<?php

$route = new Zend_Controller_Router_Route(
    'cargo/:id',
    array(
        'controller' => 'cargo',
        'action'     => 'editar'
    )
);

$router->addRoute('cargo', $route);

$route = new Zend_Controller_Router_Route(
    'cargo/salvar',
    array(
        'controller' => 'cargo',
        'action'     => 'salvar'
    )
);

$router->addRoute('cargo/salvar', $route);

$route = new Zend_Controller_Router_Route(
    'cargo/deletar/:id/status/:status',
    array(
        'controller' => 'cargo',
        'action'     => 'deletar'
    )
);

$router->addRoute('cargo/deletar', $route);




$route = new Zend_Controller_Router_Route(
    'cliente/:id',
    array(
        'controller' => 'cliente',
        'action'     => 'editar'
    )
);

$router->addRoute('cliente', $route);

$route = new Zend_Controller_Router_Route(
    'cliente/salvar',
    array(
        'controller' => 'cliente',
        'action'     => 'salvar'
    )
);

$router->addRoute('cliente/salvar', $route);

$route = new Zend_Controller_Router_Route(
    'cliente/novo/',
    array(
        'controller' => 'cliente',
        'action'     => 'novo'
    )
);

$router->addRoute('cliente/novo', $route);


$route = new Zend_Controller_Router_Route(
    'cliente/deletar/:id/status/:status',
    array(
        'controller' => 'cliente',
        'action'     => 'deletar'
    )
);

$router->addRoute('cliente/deletar', $route);


$route = new Zend_Controller_Router_Route(
    'compra/:id',
    array(
        'controller' => 'compra',
        'action'     => 'editar'
    )
);

$router->addRoute('compra', $route);

$route = new Zend_Controller_Router_Route(
    'compra/salvar',
    array(
        'controller' => 'compra',
        'action'     => 'salvar'
    )
);

$router->addRoute('compra/salvar', $route);

$route = new Zend_Controller_Router_Route(
    'compra/deletar/:id/status/:status',
    array(
        'controller' => 'compra',
        'action'     => 'deletar'
    )
);

$router->addRoute('compra/deletar', $route);

$route = new Zend_Controller_Router_Route(
    'estoque/:id',
    array(
        'controller' => 'estoque',
        'action'     => 'editar'
    )
);

$router->addRoute('estoque', $route);

$route = new Zend_Controller_Router_Route(
    'estoque/salvar',
    array(
        'controller' => 'estoque',
        'action'     => 'salvar'
    )
);

$router->addRoute('estoque/salvar', $route);

$route = new Zend_Controller_Router_Route(
    'estoque/deletar/:id/status/:status',
    array(
        'controller' => 'estoque',
        'action'     => 'deletar'
    )
);

$router->addRoute('estoque/deletar', $route);


/*
MOEDA
 */

$route = new Zend_Controller_Router_Route(
    'forma-pagamento/:id',
    array(
        'controller' => 'forma-pagamento',
        'action'     => 'editar'
    )
);

$router->addRoute('forma-pagamento', $route);

$route = new Zend_Controller_Router_Route(
    'forma-pagamento/salvar',
    array(
        'controller' => 'forma-pagamento',
        'action'     => 'salvar'
    )
);

$router->addRoute('forma-pagamento/salvar', $route);

$route = new Zend_Controller_Router_Route(
    'forma-pagamento/deletar/:id/status/:status',
    array(
        'controller' => 'forma-pagamento',
        'action'     => 'deletar'
    )
);

$router->addRoute('forma-pagamento/deletar', $route);


/*
PROCEDIMENTOS
 */

$route = new Zend_Controller_Router_Route(
    'loja/:id',
    array(
        'controller' => 'loja',
        'action'     => 'editar'
    )
);

$router->addRoute('loja', $route);

$route = new Zend_Controller_Router_Route(
    'loja/salvar',
    array(
        'controller' => 'loja',
        'action'     => 'salvar'
    )
);

$router->addRoute('loja/salvar', $route);

$route = new Zend_Controller_Router_Route(
    'loja/novo/',
    array(
        'controller' => 'loja',
        'action'     => 'novo'
    )
);

$router->addRoute('loja/novo', $route);

$route = new Zend_Controller_Router_Route(
    'loja/deletar/:id/status/:status',
    array(
        'controller' => 'loja',
        'action'     => 'deletar'
    )
);

$router->addRoute('loja/deletar', $route);


/*
PAIS
 */

$route = new Zend_Controller_Router_Route(
    'produto/:id',
    array(
        'controller' => 'produto',
        'action'     => 'editar'
    )
);

$router->addRoute('produto', $route);

$route = new Zend_Controller_Router_Route(
    'produto/salvar',
    array(
        'controller' => 'produto',
        'action'     => 'salvar'
    )
);

$router->addRoute('produto/salvar', $route);

$route = new Zend_Controller_Router_Route(
    'produto/novo/',
    array(
        'controller' => 'produto',
        'action'     => 'novo'
    )
);

$router->addRoute('produto/novo', $route);

$route = new Zend_Controller_Router_Route(
    'produto/deletar/:id/status/:status',
    array(
        'controller' => 'produto',
        'action'     => 'deletar'
    )
);

$router->addRoute('produto/deletar', $route);

/*
USUARIOS
 */

$route = new Zend_Controller_Router_Route(
    'usuario/:id',
    array(
        'controller' => 'usuario',
        'action'     => 'editar'
    )
);

$router->addRoute('usuario', $route);

$route = new Zend_Controller_Router_Route(
    'usuario/salvar',
    array(
        'controller' => 'usuario',
        'action'     => 'salvar'
    )
);

$router->addRoute('usuario/salvar', $route);

$route = new Zend_Controller_Router_Route(
    'usuario/deletar/:id/status/:status',
    array(
        'controller' => 'usuario',
        'action'     => 'deletar'
    )
);

$router->addRoute('usuario/deletar', $route);

$route = new Zend_Controller_Router_Route(
    'usuario/novo/',
    array(
        'controller' => 'usuario',
        'action'     => 'novo'
    )
);

$router->addRoute('usuario/novo', $route);


$route = new Zend_Controller_Router_Route(
    'marca/:id',
    array(
        'controller' => 'marca',
        'action'     => 'editar'
    )
);

$router->addRoute('marca', $route);

$route = new Zend_Controller_Router_Route(
    'marca/salvar',
    array(
        'controller' => 'marca',
        'action'     => 'salvar'
    )
);

$router->addRoute('marca/salvar', $route);

$route = new Zend_Controller_Router_Route(
    'marca/deletar/:id/status/:status',
    array(
        'controller' => 'marca',
        'action'     => 'deletar'
    )
);

$router->addRoute('marca/deletar', $route);
?>
