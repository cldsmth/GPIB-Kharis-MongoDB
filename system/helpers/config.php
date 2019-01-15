<?php
define('PATH', "http://".$_SERVER['HTTP_HOST']."/gpib/");
define('ADMIN', PATH."system/");
define('ROOT', $_SERVER['DOCUMENT_ROOT']."/");
define('NAME', "GPIB Kharis");

$global = array(
	'absolute-url' => PATH,
	'absolute-url-admin' => ADMIN,
	'root-url' => ROOT."gpib/",
	'uploads-url' => PATH."uploads/",
	'api' => PATH."api/",
	'favicon' => ADMIN."assets/images/logo.png"
);

$seo = array(
	'company-name' => NAME,
	'copyright' => "Copyright ".NAME." ".date('Y')." &copy;"
);

$smtp = array(
	'url' => "www.eannovate.com",
	'to' => "dean11.cliff@gmail.com",
	'from' => "cliff.dean@eannovate.com",
	'from-name' => "Developer",
	'password' => "Cliff123"
);

$path = array(
	'login' => ADMIN,
	'logout' => ADMIN."?action=logout",
	'reset-password' => ADMIN."reset-password/",
	'decrypt-fie' => PATH."file/",
	'home' => ADMIN."view/home/",
	'admin' => ADMIN."view/admin/",
	'admin-add' => ADMIN."view/admin/new/",
	'admin-edit' => ADMIN."view/admin/update/",
	'article-category' => ADMIN."view/article-category/",
	'event-category' => ADMIN."view/event-category/",
	'keluarga' => ADMIN."view/keluarga/",
	'keluarga-add' => ADMIN."view/keluarga/new/",
	'keluarga-edit' => ADMIN."view/keluarga/update/",
	'jemaat' => ADMIN."view/jemaat/",
	'jemaat-add' => ADMIN."view/jemaat/new/",
	'jemaat-edit' => ADMIN."view/jemaat/update/",
	'jemaat-import' => ADMIN."view/jemaat/import/"
);

$title = array(
	'login' => NAME." | Login",
	'reset-password' => NAME." | Reset Password",
	'home' => NAME." | Home",
	'admin' => NAME." | Admin",
	'article-category' => NAME." | Article Category",
	'event-category' => NAME." | Event Category",
	'keluarga' => NAME." | Keluarga",
	'jemaat' => NAME." | Jemaat"
);
?>