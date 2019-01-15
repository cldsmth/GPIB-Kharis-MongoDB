<?php
if(!isset($_SESSION['GpibKharis'])){
	$_SESSION['status'] = "You must login first.";
	$_SESSION['alert'] = "failed";
    header("Location:".$path['login']."?notLogin");

}else{
	if(isset($_COOKIE['cookie_datas']) && !isset($_SESSION['GpibKharis']['admin']['id'])){ //if login check me out
		create_session(json_decode($_COOKIE['cookie_datas'], true)); //set cookie in session
	}
}
?>