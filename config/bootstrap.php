<?php

	Croogo::hookRoutes('Cforms');
	Croogo::hookComponent('Nodes', 'Cforms.Cforms');
	Croogo::hookHelper('Nodes', 'Cforms.CformCss');
	Croogo::hookAdminMenu('Cforms');

 	CroogoNav::add('extensions.children.cforms', array(
        'title' => __('Cforms'),
        'url' => '#',
        'access' => array('admin'),
        'children' => array(
            'cforms1' => array(
                'title' => __('List Forms'),
                'url' => array('controller' => 'cforms', 'action' => 'index', 'plugin' => 'cforms','admin' => true),
                'access' => array('admin'),
            ),
            'cforms2' => array(
                'title' => __('Create Form'),
                'url' => array('controller' => 'cforms', 'action' => 'add', 'plugin' => 'cforms','admin' => true),
                'access' => array('admin'),
            ),
            'cforms3' => array(
                'title' => __('Validation Rules'),
                'url' => array('controller' => 'validation_rules', 'action' => 'index', 'plugin' => 'cforms','admin' => true),
                'access' => array('admin'),
            ),
        ),
    ));

?>