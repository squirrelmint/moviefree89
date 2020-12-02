<?php
namespace App\Models;

use CodeIgniter\Model;

class Content_Model extends Model {
    protected $path_fillmovies;
    protected $mo_content = 'content';
    public function __construct()
    {
        parent::__construct();

        $db = \Config\Database::connect();
        $this->path_fillmovies = "img_content";
    }
    public function get_contents($branch, $search, $page = 1)
    {
        // echo $search;die;
        $sql_where = "";

        if ($search != "") {
            $sql_where .= " AND CONCAT_WS('',$this->mo_content.content_head) LIKE '%$search%' ";
                                              
        }

        $sql = "SELECT
            $this->mo_content.content_id,
					$this->mo_content.content_head,
                    $this->mo_content.content_thumbnail,
                    $this->mo_content.content_body,
                    $this->mo_content.branch_id
             FROM
             $this->mo_content 
             WHERE $this->mo_content.branch_id =  ".$branch . $sql_where . "
             ORDER BY $this->mo_content.content_id DESC ";

        $query = $this->db->query($sql);
        $total = count($query->getResultArray());
        $perpage = 20;

        return get_pagination($sql, $page, $perpage, $total);
    }
    public function saveContent($params,$branch,$imgs)
    {
        $this->db->transBegin();
        $bd =  $this->db->table($this->mo_content);
       
        $fileName = $imgs->getRandomName();
        $htmlcode = htmlentities(htmlspecialchars($params['ckeditor']));
       
        $data =  [
            'content_head' => $params['txthead'],
            'content_thumbnail' => $fileName,
            'content_body' => $htmlcode,
            'branch_id' => $branch
        ];
        try {

            if ($bd->insert($data)) {
                if (($imgs->getName()!='')  &&  $imgs->move(FCPATH.$this->path_fillmovies, $data['content_thumbnail'])) {
                    $this->db->transCommit();
                    return true;
                }else{
                    $this->db->transRollback();
                    return 'Must be insert file';
                }
            }
        } catch (\Exception $e) {
            // throw new Exception("Error Insert user", 1);
            $this->db->transRollback();
            return $e->getMessage();
        }
    }
    public function getEditcontent($id)
    {
        $sql = "SELECT
        content_head,
        content_thumbnail,
        content_body,
        branch_id 
        FROM
        $this->mo_content
        WHERE
        `$this->mo_content`.content_id = ?";
        //echo $sql;die;

        $query = $this->db->query($sql, [$id]);
        return $query->getRowArray();
    }
    public function updateContent($params,$branch,$img,$id)
    {
        $this->db->transBegin();
        $bd = $this->db->table($this->mo_content);

        $htmlcode = htmlentities(htmlspecialchars($params['ckeditor']));
        $filename = '';
        
        // Manage file if have new file
        if(empty($img->getfilename())){
            $filename = $params['oldfile'];
        }else{
            $filename =$img->getRandomName();
        }

        $data =  [
            'content_head' => $params['txthead'],
            'content_thumbnail' => $filename,
            'content_body' => $htmlcode
        ];

        try {
            $bd->where('content_id', $id);
            if($bd->update($data)){
                if(
                    (!empty($img->getfilename()))&& //Check if have new file
                    ($img->move(FCPATH.$this->path_fillmovies, $data['content_thumbnail']))&& // insert new file
                    (@unlink(set_realpath(FCPATH.$this->path_fillmovies."/".$params['oldfile']))) //Delete old file
                    
                ){}
            }
                $this->db->transCommit();
                return true;
            }
         catch (\Exception $e)
         {
            $this->db->transRollback();
            return $e->getMessage();
                
         }
    }
    public function deleteContent($branch, $id)
    {
        $sql = "SELECT
        $this->mo_content.content_id,
        $this->mo_content.content_thumbnail
         FROM
         $this->mo_content
         WHERE
         $this->mo_content.branch_id = $branch 
         AND
         $this->mo_content.content_id = $id 
         GROUP BY $this->mo_content.content_id LIMIT 1";
         //echo $sql;die;
         $query = $this->db->query($sql);
         $files = $query->getResultArray()[0]['content_thumbnail'];   
        $this->db->transBegin();
		$bd =  $this->db->table($this->mo_content);
		$bd->where('content_id', $id);
		try 
	   	{
			if($bd->delete()==true && @unlink(set_realpath(FCPATH.$this->path_fillmovies."/".$files)) ){
				$this->db->transCommit();
				return true;
			}else{
				$this->db->transRollback();
				return false;
			}
		} 
		catch (\Exception $e) 
		{
           // throw new Exception("Error Insert user", 1);
		   $this->db->transRollback();
		   return $e->getMessage();
        }
    }
}