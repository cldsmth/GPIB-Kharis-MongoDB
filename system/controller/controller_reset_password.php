<?php
include_once($global['root-url']."class/Crud.php");
$crud = new Crud();

include_once($global['root-url']."class/Encryption.php");
$encrypt = new Encryption();

include_once($global['root-url']."model/Admin.php");
$admin = new Admin();

if(!isset($_GET['action'])){
	$_p1 = isset($_GET['p1']) ? check_input($_GET['p1']) : "";
	$_p2 = isset($_GET['p2']) ? check_input($_GET['p2']) : "";
	$_email = $encrypt->encrypt_decrypt("decrypt", $_p1);
    $_code = $encrypt->encrypt_decrypt("decrypt", $_p2);

    $check_reset_code = $admin->check_reset_code($crud, $_email, $_code);
	if($check_reset_code){
		if(isset($_SESSION['status'])){
	        $message = $_SESSION['status'];
	        unset($_SESSION['status']);
	    } else {
	        $message = "";
	    }

	    if(isset($_SESSION['alert'])){
	        $alert = $_SESSION['alert'];
	        unset($_SESSION['alert']);
	    } else {
	        $alert = "";
	    }
	}else{
    	$_SESSION['status'] = "Link reset password has been expired";
        $_SESSION['alert'] = "failed";
        header("Location:".$path['login']);
	}
    
}else{

	if(isset($_GET['action'])){

	    if($_GET['action'] == 'reset' && issetVar(array('p1', 'p2', 'password', 'repassword'))){
	    	$_p1 = check_input($_POST['p1']);
	    	$_p2 = check_input($_POST['p2']);
	    	$_password = check_input($_POST['password']);
            $_repassword = check_input($_POST['repassword']);
            $_url = check_input($_POST['url']);
            $_email = $encrypt->encrypt_decrypt("decrypt", $_p1);
            $_code = $encrypt->encrypt_decrypt("decrypt", $_p2);
            $_salt = substr(md5(time()), 0, 5);
            $password = substr(doHash($_password, $_salt), 0, 64);

            if($_password == $_repassword){
            	$check_reset_code = $admin->check_reset_code($crud, $_email, $_code);
            	if($check_reset_code){
            		$result = $admin->reset_password($crud, $_email, $_code, $password, $_salt);
	               	if($result){
	                    $message = "Reset password success. Try to sign in with your new password";
	                    $alert = "success";
	                    $page = $path['login'];
	                }else{
	                    $message = "Reset password failed";
	                    $alert = "failed";
	                    $page = $_url;
	                }
            	}else{
            		$message = "E-mail / Reset Code not found";
                	$alert = "failed";
                	$page = $_url;
            	}
			}else{
				$message = "Password does not match";
                $alert = "failed";
                $page = $_url;
			}

	        $_SESSION['status'] = $message;
	        $_SESSION['alert'] = $alert;
	        header("Location:".$page);
	    
		} else {
	    	$_SESSION['status'] = "Action Not Found.";
	        $_SESSION['alert'] = "failed";
	        header("Location:".$path['reset-password']);
	    }

	} else {
		$_SESSION['status'] = "Not Found.";
        $_SESSION['alert'] = "failed";
        header("Location:".$path['reset-password']);
	}
	
}
?>