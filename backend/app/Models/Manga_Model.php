<?php namespace App\Models;
use CodeIgniter\Model;

// defined('BASEPATH') or exit('No direct script access allowed');

class Manga_Model extends Model {

    protected $table_cate	= 'manga_category';
	protected $table_manga	= 'manga_subject';
    protected $table_episode = 'manga_episode';
    protected $table_episodeimg = 'manga_episodeimage';
    protected $table_episodeimg1 = 'manga_episodeimage1';

    private $path_file;
    
    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        $this->path_file = "/manga/imgmanga/";
    }

    public function insert_data($params, $paramsimages)
    {
        $this->db->transBegin();

        $bd_manga =  $this->db->table($this->table_episode);
        $bd_image =  $this->db->table($this->table_episodeimg);
        $bd_image1 =  $this->db->table($this->table_episodeimg1);
        
        $data = [
            'masubject_id' => $params['masubject_id'],
            'maepisode_name_eng' => $params['maepisode_name_eng'],
            'maepisode_public_datetime' => $params['maepisode_public_datetime'],
            'maepisode_status' => $params['maepisode_status']
        ];

        // var_dump($paramsimages);die;
                
        try {

            if( $bd_manga->insert($data)==true ){
                $maepisode_id = $this->db->insertID();
                $maepisodeimage_id = '';

                $i=1; $dataimages=array();
                foreach ($paramsimages as $key => $value) {

                    if(!filter_var($value, FILTER_VALIDATE_URL)){

                        $manga_name = preg_replace('/[^A-Za-z0-9\-]/', '', $params['masubject_name_eng']);
                        $dir = strtolower(str_replace(' ', '', $manga_name))."/";

                        $split = explode(' ',$params['maepisode_name_eng']);
                        $csplit = count($split);

                        $ep = 'ep'.$split[$csplit - 1];

                        $filename = $value->getRandomName();
                        $newfile = $dir . $ep . '/' . $filename;

                        $sql = "INSERT INTO $this->table_episodeimg 
                                (
                                    maepisodeimage_id,
                                    maepisode_id,
                                    maepisodeimage_path,
                                    maepisodeimage_seq
                                )
                                VALUES (
                                    '$maepisodeimage_id',
                                    '$maepisode_id',
                                    '$newfile',
                                    '$i'
                                )
                                ON DUPLICATE KEY UPDATE
                                    maepisode_id = '$maepisode_id',
                                    maepisodeimage_path = '$filename', 
                                    maepisodeimage_seq = '$i';";
                        
                        
                        $dir = $dir . $ep;

                        // echo $params['masubject_name_eng'];die;

                        $files = $value;

                        if( $this->db->query($sql) && $files->move(FCPATH.$this->path_file.$dir, $filename) ){
                            // $this->db->transCommit();
                            $result = true;
                        }else{
                            $this->db->transRollback();
                            return "Insert Invalid";
                        }
                    
                    }else{

                        $sql = "INSERT INTO $this->table_episodeimg 
                                (
                                    maepisodeimage_id,
                                    maepisode_id,
                                    maepisodeimage_path,
                                    maepisodeimage_seq
                                )
                                VALUES (
                                    '$maepisodeimage_id',
                                    '$maepisode_id',
                                    '$value',
                                    '$i'
                                )
                                ON DUPLICATE KEY UPDATE
                                    maepisode_id = '$maepisode_id',
                                    maepisodeimage_path = '$value', 
                                    maepisodeimage_seq = '$i';";


                        if( $this->db->query($sql) ){
                            // $this->db->transCommit();
                            $result = true;
                        }else{
                            $this->db->transRollback();
                            return "Insert Invalid";
                        }
                        
                    }

                }

                if( $result == true ){
                    $this->db->transCommit();
                    return true;
                }

            }

        }
        catch (\Exception $e)
        {
            // throw new Exception("Error Insert user", 1);
            $this->db->transRollback();
            return $e->getMessage();
            
        }

    }

    public function update_data($data, $dataimages, $imgdata, $count)
    {
        $this->db->transBegin();

        // echo "<pre>";
        // var_dump($insertdata);die;
        $bd_episode =  $this->db->table($this->table_episode);
        $bd_image =  $this->db->table($this->table_episodeimg);
        $bd_image1 =  $this->db->table($this->table_episodeimg1);

        $masubject_name_eng = $data['masubject_name_eng'];
                
        try {

            $ep_id = $data['maepisode_id'];
            unset($data['maepisode_id']);
            unset($data['masubject_name_eng']);
            
            $bd_episode->where('maepisode_id', $ep_id);
            if( $bd_episode->update($data)==true ){

                $datakey = array_keys($imgdata);
                foreach ($dataimages as $key => $value) {

                    $maepisodeimage_id = '';
                    if( in_array( $key , $datakey) ){ 
                        $maepisodeimage_id = $imgdata[$key]['maepisodeimage_id']; 
                    }

                    $i = $key+1;

                    if(!filter_var($value, FILTER_VALIDATE_URL)){

                        $manga_name = preg_replace('/[^A-Za-z0-9\-]/', '', $masubject_name_eng);
                        $dir = strtolower(str_replace(' ', '', $manga_name))."/";

                        $split = explode(' ',$masubject_name_eng);
                        $csplit = count($split);

                        $ep = 'ep'.$split[$csplit - 1];

                        $filename = $value->getRandomName();
                        $newfile = $dir . $ep . '/' . $filename;

                        $sql = "INSERT INTO $this->table_episodeimg 
                                (
                                    maepisodeimage_id,
                                    maepisode_id,
                                    maepisodeimage_path,
                                    maepisodeimage_seq
                                )
                                VALUES (
                                    '$maepisodeimage_id',
                                    '$ep_id',
                                    '$newfile',
                                    '$i'
                                )
                                ON DUPLICATE KEY UPDATE
                                    maepisode_id = '$ep_id',
                                    maepisodeimage_path = '$newfile', 
                                    maepisodeimage_seq = '$i';";
                        
                        $dir = $dir . $ep;
                        $files = $value;

                        if( $this->db->query($sql) && $files->move(FCPATH.$this->path_file.$dir, $filename) ){
                            if( in_array( $key , $datakey) ){
                                $oldimg = $imgdata[$key]['maepisodeimage_path'];
                                @unlink(set_realpath(FCPATH.$this->path_file."/".$oldimg));
                            }
                        }else{
                            $this->db->transRollback();
                            return "Insert Invalid";
                        }
                    
                    }else{

                        $sql = "INSERT INTO $this->table_episodeimg 
                                (
                                    maepisodeimage_id,
                                    maepisode_id,
                                    maepisodeimage_path,
                                    maepisodeimage_seq
                                )
                                VALUES (
                                    '$maepisodeimage_id',
                                    '$ep_id',
                                    '$value',
                                    '$i'
                                )
                                ON DUPLICATE KEY UPDATE
                                    maepisode_id = '$ep_id',
                                    maepisodeimage_path = '$value', 
                                    maepisodeimage_seq = '$i';";

                                    // echo $sql;die;


                        if( $this->db->query($sql) ){
                            // $this->db->transCommit();
                            $result = true;
                        }else{
                            $this->db->transRollback();
                            return "Insert Invalid";
                        }
                        
                    }

                }

                
                if($count < count($imgdata)){
                    for($i=$count+1;$i<=count($imgdata);$i++){
                        $del_id = $imgdata[$i-1]['maepisodeimage_id'];

                        if( $bd_image->delete(['maepisodeimage_id' => $del_id])!=true && $bd_image1->delete(['maepisodeimage_id' => $del_id])!=true  ){
                            $this->db->transRollback();
                            return false;
                        }
                    }
                }


                $this->db->transCommit();
                return true;

            }

        }
        catch (\Exception $e)
        {
            // throw new Exception("Error Insert user", 1);
            $this->db->transRollback();
            return $e->getMessage();
            
        }

    }

    public function update_active($ep_id,$action)
    {
        $this->db->transBegin();
        $bd_episode =  $this->db->table($this->table_episode);

        $data = [ 'maepisode_status'=>$action ];

        try {
            
            $bd_episode->where('maepisode_id', $ep_id);
            if( $bd_episode->update($data)!=true ){
                $this->db->transRollback();
                return false;
            }

            $this->db->transCommit();
            return true;

        }
        catch (\Exception $e)
        {
            // throw new Exception("Error Insert user", 1);
            $this->db->transRollback();
            return $e->getMessage();
            
        }
    }

    public function del_data($ep_id)
    {
        $this->db->transBegin();

        $bd_episode =  $this->db->table($this->table_episode);
        $bd_image =  $this->db->table($this->table_episodeimg);
        $bd_image1 =  $this->db->table($this->table_episodeimg1);

        $bd_episode->where('maepisode_id', $ep_id);
        $bd_image->where('maepisode_id', $ep_id);
        $bd_image1->where('maepisode_id', $ep_id);

        try {
            
            if( $bd_episode->delete()==true && $bd_image->delete()==true && $bd_image1->delete()==true ){
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

    

}
?>