<?php namespace App\Models;
use CodeIgniter\Model;

// defined('BASEPATH') or exit('No direct script access allowed');

class Manage_Model extends Model {

	protected $table_mo		= 'mo_movie';
	protected $table_mocate	= 'mo_category';

	protected $table_ma		= 'manga_subject';
	protected $table_macate	= 'manga_category';

	protected $table_ads	= 'ads';
	protected $table_user	= 'user';


	public function __construct() {
        parent::__construct();
        
        $db = \Config\Database::connect();
	}
	
	public function get_moviecategory()
	{
		$sql = "SELECT
					$this->table_mocate.category_id,
					$this->table_mocate.category_name as catename,
					$this->table_mocate.category_status,
					$this->table_mocate.category_seq,
					$this->table_mocate.branch_id
				FROM
				$this->table_mocate
				ORDER BY $this->table_mocate.category_id DESC
				LIMIT 5
				";

		$query = $this->db->query($sql);
		// echo json_encode($query->getResult());die;
    	return $query->getResultArray();
	}

	public function get_movie()
	{
		$sql = "SELECT
					$this->table_mo.movie_id,
					$this->table_mo.movie_thname,
					$this->table_mo.movie_enname
				FROM
					$this->table_mo
				LIMIT 5
				";

		$query = $this->db->query($sql);
		// echo json_encode($query->getResult());die;
    	return $query->getResultArray();
	}

	public function get_mangacategory()
	{
		$sql = "SELECT
					$this->table_macate.macategory_id,
					$this->table_macate.branch_id,
					$this->table_macate.macategory_name as catename
				FROM
					$this->table_macate
				ORDER BY $this->table_macate.macategory_id DESC
				LIMIT 5
				";

		$query = $this->db->query($sql);
		// echo json_encode($query->getResult());die;
    	return $query->getResultArray();
	}

	public function get_ads($branch_id)
	{
		$sql = "SELECT
					$this->table_ads.ads_id,
					$this->table_ads.ads_name,
					$this->table_ads.ads_picture,
					$this->table_ads.ads_url,
					$this->table_ads.ads_position
				FROM
					$this->table_ads
				WHERE $this->table_ads.branch_id = ?
				LIMIT 5
				";
				//echo $sql;die;
		$query = $this->db->query($sql, [$branch_id]);
    	return $query->getResultArray();
	}

}

?>