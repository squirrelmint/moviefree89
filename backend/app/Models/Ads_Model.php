<?php namespace App\Models;
use CodeIgniter\Model;

class Ads_Model extends Model {

    protected $table	= 'ads';
    protected $tablereportads	= 'reportads';
    protected $tablereportadsvdo	= 'reportadsvdo';
    private $path_fileads;
    
	public function __construct() {
        parent::__construct();
        
        $db = \Config\Database::connect();
        $this->path_fileads = "banners";
    }

    public function readVdoAds($sid, $adsid, $branch_id){

        $builder =  $this->db->table($this->tablereportadsvdo);
        
        $data = [
            'reportadsvdo_sid' => $sid,
            'adsvideo_id' => $adsid,
            'branch_id' => $branch_id
        ];

        try {

            if( $builder->insert($data) ){
                return true;
            }else{
                return false;
            }

        } catch (\Throwable $th) {
            return false;
        }

    }

    public function readAds($sid, $adsid, $branch_id){

        $builder =  $this->db->table($this->tablereportads);
        
        $data = [
            'reportads_sid' => $sid,
            'ads_id' => $adsid,
            'branch_id' => $branch_id
        ];

        try {

            if( $builder->insert($data) ){
                return true;
            }else{
                return false;
            }

        } catch (\Throwable $th) {
            return false;
        }

    }

	public function insert_data($data, $files)
	{
        $bd =  $this->db->table($this->table);

        $data['ads_picture'] = $files->getRandomName();

        if($bd->insert($data) && $files->move(FCPATH.$this->path_fileads, $data['ads_picture'])){
            // return redirect()->to('/branch/add');
            return true;
        }else{
            return false;
        }
    }

    public function update_data($id, $data, $oldpic, $files)
    {
        
        $builder = $this->db->table($this->table);

        $builder->where('ads_id', $id);

        if ( $files->isValid() ) {

            $data['ads_picture'] = $files->getRandomName();

            if($builder->update($data)==true && $files->move(FCPATH.$this->path_fileads, $data['ads_picture'])){
                // return redirect()->to('/branch/add');
                if (!empty($files)) {
                    @unlink(FCPATH.$this->path_fileads."/".$oldpic);
                }
    
                return true;
            }else{
                return false;
            }

        }else{

            if($builder->update($data)==true){   
                return true;
            }else{
                return false;
            }

        }
 
        
    }

    public function delete_data($files, $id)
    {
        $builder = $this->db->table($this->table);

        $builder->where('ads_id', $id);

        try {
            @unlink(set_realpath(FCPATH.$this->path_fileads."/".$files));
            if( $builder->delete()==true ){
                return true;
            }
         }
         catch (\Exception $e)
         {
            // throw new Exception("Error Insert user", 1);
            return $e->getMessage();
                
         }

    }
}