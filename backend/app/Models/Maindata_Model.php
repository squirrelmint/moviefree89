<?php namespace App\Models;
use CodeIgniter\Model;

// defined('BASEPATH') or exit('No direct script access allowed');

class Maindata_Model extends Model {

	protected $table      	= 'branch';
	protected $table_grant	= 'grant';
	protected $table_user	= 'user';

	protected $systemField 	= 'branch_system';

	public function __construct() {
        parent::__construct();
        
        $db = \Config\Database::connect();
    }

    public function get_system()
	{
		$sql = "SHOW COLUMNS FROM $this->table WHERE Field = '$this->systemField' ";
		$query = $this->db->query($sql);
		$result = $query->getRow();

		preg_match("/^enum\(\'(.*)\'\)$/", $result->Type, $matches);
    	$system = explode("','", $matches[1]);

    	return $system;
	}

	public function get_branch($user_id)
	{
		$ugrant = $_SESSION['ugrant'];

		$wh_uid = "";
		if($ugrant!=2){
			$wh_uid .= " INNER JOIN `$this->table_grant` ON `$this->table_grant`.branch_id = `$this->table`.branch_id";
			$wh_uid .= " INNER JOIN `$this->table_user` ON `$this->table_grant`.user_id = `$this->table_user`.user_id";
			$wh_uid .= " WHERE `$this->table_user`.user_id = '$user_id' ";
		}

		$sql = "SELECT
					`$this->table`.branch_id,
					`$this->table`.branch_name,
					`$this->table`.branch_logo,
					`$this->table`.branch_status
				FROM
					`$this->table`
				$wh_uid
				GROUP BY `$this->table`.branch_id
				";

		$query = $this->db->query($sql);
		// echo json_encode($query->getResult());die;
    	return $query->getResultArray();
	}

	public function get_branchid($branch_id)
	{
		$ugrant = $_SESSION['ugrant'];
		$user_id = $_SESSION['uid'];

		$wh_ugrant = "";
		if($ugrant!=2){
			$wh_ugrant = " AND `$this->table_user`.user_id = '$user_id' ";
		}

		$sql = "SELECT
					`$this->table`.branch_id,
					`$this->table`.branch_name,
					`$this->table`.branch_logo,
					`$this->table`.branch_system,
					`$this->table`.branch_status
				FROM
					`$this->table`
				INNER JOIN `$this->table_grant` ON `$this->table_grant`.branch_id = `$this->table`.branch_id 
				INNER JOIN `$this->table_user` ON `$this->table_grant`.user_id = `$this->table_user`.user_id
				WHERE `$this->table`.branch_id = '$branch_id' $wh_ugrant
				";
		$query = $this->db->query($sql);
    	return $query->getRowArray();
	}

}

?>