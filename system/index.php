<?php
	include("helpers/require.php");
	include("controller/controller_index.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$title['login'];?></title>
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

			<div id="login-form" class="simple-page-form animated flipInY">
				<h4 class="form-title m-b-xl text-center">Sign In With Your Account</h4>
				<form action="index.php?action=login" method="post" onsubmit="return validateForm();">
					<div class="form-group">
						<input id="input-email" type="text" name="email" class="form-control" placeholder="E-mail">
						<div id="error-email" class="is-error"></div>
					</div>
					<div class="form-group">
						<input id="input-password" type="password" name="password" class="form-control" placeholder="Password">
						<div id="error-password" class="is-error"></div>
					</div>
					<div class="form-group m-b-xl">
						<div class="checkbox checkbox-primary">
							<input id="cb-remember" type="checkbox" name="remember_me" value="yes">
							<label for="cb-remember">Keep me signed in</label>
						</div>
					</div>
					<input type="submit" class="btn btn-primary" value="SIGN IN">
				</form>
			</div><!-- #login-form -->

			<div class="simple-page-footer">
				<p><a href="#panel-forgot" data-toggle="modal" data-target="#panel-forgot">FORGOT YOUR PASSWORD ?</a></p>
			</div><!-- .simple-page-footer -->

			<!-- start: PANEL FORGOT MODAL FORM -->
            <div class="modal fade" id="panel-forgot" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                      &times;
                    </button>
                    <h4 class="modal-title">Forgot Your Password ?</h4>
                  </div>
                  <form name="form-forgot" action="index.php?action=forgot" enctype="multipart/form-data" method="post" onsubmit="return validateFormForgot();" >
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 form-label"><strong>E-mail <span class="symbol-required">*</span></strong> :</div>
                        <div class="col-sm-8 col-xs-12">
                          <input id="input-forgot-email" name="email" type="text" class="form-control input-style" placeholder="E-mail">
                          <div id="error-forgot-email" class="is-error"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3 col-xs-12"></div>
                        <div class="col-sm-8 col-xs-12">
                          <span class="note-input">
                            <i class="fa fa-info-circle"></i> If you forgot your password an email with a password reset link will be sent to you. Click on the link in that email and you will be taken to a page where you can then create a new password.
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer f5-bg">
                      <div class="btn-group">
                        <button type="reset" class="btn btn-default" data-dismiss="modal"><i class='fa fa-times'></i> Cancel</button>
                        <button id="btn-submit" type="submit" class="btn btn-primary btn-md"><i class="fa fa-check"></i> Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <!-- end: SPANEL CONFIGURATION MODAL FORM -->

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
				var email = $("#input-email").val();
				var password = $("#input-password").val();
				var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

				if(email != ""){
					if(email.match(mailformat)){
						$("#error-email").html("");
						$("#error-email").hide();
						$("#input-email").removeClass("input-error");
					} else {
						$("#error-email").show();
						$("#error-email").html("<i class='fa fa-warning'></i> Invalid e-mail format.");
						$("#input-email").addClass("input-error");
						$("#input-email").focus();
						return false;
					}
				} else {
					$("#error-email").show();
					$("#error-email").html("<i class='fa fa-warning'></i> This field is required.");
					$("#input-email").addClass("input-error");
					$("#input-email").focus();
					return false;
				}
				if(password != ""){
					$("#error-password").html("");
					$("#error-password").hide();
					$("#input-password").removeClass("input-error");
				} else {
					$("#error-password").show();
					$("#error-password").html("<i class='fa fa-warning'></i> This field is required.");
					$("#input-password").addClass("input-error");
					$("#input-password").focus();
					return false;
				}
				return true;
			}

			function validateFormForgot(){
				var email = $("#input-forgot-email").val();
				var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

				if(email != ""){
					if(email.match(mailformat)){
						$("#error-forgot-email").html("");
						$("#error-forgot-email").hide();
						$("#input-forgot-email").removeClass("input-error");
					} else {
						$("#error-forgot-email").show();
						$("#error-forgot-email").html("<i class='fa fa-warning'></i> Invalid e-mail format.");
						$("#input-forgot-email").addClass("input-error");
						$("#input-forgot-email").focus();
						return false;
					}
				} else {
					$("#error-forgot-email").show();
					$("#error-forgot-email").html("<i class='fa fa-warning'></i> This field is required.");
					$("#input-forgot-email").addClass("input-error");
					$("#input-forgot-email").focus();
					return false;
				}
				return true;
			}
		</script>
	</body>
</html>