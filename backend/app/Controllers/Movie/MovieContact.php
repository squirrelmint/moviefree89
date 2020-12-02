<?php

namespace App\Controllers\Movie;

use App\Models\Contact_Model;
use CodeIgniter\Controller;

class MovieContact extends Controller
{
	public function __construct()
	{
		$this->validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
		$this->contactdatamodel = new Contact_Model();

		helper(['filesystem', 'alert', 'loader', 'checklogin', 'url', 'pagination']);
	}

	public function index($branch, $search = "")
	{

		if (checkLogin() == false) {
			return redirect()->to('/login');
		}

		$nav = [
			'module_name' => 'ผู้ต้องการติดต่อ',
			'module_level' => array(
				array('name' => "Home", 'url' => "/"),
				array('name' => "Branch", 'url' => "/management/branch/" . $branch),
				array('name' => 'Request Ads', 'url' => "")
			)
		];
		$contact = $this->contactdatamodel->get_contact($branch, $search);
		$data = [
			'contact' => $contact,
			'search_string'=>$search,
			'branch'=>$branch
		];
		echo view('template/header');
		echo view('template/body', $nav);
		echo view('movie/contactlist',$data);
		echo view('template/footer');
	}

	public function del($branch,$id)
	//die;
	{
		if (checkLogin() == false) {
			return redirect()->to('/login');
		}
		$result = $this->contactdatamodel->del_contact($branch, $id);
		if(is_bool($result)&&$result==true){
			return redirect()->to('/movie/contact/branch/'.$branch);
		}else{
			setAlert('error','delete fail please try again');
			return redirect()->to('/movie/contact/branch/'.$branch);
		}
		
	}

	
	//--------------------------------------------------------------------

}
