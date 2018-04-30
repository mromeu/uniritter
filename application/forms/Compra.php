<?php

class Application_Form_Compra extends Zend_Form
{

    public $cliente_id;
    public $produto_id;
    public $forma_pagamento_id;
    public $compra_quantidade;
    public $compra_valor;

    public function init()
    {
        $funcoes = new Zend_Funcoes();

        $this->cliente_id = new Zend_Form_Element_Select('fk_cliente_id',array(
            'class' => 'form-control'));
        $this->cliente_id->setLabel('Cliente')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required')
                    ->addMultiOption('', '')
                    ->setRegisterInArrayValidator(false);

        $model = new Application_Model_Cliente();
        $objs  = $model->fetchAll();

        foreach ($objs as $obj) {

            $this->cliente_id->addMultiOption($obj['cliente_id'], $obj['cliente_nome']);
        }

        $this->produto_id = new Zend_Form_Element_Select('fk_produto_id',array(
            'class' => 'form-control'));
        $this->produto_id->setLabel('Produto')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required')
                    ->addMultiOption('', '')
                    ->setRegisterInArrayValidator(false);

        $model = new Application_Model_Produto();
        $objs  = $model->fetchAll(array('estoque_minimo' => 0));

        foreach ($objs as $obj) {

            $this->produto_id->addMultiOption($obj['produto_id'], $obj['produto_nome'] . ' - Estoque: '. $obj['estoque_quantidade']);
        }

        $this->forma_pagamento_id = new Zend_Form_Element_Select('fk_forma_pagamento_id',array(
            'class' => 'form-control'));
        $this->forma_pagamento_id->setLabel('Forma de Pagamento')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required')
                    ->addMultiOption('', '')
                    ->setRegisterInArrayValidator(false);

        $model = new Application_Model_FormaPagamento();
        $objs  = $model->fetchAll();

        foreach ($objs as $obj) {

            $this->forma_pagamento_id->addMultiOption($obj['forma_pagamento_id'], $obj['forma_pagamento_nome']);
        }

        $this->compra_quantidade = new Zend_Form_Element_Number('compra_quantidade',array(
            'class' => 'form-control',
            'min'   => '0',
            'max'   => '10000'));

        $this->compra_quantidade->setLabel('Quantidade')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

        $this->compra_valor = new Zend_Form_Element_Text('compra_valor',array(
            'class' => 'form-control'));

        $this->compra_valor->setLabel('Valor')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

       $this->addElements(array(
            $this->produto_id,
            $this->cliente_id,
            $this->forma_pagamento_id,
            $this->compra_valor,
            $this->compra_quantidade
        ));
    }

    public function filtros()
    {

        $this->produto_id->removeAttrib('required');
        $this->cliente_id->removeAttrib('required');
        $this->forma_pagamento_id->removeAttrib('required');
        $this->compra_valor->removeAttrib('required');
        $this->compra_quantidade->removeAttrib('required');

        $this->addElements([
          $this->produto_id,
          $this->cliente_id,
          $this->forma_pagamento_id,
          $this->compra_valor,
          $this->compra_quantidade
        ]);

    }

}
