<?php
namespace App\Models;

use CodeIgniter\Model;

class Requestads_Model extends Model {
    protected $mo_adscontact = 'mo_adscontact';
    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }
    public function get_requestads($branch, $search, $page = 1)
    {
        // echo $search;die;
        $sql_where = "";

        if ($search != "") {
            $sql_where .= " AND CONCAT_WS('',$this->mo_adscontact.mo_adscontact_namesurname,$this->mo_adscontact.mo_adscontact_email,$this->mo_adscontact.mo_adscontact_lineid,$this->mo_adscontact.mo_adscontact_phone) LIKE '%$search%' ";
        }

        $sql = "SELECT
            $this->mo_adscontact.mo_adscontact_id,
					$this->mo_adscontact.mo_adscontact_namesurname,
                    $this->mo_adscontact.mo_adscontact_email,
                    $this->mo_adscontact.mo_adscontact_lineid,
                    $this->mo_adscontact.mo_adscontact_phone,
                    $this->mo_adscontact.mo_adscontact_branch_id
             FROM
             $this->mo_adscontact 
             WHERE $this->mo_adscontact.mo_adscontact_branch_id =  ".$branch . $sql_where . "
             ORDER BY $this->mo_adscontact.mo_adscontact_id DESC ";

        $query = $this->db->query($sql);
        $total = count($query->getResultArray());
        $perpage = 20;

        return get_pagination($sql, $page, $perpage, $total);
    }
    public function del_requestads($branch, $id)
    {
        $data = [
            'mo_adscontact_branch_id' => $branch,
            'mo_adscontact_id' => $id
        ];
        $bd =  $this->db->table($this->mo_adscontact);
        $bd->where($data);
        try {
            if ($bd->delete() == true) {
                return true;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}