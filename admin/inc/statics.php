<?php
// App Name
define('appName','Minazi.Store');

// Setting up the time zone
date_default_timezone_set('Africa/Accra');

// server
define('hostName', 'localhost');
define('userName', 'minazy_ecommerce');
define('userPass', 'YXMxTm^PHvxp');
define('hostDb', 'minazy_buy');


// Host Name
// define('hostName', 'localhost');

// User Name
// define('userName', 'root');

// User Password
// define('userPass', '');

// Host Database
// define('hostDb', 'minazy');

function url(){
    return sprintf(
      "%s://%s%s",
      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
      $_SERVER['SERVER_NAME'],
      $_SERVER['REQUEST_URI']
    );
}

// Base URL
define('baseUrl', url());
define('base', 'http://localhost/minazi/en/');
define('admin_base', 'http://localhost/minazi-main/admin/');

// Names of Tables
// Products Table
define('products','tbl_product');
// Customers Table
define('customers','tbl_customer');
// Payments Table
define('payments','tbl_payment');
// Users Table
define('users','tbl_user');
// Category Table
define('categories','tbl_category');
// Messages Table
define('messages','tbl_message');
// Rating Table
define('ratings','tbl_rating');
// Orders Table
define('orders','tbl_order');
// MetaData Table
define('metadata','tbl_meta');
// Secret Key
define('sec_key','Bearer FLWSECK_TEST-SANDBOXDEMOKEY-X');
// Token
define('mytoken','MZ78673');

$country = array(
  ''  => 'Choose....',
  '1' => 'United Arab Emirates',
  '2' => 'Ghana',
);

$state = array(
  ''  => 'Choose....',
  '1-1' => 'Abu Dhabi',
  '1-2' => 'Dubai',
  '1-3' => 'Sharjah',
  '1-4' => 'Umm al Khaimah',
  '1-5' => 'Ajman',
  '1-6' => 'Ras Al Khaimah',
  '1-7' => 'Fujaira',
  '2-1' => 'Ahafo',
  '2-2' => 'Ashanti',
  '2-3' => 'Bono East',
  '2-4' => 'Brong Ahafo',
  '2-5' => 'Central',
  '2-6' => 'Eastern',
  '2-7' => 'Greater Accra',
  '2-8' => 'North East',
  '2-9' => 'Northern',
  '2-10' => 'Oti',
  '2-11' => 'Savannah',
  '2-12' => 'Volta',
  '2-13' => 'Upper East',
  '2-14' => 'Upper West',
  '2-15' => 'Western',
  '2-16' => 'Western North',
);
