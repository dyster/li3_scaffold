<?php
use lithium\core\Libraries;
use lithium\net\http\Media;
use lithium\util\String;

/*
 * This filter will intercept missing Controller exception and inject our own
 */
Libraries::applyFilter('instance', function($self, $params, $chain) {
	if ($params['type'] == 'controllers') {
		$request = $params['options']['request'];
		if (!$class = $self::locate('controllers', $params['name'])) {
			return new li3_scaffold\controllers\ScaffoldController(compact('request'));
		}
	}
	return $chain->next($self, $params, $chain);
});

/*
 * This filter checks for invalid template paths and exchanges them for ours
 */
Media::applyFilter('view', function($self, $params, $chain) {
	$options = $params['options'];
	$pattern = $options['paths']['template'];
	$library = Libraries::get(true, 'path');
	$template = String::insert($pattern, $options + compact('library'));

	if(!file_exists($template)) {
		$library = Libraries::get('li3_scaffold', 'path');
		$params['handler']['paths']['template'] = String::insert($pattern, compact('library'));
	}
	return $chain->next($self, $params, $chain);
});

?>