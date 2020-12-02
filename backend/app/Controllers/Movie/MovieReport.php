<?php namespace App\Controllers\Movie;
use App\Models\MovieReport_Model;
use CodeIgniter\Controller;

class MovieReport extends Controller
{
	public function __construct() {

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->moviereportdatamodel = new MovieReport_Model();

        helper(['url','alert','checklogin']);

    }

	public function index($branch,$search="")
	{
        $nav = [
            'module_name' => 'Movie Reports',
            'module_level' => array(
                                    array('name'=>"Home", 'url'=>"/"),
                                    array('name'=>"Branch", 'url'=>"/management/branch/".$branch),
                                    array('name'=>'Report', 'url'=>"#")
                                )
        ];

        $data = [
			'reports' => $this->moviereportdatamodel->get_report($search,$branch,20,0),
			'search_string' => $search
		];
        $data['branch'] = $branch;
        echo view('template/header');
		echo view('template/body', $nav);

		echo view('movie/report',$data);
		echo view('template/footer');
    }
    
}
