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
| This route indicates which thecontroller class should be loaded if 
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
$route['default_controller'] = "admin/login";
$route['admin'] = "admin/login";
//$route['product/(:any)'] = 'admin/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//$route['Category/(:any)'] = 'Category/index/$1';
//$route['Products/(:any)'] = 'Products/index/$1';
//$route['ResetPassword/(:any)'] = 'ResetPassword/index/$1';
$route['admin/CompletedOrders/(:any)'] = 'admin/CompletedOrders/index/$1';
//$route['register'] = 'Register';
//$route['forgot-password'] = 'Forgot_password';

/* REST API Routes */
$route['api/categories'] = 'Api/categories';
$route['api/collections'] = 'Api/collections';
$route['api/products'] = 'Api/products';
$route['api/products/featured'] = 'Api/featured_products';
$route['api/products/new-arrivals'] = 'Api/new_arrivals';
$route['api/products/detail/(:any)'] = 'Api/product_detail/$1';
$route['api/search'] = 'Api/search';
$route['api/promocode/apply'] = 'Api/apply_promocode';
$route['api/shipping/options'] = 'Api/shipping_options';
$route['api/content/(:any)'] = 'Api/content/$1';
$route['api/testimonials'] = 'Api/testimonials';
$route['api/banners'] = 'Api/banners';
$route['api/signature-collection'] = 'Api/signature_collection';
$route['api/countries'] = 'Api/countries';

/* Auth API Routes */
$route['api/auth/send-otp'] = 'Api/send_register_otp';
$route['api/auth/verify-otp'] = 'Api/verify_register_otp';
$route['api/auth/register'] = 'Api/register';
$route['api/auth/verify-email'] = 'Api/verify_email';
$route['api/auth/resend-verification'] = 'Api/resend_verification_email';
$route['api/auth/login'] = 'Api/login';
$route['api/auth/forgot-password'] = 'Api/forgot_password';
$route['api/auth/reset-password'] = 'Api/reset_password';
$route['api/auth/update-profile'] = 'Api/update_profile';
$route['api/auth/change-password'] = 'Api/change_password';
$route['api/user/orders'] = 'Api/user_orders';

/* Order Tracking API Route */
$route['api/track'] = 'Api/track_order';

/* Payment & Windcave FPRN API Routes */
$route['api/windcave/create-session'] = 'Api/windcave_create_session';
$route['api/payment/status'] = 'Api/payment_status';

/* Contact Us API Route */
$route['api/contact'] = 'Api/contact_submit';

/* Newsletter Subscription API Route */
$route['api/newsletter/subscribe'] = 'Api/newsletter_subscribe';

/* Blogs API Routes */
$route['api/blogs'] = 'Api/blogs';
$route['api/blogs/(:any)'] = 'Api/blog_detail/$1';

