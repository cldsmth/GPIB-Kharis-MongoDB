<?php
if(!function_exists('hasProperty'))
{
    function hasProperty($object, $property){
        return isset($object->$property) ? true : false;
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

if(!function_exists('checkStatusText'))
{
    function checkStatusText($status){
        return $status == 1 ? "Aktif" : "Non Aktif";
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