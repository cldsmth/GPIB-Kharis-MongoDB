<?php
	include("helpers/require.php");
	include("controller/controller_reset_password.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$title['reset-password'];?></title>
		<?php include("parts/part-module-head.php");?>
	</head>
	<body class="simple-page">
		<div class="simple-page-wrap">
			<div class="simple-page-logo animated swing">
				<a href="#">
					<span><i class="fa fa-gg"></i></span>
					<span><?=$seo['company-name']." Administrator";?></span>
				</a>
			</div><!-- logo -->

			<div id="rest-form" class="simple-page-form animated flipInY">
				<h4 class="form-title m-b-xl text-center">Reset Your Password</h4>
				<form action="?action=reset" method="post" onsubmit="return validateForm();">
					<div class="form-group">
						<input id="input-password" name="password" type="password" class="form-control" placeholder="New Password">
                        <div id="error-password" class="is-error"></div>
                        <span class="note-input">
                        	<i class="fa fa-info-circle"></i> Password must contain the following: A lowercase letter, a capital (uppercase) letter, a number, and minimum 8 characters
                     	</span>
					</div>
					<div class="form-group">
						<input id="input-repassword" name="repassword" type="password" class="form-control" placeholder="Re-Type New Password">
                        <div id="error-repassword" class="is-error"></div>
					</div>
					<input name="p1" type="hidden" value="<?=$_p1;?>">
					<input name="p2" type="hidden" value="<?=$_p2;?>">
					<input name="url" type="hidden" value="<?=$path['reset-password']."?p1=".$_p1."&p2=".$_p2;?>">
					<input type="submit" class="btn btn-primary" value="SUBMIT">
				</form>
			</div><!-- #reset-form -->

		</div><!-- .simple-page-wrap -->

		<?php include("parts/part-footer-js.php");?>
		<script type="text/javascript">
			<?php if($message != ""){?>
				//use session here for alert success/failed
				var alertText = "<?=$message;?>"; //text for alert
				<?php if($alert != "success"){?>
					//error alert
					errorAlert(alertText);
				<?php } else { ?>
					//success alert
					successAlert(alertText);
				<?php } ?>
			<?php } ?>

			function validateForm(){
				var password = $("#input-password").val();
		        var repassword = $("#input-repassword").val();
		        var lowercaseformat = /[a-z]/g;
		        var uppercaseformat = /[A-Z]/g;
		        var numberformat = /[0-9]/g;
		        
		        if(password != ""){
		          if(password.match(lowercaseformat)){
		            $("#error-password").html("");
		            $("#error-password").hide();
		            $("#input-password").removeClass("input-error");
		          }else{
		            $("#error-password").show();
		            $("#error-password").html("<i class='fa fa-warning'></i> Password must contain at least one lowercase letter.");
		            $("#input-password").addClass("input-error");
		            $("#input-password").focus();
		            return false;
		          }
		          if(password.match(uppercaseformat)){
		            $("#error-password").html("");
		            $("#error-password").hide();
		            $("#input-password").removeClass("input-error");
		          }else{
		            $("#error-password").show();
		            $("#error-password").html("<i class='fa fa-warning'></i> Password must contain at least one capital (uppercase) letter.");
		            $("#input-password").addClass("input-error");
		            $("#input-password").focus();
		            return false;
		          }
		          if(password.match(numberformat)){
		            $("#error-password").html("");
		            $("#error-password").hide();
		            $("#input-password").removeClass("input-error");
		          }else{
		            $("#error-password").show();
		            $("#error-password").html("<i class='fa fa-warning'></i> Password must contain at least one number.");
		            $("#input-password").addClass("input-error");
		            $("#input-password").focus();
		            return false;
		          }
		          if(password.length >= 8){
		            $("#error-password").html("");
		            $("#error-password").hide();
		            $("#input-password").removeClass("input-error");
		          }else{
		            $("#error-password").show();
		            $("#error-password").html("<i class='fa fa-warning'></i> Password must contain at least 8 characters.");
		            $("#input-password").addClass("input-error");
		            $("#input-password").focus();
		            return false;
		          }
		        } else {
		          $("#error-password").show();
		          $("#error-password").html("<i class='fa fa-warning'></i> This field is required.");
		          $("#input-password").addClass("input-error");
		          $("#input-password").focus();
		          return false;
		        }
		        if(repassword != ""){
		          $("#error-repassword").html("");
		          $("#error-repassword").hide();
		          $("#input-repassword").removeClass("input-error");
		        } else {
		          $("#error-repassword").show();
		          $("#error-repassword").html("<i class='fa fa-warning'></i> This field is required.");
		          $("#input-repassword").addClass("input-error");
		          $("#input-repassword").focus();
		          return false;
		        }
		        if(password != "" && repassword != ""){
		          if(password != repassword){
		            $("#error-repassword").show();
		            $("#error-repassword").html("<i class='fa fa-warning'></i> Re-Type New Password does not match.");
		            $("#input-repassword").addClass("input-error");
		            $("#input-repassword").focus();
		            return false;
		          }
		        }
		        return true;
			}
		</script>
	</body>
</html>