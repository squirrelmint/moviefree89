<?php namespace App\Controllers\Manga;
use App\Models\Mangadata_Model;
use CodeIgniter\Controller;

class MangaCate extends Controller
{
	public function __construct() {

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->mangadataModel = new Mangadata_Model();

        helper(['url','alert','checklogin','pagination']);

    }

	public function category($branch,$search="")
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$page = 1;
		if( !empty( $_GET) ){
			$page = $_GET['page'];
		}

		$nav = [
                'module_name' => 'Category',
                'module_level' => array(
										array('name'=>"Home", 'url'=>"/"),
										array('name'=>"Manga", 'url'=>"/management/branch/".$branch),
                                        array('name'=>'Category', 'url'=>"/manga/branch/".$branch."/category/index")
                                    )
            ];

		echo view('template/header');
		echo view('template/body', $nav);

		$data = [];
		$data['branch'] = $branch;
		$data['search_string'] = $search_string = urldecode($search);
		$cate = $this->mangadataModel->get_categorylist($branch, $search_string, $page);
		$data['cate'] = $cate['list'];
		unset($cate['list']);
		$data['paginate'] = $cate;

		echo view('manga/categorylist', $data);
		echo view('template/footer');
	}

	public function add($branch,$id="")
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$nav = [
			'module_name'=>'Add Category',
			'module_level' => array(
									array('name'=>"Home", 'url'=>"/"),
									array('name'=>"Manga", 'url'=>"/management/branch/".$branch),
									array('name'=>'Category', 'url'=>"/manga/branch/".$branch."/category/index"),	
									array('name'=>'Add', 'url'=>"/manga/category/add")					
								)
		];

		echo view('template/header');
		echo view('template/body', $nav);

		$data = [];
		$data['branch'] = $branch;

		echo view('manga/categoryform', $data);
		echo view('template/footer');

	}

	public function edit($branch,$id)
	{

		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$nav = [
			'module_name'=>'Edit Category',
			'module_level' => array(
									array('name'=>"Home", 'url'=>"/"),
									array('name'=>"Manga", 'url'=>"/management/branch/".$branch),
									array('name'=>'Category', 'url'=>"/manga/branch/".$branch."/category/index"),
									array('name'=>'Edit', 'url'=>"/manga/branch/".$branch."category/edit/id/".$id)		
								)
		];

		echo view('template/header');
		echo view('template/body', $nav);

		$data = [
				  'branch' => $branch,
				  'id' => $id,
				  'data' => $this->mangadataModel->get_editdata_category($branch,$id)
		];
		echo view('manga/categoryformedit', $data);
		echo view('template/footer');

	}

	public function saveadd($branch)
    {
        $params = $this->request->getVar();
        $result = $this->mangadataModel->savecategory_add($params,$branch);

        if ($result==true && is_bool($result)) {

            setAlert('success', 'Add Success.');
			return redirect()->to('/manga/branch/'.$branch.'/category/index');
			
        }else{

            setAlert('error', $result);
			return redirect()->to('/manga/branch/'.$branch.'/category/index');
			
        }
	}

	   //อัพการแก้ไข
	public function editsave($branch,$id){

		$params = $this->request->getVar();
		$result = $this->mangadataModel->update_category($params,$id);

		if ($result==true && is_bool($result)) {

			setAlert('success', 'Edit Success.');
			return redirect()->to('/manga/branch/'.$branch.'/category/index');

		}else{

			setAlert('error', $result);
			return redirect()->to('/manga/branch/'.$branch.'/category/index');

		}

	}

	//ลบ
	public function del($branch,$id)
	{

		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$result = $this->mangadataModel->category_del($branch,$id);

		if ($result==true && is_bool($result)) {

			setAlert('success', 'Success.');
			return redirect()->to('/manga/branch/'.$branch.'/category/index');

		}else{

			setAlert('error', $result);
			return redirect()->to('/manga/branch/'.$branch.'/category/index');

		}

	}


	//--------------------------------------------------------------------

}
