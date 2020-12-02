<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
	protected $serviceUrl;

	public function __construct() {

		$this->session = \Config\Services::session();
		helper(['checklogin','url']);

		$config = new \Config\App();
		$this->serviceUrl = $config->serviceUrl;

    }

	public function index()
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
			die;
		}

		$nav = [
			'module_name' => 'Index',
			'module_level' => array(
									array('name'=>"Home", 'url'=>"/"),
								)
		];

		echo view('template/header');
		echo view('template/body', $nav);
		echo view('index');
		echo view('template/footer');

	}

	public function login()
	{
		echo view('login');
	}

	//--------------------------------------------------------------------

}
