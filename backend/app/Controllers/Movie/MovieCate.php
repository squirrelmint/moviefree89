<?php

namespace App\Controllers\Movie;

use App\Models\Moviedata_Model;
use CodeIgniter\Controller;

class MovieCate extends Controller
{
	protected $request;

	public function __construct()
	{

		$this->validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
		$this->moviedatamodel = new Moviedata_Model();

		helper(['filesystem', 'alert', 'loader', 'checklogin', 'url', 'pagination']);
	}

	public function index()
	{

		if (checkLogin() == false) {
			return redirect()->to('/login');
		}

		$nav = [
			'module_name' => 'Movie',
			'module_level' => array(
				array('name' => "Home", 'url' => "/"),
				array('name' => "Movie", 'url' => "#")
			)
		];


		echo view('template/header');
		echo view('template/body', $nav);

		echo view('movie/index');
		echo view('template/footer');
	}

	public function category($branch, $search = "")
	//die;
	{
		$page = 1;
		if (!empty($_GET)) {
			$page = $_GET['page'];
		}
		if (checkLogin() == false) {
			return redirect()->to('/login');
		}
		$search = urldecode($search);
		$nav = [
			'module_name' => 'Category',
			'module_level' => array(
				array('name' => "Home", 'url' => "/"),
				array('name' => "Branch", 'url' => "/management/branch/" . $branch),
				array('name' => 'Category', 'url' => "/movie/category/index")
			)
		];
		$branchdata = $this->moviedatamodel->get_category_page($branch, $search, $page);
		$data = [
			'cate' => $branchdata['list'],
			'paginate' => $branchdata,
			'search_string' => $search
		];
		$data['branch'] = $branch;

		echo view('template/header');
		echo view('template/body', $nav);

		// $data = [];
		// $data['cate'] = $this->moviedatamodel->get_category();


		echo view('movie/categorylist', $data);
		echo view('template/footer');
	}

	public function add($branch, $id = "")
	{
		if (checkLogin() == false) {
			return redirect()->to('/login');
		}

		$nav = [
			'module_level' => array(
				array('name' => "Home", 'url' => "/"),
				array('name' => "Branch", 'url' => "/management/branch/" . $branch),
				array('name' => 'Category', 'url' => "/movie/branch/1/category/index"),
			)
		];

		$nav['module_name'] = 'Add Category';
		$bc = array('name' => 'Add', 'url' => "/movie/category/add");
		if (!empty($id)) {
			$nav['module_name'] = 'Edit Category';
			$bc = array('name' => 'Edit', 'url' => "/movie/category/edit/id/" . $id);
		}
		$nav['module_level'][] = $bc;

		echo view('template/header');
		echo view('template/body', $nav);

		$data = [];
		$data['branch'] = $branch;

		echo view('movie/categoryform', $data);
		echo view('template/footer');
	}

	public function saveadd($branch)
	{
		$params = $this->request->getVar();
		$this->validation->setRules([
			'category_name' => 'required'
		]);

		foreach ($params['macategory_name'] as $value) {
			$data_Field['category_name'] = $value;
			$validate_field = $this->validation->run($data_Field);
			if ($validate_field == FALSE) {
				setAlert('error', $validate_field);
				return redirect()->to('/movie/branch/' . $branch . '/category/index');
			}
		}

		$result = $this->moviedatamodel->savecategory_add($params, $branch);

		if ($result == true && is_bool($result)) {
			setAlert('success', 'Add Success.');
			return redirect()->to('/movie/branch/' . $branch . '/category/index');
		} else {
			setAlert('error', $result);
			return redirect()->to('/movie/branch/' . $branch . '/category/index');
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
				array('name' => 'Category', 'url' => "/movie/branch/" . $branch . "/category/index"),
				array('name' => 'Edit', 'url' => "/")
			)
		];
		$nav['module_name'] = 'Edit Category';

		$data = [
			'id' => $id,
			'data' => $this->moviedatamodel->get_editdata_category($id),
			'branch' => $branch
		];

		echo view('template/header');
		echo view('template/body', $nav);
		echo view('movie/categoryedit', $data);
		echo view('template/footer');
	}
	public function category_update($branch,$id)
	{

		$params = $this->request->getVar();
		$this->validation->setRules([
			'macategory_name' => 'required'
		]);

		$data_Field['macategory_name'] = $params['macategory_name'];
		$validate_field = $this->validation->run($data_Field);
		if ($validate_field == FALSE && is_bool($validate_field)) {
			setAlert('error', $validate_field);
			return redirect()->to('/movie/branch/'.$branch.'/category/edit/id/' . $id);
		}

		$result = $this->moviedatamodel->update_category($params, $id);

		if ($result == true && is_bool($result)) {
			setAlert('success', 'Restore Success.');
			return redirect()->to('/movie/branch/'.$branch.'/category/index');
		} else {
			setAlert('error', $result);
			return redirect()->to('/movie/branch/'.$branch.'/category/edit/id/' . $id);
		}
	}



	public function del($branch, $id)
	{

		if (checkLogin() == false) {
			return redirect()->to('/login');
		}


		$result = $this->moviedatamodel->del_category($id);

		if ($result == true && is_bool($result)) {

			setAlert('success', 'Restore Success.');
			return redirect()->to('/movie/branch/' . $branch . '/category/index');
		} else {

			setAlert('error', $result);
			return redirect()->to('/movie/branch/' . $branch . '/category/index');
		}
	}

	//--------------------------------------------------------------------

}
