<?php

class Application_Form_Marca extends Zend_Form
{

    public $marca_nome;
    public $marca_ativo;

    public function init()
    {
        $funcoes = new Zend_Funcoes();

        $this->marca_nome = new Zend_Form_Element_Text('marca_nome',array(
            'class' => 'form-control'));
        $this->marca_nome->setLabel('Nome')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->marca_ativo = new Zend_Form_Element_Select('marca_ativo',array(
            'class' => 'form-control'));
        $this->marca_ativo->setLabel('Ativo')
                    ->removeDecorator('HtmlTag')
                    ->setRequired(false)
                    ->addMultiOption('1', 'Ativo')
                    ->addMultiOption('0', 'Inativo')
                    ->setRegisterInArrayValidator(false);

       $this->addElements(array(
            $this->marca_nome,
            $this->marca_ativo,
        ));
    }

    public function filtros()
    {

        $this->marca_nome->removeAttrib('required');
        $this->marca_ativo->removeAttrib('required');

        $this->addElements([
            $this->marca_nome,
            $this->marca_ativo
        ]);

    }

}
