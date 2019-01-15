<?php
if(!function_exists('smtpmailer'))
{
    function smtpmailer($to, $from_url, $from, $from_password, $from_name, $subject, $body){
        global $error;
        $mail = new PHPMailer(); // create a new object
        $mail->CharSet = "UTF-8";
        //Server settings
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = ""; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = ""; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = $from_url;
        $mail->Port = 587;
        $mail->Username = $from;
        $mail->Password = $from_password;
        //Recipients
        $mail->SetFrom($from, $from_name);
        $mail->Subject = html_entity_decode($subject);
        $mail->isHTML(true); //Send HTML or Plain Text email
        $mail->Body = $body;
        if(is_array($to)){
            for($i=0; $i<count($to); $i++){
                $mail->AddAddress($to[$i]);
            }
        }else{
            $mail->AddAddress($to);
        }
        //check email send
        if(!$mail->Send()) {
            $error = 'Mail error: '.$mail->ErrorInfo;
            return false;
        } else {
            $error = 'Message sent!';
            return true;
        }
    }
}

if(!function_exists('linkToPage'))
{
    function linkToPage($page, $query_string){
        return str_replace("page=".$page, "", $query_string);
    }
}

if(!function_exists('linkToEdit'))
{
    function linkToEdit($query_string){
        return $query_string != "" ? "&".$query_string : "";
    }
}

if(!function_exists('linkToIndex'))
{
    function linkToIndex($id, $query_string){
        if($query_string != ""){
            $query = str_replace("id=".$id, "", $query_string);
            if($query != ""){
                $query = str_replace("&page=", "page=", $query);
                $query = "?".$query;
            }else{
                $query = str_replace("&", "", $query);
            }
        }else{
            $query = "";
        }
        return $query;
    }
}

if(!function_exists('RemoveAdvancedSearch'))
{
    function RemoveAdvancedSearch($page, $param, $data, $query_string){
        $query = str_replace("page=".$page, "page=1", $query_string);
        return str_replace($param."=".$data, $param."=", check_input(urldecode($query)));
    }
}

if(!function_exists('TextAdvancedSearch'))
{
    function TextAdvancedSearch($param, $data){
        $text = "";
        switch ($param) {
            case "keyword":
                $text = "Keyword <i>contains</i>&nbsp;&nbsp;<code>\"".correctDisplay($data)."\"</code>&nbsp;from advanced search";
                break;
            case "sector":
                $text = "Sector <i>is selected</i>&nbsp;&nbsp;<code>\"".$data."\"</code>&nbsp;from advanced search";
                break;
            case "pelkat":
                $text = "Pelkat <i>is selected</i>&nbsp;&nbsp;<code>\"".strtoupper($data)."\"</code>&nbsp;from advanced search";
                break;
            case "gender":
                if($data == "m"){
                    $data = "Male";
                }else if($data == "f"){
                    $data = "Female";
                }
                $text = "Gender <i>is selected</i>&nbsp;&nbsp;<code>\"".$data."\"</code>&nbsp;from advanced search";
                break;
            case "married":
                $data = $data == 1 ? "Married" : "Single";
                $text = "Status Marriage <i>is selected</i>&nbsp;&nbsp;<code>\"".$data."\"</code>&nbsp;from advanced search";
                break;
            case "status":
                $data = $data == 1 ? "Active" : "Inactive";
                $text = "Status <i>is selected</i>&nbsp;&nbsp;<code>\"".$data."\"</code>&nbsp;from advanced search";
                break;
            default:
                $text = "";
                break;
        }
        return $text;
    }
}

if(!function_exists('contains'))
{
    function contains($haystack, $needle){
        return strpos($haystack, $needle) !== false;
    }
}

if(!function_exists('hasProperty'))
{
    function hasProperty($object, $property){
        return isset($object->$property) ? true : false;
    }
}

if(!function_exists('listSector'))
{
    function listSector(){
        $data = array(0 => array('value' => 1, 'text' => "Sektor 1"),
            1 => array('value' => 2, 'text' => "Sektor 2"),
            2 => array('value' => 3, 'text' => "Sektor 3"),
            3 => array('value' => 4, 'text' => "Sektor 4")
        );
        return $data;
    }
}

if(!function_exists('listPelkat'))
{
    function listPelkat(){
        $data = array(0 => array('value' => "pa", 'text' => "PA"),
            1 => array('value' => "pt", 'text' => "PT"),
            2 => array('value' => "gp", 'text' => "GP"),
            3 => array('value' => "pkp", 'text' => "PKP"),
            4 => array('value' => "pkb", 'text' => "PKB"),
            5 => array('value' => "pklu", 'text' => "PKLU")
        );
        return $data;
    }
}

if(!function_exists('listGender'))
{
    function listGender(){
        $data = array(0 => array('value' => "m", 'text' => "Laki-laki"),
            1 => array('value' => "f", 'text' => "Perempuan")
        );
        return $data;
    }
}

if(!function_exists('listMarried'))
{
    function listMarried(){
        $data = array(0 => array('value' => "1", 'text' => "Menikah"),
            1 => array('value' => "0", 'text' => "Belum Menikah")
        );
        return $data;
    }
}

if(!function_exists('listStatus'))
{
    function listStatus(){
        $data = array(0 => array('value' => "1", 'text' => "Aktif"),
            1 => array('value' => "0", 'text' => "Non Aktif")
        );
        return $data;
    }
}

if(!function_exists('characterToHTMLEntity'))
{
    function characterToHTMLEntity($str){
        $search = array('&', '<', '>', '€', '‘', '’', '“', '”', '–', '—', 
            '¡', '¢', '£', '¤', '¥', '¦', '§', '¨', '©', 'ª', 
            '«', '¬', '®', '¯', '°', '±', '²', '³', '´', 'µ', 
            '¶', '·', '¸', '¹', 'º', '»', '¼', '½', '¾', '¿', 
            'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 
            'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 
            'Ô', 'Õ', 'Ö', '×', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 
            'Þ', 'ß', 'à', 'á', 'â', 'ã','ä', 'å', 'æ', 'ç', 
            'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ñ', 
            'ò', 'ó', 'ô', 'õ', 'ö', '÷', 'ø', 'ù', 'ú', 'û', 
            'ü', 'ý', 'þ', 'ÿ','Œ', 'œ', '‚', '„', '…', '™', 
            '•', '˜', '"', '\'', '\n');
        $replace = array('&amp;', '&lt;', '&gt;', '&euro;', '&lsquo;', '&rsquo;', '&ldquo;', '&rdquo;', '&ndash;', '&mdash;', 
            '&iexcl;','&cent;', '&pound;', '&curren;', '&yen;', '&brvbar;', '&sect;', '&uml;', '&copy;', '&ordf;', 
            '&laquo;', '&not;', '&reg;', '&macr;', '&deg;', '&plusmn;', '&sup2;', '&sup3;', '&acute;', '&micro;', 
            '&para;', '&middot;', '&cedil;', '&sup1;', '&ordm;', '&raquo;', '&frac14;', '&frac12;', '&frac34;', '&iquest;', 
            '&Agrave;', '&Aacute;', '&Acirc;', '&Atilde;', '&Auml;', '&Aring;', '&AElig;', '&Ccedil;', '&Egrave;', '&Eacute;', 
            '&Ecirc;', '&Euml;', '&Igrave;', '&Iacute;', '&Icirc;', '&Iuml;', '&ETH;', '&Ntilde;', '&Ograve;', '&Oacute;', 
            '&Ocirc;', '&Otilde;', '&Ouml;', '&times;', '&Oslash;', '&Ugrave;', '&Uacute;', '&Ucirc;', '&Uuml;', '&Yacute;', 
            '&THORN;', '&szlig;', '&agrave;', '&aacute;', '&acirc;', '&atilde;', '&auml;', '&aring;', '&aelig;', '&ccedil;', 
            '&egrave;', '&eacute;','&ecirc;', '&euml;', '&igrave;', '&iacute;', '&icirc;', '&iuml;', '&eth;', '&ntilde;', 
            '&ograve;', '&oacute;', '&ocirc;', '&otilde;', '&ouml;', '&divide;','&oslash;', '&ugrave;', '&uacute;', '&ucirc;', 
            '&uuml;', '&yacute;', '&thorn;', '&yuml;', '&OElig;', '&oelig;', '&sbquo;', '&bdquo;', '&hellip;', '&trade;', 
            '&bull;', '&asymp;', '&quot;', '&rsquo;', '<br>');
        $str = str_replace($search, $replace, $str); //REPLACE VALUES
        return $str; //RETURN FORMATED STRING
    }
}

if(!function_exists('save_image'))
{
    function save_image($image, $param, $upload_link){
        $result = array("status" => "400", "message" => "No data");
        if(isset($_FILES[$param]['name'])){
            if(!empty($_FILES[$param]['name'])){
                $allowed_ext = array('jpg', 'jpeg', 'png');
                $file_name = time().rand().cleanSpace($_FILES[$param]['name']);
                $file_ext_tmp = explode('.', $file_name);
                $file_ext = strtolower(end($file_ext_tmp));
                $file_type = $_FILES[$param]['type'];
                $file_size = $_FILES[$param]['size'];
                $file_tmp = $_FILES[$param]['tmp_name'];

                if(in_array($file_ext, $allowed_ext) === true){
                    if($file_size < 9097152){
                        $file_loc = $upload_link.$file_name;
                        $file_locThmb = $upload_link."thmb/".$file_name;
                        //Resizing images
                        if(move_uploaded_file($file_tmp, $file_loc)){
                            $image->load($file_loc);
                            $image->resize(200, 200);
                            $image->save($file_locThmb);
                            $result = array("status" => "200", "message" => "Upload image success");
                            $result['data']['filename'] = $file_name;
                        }else{
                            $result = array("status" => "400", "message" => "Upload image failed");
                        }
                    }else{
                        $result = array("status" => "413", "message" => "ERROR: file size max 9 MB!");
                    }
                }else{
                    $result = array("status" => "415", "message" => "ERROR: extension file invalid!");
                }
            }else{
                $result = array("status" => "404", "message" => "Upload file is empty");
            }
        }else{
            $result = array("status" => "404", "message" => "Upload file is empty");
        }
        return $result;
    }
}

if(!function_exists('save_excel'))
{
    function save_excel($param, $upload_link){
        $result = array("status" => "400", "message" => "No data");
        if(isset($_FILES[$param]['name'])){
            if(!empty($_FILES[$param]['name'])){
                $allowed_ext = array('xls', 'xlsx');
                $file_name = time().rand().cleanSpace($_FILES[$param]['name']);
                $file_ext_tmp = explode('.', $file_name);
                $file_ext = strtolower(end($file_ext_tmp));
                $file_type = $_FILES[$param]['type'];
                $file_size = $_FILES[$param]['size'];
                $file_tmp = $_FILES[$param]['tmp_name'];

                if(in_array($file_ext, $allowed_ext) === true){
                    $file_loc = $upload_link.$file_name;
                    if(move_uploaded_file($file_tmp, $file_loc)){
                        $result = array("status" => "200", "message" => "Upload excel success");
                        $result['data']['filename'] = $file_name;
                        $result['data']['location'] = $file_loc;
                    }else{
                        $result = array("status" => "400", "message" => "Upload excel failed");
                    }
                }else{
                    $result = array("status" => "415", "message" => "ERROR: extension file invalid!");
                }
            }else{
                $result = array("status" => "404", "message" => "Upload file is empty");
            }
        }else{
            $result = array("status" => "404", "message" => "Upload file is empty");
        }
        return $result;
    }
}

if(!function_exists('getUploadFile'))
{
    function getUploadFile($url, $module, $thmb, $data){
        $data = trim($data);
        if($data != ""){
            switch ($module) {
                case "admin":
                    $result = $url."uploads/admin/".$thmb.$data;
                break;
                default:
                    $result = $url."img/placeholder-image.png";
                break;
            }
        }else{
            if($module == "admin"){
                $result = $url."img/placeholder-anonymous.jpg";
            }else{
                $result = $url."img/placeholder-image.png";
            }
        }
        return $result;
    }
}

if(!function_exists('colorStatus'))
{
    function colorStatus($status){
        return $status == 1 ? "" : "danger";
    }
}

if(!function_exists('checkFullName'))
{
    function checkFullName($first_name, $middle_name, $last_name){
        return $first_name.($middle_name != "" ? " ".$middle_name." ".$last_name : " ".$last_name);
    }
}

if(!function_exists('checkPhone'))
{
    function checkPhone($phones){
        $phone = "";
        if(is_array($phones)){
            $num = 1;
            for($i=0; $i < count($phones); $i++){
                if($phones[$i] != ""){
                    $slash = $num == 1 ? "" : " / ";
                    $phone .= $slash.$phones[$i];
                    $num++;
                }
            }
        }
        return $phone;
    }
}

if(!function_exists('checkGender'))
{
    function checkGender($gender){
        switch ($gender) {
            case "m":
                $result = "Laki-laki";
                break;
            case "f":
                $result = "Perempuan";
                break;
            default:
                $result = "-";
                break;
        }
        return $result;
    }
}

if(!function_exists('checkMarried'))
{
    function checkMarried($status){
        return $status == 1 ? "Menikah" : "Belum Menikah";
    }
}

if(!function_exists('checkStatus'))
{
    function checkStatus($status){
        return $status == 1 ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>";
    }
}

if(!function_exists('checkGenderValue'))
{
    function checkGenderValue($gender){
        if(contains($gender, "L")){
            $result = "m";
        }else if(contains($gender, "P")){
            $result = "f";
        }else{
            $result = "";
        }
        return $result;
    }
}

if(!function_exists('checkMarriedValue'))
{
    function checkMarriedValue($status){
        return $status == "Menikah" ? 1 : 0;
    }
}

if(!function_exists('checkStatusValue'))
{
    function checkStatusValue($status){
        return $status == "Aktif" ? 1 : 0;
    }
}

if(!function_exists('checkFormatDateValue'))
{
    function checkFormatDateValue($date){
        return $date != "" ? date("Y-m-d", strtotime($date)) : "0000-00-00";
    }
}

if(!function_exists('PHPFilename'))
{
    function PHPFilename(){
        return basename($_SERVER['SCRIPT_FILENAME'], ".php");
    }
}

if(!function_exists('in_array_any'))
{
    function in_array_any($needles, $haystack){
       return (bool) array_intersect($needles, $haystack);
    }
}

if(!function_exists('issetVar'))
{
    function issetVar($datas){
        $count = 0;
        $index = 0;
        $var_array = array();
        if(is_array($datas)){
            $count = count($datas);
            foreach($datas as $data){
                if(isset($_REQUEST[$data])){
                    if($_REQUEST[$data] != ""){
                        $var_array[$index] = $data;
                        $index++;
                    }
                }
            }
        }
        return $count == count($var_array) ? true : false;
    }
}

if(!function_exists('create_session'))
{
    function create_session($datas){
        end_session();
        $_SESSION['GpibKharis']['admin']['id'] = $datas->id;
        $_SESSION['GpibKharis']['admin']['name'] = $datas->name;
        $_SESSION['GpibKharis']['admin']['email'] = $datas->email;
        $_SESSION['GpibKharis']['admin']['img'] = $datas->img;
        $_SESSION['GpibKharis']['admin']['auth_code'] = $datas->auth_code;
    }
}

if(!function_exists('end_session'))
{
    function end_session(){
        if(isset($_SESSION['GpibKharis'])){
            unset($_SESSION['GpibKharis']);
        }
    }
}

if(!function_exists('create_cookie'))
{
    function create_cookie($datas){
        $path = "/gpib/admin/";
        $cookie_time = (3600 * 24 * 15); // 15 day
        setcookie("cookie_datas", $datas, time() + $cookie_time, $path);
    }
}

if(!function_exists('end_cookie'))
{
    function end_cookie(){
        $path = "/gpib/admin/";
        $cookie_time = (3600 * 24 * 15); // 15 day
        setcookie("cookie_datas", "", time() - $cookie_time, $path);
    }
}

if(!function_exists('generate_code'))
{
    function generate_code($length=6, $type=1){
        $key = "";
        switch($type){
            case 2:
            $pattern = "abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz";
            break;
            case 3:
            $pattern = "12345678901234567890123456789012345678901234567890";
            break;
            default:
            $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
            break;
        }
        for($i=0;$i<$length;$i++){
            $key .= $pattern{rand(0,35)};
        }
        return strtoupper($key);
    }
}

if(!function_exists('formatRupiah'))
{
    function formatRupiah($data) {
        $result = "";
        $result = 'Rp '.number_format($data,0,'.','.');

        return $result;
    }
}

if(!function_exists('formatNumber'))
{
    function formatNumber($data) {
        $result = "";
        $result = number_format($data,0,'.','.');

        return $result;
    }
}

if(!function_exists('cleanSpace'))
{
    function cleanSpace($string) {
        $string = trim($string);
        while(strpos($string,' ')){
            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        }
        return $string;
    }
}

if(!function_exists('calculate_age'))
{
    function calculate_age($date){
        if($date == "0000-00-00"){
            return null;
        }
        $today = new DateTime(nowDate());
        $birthdate = new DateTime($date);
        $interval = $today->diff($birthdate);
        return $interval->format('%y');
    }
}

if(!function_exists('time_ago'))
{
    function time_ago($time_ago){
        date_default_timezone_set('Asia/Jakarta');
        $time_ago = strtotime($time_ago);
        $cur_time = time();
        $time_elapsed = $cur_time - $time_ago;
        $seconds = $time_elapsed;
        $minutes = round($time_elapsed / 60);
        $hours = round($time_elapsed / 3600);
        $days = round($time_elapsed / 86400);
        $weeks = round($time_elapsed / 604800);
        $months = round($time_elapsed / 2600640);
        $years = round($time_elapsed / 31207680);

        if($seconds <= 60){ //Seconds
            return "just now";
        }else if($minutes <= 60){ //Minutes
            if($minutes == 1){
                return "one minute ago";
            }else{
                return "$minutes minutes ago";
            }
        }else if($hours <= 24){ //Hours
            if($hours == 1){
                return "an hour ago";
            }else{
                return "$hours hours ago";
            }
        }else if($days <= 7){ //Days
            if($days == 1){
                return "yesterday";
            }else{
                return "$days days ago";
            }
        }else if($weeks <= 4.3){ //Weeks
            if($weeks == 1){
                return "a week ago";
            }else{
                return "$weeks weeks ago";
            }
        }else if($months <= 12){ //Months
            if($months == 1){
                return "a month ago";
            }else{
                return "$months months ago";
            }
        }else{
            if($years == 1){ //Years
                return "one year ago";
            }else{
                return "$years years ago";
            }
        }
    }
}

if(!function_exists('clean'))
{
    function clean($string) {
        $search = array('&amp;', '&lt;', '&gt;', '&euro;', '&lsquo;', '&rsquo;', '&ldquo;', '&rdquo;', '&ndash;', '&mdash;', 
            '&iexcl;','&cent;', '&pound;', '&curren;', '&yen;', '&brvbar;', '&sect;', '&uml;', '&copy;', '&ordf;', 
            '&laquo;', '&not;', '&reg;', '&macr;', '&deg;', '&plusmn;', '&sup2;', '&sup3;', '&acute;', '&micro;', 
            '&para;', '&middot;', '&cedil;', '&sup1;', '&ordm;', '&raquo;', '&frac14;', '&frac12;', '&frac34;', '&iquest;', 
            '&Agrave;', '&Aacute;', '&Acirc;', '&Atilde;', '&Auml;', '&Aring;', '&AElig;', '&Ccedil;', '&Egrave;', '&Eacute;', 
            '&Ecirc;', '&Euml;', '&Igrave;', '&Iacute;', '&Icirc;', '&Iuml;', '&ETH;', '&Ntilde;', '&Ograve;', '&Oacute;', 
            '&Ocirc;', '&Otilde;', '&Ouml;', '&times;', '&Oslash;', '&Ugrave;', '&Uacute;', '&Ucirc;', '&Uuml;', '&Yacute;', 
            '&THORN;', '&szlig;', '&agrave;', '&aacute;', '&acirc;', '&atilde;', '&auml;', '&aring;', '&aelig;', '&ccedil;', 
            '&egrave;', '&eacute;','&ecirc;', '&euml;', '&igrave;', '&iacute;', '&icirc;', '&iuml;', '&eth;', '&ntilde;', 
            '&ograve;', '&oacute;', '&ocirc;', '&otilde;', '&ouml;', '&divide;','&oslash;', '&ugrave;', '&uacute;', '&ucirc;', 
            '&uuml;', '&yacute;', '&thorn;', '&yuml;', '&OElig;', '&oelig;', '&sbquo;', '&bdquo;', '&hellip;', '&trade;', 
            '&bull;', '&asymp;', '&quot;', '<br>');
        $string = str_replace($search, "", $string);
        $string = str_replace(" ", "-", $string);
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        $string = strtolower($string); // Convert to lowercase
        return $string;
    }
}

if(!function_exists('encode'))
{
    function encode($param){
        $new_result = $param;
        if($param != null){
            $result = clean($param);
            $new_result = rawurlencode($result);
        }
        return $new_result;
    }
}

if(!function_exists('decode'))
{
    function decode($param){
        $new_result = $param;
        if($param != null){
            $new_result = str_replace('-',' ',$param);
        }
        return $new_result;
    }
}

if(!function_exists('isSelected'))
{
    function isSelected($value, $data){
        return $value == $data ? "selected" : "";
    }
}

if(!function_exists('isChecked'))
{
    function isChecked($value, $data){
        return $value == $data ? "checked" : "";
    }
}

if(!function_exists('nowDate'))
{
    function nowDate() {
        $date = date_create("", timezone_open('Asia/Jakarta'));
        $date = date_format($date, 'Y-m-d');
        return $date;
    }
}

if(!function_exists('nowDateComplete'))
{
    function nowDateComplete() {
        $date = date_create("", timezone_open('Asia/Jakarta'));
        $date = date_format($date, 'jS F Y - g:i A');
        return $date;
    }
}

if(!function_exists('xss_clean'))
{
    function xss_clean($data){
        //Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        //Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        //Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        //Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        //Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
        do{
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);
        return $data;
    }
}

if(!function_exists('check_input'))
{
    function check_input($data) {
        $data = trim($data);
        $data = xss_clean($data);
        $data = characterToHTMLEntity($data);
        return $data;
    }
}

if(!function_exists('charLength'))
{
    //function to put 3dots after lengthy string
    function charLength($data, $length) {
        $strLength = strlen($data);
        if ($strLength > $length) {
            $data = substr(strip_tags($data), 0, $length) . "...";
        }
        return $data;
    }
}

if(!function_exists('doHash'))
{
    function doHash($secData, $salt) {
        //creates a random 5 character sequence
        $secData = hash('sha256', $salt . $secData);
        return $secData;
    }
}

if(!function_exists('inputDisplay'))
{
    function inputDisplay($data) {
        $data = htmlentities($data);
        $data = html_entity_decode($data);
        return $data;
    }
}

if(!function_exists('correctDisplay'))
{
    function correctDisplay($data) {
        $data = htmlspecialchars_decode(stripslashes($data), ENT_QUOTES);
        return $data;
    }
}
?>