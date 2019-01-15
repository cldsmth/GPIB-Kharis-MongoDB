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
                <li class="active">Admin Management</li>
              </ol>
      			</div>

            <!-- start: PAGE CONTENT -->
            <div class="col-md-12">
              <div class="widget">
                <header class="widget-header">
                  <div class="row">
                    <div class="col-sm-6">
                      <h4 class="widget-title">Manage Admin</h4>
                    </div>
                    <div class="hidden-xs">
                      <div class="col-sm-6 text-right">
                        <a href="<?=$path['admin-add'];?>" class="btn btn-xs btn-outline btn-primary"><i class='fa fa-plus'></i> Create New Admin</a>
                      </div>
                    </div>
                    <div class="visible-xs">
                      <div class="col-sm-6 text-left up1">
                        <a href="<?=$path['admin-add'];?>" class="btn btn-xs btn-outline btn-primary"><i class='fa fa-plus'></i> Create New Admin</a>
                      </div>
                    </div>
                  </div>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-horizontal-scroll">
                      <tbody>
                        <tr>
                          <th class="text-left">#</th>
                          <th class="text-center">Action</th>
                          <th class="text-center">Status</th>
                          <th class="text-center">Image</th>
                          <th>Name</th>
                          <th>E-mail</th>
                          <th>Create Date</th>
                          <th>Last Updated</th>
                        </tr>
                        <?php $num=1; if(hasProperty($datas, "data")){ foreach($datas->data as $data){?>
                        <tr>
                          <td class="text-left"><?=($_page-1)*20+$num;?>.</td>
                          <td class="text-center">
                            <div class="btn-group" role="group">
                              <button type="button" class="btn btn-outline btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gear"></i></button>
                              <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)" onclick="copyValue(this)" data-id="<?=$data->id;?>" data-name="<?=correctDisplay($data->name);?>" data-toggle="modal" data-target="#panel-change-password"><i class="fa fa-lock"></i> Change Password</a></li>
                                <li><a href="<?=$path['admin-edit']."?id=".$data->id.linkToEdit($_SERVER['QUERY_STRING']);?>"><i class='fa fa-edit'></i> Edit</a></li>
                                <li><a href="javascript:void(0)" onclick="confirmDelete('<?=$data->id;?>', '<?=$data->name;?>');"><i class="fa fa-trash"></i> Delete</a></li>
                              </ul>
                            </div>
                          </td>
                          <td class="text-center"><?=checkStatus($data->status);?></td>
                          <td class="text-center">
                            <a class="fancybox" data-url="<?=$global['absolute-url'];?>" data-module="admin" data-img="<?=($data->img != "" ? $encrypt->encrypt_decrypt("decrypt", $data->img) : "");?>" href="javascript:void(0)" onclick="previewImage(this)">
                              <img style="width: 40px;" class="img-circle" src="<?=$path['decrypt-fie']."admin/thmb/".($data->img != "" ? $data->img : "null")."/";?>">
                            </a>
                          </td>
                          <td><?=correctDisplay($data->name);?></td>
                          <td><?=$data->email;?></td>
                          <td><?=date("d-M-Y, H:i:s", strtotime($data->datetime));?></td>
                          <td><?=($data->datetime != $data->timestamp ? time_ago($data->timestamp) : "-");?></td>
                        </tr>
                        <?php $num++;}?>
                        <tr style="height: 100px;">
                          <td colspan="8"></td>
                        </tr>
                        <?php }else{?>
                        <tr>
                          <td colspan="8">There is no data!</td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  </div>
                  <div id="default-datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap up2">
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="dataTables_info" id="default-datatable_info" role="status" aria-live="polite"><?="Showing ".(($_page-1)*20+1)." to ".($total_data+(($_page-1)*20))." of ".$total_data_all." entries";?></div>
                      </div>
                      <div class="col-sm-7">
                        <?php include("../../parts/part-pagination.php");?>
                      </div>
                    </div>
                  </div>                  
                </div><!-- .widget-body -->
              </div><!-- .widget -->
            </div>		
            <!-- end: PAGE CONTENT-->

            <!-- start: PANEL ADD MODAL FORM -->
            <div class="modal fade" id="panel-change-password" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                      &times;
                    </button>
                    <h4 class="modal-title"><span id="text-header"></span></h4>
                  </div>
                  <form name="form-change-password" action="index.php?action=change_password" enctype="multipart/form-data" method="post" onsubmit="return confirmSubmitChangePassword();" >
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-4 col-xs-12 form-label"><strong>New Password <span class="symbol-required">*</span></strong> :</div>
                        <div class="col-sm-7 col-xs-12">
                          <input id="input-password" name="password" type="password" class="form-control input-style" placeholder="New Password">
                          <div id="error-password" class="is-error"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4 col-xs-12"></div>
                        <div class="col-sm-7 col-xs-12">
                          <span class="note-input">
                            <i class="fa fa-info-circle"></i> Password must contain the following: A lowercase letter, a capital (uppercase) letter, a number, and minimum 8 characters
                          </span>
                        </div>
                      </div>
                      <div class="row up1"></div>
                      <div class="row">
                        <div class="col-sm-4 col-xs-12 form-label"><strong>Re-Type New Password <span class="symbol-required">*</span></strong> :</div>
                        <div class="col-sm-7 col-xs-12">
                          <input id="input-repassword" name="repassword" type="password" class="form-control input-style" placeholder="Re-Type New Password">
                          <div id="error-repassword" class="is-error"></div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer f5-bg">
                      <input id="input-id" type="hidden" name="id">
                      <input id="input-name" type="hidden" name="name">
                      <input type="hidden" name="url" value="<?=$path['admin']."?page=".$_page;?>">
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

      function copyValue(x){
        var id = $(x).attr("data-id");
        var name = $(x).attr("data-name");
        var header = "Change Password \""+name+"\"";

        $("#error-password").html("");
        $("#error-password").hide();
        $("#input-password").removeClass("input-error");
        $("#error-repassword").html("");
        $("#error-repassword").hide();
        $("#input-repassword").removeClass("input-error");
        $("#text-header").text(header);
        $("#input-id").val(id);
        $("#input-name").val(name);
      }

      function validateFormChangePassword(){
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

      function confirmSubmitChangePassword(){
        if(validateFormChangePassword()){
          var name = $("#input-name").val();
          var result = confirm("Are you sure want to change password \""+name+"\" ?");
          if(result){
            $("#btn-submit").attr('disabled', 'disabled');
            $("#btn-submit").html("<i class='fa fa-spinner fa-spin'></i> Loading");
            document.getElementById("form-change-password").submit();
          }
        }
        return false;
      }

      function confirmDelete(id, name){
        var admin_id = "<?=$_SESSION['GpibKharis']['admin']['id'];?>";
        if(admin_id != id){
          var x = confirm("Are you sure want to delete \""+name+"\" ?");
          if(x == true){
            window.location.href = "index.php?action=delete&id="+id+"&name="+name;
          }else{
            //nothing
          }
        }else{
          alert("You cannot delete \""+name+"\" when you're logged in")
        }
      }
    </script>
  </body>
</html>