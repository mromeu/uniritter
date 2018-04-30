<?php

class Application_Form_Usuario extends Zend_Form
{

    public $usuario_id;
    public $cargo_id;
    public $loja_id;
    public $usuario_nome;
    public $usuario_email;
    public $usuario_login;
    public $usuario_senha;
    public $usuario_ativo;
    public $cadastroi;
    public $cadastrof;


    public function init()
    {
        $this->usuario_id = new Zend_Form_Element_Hidden('usuario_id');

        $this->cargo_id = new Zend_Form_Element_Select('fk_cargo_id',array(
            'class' => 'form-control'));
        $this->cargo_id->setLabel('Cargo')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required')
                    ->addMultiOption('', '')
                    ->setRegisterInArrayValidator(false);

        $model = new Application_Model_Cargo();
        $objs  = $model->fetchAll([
            'cargo_ativo = ?' => 1
        ]);

        foreach ($objs as $obj) {

            $this->cargo_id->addMultiOption($obj['cargo_id'], $obj['cargo_nome']);
        }

        $this->loja_id = new Zend_Form_Element_Select('fk_loja_id',array(
            'class' => 'form-control'));
        $this->loja_id->setLabel('Loja')
                    ->removeDecorator('HtmlTag')
                    ->addMultiOption('', '')
                    ->setRegisterInArrayValidator(false);

        $model = new Application_Model_Loja();
        $objs  = $model->fetchAll([
            'loja_ativo = ?' => 1
        ]);

        foreach ($objs as $obj) {

            $this->loja_id->addMultiOption($obj['loja_id'], $obj['loja_nome']);
        }

        $this->usuario_nome = new Zend_Form_Element_Text('usuario_nome',array(
            'class' => 'form-control'));
        $this->usuario_nome->setLabel('Nome')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->usuario_email = new Zend_Form_Element_Email('usuario_email',array(
            'class' => 'form-control'));
        $this->usuario_email->setLabel('E-mail')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->usuario_login = new Zend_Form_Element_Text('usuario_login',array(
            'class' => 'form-control'));
        $this->usuario_login->setLabel('Login')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->usuario_senha = new Zend_Form_Element_Password('usuario_senha', array(
            'class' => 'form-control'));
        $this->usuario_senha->setLabel('Senha')
                    ->removeDecorator('HtmlTag');

        $this->usuario_ativo = new Zend_Form_Element_Select('usuario_ativo',array(
            'class' => 'form-control'));
        $this->usuario_ativo->setLabel('Ativo')
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
    		$this->usuario_id,
        $this->loja_id,
        $this->cargo_id,
		    $this->usuario_nome,
		    $this->usuario_email,
		    $this->usuario_login,
		    $this->usuario_senha,
		    $this->usuario_ativo,
        $this->cadastroi,
        $this->cadastrof
        ]);
    }

    public function filtros()
    {

		  $this->usuario_id->removeAttrib('required');
      $this->cargo_id->removeAttrib('required');
      $this->loja_id->removeAttrib('required');
	    $this->usuario_nome->removeAttrib('required');
	    $this->usuario_email->removeAttrib('required');
	    $this->usuario_login->removeAttrib('required');
	    $this->usuario_senha->removeAttrib('required');
	    $this->usuario_ativo->removeAttrib('required');
      $this->cadastroi->removeAttrib('required');
      $this->cadastrof->removeAttrib('required');

        $this->addElements([
          $this->usuario_id,
          $this->cargo_id,
          $this->loja_id,
  		    $this->usuario_nome,
  		    $this->usuario_email,
  		    $this->usuario_login,
  		    $this->usuario_senha,
  		    $this->usuario_ativo,
          $this->cadastroi,
          $this->cadastrof
        ]);

    }

}
