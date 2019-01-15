<?php
include_once($global['root-url']."class/Crud.php");
$crud = new Crud();

include_once($global['root-url']."class/RandomStringGenerator.php");
$generator = new RandomStringGenerator();

include_once($global['root-url']."model/Category.php");
$category = new Category();

if(!isset($_GET['action'])){
	$datas = $category->get_all($crud, "article");
    //var_dump($datas);
    $total_data = is_array($datas) ? count($datas) : 0;

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

	    if($_GET['action'] == "save" && issetVar(array('title'))){
	    	$category->setId(check_input($_POST['id']));
			$category->setTitle(check_input($_POST['title']));
			$category->setSlug(encode($category->getTitle()));
			$category->setType("article");
			$category->setStatus(isset($_POST['status']) ? check_input($_POST['status']) : 0);

			if($category->getId() != ""){
				$result = $category->update_data($crud, $category);
               	if($result){
                    $message = "Edit Article Category '".$category->getTitle()."' success";
                    $alert = "success";
                }else{
                    $message = "Edit Article Category '".$category->getTitle()."' failed. Please try again";
                    $alert = "failed";
                }
			}else{
				$category->setId($generator->generate(32));
				$result = $category->insert_data($crud, $category);
               	if($result){
                    $message = "Add New Article Category '".$category->getTitle()."' success";
                    $alert = "success";
                }else{
                    $message = "Add New Article Category '".$category->getTitle()."' failed. Please try again";
                    $alert = "failed";
                }
			}

	        $_SESSION['status'] = $message;
	        $_SESSION['alert'] = $alert;
	        header("Location:".$path['article-category']);
	    
	    } else if($_GET['action'] == "delete" && issetVar(array('id', 'title'))){
            $_id = check_input($_GET['id']);
            $_title = check_input($_GET['title']);
            
            $result = $category->delete_data($crud, $_id);
            if($result){
                $message = "Article Category '".$_title."' success to be deleted in system";
                $alert = "success";
            }else{
                $message = "Article Category '".$_title."' failed to be deleted in system";
                $alert = "failed";
            }

	        $_SESSION['status'] = $message;
	        $_SESSION['alert'] = $alert;
	        header("Location:".$path['article-category']);

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