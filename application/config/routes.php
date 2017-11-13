<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['content/(:any)/edit_content/(:any)'] = 'content/edit_content/$1/$2';
$route['content/(:any)/add_content'] = 'content/add_content/$1';
$route['content/(:any)'] = 'content/content_cms/$1';

$route['news/(:any)'] = 'content/content_page/news/$1';
$route['previews/(:any)'] = 'content/content_page/previews/$1';
$route['blog/(:any)'] = 'content/content_page/blog/$1';

$route['news'] = 'content/content_category/news';
$route['previews'] = 'content/content_category/previews';
$route['blog'] = 'content/content_category/blog';

$route['default_controller'] = 'content/content_welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
