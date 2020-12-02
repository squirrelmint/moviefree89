<?php namespace App\Controllers;
use App\Models\Maindata_Model;
use App\Models\Branch_Model;
use App\Models\User_Model;
use CodeIgniter\Controller;

class Dashboard extends Controller
{
	public function __construct() {

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->MaindataModel = new Maindata_Model();

		helper(['url','alert','checklogin']);

    }

	public function index()
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$header = [
				'branchsystem' => 'OK',
		];

		$nav = [
                'module_name' => 'Dashboard',
                'module_level' => array(
                                        array('name'=>"Home", 'url'=>"/"),
                                        array('name'=>"Dashboard", 'url'=>"#")
                                    )
			];
		
		$header = [
			'branchsystem' => 'OK',
		];

		echo view('template/header', $header);
		echo view('template/body', $nav);

		$data = [];

		// get branch show to dashboard
		$user_id = $_SESSION['uid'];
		$data['branch'] = $this->MaindataModel->get_branch($user_id);
		$data['branch_status'] = ['0'=>'ปิดการใช้งาน','1'=>'กำลังใช้งาน','2'=>'กำลังปรับปรุง'];
		$data['branch_statusstyle'] = ['0'=>'border-grey-400','1'=>'border-success','2'=>'border-danger'];

		echo view('dashboard', $data);
		echo view('template/footer');
	}

	public function management( $branch_id )
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$branch = $this->MaindataModel->get_branchid($branch_id);

		$sess_data = array('brid' => $branch_id );
		$this->session->set($sess_data);
		
		$nav = [
                'module_name' => ucwords(strtolower($branch['branch_name'])),
                'module_level' => array(
                                        array('name'=>"Home", 'url'=>"/"),
                                        array('name'=>strtolower($branch['branch_name']), 'url'=>"#")
                                    )
            ];

		echo view('template/header');
		echo view('template/body', $nav);

		$data = [];
		$data['branch'] = $branch;

		$userModel = new User_Model();
		$data['user'] = $userModel->get_user_id($_SESSION['uid']);

		if($branch['branch_system']=='movie'){

			echo view('movie/manage', $data);

		}else if($branch['branch_system']=='manga'){

			echo view('manga/manage', $data);

		}

		echo view('template/footer');
	}

	public function update_branchstatus($id, $status)
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$BranchModel = new Branch_Model();
		$result = $BranchModel->update_branchstatus($id, $status);

		if($result=="ok"){
			$alertstatus = ['0'=>'ระบบปิดการใช้งาน','1'=>'ระบบกำลังใช้งาน','2'=>'ระบบกำลังปรับปรุง'];
			setAlert('success', $alertstatus[$status]);
			return redirect()->to('/dashboard');
		}
	}



	//--------------------------------------------------------------------

}
