<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Dashboard::index');

// Redirect to a URI
// $routes->addRedirect('/index', '/');

$routes->get('/login', 'User::login');
$routes->post('/user/authenticate', 'User::authenticate');
$routes->get('/logout', 'User::logout');

// Profile
$routes->get('/profile/index', 'Profile::index');
$routes->get('/profile/index/(:any)', 'Profile::index/$1');
$routes->get('/profile/add', 'Profile::add');
$routes->post('/profile/saveadd', 'Profile::saveadd');
$routes->get('/profile/edit/(:num)', 'Profile::edit/$1');
$routes->post('/profile/saveedit/(:num)', 'Profile::saveedit/$1');
$routes->get('/profile/savedelete/(:num)', 'Profile::savedelete/$1');
$routes->get('/profile/saveundelete/(:num)', 'Profile::saveundelete/$1');

// Dashboard
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/management/branch/(:num)', 'Dashboard::management/$1');
$routes->get('/dashboard/update/branch/(:num)/status/(:num)', 'Dashboard::update_branchstatus/$1/$2');

//Manga Service
$routes->post('/manga/ep/(:num)', 'Manga\Manga::saveview/$1');

// Manga Category
$routes->get('/manga/branch/(:num)/category/index', 'Manga\MangaCate::category/$1');
$routes->get('/manga/branch/(:num)/category/index/(:any)', 'Manga\MangaCate::category/$1/$2');
$routes->get('/manga/branch/(:num)/category/add', 'Manga\MangaCate::add/$1');
$routes->post('/manga/branch/(:num)/category/saveadd', 'Manga\MangaCate::saveadd/$1');
$routes->get('/manga/branch/(:num)/category/edit/id/(:num)', 'Manga\MangaCate::edit/$1/$2');
$routes->post('/manga/branch/(:num)/category/editsave/id/(:num)', 'Manga\MangaCate::editsave/$1/$2');
$routes->get('/manga/branch/(:num)/category/del/id/(:num)', 'Manga\MangaCate::del/$1/$2');

// Manga Subject
$routes->get('/manga/branch/(:num)/subject/index', 'Manga\Manga::subject/$1');
$routes->get('/manga/branch/(:num)/subject/index/(:any)', 'Manga\Manga::subject/$1/$2');
$routes->get('/manga/branch/(:num)/subject/add', 'Manga\Manga::add/$1');
$routes->get('/manga/branch/(:num)/subject/del/id/(:num)', 'Manga\Manga::del/$1/$2');
$routes->post('/manga/branch/(:num)/subject/saveadd', 'Manga\Manga::saveadd/$1');
$routes->get('/manga/branch/(:num)/subject/edit/id/(:num)', 'Manga\Manga::edit/$1/$2');
$routes->post('/manga/branch/(:num)/subject/editsave/id/(:num)', 'Manga\Manga::editsave/$1/$2');

// Manga Episode
$routes->get('/manga/(:num)/episode/index', 'Manga\MangaEpisode::index/$1');
$routes->get('/manga/(:num)/episode/index/(:any)', 'Manga\MangaEpisode::index/$1/$2');
$routes->get('/manga/(:num)/episode/add', 'Manga\MangaEpisode::add/$1');
$routes->post('/manga/(:num)/episode/saveadd', 'Manga\MangaEpisode::saveadd/$1');
$routes->get('/manga/(:num)/episode/edit/id/(:num)', 'Manga\MangaEpisode::edit/$1/$2');
$routes->post('/manga/(:num)/episode/edit/id/(:num)/saveedit', 'Manga\MangaEpisode::saveedit/$1/$2');
$routes->get('/manga/(:num)/episode/del/id/(:num)/action/(:num)', 'Manga\MangaEpisode::savedel/$1/$2/$3');
$routes->get('/manga/(:num)/episode/undel/id/(:num)', 'Manga\MangaEpisode::undel/$1/$2');

//Manga Report
$routes->get('/manga/branch/(:num)/report/index', 'Manga\MangaReport::index/$1');
$routes->get('/manga/branch/(:num)/report/index/(:alphanum)', 'Manga\MangaReport::index/$1/$2');
$routes->get('/manga/branch/(:num)/del/(:num)', 'Manga\MangaReport::del/$1/$2');
$routes->get('/manga/(:num)/episode/edit/id/(:num)/rp/(:num)', 'Manga\MangaEpisode::edit/$1/$2/$3');

//Manga Request
$routes->get('/manga/branch/(:num)/request/index', 'Manga\MangaRequest::index/$1');
$routes->get('/manga/branch/(:num)/request/index/(:alphanum)', 'Manga\MangaRequest::index/$1/$2');
$routes->get('/manga/branch/(:num)/request/del/(:num)', 'Manga\MangaRequest::del/$1/$2');

//Manga Ads
$routes->get('/mangaads/branch/(:num)/index', 'Manga\Ads::index/$1');
$routes->get('/mangaads/branch/(:num)/index/(:any)', 'Manga\Ads::index/$1/$2');
$routes->get('/mangaads/branch/(:num)/add', 'Manga\Ads::add/$1');
$routes->post('/mangaads/branch/(:num)/saveadd', 'Manga\Ads::saveadd/$1');
$routes->get('/mangaads/branch/(:num)/edit/id/(:num)', 'Manga\Ads::edit/$1/$2');
$routes->post('/mangaads/branch/(:num)/saveedit/id/(:num)', 'Manga\Ads::saveedit/$1/$2');
$routes->get('/mangaads/branch/(:num)/del/id/(:num)', 'Manga\Ads::savedel/$1/$2');

// Movie Category
$routes->get('/movie/branch/(:num)/category/index', 'Movie\MovieCate::category/$1');
$routes->get('/movie/branch/(:num)/category/index/(:any)', 'Movie\MovieCate::category/$1/$2');
$routes->get('/movie/branch/(:num)/category/add', 'Movie\MovieCate::add/$1');
$routes->post('/movie/branch/(:num)/category/saveadd', 'Movie\MovieCate::saveadd/$1');
$routes->get('/movie/branch/(:num)/category/edit/id/(:num)', 'Movie\MovieCate::edit/$1/$2');
$routes->post('/movie/category/branch/(:num)/update/id/(:num)', 'Movie\MovieCate::category_update/$1/$2');
$routes->get('/movie/branch/(:num)/category/del_cate/id/(:num)', 'Movie\MovieCate::del/$1/$2');
$routes->get('/movie/branch/(:num)/report/index', 'Movie\MovieReport::index/$1');
$routes->get('/movie/branch/(:num)/report/index/(:alphanum)', 'Movie\MovieReport::index/$1/$2');

//Movie Report
$routes->get('/movie/branch/(:num)/report/index', 'Movie\MovieReport::index/$1');
$routes->get('/movie/branch/(:num)/report/index/(:alphanum)', 'Movie\MovieReport::index/$1/$2');

//Movie Request
$routes->get('/movie/branch/(:num)/request/index', 'Movie\MovieRequest::index/$1');
$routes->get('/movie/branch/(:num)/request/del/id/(:num)', 'Movie\MovieRequest::savedel/$1/$2');

//Movie Ads
$routes->get('/movieads/branch/(:num)/index', 'Movie\Ads::index/$1');
$routes->get('/movieads/branch/(:num)/index/(:any)', 'Movie\Ads::index/$1/$2');
$routes->get('/movieads/branch/(:num)/add', 'Movie\Ads::add/$1');
$routes->post('/movieads/branch/(:num)/saveadd', 'Movie\Ads::saveadd/$1');
$routes->get('/movieads/branch/(:num)/edit/id/(:num)', 'Movie\Ads::edit/$1/$2');
$routes->post('/movieads/branch/(:num)/saveedit/id/(:num)', 'Movie\Ads::saveedit/$1/$2');
$routes->get('/movieads/branch/(:num)/del/id/(:num)', 'Movie\Ads::savedel/$1/$2');

//Video Moovie
$routes->get('/video/branch/(:num)/video/index', 'Movie\MovieVideo::video/$1');
$routes->get('/video/branch/(:num)/video/index/(:any)', 'Movie\MovieVideo::video/$1/$2');
$routes->get('/video/branch/(:num)/video/add', 'Movie\MovieVideo::add/$1');
$routes->post('/video/branch/(:num)/video/saveadd', 'Movie\MovieVideo::saveadd/$1');
$routes->get('/video/branch/(:num)/video/edit/id/(:num)', 'Movie\MovieVideo::edit/$1/$2');
$routes->post('/video/branch/(:num)/video/update/id/(:num)', 'Movie\MovieVideo::video_update/$1/$2');
$routes->get('/video/branch/(:num)/video/del_video/id/(:num)', 'Movie\MovieVideo::del_video/$1/$2');

//Live Stream
$routes->get('/video/branch/(:num)/livestream/index', 'Movie\LiveStream::livestream/$1');
$routes->get('/video/branch/(:num)/livestream/index/(:any)', 'Movie\LiveStream::livestream/$1/$2');
$routes->get('/video/branch/(:num)/livestream/add', 'Movie\LiveStream::addlivestream/$1');//View
$routes->post('/video/branch/(:num)/livestream/saveadd', 'Movie\LiveStream::livestreamsaveadd/$1');//Controller
$routes->get('/video/branch/(:num)/livestream/edit/id/(:num)', 'Movie\LiveStream::edit/$1/$2');
$routes->post('/video/branch/(:num)/livestream/update/id/(:num)', 'Movie\livestream::livestream_update/$1/$2');
$routes->get('/video/branch/(:num)/livestream/del_livestream/id/(:num)', 'Movie\LiveStream::del_livestream/$1/$2');

// Setting
$routes->get('/setting/branch/(:num)', 'Setting::index/$1');
$routes->post('/setting/branch/(:num)/saveedit', 'Setting::saveedit/$1');

// Seo
$routes->get('/seo/branch/(:num)', 'Seo::index/$1');
$routes->post('/seo/branch/(:num)/saveedit', 'Seo::saveedit/$1');

//Report Ads
$routes->get('/reportads/branch/(:num)/index', 'Reportads::index/$1');
$routes->get('/reportads/branch/(:num)/index/(:any)', 'Reportads::index/$1/$2');

// Branch
$routes->get('/branch/index', 'Branch::index');
$routes->get('/branch/add', 'Branch::add');
$routes->post('/branch/saveadd', 'Branch::saveadd');
$routes->get('/branch/savedelete/(:num)', 'Branch::savedelete/$1');
$routes->get('/branch/saveundelete/(:num)', 'Branch::saveundelete/$1');
$routes->post('/branch/edit/(:num)', 'Branch::edit/$1');

// Video Ads
$routes->get('/vdoads/branch/(:num)/index', 'Movie\VdoAds::index/$1');
$routes->get('/vdoads/branch/(:num)/index/(:any)', 'Movie\VdoAds::index/$1/$2');
$routes->get('/vdoads/branch/(:num)/add', 'Movie\VdoAds::add/$1');
$routes->post('/vdoads/branch/(:num)/saveadd', 'Movie\VdoAds::saveadd/$1');
$routes->get('/vdoads/branch/(:num)/edit/id/(:num)', 'Movie\VdoAds::edit/$1/$2');
$routes->post('/vdoads/branch/(:num)/saveedit/id/(:num)', 'Movie\VdoAds::saveedit/$1/$2');
$routes->get('/vdoads/branch/(:num)/del/id/(:num)', 'Movie\VdoAds::savedel/$1/$2');

// Request Ads
$routes->get('/movie/requestads/branch/(:num)', 'Movie\MovieRequestAds::index/$1');
$routes->get('/movie/requestads/branch/(:num)/search/(:any)', 'Movie\MovieRequestAds::index/$1/$2');
$routes->get('/movie/requestads/branch/(:num)/del_requestads/(:num)', 'Movie\MovieRequestAds::del/$1/$2');

// Contact
$routes->get('/movie/contact/branch/(:num)', 'Movie\MovieContact::index/$1');
$routes->get('/movie/contact/branch/(:num)/search/(:any)', 'Movie\MovieContact::index/$1/$2');
$routes->get('/movie/contact/branch/(:num)/del_contact/(:num)', 'Movie\MovieContact::del/$1/$2');

// Content
$routes->get('/content/branch/(:num)/content/index', 'Content::index/$1');
$routes->get('/content/branch/(:num)/content/index/(:any)', 'Content::index/$1/$2');
$routes->get('/content/branch/(:num)/content/add', 'Content::add/$1');
$routes->get('/content/branch/(:num)/content/edit/id/(:num)', 'Content::edit/$1/$2');
$routes->post('/content/branch/(:num)/content/saveadd', 'Content::saveadd/$1');
$routes->post('/content/branch/(:num)/content/update/id/(:num)', 'Content::Update/$1/$2');
$routes->get('/content/branch/(:num)/content/delete/id/(:num)', 'Content::Delete/$1/$2');

//Report Ads
$routes->get('/reportads/branch/(:num)/index', 'Reportads::index/$1');
$routes->get('/reportads/branch/(:num)/index/(:any)', 'Reportads::index/$1/$2');

//Report Ads Video
$routes->get('/reportadsvideo/branch/(:num)/index', 'Reportadsvdo::index/$1');
$routes->get('/reportadsvideo/branch/(:num)/index/(:any)', 'Reportadsvdo::index/$1/$2');

//Service Ads
$routes->get('/ads/sid/(:any)/adsid/(:num)/branch/(:num)', 'AdsService::new/$1/$2/$3');
//Service Ads Vdo
$routes->get('/adsvdo/sid/(:any)/adsid/(:num)/branch/(:num)', 'AdsVdoService::new/$1/$2/$3');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
