<?php
  include("../../helpers/require.php");
  include("../../helpers/auth.php");
  include("controller/controller_event_category.php");
  $curpage = "event-category";
  $navpage = "Event";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?=$title['event-category'];?></title>
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
                <li class="active">Event Category Management</li>
              </ol>
      			</div>

            <!-- start: PAGE CONTENT -->
            <div class="col-md-12">
              <div class="widget">
                <header class="widget-header">
                  <div class="row">
                    <div class="col-sm-6">
                      <h4 class="widget-title">Manage Event Category</h4>
                    </div>
                    <div class="hidden-xs">
                      <div class="col-sm-6 text-right">
                        <a href="#panel-input" class="btn btn-xs btn-outline btn-primary" data-id="" data-title="" data-status="1" data-toggle="modal" data-target="#panel-input" onclick="copyValue(this)"><i class='fa fa-plus'></i> Create New Category</a>
                      </div>
                    </div>
                    <div class="visible-xs">
                      <div class="col-sm-6 text-left up1">
                        <a href="#panel-input" class="btn btn-xs btn-outline btn-primary" data-id="" data-title="" data-status="1" data-toggle="modal" data-target="#panel-input" onclick="copyValue(this)"><i class='fa fa-plus'></i> Create New Category</a>
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
                          <th>Title</th>
                          <th>Create Date</th>
                          <th>Last Updated</th>
                        </tr>
                        <?php $num=1; if(is_array($datas)){ foreach($datas as $data){?>
                        <tr>
                          <td class="text-left"><?=$num;?>.</td>
                          <td class="text-center">
                            <a href="javascript:void(0)" onclick="copyValue(this)" class="btn btn-xs btn-outline btn-success" data-id="<?=$data->id;?>" data-title="<?=correctDisplay($data->title);?>" data-status="<?=$data->status;?>" data-toggle="modal" data-target="#panel-input"><i class='fa fa-edit'></i> Edit</a>
                            <a href="javascript:void(0)" onclick="confirmDelete('<?=$data->id;?>', '<?=$data->title;?>' , 0);" class="btn btn-xs btn-outline btn-danger"><i class="fa fa-trash"></i> Delete</a>
                          </td>
                          <td class="text-center"><?=checkStatus($data->status);?></td>
                          <td><?=correctDisplay($data->title);?></td>
                          <td><?=date("d-M-Y, H:i:s", strtotime($data->datetime));?></td>
                          <td><?=($data->datetime != $data->timestamp ? time_ago($data->timestamp) : "-");?></td>
                        </tr>
                        <?php $num++;}}else{?>
                        <tr>
                          <td colspan="6">There is no data!</td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  </div>
                  <div id="default-datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap up2">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="dataTables_info" id="default-datatable_info" role="status" aria-live="polite"><?="Showing ".(is_array($datas) ? 1 : 0)." to ".$total_data." of ".$total_data." entries";?></div>
                      </div>
                    </div>
                  </div>                  
                </div><!-- .widget-body -->
              </div><!-- .widget -->
            </div>		
            <!-- end: PAGE CONTENT-->

            <!-- start: PANEL ADD MODAL FORM -->
            <div class="modal fade" id="panel-input" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                      &times;
                    </button>
                    <h4 class="modal-title"><span id="text-header"></span></h4>
                  </div>
                  <form name="form-category" action="index.php?action=save" enctype="multipart/form-data" method="post" onsubmit="return confirmSubmit();" >
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 form-label"><strong>Title <span class="symbol-required">*</span></strong> :</div>
                        <div class="col-sm-8 col-xs-12">
                          <input id="input-title" name="title" type="text" class="form-control input-style" placeholder="Title" maxlength="100">
                          <div id="error-title" class="is-error"></div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3 col-xs-12"></div>
                        <div class="col-sm-8 col-xs-12">
                          <span class="note-input">
                            <i class="fa fa-info-circle"></i> Max char 100
                          </span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 up1 form-label">Status :</div>
                        <div class="col-sm-8 col-xs-12 up1">
                          <div class="checkbox checkbox-primary">
                            <input id="input-status" name="status" type="checkbox" value="1">
                            <label for="input-status">
                              <span class="note-input">Unchecked if status inactive</span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer f5-bg">
                      <input id="input-id" type="hidden" name="id">
                      <input id="default-title" type="hidden" name="default_title">
                      <input id="default-status" type="hidden" name="default_status">
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

      function copyValue(x){
        var id = $(x).attr("data-id");
        var title = $(x).attr("data-title");
        var status = $(x).attr("data-status");
        var header = id != "" ? "Edit Event Category \""+title+"\"" : "Create New Event Category";

        $("#error-title").html("");
        $("#error-title").hide();
        $("#input-title").removeClass("input-error");
        $("#text-header").text(header);
        $("#input-id").val(id);
        $("#input-title").val(title);
        $("#input-status").prop("checked", status == 1 ? true : false);
        $("#default-title").val(title);
        $("#default-status").val(status == 1 ? true : false);
      }

      function validateForm(){
        var title = $("#input-title").val();

        if(title != ""){
          $("#error-title").html("");
          $("#error-title").hide();
          $("#input-title").removeClass("input-error");
        } else {
          $("#error-title").show();
          $("#error-title").html("<i class='fa fa-warning'></i> This field is required.");
          $("#input-title").addClass("input-error");
          $("#input-title").focus();
          return false;
        }
        return true;
      }

      function confirmSubmit(){
        if(validateForm()){
          var result;
          var id = document.getElementById("input-id");
          var title = document.getElementById("input-title");
          var status = document.getElementById("input-status");
          var default_title = document.getElementById("default-title");
          var default_status = document.getElementById("default-status");
          var array = [
            [default_title.value, title.value],
            [default_status.value == "true" ? true : false, status.checked]
          ];
          if(id.value != ""){
            if(isDataChanges(array)){
              result = confirm("Are you sure want to edit \""+title.value+"\" ?");
              if(result){
                $("#btn-submit").attr('disabled', 'disabled');
                $("#btn-submit").html("<i class='fa fa-spinner fa-spin'></i> Loading");
                document.getElementById("form-category").submit();
              }
            }else{
              alert("There is no change");
            }
          }else{
            result = confirm("Are you sure want to create \""+title.value+"\" ?");
            if(result){
              $("#btn-submit").attr('disabled', 'disabled');
              $("#btn-submit").html("<i class='fa fa-spinner fa-spin'></i> Loading");
              document.getElementById("form-category").submit();
            }
          }
        }
        return false;
      }

      function confirmDelete(id, title, total_data){
        if(total_data == 0){
          var x = confirm("Are you sure want to delete \""+title+"\" ?");
          if(x == true){
            window.location.href = "index.php?action=delete&id="+id+"&title="+title;
          }else{
            //nothing
          }
        }else{
          alert("You cannot delete \""+title+"\" when used in another page")
        }
      }
    </script>
  </body>
</html>