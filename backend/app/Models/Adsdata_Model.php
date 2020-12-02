<?php namespace App\Models;
use CodeIgniter\Model;

// defined('BASEPATH') or exit('No direct script access allowed');

class Adsdata_Model extends Model {

    protected $table	= 'ads';
    
	public function __construct() {
        parent::__construct();
        
        $db = \Config\Database::connect();
    }

	public function get_ads($branch_id, $search, $page=1)
	{
        $sql_where = "";
        if ($search!="") {
            $sql_where .= " AND CONCAT_WS('', $this->table.ads_name, $this->table.ads_position) LIKE '%$search%' ";
        }
        
        $sql = "SELECT
                    $this->table.ads_id,
                    $this->table.ads_name,
                    $this->table.ads_picture,
                    $this->table.ads_url,
                    $this->table.ads_position,
                    $this->table.branch_id
                FROM
                    $this->table
                WHERE $this->table.branch_id = '$branch_id' $sql_where
             ";
        
        $query = $this->db->query($sql);
		$total = count($query->getResultArray());
		$perpage = 20;

		return get_pagination($sql,$page,$perpage,$total);
    }

    public function get_ads_onid($id)
	{
        $sql = "SELECT
                    $this->table.ads_id,
                    $this->table.ads_name,
                    $this->table.ads_picture,
                    $this->table.ads_url,
                    $this->table.ads_position,
                    $this->table.branch_id
                FROM
                    $this->table
                WHERE $this->table.ads_id = ?
             ";
        
        $query = $this->db->query($sql, [$id]);
		// echo json_encode($query->getResult());die;
    	return $query->getRowArray();
    }
}