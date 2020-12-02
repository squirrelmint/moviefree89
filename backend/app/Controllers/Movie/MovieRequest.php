<?php namespace App\Controllers\Movie;
use App\Models\MovieRequest_Model;
use CodeIgniter\Controller;

class MovieRequest extends Controller
{
	public function __construct() {

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->movierequestmodel = new MovieRequest_Model();

        helper(['url','alert','checklogin']);

    }

	public function index($branch)
	{
		$nav = [
            'module_name' => 'Movie Reports',
            'module_level' => array(
                                    array('name'=>"Home", 'url'=>"/"),
                                    array('name'=>"Branch", 'url'=>"/management/branch/".$branch),
                                    array('name'=>'Request', 'url'=>"#")
                                )
        ];

        $data = [
        	'branch' => $branch,
			'requests' => $this->movierequestmodel->get_request($branch)
		];

        echo view('template/header');
		echo view('template/body', $nav);

		echo view('movie/request',$data);
		echo view('template/footer');
	}

	public function savedel($branch_id, $request_id)
	{
		if( checkLogin()==false ){
			return redirect()->to('/login');
		}

		$result = $this->movierequestmodel->delete_data($request_id);

		if ($result==true && is_bool($result)) {

			setAlert('success', 'Delete Success.');
			return redirect()->to('/movie/branch/'.$branch_id.'/request/index');

		}else{

			setAlert('error', $result);
			return redirect()->to('/movie/branch/'.$branch_id.'/request/index');

		}
	}
}