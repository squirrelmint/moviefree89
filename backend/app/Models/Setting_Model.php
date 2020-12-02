<?php
namespace App\Models;

use CodeIgniter\Model;

class Setting_Model extends Model {
    
    protected $table = 'setting';
    private $path_fileseting;
    
    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        $this->path_filesetting = "setting";
    }

    public function get_setting($branch)
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

    public function update_setting($branch, $data, $logo, $icon)
    {
        extract($data);

        $setting_logo = $oldlogo;
        if( !empty($logo->getName()) ){
            $setting_logo = $logo->getRandomName();
        }

        $setting_icon = $oldicon;
        if( !empty($icon->getName()) ){
            $setting_icon = $icon->getRandomName();
        }

        if( !empty($setting_header) ){
            $setting_header = base64_encode($setting_header);
        }

        if( !empty($setting_footer) ){
            $setting_footer = base64_encode($setting_footer);
        }

        $sql = "INSERT INTO $this->table 
                (
                    setting_id,
                    branch_id,
                    setting_title,
                    setting_description,
                    setting_keyword,
                    setting_logo,
                    setting_icon,
                    setting_fb,
                    setting_line,
                    setting_header,
                    setting_footer
                )
                VALUES (
                    '$setting_id',
                    '$branch',
                    '$setting_title',
                    '$setting_description',
                    '$setting_keyword',
                    '$setting_logo',
                    '$setting_icon',
                    '$setting_facebook',
                    '$setting_line',
                    '$setting_header',
                    '$setting_footer'
                )
                ON DUPLICATE KEY UPDATE
                    branch_id = '$branch',
                    setting_title = '$setting_title',
                    setting_description = '$setting_description',
                    setting_keyword = '$setting_keyword',
                    setting_logo = '$setting_logo',
                    setting_icon = '$setting_icon',
                    setting_fb = '$setting_facebook',
                    setting_line = '$setting_line',
                    setting_header = '$setting_header',
                    setting_footer = '$setting_footer';";
                    
        try {

            if(  
                (!empty($logo->getName()) && $logo->move(FCPATH.$this->path_filesetting, $setting_logo) ) || 
                (!empty($icon->getName()) && $icon->move(FCPATH.$this->path_filesetting, $setting_icon) ) 
            ){
                if( $this->db->query($sql)==true ){
                    if (!empty($logo->getName()) && !empty($oldlogo)) {
                        @unlink(set_realpath(FCPATH.$this->path_filesetting."/".$oldlogo));
                    }

                    if (!empty($icon->getName()) && !empty($oldicon)) {
                        @unlink(set_realpath(FCPATH.$this->path_filesetting."/".$oldicon));
                    }
                    return true;
                }
            }else if( $this->db->query($sql)==true ){
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
