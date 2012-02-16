<?php

namespace li3_scaffold\controllers;

use li3_scaffold\models\ScaffoldModel;



class ScaffoldController extends \lithium\action\Controller
{


	public function index()	{

		$contrl = $this->request->params['controller'];
		$data[1] = array("This is a test string");
		//ScaffoldModel::__init();

		ScaffoldModel::meta('name', $contrl);
		$data = ScaffoldModel::all()->to('array');

		if(empty($data)) {
			$data[]['Table empty!'] = 'Go insert something';
		}

		return compact('data', 'contrl');
	}

	public function add() {
		$contrl = $this->request->params['controller'];
		ScaffoldModel::meta('name', $contrl);
		$schema = ScaffoldModel::schema();
		$model = ScaffoldModel::create();
		return compact('schema', 'model', 'contrl');
	}


}



?>