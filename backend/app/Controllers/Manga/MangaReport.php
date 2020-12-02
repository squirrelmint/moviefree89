<?php namespace App\Controllers\Manga;
use App\Models\MangaReport_Model;
use CodeIgniter\Controller;

class MangaReport extends Controller
{
	public function __construct() {

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->mangareportdatamodel = new MangaReport_Model();

        helper(['url','alert','checklogin']);

    }

	public function index($branch,$search="")
	{
        $nav = [
            'module_name' => 'รายการแจ้งหนังเสีย',
            'module_level' => array(
                                    array('name'=>"หน้าแรก", 'url'=>"/"),
                                    array('name'=>"แจ้งหนังเสีย", 'url'=>"#")
                                )
        ];

        $data = [
			'reports' => $this->mangareportdatamodel->get_report($search,$branch),
            'search_string' => $search,
            'branch' => $branch
        ];

        echo view('template/header');
		echo view('template/body', $nav);

		echo view('manga/report',$data);
		echo view('template/footer');
    }

    public function del($branch, $id)
	{

        $result = $this->mangareportdatamodel->report_del($id);

        if ($result==true && is_bool($result)) {

            setAlert('success', 'Restore Success.');
            return redirect()->to('/manga/branch/'.$branch.'/report/index');

        }else{

            setAlert('error', $result);
            return redirect()->to('/manga/branch/'.$branch.'/report/index');

        }

	}
} 
