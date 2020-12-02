<?php namespace App\Models;
use CodeIgniter\Model;

// defined('BASEPATH') or exit('No direct script access allowed');

class Vdoads_Model extends Model {

	protected $table_vdoads		= 'mo_adsvideo';
	private $path_vdoads;

	public function __construct() {
        parent::__construct();
        
		$db = \Config\Database::connect();
		$this->path_vdoads = 'movie/adsvdo';
	}
	
	function insert_vdoads($params,$branch,$files)
	{
		$this->db->transBegin();
		$bd =  $this->db->table($this->table_vdoads);

		$filename = $files->getRandomName();

		$data =  	[
			'adsvideo_name' => $params['adsvideo_name'],
			'adsvideo_video'=> $filename,
			'adsvideo_status'=> $params['adsvideo_status'],
			'adsvideo_url'=> $params['adsvideo_url'],
			'branch_id' => $branch,
			'adsvideo_skip' =>  $params['adsvideo_skip']
		];

		try 
	   	{

			if($bd->insert($data)==true && $files->move(FCPATH.$this->path_vdoads, $data['adsvideo_video'])){

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

	function update_vdoads($params,$branch,$id,$files)
	{
		$this->db->transBegin();
		$bd =  $this->db->table($this->table_vdoads);
		$bd->where('adsvideo_id', $id);

		$data =  	[
			'adsvideo_name' => $params['adsvideo_name'],
			'adsvideo_status'=> $params['adsvideo_status'],
			'adsvideo_url'=> $params['adsvideo_url'],
			'adsvideo_skip' =>  $params['adsvideo_skip']
		];

		if(!empty($files->getName())){
			$data['adsvideo_video'] = $files->getRandomName();
		}

		try 
	   	{

			if($bd->update($data)==true ){

				if( !empty($files->getName()) && $files->move(FCPATH.$this->path_vdoads, $data['adsvideo_video']) ){

					@unlink(set_realpath(FCPATH.$this->path_vdoads."/".$params['oldfile']));
					$this->db->transCommit();
					return true;

				}

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

	function delete_vdoads($id,$files)
	{
		$this->db->transBegin();
		$bd =  $this->db->table($this->table_vdoads);
		$bd->where('adsvideo_id', $id);
		try 
	   	{

			if($bd->delete()==true && @unlink(set_realpath(FCPATH.$this->path_vdoads."/".$files)) ){

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