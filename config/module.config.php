<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'LedsStickyNotes\Controller\Simple' => 'LedsStickyNotes\Controller\SimpleController',
            'LedsStickyNotes\Controller\Collection' => 'LedsStickyNotes\Controller\CollectionController',            
        ),
    ),
    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                'LedsStickyNotes' => __DIR__ . '/../public',
            ),
        ),
    ),    
     'router' => array(
        'routes' => array(
             'simple' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/simple[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'note' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'LedsStickyNotes\Controller\Simple',
                        'action' => 'index',
                    ),
                ),
            ),
             'sticky-notes-collection' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/sticky-notes-collection[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'LedsStickyNotes\Controller\Collection',
                        'action' => 'index',
                    ),
                ),
            ),
            'sticky-notes-collection-view' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/sticky-notes-collection/notes-collection[/:note][/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'note' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'LedsStickyNotes\Controller\Collection',
                        'action' => 'collection-view',
                    ),
                ),
            ),            
        ),
    ),
 	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view'
		),
		'strategies' => array(
			'ViewJsonStrategy',
		),
	),
    'doctrine' => array(
        'driver' => array(
            'LedsStickyNotes_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/LedsStickyNotes/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'LedsStickyNotes\Entity' => 'LedsStickyNotes_driver',
                ),
            ),
        ),
    ),
);
