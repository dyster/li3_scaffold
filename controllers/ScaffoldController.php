<?php

namespace li3_scaffold\controllers;

use li3_scaffold\models\ScaffoldModel;

class ScaffoldController extends \lithium\action\Controller
{
	private static $contrl;

	public function index($notice = null) {
		self::Init();
		$data = ScaffoldModel::all()->to('array');

		$keys = array();
		foreach($data as $d) {
			$keys = array_merge($keys, $d);
		}
		$keys = array_keys($keys);

		return compact('data', 'notice', 'keys');
	}

	public function add() {
		self::Init();
		$schema = ScaffoldModel::schema();
		$model = ScaffoldModel::create();

		if (($this->request->data) && $model->save($this->request->data)) {
			return $this->redirect(
				array(
					self::$contrl.'::index',
					'args' => array('notice' => 'Your data was successfully added')
				)
			);
		}

		return compact('schema', 'model');
	}

	public function edit($id) {
		self::Init();
		$schema = ScaffoldModel::schema();
		$model = ScaffoldModel::first($id);

		if (!$model) {
			return $this->redirect(self::$contrl.'::index');
		}
		if (($this->request->data) && $model->save($this->request->data)) {
			return $this->redirect(
				array(
					self::$contrl.'::index',
					'args' => array('notice' => 'Your data was successfully edited')
				)
			);
		}

		return compact('schema', 'model');
	}

	public function delete($id) {
		self::Init();
		$model = ScaffoldModel::find($id);

		if ($this->request->is('delete') && ScaffoldModel::first($this->request->data['id'])->delete()) {
			return $this->redirect(
				array(
					self::$contrl.'::index',
					'args' => array('notice' => 'Your data was successfully deleted!')
				)
			);
		}
		return compact('model');
	}

	private function Init()
	{
		self::$contrl = $this->request->params['controller'];
		$this->set(array('contrl' => self::$contrl));
		ScaffoldModel::meta('name', self::$contrl);
	}
}

?>