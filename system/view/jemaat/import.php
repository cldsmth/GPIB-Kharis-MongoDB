<?php
  include("../../helpers/require.php");
  include("../../helpers/auth.php");
  include("controller/controller_jemaat.php");
  $curpage = "import-jemaat";
  $navpage = "Setting";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?=$title['jemaat'];?></title>
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
                <li><a href="<?=$path['jemaat'];?>">Jemaat Management</a></li>
                <li class="active">Import</li>
              </ol>
      			</div>

            <!-- start: PAGE CONTENT -->
            <div class="col-md-12">
              <div class="widget">
                <header class="widget-header">
                  <div class="row">
                    <div class="col-sm-6">
                      <h4 class="widget-title">Import Data Jemaat</h4>
                    </div>
                  </div>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                  <form id="form-jemaat" action="<?=$path['jemaat'];?>index.php?action=import" enctype="multipart/form-data" method="post" onsubmit="return confirmSubmit();">
                    <div class="panel-body">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-sm-offset-3 col-sm-6 col-xs-12">
                            <div class="text-center">
                              <a target="_blank" href="<?=$global['uploads-url']."template/Sample.xls";?>" class="btn btn-outline btn-primary"><i class='fa fa-download'></i> Download Excel Template</a>
                            </div>
                          </div>
                        </div>
                        <div class="row up2">
                          <div class="col-sm-offset-3 col-sm-6 col-xs-12">
                            <div class="wrap-iexcel">
                              <label for="input-file" class="box-iexcel">
                                <div id="btn-iexcel" class="btn-iexcel">
                                  Choose File
                                </div>
                                <div id="text-iexcel" class="text-iexcel">Import Excel</div>
                              </label>
                              <input id="input-file" name="file" style="display: none;" type="file">
                              <input id="input-ext" type="hidden">
                              <div id="error-files" class="is-error"></div>
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-offset-3 col-sm-6 col-xs-12">
                            <div class="wrap-iexcel">
                              <span class="note-input">
                                <i class="fa fa-info-circle"></i> Import file format has to be xls, xlsx
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-footer">
                      <div class="row">
                        <div class="col-sm-12 text-right">
                          <div class="btn-group">
                            <a href="<?=$path['jemaat-import'];?>" class="btn btn-default"><i class='fa fa-times'></i> Cancel</a>
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
      
      $("#input-file").change(function(){
        var file_val = $(this).val();
        if(file_val != ""){
          var ext = getExtension(file_val);
          var filename = $(this)[0].files[0].name;
          $("#input-ext").val(ext);
          $("#text-iexcel").text(filename);
          $("#btn-iexcel").text("Change File");
        }else{
          $("#text-iexcel").text("Import Excel");
          $("#btn-iexcel").text("Choose File");
        }
      });

      function getExtension(filename){
        var parts = filename.split(".");
        return parts[parts.length - 1].toLowerCase();
      }

      function isExcel(ext){
        switch(ext){
          case 'xls':
            return true;
          break;
          case 'xlsx':
            return true;
          break;
        }
        return false;
      }

      function validateForm(){
        var files = $("#input-file").val();
        var ext = $("#input-ext").val();

        if(files != ""){
          if(!isExcel(ext)){
            $("#error-files").show();
            $("#error-files").html("<i class='fa fa-warning'></i> Invalid file format.");
            $("#input-file").addClass("input-error");
            $("#input-file").focus();
            return false;
          }else{
            $("#error-files").html("");
            $("#error-files").hide();
            $("#input-file").removeClass("input-error");
          }
        } else {
          $("#error-files").show();
          $("#error-files").html("<i class='fa fa-warning'></i> This field is required.");
          $("#input-file").addClass("input-error");
          $("#input-file").focus();
          return false;
        }
        return true;
      }

      function confirmSubmit(){
        if(validateForm()){
          var result = confirm("Are you sure want to import data jemaat ?");
          if(result){
            $("#btn-submit").attr('disabled', 'disabled');
            $("#btn-submit").html("<i class='fa fa-spinner fa-spin'></i> Loading");
            document.getElementById("form-jemaat").submit();
          }
        }
        return false;
      }
    </script>
  </body>
</html>