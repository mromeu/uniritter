<?php
class Application_Form_Login extends Zend_Form
{
    public $login;
    public $senha;
    public $submit;

    public function init()
    {
        $this->login = new Zend_Form_Element_Text('login', array(
            'class' => 'form-control',
            'placeholder' => 'usuário'));
        $this->login->setAttrib('required');

        $this->senha = new Zend_Form_Element_Password('senha', array(
            'class' => 'form-control',
            'placeholder' => 'senha'));

        $this->submit = new Zend_Form_Element_Submit('ENTRAR', array('class' => 'btn btn-lg btn-primary btn-block'));
        $this->submit->addDecorators(array(array('HtmlTag', array('class' => 'text-danger'))));

        $this->addElements(array(
            $this->login,
            $this->senha,
            $this->submit
        ))
             ->setElementDecorators(array('ViewHelper','Errors'))
             ->setDecorators(array('FormElements', 'Form'))
             ->setAttrib('class', 'form-signin')
             ->addDecorator('Description', array('placement' => 'prepend'));
    }
}
