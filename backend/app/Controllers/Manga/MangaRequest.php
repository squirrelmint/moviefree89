<?php namespace App\Controllers\Manga;

use App\Models\MangaRequest_Model;
use CodeIgniter\Controller;

class MangaRequest extends Controller
{

	public function __construct() {

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->mangarequestdatamodel = new MangaRequest_Model();

        helper(['url','alert','checklogin']);

    }



	public function index($branch,$search="")
	{

        $nav = [
            'module_name' => 'รายการขอการ์ตูน',
            'module_level' => array(
                                    array('name'=>"Home", 'url'=>"/"),
                                    array('name'=>"Branch", 'url'=>"/management/branch/".$branch),
                                    array('name'=>"Request", 'url'=>"#")
                                )
        ];


        $data = [
			'requests' => $this->mangarequestdatamodel->get_request($search,$branch),
            'search_string' => $search,
            'branch' => $branch
        ];

        echo view('template/header');
		echo view('template/body', $nav);
		echo view('manga/request',$data);
		echo view('template/footer');

    }


    public function del($branch, $id)
	{

        $result = $this->mangarequestdatamodel->request_del($id);

        if ($result==true && is_bool($result)) {
            setAlert('success', 'Delete Success.');
            return redirect()->to('/manga/branch/'.$branch.'/request/index');
        }else{
            setAlert('error', $result);
            return redirect()->to('/manga/branch/'.$branch.'/request/index');
        }

	}

} 

