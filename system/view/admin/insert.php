<?php
  include("../../helpers/require.php");
  include("../../helpers/auth.php");
  include("controller/controller_admin.php");
  $curpage = "admin";
  $navpage = "Administrator";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?=$title['admin'];?></title>
    <?php include("../../parts/part-module-head.php");?>
  </head>
  <body class="menubar-left menubar-unfold menubar-light theme-primary">

    <!-- APP NAVBAR !-->
    <?php include("../../parts/part-navbar.php");?>

    <!-- APP ASIDE !-->
    <?php include("../../parts/part-aside.php");?>

    <!-- APP MAIN -->
    <main id="app-main" class="app-main">
      <div class="wrap">
      	<section class="app-content">
      		<div class="row">

            <!-- Breadcrumb !-->
      			<div class="col-md-12 pad0">
              <ol class="breadcrumb" style="background: none;">
                <li><a href="<?=$path['home'];?>">Home</a></li>
                <li><a href="<?=$path['admin'];?>">Admin Management</a></li>
                <li class="active">Insert</li>
              </ol>
      			</div>

            <!-- start: PAGE CONTENT -->
            <div class="col-md-12">
              <div class="widget">
                <header class="widget-header">
                  <div class="row">
                    <div class="col-sm-6">
                      <h4 class="widget-title">Create New Admin</h4>
                    </div>
                  </div>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                  <form id="form-admin" action="<?=$path['admin'];?>index.php?action=add" enctype="multipart/form-data" method="post" onsubmit="return confirmSubmit();">
                    <div class="panel-body">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 form-label"><strong>Name <span class="symbol-required">*</span></strong> :</div>
                          <div class="col-sm-5 col-xs-12">
                            <input id="input-name" name="name" type="text" class="form-control input-style" placeholder="Name" maxlength="100">
                            <div id="error-name" class="is-error"></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12"></div>
                          <div class="col-sm-5 col-xs-12">
                            <span class="note-input">
                              <i class="fa fa-info-circle"></i> Max char 100
                            </span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 up1 form-label"><strong>E-mail <span class="symbol-required">*</span></strong> :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <input id="input-email" name="email" type="text" class="form-control input-style" placeholder="E-mail" maxlength="100">
                            <div id="error-email" class="is-error"></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12"></div>
                          <div class="col-sm-5 col-xs-12">
                            <span class="note-input">
                              <i class="fa fa-info-circle"></i> Max char 100
                            </span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 up1 form-label"><strong>Password <span class="symbol-required">*</span></strong> :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <input id="input-password" name="password" type="password" class="form-control input-style" placeholder="Password">
                            <div id="error-password" class="is-error"></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12"></div>
                          <div class="col-sm-5 col-xs-12">
                            <span class="note-input">
                              <i class="fa fa-info-circle"></i> Password must contain the following: A lowercase letter, a capital (uppercase) letter, a number, and minimum 8 characters
                            </span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 up1 form-label"><strong>Re-Type Password <span class="symbol-required">*</span></strong> :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <input id="input-repassword" name="repassword" type="password" class="form-control input-style" placeholder="Re-Type Password">
                            <div id="error-repassword" class="is-error"></div>
                          </div>
                        </div>
                        <div class="row up1"></div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 up1 form-label">Image :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <input id="input-image" name="image" type="file" class="form-control">
                            <input id="input-image-size" name="image_size" type="hidden">
                            <div id="error-image" class="is-error"></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12"></div>
                          <div class="col-sm-5 col-xs-12">
                            <span class="note-input">
                              <i class="fa fa-info-circle"></i> Image will be best shown in 800px by 360px.<br>Image format has to be jpg, jpeg, png. Image max 9 MB
                            </span>
                          </div>
                        </div>
                        <div class="row up1"></div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 up1 form-label">Status :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <div class="checkbox checkbox-primary">
                              <input id="input-status" checked name="status" type="checkbox" value="1">
                              <label for="input-status">
                                <span class="note-input">Unchecked if status inactive</span>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-footer">
                      <div class="row">
                        <div class="col-sm-12 text-right">
                          <div class="btn-group">
                            <a href="<?=$path['admin'];?>" class="btn btn-default"><i class='fa fa-times'></i> Cancel</a>
                            <button id="btn-submit" type="submit" class="btn btn-primary btn-md"><i class="fa fa-check"></i> Submit</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div><!-- .widget-body -->
              </div><!-- .widget -->
            </div>		
            <!-- end: PAGE CONTENT-->
      	
        	</div><!-- .row -->
      	</section><!-- #dash-content -->
      </div><!-- .wrap -->

      <!-- APP FOOTER !-->
      <?php include("../../parts/part-footer.php");?>

    </main>
  	<?php include("../../parts/part-footer-js.php");?>
    <script type="text/javascript">
      $('#input-image').bind('change', function() {
        $("#input-image-size").val(sizeFile(this));
      });

      function validateForm(){
        var name = $("#input-name").val();
        var email = $("#input-email").val();
        var password = $("#input-password").val();
        var repassword = $("#input-repassword").val();
        var image = $("#input-image").val();
        var image_size = $("#input-image-size").val();
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var lowercaseformat = /[a-z]/g;
        var uppercaseformat = /[A-Z]/g;
        var numberformat = /[0-9]/g;

        if(name != ""){
          $("#error-name").html("");
          $("#error-name").hide();
          $("#input-name").removeClass("input-error");
        } else {
          $("#error-name").show();
          $("#error-name").html("<i class='fa fa-warning'></i> This field is required.");
          $("#input-name").addClass("input-error");
          $("#input-name").focus();
          return false;
        }
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
            $("#error-repassword").html("<i class='fa fa-warning'></i> Re-Type Password does not match.");
            $("#input-repassword").addClass("input-error");
            $("#input-repassword").focus();
            return false;
          }
        }
        if(image != ""){
          if(!checkFormatImage(image)){
            $("#error-image").show();
            $("#error-image").html("<i class='fa fa-warning'></i> Invalid image format.");
            $("#input-image").addClass("input-error");
            $("#input-image").focus();
            return false;
          }else{
            if(image_size > 9097152){
              $("#error-image").show();
              $("#error-image").html("<i class='fa fa-warning'></i> File size must under 9mb!");
              $("#input-image").addClass("input-error");
              $("#input-image").focus();
              return false;
            }else{
              $("#error-image").html("");
              $("#error-image").hide();
              $("#input-image").removeClass("input-error");
            }
          }
        }
        return true;
      }

      function confirmSubmit(){
        if(validateForm()){
          var name = $("#input-name").val();
          var result = confirm("Are you sure want to create \""+name+"\" ?");
          if(result){
            $("#btn-submit").attr('disabled', 'disabled');
            $("#btn-submit").html("<i class='fa fa-spinner fa-spin'></i> Loading");
            document.getElementById("form-admin").submit();
          }
        }
        return false;
      }
    </script>
  </body>
</html>