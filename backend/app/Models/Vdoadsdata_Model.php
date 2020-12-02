<?php namespace App\Models;
use CodeIgniter\Model;

// defined('BASEPATH') or exit('No direct script access allowed');

class Vdoadsdata_Model extends Model {

	protected $table_vdoads		= 'mo_adsvideo';
	private $path_vdoads;

	public function __construct() {
        parent::__construct();
        
		$db = \Config\Database::connect();
		$this->path_macover = 'movie/adsvdo';
	}

	function get_adsvideolist($branch_id, $search, $page=1)
	{
		$sql_where = "";
        if ($search!="") {
            $sql_where .= " AND $this->table_vdoads.adsvideo_name LIKE '%$search%' ";
		}

		$sql = "SELECT 
					$this->table_vdoads.adsvideo_id,
					$this->table_vdoads.adsvideo_name,
					$this->table_vdoads.adsvideo_video,
					$this->table_vdoads.adsvideo_status,
					$this->table_vdoads.adsvideo_url,
					$this->table_vdoads.branch_id,
					$this->table_vdoads.adsvideo_skip
				FROM
					$this->table_vdoads
				WHERE $this->table_vdoads.branch_id = '$branch_id' $sql_where
				";
				
		$query = $this->db->query($sql);
		$total = count($query->getResultArray());
		$perpage = 20;
		// return $query = $this->db->query($sql);
		// echo json_encode($query->getResult());die;
    	return get_pagination($sql,$page,$perpage,$total);
	}
	
	function get_adsvideo_on_id($branch_id,$id)
	{
		$sql = "SELECT 
					$this->table_vdoads.adsvideo_id,
					$this->table_vdoads.adsvideo_name,
					$this->table_vdoads.adsvideo_video,
					$this->table_vdoads.adsvideo_status,
					$this->table_vdoads.adsvideo_url,
					$this->table_vdoads.branch_id,
					$this->table_vdoads.adsvideo_skip
				FROM
					$this->table_vdoads
				WHERE $this->table_vdoads.branch_id = ? AND $this->table_vdoads.adsvideo_id = ?
				";
		$query = $this->db->query($sql, [$branch_id,$id]);
		return $query->getRowArray();
	}

}

?>