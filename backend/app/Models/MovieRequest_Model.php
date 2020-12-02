<?php namespace App\Models;
use CodeIgniter\Model;

// defined('BASEPATH') or exit('No direct script access allowed');

class MovieRequest_Model extends Model {

    protected $table_request	= 'mo_request';

	public function __construct() {
        parent::__construct();

        $db = \Config\Database::connect();
    }


    public function get_request($branch)
	{

		$sql = "SELECT
					$this->table_request.mo_request_id,
                    $this->table_request.mo_request,
                    $this->table_request.branch_id,
					DATE_FORMAT($this->table_request.mo_request_datetime, '%d %M %Y %H:%i') As requestdate
				FROM
					$this->table_request
                WHERE
                    $this->table_request.branch_id = '$branch'
                ";

		$query = $this->db->query($sql);
    	return $query->getResultArray();
    }

    public function delete_data($id)
    {
        $builder = $this->db->table($this->table_request);
        $builder->where('mo_request_id', $id);

        try {
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

?>