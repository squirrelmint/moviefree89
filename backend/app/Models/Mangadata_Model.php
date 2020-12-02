<?php namespace App\Models;
use CodeIgniter\Model;

// defined('BASEPATH') or exit('No direct script access allowed');

class Mangadata_Model extends Model {

	protected $table_cate		= 'manga_category';
	protected $table_cagroup 	= 'manga_categorygroup';
	protected $table_manga		= 'manga_subject';
	protected $table_episode 	= 'manga_episode';
	protected $table_episodeimg = 'manga_episodeimage';
	protected $table_episodeimg1 = 'manga_episodeimage1';
	protected $table_episodeimg2 = 'manga_episodeimage2';

	private $path_macover;

	public function __construct() {
        parent::__construct();
        
		$db = \Config\Database::connect();
		$this->path_macover = 'manga/cover';
    }

	public function get_category($branch)
	{

		$sql = "SELECT
					$this->table_cate.macategory_id,
					$this->table_cate.macategory_name
				FROM
					$this->table_cate
				WHERE $this->table_cate.branch_id = ?
				";

		$query = $this->db->query($sql,[$branch]);
		// echo json_encode($query->getResult());die;
    	return $query->getResultArray();
	}

	public function get_categorylist($branch, $search="", $page=1)
	{
		$sql_where = "";
        if ($search!="") {
            $sql_where .= " AND $this->table_cate.macategory_name LIKE '%$search%' ";
		}

		$sql = "SELECT
					$this->table_cate.macategory_id,
					$this->table_cate.macategory_name
				FROM
					$this->table_cate
				WHERE $this->table_cate.branch_id = '$branch' $sql_where
				";
		$query = $this->db->query($sql);
		$total = count($query->getResultArray());
		$perpage = 20;
		// return $query = $this->db->query($sql);
		// echo json_encode($query->getResult());die;
    	return get_pagination($sql,$page,$perpage,$total);
	}

	public function get_subjectlist($branch, $search, $page=1)
	{
		$sql_where = "";
        if ($search!="") {
            $sql_where .= " AND CONCAT_WS('', `$this->table_manga`.masubject_name_eng, `$this->table_manga`.masubject_name_thai, `$this->table_manga`.masubject_description, `$this->table_manga`.masubject_author) LIKE '%$search%' ";
		}

		$sql = "SELECT
					$this->table_manga.masubject_id,
					$this->table_manga.masubject_picture,
					$this->table_manga.masubject_name_eng,
					$this->table_manga.masubject_name_thai,
					$this->table_manga.masubject_description,
					$this->table_manga.masubject_author,
					$this->table_manga.masubject_create_datetime,
					$this->table_manga.masubject_status
				FROM
					$this->table_manga
				WHERE $this->table_manga.branch_id = '$branch' $sql_where
				ORDER BY $this->table_manga.masubject_id DESC
				";


		$query = $this->db->query($sql);
		$total = count($query->getResultArray());
		$perpage = 20;
		// echo json_encode($query->getResultArray());die;
    	return get_pagination($sql,$page,$perpage,$total);
	}

	public function get_categorygroup($branch,$id)
	{
		$sql = "SELECT
					$this->table_cagroup.macategorygroup_id,
					$this->table_cagroup.masubject_id,
					$this->table_cagroup.macategory_id,
					$this->table_cate.macategory_name
				FROM
					$this->table_cagroup
				LEFT JOIN $this->table_cate ON $this->table_cagroup.macategory_id = $this->table_cate.macategory_id
				WHERE $this->table_cagroup.masubject_id = $id
				";
		$query = $this->db->query($sql, [$branch]);
    	return $query->getResultArray();
	}	

	public function get_manga_on_id($manga_id)
	{
		$sql = "SELECT
					$this->table_manga.masubject_id,
					$this->table_manga.branch_id,
					$this->table_manga.masubject_name_eng,
					$this->table_manga.masubject_name_thai,
					$this->table_manga.masubject_description,
					$this->table_manga.masubject_author,
					$this->table_manga.masubject_create_datetime,
					$this->table_manga.masubject_status
				FROM
					$this->table_manga
				WHERE $this->table_manga.masubject_id = ?
				";
		$query = $this->db->query($sql, [$manga_id]);
		// echo json_encode($query->getResult());die;
    	return $query->getRowArray();
	}

	public function get_episode_on_id($ep_id)
	{
		$sql = "SELECT
					$this->table_episode.maepisode_id,
					$this->table_episode.masubject_id,
					$this->table_episode.maepisode_name_eng,
					$this->table_episode.maepisode_name_thai,
					$this->table_episode.maepisode_read,
					$this->table_episode.maepisode_create_datetime,
					$this->table_episode.maepisode_public_datetime,
					$this->table_episode.maepisode_status
				FROM
					$this->table_episode
				WHERE $this->table_episode.maepisode_id = ?
				";
		$query = $this->db->query($sql, [$ep_id]);
		// echo json_encode($query->getResult());die;
    	return $query->getRowArray();
	}

	public function get_episode_on_mangaid($manga_id, $search, $page=1)
	{
		$sql_where = "";
        if ($search!="") {
            $sql_where .= " AND CONCAT_WS('', `$this->table_episode`.maepisode_name_eng, `$this->table_episode`.maepisode_name_thai) LIKE '%$search%' ";
		}
		
		$sql = "SELECT
					$this->table_episode.maepisode_id,
					$this->table_episode.masubject_id,
					$this->table_episode.maepisode_name_eng,
					$this->table_episode.maepisode_name_thai,
					$this->table_episode.maepisode_read,
					$this->table_episode.maepisode_create_datetime,
					DATE_FORMAT($this->table_episode.maepisode_public_datetime, '%d %M %Y') as public_date,
					$this->table_episode.maepisode_status
				FROM
					$this->table_episode
				WHERE $this->table_episode.masubject_id = '$manga_id' $sql_where
				";
		$query = $this->db->query($sql);
		$total = count($query->getResultArray());
		$perpage = 20;

		return get_pagination($sql,$page,$perpage,$total);
		
	}

	public function get_episodeimg_on_epid($ep_id)
	{
		$sql = "SELECT
					$this->table_episodeimg.maepisodeimage_id,
					$this->table_episodeimg.maepisode_id,
					$this->table_episodeimg.maepisodeimage_path
				FROM
					$this->table_episodeimg
				WHERE $this->table_episodeimg.maepisode_id = ?
				";
		$query = $this->db->query($sql, [$ep_id]);
    	return $query->getResultArray();
	}

	public function get_editdata_category($branch,$id){

		$sql = "SELECT
			 `$this->table_cate`.macategory_name,
			 `$this->table_cate`.macategory_id
			 FROM
			 $this->table_cate
			 WHERE
			 `$this->table_cate`.macategory_id = ?";
			// echo $sql;die;
	
		$query = $this->db->query($sql, [$id]);
		return $query->getRowArray();
	
	}

	public function get_editdata_subject($branch,$id){

		$sql = "SELECT
			`$this->table_manga`.masubject_picture,
			`$this->table_manga`.masubject_name_eng,
			`$this->table_manga`.masubject_name_thai,
			`$this->table_manga`.masubject_description,
			`$this->table_manga`.masubject_author,
			`$this->table_manga`.masubject_create_datetime,
			`$this->table_manga`.masubject_status,
			`$this->table_manga`.masubject_id
			FROM
			$this->table_manga
			WHERE
			`$this->table_manga`.masubject_id = ?";
			// echo $sql;die;

		$query = $this->db->query($sql, [$id]);
		return $query->getRowArray();
	
	}

	public function get_categorygroup_onid($masubject_id){

		$sql = "SELECT
					`$this->table_cagroup`.macategorygroup_id
					FROM
					$this->table_cagroup
					WHERE
					`$this->table_cagroup`.masubject_id = ?";

		$query = $this->db->query($sql, [$masubject_id]);
		return $query->getResultArray();

 	}

	//เพิ่มข้อมูล
	public function savecategory_add($params,$branch)
   	{
		$this->db->transBegin();
       	$bd =  $this->db->table($this->table_cate);

	   	foreach($params['macategory_name'] as $value)
	   	{
           	$data[] =  [
				   	'macategory_name'=> $value,
                    'branch_id' => $branch
       		];

	   } 

	   try 
	   {
		   	if($bd->insertBatch($data)==true )
		   	{
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
	   
   	public function savesubject_add($params,$branch,$files)
   	{
	   	$bd =  $this->db->table($this->table_manga);
	   	$bd2 = $this->db->table($this->table_cagroup);

		$this->db->transBegin();

		if(!empty($params['masubject_url'])){
			$filename = $params['masubject_url'];
		}else{
			$filename = $files->getRandomName();
		}
		   
		$data =  	[
			'masubject_picture' => $filename,
			'masubject_name_eng'=> $params['masubject_name_eng'],
			'masubject_description'=> $params['masubject_description'],
			'masubject_author	'=> $params['masubject_author'],
			'masubject_status'=> $params['masubject_status'],
			'masubject_create_datetime' => $params['masubject_create_datetime'],
			'branch_id' => $branch
		];


	   	try 
	   	{

			if($bd->insert($data)==true){
				$masubject_id = $this->db->insertID();
				$macategorygroup_id = '';

				foreach($params['macategory_id'] as $value)
				{
					// $data2[] = 	[
					// 	'masubject_id' => $insert_id,
					// 	'macategory_id'=> $value,
					// 	'branch_id'=> $branch
					// ]; 

					$sql = "INSERT INTO $this->table_cagroup 
							(
								macategorygroup_id,
								masubject_id,
								macategory_id,
								branch_id
							)
							VALUES (
								'$macategorygroup_id',
								'$masubject_id',
								'$value',
								'$branch'
							)
							ON DUPLICATE KEY UPDATE
								masubject_id = '$masubject_id',
								macategory_id = '$value';";


					if( $this->db->query($sql) == FALSE  ){

						$this->db->transRollback();
						return false;

					}

				} 

				if( empty($params['masubject_url']) && $files->move(FCPATH.$this->path_macover, $data['masubject_picture']) )
				{

					$this->db->transCommit();
					return true;

				}
				else if( !empty($params['masubject_url']) ){

					$this->db->transCommit();
					return true;

				}
				else{

					$this->db->transRollback();
					return false;

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
	   
	public function update_category($params,$id)
	{
		$this->db->transBegin();

		$bd =  $this->db->table($this->table_cate);

		$data = [
				 'macategory_name'  => $params['macategory_name']
		];
	
		$bd->where('macategory_id', $id);

		try {
			if($bd->update($data)==true ){
				$this->db->transCommit();
				return true;
			}
		}
		catch (\Exception $e)
		{
			$this->db->transRollback();
			return $e->getMessage();
	
		}
	}
	
	public function update_subject($data,$updatedata,$insertdata,$deldata,$files,$oldpic)
	{

		$bd =  $this->db->table($this->table_manga);
		$bd_cat = $this->db->table($this->table_cagroup);
	
		$this->db->transBegin();

		if( !empty($files) ){
			$data['masubject_picture'] = $files->getRandomName();
		}else if( empty($data['masubject_picture'] ) ){
			$data['masubject_picture']  = $oldpic;
		}
	
		$subject_id = $data['masubject_id']; 
		unset($data['masubject_id']);

		$bd->where('masubject_id', $subject_id);

		try {

			if($bd->update($data)!=true ){
				$this->db->transRollback();
				return false;
			}

			if( !empty($files) && $files->move(FCPATH.$this->path_macover, $data['masubject_picture']) ){ 
                @unlink(set_realpath(FCPATH.$this->path_macover."/".$oldpic));
			}

			if(!empty($updatedata)){
				foreach($updatedata as $key => $up){
					$macategorygroup_id = $up['macategorygroup_id'];
					unset($up['macategorygroup_id']);
	
					$bd_cat->where('macategorygroup_id', $macategorygroup_id);
					if( $bd_cat->update($up)!=true ){
						$this->db->transRollback();
						return false;
					}
				}
			}
	
			if(!empty($deldata)){
				foreach($deldata as $key => $de){
					if( $bd_cat->delete(['macategorygroup_id' => $de['macategorygroup_id']])!=true ){
						$this->db->transRollback();
						return false;
					}
				}
			}
	
			if(!empty($insertdata)){
				if( $bd_cat->insertBatch($insertdata)!=true ){
					$this->db->transRollback();
					return false;
				}
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

   	//ลบข้อมูล
   	public function category_del($branch, $id)
   	{
	 	$bd = $this->db->table($this->table_cate);
		$bd->where('macategory_id', $id);

		try {
			if($bd->delete()==true ){
			return true;
			}
	 	}
	 		catch (\Exception $e)
	 	{
			return $e->getMessage();

	 	}	
   	}

  	public function subject_del($id)
   	{	  
		$this->db->transBegin();

		$bd_subject = $this->db->table($this->table_manga);
		$bd_group = $this->db->table($this->table_cagroup);
		$bd_episode = $this->db->table($this->table_episode);
		$bd_episodeimg = $this->db->table($this->table_episodeimg);
		$bd_episodeimg1 = $this->db->table($this->table_episodeimg1);
		$bd_episodeimg2 = $this->db->table($this->table_episodeimg2);

		$bd_subject->where('masubject_id', $id);	
		$bd_group->where('masubject_id', $id);
		$bd_episode->where('masubject_id', $id);

		$sql = "SELECT
					`$this->table_episode`.maepisode_id
				FROM
					$this->table_episode
				WHERE
					`$this->table_episode`.masubject_id = ?";

		$query = $this->db->query($sql, [$id]);
		$maepisode_id = '';
		if( $result = $query->getRowArray() ){
			$maepisode_id = $result['maepisode_id'];
		}

		$bd_episodeimg->where('maepisode_id', $maepisode_id);
		$bd_episodeimg1->where('maepisode_id', $maepisode_id);
		$bd_episodeimg2->where('maepisode_id', $maepisode_id);


		try {

			if(  $bd_episodeimg->delete()==true && $bd_episodeimg1->delete()==true && $bd_episodeimg2->delete()==true && $bd_group->delete()==true && $bd_episode->delete()==true && $bd_subject->delete()==true )
			{

				$this->db->transCommit();
				return true;	

			}else{

				$this->db->transRollback();
				return false;

			}

	 	}
	 		catch (\Exception $e)
	 	{

			$this->db->transRollback();
			return $e->getMessage();	

	 	}	
   	}
	public function increseView($id)
	{
		$sql = "Update $this->table_episode SET $this->table_episode.maepisode_read = $this->table_episode.maepisode_read+1 WHERE $this->table_episode.maepisode_id = $id";
		$this->db->transBegin();
		try {
			if( $this->db->query($sql) == FALSE  ){

				$this->db->transRollback();
				return false;
			}else{
				$this->db->transCommit();
				return true;
			}
		}
		catch (\Exception $e)
	 	{
			return $e->getMessage();
	 	}	

	}
}

?>