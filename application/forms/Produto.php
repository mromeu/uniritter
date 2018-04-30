<?php

class Application_Form_Produto extends Zend_Form
{

    public $produto_id;
    public $marca_id;
    public $produto_nome;
    public $produto_imagem;
    public $produto_descricao;
    public $produto_valor;
    public $produto_ativo;
    public $cadastroi;
    public $cadastrof;
    public $valori;
    public $valorf;


    public function init()
    {
        $this->produto_id = new Zend_Form_Element_Hidden('produto_id');




        $this->marca_id = new Zend_Form_Element_Select('fk_marca_id',array(
            'class' => 'form-control'));
        $this->marca_id->setLabel('Marca')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required')
                    ->addMultiOption('', 'escolha uma marca')
                    ->setRegisterInArrayValidator(false);

        $model = new Application_Model_Marca();
        $objs  = $model->fetchAll(array('marca_ativo' => 1));

        foreach ($objs as $obj) {

            $this->marca_id->addMultiOption($obj['marca_id'], $obj['marca_nome']);
        }


























        $this->produto_nome = new Zend_Form_Element_Text('produto_nome',array(
            'class' => 'form-control'));
        $this->produto_nome->setLabel('Nome')
                    ->removeDecorator('HtmlTag');
                    //->setAttrib('required');

        $this->produto_imagem = new Zend_Form_Element_File('produto_imagem',array(
            'class' => 'form-control'));
        $this->produto_imagem->setLabel('Imagem do Produto')
                    ->setDestination(APPLICATION_PATH .'/../public/img/produto')
                    ->removeDecorator('HtmlTag');

        $this->produto_descricao = new Zend_Form_Element_Textarea('produto_descricao', array(
            'class' => 'form-control textarea-editor',
            'rows' => 10));
        $this->produto_descricao->setLabel('Descrição do Produto')
                    ->removeDecorator('HtmlTag');

        $this->produto_valor = new Zend_Form_Element_Text('produto_valor',array(
            'class' => 'form-control'));
        $this->produto_valor->setLabel('Valor')
                    ->removeDecorator('HtmlTag');
                    //->setAttrib('required');

        $this->cadastroi = new Zend_Form_Element_Date('cadastroi',array(
            'class' => 'form-control'));
        $this->cadastroi->setLabel('Data de cadastro inicial')
                    ->removeDecorator('HtmlTag');

        $this->cadastrof = new Zend_Form_Element_Date('cadastrof',array(
            'class' => 'form-control'));
        $this->cadastrof->setLabel('Data de cadastro final')
                    ->removeDecorator('HtmlTag');

        $this->valori = new Zend_Form_Element_Text('valori',array(
            'class' => 'form-control'));
        $this->valori->setLabel('Valor inicial')
                    ->removeDecorator('HtmlTag');

        $this->valorf = new Zend_Form_Element_Text('valorf',array(
            'class' => 'form-control'));
        $this->valorf->setLabel('Valor final')
                    ->removeDecorator('HtmlTag');

        $this->produto_ativo = new Zend_Form_Element_Select('produto_ativo',array(
            'class' => 'form-control'));
        $this->produto_ativo->setLabel('Ativo')
                    ->removeDecorator('HtmlTag')
                    ->setRequired(false)
                    ->addMultiOption('1', 'Ativo')
                    ->addMultiOption('0', 'Inativo')
                    ->setRegisterInArrayValidator(false);


        $this->addElements([
    		$this->produto_id,
        $this->marca_id,
		    $this->produto_nome,
		    $this->produto_imagem,
		    $this->produto_descricao,
		    $this->produto_valor,
		    $this->produto_ativo,
        ]);
    }

    public function filtros()
    {

		  $this->produto_id->removeAttrib('required');
	    $this->produto_nome->removeAttrib('required');
      $this->marca_id->removeAttrib('required');
	    $this->produto_imagem->removeAttrib('required');
	    $this->produto_descricao->removeAttrib('required');
	    $this->produto_valor->removeAttrib('required');
	    $this->produto_ativo->removeAttrib('required');
      $this->cadastroi->removeAttrib('required');
      $this->cadastrof->removeAttrib('required');
      $this->valori->removeAttrib('required');
      $this->valorf->removeAttrib('required');

        $this->addElements([
          $this->produto_id,
  		    $this->produto_nome,
          $this->marca_id,
  		    $this->produto_imagem,
  		    $this->produto_descricao,
  		    $this->produto_valor,
  		    $this->produto_ativo,
          $this->cadastroi,
          $this->cadastrof,
          $this->valori,
          $this->valorf
        ]);

    }

}
