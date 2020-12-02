<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Ads_Model;

class AdsService extends ResourceController
{

    protected $format    = 'json';
    protected $request;

    private $auth;
    private $adsmodel;

    public function __construct()
    {
        
        $this->request = \Config\Services::request();
        $this->adsmodel = new Ads_Model();

    }

    public function new($sid=null, $adsid=null, $brach_id=null)
    {
        
        if ( $sid==null || $adsid==null || $brach_id==null ) {
            return $this->respond( array('auth'=>'true', 'data'=>'null') );
        }

        $insert = $this->adsmodel->readAds($sid, $adsid, $brach_id);

        if ($insert==true) {
            return $this->respond( array('auth'=>'true', 'status'=>'true') );
        }else{
            return $this->respond( array('auth'=>'true', 'status'=>'fase') );
        }

    }

}