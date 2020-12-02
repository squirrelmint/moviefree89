<?php namespace App\Models;
use CodeIgniter\Model;

// defined('BASEPATH') or exit('No direct script access allowed');

class MovieReport_Model extends Model {

    protected $table_report	= 'movie_report';
    protected $table_source1	= 'mo_movie';
	// protected $table_manga	= 'mo_subject';
	// protected $table_episode = 'manga_episode';

	public function __construct() {
        parent::__construct();

        $db = \Config\Database::connect();
    }


    public function get_report($search,$branch, $limit, $start)
	{
        $sql_where = "";

        if ($search!="") {
            $sql_where .= " AND $this->table_source1.movie_thname  LIKE '%$search%' ";
        }

		$sql = "SELECT
					$this->table_report.moviereport_id,
                    $this->table_report.reason,
                    $this->table_source1.movie_id,
					$this->table_source1.movie_thname
				FROM
					$this->table_report
                LEFT JOIN
                    $this->table_source1
                ON  $this->table_report.movie_id = $this->table_source1.movie_id
                WHERE
                    $this->table_report.branch_id = $branch ".$sql_where."
                    GROUP BY `$this->table_source1`.movie_id
                    LIMIT ?, ?;"
                ;



		$query = $this->db->query($sql,[$start, $limit]);
    	return $query->getResultArray();
    }




}

?>