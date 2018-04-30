<?php

class LojaController extends Zend_Controller_Action
{

    protected $model;
    protected $form;
    protected $link;
    protected $idBd;

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

        $this->model = new Application_Model_Loja();
        $this->form = new Application_Form_Loja();
        $this->link = 'loja';
        $this->idBd = 'loja_id';

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

        $where['loja_ativo'] = 1;

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
        $this->view->formNovo = $this->form;
        $this->view->cols = $this->funcoes->ColsInfo($model);
    }

    public function salvarAction($values = null)
    {
        $model  = $this->model;
        $form   = $this->form;

        if($this->getRequest()->isPost() and $form->isValid($_POST)) {

            $values = $this->funcoes->FormataInputsBd($this->funcoes->ColsInfo($model), $form->getValues());

            if(!empty($_POST[$this->idBd])) {

                $id = $_POST[$this->idBd];

                if($model->salvar($values, $id, $this->session->usuario_id)) {

                    $this->redirect($this->link);
                };

            } else {

                if($model->novo($values, $this->session->usuario_id)) {

                    $this->redirect($this->link);
                }
            }
        }
    }

    public function novoAction()
    {
        $model  = $this->model;
        $form   = $this->form;

        if($this->getRequest()->isPost() and $form->isValid($_POST)) {

            $this->salvarAction($form->getValues());

        } else {

        }

        $this->view->form = $form;
    }
    public function editarAction()
    {
        $model  = $this->model;
        $form   = $this->form;

        if(!empty($this->getParam('id'))) {

            $obj = $model->find($this->getParam('id'));

            $this->funcoes->FormataInputsView($this->funcoes->ColsInfo($model), $form->getElements(), $obj);
        }

        $this->view->form = $form;
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
