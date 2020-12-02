<?php 
	namespace App\Controllers\Movie;
	use App\Models\Adsdata_Model;
	use App\Models\Ads_Model;
	use CodeIgniter\Controller;

	class Ads extends Controller{		
		private $path_ads;	

		public function __construct() 	
		{		
			$this->validation =  \Config\Services::validation();        
			$this->session = \Config\Services::session();		
			$this->adsdataModel = new Adsdata_Model();		
			$this->adsModel = new Ads_Model();		
			$this->path_ads = "/banners/";        
			helper(['filesystem','url','alert','checklogin','pagination','advertisement']);    
		}    

		public function index($branch_id, $search="")	
		{        
			if( checkLogin()==false ){			
				return redirect()->to('/login');		
			}		

			$page = 1;		
			if( !empty( $_GET) ){			
				$page = $_GET['page'];		
			}		

			$nav = [			
				'module_name' => 'โฆษณา',			
				'module_level' => array(				
					array('name'=>"Home", 'url'=>"/"),				
					array('name'=>"Branch", 'url'=>"/management/branch/".$branch_id),		
					array('name'=>"Advertisement", 'url'=>"/movieads/branch/".$branch_id."/index")									
					)        
				];        

				echo view('template/header', ['branch'=>$branch_id]);		
				echo view('template/body', $nav);        

				$data = [];        
				$data['search_string'] = $search_string = urldecode($search);		
				$data['branch_id'] = $branch_id;		
				$data['path_ads'] = $this->path_ads;
				// print_r($_SESSION['brtemp']);die;		
				$tem = $_SESSION['brtemp'][$branch_id]; 		
				$data['posads'] = get_temads( $tem );		
				$adslist = $this->adsdataModel->get_ads($branch_id, $search_string, $page);	
				$data['adslist'] = $adslist['list']; 
				unset($adslist['list']);		
				$data['paginate'] = $adslist;	
				
				echo view('movie/adslist', $data);		
				echo view('template/footer');	
		}		

		public function add($branch_id)	
		{		
			if( checkLogin()==false ){			
				return redirect()->to('/login');		
			}		

			$nav = [			
				'module_name' => 'เพิ่มโฆษณา',			
				'module_level' => array(									
					array('name'=>"Home", 'url'=>"/"),									
					array('name'=>"Branch", 'url'=>"/management/branch/".$branch_id),		
					array('name'=>"Advertisement", 'url'=>"/movieads/branch/".$branch_id."/index"),										
					array('name'=>"Add", 'url'=>"/movieads/branch/".$branch_id."/add"),																
					)		
				];		

			echo view('template/header');		
			echo view('template/body', $nav);		

			$data = [];
            $data['branch_id'] = $branch_id;
			$tem = $_SESSION['brtemp'][$branch_id]; 
			$data['posads'] = get_temads( $tem );	

			
			echo view('movie/adsform', $data);		
			echo view('template/footer');	
		}	

		public function edit($branch_id, $id)	
		{		
			if( checkLogin()==false ){			
				return redirect()->to('/login');		
			}		

			$nav = [			
				'module_name' => 'แก้ไขโฆษณา',			
				'module_level' => array(									
					array('name'=>"Home", 'url'=>"/"),									
					array('name'=>"Branch", 'url'=>"/management/branch/".$branch_id),		
					array('name'=>"Advertisement", 'url'=>"/movieads/branch/".$branch_id."/index"),										
					array('name'=>"Edit", 'url'=>"/movieads/branch/".$branch_id."/edit/id/".$id),																	
					)		
				];		

			echo view('template/header');		
			echo view('template/body', $nav);		
	
			$tem = $_SESSION['brtemp'][$branch_id]; 
			$data = [
				'branch_id' => $branch_id,
				'ads_id' => $id,
				'ads' => $this->adsdataModel->get_ads_onid($id),
				'posads' => get_temads( $tem )
			];

			echo view('movie/adsedit', $data);		
			echo view('template/footer');	
		}	

		public function saveadd($branch_id)	
		{		
			$params = $this->request->getVar();		
			$files = $this->request->getFiles()['ads_picture'];		

			$data = [			
				'branch_id' => $branch_id,			
				'ads_name' => $params['ads_name'],			
				'ads_url' => $params['ads_url'],			
				'ads_position' => $params['ads_position']		
				];		

			$this->validation->setRules([			
				'ads_name' => 'required',			
				'ads_url' => 'valid_url',            
				'ads_position' => 'required'		
				]);				

			if ($this->validation->run($data) == FALSE){            
				setAlert('error', 'Add failed.');            
				return redirect()->to('/movieads/branch/'.$branch_id.'/index');		
			}else{			
				$result = $this->adsModel->insert_data($data, $files);            

				if ($result==true && is_bool($result)) {  

					setAlert('success', 'Add Success.');                
					return redirect()->to('/movieads/branch/'.$branch_id.'/index');            
				}else{                    

					setAlert('error', $result);               
					return redirect()->to('/movieads/branch/'.$branch_id.'/index');

				}		
			}		

		}	

		public function saveedit($branch_id,$id)	
		{		

			$params = $this->request->getVar();		
			$files = $this->request->getFiles()['ads_picture'];		
			$ads = $this->adsdataModel->get_ads_onid($id);		
			$oldpic = $ads['ads_picture'];		

			$data = [			
				'ads_name' => $params['ads_name'],			
				'ads_url' => $params['ads_url'],			
				'ads_position' => $params['ads_position']		
				];		

			$this->validation->setRules([			
				'ads_name' => 'required',			
				'ads_url' => 'valid_url',            
				'ads_position' => 'required'		
				]);				

			if ($this->validation->run($data) == FALSE){ 

				setAlert('error', 'Add failed.');            
				return redirect()->to('/movieads/branch/'.$branch_id.'/index');	

			}else
			{			
				$result = $this->adsModel->update_data($id, $data, $oldpic, $files);            
				if ($result==true && is_bool($result)) 
				{
					
					setAlert('success', 'Edit Success.');                
					return redirect()->to('/movieads/branch/'.$branch_id.'/index');                
				}else
				{                    

					setAlert('error', $result);                
					return redirect()->to('/movieads/branch/'.$branch_id.'/index');

				}		
			}		
	
		}		

		public function savedel($branch_id,$id)	
		{		
			if( checkLogin()==false ){			
				return redirect()->to('/login');		
			}		

			$ads = $this->adsdataModel->get_ads_onid($id);		
			$files = $ads['ads_picture'];		
			$result = $this->adsModel->delete_data($files,$id);		

			if ($result==true && is_bool($result)) {

				setAlert('success', 'Delete Success.');			
				return redirect()->to('/movieads/branch/'.$branch_id.'/index');	

			}else
			{			

				setAlert('error', $result);			
				return redirect()->to('/movieads/branch/'.$branch_id.'/index');		

			}	
		}
	}
?>