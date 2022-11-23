<?php
//Class Controller làm công việc giao tiếp giữa models và views
namespace App\Controllers;

use League\Plates\Engine;

class Controller
{
	protected $view;

	public function __construct() {
		$this->view = new Engine(ROOTDIR . 'views');
	}

	public function sendPage($page, array $data = []) {
		exit($this->view->render($page, $data));
	}

	public function sendNotFound(){
	http_response_code(404);
	exit($this->view->render('errors/404'));
	}
	//Lưu giá trị của form
	protected function saveFormValues(array $data, array $except = []) {
		$form = [];
		foreach ($data as $key => $value) {
			if (!in_array($key, $except, true)) {
				$form[$key] = $value;
			}
		}
		$_SESSION['form'] = $form;
	}

	//Lấy giá trị form đã lưu
	protected function getSavedFormValues()
	{
		return session_get_once('form', []);
	}

}
