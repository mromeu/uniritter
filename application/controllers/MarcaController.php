<?php

class MarcaController extends Zend_Controller_Action
{

    public function init()
    {

      	/**
      	 *
      	 * @var array
      	 * title = title to be in strong tag
      	 * message = message to show
      	 * css = class to add
      	 */
    	  $this->view->flashMessage = array();
        $this->view->controllerName = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();

        $this->model = new Application_Model_Marca();
        $this->form = new Application_Form_Marca();
        $this->formNovo = new Application_Form_Marca();
        $this->link = 'marca';
        $this->idBd = 'marca_id';

        $this->funcoes = new Zend_Funcoes();
        $this->session = new Zend_Session_Namespace('login');

        if($this->funcoes->Logado()){
            if ('logout' == $this->getRequest()->getActionName()) {
                $this->_helper->redirector('index');
            }

        } else {
            if ('logout' != $this->getRequest()->getActionName()) {
                $this->_helper->redirector('index', 'login');
            }
        }

    }

    public function indexAction()
    {

        $model  = $this->model;
        $form   = $this->form;

        $form->filtros();

        $where['marca_ativo'] = 1;

        if($this->getRequest()->isPost() and $form->isValid($_POST)) {

            $where = $form->getValues();

            $this->view->limpraFiltro = true;
        }

        $rows   = $model->fetchAll($where);

        if(count($rows) == 0) {

            $this->view->flashMessage = [
                'title' => 'Errou!',
                'message' => 'Nenhum registro encontrado.',
                'css' => 'danger'
            ];
        }

        $this->view->rows = $rows;
        $this->view->form = $form;
        $this->view->formNovo = $this->formNovo;
        $this->view->cols = $this->funcoes->ColsInfo($model);
    }

    public function salvarAction()
    {
        $model  = $this->model;
        $form   = $this->form;
        $funcoes = new Zend_Funcoes();

        if($this->getRequest()->isPost() and $form->isValid($_POST)) {

            $values = $funcoes->FormataInputsBd($funcoes->ColsInfo($model), $form->getValues());

            if(!empty($_POST[$this->idBd])) {

                $id = $_POST[$this->idBd];

                if($model->salvar($values, $id, $this->session->usuario_id)) {

                    $this->redirect($this->link);
                };

            } else {

                if($model->novo($values, $this->session->usuario_id)) {

                    $this->redirect($this->link);
                };

            }

        }
    }

    public function editarAction()
    {
        $model  = $this->model;

        if(!empty($this->getParam('id'))) {

            $this->_helper->json($model->find($this->getParam('id')));
        }

    }

    public function deletarAction()
    {

        $model  = $this->model;

        $model->deletar(
            $this->getParam('id'),
            $this->getParam('status') == 1 ? 0 : 1,
            $this->session->usuario_id
        );

    }

}
