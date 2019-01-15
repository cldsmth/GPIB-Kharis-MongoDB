<?php
$root_url = dirname(dirname(__FILE__))."/";

include($root_url."helpers/require.php");

include_once($root_url."class/Crud.php");
$crud = new Crud();

include_once($root_url."model/Jemaat.php");
$jemaat = new Jemaat();

$datas = $jemaat->get_all($crud, "", "", "", "", "", "", "");
//var_dump($datas);
if(hasProperty($datas, "data")){
    $message = "";
    $num = 1;
    foreach($datas->data as $data){
        if($data->birthday != "0000-00-00"){
            $now_age = calculate_age($data->birthday);
            if($data->age != $now_age){
                $jemaat->update_age($crud, $data->id, $now_age);
                $message .= $num.". Umur ".$data->full_name." dari ".$data->age." menjadi ".$now_age."<br>";
                $num++;
            }
        }
    }
    if($message != ""){
        echo $message;
    }else{
        echo "Tidak ada perubahan umur";
    }
}
?>