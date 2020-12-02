<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Setting_Model;

class Setting extends Controller
{
    protected $validation;
    protected $Branch_Model;
    protected $session;
    protected $baseUrl;

	public function __construct() {

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->settingModel = new Setting_Model();
        $this->baseUrl = base_url();
        helper(['filesystem', 'alert', 'loader','checklogin','url','pagination']);

    }


	public function index($branch){

        if( checkLogin()==false ){
			return redirect()->to('/login');
        }
        
        $nav = [
                'module_name' => 'ตั้งหน้าเว็บ',
                'module_level' => array(
                                        array('name'=>"Home", 'url'=>"/"),
                                        array('name'=>"Branch", 'url'=>"/management/branch/".$branch),
                                        array('name'=>"Setting", 'url'=>"#")
                                    )
            ];

        $setting = $this->settingModel->get_setting($branch);
        if( empty($setting) ){
            $setting = [
                'setting_id' => '',
                'setting_domain' => '',
                'setting_title' => '',
                'setting_description' => '',
                'setting_keyword' => '',
                'setting_logo' => '',
                'setting_icon' => '',
                'setting_ssl' => '',
                'setting_adsskip' => '',
                'setting_fb' => '',
                'setting_line' => '',
                'setting_header' => '',
                'setting_footer' => '',
            ];
        }else{
            $setting ['setting_header'] = base64_decode($setting ['setting_header']);
            $setting ['setting_footer'] = base64_decode($setting ['setting_footer']);
        }

        $data = [
                'branch_id' => $branch,
                'setting' => $setting
            ];
            
		echo view('template/header');
		echo view('template/body', $nav);
		echo view('setting', $data);
        echo view('template/footer');
        
    }

    public function saveedit($branch){

        if( checkLogin()==false ){
			return redirect()->to('/login');
        }
         //echo "<pre>"; print_r($this->request->getFiles()['setting_logo']);die;
       
        $this->validation->setRules([
            'setting_id' => 'required',
            'setting_title' => 'required',
            'setting_keyword' => 'required',
            'setting_logo' => 'required',
            'setting_icon' => 'required'
        ]);
        $data_Field['setting_id'] = $this->request->getVar()['setting_id'];
        $data_Field['setting_title'] = $this->request->getVar()['setting_title'];
        $data_Field['setting_keyword'] = $this->request->getVar()['setting_keyword'];
        if($this->request->getFiles()['setting_logo']->getName()==""){
            $data_Field['setting_logo'] = $this->request->getVar()['oldlogo'];
        }else{
            $data_Field['setting_logo'] = $this->request->getFiles()['setting_logo']->getName();
        }
        if($this->request->getFiles()['setting_icon']->getName()==""){
            $data_Field['setting_icon'] = $this->request->getVar()['oldicon'];
        }else{
            $data_Field['setting_icon'] = $this->request->getFiles()['setting_icon']->getName();
        }
        $validate_field = $this->validation->run($data_Field);

        if ($validate_field == FALSE)
        {
            setAlert('error', $validate_field);
            return redirect()->to('/setting/branch/'.$branch);
        }

        $data = $this->request->getVar();
        $logo = $this->request->getFiles()['setting_logo'];
        $icon = $this->request->getFiles()['setting_icon'];

        $result = $this->settingModel->update_setting($branch, $data, $logo, $icon);

        if ($result==true && is_bool($result)) {

            setAlert('success', 'Success.');
            return redirect()->to('/setting/branch/'.$branch);

        }else{

            setAlert('error', $result);
            return redirect()->to('/setting/branch/'.$branch);

        }
    }
    

}
