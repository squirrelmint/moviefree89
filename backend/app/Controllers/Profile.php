<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\User_Model;
use App\Models\Branch_Model;

class Profile extends Controller
{
    protected $validation;
    protected $User_Model;
    protected $Branch_Model;
    protected $session;
    protected $baseUrl;

	public function __construct() {

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->User_Model = new User_Model();
        $this->Branch_Model = new Branch_Model();
        $this->baseUrl = base_url();
        helper(['alert','checklogin','url','pagination']);

    }

    public function saveedit($id){

        $data['user_name'] = $this->request->getPost("username");
        $data['user_pass'] = $this->request->getPost("password");
        $data['user_label'] = $this->request->getPost("name");
        $data['user_email'] = $this->request->getPost("email");
        $data['user_tel'] = $this->request->getPost("tel");

        $this->validation->setRules([
            'user_name' => 'required',
            'user_pass' => 'required|min_length[6]',
            'user_label' => 'required',
            'user_tel' => 'required'
        ]);

        if ($this->validation->run($data) == FALSE)
        {

            setAlert('error', 'Edit failed.');
            return redirect()->to('/profile/index');

        }
        else
        {

            $result = null;

            if ( is_array($this->request->getPost("system")) ) {

                $data_user = $data;
                $data_grant = $this->request->getPost("system");
                
                $result = $this->User_Model->edit_user_grant($data_user, $data_grant, $id);
                
            }else{

                $result = $this->User_Model->edit_user($data, $id);

            }

            if ($result==true && is_bool($result)) {

                setAlert('success', 'Edit Success.');
                return redirect()->to('/profile/index');

            }else{

                setAlert('error', $result);
                return redirect()->to('/profile/index');

            }

        }

    }

    public function edit($id){

        if( checkLogin()==false ){
			return redirect()->to('/login');
        }

        $nav = [
            'module_name' => 'Add User',
            'module_level' => array(
                                    array('name'=>"Home", 'url'=>"/"),
                                    array('name'=>"Profile", 'url'=>"/profile/index"),
                                    array('name'=>"Edit", 'url'=>"/")
                                )
        ];

        $data = [
            'id' => $id,
            'data' => $this->User_Model->get_user_id($id),
            'branch' => $this->Branch_Model->get_branch_all($id)
        ];

        echo view('template/header');
		echo view('template/body', $nav);
		echo view('profile/edit', $data);
		echo view('template/footer');

    }

    public function saveundelete($id){

        $data['user_status'] = "1";

        $result = $this->User_Model->delete_user($data, $id);

        if ($result==true && is_bool($result)) {

            setAlert('success', 'Restore Success.');
            return redirect()->to('/profile/index');

        }else{

            setAlert('error', $result);
            return redirect()->to('/profile/index');

        }

    }

    public function savedelete($id){

        $data['user_status'] = "0";
        
        //print_r($data['user_status']);die;

        $result = $this->User_Model->delete_user($data, $id);

        if ($result==true && is_bool($result)) {

            setAlert('success', 'Delete Success.');
            return redirect()->to('/profile/index');

        }else{

            setAlert('error', $result);
            return redirect()->to('/profile/index');

        }

    }

    public function saveadd()
    {
        
        $data['user_name'] = $this->request->getPost("username");
        $data['user_pass'] = $this->request->getPost("password");
        $data['user_label'] = $this->request->getPost("name");
        $data['user_email'] = $this->request->getPost("email");
        $data['user_tel'] = $this->request->getPost("tel");

        $this->validation->setRules([
            'user_name' => 'required',
            'user_pass' => 'required|min_length[6]',
            'user_label' => 'required',
            'user_tel' => 'required'
        ]);

        if ($this->validation->run($data) == FALSE)
        {

            setAlert('error', 'Add failed.');
            return redirect()->to('/profile/index');

        }
        else
        {

            $result = null;

            if ( is_array($this->request->getPost("system")) ) {

                $data_user = $data;
                $data_grant = $this->request->getPost("system");
                
                $result = $this->User_Model->add_user_grant($data_user, $data_grant);
                
            }else{

                $result = $this->User_Model->add_user($data);

            }

            if ($result==true && is_bool($result)) {

                setAlert('success', 'Add Success.');
                return redirect()->to('/profile/index');

            }else{

                setAlert('error', $result);
                return redirect()->to('/profile/index');

            }

        }
        
    }

    public function add()
    {
        if( checkLogin()==false ){
			return redirect()->to('/login');
		}

        $nav = [
            'module_name' => 'Add User',
            'module_level' => array(
                                    array('name'=>"Home", 'url'=>"/"),
                                    array('name'=>"Profile", 'url'=>"/profile/index"),
                                    array('name'=>"Add", 'url'=>"/")
                                )
        ];

        $data = [
            'branch' => $this->Branch_Model->get_branch_all()
        ];

        echo view('template/header');
		echo view('template/body', $nav);
		echo view('profile/add', $data);
		echo view('template/footer');
    }

	public function index($search="")
	{
        if( checkLogin()==false ){
			return redirect()->to('/login');
        }

        $page = 1;
		if( !empty( $_GET) ){
			$page = $_GET['page'];
		}
        
        $nav = [
                'module_name' => 'Profile Management',
                'module_level' => array(
                                        array('name'=>"Home", 'url'=>"/"),
                                        array('name'=>"Profile", 'url'=>"#")
                                    )
            ];

        $userdata = $this->User_Model->get_user_page($search, $page);
        
        $data = [
                'usercount' => $this->User_Model->count_user_page($search),
                'userdata' => $userdata['list'],
                'paginate' => $userdata,
                'search_string' => $search
            ];

        // print_r($data);

		echo view('template/header');
		echo view('template/body', $nav);
		echo view('profile/index', $data);
        echo view('template/footer');
        
	}

	//--------------------------------------------------------------------

}
