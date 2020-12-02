<?php

namespace App\Controllers\Movie;

use App\Models\MovieLiveStream_Model;
use App\Models\Moviedata_Model;
use App\Models\Seo_Model;
use App\Models\Setting_Model;
use CodeIgniter\Controller;

class LiveStream extends Controller
{
	//private $img_movies = "img_movies";
	private $path_fillmovies;
	protected $serviceUrl;
	public function __construct()
	{

		$this->validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
		$this->movielivestreammodel = new MovieLiveStream_Model();
		$this->moviedatamodel = new Moviedata_Model();
		$this->seoModel = new Seo_Model();
		$this->settingModel = new Setting_Model();
		$this->base_url = base_url();
		$this->path_fillmovies = "movie/adsvdo";
		$this->path_filllivestream = "movie/livestream/";
		$config = new \Config\App();
		$this->serviceUrl = $config->serviceUrl;
		helper(['filesystem', 'alert', 'loader', 'checklogin', 'url', 'pagination']);
	}
	public function livestream($branch, $search = "")
	{
		// print_r($branch);
		// die;
		$page = 1;
		if (!empty($_GET)) {
			$page = $_GET['page'];
		}
		if (checkLogin() == false) {
			return redirect()->to('/login');
		}
		$search = urldecode($search);
		$nav = [
			'module_name' => 'Live Stream',
			'module_level' => array(
				array('name' => "Home", 'url' => "/"),
				array('name' => "Branch", 'url' => "/management/branch/" . $branch),
				array('name' => 'Live Stream', 'url' => "/video/branch/" . $branch . "/livestream/index")
			)
		];

		$branchdata = $this->movielivestreammodel->get_livestream($branch, $search, $page);
		$data = [];
		$data = [
			'search_string' => $search,
			'cate' => $branchdata['list'],
			'paginate' => $branchdata,
			'url_service' => $this->serviceUrl,
			'filepath' => $this->path_filllivestream
		];


		$data['branch'] = $branch;

		echo view('template/header');
		echo view('template/body', $nav);
		echo view('movie/livestreamlist', $data);
		echo view('template/footer');
	}
	public function addlivestream($branch, $id = "")
	{
		if (checkLogin() == false) {
			return redirect()->to('/login');
		}
		$category_id = $this->moviedatamodel->get_category();

		$nav = [
			'module_level' => array(
				array('name' => "Home", 'url' => "/"),
				array('name' => "Branch", 'url' => "/management/branch/" . $branch),
				array('name' => "Live Stream", 'url' => "/video/branch/" . $branch . "/livestream/index"),
				array('name' => "Add Live Stream", 'url' => "#")
			)
		];

		$nav['module_name'] = 'Add Live Stream';

		echo view('template/header');
		echo view('template/body', $nav);

		$data = [];
		$data = [
			'branch' => $branch,
			'category' => $category_id,
			'seo' => $this->seoModel->get_seo($branch),
			'base_url' => $this->base_url,
			'url_service' => $this->serviceUrl,
			'setting' => $this->settingModel->get_setting($branch)
		];

		echo view('movie/livestreamform', $data);
		echo view('template/footer');
	}
	public function livestreamsaveadd($branch)
	{

		$params = $this->request->getVar();
		$files = $this->request->getFiles();

		$this->validation->setRules([
			'livestream_name' => 'required',
			'livestream_url' => 'required',
			'livestream_img' => 'required'
		]);
		$data_Field['livestream_name'] = $this->request->getVar()['livestreamname_th'];	
		$data_Field['livestream_url'] = $this->request->getVar()['livestreamname_url'];
		$data_Field['livestream_img'] = $files['img_video']->getfilename();
		$validate_field = $this->validation->run($data_Field);
        if ($validate_field == FALSE)
        {
            setAlert('error','Add fail please validate field');
            return redirect()->to('/video/branch/' . $branch . '/livestream/add');
        }
		//$imgs = $files['videoname_url']; for up load file
		//$result = $this->moviedatamodel->savevideo_add($params,$branch,$files); for up load file

		$result = $this->movielivestreammodel->savelivestream_add($params, $branch, $files);

		if ($result == true && is_bool($result)) {
			setAlert('success', 'Add Success.');
			return redirect()->to('/video/branch/' . $branch . '/livestream/index');
		} else {
			setAlert('error', $result);
			return redirect()->to('/video/branch/' . $branch . '/livestream/add');
		}
	}
	public function del_livestream($branch, $id)
	{
		if (checkLogin() == false) {
			return redirect()->to('/login');
		}
		$result = $this->movielivestreammodel->livestream_del($branch, $id);

		if ($result == true && is_bool($result)) {
			setAlert('success', 'Restore Success.');
			return redirect()->to('/video/branch/' . $branch . '/livestream/index');
		} else {
			setAlert('error', $result);
			return redirect()->to('/video/branch/' . $branch . '/livestream/index');
		}
	}

	public function edit($branch, $id)
	{
		if (checkLogin() == false) {
			return redirect()->to('/login');
		}
		$nav = [
			'module_level' => array(
				array('name' => "Home", 'url' => "/"),
				array('name' => "Branch", 'url' => "/management/branch/" . $branch),
				array('name' => "Live Stream", 'url' => "/video/branch/" . $branch . "/livestream/index"),
				array('name' => 'Edit livestream', 'url' => "#")
			)
		];

		$nav['module_name'] = 'Edit livestream';
	
		echo view('template/header');
		echo view('template/body', $nav);

		$data = [
			'id' => $id,
			'data' => $this->movielivestreammodel->get_editdata_livestream($id),
			'filepath' => $this->path_filllivestream,
			'branch' => $branch
		];
		echo view('movie/liveStreamedit', $data);
		echo view('template/footer');
	}
	public function livestream_update($branch, $id)
	{
		$file = $this->request->getFiles();
		$params = $this->request->getVar();
		// echo "<pre>";
		// echo $params['status'];
		// print_r($params); 
		// die;
		$this->validation->setRules([
			'livestream_name' => 'required',
			'livestream_url' => 'required',
			'livestream_img' => 'required'
		]);
		$data_Field['livestream_name'] = $this->request->getVar()['livestreamname_th'];	
		$data_Field['livestream_url'] = $this->request->getVar()['livestreamname_url'];
		if(empty($file['img_video']->getfilename())){
            $data_Field['livestream_img'] = $params['livestream_old_img'];
        }else{
            $data_Field['livestream_img'] = $file['img_video']->getRandomName();
        }
		$validate_field = $this->validation->run($data_Field);
        if ($validate_field == FALSE)
        {
            setAlert('error','Edit fail please validate field');
            return redirect()->to('/video/branch/'.$branch.'/livestream/edit/id/'.$id);
        }

		if (!array_key_exists('status', $params)) {
			$params['status'] = 0;
		}

		$result = $this->movielivestreammodel->update_livestream($branch, $id, $params, $file);

		if ($result == true && is_bool($result)) {

			setAlert('success', 'Restore Success.');
			return redirect()->to('/video/branch/1/livestream/index');
		} else {

			setAlert('error', $result);
			return redirect()->to('/video/branch/1/livestream/edit/id/' . $id);
		}
	}
	//--------------------------------------------------------------------

}
