<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\User_Model;

class User extends Controller
{
    protected $validation;
    protected $User_Model;
    protected $session;
    protected $baseUrl;

    public function __construct() {

        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->User_Model = new User_Model();
        $this->baseUrl = base_url();
        helper(['alert','url']);

    }

	public function login()
	{
        
        $session_items = array('login','uname', 'uid', 'usystem', 'ugrant', 'sid');
        $this->session->remove($session_items);

        echo view('login');

    }

    public function logout(){

        $session_items = array('login','uname', 'uid', 'usystem', 'ugrant', 'sid');
        $this->session->remove($session_items);

        setAlert('success', 'Logout Success.');

        return redirect()->to('/login');

    }
    
    public function authenticate()
	{

        $data['user_name'] = $this->request->getPost("username");
        $data['user_pass'] = $this->request->getPost("password");

        $this->validation->setRules([
            'user_name' => 'required',
            'user_pass' => 'required|min_length[6]'
        ]);

        if ($this->validation->run($data) == FALSE)
        {

            $this->session->setFlashdata('msg', 'Username / Password Required');
            return redirect()->to('/login');

        }
        else
        {
            // $data['user_pass'] = md5($this->request->getPost("password"));

            $result = $this->User_Model->get_user($data);
            
            if (count($result) > 0)
            {
                $brtemp = $this->User_Model->get_branchtemplate($result[0]->user_id);
                $brsystem = $this->User_Model->get_branchsystem($result[0]->user_id,$result[0]->user_status);
                
                $sess_data = array('login' => TRUE, 'uname' => $result[0]->user_label, 'usystem' => $result[0]->user_system, 'ugrant' => $result[0]->user_status, 'uid' => $result[0]->user_id, 'brsystem' => $brsystem, 'brtemp' => $brtemp, 'sid' => session_id() );

                $this->session->set($sess_data);

                // setAlert('success', 'Login Success.');
                return redirect()->to('/dashboard');
            }
            else
            {
                $this->session->setFlashdata('msg', 'Wrong Username or Password!');
                return redirect()->to('/login');
            }

        }
        
	}

	//--------------------------------------------------------------------

}
