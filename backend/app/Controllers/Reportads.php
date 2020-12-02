<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Reportads_Model;

class Reportads extends Controller
{
    protected $validation;
    protected $reportadsModel;
    protected $session;
    protected $baseUrl;

	public function __construct() {

		$this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->reportadsModel = new Reportads_Model();
    
        $this->baseUrl = base_url();
        helper(['filesystem', 'alert', 'loader','checklogin','url','pagination','library']);

    }


	public function index($branch, $search=""){

        // if( checkLogin()==false ){
		// 	return redirect()->to('/login');
        // }
        
        $nav = [
                'module_name' => 'รายการโฆษณา',
                'module_level' => array(
                                        array('name'=>"Home", 'url'=>"/"),
                                        // array('name'=>"Manga", 'url'=>"/management/branch/".$branch),
                                        array('name'=>"Report Ads", 'url'=>"#")
                                    )
            ];
        
        $datecurrent = date('Y-m-d');
        $sdate = date('01-m-Y') . " - " . date("t-m-Y", strtotime($datecurrent));
        $datestart = date('Y-m-01');
        $dateend = date("t-m-Y", strtotime($datecurrent));

        if(!empty($search)){
            $sdate = urldecode($search);
            list($datestart, $blank, $dateend) = explode(' ', $sdate);
            $datestart = date_format(date_create($datestart),"Y-m-d");
            $dateend = date_format(date_create($dateend),"Y-m-d");
        }

        $creport = $this->reportadsModel->get_countreportads($branch, $datestart, $dateend);
        if( !empty($creport) ){ $creport = $creport['cads']; }

        $dlmstart = date_create($datestart);
        date_sub($dlmstart,date_interval_create_from_date_string("1 months"));
        $dlstart = date_format($dlmstart,"Y-m-d");

        $dlmend = date_create($dateend);
        date_sub($dlmend,date_interval_create_from_date_string("1 months"));
        $dlend = date_format($dlmend,"Y-m-d");

        $lsdate = date_format($dlmstart,"d-m-Y") . " - " . date_format($dlmend,"d-m-Y");

        $clreport = $this->reportadsModel->get_countreportads($branch, $dlstart, $dlend);
        if( !empty($clreport) ){ $clreport = $clreport['cads']; }

        $report = $this->reportadsModel->get_reportads($branch, $datestart, $dateend);
        $chartcr = $this->reportadsModel->get_chart_on_month($branch, $datestart, $dateend);
        $chartlm = $this->reportadsModel->get_chart_on_month($branch, $dlstart, $dlend);

        $data = [
                'branch_id' => $branch,
                'daterange' => $sdate,
                'ldaterange' => $lsdate,
                'count' => $creport,
                'lcount' => $clreport,
                'report' => $report,
                'monththai' => get_date_on_thai(),
                'chart_cr' => json_encode($chartcr),
                'chart_lm' => json_encode($chartlm),
            ];
            
		echo view('template/header');
		echo view('template/body', $nav);
		echo view('reportads/index', $data);
        echo view('template/footer');
        
    }

    

}
