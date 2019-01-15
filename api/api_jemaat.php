<?php
header("content-type: application/json");
header("access-control-allow-origin: *");
include_once(dirname(dirname(__FILE__))."/helpers/require_api.php");

if(isset($_GET['action'])){//start gate

	include_once($global['root-url']."class/Crud.php");
	$crud = new Crud();

	include_once($global['root-url']."model/Admin.php");
	$admin = new Admin();

	include_once($global['root-url']."model/Jemaat.php");
	$jemaat = new Jemaat();

	//===================================== export ========================================
	if($_GET['action'] == 'export' && issetVar(array('admin_id', 'auth_code'))){
		$_message = array("status" => "400", "message" => "No Data");
		$_admin_id = check_input($_POST['admin_id']);
		$_auth_code = check_input($_POST['auth_code']);
		$_keyword = isset($_POST['keyword']) ? check_input($_POST['keyword']) : "";
		$_sector = isset($_POST['sector']) ? check_input($_POST['sector']) : "";
		$_pelkat = isset($_POST['pelkat']) ? check_input($_POST['pelkat']) : "";
		$_gender = isset($_POST['gender']) ? check_input($_POST['gender']) : "";
		$_married = isset($_POST['married']) ? check_input($_POST['married']) : "";
		$_status = isset($_POST['status']) ? check_input($_POST['status']) : "";

		if($admin->check_code($crud, $_admin_id, $_auth_code)){
			$columns = array(0 => array('value' => "No", 'vAlign' => "center", 'hAlign' => "center"),
	            1 => array('value' => "Status", 'vAlign' => "center", 'hAlign' => "center"),
	            2 => array('value' => "Nama Jemaat"),
	            3 => array('value' => "Nama Keluarga"),
	            4 => array('value' => "Sektor", 'vAlign' => "center", 'hAlign' => "center"),
	            5 => array('value' => "Jenis Kelamin"),
	            6 => array('value' => "No. HP"),
	            7 => array('value' => "Tanggal Lahir", 'vAlign' => "center", 'hAlign' => "center"),
	            8 => array('value' => "Umur", 'vAlign' => "center", 'hAlign' => "center"),
	            9 => array('value' => "Status Menikah", 'vAlign' => "center", 'hAlign' => "center")
	        );
	        if(is_array($columns)){
	        	$jemaats = array();
	        	$i = 0;
	        	foreach($columns as $column){
	        		$jemaats[0]['cells'][$i]['value'] = $column['value'];
	        		if(isset($column['vAlign'])){
	        			$jemaats[0]['cells'][$i]['vAlign'] = $column['vAlign'];	
	        		}
	        		if(isset($column['hAlign'])){
	        			$jemaats[0]['cells'][$i]['hAlign'] = $column['hAlign'];
	        		}
					$jemaats[0]['cells'][$i]['color'] = "#000000";
					$jemaats[0]['cells'][$i]['background'] = "#a2a2a2";
					$jemaats[0]['cells'][$i]['fontSize'] = 14;
					$jemaats[0]['cells'][$i]['bold'] = true;
	        		$i++;
	        	}
	        	$result = $jemaat->get_all($crud, "", $_keyword, $_sector, $_pelkat, $_gender, $_married, $_status);
				//var_dump($result);
				if(hasProperty($result, "data")){
					$num = 1;
					foreach($result->data as $data){
						//no
						$jemaats[$num]['cells'][0]['value'] = $num;
						$jemaats[$num]['cells'][0]['vAlign'] = "center";
						$jemaats[$num]['cells'][0]['hAlign'] = "center";
						$jemaats[$num]['cells'][0]['fontSize'] = 12;
						//sector
						$jemaats[$num]['cells'][1]['value'] = checkStatusText($data->status);
						$jemaats[$num]['cells'][1]['vAlign'] = "center";
						$jemaats[$num]['cells'][1]['hAlign'] = "center";
						$jemaats[$num]['cells'][1]['fontSize'] = 12;
						//full name
						$jemaats[$num]['cells'][2]['value'] = $data->full_name;
						$jemaats[$num]['cells'][2]['fontSize'] = 12;
						//family name
						$jemaats[$num]['cells'][3]['value'] = $data->keluarga->name;
						$jemaats[$num]['cells'][3]['fontSize'] = 12;
						//sector
						$jemaats[$num]['cells'][4]['value'] = $data->keluarga->sector;
						$jemaats[$num]['cells'][4]['vAlign'] = "center";
						$jemaats[$num]['cells'][4]['hAlign'] = "center";
						$jemaats[$num]['cells'][4]['fontSize'] = 12;
						//gender
						$jemaats[$num]['cells'][5]['value'] = checkGender($data->gender);
						$jemaats[$num]['cells'][5]['fontSize'] = 12;
						//phone
						$jemaats[$num]['cells'][6]['value'] = checkPhone(array($data->phone1, $data->phone2, $data->phone3));
						$jemaats[$num]['cells'][6]['fontSize'] = 12;
						//birthday
						$jemaats[$num]['cells'][7]['value'] = $data->birthday != "0000-00-00" ? date("d-M-Y", strtotime($data->birthday)) : "-";
						$jemaats[$num]['cells'][7]['vAlign'] = "center";
						$jemaats[$num]['cells'][7]['hAlign'] = "center";
						$jemaats[$num]['cells'][7]['fontSize'] = 12;
						//age
						$jemaats[$num]['cells'][8]['value'] = (string) $data->age != null ? $data->age : "-";
						$jemaats[$num]['cells'][8]['vAlign'] = "center";
						$jemaats[$num]['cells'][8]['hAlign'] = "center";
						$jemaats[$num]['cells'][8]['fontSize'] = 12;
						//married
						$jemaats[$num]['cells'][9]['value'] = checkMarried($data->married);
						$jemaats[$num]['cells'][9]['vAlign'] = "center";
						$jemaats[$num]['cells'][9]['hAlign'] = "center";
						$jemaats[$num]['cells'][9]['fontSize'] = 12;
						$num++;
					}
				}
				if(is_array($jemaats)){
					$_message = array("status" => "200", "message" => "Data Exist", "data" => $jemaats);
				}
	        }
		}else{
			$_message = array("status" => "401", "message" => "Unauthorized");
		}
		echo json_encode($_message);
	}

	else{
		$_message = array("status" => "404", "message" => "Action Not Found");
		echo json_encode($_message);
	}
}//end gate
else{
	$_message = array("status" => "404", "message" => "Not Found");
	echo json_encode($_message);
}
?>