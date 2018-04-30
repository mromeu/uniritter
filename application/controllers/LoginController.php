<?php
class LoginController extends Zend_Controller_Action {

    public function init() {
        $this->_helper->layout->setLayout('login');
    }

    public function indexAction() {

        $form   = new Application_Form_Login();
        $model  = new Application_Model_Usuario();

        if ($this->getRequest()->isPost() and $form->isValid($_POST)) {

            $values = $form->getValues();

            if ($model->login($values['login'], $values['senha'])) {
                $this->_helper->redirector('index', 'index');

            } else {
                $form->setDescription('Dados inválidos');
                $this->view->form = $form;

            }
        } else {
            $this->view->form = $form;

        }
    }

    public function logoutAction() {

        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index');
    }
}
