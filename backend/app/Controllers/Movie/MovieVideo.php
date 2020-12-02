<?php namespace App\Controllers\Movie;
use App\Models\Moviedata_Model;
use App\Models\Seo_Model;
use App\Models\Setting_Model;
use CodeIgniter\Controller;

class MovieVideo extends Controller
{
	//private $img_movies = "img_movies";
	private $path_fillmovies;
	protected $serviceUrl;
	public function __construct() {

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->moviedatamodel = new Moviedata_Model();
        $this->seoModel = new Seo_Model();
        $this->settingModel = new Setting_Model();
        $this->base_url = base_url();
		$this->path_fillmovies = "img_movies";
		$config = new \Config\App();
		$this->serviceUrl = $config->serviceUrl;
		helper(['filesystem', 'alert', 'loader','checklogin','url','pagination']);
    }

	public function index($search){
		
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}
		$nav = [
                'module_name' => 'Video',
                'module_level' => array(
                                        array('name'=>"Home", 'url'=>"/"),
                                        array('name'=>"Video", 'url'=>"#")
                                    )
            ];
		$data = [
			'userdata' => $this->moviedatamodel->get_user_page($search, 20, 0),
			'search_string' => $search,
			'url_service'=> $this->serviceUrl
		];

		echo view('template/header');
		echo view('template/body', $nav);

		echo view('movie/videolist');
		echo view('template/footer');
	}


	// List video
	public function video($branch,$search="")
	{
        // print_r($branch);
		// die;
		$page = 1;
		if( !empty( $_GET) ){
			$page = $_GET['page'];
		}
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}
		$search = urldecode($search);
		$nav = [
                'module_name' => 'Video',
                'module_level' => array(
										array('name'=>"Home", 'url'=>"/"),
										array('name'=>"Branch", 'url'=>"/management/branch/".$branch),
                                        array('name'=>'Video', 'url'=>"#")
                                    )
            ];

		$branchdata = $this->moviedatamodel->get_video($branch,$search, $page);
		$data = [];
		$data = [
			'search_string' => $search,
			'cate' => $branchdata['list'],
            'paginate' => $branchdata,
            'url_service'=> $this->serviceUrl
			];


        $data['branch'] = $branch;
       
		echo view('template/header');
		echo view('template/body', $nav);
		echo view('movie/videolist', $data);
		echo view('template/footer');
	}


	public function add($branch,$id="")
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}
		$category_id = $this->moviedatamodel->get_category();

		$nav = [
			'module_level' => array(
									array('name'=>"Home", 'url'=>"/"),
									array('name'=>"Branch", 'url'=>"/management/branch/".$branch),
									array('name'=>"Video", 'url'=>"/video/branch/".$branch."/video/index"),
									array('name'=>"Add", 'url'=>"#")								
								)
		];
		$nav['module_name'] = 'Add Movie';

		echo view('template/header');
		echo view('template/body', $nav);

        $data = [];
		$data = [
			'branch' => $branch,
			'category' => $category_id,
			'seo' => $this->seoModel->get_seo($branch),
			'base_url' => $this->base_url,
			'url_service'=> $this->serviceUrl,
			'setting' => $this->settingModel->get_setting($branch)
		];

		echo view('movie/videoform', $data);
		echo view('template/footer');

    }
    
	public function saveadd($branch) {
		
	    $params = $this->request->getVar();
		$files = $this->request->getFiles();
		// echo "<pre>";
		// print_r($params); 
		// die;
		$imgs = $files['img_video']; //for up load file

		$this->validation->setRules([
				'movie_thname' => 'required',
				'movie_picture' =>  'required',
				'movie_year' =>  'required',
				'movie_quality' => 'required',
				'movie_sound' =>  'required',
				'movie_type' =>  'required',
				'movie_ratescore' =>  'required',
				'movie_thmain' =>   'required'
        ]);
		$data_Field['movie_thname'] = $this->request->getVar()['videoname_th'];
		if ($imgs->getName()==''){
            $data_Field['movie_picture'] = $this->request->getVar()['videoname_url'];
        }else {
            $data_Field['movie_picture'] = $imgs->getName();
		}
		$data_Field['movie_year'] = $this->request->getVar()['videoname_year'];
		$data_Field['movie_quality'] = $this->request->getVar()['quality'];
		$data_Field['movie_sound'] = $this->request->getVar()['sound'];
		$data_Field['movie_type'] = $this->request->getVar()['video_type'];
		$data_Field['movie_ratescore'] = $this->request->getVar()['videoname_ratescore'];
		$data_Field['movie_thmain'] = $this->request->getVar()['url_movieth_manin'];
		$data_Field['movie_preview'] = $this->request->getVar()['triler_video'];
		$validate_field = $this->validation->run($data_Field);
        if ($validate_field == FALSE)
        {
            setAlert('error','Add fail please validate field');
            return redirect()->to('/video/branch/'.$branch.'/video/add');
        }


		$result = $this->moviedatamodel->savevideo_add($params,$branch,$imgs);

        if ($result==true && is_bool($result)){
            setAlert('success', 'Add Success.');
			return redirect()->to('/video/branch/'.$branch.'/video/index');
					
        }else{
            setAlert('error', $result);
            return redirect()->to('/video/branch/'.$branch.'/video/add');
		}
		
	}
	
	public function edit($branch,$id){
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}
		$nav = [
			'module_level' => array(
									array('name'=>"Home", 'url'=>"/"),
									array('name'=>"Branch", 'url'=>"/management/branch/".$branch),
									array('name'=>"Video", 'url'=>"/video/branch/".$branch."/video/index"),
									array('name'=>"Edit", 'url'=>"#")		
								)
		];

		$nav['module_name'] = 'Edit Video';

		echo view('template/header');
		echo view('template/body', $nav);

		$data = [
            'id' => $id,
			'data' => $this->moviedatamodel->get_editdata_video($id),
			'category_list' => $this->moviedatamodel->get_category(),
			'category_onmovie' => $this->moviedatamodel->get_category_onmovie($id),
			'path_img' => $this->path_fillmovies.'/',
			'seo' => $this->seoModel->get_seo($branch),
			'base_url' => $this->base_url,
			'setting' => $this->settingModel->get_setting($branch),
			'url_service'=> $this->serviceUrl
		];
		echo view('movie/videoedit', $data);
		echo view('template/footer');

	}
	public function video_update($branch,$id){
		$imgs = $this->request->getFiles()['img_video'];
		$params = $this->request->getVar();	
		$fileold = $this->moviedatamodel->get_fileold($id)['movie_picture'];
		// echo "<pre>";
		// print_r($file_name_old); 
		// die;
		$this->validation->setRules([
			'movie_thname' => 'required',
			'movie_picture' =>  'required',
			'movie_year' =>  'required',
			'movie_quality' => 'required',
			'movie_sound' =>  'required',
			'movie_type' =>  'required',
			'movie_ratescore' =>  'required',
			'movie_thmain' =>   'required'
		]);
		$data_Field['movie_thname'] = $this->request->getVar()['videoname_th'];
		if ($imgs->getName()!=''){
			$data_Field['movie_picture'] = $imgs->getName();
        }else if($this->request->getVar()['videoname_url']!=''){
            $data_Field['movie_picture'] = $this->request->getVar()['videoname_url'];
		}else{
			$data_Field['movie_picture'] = $fileold;
		}
		$data_Field['movie_year'] = $this->request->getVar()['videoname_year'];
		$data_Field['movie_quality'] = $this->request->getVar()['quality'];
		$data_Field['movie_sound'] = $this->request->getVar()['sound'];
		$data_Field['movie_type'] = $this->request->getVar()['video_type'];
		$data_Field['movie_ratescore'] = $this->request->getVar()['videoname_ratescore'];
		$data_Field['movie_thmain'] = $this->request->getVar()['url_movieth_manin'];
		$data_Field['movie_preview'] = $this->request->getVar()['triler_video'];
		$validate_field = $this->validation->run($data_Field);
        if ($validate_field == FALSE)
        {
            setAlert('error','Add fail please validate field');
            return redirect()->to('/video/branch/'.$branch.'/video/add');
        }



		$result = $this->moviedatamodel->update_video($branch,$id,$params,$imgs,$fileold);
       
        if ($result==true && is_bool($result)) {

            setAlert('success', 'Restore Success.');
            return redirect()->to('/video/branch/1/video/index');

        }else{

            setAlert('error', $result);
            return redirect()->to('/video/branch/1/video/edit/id/'.$id);

        }
		
    }
    
    public function del_video($branch,$id)
    
	{
		if( checkLogin()==false){
			return redirect()->to('/login');
		}
        $result = $this->moviedatamodel->video_del($id);
		
        if ($result==true && is_bool($result)) {

            setAlert('success', 'Restore Success.');
            return redirect()->to('/video/branch/'.$branch.'/video/index');
        }else{

            setAlert('error', $result);
            return redirect()->to('/video/branch/'.$branch.'/video/index');

        }

	}
	
	//--------------------------------------------------------------------

}
