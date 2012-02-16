<?php
use lithium\core\Libraries;
use lithium\net\http\Media;
use lithium\template\View;
use li3_scaffold\controllers\ScaffoldController;
use lithium\util\String;
use lithium\template\view\adapter\File;
use lithium\template\view\Compiler;

/*
 * This filter will intercept missing Controller exception and inject our own
 */
Libraries::applyFilter('instance', function($self, $params, $chain) {

	if ($params['type'] == 'controllers') {
		$request = $params['options']['request'];

		if (!$class = $self::locate('controllers', $params['name'])) {

			$class = new li3_scaffold\controllers\ScaffoldController(compact('request'));

			return $class;
		}

	}

	return $chain->next($self, $params, $chain);
});
/*
 * This filter checks for invalid template paths and exchanges them for ours
 */
Media::applyFilter('view', function($self, $params, $chain){

	$options = $params['options'];

	$library = Libraries::get(true, 'path');
	$template = String::insert($options['paths']['template'], $options + compact('library'));

	if(!file_exists($template)) {

		//$params['handler']['view'] = 'li3_scaffold\template\ScaffoldView';
		$library = Libraries::get('li3_scaffold', 'path');
		$params['handler']['paths']['template'] = String::insert($options['paths']['template'], compact('library'));
	}

	return $chain->next($self, $params, $chain);
});


?>