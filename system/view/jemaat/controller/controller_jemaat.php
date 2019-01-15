<?php
include_once($global['root-url']."class/Crud.php");
$crud = new Crud();

include_once($global['root-url']."class/RandomStringGenerator.php");
$generator = new RandomStringGenerator();

include_once($global['root-url']."model/Jemaat.php");
$jemaat = new Jemaat();

include_once($global['root-url']."model/Keluarga.php");
$keluarga = new Keluarga();

if(!isset($_GET['action'])){
	$filename = PHPFilename();
    if($filename == "index"){
    	$_page = isset($_GET['page']) ? check_input($_GET['page']) : 1;
		$_keyword = isset($_GET['keyword']) ? check_input($_GET['keyword']) : "";
		$_sector = isset($_GET['sector']) ? check_input($_GET['sector']) : "";
		$_pelkat = isset($_GET['pelkat']) ? check_input($_GET['pelkat']) : "";
		$_gender = isset($_GET['gender']) ? check_input($_GET['gender']) : "";
		$_married = isset($_GET['married']) ? check_input($_GET['married']) : "";
		$_status = isset($_GET['status']) ? check_input($_GET['status']) : "";
        $datas = $jemaat->get_all($crud, $_page, $_keyword, $_sector, $_pelkat, $_gender, $_married, $_status);
	    //var_dump($datas);
	    $total_page = hasProperty($datas, "data") ? $datas->total_page : 0;
	    $total_data = hasProperty($datas, "data") ? $datas->total_data : 0;
	    $total_data_all = hasProperty($datas, "data") ? $datas->total_data_all : 0;
	    //advanced search
	    $sectors = listSector();
    	$pelkats = listPelkat();
    	$genders = listGender();
    	$marrieds = listMarried();
    	$statuss = listStatus();
	    $searchs = array_filter(array($_keyword, $_sector, $_pelkat, $_gender, $_married, $_status), "strlen");
		$filters = array(0 => array('param' => "keyword", 'value' => $_keyword),
	        1 => array('param' => "sector", 'value' => $_sector),
	        2 => array('param' => "pelkat", 'value' => $_pelkat),
	        3 => array('param' => "gender", 'value' => $_gender),
	        4 => array('param' => "married", 'value' => $_married),
	        5 => array('param' => "status", 'value' => $_status)
	    );
    }else if($filename == "insert"){
        $keluargas = $keluarga->get_list($crud);
    }else{
    	//code import
    }

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

	if(isset($_GET['action'])){

	    if($_GET['action'] == "add" && issetVar(array('first_name', 'last_name', 'keluarga', 'gender'))){
	    	$jemaat->setId($generator->generate(32));
	    	$jemaat->setKeluargaId(check_input($_POST['keluarga']));
			$jemaat->setFirstName(check_input($_POST['first_name']));
			$jemaat->setMiddleName(check_input($_POST['middle_name']));
			$jemaat->setLastName(check_input($_POST['last_name']));
			$jemaat->setFullName(checkFullName($jemaat->getFirstName(), $jemaat->getMiddleName(), $jemaat->getLastName()));
			$jemaat->setGender(check_input($_POST['gender']));
			$jemaat->setBirthday(checkFormatDateValue(check_input($_POST['birthday'])));
			$jemaat->setAge(calculate_age($jemaat->getBirthday()));
			$jemaat->setPhone1(check_input($_POST['phone1']));
			$jemaat->setPhone2(check_input($_POST['phone2']));
			$jemaat->setPhone3(check_input($_POST['phone3']));
			$jemaat->setNotes(check_input(nl2br($_POST['notes'], false)));
			$jemaat->setMarried(isset($_POST['married']) ? check_input($_POST['married']) : 0);
			$jemaat->setStatus(isset($_POST['status']) ? check_input($_POST['status']) : 0);

			$check_name = $jemaat->check_name($crud, $jemaat->getFullName());
			if($check_name){
				$message = "Name '".$jemaat->getFullName()."' already exist";
				$alert = "failed";
			}else{
				$result = $jemaat->insert_data($crud, $jemaat);
	           	if($result){
	                $message = "Add New Jemaat '".$jemaat->getFullName()."' success";
	                $alert = "success";
	            }else{
	                $message = "Add New Jemaat '".$jemaat->getFullName()."' failed. Please try again";
	                $alert = "failed";
	            }
			}

	        $_SESSION['status'] = $message;
	        $_SESSION['alert'] = $alert;
	        header("Location:".$path['jemaat']);
	    
	    } else if($_GET['action'] == "delete" && issetVar(array('id', 'name'))){
	    	$_id = check_input($_GET['id']);
            $_name = check_input($_GET['name']);

            $result = $jemaat->delete_data($crud, $_id);
            if($result){
                $message = "Jemaat '".$_name."' success to be deleted in system";
                $alert = "success";
            }else{
                $message = "Jemaat '".$_name."' failed to be deleted in system";
                $alert = "failed";
            }

	        $_SESSION['status'] = $message;
	        $_SESSION['alert'] = $alert;
	        header("Location:".$path['jemaat']);

        } else if($_GET['action'] == "import" && isset($_FILES['file'])){
	    	error_reporting(E_ALL^E_NOTICE); //remove notice
            include_once($global['root-url']."/system/libraries/php-excel-reader/excel_reader2.php");
            include_once($global['root-url']."/system/libraries/php-excel-reader/SpreadsheetReader.php");

            $datas = "";
            $excels = save_excel("file", $global['root-url']."uploads/template/");
			if($excels['status'] == 200){
				$file_location = $excels['data']['location'];
				chmod($file_location, 0777);
				$datas = array();
				$num = 0;

				$Reader = new SpreadsheetReader($file_location);
                $totalSheet = count($Reader->sheets());
                for($i=0; $i < $totalSheet; $i++){
                    $Reader->ChangeSheet($i);
                    $isFormat = false;
                    $index = 0;
                    foreach($Reader as $Row){
                        if($index > 0){
                        	if($isFormat){
                        		if($Row[0] != ""){
                        			$sector = check_input($Row[1]);
                        			$first_name = check_input($Row[2]);
	                        		$middle_name = check_input($Row[3]);
	                        		$last_name = check_input($Row[4]);
	                        		$full_name = checkFullName($first_name, $middle_name, $last_name);
	                        		$keluarga_name = check_input($Row[5]);
	                        		$gender = checkGenderValue(check_input($Row[6]));
	                        		$phones = explode(" / ", check_input($Row[7]));
	                        		$status = checkStatusValue(check_input($Row[8]));
	                        		$married = checkMarriedValue(check_input($Row[9]));
	                        		$notes = check_input($Row[10]);
	                        		$birthday = checkFormatDateValue(check_input($Row[11]));
	                        		$age = calculate_age($birthday);
	                        		$address = check_input($Row[12]);
	                        		//set array data
	                        		$datas['data'][$num]['sector'] = $sector;
	                        		$datas['data'][$num]['first_name'] = $first_name;
	                        		$datas['data'][$num]['middle_name'] = $middle_name;
	                        		$datas['data'][$num]['last_name'] = $last_name;
	                        		$datas['data'][$num]['full_name'] = $full_name;
	                        		$datas['data'][$num]['keluarga_name'] = $keluarga_name;
	                        		$datas['data'][$num]['gender'] = $gender;
	                        		for($i=0; $i < 3; $i++){
	                        			$phone = isset($phones[$i]) ? $phones[$i] : "";
	                        			$datas['data'][$num]['phone'.($i+1)] = $phone;
	                        		}
	                        		$datas['data'][$num]['married'] = $married;
	                        		$datas['data'][$num]['status'] = $status;
	                        		$datas['data'][$num]['notes'] = $notes;
	                        		$datas['data'][$num]['birthday'] = $birthday;
	                        		$datas['data'][$num]['age'] = $age;
	                        		$datas['data'][$num]['address'] = $address;
	                        		$num++;
                        		}
                        	}
                        }else{
                        	$columns = array(0 => array('value' => $Row[0], 'text' => "NO"),
					            1 => array('value' => $Row[1], 'text' => "SEKTOR"),
					            2 => array('value' => $Row[2], 'text' => "NAMA AWAL"),
					            3 => array('value' => $Row[3], 'text' => "NAMA AKHIR"),
					            4 => array('value' => $Row[4], 'text' => "NAMA MARGA"),
					            5 => array('value' => $Row[5], 'text' => "NAMA KELUARGA"),
					            6 => array('value' => $Row[6], 'text' => "JENIS KELAMIN"),
					            7 => array('value' => $Row[7], 'text' => "NO. TELP / HP"),
					            8 => array('value' => $Row[8], 'text' => "STATUS AKTIF"),
					            9 => array('value' => $Row[9], 'text' => "STATUS MENIKAH"),
					            10 => array('value' => $Row[10], 'text' => "CATATAN"),
					            11 => array('value' => $Row[11], 'text' => "TANGGAL LAHIR"),
					            12 => array('value' => $Row[12], 'text' => "ALAMAT"),
					        );
                        	$array_check = array();
                        	$index_check = 0;
                        	foreach($columns as $column){
                        		if($column['value'] == $column['text']){
                        			$array_check[$index_check] = true;
                        			$index_check++;
                        		}
                        	}
                        	if(count($array_check) == count($columns)){
                        		$isFormat = true;
                        	}
                        }
                        $index++;
                    }
                }
                unlink($file_location);
			}

			//var_dump(json_encode($datas));
			if(is_array($datas)){
				if(isset($datas['data'])){
					$message = "Import file excel success";
					$alert = "success";

					foreach($datas['data'] as $data){
						$sector = $data['sector'];
						$first_name = $data['first_name'];
						$middle_name = $data['middle_name'];
						$last_name = $data['last_name'];
						$full_name = $data['full_name'];
						$keluarga_name = $data['keluarga_name'];
						$gender = $data['gender'];
						$phone1 = $data['phone1'];
						$phone2 = $data['phone2'];
						$phone3 = $data['phone3'];
						$married = $data['married'];
						$status = $data['status'];
						$notes = $data['notes'];
						$birthday = $data['birthday'];
						$age = $data['age'];
						$address = $data['address'];
						//check keluarga
						$keluarga_id = $keluarga->get_id_by_name($crud, $keluarga_name);
						if($keluarga_id == ""){
							$keluarga->setId($generator->generate(32));
							$keluarga->setName($keluarga_name);
							$keluarga->setSector($sector);
							$keluarga->setWeddingDate("0000-00-00");
							$keluarga->setAddress($address);
							$keluarga->setStatus($status);
							$result = $keluarga->insert_data($crud, $keluarga);
							if($result){
								$keluarga_id = $keluarga->getId();
							}
						}
						//check jemaat
						$check_jemmat = $jemaat->check_name($crud, $full_name);
						if(!$check_jemmat){
							$jemaat->setId($generator->generate(32));
					    	$jemaat->setKeluargaId($keluarga_id);
							$jemaat->setFirstName($first_name);
							$jemaat->setMiddleName($middle_name);
							$jemaat->setLastName($last_name);
							$jemaat->setFullName($full_name);
							$jemaat->setGender($gender);
							$jemaat->setBirthday($birthday);
							$jemaat->setAge($age);
							$jemaat->setPhone1($phone1);
							$jemaat->setPhone2($phone2);
							$jemaat->setPhone3($phone3);
							$jemaat->setNotes($notes);
							$jemaat->setMarried($married);
							$jemaat->setStatus($status);
							$jemaat->insert_data($crud, $jemaat);
						}
					}
				}else{
					$message = "Invalid format column file excel. Please check your file excel with the same format template";
					$alert = "failed";
				}
			}else{
				$message = "Import file excel failed";
				$alert = "failed";
			}

			$_SESSION['status'] = $message;
	        $_SESSION['alert'] = $alert;
	        header("Location:".$path['jemaat-import']);
	    
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