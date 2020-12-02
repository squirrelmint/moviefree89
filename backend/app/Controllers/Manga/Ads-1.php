<?php namespace App\Controllers\Manga;
use App\Models\Adsdata_Model;
use App\Models\Ads_Model;
use CodeIgniter\Controller;

class Ads extends Controller
{	
	private $path_ads;
	public function __construct() {

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
		$this->adsdataModel = new Adsdata_Model();
		$this->adsModel = new Ads_Model();
		$this->path_ads = "/ads/";

        helper(['filesystem','url','alert','checklogin','pagination']);

    }

    public function index($branch_id, $search="")
	{

        if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$page = 1;
		if( !empty( $_GET) ){
			$page = $_GET['page'];
		}

		$nav = [
			'module_name' => 'โฆษณา',
			'module_level' => array(
									array('name'=>"หน้าแรก", 'url'=>"/"),
									array('name'=>"โฆษณา", 'url'=>"/mangaads/branch/".$branch_id."/index")								
								)
        ];
        
        echo view('template/header', ['branch'=>$branch_id]);
		echo view('template/body', $nav);

        $data = [];
        $data['search_string'] = $search_string = urldecode($search);
		$data['branch_id'] = $branch_id;
		$data['path_ads'] = $this->path_ads;
		$adslist = $this->adsdataModel->get_ads($branch_id, $search_string, $page);
		$data['adslist'] = $adslist['list']; unset($adslist['list']);
		$data['paginate'] = $adslist;

		echo view('manga/adslist', $data);
		echo view('template/footer');
	}
	
	public function add($branch_id)
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$nav = [
			'module_name' => 'เพิ่มโฆษณา',
			'module_level' => array(
									array('name'=>"หน้าแรก", 'url'=>"/"),
									array('name'=>"โฆษณา", 'url'=>"/mangaads/branch/".$branch_id."/index"),	
									array('name'=>"เพิ่ม", 'url'=>"/mangaads/branch/".$branch_id."/add"),									
								)
		];

		echo view('template/header');
		echo view('template/body', $nav);

		$data = [];
		$data['branch_id'] = $branch_id;

		echo view('manga/adsform', $data);
		echo view('template/footer');

	}

	public function edit($branch_id, $id)
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$nav = [
			'module_name' => 'แก้ไขโฆษณา',
			'module_level' => array(
									array('name'=>"หน้าแรก", 'url'=>"/"),
									array('name'=>"โฆษณา", 'url'=>"/mangaads/branch/".$branch_id."/index"),	
									array('name'=>"แก้ไข", 'url'=>"/mangaads/branch/".$branch_id."/edit/id/".$id),									
								)
		];

		echo view('template/header');
		echo view('template/body', $nav);

		$data = [
			'branch_id' => $branch_id,
			'ads_id' => $id,
			'ads' => $this->adsdataModel->get_ads_onid($id)
		];
		

		echo view('manga/adsedit', $data);
		echo view('template/footer');

	}

	public function saveadd($branch_id)
	{
		$params = $this->request->getVar();
		$files = $this->request->getFiles()['ads_picture'];

		$data = [
			'branch_id' => $branch_id,
			'ads_name' => $params['ads_name'],
			'ads_url' => $params['ads_url'],
			'ads_position' => $params['ads_position']
		];

		$this->validation->setRules([
			'ads_name' => 'required',
			'ads_url' => 'valid_url',
            'ads_position' => 'required'
		]);
		
		if ($this->validation->run($data) == FALSE)
        {

            setAlert('error', 'Add failed.');
            return redirect()->to('/mangaads/branch/'.$branch_id.'/index');

		}
		else{

			$result = $this->adsModel->insert_data($data, $files);

            if ($result==true && is_bool($result)) {
    
                setAlert('success', 'Add Success.');
                return redirect()->to('/mangaads/branch/'.$branch_id.'/index');
    
            }else{
    
                setAlert('error', $result);
                return redirect()->to('/mangaads/branch/'.$branch_id.'/index');
    
            }
		}
		die;
	}

	public function saveedit($branch_id,$id)
	{
		$params = $this->request->getVar();
		$files = $this->request->getFiles()['ads_picture'];
		$ads = $this->adsdataModel->get_ads_onid($id);
		$oldpic = $ads['ads_picture'];

		$data = [
			'ads_name' => $params['ads_name'],
			'ads_url' => $params['ads_url'],
			'ads_position' => $params['ads_position']
		];

		$this->validation->setRules([
			'ads_name' => 'required',
			'ads_url' => 'valid_url',
            'ads_position' => 'required'
		]);
		
		if ($this->validation->run($data) == FALSE)
        {

            setAlert('error', 'Add failed.');
            return redirect()->to('/mangaads/branch/'.$branch_id.'/index');

		}
		else{

			$result = $this->adsModel->update_data($id, $data, $oldpic, $files);

            if ($result==true && is_bool($result)) {
    
                setAlert('success', 'Edit Success.');
                return redirect()->to('/mangaads/branch/'.$branch_id.'/index');
    
            }else{
    
                setAlert('error', $result);
                return redirect()->to('/mangaads/branch/'.$branch_id.'/index');
    
            }
		}
		die;
	}
	
	public function savedel($branch_id,$id)
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$ads = $this->adsdataModel->get_ads_onid($id);
		$files = $ads['ads_picture'];

		$result = $this->adsModel->delete_data($files,$id);

		if ($result==true && is_bool($result)) {

			setAlert('success', 'Delete Success.');
			return redirect()->to('/mangaads/branch/'.$branch_id.'/index');

		}else{

			setAlert('error', $result);
			return redirect()->to('/mangaads/branch/'.$branch_id.'/index');

		}

	}

}
?>