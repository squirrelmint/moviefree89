<?php namespace App\Controllers\Manga;
use App\Models\Mangadata_Model;
use App\Models\Manga_Model;
use App\Models\MangaReport_Model;
use CodeIgniter\Controller;

class MangaEpisode extends Controller
{
	private $serviceUrl;
	protected $validation;
	protected $session;
	protected $mangadataModel;
	protected $mangaModel;
	protected $reportModel;
	protected $path_file;


	public function __construct() 
	{

		$config = new \Config\App();
		$this->serviceUrl = $config->serviceUrl;

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
		$this->mangadataModel = new Mangadata_Model();
		$this->reportModel = new MangaReport_Model();
		$this->mangaModel = new Manga_Model();

		$this->path_file = "manga/imgmanga";

        helper(['filesystem','url','alert','checklogin','pagination']);

    }

	public function index($manga_id, $search="")
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$page = 1;

		if( !empty( $_GET) ){
			$page = $_GET['page'];
		}

		$data = [];
		$data['manga'] = $mangadata = $this->mangadataModel->get_manga_on_id($manga_id);

		$nav = [
                'module_name' => ucwords(strtolower($mangadata['masubject_name_eng'])),
                'module_level' => array(
										array('name'=>"Home", 'url'=>"/"),
										array('name'=>"Manga", 'url'=>"/management/branch/".$mangadata['branch_id']),
										array('name'=>"Subject", 'url'=>"/manga/branch/".$mangadata['branch_id']."/subject/index"),
                                        array('name'=>ucwords(strtolower($mangadata['masubject_name_eng'])), 'url'=>"/manga/".$mangadata['masubject_id']."/episode/index")
                                    )
            ];

		echo view('template/header');
		echo view('template/body', $nav);

		$data['manga_id'] = $manga_id;
		$data['search_string'] = $search_string = urldecode($search);
		$mangaep = $this->mangadataModel->get_episode_on_mangaid($manga_id, $search_string, $page);
		$data['mangaep'] = $mangaep['list'];
		unset($mangaep['list']);
		$data['paginate'] = $mangaep;

		echo view('manga/episodelist', $data);
		echo view('template/footer');
	}

	public function add($manga_id)
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$data = [];
		$data['manga'] = $mangadata = $this->mangadataModel->get_manga_on_id($manga_id);

		$nav = [
			'module_name' => 'Add Episode',
			'module_level' => array(
									array('name'=>"Home", 'url'=>"/"),
									array('name'=>"Manga", 'url'=>"/management/branch/".$mangadata['branch_id']),
									array('name'=>"Subject", 'url'=>"/manga/branch/".$mangadata['branch_id']."/subject/index"),
									array('name'=>ucwords(strtolower($mangadata['masubject_name_eng'])), 'url'=>"/manga/".$mangadata['masubject_id']."/episode/index"),
									array('name'=>'Add', 'url'=>"/manga/".$manga_id."/episode/add")						
								)
		];

		echo view('template/header');
		echo view('template/body', $nav);

		$data['url_service'] = $this->serviceUrl;
		$data['masubject_name_eng'] = $mangadata['masubject_name_eng'];
		$data['manga_id'] = $manga_id;

		echo view('manga/episodeform', $data);
		echo view('template/footer');

	}

	public function edit($manga_id, $ep_id)
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$data = [];
		$data['manga'] = $mangadata = $this->mangadataModel->get_manga_on_id($manga_id);

		$nav = [
			'module_name' => 'Edit Episode',
			'module_level' => array(
									array('name'=>"Home", 'url'=>"/"),
									array('name'=>"Manga", 'url'=>"/management/branch/".$mangadata['branch_id']),
									array('name'=>"Subject", 'url'=>"/manga/branch/".$mangadata['branch_id']."/subject/index"),
									array('name'=>ucwords(strtolower($mangadata['masubject_name_eng'])), 'url'=>"/manga/".$mangadata['masubject_id']."/episode/index"),
									array('name'=>'Edit', 'url'=>"/manga/".$manga_id."/episode/edit/id/".$ep_id)						
								)
		];

		echo view('template/header');
		echo view('template/body', $nav);

		$data['manga_id'] = $manga_id;
		$data['path_manga'] = $this->path_file;
		$data['epdata'] = array();
		$data['epdata'] = $this->mangadataModel->get_episode_on_id($ep_id);
		$data['imgdata'] = $this->mangadataModel->get_episodeimg_on_epid($ep_id);

		echo view('manga/episodeedit', $data);
		echo view('template/footer');

	}

	public function saveadd($id)
	{
		$params = $this->request->getVar();
		$files = $this->request->getFiles();

		$data = [
			'masubject_id' => $id,
			'masubject_name_eng' => $params['masubject_name_eng'], 
			'maepisode_name_eng' => $params['maepisode_name_eng'],
			'maepisode_public_datetime' => '',
			'maepisode_status' => $params['maepisode_status']
		];

		if($params['maepisode_status']==true){
			$data['maepisode_public_datetime'] = date("Y-m-d H:i:s");
		}

		$dataimages = array(); $dataimg_upload = array();
		if( !empty($files['maepisodeimage_picture']) ){ $dataimg_upload = $files['maepisodeimage_picture']; }
		$dataimg_url = $params['maepisodeimage_path'];

		$curl = array();
		if( $params['curl'] != "" ){ $curl = explode('|', $params['curl']);}
		$cfile = array();
		if( $params['cfile'] != "" ){$cfile = explode('|', $params['cfile']);}


		// echo "url: "; print_r($curl);echo "file: ";print_r($cfile); echo$params['count'];die;

		if( !empty($params['count']) ){

			for ($i=0; $i < $params['count']; $i++) { 

				if( in_array($i,$curl) ){

					if(!filter_var($dataimg_url[$i], FILTER_VALIDATE_URL)){

						setAlert('error', 'Invalid URL.');
						return redirect()->to('/manga/'.$id.'/episode/add');

					}else{

						$dataimages[] =  $dataimg_url[$i];
					
					}

				}else if( in_array($i,$cfile) ){

					if( $dataimg_upload[$i]->isValid() ){

						$dataimages[] =  $dataimg_upload[$i];

					}else{

						setAlert('error', 'Invalid File.');
						return redirect()->to('/manga/'.$id.'/episode/add');

					}
				}

			}

		}

		$this->validation->setRules([
            'maepisode_name_eng' => 'required',
			'maepisode_status' => 'required'
		]);
		
		if ($this->validation->run($data) == FALSE)
        {

            setAlert('error', 'Add failed.');
            return redirect()->to('/manga/'.$id.'/episode/index');

		}
		else{

			$result = $this->mangaModel->insert_data($data, $dataimages);

            if ($result==true && is_bool($result)) {
    
                setAlert('success', 'Add Success.');
                return redirect()->to('/manga/'.$id.'/episode/index');
    
            }else{
    
                setAlert('error', $result);
                return redirect()->to('/manga/'.$id.'/episode/index');
    
            }
		}
		die;
	}

	public function saveedit($manga_id, $ep_id, $rpid="")
	{
		$params = $this->request->getVar();
		$files = $this->request->getFiles();

		$data = [
			'maepisode_id'=>$ep_id,
			'masubject_name_eng' => $params['masubject_name_eng'], 
			'maepisode_name_eng' => $params['maepisode_name_eng'],
			'maepisode_status' => $params['maepisode_status']
		];

		if($params['maepisode_status']==true && $params['masubject_datetime'] == ""){
			$data['maepisode_public_datetime'] = date("Y-m-d h:i:s");
		}

		$imgdata = $this->mangadataModel->get_episodeimg_on_epid($ep_id);

		$dataimages = array(); $datakey = array(); $dataimg_upload = array();
		if( !empty($files['maepisodeimage_picture']) ){ 
			$dataimg_upload = $files['maepisodeimage_picture']; 
		}
		$dataimg_url = $params['maepisodeimage_path'];

		$curl = array();
		if( $params['curl'] != "" ){ $curl = explode('|', $params['curl']);}
		$cfile = array();
		if( $params['cfile'] != "" ){$cfile = explode('|', $params['cfile']);}

		// echo "url: "; print_r($curl);echo "file: ";print_r($cfile); echo$params['count'];die;


		if( !empty($params['count']) ){

			for ($i=0; $i < $params['count']; $i++) { 

				if( in_array($i,$curl) ){

					if(!filter_var($dataimg_url[$i], FILTER_VALIDATE_URL)){

						setAlert('error', 'Invalid URL.');
						return redirect()->to('/manga/'.$manga_id.'/episode/edit/id/'.$ep_id);

					}else{
						
						$dataimages[$i] =  $dataimg_url[$i];
					
					}

				}else if( in_array($i,$cfile) ){

					if( $dataimg_upload[$i]->isValid() ){

						$dataimages[$i] =  $dataimg_upload[$i];

					}else{

						setAlert('error', 'Invalid File.');
						return redirect()->to('/manga/'.$manga_id.'/episode/edit/id/'.$ep_id);

					}
				}

			}

		}

		$this->validation->setRules([
            'maepisode_name_eng' => 'required',
            'maepisode_status' => 'required'
		]);

		$branch_id = $_SESSION['brid'];
		
		if ($this->validation->run($data) == FALSE)
        {
			if(!empty($rpid)){
				setAlert('error', 'Edit failed.');
				return redirect()->to('manga/branch/'.$branch_id.'/report/index');
			}else{
				setAlert('error', 'Edit failed.');
				return redirect()->to('/manga/'.$manga_id.'/episode/edit/id/'.$ep_id);
			}

		}
		else{

			$result = $this->mangaModel->update_data($data, $dataimages, $imgdata, $params['count']);

            if ($result==true && is_bool($result)) {

				if(!empty($rpid)){
					$this->reportModel->report_del($rpid);
					setAlert('success', 'Edit Success.');
					return redirect()->to('manga/branch/'.$branch_id.'/report/index');
				}else{
					setAlert('success', 'Edit Success.');
                	return redirect()->to('/manga/'.$manga_id.'/episode/index');
				}
    
            }else{
				
				if(!empty($rpid)){
					setAlert('error', $result);
                	return redirect()->to('manga/branch/'.$branch_id.'/report/index');
				}else{
					setAlert('error', $result);
                	return redirect()->to('/manga/'.$manga_id.'/episode/index');
				}
    
            }
		}
		die;
	}
	
	public function savedel($manga_id,$ep_id,$action)
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		if($action==true){
			// echo "inactive";
			$result = $this->mangaModel->update_active($ep_id,'0');
		}else{
			$result = $this->mangaModel->del_data($ep_id);
		}

		if ($result==true && is_bool($result)) {

			setAlert('success', 'Delete Success.');
			return redirect()->to('/manga/'.$manga_id.'/episode/index');

		}else{

			setAlert('error', $result);
			return redirect()->to('/manga/'.$manga_id.'/episode/index');

		}

	}

	public function undel($manga_id,$ep_id)
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$result = $this->mangaModel->update_active($ep_id,'1');

		if ($result==true && is_bool($result)) {

			setAlert('success', 'Success.');
			return redirect()->to('/manga/'.$manga_id.'/episode/index');

		}else{

			setAlert('error', $result);
			return redirect()->to('/manga/'.$manga_id.'/episode/index');

		}

	}

	//--------------------------------------------------------------------

}