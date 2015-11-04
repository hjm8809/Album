<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Demo\Controller\Index' => 'Demo\Controller\IndexController',
        ),
    ),
    //album.local/demo[/:controller[/:action]] => /Album/module/Demo/Controller/IndexController.php
    'router' => array(
        'routes' => array(
            'demo' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/demo[/:controller[/:action]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Demo\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

);