<?php

class Application_Form_Cargo extends Zend_Form
{

    public $cargo_nome;
    public $cargo_codigo;
    public $cargo_ativo;

    public function init()
    {
        $funcoes = new Zend_Funcoes();

        $this->cargo_nome = new Zend_Form_Element_Text('cargo_nome',array(
            'class' => 'form-control'));
        $this->cargo_nome->setLabel('Nome')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->cargo_codigo = new Zend_Form_Element_Text('cargo_codigo',array(
            'class' => 'form-control'));
        $this->cargo_codigo->setLabel('Código')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->cargo_ativo = new Zend_Form_Element_Select('cargo_ativo',array(
            'class' => 'form-control'));
        $this->cargo_ativo->setLabel('Ativo')
                    ->removeDecorator('HtmlTag')
                    ->setRequired(false)
                    ->addMultiOption('1', 'Ativo')
                    ->addMultiOption('0', 'Inativo')
                    ->setRegisterInArrayValidator(false);

       $this->addElements(array(
            $this->cargo_nome,
            $this->cargo_codigo,
        ));
    }

    public function filtros()
    {

        $this->cargo_nome->removeAttrib('required');
        $this->cargo_codigo->removeAttrib('required');

        $this->addElements([
            $this->cargo_nome,
            $this->cargo_codigo,
            $this->cargo_ativo
        ]);

    }

}
