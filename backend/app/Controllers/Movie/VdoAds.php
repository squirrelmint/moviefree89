<?php namespace App\Controllers\Movie;
use App\Models\Vdoads_Model;
use App\Models\Vdoadsdata_Model;
use CodeIgniter\Controller;

class VdoAds extends Controller
{
	private $path_vdoads;
	protected $vdoadsModel;
	protected $vdoadsdataModel;

	public function __construct() {

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->vdoadsModel = new Vdoads_Model();
        $this->vdoadsdataModel = new Vdoadsdata_Model();
		$this->path_vdoads = 'movie/adsvdo';

        helper(['filesystem','url','alert','checklogin','pagination']);

    }
    
    public function index($branch,$search="")
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$page = 1;
		if( !empty( $_GET) ){
			$page = $_GET['page'];
		}

		$nav = [
                'module_name' => 'โฆษณาวิดีโอ',
                'module_level' => array(
										array('name'=>"Home", 'url'=>"/"),
										array('name'=>"branch", 'url'=>"/management/branch/".$branch),
                                        array('name'=>'Vdo Ads', 'url'=>"/vdoads/branch/".$branch."/index")
                                    )
            ];

		echo view('template/header');
		echo view('template/body', $nav);

		$data = [];
		$data['branch'] = $branch;
		$data['search_string'] = $search_string = urldecode($search);
		$data['adsvdo'] = $this->vdoadsdataModel->get_adsvideolist($branch, $search_string, $page );
		$data['filepath'] = $this->path_vdoads.'/';

		echo view('movie/vdoadslist', $data);
		echo view('template/footer');
    }
    
    public function add($branch)
	{

		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$nav = [
			'module_name' => 'Add Ads Video',
			'module_level' => array(
									array('name'=>"Home", 'url'=>"/dashboard"),
									array('name'=>"Branch", 'url'=>"/management/branch/".$branch),
									array('name'=>"Vdo Ads", 'url'=>"/vdoads/branch/".$branch."/index"),
                                    array('name'=>'Add Vdo Ads', 'url'=>"#")
								)
		];

		echo view('template/header');
		echo view('template/body', $nav);

		$data = [];
		$data = [
			'branch' => $branch
		];

		echo view('movie/vdoadsform', $data);
		echo view('template/footer');

    }

    public function edit($branch, $id)
	{

		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$nav = [
			'module_name' => 'Edit Ads Video',
			'module_level' => array(
									array('name'=>"Home", 'url'=>"/dashboard"),
									array('name'=>"Branch", 'url'=>"/management/branch/".$branch),
									array('name'=>"Vdo Ads", 'url'=>"/vdoads/branch/".$branch."/index"),
									array('name'=>'Edit Vdo Ads', 'url'=>"#")
								)
		];

		echo view('template/header');
		echo view('template/body', $nav);

        $data = [];
        
        $adsvdo = $this->vdoadsdataModel->get_adsvideo_on_id($branch, $id);
		$data = [
            'branch' => $branch,
            'id' => $id,
            'adsvdo' => $adsvdo
		];

		echo view('movie/vdoadsedit', $data);
		echo view('template/footer');

    }
    
    public function saveadd($branch)
    {
		$params = $this->request->getVar();
		$files = $this->request->getFiles()['adsvideo_video'];

		$valid = [
			'adsvideo_name' => 'required',
            'adsvideo_url' => 'required',
			'adsvideo_status' => 'required',
			'adsvideo_skip' => 'required'
		];

		$this->validation->setRules($valid);

		if ($this->validation->run($params) == FALSE)
        {
            setAlert('error', 'Add failed.');
            return redirect()->to('/vdoads/branch/'.$branch.'/index');

		}
		else{

			$result = $this->vdoadsModel->insert_vdoads($params,$branch,$files);

            if ($result==true && is_bool($result)) {
    
                setAlert('success', 'Add Success.');
                return redirect()->to('/vdoads/branch/'.$branch.'/index');
    
            }else{
    
                setAlert('error', $result);
                return redirect()->to('/vdoads/branch/'.$branch.'/index');
    
            }
		}

    }
    
    public function saveedit($branch, $id)
    {
		$params = $this->request->getVar();
		$files= $this->request->getFiles()['adsvideo_video'];

		$valid = [
			'adsvideo_name' => 'required',
            'adsvideo_url' => 'required',
			'adsvideo_status' => 'required',
			'adsvideo_skip' => 'required'
		];
		// echo "<pre>";
		// print_r($params); 
		// die;

		$this->validation->setRules($valid);

		if ($this->validation->run($params) == FALSE)
        {

            setAlert('error', 'Add failed.');
            return redirect()->to('/vdoads/branch/'.$branch.'/index');

		}
		else{

			$result = $this->vdoadsModel->update_vdoads($params,$branch,$id,$files);

            if ($result==true && is_bool($result)) {
    
                setAlert('success', 'Add Success.');
                return redirect()->to('/vdoads/branch/'.$branch.'/index');
    
            }else{
    
                setAlert('error', $result);
                return redirect()->to('/vdoads/branch/'.$branch.'/index');
    
            }
		}

    }
    
    public function savedel($branch,$id)
    {
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$params = $this->request->getVar();

		$adsvideo = $this->vdoadsdataModel->get_adsvideo_on_id($branch,$id);
		$files = $adsvideo['adsvideo_video'];

		$result = $this->vdoadsModel->delete_vdoads($id,$files);

		if($result==true && is_bool($result)){

			setAlert('success', 'Delete Success.');
			return redirect()->to('/vdoads/branch/'.$branch.'/index');
			
		}else{

			setAlert('error', $result);
			return redirect()->to('/vdoads/branch/'.$branch.'/index');

		}

	}

}

?>