<?php namespace App\Models;
use CodeIgniter\Model;

// defined('BASEPATH') or exit('No direct script access allowed');

class MangaRequest_Model extends Model {

    protected $table_request	= 'manga_request';
	public function __construct() {
        parent::__construct();

        $db = \Config\Database::connect();
    }


    public function get_request($search,$branch)
	{
        $sql_where = "";

        if ($search!="") {
            $sql_where .= " AND REPLACE(' ', '', $this->table_request.marequest_manga)  LIKE REPLACE(' ', '', '%$search%') ";
        }

		$sql = "SELECT
                    $this->table_request.marequest_id,
					$this->table_request.marequest_manga,
                    $this->table_request.marequest_ip,
                    $this->table_request.marequest_datetime
				FROM
					$this->table_request
                WHERE
                    $this->table_request.branch_id = $branch ".$sql_where."";

        // echo $sql;die;
		$query = $this->db->query($sql);
    	return $query->getResultArray();
    }


    public function request_del($id)
    {
        $bd = $this->db->table($this->table_request);
        $bd->where('marequest_id', $id);

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

}

?> 
