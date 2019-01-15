<?php
  include("../../helpers/require.php");
  include("../../helpers/auth.php");
  include("controller/controller_admin_detail.php");
  $curpage = "admin";
  $navpage = "Administrator";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?=$title['admin'];?></title>
    <?php include("../../parts/part-module-head.php");?>
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="<?=$global['absolute-url-admin'];?>libraries/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen">
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
                <li><a href="<?=$path['admin'].linkToIndex($_id, $_SERVER['QUERY_STRING']);?>">Admin Management</a></li>
                <li class="active">Edit</li>
              </ol>
      			</div>

            <!-- start: PAGE CONTENT -->
            <div class="col-md-12">
              <div class="widget">
                <?php if(hasProperty($datas, "id")){?>
                <header class="widget-header">
                  <div class="row">
                    <div class="col-sm-6">
                      <h4 class="widget-title">Admin "<?=correctDisplay($datas->name);?>"</h4>
                    </div>
                  </div>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                  <form id="form-admin" action="<?=$path['admin'];?>edit.php?action=edit" enctype="multipart/form-data" method="post" onsubmit="return confirmSubmit();">
                    <div class="panel-body">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 form-label"><strong>Name <span class="symbol-required">*</span></strong> :</div>
                          <div class="col-sm-5 col-xs-12">
                            <input id="input-name" name="name" type="text" class="form-control input-style" placeholder="Name" maxlength="100" value="<?=inputDisplay($datas->name);?>">
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
                            <input name="old_email" type="hidden" value="<?=$datas->email;?>">
                            <input id="input-email" name="new_email" type="text" class="form-control input-style" placeholder="E-mail" maxlength="100" value="<?=$datas->email;?>">
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
                        <div class="row up1"></div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 up1 form-label">Image :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <a class="fancybox" data-url="<?=$global['absolute-url'];?>" data-module="admin" data-img="<?=($datas->img != "" ? $encrypt->encrypt_decrypt("decrypt", $datas->img) : "");?>" href="javascript:void(0)" onclick="previewImage(this)">
                              <img style="width: 40px;" class="img-circle" src="<?=$path['decrypt-fie']."admin/thmb/".($datas->img != "" ? $datas->img : "null")."/";?>">
                            </a>
                            <div class="up1"></div>
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
                              <input <?=isChecked($datas->status, 1);?> id="input-status" name="status" type="checkbox" value="1">
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
                            <input name="id" type="hidden" value="<?=$datas->id;?>">
                            <input name="url" type="hidden" value="<?=$path['admin'].linkToIndex($_id, $_SERVER['QUERY_STRING']);?>">
                            <a href="<?=$path['admin'].linkToIndex($_id, $_SERVER['QUERY_STRING']);?>" class="btn btn-default"><i class='fa fa-times'></i> Cancel</a>
                            <button id="btn-submit" type="submit" class="btn btn-primary btn-md"><i class="fa fa-check"></i> Submit</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div><!-- .widget-body -->
                <?php }else{?>
                <div class="widget-body">
                  <div class="panel-body">
                    <div class="form-body">
                      <div class="row">
                        <div class="col-sm-12 col-xs-12">
                          <h1 id="_404_title" class="animated shake" style="color: #0288e5; margin-top: -35px;">404</h1>
                          <h5 id="_404_msg" class="animated slideInUp" style="color: #0288e5">Oops, an error occur. The page can't be found</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer">
                    <div class="row">
                      <div class="col-sm-12 text-center">
                        <div class="btn-group">
                          <a href="<?=$path['home'];?>" class="btn btn-default"><i class='fa fa-home'></i> Back to Home</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- .widget-body -->
                <?php }?>
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
    <script type="text/javascript" src="<?=$global['absolute-url-admin'];?>libraries/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $(".fancybox").fancybox({
          padding : 0
        });
      });

      $('#input-image').bind('change', function() {
        $("#input-image-size").val(sizeFile(this));
      });

      function validateForm(){
        var name = $("#input-name").val();
        var email = $("#input-email").val();
        var image = $("#input-image").val();
        var image_size = $("#input-image-size").val();
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

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
          var name = document.getElementById("input-name");
          var email = document.getElementById("input-email");
          var image = document.getElementById("input-image");
          var status = document.getElementById("input-status");
          var array = [
            [name.defaultValue, name.value],
            [email.defaultValue, email.value],
            [image.defaultValue, image.value],
            [status.defaultChecked, status.checked]
          ];
          if(isDataChanges(array)){
            var result = confirm("Are you sure want to edit ?");
            if(result){
              $("#btn-submit").attr('disabled', 'disabled');
              $("#btn-submit").html("<i class='fa fa-spinner fa-spin'></i> Loading");
              document.getElementById("form-admin").submit();
            }
          }else{
            alert("There is no change");
          }
        }
        return false;
      }
    </script>
  </body>
</html>