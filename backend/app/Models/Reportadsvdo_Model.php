<?php
namespace App\Models;

use CodeIgniter\Model;

class Reportadsvdo_Model extends Model {
    
    protected $table = 'reportadsvdo';
    protected $tableads = 'mo_adsvideo';
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
                    AND DATE_FORMAT(`$this->table`.reportadsvdo_datetime, '%Y-%m-%d') BETWEEN '$datestart' AND '$dateend'
                ";

        $query = $this->db->query($sql, [$branch]);
        
        return $query->getRowArray();

    }

    public function get_reportads($branch, $datestart, $dateend)
    {
        $sql = "SELECT
                    `$this->table`.*,
                    DATE_FORMAT(`$this->table`.reportadsvdo_datetime, '%Y-%m-%d') As columkey,
                    ads.adsvideo_name,
                    ads.adsvideo_url
                FROM
                    `$this->table`
                INNER JOIN `$this->tableads` ads ON ads.adsvideo_id = `$this->table`.adsvideo_id
                WHERE
                    `$this->table`.branch_id = ?
                    AND DATE_FORMAT(`$this->table`.reportadsvdo_datetime, '%Y-%m-%d') BETWEEN '$datestart' AND '$dateend'
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
                    `$this->table`.reportadsvdo_id,
                    ads.adsvideo_name,
                    COUNT(`$this->table`.reportadsvdo_id) as cads
                FROM
                    `$this->table`
                INNER JOIN `$this->tableads` ads ON ads.adsvideo_id = `$this->table`.adsvideo_id
                WHERE
                    `$this->table`.branch_id = ? 
                    AND DATE_FORMAT(`$this->table`.reportadsvdo_datetime, '%Y-%m-%d') BETWEEN '$datestart' AND '$dateend'
                GROUP BY 
                    `$this->table`.adsvideo_id
                ";
        // echo $sql;die;

        $query = $this->db->query($sql, [$branch]);
        $result = $query->getResultArray();

        $chart = array();
        if( !empty($result) ){
            $i=0;
            foreach($result as $val){
                $chart[] = array(
                    'ads'=>$val['adsvideo_name'], 
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