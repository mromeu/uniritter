<?php

class Application_Form_Loja extends Zend_Form
{

    public $loja_id;
    public $estado_id;
    public $cidade_id;
    public $loja_nome;
    public $loja_endereco;
    public $loja_numero;
    public $loja_complemento;
    public $loja_bairro;
    public $loja_cep;
    public $loja_ativo;

    public function init()
    {
        $this->loja_id = new Zend_Form_Element_Hidden('loja_id');

        $this->estado_id = new Zend_Form_Element_Select('fk_estado_id',array(
            'class' => 'form-control',
            'onchange' => 'carregaCidades(this.value)'));
        $this->estado_id->setLabel('Estado')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required')
                    ->addMultiOption('', 'escolha um estado')
                    ->setRegisterInArrayValidator(false);

        $model = new Application_Model_Estado();
        $objs  = $model->fetchAll();

        foreach ($objs as $obj) {

            $this->estado_id->addMultiOption($obj['estado_id'], $obj['estado_sigla'] . ' - ' . $obj['estado_nome']);
        }

        $this->cidade_id = new Zend_Form_Element_Select('fk_cidade_id',array(
            'class' => 'form-control cidade'));
        $this->cidade_id->setLabel('Cidade')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required')
                    ->addMultiOption('', '')
                    ->setRegisterInArrayValidator(false);

        $this->loja_nome = new Zend_Form_Element_Text('loja_nome',array(
            'class' => 'form-control'));
        $this->loja_nome->setLabel('Nome')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->loja_endereco = new Zend_Form_Element_Text('loja_endereco',array(
            'class' => 'form-control'));
        $this->loja_endereco->setLabel('Endereço')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->loja_numero = new Zend_Form_Element_Text('loja_numero',array(
            'class' => 'form-control'));
        $this->loja_numero->setLabel('Número')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->loja_complemento = new Zend_Form_Element_Text('loja_complemento',array(
            'class' => 'form-control'));
        $this->loja_complemento->setLabel('Complemento')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->loja_bairro = new Zend_Form_Element_Text('loja_bairro',array(
            'class' => 'form-control'));
        $this->loja_bairro->setLabel('Bairro')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->loja_cep = new Zend_Form_Element_Text('loja_cep',array(
            'class' => 'form-control'));
        $this->loja_cep->setLabel('CEP')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->loja_ativo = new Zend_Form_Element_Select('loja_ativo',array(
            'class' => 'form-control'));
        $this->loja_ativo->setLabel('Ativo')
                    ->removeDecorator('HtmlTag')
                    ->addMultiOption('', '')
                    ->addMultiOption('1', 'Ativo')
                    ->addMultiOption('0', 'Inativo')
                    ->setRegisterInArrayValidator(false)
                    ->setAttrib('required');

        $this->addElements([
    		$this->loja_id,
		    $this->estado_id,
		    $this->cidade_id,
		    $this->loja_nome,
		    $this->loja_endereco,
		    $this->loja_numero,
        $this->loja_complemento,
        $this->loja_bairro,
        $this->loja_cep,
        $this->loja_ativo
        ]);
    }

    public function filtros()
    {

		  $this->loja_id->removeAttrib('required');
      $this->estado_id->removeAttrib('required');
      $this->cidade_id->removeAttrib('required');
	    $this->loja_nome->removeAttrib('required');
	    $this->loja_endereco->removeAttrib('required');
	    $this->loja_numero->removeAttrib('required');
	    $this->loja_complemento->removeAttrib('required');
	    $this->loja_bairro->removeAttrib('required');
      $this->loja_cep->removeAttrib('required');
      $this->loja_ativo->removeAttrib('required');

        $this->addElements([
          $this->loja_id,
  		    $this->estado_id,
  		    $this->cidade_id,
  		    $this->loja_nome,
  		    $this->loja_endereco,
  		    $this->loja_numero,
          $this->loja_complemento,
          $this->loja_bairro,
          $this->loja_cep,
          $this->loja_ativo
        ]);

    }

}
