<?php

namespace App\Models;

use CodeIgniter\Model;

// defined('BASEPATH') or exit('No direct script access allowed');

class Moviedata_Model extends Model
{

    protected $table_cate    = 'mo_category';
    protected $table_source1    = 'mo_movie';
    protected $mo_moviecate = 'mo_moviecate';
    protected $mo_livestream = 'mo_livestream';
    private $path_fillmovies;

    // protected $table_manga	= 'mo_subject';
    // protected $table_episode = 'manga_episode';

    public function __construct()
    {
        parent::__construct();

        $db = \Config\Database::connect();
        $this->path_fillmovies = "img_movies";
    }

    public function count_user_page($search)
    {

        $sql_where = "";

        if ($search != "") {
            $sql_where .= " AND CONCAT_WS('', `$this->table`.user_name, `$this->table`.user_label, `$this->table`.user_email, `$this->table`.user_tel) LIKE '%$search%' ";
        }

        $sql = "SELECT count(user_id) as count_id FROM `$this->table` WHERE 1=1 " . $sql_where . ";";
        $query = $this->db->query($sql);
        return $query->getResult()[0]->count_id;
    }

    public function get_category_page($branch, $search, $page = 1)
    {
        // echo $search;die;
        $sql_where = "";

        if ($search != "") {
            $sql_where .= " AND CONCAT_WS('',`$this->table_cate`.category_name, `$this->table_cate`.category_status) LIKE '%$search%' ";
        }

        $sql = "SELECT
            $this->table_cate.category_id,
		    $this->table_cate.category_name,
            $this->table_cate.branch_id
            FROM
            `$this->table_cate`
            WHERE
            $this->table_cate.branch_id = $branch " . $sql_where . "
           " . $sql_where . "
            GROUP BY `$this->table`.category_id ";
        $query = $this->db->query($sql);
        $total = count($query->getResultArray());
        $perpage = 10;

        return get_pagination($sql, $page, $perpage, $total);
    }

    public function get_category()
    {
        $sql = "SELECT
					$this->table_cate.category_id,
					$this->table_cate.category_name
				FROM
					$this->table_cate
				";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function savecategory_add($params, $branch)
    {
        $bd =  $this->db->table($this->table_cate);
        $this->db->transBegin();

        // $data =  [
        //            'category_name' =>  $params['macategory_name'][0],
        //            'branch_id' => $branch
        //        ];

        foreach ($params['macategory_name'] as $value) {
            $data[] =  [
                'category_name' => $value,
                'branch_id' => $branch
            ];
        }
        //echo "<pre>"; print_r($data);die;
        try {
            if ($bd->insertBatch($data) == true) {
                $this->db->transCommit();
                return true;
            }
        } catch (\Exception $e) {
            // throw new Exception("Error Insert user", 1);
            $this->db->transRollback();
            return $e->getMessage();
        }
    }

    public function savevideo_add($params, $branch, $imgs)
    {
        // echo "<pre>";
        // print_r($imgs);die;
        if ($imgs->getName()=='') {
            $data['movie_picture'] = $params['videoname_url'];
        } else {
            $data['movie_picture'] = $imgs->getRandomName();
        }


        $bd =  $this->db->table($this->table_source1);

        $this->db->transBegin();
        $data =  [
            'movie_thname' => $params['videoname_th'],
            'movie_des' => $params['videoname_des'],
            'movie_picture' => $data['movie_picture'],
            'movie_year' => $params['videoname_year'],
            'movie_quality' => $params['quality'],
            'movie_sound' => $params['sound'],
            'movie_type' => $params['video_type'],
            'movie_ratescore' => $params['videoname_ratescore'],
            'movie_thmain' =>  $params['url_movieth_manin'],
            'movie_preview' =>  $params['triler_video'],
            'movie_enmain' => $params['url_movieen_manin'],
            'movie_thsub1' => $params['url_movieth_sub1'],
            'movie_thsub2' => $params['url_movieth_sub2'],
            'movie_ensub1' => $params['url_movieen_sub1'],
            'movie_ensub2' => $params['url_movieen_sub2'],
            'branch_id' => $branch
        ];
        try {

            if ($bd->insert($data)) {
                $movies_id = $this->db->insertID();
               
                foreach($params['category_choose'] as $cate_ids){
                    $sql = "INSERT INTO $this->mo_moviecate ( movie_id, category_id, branch_id) VALUES ('$movies_id', '$cate_ids', '$branch') ON DUPLICATE KEY UPDATE movie_id = '$id', category_id='$cate_ids';";
                    $query = $this->db->query($sql);
                }

                if (($imgs->getName()!='')  &&  $imgs->move(FCPATH.$this->path_fillmovies, $data['movie_picture'])) {
                    $this->db->transCommit();
                    return true;
                } else if (!empty($params['videoname_url'])) {
                    $this->db->transCommit();
                    return true;
                }
            }
        } catch (\Exception $e) {
            // throw new Exception("Error Insert user", 1);
            $this->db->transRollback();
            return $e->getMessage();
        }
    }


    public function get_editdata_category($id)
    {
        // echo $id;die;
        $sql = "SELECT
            `$this->table_cate`.category_name,
            `$this->table_cate`.category_id
            FROM
            `$this->table_cate`
            WHERE
            `$this->table_cate`.category_id = ?";
        // echo $sql;die;

        $query = $this->db->query($sql, [$id]);

        return $query->getRowArray();
    }
    public function update_category($params, $id)
    {

        $bd =  $this->db->table($this->table_cate);
        $this->db->transBegin();
        $data = [
            'category_name'  => $params['macategory_name']
        ];

        $bd->where('category_id', $id);
        try {
            if ($bd->update($data) == true) {
                $this->db->transCommit();
                return true;
            }
        } catch (\Exception $e) {
            $this->db->transRollback();
            return $e->getMessage();
        }
    }

    public function del_category($id)
    {
        //echo $id;die;
        $bd =  $this->db->table($this->table_cate);
        $bd->where('category_id', $id);

        try {
            if ($bd->delete() == true) {
                return true;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



    //********************************************* Movie  Table source 1  ******************************************************** //

    public function get_video($branch, $search, $page = 1)
    {
        // echo $search;die;
        $sql_where = "";

        if ($search != "") {
            $sql_where .= " AND CONCAT_WS('',`$this->table_source1`.movie_thname, 
                                              `$this->table_source1`.movie_enname,
                                              `$this->table_source1`.movie_picture,
                                              `$this->table_source1`.movie_des,
                                              `$this->table_source1`.movie_year,
                                              `$this->table_source1`.movie_quality
                                              ) LIKE '%$search%' ";
        }

        $sql = "SELECT
            $this->table_source1.movie_id,
					$this->table_source1.movie_thname,
                    $this->table_source1.movie_enname,
                    $this->table_source1.movie_des,
                    `$this->table_source1`.movie_picture,
                    $this->table_source1.movie_year,
                    $this->table_source1.movie_quality,
                    $this->table_source1.movie_sound,
                    $this->table_source1.movie_ratescore,
                    $this->table_source1.branch_id
             FROM
             $this->table_source1
             WHERE
             $this->table_source1.branch_id = $branch " . $sql_where . "
             ORDER BY $this->table_source1.movie_id DESC ";

        $query = $this->db->query($sql);
        $total = count($query->getResultArray());
        $perpage = 20;

        return get_pagination($sql, $page, $perpage, $total);
    }
    public function get_editdata_video($id)
    {
        //echo $id;die;
        $sql = "SELECT
                    $this->table_source1.*
                 
                FROM
                    $this->table_source1
                WHERE
             `$this->table_source1`.movie_id = ?";
        //echo $sql;die;

        $query = $this->db->query($sql, [$id]);

        return $query->getRowArray();
    }
    public function get_category_onmovie($id)
    {
        $sql = "SELECT
					$this->mo_moviecate.category_id
				FROM
					$this->mo_moviecate
                WHERE $this->mo_moviecate.movie_id = $id
				";
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
    public function update_video($branch, $id, $params, $imgs, $fileold)
    {
        //    echo "<pre>";
        //     print_r($params['category_choose']);die;
        if ($imgs->getName()!='') {
            $data['movie_picture'] = $imgs->getRandomName();
        } else if($params['videoname_url']!=''){
            $data['movie_picture'] = $params['videoname_url'];
        }else{
            $data['movie_picture'] = $fileold;
        }

        $bd = $this->db->table($this->table_source1);


        $this->db->transBegin();
        $data =  [
            'movie_thname' => $params['videoname_th'],
            'movie_des' => $params['videoname_des'],
            'movie_picture' => $data['movie_picture'],
            'movie_year' => $params['videoname_year'],
            'movie_quality' => $params['quality'],
            'movie_type' => $params['video_type'],
            'movie_sound' => $params['sound'],
            'movie_ratescore' => $params['videoname_ratescore'],
            'movie_thmain' => $params['url_movieth_manin'],
            'movie_preview' => $params['triler_video'],
            'movie_enmain' => $params['url_movieen_manin'],
            'movie_thsub1' => $params['url_movieth_sub1'],
            'movie_thsub2' => $params['url_movieth_sub2'],
            'movie_ensub1' => $params['url_movieen_sub1'],
            'movie_ensub2' => $params['url_movieen_sub2'],
            'branch_id' => $branch
        ];

        try {
            $bd->where('movie_id', $id);
            if ($bd->update($data)) {
                if($imgs->getName()!=''){
                    $imgs->move(FCPATH.$this->path_fillmovies, $data['movie_picture']);
                }
                if(
                    (substr($fileold,0,4)!='http')&&
                    ($data['movie_picture']!=$fileold)
                  )
                {
                    @unlink(set_realpath(FCPATH.$this->path_fillmovies."/".$params['livestream_old_img']));
                }
            }

            foreach($params['category_choose'] as $cate_ids){
                $sql = "INSERT INTO $this->mo_moviecate ( movie_id, category_id, branch_id) VALUES ('$id', '$cate_ids', '$branch') ON DUPLICATE KEY UPDATE movie_id = '$id', category_id='$cate_ids';";
                $query = $this->db->query($sql);
            }

          

            $this->db->transCommit();
            return true;
        } catch (\Exception $e) {
            $this->db->transRollback();
            return $e->getMessage();
        }
    }


    public function video_del($id)
    {
        $bd =  $this->db->table($this->table_source1);
        $bd->where('movie_id', $id);
        try {
            if ($bd->delete() == true) {
                return true;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_img_video($id)
    {
        $sql = "SELECT
                   movie_picture
               FROM
                   $this->table_source1
               WHERE
            `$this->table_source1`.movie_id = ?";
        $query = $this->db->query($sql, [$id]);

        return $query->getRowArray();
    }

    public function get_link_video1($id)
    {
        $sql = "SELECT
                   movie_source1
               FROM
                   $this->movies_source1
               WHERE
            `$this->movies_source1`.movie_id = ?";
        $query = $this->db->query($sql, [$id]);

        return $query->getRowArray();
    }
    public function get_link_video2($id)
    {
        $sql = "SELECT
                   movie_source1
               FROM
                   $this->movies_source2
               WHERE
            `$this->movies_source2`.movie_id = ?";
        $query = $this->db->query($sql, [$id]);

        return $query->getRowArray();
    }
    public function get_link_video3($id)
    {
        $sql = "SELECT
                   movie_source1
               FROM
                   $this->movies_source3
               WHERE
            `$this->movies_source3`.movie_id = ?";
        $query = $this->db->query($sql, [$id]);

        return $query->getRowArray();
    }

    public function get_fileold($id)
    {
        $sql = "SELECT
                   movie_picture
               FROM
                   $this->table_source1
               WHERE
            `$this->table_source1`.movie_id = ?";
        $query = $this->db->query($sql, [$id]);

        return $query->getRowArray();
    }
}
