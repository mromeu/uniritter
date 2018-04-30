<?php

class Application_Form_Cliente extends Zend_Form
{

    public $cliente_id;
    public $cliente_nome;
    public $cliente_email;
    public $cliente_login;
    public $cliente_senha;
    public $cliente_ativo;
    public $cadastroi;
    public $cadastrof;


    public function init()
    {
        $this->cliente_id = new Zend_Form_Element_Hidden('cliente_id');

        $this->cliente_nome = new Zend_Form_Element_Text('cliente_nome',array(
            'class' => 'form-control'));
        $this->cliente_nome->setLabel('Nome')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->cliente_email = new Zend_Form_Element_Email('cliente_email',array(
            'class' => 'form-control'));
        $this->cliente_email->setLabel('E-mail')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->cliente_login = new Zend_Form_Element_Text('cliente_login',array(
            'class' => 'form-control'));
        $this->cliente_login->setLabel('Login')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->cliente_senha = new Zend_Form_Element_Password('cliente_senha', array(
            'class' => 'form-control'));
        $this->cliente_senha->setLabel('Senha')
                    ->removeDecorator('HtmlTag');

        $this->cliente_ativo = new Zend_Form_Element_Select('cliente_ativo',array(
            'class' => 'form-control'));
        $this->cliente_ativo->setLabel('Ativo')
                    ->removeDecorator('HtmlTag')
                    ->addMultiOption('', '')
                    ->addMultiOption('1', 'Ativo')
                    ->addMultiOption('0', 'Inativo')
                    ->setRegisterInArrayValidator(false)
                    ->setAttrib('required');

        $this->cadastroi = new Zend_Form_Element_Date('cadastroi',array(
            'class' => 'form-control'));
        $this->cadastroi->setLabel('Data de cadastro inicial')
                    ->removeDecorator('HtmlTag');

        $this->cadastrof = new Zend_Form_Element_Date('cadastrof',array(
            'class' => 'form-control'));
        $this->cadastrof->setLabel('Data de cadastro final')
                    ->removeDecorator('HtmlTag');


        $this->addElements([
    		$this->cliente_id,
		    $this->cliente_nome,
		    $this->cliente_email,
		    $this->cliente_login,
		    $this->cliente_senha,
		    $this->cliente_ativo,
        $this->cadastroi,
        $this->cadastrof
        ]);
    }

    public function filtros()
    {

		  $this->cliente_id->removeAttrib('required');
	    $this->cliente_nome->removeAttrib('required');
	    $this->cliente_email->removeAttrib('required');
	    $this->cliente_login->removeAttrib('required');
	    $this->cliente_senha->removeAttrib('required');
	    $this->cliente_ativo->removeAttrib('required');
      $this->cadastroi->removeAttrib('required');
      $this->cadastrof->removeAttrib('required');

        $this->addElements([
          $this->cliente_id,
  		    $this->cliente_nome,
  		    $this->cliente_email,
  		    $this->cliente_login,
  		    $this->cliente_senha,
  		    $this->cliente_ativo,
          $this->cadastroi,
          $this->cadastrof
        ]);

    }

}
