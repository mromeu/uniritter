<?php

class IndexController extends Zend_Controller_Action
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
      $this->session = new Zend_Session_Namespace('login');
    }

    public function preDispatch()
    {
      $this->funcoes = new Zend_Funcoes();

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


    }

}
