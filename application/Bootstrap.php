<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initRoutes()
    {
        $router = Zend_Controller_Front::getInstance()->getRouter();
        include APPLICATION_PATH . "/configs/routes.php";
    }

    protected function _initResourceAutoloader()
    {
        //Zend_Paginator::setDefaultScrollingStyle('Sliding');
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('pagination.phtml');
    }
}
