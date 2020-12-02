<?php
namespace App\Models;

use CodeIgniter\Model;

class Contact_Model extends Model {
    protected $mo_contact = 'mo_contact';
    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
    }
    public function get_contact($branch, $search, $page = 1)
    {
        // echo $search;die;
        $sql_where = "";

        if ($search != "") {
            $sql_where .= " AND CONCAT_WS('',$this->mo_contact.mo_contact_data) LIKE '%$search%' ";
        }

        $sql = "SELECT
            $this->mo_contact.mo_contact_id,
					$this->mo_contact.mo_contact_data
             FROM
             $this->mo_contact 
             WHERE $this->mo_contact.mo_contact_branch_id =  ".$branch . $sql_where . "
             ORDER BY $this->mo_contact.mo_contact_id DESC ";
        $query = $this->db->query($sql);
        $total = count($query->getResultArray());
        $perpage = 20;

        return get_pagination($sql, $page, $perpage, $total);
    }
    public function del_contact($branch, $id)
    {
        $data = [
            'mo_contact_branch_id' => $branch,
            'mo_contact_id' => $id
        ];
        $bd =  $this->db->table($this->mo_contact);
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