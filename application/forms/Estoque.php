<?php

class Application_Form_Estoque extends Zend_Form
{
    public $estoque_id;
    public $produto_id;
    public $estoque_quantidade;

    public function init()
    {
        $funcoes = new Zend_Funcoes();

        $this->produto_id = new Zend_Form_Element_Select('fk_produto_id',array(
            'class' => 'form-control'));
        $this->produto_id->setLabel('Produto')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required')
                    ->addMultiOption('', '')
                    ->setRegisterInArrayValidator(false);

        $model = new Application_Model_Produto();
        $objs  = $model->fetchAll();

        foreach ($objs as $obj) {

            $this->produto_id->addMultiOption($obj['produto_id'], $obj['produto_nome']);
        }

        $this->estoque_quantidade = new Zend_Form_Element_Number('estoque_quantidade',array(
            'class' => 'form-control',
            'min'   => '0',
            'max'   => '10000'));

        $this->estoque_quantidade->setLabel('Quantidade')
                    ->removeDecorator('HtmlTag')
                    ->setAttrib('required');

       $this->addElements(array(
            $this->estoque_id,
            $this->produto_id,
            $this->estoque_quantidade,
        ));
    }

    public function filtros()
    {

        $this->produto_id->removeAttrib('required');
        $this->estoque_quantidade->removeAttrib('required');

        $this->addElements([
            $this->estoque_id,
            $this->produto_id,
            $this->estoque_quantidade
        ]);

    }

}
