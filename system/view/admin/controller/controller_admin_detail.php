<?php
include_once($global['root-url']."class/Crud.php");
$crud = new Crud();

include_once($global['root-url']."class/Encryption.php");
$encrypt = new Encryption();

include_once($global['root-url']."class/SimpleImage.php");
$image = new SimpleImage();

include_once($global['root-url']."model/Admin.php");
$admin = new Admin();

if(!isset($_GET['action'])){
	$_id = isset($_GET['id']) ? check_input($_GET['id']) : "";
	$datas = $admin->get_detail($crud, $_id);
	//var_dump($datas);
}else{

	if(isset($_GET['action'])){

	    if($_GET['action'] == "edit" && issetVar(array('id', 'name', 'new_email'))){
	    	$admin->setId(check_input($_POST['id']));
			$admin->setName(check_input($_POST['name']));
			$admin->setEmail(check_input($_POST['new_email']));
			$admin->setStatus(isset($_POST['status']) ? check_input($_POST['status']) : 0);
			$_old_email = check_input($_POST['old_email']);
			$_url = check_input($_POST['url']);

			$check_email = $admin->getEmail() != $_old_email ? $admin->check_email($crud, $admin->getEmail()) : false;
			if($check_email){
				$message = "E-mail '".$admin->getEmail()."' already exist";
				$alert = "failed";
			}else{
				$images = save_image($image, "image", $global['root-url']."uploads/admin/");
				if($images['status'] == 200){
					$admin->setImage($encrypt->encrypt_decrypt("encrypt", $images['data']['filename']));
				}
				$result = $admin->update_data($crud, $admin, $encrypt, $global['root-url']."uploads/admin/");
               	if($result){
                    $message = "Edit Administrator '".$admin->getName()."' success";
                    $alert = "success";
                }else{
                    $message = "Edit Administrator '".$admin->getName()."' failed. Please try again";
                    $alert = "failed";
                }
			}

	        $_SESSION['status'] = $message;
	        $_SESSION['alert'] = $alert;
	        header("Location:".$_url);
	    
	    } else {
	    	$_SESSION['status'] = "Action Not Found.";
	        $_SESSION['alert'] = "failed";
	        header("Location:".$path['home']);
	    }

	} else {
		$_SESSION['status'] = "Not Found.";
        $_SESSION['alert'] = "failed";
        header("Location:".$path['home']);
	}
	
}
?>