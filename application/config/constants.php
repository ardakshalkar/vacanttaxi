<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*  backend users */

define('SUPERADMIN',1113);
define('ADMIN',1112);
define('COMPANY',1111);
define('DISPATCHER',1110);

/* Modes */

define('READ_ONLY',0);
define('MANAGE',1);

/* Table names */
define('ADMIN_TABLE',			'admins');
define('USER_TABLE',			'users');
define('USER_PROFILES_TABLE',	'user_profiles');
define('ADMIN_PROFILE_TABLE',	'admins_profile');
define('COMPANY_TABLE',			'company');
define('DRIVER_TABLE',			'driver');
define('CAR_TABLE',		'categories');
define('CITY_TABLE',			'city');
define('COMMENT_TABLE',			'comments');
define('UNOFFICIAL_ORDER_TABLE','unofficial_order');
define('ORDER_TABLE',			'order');
define('DISPATCHER_TABLE',		'company_dispatcher');
define('DRIVER_TO_COMPANY_TABLE','driver_to_company');

/* MODE */
define('FULL_DAY',				3111);
define('HALF_DAY',				3112);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */

define('CITY','Almaty');
