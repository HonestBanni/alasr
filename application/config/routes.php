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
$route['default_controller'] = 'SiteController';
$route['404_override'] = 'SiteController/error_page';
//$route['404_override'] = 'SiteController/error_page';

$route['translate_uri_dashes'] = FALSE;

/*
 * 
 *    User Login Routes
 * 
 */



// Public Routes
$route['Home']              = 'SiteController/index';
$route['About']             = 'SiteController/about_us';
$route['Contact']           = 'SiteController/contact_us';
$route['Gallery']           = 'SiteController/gallery';
$route['Gallery/:num']      = 'SiteController/gallery/:num';
$route['Events']            = 'SiteController/events';
$route['Events/:num']       = 'SiteController/events/:num';
$route['Event/:any']        = 'SiteController/event_details/:any';







$route['Login']             = 'LoginController/index';
$route['Logout']            = 'LoginController/logout';
$route['userAuth']          = 'LoginController/login_authentication';


/*
 * 
 *     AppSetting Routes
 * 
 */

// Point of Sale Modules Routes
//$route['Dashboard']                 = 'AdminPanelController/admin_home_banner';
$route['Dashboard']                 = 'UserManagement/index';
$route['restricted']                = 'UserManagement/user_restricted_page';
 

// User Managements Modules Routes
$route['HeaderNav']                 = 'UserManagement/menu_Level1';
$route['HeaderNav/:num']            = 'UserManagement/menu_Level1/:num';
$route['deleteM1/:num']             = 'UserManagement/delete_menu_Level1/:num';

$route['menuLevel2']                = 'UserManagement/menu_Level2';
$route['menuLevel2/:num']           = 'UserManagement/menu_Level2/:num';
$route['deleteM2/:num']             = 'UserManagement/delete_menu_Level2/:num';
$route['menuLevel3']                = 'UserManagement/menu_Level3';
$route['menuLevel3/:num']           = 'UserManagement/menu_Level3/:num';
$route['deleteM3/:num']             = 'UserManagement/delete_menu_Level3/:num';
$route['menu2Section']              = 'UserManagement/menu2_section'; //selection 


$route['userRole']                  = 'UserManagement/userRole';
$route['userRole/:num']             = 'UserManagement/userRole/:num';
$route['userRoleCreate']            = 'UserManagement/userRoleCreate';
$route['userRoleCreate/:num']       = 'UserManagement/userRoleCreate/:num';
$route['dbUser']                    = 'UserManagement/dbUser';
$route['dbUser/:num']               = 'UserManagement/dbUser/:num';
$route['dbUserCreate']              = 'UserManagement/dbUserCreate';
$route['groupPolicy/:num']          = 'UserManagement/groupPolicy/:num';
$route['GPSetting/:num']            = 'UserManagement/group_policy_Lthree/:num';
$route['policySetups/:num']         = 'UserManagement/groupPolicySetup/:num';
$route['policySave']                = 'UserManagement/policySave';
$route['policyThirdLayer']          = 'UserManagement/policy_third_layer';



// Website Admin Panel Routes

$route['homeNav']                   = 'AdminPanelController/admin_home_nav';
$route['HomeNavShow']               = 'AdminPanelController/home_nav_show_js';
$route['RegisterNav']               = 'AdminPanelController/register_nav_js';
$route['SearchNav']                 = 'AdminPanelController/nav_show_search_js';
$route['DeleteNav']                 = 'AdminPanelController/nav_delete_js';


$route['adminBanner']               = 'AdminPanelController/admin_home_banner';
$route['HomeBannerShow']            = 'AdminPanelController/admin_home_banner_show_js';
$route['UpdateBanner']              = 'AdminPanelController/updat_banner_show';
$route['UpdateBannerData']          = 'AdminPanelController/updat_banner';

$route['adminGallery']              = 'AdminPanelController/admin_gallery';
$route['adminGalleryShow']            = 'AdminPanelController/admin_gallery_show_js';
$route['UpdateGallery']             = 'AdminPanelController/admin_gallery_update_js';
$route['updateGalleryRecord']            = 'AdminPanelController/admin_gallery_update_js';




$route['AdminNews']                 = 'AdminPanelController/admin_home_news';
$route['adminNewsInsert']           = 'AdminPanelController/admin_home_news_insert';
$route['adminNewsShow']             = 'AdminPanelController/admin_news_show_js';
$route['UpdateNews']                = 'AdminPanelController/admin_news_update_js';

//$route['updateGalleryRecord']            = 'AdminPanelController/admin_gallery_update_js';
 
$route['AdminEvents']                 = 'AdminPanelController/admin_home_events';
$route['adminEventShow']             = 'AdminPanelController/admin_events_show_js';
$route['UpdateEvents']                = 'AdminPanelController/admin_events_update_js';
// Product Controller 

$route['RegCompany']                = 'ProductController/register_product_company';
$route['RegCompanyShow']            = 'ProductController/register_company_show_js';
$route['RegCompanyShowSearch']      = 'ProductController/register_company_show_search_js';
$route['AddCompany']                = 'ProductController/add_company_js';
$route['UpdateCompany']             = 'ProductController/update_company_js';
$route['UpdateCompanyData']         = 'ProductController/update_company_data';
$route['DeleteCompany']             = 'ProductController/delete_company_js';

$route['Product']                   = 'ProductController/product';
$route['RegisterProducts']          = 'ProductController/register_products_js';
$route['UpdateProduct']             = 'ProductController/update_product_js';
$route['UpdateProductData']             = 'ProductController/update_product_data';
$route['DeleteProducts']            = 'ProductController/delete_products_js';
$route['ProductShow']               = 'ProductController/product_show_js';
$route['ProductShowSearch']         = 'ProductController/product_show_search_js';

$route['RegCustomer']               = 'ProductController/register_customer';
$route['RegCustomerShow']           = 'ProductController/register_customer_show_js';
$route['RegCustomerShowSearch']     = 'ProductController/register_customer_show_search_js';
$route['AddCustomer']               = 'ProductController/add_customer_js';
$route['UpdateCustomer']            = 'ProductController/update_customer_js';
$route['UpdateCustomerData']        = 'ProductController/update_customer_data';
$route['DeleteCustomer']            = 'ProductController/delete_customer_js';
//$route['product/:num']              = 'productController/product/:num';

/*
 * 
 *     Stock Routes
 * 
 */


$route['StockDashboard']            = 'PosController/stock_dashboard';
$route['StockProductInfo']          = 'PosController/stock_product_info';
$route['addProductDemo']            = 'PosController/add_demo_product_js';
$route['showProductDemo']           = 'PosController/show_demo_product_js';
$route['deleteDemoPro']             = 'PosController/delete_demo_product_js';
$route['companyBalance']            = 'PosController/company_balance_js';
$route['saveStock']                 = 'PosController/save_stock_js';
$route['StockUpdate']               = 'PosController/stock_update_report';
$route['UpdateStockInvoice/:num']   = 'PosController/update_stock_invoice/:num';
$route['updateStockData']           = 'PosController/update_stock_date_js';
$route['deleteStockInvoice']        = 'PosController/delete_stock_invoice_js';
/*
 * 
 *     Reports Routes
 * 
 */

$route['stockReport']               = 'ReportController/stock_report';
$route['saleReport']                = 'ReportController/sale_report';
$route['inventoryStockStatus']      = 'ReportController/inventory_stock_status_report';



/*
 * 
 *     Sale Routes
 * 
 */

$route['saleDashboard']             = 'SaleController/sale_dashboard';
$route['saleProductCheck']          = 'SaleController/sale_product_check';
$route['customerBalance']           = 'SaleController/customer_balance_js';
$route['saveSale']                  = 'SaleController/save_sale_js';
$route['SaleUpdate']                = 'SaleController/sale_update_report';