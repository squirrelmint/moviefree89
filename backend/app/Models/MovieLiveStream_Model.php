<?php namespace App\Models;
use CodeIgniter\Model;

// defined('BASEPATH') or exit('No direct script access allowed');

class MovieLiveStream_Model extends Model {

    protected $table_cate	= 'mo_category';
    protected $table_source1	= 'mo_movie';
    protected $mo_moviecate = 'mo_moviecate';
    protected $mo_livestream = 'mo_livestream';
    private $path_fillmovies;

	// protected $table_manga	= 'mo_subject';
	// protected $table_episode = 'manga_episode';

	public function __construct() {
        parent::__construct();
        
        $db = \Config\Database::connect();
        $this->path_fillmovies = "movie/livestream";
    }
    public function get_livestream($branch,$search, $page=1){
        // echo $search;die;
         $sql_where = "";
 
         if ($search!="") {
             $sql_where .= " AND CONCAT_WS('',$this->mo_livestream.livestream_name
                                              ) LIKE '%$search%' ";
         }
 
         $sql = "SELECT
            $this->mo_livestream.livestream_id,
					$this->mo_livestream.livestream_name,
                    $this->mo_livestream.livestream_url,
                    $this->mo_livestream.livestream_img,
                    $this->mo_livestream.livestream_status,
                    $this->mo_livestream.branch_id
             FROM
             $this->mo_livestream
             WHERE
             $this->mo_livestream.branch_id = $branch ".$sql_where."
             GROUP BY $this->mo_livestream.livestream_id ";
             //echo $sql;die;
             $query = $this->db->query($sql);
             $total = count($query->getResultArray());
             $perpage = 20;
     
             return get_pagination($sql,$page,$perpage,$total);
 
    }
    public function savelivestream_add($params,$branch,$files){
        $this->db->transBegin();
        $bd =  $this->db->table($this->mo_livestream);
        $filename = $files['img_video']->getRandomName();
        $status;
        if(!empty($params['status'])){
            $status = 1;
        }else{
            $status = 0;
        }
        $data =  	[
			'livestream_name' => $params['livestreamname_th'],
			'livestream_img'=> $filename,
			'livestream_url'=> $params['livestreamname_url'],
			'livestream_status'=> $status,
			'branch_id' => $branch
        ];
        try 
	   	{

			if($bd->insert($data)==true && $files['img_video']->move(FCPATH.$this->path_fillmovies, $data['livestream_img'])){

				$this->db->transCommit();
				return true;
				
			}else{

				$this->db->transRollback();
				return false;

			}

        } 
        catch (\Exception $e) 
		{
           // throw new Exception("Error Insert user", 1);
		   $this->db->transRollback();
		   return $e->getMessage();
        }
    }
    public function livestream_del($branch,$id){


        $sql = "SELECT
        $this->mo_livestream.livestream_id,
        $this->mo_livestream.livestream_img
         FROM
         $this->mo_livestream
         WHERE
         $this->mo_livestream.branch_id = $branch 
         AND
         $this->mo_livestream.livestream_id = $id 
         GROUP BY $this->mo_livestream.livestream_id LIMIT 1";
         //echo $sql;die;
         $query = $this->db->query($sql);
         $files = $query->getResultArray()[0]['livestream_img'];   
        $this->db->transBegin();
		$bd =  $this->db->table($this->mo_livestream);
		$bd->where('livestream_id', $id);
		try 
	   	{
			if($bd->delete()==true && @unlink(set_realpath(FCPATH.$this->path_fillmovies."/".$files)) ){
				$this->db->transCommit();
				return true;
			}else{
				$this->db->transRollback();
				return false;
			}
		} 
		catch (\Exception $e) 
		{
           // throw new Exception("Error Insert user", 1);
		   $this->db->transRollback();
		   return $e->getMessage();
        }
    }
    public function  get_editdata_livestream($id){
            $sql = "SELECT
            livestream_name,
            livestream_url,
            livestream_img,
            livestream_status,
            branch_id 
            FROM
            $this->mo_livestream
            WHERE
            `$this->mo_livestream`.livestream_id = ?";
            //echo $sql;die;

            $query = $this->db->query($sql, [$id]);
            return $query->getRowArray();
    }
    public function update_livestream($branch,$id,$params,$file){
        $this->db->transBegin();
        $bd = $this->db->table($this->mo_livestream);
        $filename = '';
        
        // Manage file if have new file
        if(empty($file['img_video']->getfilename())){
            $filename = $params['livestream_old_img'];
        }else{
            $filename = $file['img_video']->getRandomName();
        }
        
        // echo "<pre>";
	    // print_r($params); 
	    // die;

        
        $data =  [
            'livestream_name' => $params['livestreamname_th'],
            'livestream_url' => $params['livestreamname_url'],
            'livestream_img' => $filename,
            'livestream_status' => $params['status']
        ];
       
        try {
            $bd->where('livestream_id', $id);
            if($bd->update($data)){
                if(
                    (!empty($file['img_video']->getfilename()))&& //Check if have new file
                    ($file['img_video']->move(FCPATH.$this->path_fillmovies, $data['livestream_img']))&& // insert new file
                    (@unlink(set_realpath(FCPATH.$this->path_fillmovies."/".$params['livestream_old_img']))) //Delete old file
                    
                ){}
            }
                $this->db->transCommit();
                return true;
            }
         catch (\Exception $e)
         {
            $this->db->transRollback();
            return $e->getMessage();
                
         }
    }
  
}