<?php

class Application_Form_FormaPagamento extends Zend_Form
{

    public $forma_pagamento_nome;
    public $forma_pagamento_ativo;

    public function init()
    {
        $funcoes = new Zend_Funcoes();

        $this->forma_pagamento_nome = new Zend_Form_Element_Text('forma_pagamento_nome',array(
            'class' => 'form-control'));
        $this->forma_pagamento_nome->setLabel('Nome')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->forma_pagamento_ativo = new Zend_Form_Element_Select('forma_pagamento_ativo',array(
            'class' => 'form-control'));
        $this->forma_pagamento_ativo->setLabel('Ativo')
                    ->removeDecorator('HtmlTag')
                    ->setRequired(false)
                    ->addMultiOption('1', 'Ativo')
                    ->addMultiOption('0', 'Inativo')
                    ->setRegisterInArrayValidator(false);

       $this->addElements(array(
            $this->forma_pagamento_nome,
            $this->forma_pagamento_ativo,
        ));
    }

    public function filtros()
    {

        $this->forma_pagamento_nome->removeAttrib('required');
        $this->forma_pagamento_ativo->removeAttrib('required');

        $this->addElements([
            $this->forma_pagamento_nome,
            $this->forma_pagamento_ativo
        ]);

    }

}
