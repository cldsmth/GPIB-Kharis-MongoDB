<?php
include_once($global['root-url']."class/Crud.php");
$crud = new Crud();

include_once($global['root-url']."class/Encryption.php");
$encrypt = new Encryption();

include_once($global['root-url']."class/Mail.php");
$mail = new Mail();

include_once($global['root-url']."model/Admin.php");
$admin = new Admin();

if(!isset($_GET['action'])){

	if(isset($_COOKIE['cookie_datas'])){
        header("Location:".$path['home']);
    }else{
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
    }
    
}else{

	if(isset($_GET['action'])){

	    if($_GET['action'] == 'login' && issetVar(array('email', 'password'))){
	        $_email = check_input($_POST['email']);
	        $_password = check_input($_POST['password']);
        	$_remember_me = isset($_POST['remember_me']) ? check_input($_POST['remember_me']) : "no";
        	$salt = $admin->get_salt($crud, $_email);
        	$password = substr(doHash($_password, $salt), 0, 64);

        	$result = $admin->login($crud, $_email, $password);
	        //var_dump($result);
	        if(hasProperty($result, "id")){
	        	if($result->status == 1){
	        		create_session($result);
		        	if(isset($_SESSION['GpibKharis']) && $_remember_me == "yes"){
		        		create_cookie(json_encode($_SESSION['GpibKharis']));
		        	}
	        		$page = $path['home'];
	        	}else{
	        		$_SESSION['status'] = "Login failed. Your account has been inactive";
		        	$_SESSION['alert'] = "failed";
		        	$page = $path['login'];
	        	}
	        }else{
	        	$_SESSION['status'] = "Login failed. Please try again";
	        	$_SESSION['alert'] = "failed";
	        	$page = $path['login'];
	        }
	        header("Location:".$page);
	    
	    } else if($_GET['action'] == 'forgot' && issetVar(array('email'))){
	        $_email = check_input($_POST['email']);
	        $_code = generate_code(8);

        	$result = $admin->check_email($crud, $_email);
	        //var_dump($result);
	        if($result){
	        	if($admin->update_reset_code($crud, $_email, $_code)){
	        		$subject = "Forget Password - GPIB Kharis";
                    $link = $path['reset-password']."?p1=".$encrypt->encrypt_decrypt("encrypt", $_email)."&p2=".$encrypt->encrypt_decrypt("encrypt", $_code);
                    $message_html = $mail->forget_password($link);
                    $sent = smtpmailer($_email, $smtp['url'], $smtp['from'], $smtp['password'], $smtp['from-name'], $subject, $message_html);
	        		if($sent){
	        			$message = "Password reset link successfully sent";
		        		$alert = "success";
	        		}else{
	        			$message = "Sent link forget password failed";
	        			$alert = "failed";
	        		}
	        	}else{
	        		$message = "Reset code forget password failed";
        			$alert = "failed";
	        	}
	        }else{
	        	$message = "E-mail not found for password reset link";
	        	$alert = "failed";
	        }

	        $_SESSION['status'] = $message;
	        $_SESSION['alert'] = $alert;
	        header("Location:".$path['login']);
	    
	    } else if($_GET['action'] == 'logout'){
		    //set end data session
		    end_cookie();
			end_session();
			if(!isset($_SESSION['GpibKharis'])){
				header("Location:".$path['login']."?logout");
			}

		} else {
	    	$_SESSION['status'] = "Action Not Found.";
	        $_SESSION['alert'] = "failed";
	        header("Location:".$path['login']);
	    }

	} else {
		$_SESSION['status'] = "Not Found.";
        $_SESSION['alert'] = "failed";
        header("Location:".$path['login']);
	}
	
}
?>