<?php
include_once($global['root-url']."class/Crud.php");
$crud = new Crud();

include_once($global['root-url']."class/RandomStringGenerator.php");
$generator = new RandomStringGenerator();

include_once($global['root-url']."model/Keluarga.php");
$keluarga = new Keluarga();

include_once($global['root-url']."model/Jemaat.php");
$jemaat = new Jemaat();

if(!isset($_GET['action'])){
	$filename = PHPFilename();
    if($filename == "index"){
    	$_page = isset($_GET['page']) ? check_input($_GET['page']) : 1;
        $datas = $keluarga->get_all($crud, $_page);
	    //var_dump($datas);
	    $total_page = hasProperty($datas, "data") ? $datas->total_page : 0;
	    $total_data = hasProperty($datas, "data") ? $datas->total_data : 0;
	    $total_data_all = hasProperty($datas, "data") ? $datas->total_data_all : 0;

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
        $sectors = listSector();
    }
}else{

	if(isset($_GET['action'])){

	    if($_GET['action'] == "add" && issetVar(array('name', 'sector'))){
	    	$keluarga->setId($generator->generate(32));
			$keluarga->setName(check_input($_POST['name']));
			$keluarga->setSector(check_input($_POST['sector']));
			$keluarga->setWeddingDate(checkFormatDateValue(check_input($_POST['wedding_date'])));
			$keluarga->setAddress(check_input(nl2br($_POST['address'], false)));
			$keluarga->setStatus(isset($_POST['status']) ? check_input($_POST['status']) : 0);

			$check_name = $keluarga->check_name($crud, $keluarga->getName());
			if($check_name){
				$message = "Name '".$keluarga->getName()."' already exist";
				$alert = "failed";
			}else{
				$result = $keluarga->insert_data($crud, $keluarga);
               	if($result){
                    $message = "Add New Keluarga '".$keluarga->getName()."' success";
                    $alert = "success";
                }else{
                    $message = "Add New Keluarga '".$keluarga->getName()."' failed. Please try again";
                    $alert = "failed";
                }
			}

	        $_SESSION['status'] = $message;
	        $_SESSION['alert'] = $alert;
	        header("Location:".$path['keluarga']);
	    
	    } else if($_GET['action'] == "delete" && issetVar(array('id', 'name'))){
            $_id = check_input($_GET['id']);
            $_name = check_input($_GET['name']);

            if($jemaat->get_count_by_keluarga($crud, $_id) == 0){
            	$result = $keluarga->delete_data($crud, $_id);
	            if($result){
	                $message = "Keluarga '".$_name."' success to be deleted in system";
	                $alert = "success";
	            }else{
	                $message = "Keluarga '".$_name."' failed to be deleted in system";
	                $alert = "failed";
	            }
            }else{
            	$message = "You cannot delete '".$_name."' when used in another page";
            	$alert = "failed";
            }

	        $_SESSION['status'] = $message;
	        $_SESSION['alert'] = $alert;
	        header("Location:".$path['keluarga']);

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