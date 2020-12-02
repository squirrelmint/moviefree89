<?php

namespace App\Controllers\Movie;

use App\Models\Requestads_Model;
use CodeIgniter\Controller;

class MovieRequestAds extends Controller
{
	public function __construct()
	{
		$this->validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
		$this->requestadsdatamodel = new Requestads_Model();

		helper(['filesystem', 'alert', 'loader', 'checklogin', 'url', 'pagination']);
	}

	public function index($branch, $search = "")
	{

		if (checkLogin() == false) {
			return redirect()->to('/login');
		}

		$nav = [
			'module_name' => 'คำขอลงโฆษณา',
			'module_level' => array(
				array('name' => "Home", 'url' => "/"),
				array('name' => "Branch", 'url' => "/management/branch/" . $branch),
				array('name' => 'Request Ads', 'url' => "")
			)
		];
		$requestads = $this->requestadsdatamodel->get_requestads($branch, $search);
		$data = [
			'requestads' => $requestads,
			'search_string'=>$search,
			'branch'=>$branch
		];
		echo view('template/header');
		echo view('template/body', $nav);
		echo view('movie/requestadslist',$data);
		echo view('template/footer');
	}

	public function del($branch,$id)
	//die;
	{
		if (checkLogin() == false) {
			return redirect()->to('/login');
		}
		$result = $this->requestadsdatamodel->del_requestads($branch, $id);
		if(is_bool($result)&&$result==true){
			return redirect()->to('/movie/requestads/branch/'.$branch);
		}else{
			setAlert('error','delete fail please try again');
			return redirect()->to('/movie/requestads/branch/'.$branch);
		}
		
	}

	
	//--------------------------------------------------------------------

}
