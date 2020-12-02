<?php namespace App\Models;
use CodeIgniter\Model;

// defined('BASEPATH') or exit('No direct script access allowed');

class MangaReport_Model extends Model {

    protected $table_report	= 'manga_report';
    protected $table_manga	= 'manga_subject';
    protected $table_ep	= 'manga_episode';
	// protected $table_episode = 'manga_episode';
	public function __construct() {
        parent::__construct();

        $db = \Config\Database::connect();
    }


    public function get_report($search,$branch)
	{
        $sql_where = "";

        if ($search!="") {
            $sql_where .= " AND $this->table_ep.maepisode_name_eng  LIKE '%$search%' ";
        }


		$sql = "SELECT
                    $this->table_report.mareport_id,
					$this->table_report.branch_id,
                    $this->table_report.maepisode_id,
                    $this->table_report.mareport_datetime,
                    $this->table_manga.masubject_id,
                    $this->table_manga.masubject_name_eng,
                    $this->table_ep.maepisode_name_eng
				FROM
					$this->table_report
                LEFT JOIN
                    $this->table_ep ON  $this->table_ep.maepisode_id = $this->table_report.maepisode_id
                LEFT JOIN
                    $this->table_manga ON  $this->table_manga.masubject_id = $this->table_ep.masubject_id
                WHERE
                    $this->table_report.branch_id = $branch ".$sql_where."";


        // echo $sql;die;
		$query = $this->db->query($sql);
    	return $query->getResultArray();
    }


    public function report_del($id)
    {
      $bd = $this->db->table($this->table_report);
     $bd->where('mareport_id', $id);

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
