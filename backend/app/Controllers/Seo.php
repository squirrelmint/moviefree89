<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Maindata_Model;
use App\Models\Seo_Model;

class Seo extends Controller
{
    protected $validation;
    protected $Branch_Model;
    protected $session;
    protected $baseUrl;

	public function __construct() {

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->MaindataModel = new Maindata_Model();
        $this->seoModel = new Seo_Model();
        $this->baseUrl = base_url();
        helper(['filesystem', 'alert', 'loader','checklogin','url','pagination']);

    }


	public function index($branch_id){

        if( checkLogin()==false ){
			return redirect()->to('/login');
        }
        
        $branch = $this->MaindataModel->get_branchid($branch_id);

        if($branch['branch_system']=='movie'){

			$lg = ['en'=>'movie','th'=>'หนัง'];

		}else if($branch['branch_system']=='manga'){

			$lg = ['en'=>'manga','th'=>'มังงะ'];

		}

        $nav = [
                'module_name' => 'ตั้งหน้า SEO',
                'module_level' => array(
                                        array('name'=>"Home", 'url'=>"/"),
                                        array('name'=>ucwords($lg['en']), 'url'=>"/management/branch/".$branch_id),
                                        array('name'=>"SEO", 'url'=>"#")
                                    )
            ];

        $seo = $this->seoModel->get_seo($branch_id);
        if( empty($seo) ){
            $seo = [
                'seo_id' => '',
                'seo_title' => '',
                'seo_description' => '',
                'seo_sitemap' => ''
            ];
        }

        $data = [
                'branch_id' => $branch_id,
                'seo' => $seo,
                'lg' => $lg
            ];
            
		echo view('template/header');
		echo view('template/body', $nav);
		echo view('seo', $data);
        echo view('template/footer');
        
    }

    public function saveedit($branch){

        if( checkLogin()==false ){
			return redirect()->to('/login');
        }

        $this->validation->setRules([
            'seo_title' => 'required',
            'seo_description' => 'required',
        ]);
        $data_Field['seo_title'] = $this->request->getVar()['seo_title'];
        $data_Field['seo_description'] = $this->request->getVar()['seo_description'];
        $validate_field = $this->validation->run($data_Field);
        if($validate_field==false  && is_bool($validate_field)){
            setAlert('error', $validate_field."validate");
            return redirect()->to('/seo/branch/'.$branch);
        }

        $data = $this->request->getVar();
        $result = $this->seoModel->update_seo($branch, $data);

        if ($result==true && is_bool($result)) {

            setAlert('success', 'Success.');
            return redirect()->to('/seo/branch/'.$branch);

        }else{

            setAlert('error', $result);
            return redirect()->to('/seo/branch/'.$branch);

        }
    }

}
