<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Content_Model;

class Content extends Controller
{
    protected $validation;
    protected $session;
    private $path_content;
    private $path_fillmovies;
    protected $Content_Model;

    public function __construct()
    {

        $this->validation =  \Config\Services::validation();
        $this->session = \Config\Services::session();

        $this->Content_Model = new Content_Model();

        $this->path_content = "/content/";
        $this->path_fillmovies = "img_content/";
        helper(['filesystem', 'url', 'alert', 'checklogin', 'pagination']);
    }

    public function index($branch_id, $search = "")
    {
        if (checkLogin() == false) {
            return redirect()->to('/login');
        }

        $nav = [
            'module_name' => 'Edit Content',
            'module_level' => array(
                array('name' => "Home", 'url' => "/"),
                array('name' => "Branch", 'url' => "/management/branch/" . $branch_id),
                array('name' => "Content", 'url' => "#")
            )
        ];
        $branchdata = $this->Content_Model->get_contents($branch_id, $search, 1);
        $data = [
            'branch' => $branch_id,
            'data' => $branchdata['list'],
            'paginate' => $branchdata,
            'filepath' => $this->path_fillmovies,
            'search_string' => $search
        ];

        echo view('template/header');
        echo view('template/body', $nav);
        echo view('contentlist', $data);
        echo view('template/footer');
    }

    public function edit($branch_id, $id)
    {

        if (checkLogin() == false) {
            return redirect()->to('/login');
        }

        $nav = [
            'module_name' => 'Edit Content',
            'module_level' => array(
                array('name' => "Home", 'url' => "/"),
                array('name' => "Branch", 'url' => "/management/branch/" . $branch_id),
                array('name' => "Content", 'url' => "/content/branch/" . $branch_id . "/content/index"),
                array('name' => "Edit Content", 'url' => "#")
            )
        ];

        $data = [
            'branch' => $branch_id,
            'id'=>$id,
            'data' => $this->Content_Model->getEditcontent($id),
            'filepath' => $this->path_fillmovies
        ];

        echo view('template/header');
        echo view('template/body', $nav);
        echo view('contentedit', $data);
        echo view('template/footer');
    }

    public function add($branch_id)
    {

        if (checkLogin() == false) {
            return redirect()->to('/login');
        }
        // echo "<pre>";
        // print_r($branch_id); 
        // die;
        $nav = [
            'module_name' => 'Add Content',
            'module_level' => array(
                array('name' => "Home", 'url' => "/"),
                array('name' => "Branch", 'url' => "/management/branch/" . $branch_id),
                array('name' => "Content", 'url' => "/content/branch/" . $branch_id . "/content/index"),
                array('name' => "Add Content", 'url' => "#")
            )
        ];

        $data = [
            'branch' => $branch_id
        ];

        echo view('template/header');
        echo view('template/body', $nav);
        echo view('contentadd', $data);
        echo view('template/footer');
    }

    public function saveadd($branch)
    {
        // echo "<pre>";
        // print_r($this->request->getFiles()); 
        // die;
        $this->validation->setRules([
            'content_head' => 'required',
            'content_thumbnail' => 'required',
            'content_body' => 'required'
        ]);
        $data_Field['content_head'] = $this->request->getVar()['txthead'];
        $data_Field['content_thumbnail'] = $this->request->getFiles()['thumbnail']->getName();
        $data_Field['content_body'] = $this->request->getVar()['ckeditor'];
        $validate_field = $this->validation->run($data_Field);
        if ($validate_field == FALSE) {
            setAlert('error', 'Save fail please validate field');
            return redirect()->to('/content/branch/' . $branch . '/content/add');
        }

        $params = $this->request->getVar();
        $img = $this->request->getFiles()['thumbnail'];

        $result = $this->Content_Model->saveContent($params, $branch, $img);

        if ($result == true && is_bool($result)) {
            setAlert('success', 'Add Success.');
            return redirect()->to('/content/branch/' . $branch . '/content/index');
        } else {
            setAlert('error', $result);
            return redirect()->to('/content/branch/' . $branch . '/content/add');
        }
    }
    public function Update($branch, $id)
    {
        $this->validation->setRules([
            'content_head' => 'required',
            'content_thumbnail' => 'required',
            'content_body' => 'required'
        ]);

        $data_Field['content_head'] = $this->request->getVar()['txthead'];
        if ($this->request->getFiles()['thumbnail']->getName() == '') {
            $data_Field['content_thumbnail'] = $this->request->getVar()['oldfile'];
        } else {
            $data_Field['content_thumbnail'] = $this->request->getFiles()['thumbnail']->getName();
        }
        $data_Field['content_body'] = $this->request->getVar()['ckeditor'];
        $validate_field = $this->validation->run($data_Field);
        if ($validate_field == FALSE) {
            setAlert('error', 'Save fail please validate field');
            return redirect()->to('/content/branch/' . $branch . '/content/edit/id/' . $id);
        }

        $params = $this->request->getVar();
        $img = $this->request->getFiles()['thumbnail'];

        $result = $this->Content_Model->updateContent($params, $branch, $img, $id);
        if ($result == true && is_bool($result)) {
            setAlert('success', 'Add Success.');
            return redirect()->to('/content/branch/' . $branch . '/content/index');
        } else {
            setAlert('error', $result);
            return redirect()->to('/content/branch/' . $branch . '/content/edit/id/' . $id);
        }
    }
    public function Delete($branch,$id)
    {
        if (checkLogin() == false) {
			return redirect()->to('/login');
        }

        $result = $this->Content_Model->deleteContent($branch, $id);

		if ($result == true && is_bool($result)) {
			setAlert('success', 'Restore Success.');
			return redirect()->to('/content/branch/' . $branch . '/content/index');
		} else {
			setAlert('error', $result);
			return redirect()->to('/content/branch/' . $branch . '/content/index');
		}
    }
}
