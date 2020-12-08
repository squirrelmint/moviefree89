<?php


namespace App\Controllers;

use App\Models\Video_Model;

class Home extends BaseController
{

	protected $base_backurl;
	public $path_setting = "";
	public $path_ads = "";
	public $branch = 1;
	public $backURL = "http://localhost:9999/";
	public $document_root = '';
	public $path_thumbnail = "https://anime.vip-streaming.com/";
	public $path_slide = "";

	public function __construct()
	{
		$this->config = new \Config\App();
		$this->validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
		$this->VideoModel = new Video_Model();
		$this->document_root = $this->config->docURL;
		$this->branch = 1;

		// Directory
		$this->path_ads = $this->backURL . 'public/banners/';
		$this->path_setting = $this->backURL . 'setting/';
		$this->path_slide = $this->backURL . 'img_slide/';
		$this->path_bg_cate = base_url() . '/public/bg_cate/';

		helper(['url', 'pagination', 'dateformat', 'validatetext']);
	}

	public function index()
	{
		$page = 1;
		if (!empty($_GET['page'])) {
			$page = $_GET['page'];
		}
		$catereq = [6, 7, 28];
		foreach ($catereq as $val) {
			$get_list_video_bycate[] = $this->VideoModel->get_list_video_bycate($this->branch, $val);
		}
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];
		$list_category = $this->VideoModel->get_category($this->branch);
		$ads = $this->VideoModel->get_ads($this->branch);
		//$list_genres = $this->VideoModel->get_id_video_bygenres($this->branch);
		$chk_act = [
			'home' => 'active',
			'poppular' => '',
			'newmovie' => '',
			'topimdb' => '',
			'category' => '',
			'contract' => ''
		];

		$header_data = [
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'list_category' => $list_category,
			'chk_act' => $chk_act,
			'setting' => $setting,
			'path_slide' => $this->path_slide,
			'urlsearch' => '/search/'
		
		];

		$list = $this->VideoModel->get_list_video($this->branch, '', $page);
		$list_1 = $this->VideoModel->get_list_new_movie($this->branch, $keyword = '', '1');
		$listyear = $this->VideoModel->get_listyear($this->branch);
		//echo "<pre>";print_r($list_genres);die;
		$list_video_topimdb = $this->VideoModel->get_list_video_topimdb($this->branch);

		


		$body_data = [
			'url_loadmore' => base_url('moviedata'),
			'path_thumbnail' => $this->path_thumbnail,
			'list_video_topimdb' => $list_video_topimdb,
			'get_list_video_bycate' => $get_list_video_bycate,
			'ads' => $ads,
			'path_ads' => $this->path_ads,
			'newmovie_1' => $list_1,
			'paginate' => $list,
			'list' => $list,
			'listyear' => $listyear
	
			
		];
		// echo '<pre>' . print_r($get_list_video_bycate, true) . '</pre>';
		// die;


		echo view('templates/header.php', $header_data);
		echo view('index.php', $body_data);
		echo view('templates/footer.php');
	}

	public function video($id, $Name)
	{
		$catereq = [6, 7, 28];
		$ads = $this->VideoModel->get_ads($this->branch);
		$setting = $this->VideoModel->get_setting($this->branch);
		$seo = $this->VideoModel->get_seo($this->branch);
		$videodata = $this->VideoModel->get_id_video($id);
		$videinterest = $this->VideoModel->get_video_interest($this->branch);
		$adstop = $this->VideoModel->get_adstop($this->branch);
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);
		$listyear = $this->VideoModel->get_listyear($this->branch);
		$list_category = $this->VideoModel->get_category($this->branch);
		$video_random = $this->VideoModel->get_id_video_random($this->branch);
		//echo "<pre>";print_r($video_random);die;
		$date = get_date($videodata['movie_create']);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		if ($seo) {

			if (substr($videodata['movie_picture'], 0, 4) == 'http') {
				$movie_picture = $videodata['movie_picture'];
			} else {
				$movie_picture = $this->path_thumbnail . $videodata['movie_picture'];
			}

			$setting['setting_img'] = $movie_picture;
			$setting['setting_description'] = str_replace("{movie_description}", $videodata['movie_des'], $seo['seo_description']);
			$setting['setting_title'] = str_replace("{movie_title} - {title_web}", $videodata['movie_thname'] . " - " . $setting['setting_title'], $seo['seo_title']);
		}
		foreach ($catereq as $val) {
			$get_list_video_bycate[] = $this->VideoModel->get_list_video_bycate($this->branch, $val);
		}

		$chk_act = [
			'home' => 'active',
			'poppular' => '',
			'newmovie' => '',
			'topimdb' => '',
			'category' => '',
			'contract' => ''
		];

		$header_data = [
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'list_category' => $list_category,
			'chk_act' => $chk_act,
			'urlsearch' => '/search/'
		];

		$body_data = [
			'url_loadmore' => base_url('moviedatarandom'),
			'path_thumbnail' => $this->path_thumbnail,
			'videodata' => $videodata,
			'videinterest' => $videinterest,
			'ads' => $ads,
			
			'path_ads' => $this->path_ads,
			'DateEng' => $date['DateEng'],
			'feildplay' => 'movie_thmain',
			'index' => 'a',
			'listyear' => $listyear,
			'get_list_video_bycate' => $get_list_video_bycate,
			'video_random' => $video_random,
			'paginate' => $video_random,
		];	

		echo view('templates/header.php', $header_data);
		echo view('video1.php', $body_data);
		echo view('templates/footer.php');
	}

	public function series($id, $Name, $index = 0, $epname = '')
	{
		$ads = $this->VideoModel->get_ads($this->branch);
		$setting = $this->VideoModel->get_setting($this->branch);
		$seo = $this->VideoModel->get_seo($this->branch);
		$series = $this->VideoModel->get_ep_series($id);
		$videinterest = $this->VideoModel->get_video_interest($this->branch);
		$adstop = $this->VideoModel->get_adstop($this->branch);
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);
		$listyear = $this->VideoModel->get_listyear($this->branch);
		$video_random = $this->VideoModel->get_id_video_random($this->branch);
		$catereq = [6, 7, 28];
		foreach ($catereq as $val) {
			$get_list_video_bycate[] = $this->VideoModel->get_list_video_bycate($this->branch, $val);
		}
		if ($epname == '') {
			$lastep = count($series['epdata']);
			$index = $lastep - 1;
		}

		$list_category = $this->VideoModel->get_category($this->branch);
		$date = get_date($series['movie_create']);

		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		if ($seo) {

			if (substr($series['movie_picture'], 0, 4) == 'http') {
				$movie_picture = $series['movie_picture'];
			} else {
				$movie_picture = $this->path_thumbnail . $vidserieseodata['movie_picture'];
			}

			$setting['setting_img'] = $movie_picture;
			$setting['setting_description'] = str_replace("{movie_description}", $series['movie_des'], $seo['seo_description']);
			$setting['setting_title'] = str_replace("{movie_title} - {title_web}", $series['movie_thname'] . " - " . $setting['setting_title'], $seo['seo_title']);
		}


		$chk_act = [
			'home' => 'active',
			'poppular' => '',
			'newmovie' => '',
			'topimdb' => '',
			'category' => '',
			'contract' => ''
		];

		$header_data = [
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'list_category' => $list_category,
			'chk_act' => $chk_act,
			'urlsearch' => '/search/'
		];

		$body_data = [
			'url_loadmore' => base_url('moviedata'),
			'path_thumbnail' => $this->path_thumbnail,
			'videodata' => $series,
			'ads' => $ads,
			'path_ads' => $this->path_ads,
			'DateEng' => $date['DateEng'],
			'feildplay' => 'movie_thmain',
			'index' => $index,
			'videinterest' => $videinterest,
			'listyear' => $listyear,
			'get_list_video_bycate' => $get_list_video_bycate,
			'video_random' => $video_random
		];

		echo view('templates/header.php', $header_data);
		echo view('video1.php', $body_data);
		echo view('templates/footer.php');
	}

	public function moviedata()
	{
		$list = $this->VideoModel->get_list_video($this->branch, '', $_GET['page']);

		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list
		];

		echo view('moviedata.php', $header_data);
	}

	public function moviedata_random()
	{
		$list = $this->VideoModel->moviedata_random_pagevideo($this->branch,  $_GET['page']);
		
		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list
		];

		echo view('moviedata.php', $header_data);
	}

	public function moviedata_topimdblist()
	{
		$list = $this->VideoModel->get_list_video_topimdb($this->branch, '', $_GET['page']);

		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list
		];

		echo view('moviedata.php', $header_data);
	}

	public function moviedata_search()
	{
		$list = $this->VideoModel->get_list_video($this->branch, $_GET['keyword'], $_GET['page']);

		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,

		];
		echo view('moviedata.php', $header_data);
	}

	public function moviedata_category()
	{
		$list = $this->VideoModel->get_id_video_bycategory($this->branch, $_GET['keyword'], $_GET['page']);

		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,
		];

		echo view('moviedata.php', $header_data);
	}

	public function categorylist() //ต้นแบบ หน้า cate / search
	{
		$ads = $this->VideoModel->get_ads($this->branch);
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$chk_act = [
			'home' => '',
			'poppular' => '',
			'newmovie' => '',
			'topimdb' => '',
			'category' => 'active',
			'contract' => ''
		];

		$header_data = [
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'path_bg_cate' => $this->path_bg_cate,
			'setting' => $setting,
			'ads' => $ads,
			'path_ads' => $this->path_ads,
			'path_thumbnail' => $this->path_thumbnail,
			'chk_act' => $chk_act,
			'urlsearch' => '/search/'
		];

		$list_category = $this->VideoModel->get_category($this->branch);

		$body_data = [
			'list_category' => $list_category
		];


		echo view('templates/header.php', $header_data);
		echo view('category.php', $body_data);
		echo view('templates/footer.php');
	}


	//*** List All GENRES  ***
	public function video_genres($id, $keyword)
	{
		
		$page = 1;
		if (!empty($_GET['page'])) {
			$page = $_GET['page'];
		}
		$ads = $this->VideoModel->get_ads($this->branch);
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$chk_act = [
			'home' => '',
			'poppular' => '',
			'newmovie' => '',
			'topimdb' => '',
			'category' => 'active',
			'contract' => ''
		];

		$header_data = [
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'path_bg_cate' => $this->path_bg_cate,
			'setting' => $setting,
			'ads' => $ads,
			'path_ads' => $this->path_ads,
			'path_thumbnail' => $this->path_thumbnail,
			'chk_act' => $chk_act,
			'urlsearch' => '/search/'
		];

		$list_genres = $this->VideoModel->get_id_video_bygenres($id ,$this->branch, $page, $keyword);
		$list_category = $this->VideoModel->get_category($this->branch);
		$listyear = $this->VideoModel->get_listyear($this->branch);
		$catereq = [6, 7, 28];
		foreach ($catereq as $val) {
			$get_list_video_bycate[] = $this->VideoModel->get_list_video_bycate($this->branch, $val);
		}
		$body_data = [
			//'url_loadmore' => base_url('moviedata_topimdblist'),
			'list' => $list_genres,
			'cate_name' => urldecode($keyword),
			'paginate' => $list_genres,
			'list_category' => $list_category,
			'listyear' => $listyear,
			'get_list_video_bycate' => $get_list_video_bycate
		];


		echo view('templates/header.php', $header_data);
		echo view('list.php', $body_data);
		echo view('templates/footer.php');
	}

	public function popular() //ต้นแบบ หน้า cate / search
	{
		$ads = $this->VideoModel->get_ads($this->branch);
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$list_category = $this->VideoModel->get_category($this->branch);
		$list = $this->VideoModel->get_list_popular($this->branch);
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);

		$chk_act = [
			'home' => '',
			'poppular' => 'active',
			'newmovie' => '',
			'topimdb' => '',
			'category' => '',
			'contract' => ''
		];

		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'path_slide' => $this->path_slide,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'chk_act' => $chk_act,
			'list_category' => $list_category,
			'list' => $list,
			'ads' => $ads,
			'path_ads' => $this->path_ads,
			'urlsearch' => '/search/'
		];

		echo view('templates/header.php', $header_data);
		echo view('popular.php');
		echo view('templates/footer.php');
	}

	public function topimdblist()
	{
		$ads = $this->VideoModel->get_ads($this->branch);
		$keyword = '';
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$list = array();

		$list = $this->VideoModel->get_list_video_topimdb($this->branch, $keyword = '', '1');
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);
		$list_category = $this->VideoModel->get_category($this->branch);

		$chk_act = [
			'home' => '',
			'poppular' => '',
			'newmovie' => '',
			'topimdb' => 'active',
			'category' => '',
			'contract' => ''

		];

		$header_data = [
			'cate_name' => 'TOP IMDB',
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'list_category' => $list_category,
			'keyword' => $keyword,
			'chk_act' => $chk_act,
			'urlsearch' => '/search/'
		];

		$body_data = [
			'url_loadmore' => base_url('moviedata_topimdblist'),
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,
			'ads' => $ads,
			'path_ads' => $this->path_ads,
		];

		echo view('templates/header.php', $header_data);
		echo view('list.php', $body_data);
		echo view('templates/footer.php');
	}


	public function newmovielist()
	{
		$ads = $this->VideoModel->get_ads($this->branch);
		$keyword = '';
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$list = array();

		$list = $this->VideoModel->get_list_video($this->branch, $keyword = '', '1');
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);
		$list_category = $this->VideoModel->get_category($this->branch);

		$chk_act = [
			'home' => '',
			'poppular' => '',
			'newmovie' => 'active',
			'topimdb' => '',
			'category' => '',
			'contract' => ''

		];

		$header_data = [
			'cate_name' => 'หนังใหม่',
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'list_category' => $list_category,
			'keyword' => $keyword,
			'chk_act' => $chk_act,
			'urlsearch' => '/search/'
		];

		$body_data = [
			'url_loadmore' => base_url('moviedata'),
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,
			'ads' => $ads,
			'path_ads' => $this->path_ads,
		];

		echo view('templates/header.php', $header_data);
		echo view('list.php', $body_data);
		echo view('templates/footer.php');
	}

	public function search($keyword)
	{
		
		$ads = $this->VideoModel->get_ads($this->branch);
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$list = array();
		$keyword = urldecode(str_replace("'", "\'", $keyword));
		$list = $this->VideoModel->get_list_video($this->branch,  $keyword, '1');
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);
		$list_category = $this->VideoModel->get_category($this->branch);
		$listyear = $this->VideoModel->get_listyear($this->branch);
		$catereq = [6, 7, 28];
		foreach ($catereq as $val) {
			$get_list_video_bycate[] = $this->VideoModel->get_list_video_bycate($this->branch, $val);
		}
		$chk_act = [

			'home' => 'active',
			'poppular' => '',
			'newmovie' => '',
			'topimdb' => '',
			'category' => '',
			'contract' => ''
		];

		$header_data = [

			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'list_category' => $list_category,
			'keyword' => $keyword,
			'chk_act' => $chk_act,
			'urlsearch' => '/search/'
		];

		$body_data = [
			'url_loadmore' => base_url('moviedata_search'),
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,
			'ads' => $ads,
			'path_ads' => $this->path_ads,
			'cate_name' => urldecode($keyword),
			'paginate' => $list,
			'listyear' => $listyear,
			'get_list_video_bycate' => $get_list_video_bycate
		];

		echo view('templates/header.php', $header_data);
		echo view('list.php', $body_data);
		echo view('templates/footer.php');
	}


	public function category($cate_id, $cate_name)
	{
		$page = 1;
		if (!empty($_GET['page'])) {
			$page = $_GET['page'];
		}
		$ads = $this->VideoModel->get_ads($this->branch);
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];
		$list = $this->VideoModel->get_id_video_bycategory($this->branch, $cate_id, $page);
		
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);
		$list_category = $this->VideoModel->get_category($this->branch);
		$listyear = $this->VideoModel->get_listyear($this->branch);
		$keyword = '';
		$catereq = [6, 7, 28];
		foreach ($catereq as $val) {
			$get_list_video_bycate[] = $this->VideoModel->get_list_video_bycate($this->branch, $val);
		}

		$chk_act = [
			'home' => '',
			'poppular' => '',
			'newmovie' => '',
			'topimdb' => '',
			'category' => 'active',
			'contract' => ''
		];

		if ($cate_id == '28') {
			$chk_act = [
				'home' => '',
				'poppular' => '',
				'newmovie' => '',
				'netflix' => 'active',
				'category' => '',
				'contract' => ''
			];
		}
		$header_data = [
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'list_category' => $list_category,
			'chk_act' => $chk_act,
			'urlsearch' => '/search/'
		];

		$body_data = [
			'cate_name' => urldecode($cate_name),
			'keyword' => $keyword,
			'url_loadmore' => base_url('moviedata_category'),
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,
			'paginate' => $list,
			'ads' => $ads,
			'path_ads' => $this->path_ads,
			'listyear' => $listyear,
			'get_list_video_bycate' => $get_list_video_bycate

		];

		echo view('templates/header.php', $header_data);
		echo view('list.php', $body_data);
		echo view('templates/footer.php');
	}


	public function video_byyear($id)
	{
		$cate_id = '';
		$page = 1;
		if (!empty($_GET['page'])) {
			$page = $_GET['page'];
		}
		$ads = $this->VideoModel->get_ads($this->branch);
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];
		$listyear = $this->VideoModel->get_listyear($this->branch);
		$list = $this->VideoModel->get_id_video_byyear($id, $this->branch, $page);
		
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);
		$list_category = $this->VideoModel->get_category($this->branch);
		$listyear = $this->VideoModel->get_listyear($this->branch);
		$catereq = [6, 7, 28];
		foreach ($catereq as $val) {
			$get_list_video_bycate[] = $this->VideoModel->get_list_video_bycate($this->branch, $val);
		}
	
		$chk_act = [
			'home' => '',
			'poppular' => '',
			'newmovie' => '',
			'topimdb' => '',
			'category' => 'active',
			'contract' => ''
		];

		if ($cate_id == '28') {
			$chk_act = [
				'home' => '',
				'poppular' => '',
				'newmovie' => '',
				'netflix' => 'active',
				'category' => '',
				'contract' => ''
			];
		}
		$header_data = [
			'document_root' => $this->document_root,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'list_category' => $list_category,
			'chk_act' => $chk_act,
			'urlsearch' => '/search/'
		];

		$body_data = [
			'cate_name' => urldecode($id),
			'keyword' => $cate_id,
			'url_loadmore' => base_url('moviedata_category'),
			'path_thumbnail' => $this->path_thumbnail,
			'list' => $list,
			'paginate' => $list,
			'ads' => $ads,
			'path_ads' => $this->path_ads,
			'listyear' => $listyear,
			'get_list_video_bycate' => $get_list_video_bycate

		];

		echo view('templates/header.php', $header_data);
		echo view('list.php', $body_data);
		echo view('templates/footer.php');
	}

	public function contract() //ต้นแบบ หน้า cate / search
	{
		$ads = $this->VideoModel->get_ads($this->branch);
		$setting = $this->VideoModel->get_setting($this->branch);
		$setting['setting_img'] = $this->path_setting . $setting['setting_logo'];

		$list_category = $this->VideoModel->get_category($this->branch);
		$adsbottom = $this->VideoModel->get_adsbottom($this->branch);

		$chk_act = [
			'home' => '',
			'poppular' => '',
			'newmovie' => '',
			'topimdb' => '',
			'category' => '',
			'contract' => 'active'
		];

		$header_data = [
			'document_root' => $this->document_root,
			'path_thumbnail' => $this->path_thumbnail,
			'path_setting' => $this->path_setting,
			'setting' => $setting,
			'chk_act' => $chk_act,
			'list_category' => $list_category,
			'ads' => $ads,
			'path_ads' => $this->path_ads,
			'urlsearch' => '/search/'
		];

		echo view('templates/header.php', $header_data);
		echo view('contract.php');
		echo view('templates/footer.php');
	}

	public function player($id, $index)
	{
		
		$video_data = $this->VideoModel->get_id_video($id);
		$series = $this->VideoModel->get_ep_series($id);
		$adsvideo = $this->VideoModel->get_adsvideolist($this->backURL);
		// echo '<pre>' . print_r($anime, true) . '</pre>';
		// 		die;
		$playerUrl = $video_data['movie_thmain'];

		if ($index != "a") {
			$playerUrl = $series['epdata'][$index];
		}

		$data = [
			'document_root' => $this->document_root,
			'branch' 		=> $this->branch,
			'backUrl' 		=> $this->backURL,
			'adsvideo'		=> $adsvideo,
			'playerUrl' 	=> $playerUrl
		];

		echo view('player.php', $data);
	}

	public function countView($id)
	{
		$this->VideoModel->countView($id);
	}

	public function save_requests()
	{
		$request_text = $_POST['request_text'];

		$this->VideoModel->save_requests($this->branch, $request_text);
	}

	public function con_ads()
	{


		$chk_ads_con_name = validate($_POST['ads_con_name']);
		$chk_ads_con_email = validate($_POST['ads_con_email']);
		$chk_ads_con_line = validate($_POST['ads_con_line']);
		$chk_ads_con_tel = validate($_POST['ads_con_tel']);

		$ads_con_name = $_POST['ads_con_name'];
		$ads_con_email = $_POST['ads_con_email'];
		$ads_con_line = $_POST['ads_con_line'];
		$ads_con_tel = $_POST['ads_con_tel'];

		// print_r($_POST);
		// die;


		$this->VideoModel->con_ads($this->branch, $ads_con_name, $ads_con_email, $ads_con_line, $ads_con_tel);
	}

	public function saveReport()
	{


		$movie_id =  $_POST['movie_id'];
		$movie_name = $_POST['movie_name'];
		$movie_ep_name = $_POST['movie_ep_name'];
		$datetime = date('Y-m-d H:i:s');



		$result = $this->VideoModel->save_reports($this->branch, $movie_id, $movie_name, $movie_ep_name, $datetime);
	}
}
