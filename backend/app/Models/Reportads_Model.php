<?php
namespace App\Models;

use CodeIgniter\Model;

class Reportads_Model extends Model {
    
    protected $table = 'reportads';
    protected $tableads = 'ads';
    private $path_fileseting;
    
    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    public function get_countreportads($branch, $datestart, $dateend)
    {
        $sql = "SELECT
                    COUNT(*) as cads
                FROM
                    `$this->table`
                WHERE
                    `$this->table`.branch_id = ?
                    AND DATE_FORMAT(`$this->table`.reportads_datetime, '%Y-%m-%d') BETWEEN '$datestart' AND '$dateend'
                ";

        $query = $this->db->query($sql, [$branch]);
        
        return $query->getRowArray();

    }

    public function get_reportads($branch, $datestart, $dateend)
    {
        $sql = "SELECT
                    `$this->table`.*,
                    DATE_FORMAT(`$this->table`.reportads_datetime, '%Y-%m-%d') As columkey,
                    ads.ads_name,
                    ads.ads_url
                FROM
                    `$this->table`
                INNER JOIN `$this->tableads` ads ON ads.ads_id = `$this->table`.ads_id
                WHERE
                    `$this->table`.branch_id = ?
                    AND DATE_FORMAT(`$this->table`.reportads_datetime, '%Y-%m-%d') BETWEEN '$datestart' AND '$dateend'
                ";

        $query = $this->db->query($sql, [$branch]);
        $result = $query->getResultArray();

        $reportads = array();
        if(!empty($result)){
            foreach($result as $val){
                $reportads[$val['columkey']][] = $val;
            }
        }

        krsort($reportads);
        // echo $sql;die;
        // echo json_encode($reportads);die;

        return $reportads;

    }

    public function get_chart_on_month($branch, $datestart, $dateend)
    {

        $sql = "SELECT
                    `$this->table`.ads_id,
                    ads.ads_name,
                    COUNT(`$this->table`.ads_id) as cads
                FROM
                    `$this->table`
                INNER JOIN `$this->tableads` ads ON ads.ads_id = `$this->table`.ads_id
                WHERE
                    `$this->table`.branch_id = ? 
                    AND DATE_FORMAT(`$this->table`.reportads_datetime, '%Y-%m-%d') BETWEEN '$datestart' AND '$dateend'
                GROUP BY 
                    `$this->table`.ads_id
                ";
        // echo $sql;die;

        $query = $this->db->query($sql, [$branch]);
        $result = $query->getResultArray();

        $chart = array();
        if( !empty($result) ){
            $i=0;
            foreach($result as $val){
                $chart[] = array(
                    'ads'=>$val['ads_name'], 
                    'value'=>$val['cads'], 
                    'color' => $i
                );
                $i++;
            }
        }

        return $chart;

    }
}

?>
