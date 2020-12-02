<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Branch_Model;

class Branch extends Controller
{
    protected $validation;
    protected $Branch_Model;
    protected $session;
    protected $baseUrl;

	public function __construct() {

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->Branch_Model = new Branch_Model();
    
        $this->baseUrl = base_url();
        helper(['filesystem', 'alert', 'loader','checklogin','url','pagination']);

    }

    public function saveedit($id)
    {
        
        $data['branch_name'] = $this->request->getPost("branch_name");
        $data['branch_system'] = $this->request->getPost("branch_system");
        // $data['branch_logo'] = $files->getRandomName();

        $this->validation->setRules([
            'branch_name' => 'required',
            'branch_system' => 'required'
        ]);
        
        if ($this->validation->run($data) == FALSE)
        {

            setAlert('error', 'Edit branch empty failed.');
            return redirect()->to('/branch/index');

        }
        else
        {
            
            $files = $this->request->getFiles('logo')['logo'];

            $result = $this->Branch_Model->edit_branch($id, $data, $this->request->getPost("oldlogo"), $files);

            if ($result==true && is_bool($result)) {

                setAlert('success', 'Edit Success.');
                return redirect()->to('/branch/index');
    
            }else{
    
                setAlert('error', $result);
                return redirect()->to('/branch/index');
    
            }

        }

    }

    public function edit($id){

        if( checkLogin()==false ){
			return redirect()->to('/login');
        }

        $nav = [
            'module_name' => 'Edit Branch',
            'module_level' => array(
                                    array('name'=>"Home", 'url'=>"/"),
                                    array('name'=>"Branch", 'url'=>"/branch/index"),
                                    array('name'=>"Edit", 'url'=>"/")
                                )
        ];

        $data = [
            'id' => $id,
            'data' => $this->Branch_Model->get_branch_id($id)
        ];

        echo view('template/header');
		echo view('template/body', $nav);
		echo view('branch/edit', $data);
		echo view('template/footer');

    }

    public function saveundelete($id){

        $data['branch_status'] = "1";

        $result = $this->Branch_Model->delete_brach($data, $id);

        if ($result==true && is_bool($result)) {

            setAlert('success', 'Restore Success.');
            return redirect()->to('/branch/index');

        }else{

            setAlert('error', $result);
            return redirect()->to('/branch/index');

        }

    }

    public function savedelete($id){

        $data['branch_status'] = "0";

        $result = $this->Branch_Model->delete_brach($data, $id);

        if ($result==true && is_bool($result)) {

            setAlert('success', 'Delete Success.');
            return redirect()->to('/branch/index');

        }else{

            setAlert('error', $result);
            return redirect()->to('/branch/index');

        }

    }

    public function saveadd(){

        $files = $this->request->getFiles()['logo'];

        $data['branch_name'] = $this->request->getPost("branch_name");
        $data['branch_system'] = $this->request->getPost("branch_system");
        // $data['branch_logo'] = $files->getRandomName();
        $data['branch_status'] = '1';

        $this->validation->setRules([
            'branch_name' => 'required'
        ]);

        if ($this->validation->run($data) == FALSE)
        {

            setAlert('error', 'Edit data empty failed.');
            return redirect()->to('/branch/index');

        }
        else
        {

            $result = $this->Branch_Model->insert_data($data, $files);

            if ($result==true && is_bool($result)) {
    
                setAlert('success', 'Add Success.');
                return redirect()->to('/branch/add');
    
            }else{
    
                setAlert('error', $result);
                return redirect()->to('/branch/add');
    
            }

        }

        
    }

    public function add(){

        if( checkLogin()==false ){
			return redirect()->to('/login');
        }
        
        $nav = [
            'module_name' => 'Add Branch',
            'module_level' => array(
                                    array('name'=>"Home", 'url'=>"/"),
                                    array('name'=>"Branch", 'url'=>"/branch/index"),
                                    array('name'=>"Add", 'url'=>"/")
                                )
        ];
        echo view('template/header');
		echo view('template/body', $nav);
		echo view('branch/add');
		echo view('template/footer');
    }

	public function index($search=""){

        if( checkLogin()==false ){
			return redirect()->to('/login');
        }
        $search = urldecode($search);

        $page = 1;
		if( !empty( $_GET) ){
			$page = $_GET['page'];
		}
        
        $nav = [
                'module_name' => 'Branch Management',
                'module_level' => array(
                                        array('name'=>"Home", 'url'=>"/"),
                                        array('name'=>"Branch", 'url'=>"#")
                                    )
            ];

        $branchdata = $this->Branch_Model->get_branch_page($search, $page);
        
        $data = [
                'usercount' => $this->Branch_Model->count_user_page($search),
                'userdata' => $branchdata['list'],
                'paginate' => $branchdata,
                'search_string' => $search
            ];
            
		echo view('template/header');
		echo view('template/body', $nav);
		echo view('branch/index', $data);
        echo view('template/footer');
        
    }
    
	//--------------------------------------------------------------------

}
