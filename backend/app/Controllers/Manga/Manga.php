<?php namespace App\Controllers\Manga;
use App\Models\Mangadata_Model;
use App\Models\Seo_Model;
use App\Models\Setting_Model;
use CodeIgniter\Controller;

class Manga extends Controller
{
	private $serviceUrl;
	protected $validation;
	protected $session;
	protected $mangadataModel;
	protected $seoModel;
	protected $settingModel;
	protected $base_url;
	protected $path_macover;

	public function __construct() {

		$config = new \Config\App();
		$this->serviceUrl = $config->serviceUrl;
		  
		$this->validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
		
		$this->mangadataModel = new Mangadata_Model();
		$this->seoModel = new Seo_Model();
		$this->settingModel = new Setting_Model();

		$this->base_url = base_url();
		$this->path_macover = 'manga/cover';

        helper(['filesystem','url','alert','checklogin','pagination']);

	}

	public function subject($branch,$search="")
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$page = 1;
		if( !empty( $_GET) ){
			$page = $_GET['page'];
		}

		$nav = [
                'module_name' => 'Subject',
                'module_level' => array(
										array('name'=>"Home", 'url'=>"/"),
										array('name'=>"Manga", 'url'=>"/management/branch/".$branch),
                                        array('name'=>'Subject', 'url'=>"/manga/branch/".$branch."/subject/index")
                                    )
            ];

		echo view('template/header');
		echo view('template/body', $nav);

		$data = [];
		$data['branch'] = $branch;
		$data['search_string'] = $search_string = urldecode($search);
		$data['path_macover'] = $this->path_macover;
		$data['category'] = $this->mangadataModel->get_category($branch);
		$manga = $this->mangadataModel->get_subjectlist($branch, $search_string, $page);
		$data['manga'] = $manga['list'];
		unset($manga['list']);
		$data['paginate'] = $manga;

		echo view('manga/mangalist', $data);
		echo view('template/footer');
	}

	public function add($branch,$id="")
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$nav = [
			'module_name' => 'Add Manga',
			'module_level' => array(
									array('name'=>"Home", 'url'=>"/"),
									array('name'=>"Manga", 'url'=>"/management/branch/".$branch),
									array('name'=>'Subject', 'url'=>"/manga/branch/".$branch."/subject/index"),	
									array('name'=>'Add', 'url'=>"/manga/branch/".$branch."/subject/add")	
								)
		];

		echo view('template/header');
		echo view('template/body', $nav);

		$data = [];
		$data = [
			'url_service' => $this->serviceUrl,
			'base_url' => $this->base_url,
			'branch' => $branch,
			'seo' => $this->seoModel->get_seo($branch),
			'setting' => $this->settingModel->get_setting($branch),
			'categoryq' => $this->mangadataModel->get_category($branch)
		];

		echo view('manga/mangaform', $data);
		echo view('template/footer');

	}

	public function saveadd($branch)
    {
		$params = $this->request->getVar();
		$files= $this->request->getFiles();

		$valid = [
			'masubject_name_eng' => 'required',
			'masubject_status' => 'required',
			'macategory_id' => 'required'
		];


		if(!empty($files['masubject_picture']->getName())){

			$files = $files['masubject_picture'];
			$valid['masubject_picture'] = 'uploaded[masubject_picture]|is_image[masubject_picture]';

		}else{

			$valid['masubject_url'] = 'required|valid_url';

		}

		$this->validation->setRules($valid);

		if ($this->validation->run($params) == FALSE)
        {

            setAlert('error', 'Add failed.');
            return redirect()->to('/manga/branch/'.$branch.'/subject/index');

		}
		else{

			$result = $this->mangadataModel->savesubject_add($params,$branch,$files);

            if ($result==true && is_bool($result)) {
    
                setAlert('success', 'Add Success.');
                return redirect()->to('/manga/branch/'.$branch.'/subject/index');
    
            }else{
    
                setAlert('error', $result);
                return redirect()->to('/manga/branch/'.$branch.'/subject/index');
    
            }
		}

	}

	public function del($branch,$id)
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$params = $this->request->getVar();
		$result = $this->mangadataModel->subject_del($id);

		if($result==true && is_bool($result)){

			setAlert('success', 'Delete Success.');
			return redirect()->to('/manga/branch/'.$branch.'/subject/index');
			
		}else{

			setAlert('error', $result);
			return redirect()->to('/manga/branch/'.$branch.'/subject/index');

		}
	}

	public function edit($branch,$id){
		if( checkLogin()==false ){
		 return redirect()->to('/login');
		}

		$nav = [
			'module_name' => 'Edit Category',
			'module_level' => array(
									array('name'=>"Home", 'url'=>"/"),
									array('name'=>"Manga", 'url'=>"/management/branch/".$branch),
									array('name'=>'Subject', 'url'=>"/manga/branch/".$branch."/subject/index"),		
									array('name'=>'Edit', 'url'=>"/manga/subject/edit/id/".$id)				
								)
		];

		echo view('template/header');
		echo view('template/body', $nav);

		$group = array();
		$text = $this->mangadataModel->get_categorygroup($branch,$id);
		if($text != ""){
			foreach($text as $value){
				$group[] = $value['macategory_id'];
			}
		}

		$data = [
			'branch' => $branch,
			'id' => $id,
			'base_url' => $this->base_url,
			'seo' => $this->seoModel->get_seo($branch),
			'setting' => $this->settingModel->get_setting($branch),
			'data' => $this->mangadataModel->get_editdata_subject($branch,$id),
			'group' => $group,
			'categoryq' => $this->mangadataModel->get_category($branch),
			'path_macover' => $this->path_macover
		];
		
		echo view('manga/subjectformedit', $data);
		echo view('template/footer');

	}

	public function editsave($branch,$id){
		$params = $this->request->getVar();
		$files= $this->request->getFiles();

		$valid = [
			'masubject_name_eng' => 'required',
			'masubject_status' => 'required',
			'macategory_id' => 'required'
		];

		if(!empty($files['masubject_picture']->getName())){

			$files = $files['masubject_picture'];
			$valid['masubject_picture'] = 'uploaded[masubject_picture]|is_image[masubject_picture]';

		}else if(!empty($params['masubject_url'])){

			$files = array();
			$valid['masubject_url'] = 'required|valid_url';

		}else{

			$files = array();
			
		}

		$oldpic = $params['masubject_oldpic'];
		$data = array(
			'masubject_id' => $id,
			'masubject_picture' => $params['masubject_url'],
			'masubject_name_eng' => $params['masubject_name_eng'],
			'masubject_author' => $params['masubject_author'],
			'masubject_status' => $params['masubject_status'],
			'masubject_description' => $params['masubject_description']
		);

		$categorydata = $params['macategory_id']; //ข้อมูลจากหน้าบ้าน
		$get_categorygroup = $this->mangadataModel->get_categorygroup_onid($id); //ข้อมูลจากดาต้าเบส

		$updatedata=[]; $insertdata=[]; $deldata=[];
		if(!empty($categorydata)){
			if( count($categorydata) >= count($get_categorygroup) ){
				foreach ($get_categorygroup as $key => $cat) {

					$updatedata[] = [
						'macategorygroup_id' => $cat['macategorygroup_id'],
						'macategory_id' => $categorydata[$key]
					];

					unset($categorydata[$key]);
				}

				foreach($categorydata as $datacat){
					$insertdata[] = [
						'masubject_id' => $id,
						'macategory_id' => $datacat,
						'branch_id' => $branch
					];
				}
			}else{
				foreach($categorydata as $key => $datacat){
					$updatedata[] = [
						'macategorygroup_id' => $get_categorygroup[$key]['macategorygroup_id'],
						'macategory_id' => $datacat
					];

					unset($get_categorygroup[$key]);
				}

				foreach($get_categorygroup as $key => $cat){
					$deldata[] = [
						'macategorygroup_id' => $cat['macategorygroup_id']
					];
				}
			}
		}


		$result = $this->mangadataModel->update_subject($data,$updatedata,$insertdata,$deldata,$files,$oldpic);

		if ($result==true && is_bool($result)) {

			setAlert('success', 'Edit Success.');
			return redirect()->to('/manga/branch/'.$branch.'/subject/index');

		}else{

			setAlert('error', $result);
			return redirect()->to('/manga/branch/'.$branch.'/subject/edit/id/'.$id);

		}
	}

	public function saveview($id)
	{
		$result = $this->mangadataModel->increseView($id);
		if ($result==true && is_bool($result)) {
			echo 'Save view done';
		}else{
			echo 'Error Save view';
		}
	}

	//--------------------------------------------------------------------

}
