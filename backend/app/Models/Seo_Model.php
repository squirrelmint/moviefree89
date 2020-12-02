<?php
namespace App\Models;

use CodeIgniter\Model;

class Seo_Model extends Model {
    
    protected $table = 'seo';
    private $path_fileseting;
    
    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
    }

    public function get_seo($branch)
    {
        $sql = "SELECT
            *
            FROM
            $this->table
            WHERE
            `$this->table`.branch_id = ?";

        $query = $this->db->query($sql, [$branch]);

        return $query->getRowArray();

    }

    public function update_seo($branch, $data)
    {
        extract($data);

        $sql = "INSERT INTO $this->table 
                (
                    seo_id,
                    branch_id,
                    seo_title,
                    seo_description,
                    seo_sitemap
                )
                VALUES (
                    '$seo_id',
                    '$branch',
                    '$seo_title',
                    '$seo_description',
                    '$seo_sitemap'
                )
                ON DUPLICATE KEY UPDATE
                    branch_id = '$branch',
                    seo_title = '$seo_title', 
                    seo_description = '$seo_description',
                    seo_sitemap = '$seo_sitemap';";

                    
        try {

            if( $this->db->query($sql)==true ){
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
