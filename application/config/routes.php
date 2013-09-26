<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "root";
//$route['(:any)']= preg_replace('/\-/u','_',$_SERVER['REQUEST_URI']);

//Dashboard
$route['admin/logout'] = 'admin/login/logout';
$route['admin/(:any)'] = 'admin/$1';

//Search and Archives
$route['(:any)/search/(:any)'] = 'archive/search/$1/$2';
$route['search/(:any)'] = 'archive/search/$1';
$route['(:any)/archive/(:any)'] = 'archive/index/$1/$2';
$route['archive/(:any)'] = 'archive/index/$1';

//Posts and Wishes
$route['(:any)/post/(:any)'] = 'index/post/$1/$2';
$route['post/(:any)'] = 'index/post/$1';
$route['(:any)/wish/(:any)'] = 'index/wish/$1/$2';
$route['wish/(:any)'] = 'index/wish/$1';

//Pagination
$route['page/(:any)'] = 'root/index/page/$1';
$route['cn/page/(:num)'] = 'root/index/cn/page/$1';
$route['en/page/(:num)'] = 'root/index/en/page/$1';
$route['cn/(:any)'] = 'root/posts/cn/$1';
$route['en/(:any)'] = 'root/posts/en/$1';
$route['cn'] = 'root/index/cn';
$route['en'] = 'root/index/en';
$route['admin'] = 'admin/dashboard';
//Posts
$route['(:any)'] = 'root/post/$1';

$route['404_override'] = 'root/e404';


/* End of file routes.php */
/* Location: ./application/config/routes.php */