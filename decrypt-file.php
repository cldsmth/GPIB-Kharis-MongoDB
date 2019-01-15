<?php
include_once("helpers/config.php");
include_once("helpers/functions.php");

include_once($global['root-url']."class/Validation.php");
$validation = new Validation();

include_once($global['root-url']."class/Encryption.php");
$encrypt = new Encryption();

if(issetVar(array('module', 'type', 'data'))){
	$_module = check_input($_GET['module']);
	$_type = check_input($_GET['type']);
	$_data = check_input($_GET['data']);
	
	if($validation->check_empty($_GET, array('module', 'type', 'data')) == null){
		$thmb = $_type == "thmb" ? "thmb/" : "";
		$data = $_data == "null" ? "" : $encrypt->encrypt_decrypt("decrypt", $_data);
		$image = getUploadFile($global['root-url'], $_module, $thmb, $data);
		if($_data != "null"){
			$ext_tmp = explode('.', $data);
	        $ext = strtolower(end($ext_tmp));
			$image_name = $_data.".".$ext;
		}else{
			$image_name = $image;
		}
	    $filesize = filesize($image); //Get the filesize of the image for headers
    	header('Content-Type: image'); //Begin the header output
	    //Now actually output the image requested, while disregarding if the database was affected
	    header('Pragma: public');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	    header('Cache-Control: private', false);
	    header('Content-Disposition: attachment; filename='.$image_name);
	    header('Content-Transfer-Encoding: binary');
	    header('Content-Length: '.$filesize);
	    readfile($image);
	    exit; //All done, get out!
	}else{
		echo "Empty Data";
	}
}else{
	echo "No data";
}
?>