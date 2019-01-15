<?php
  include("../../helpers/require.php");
  include("../../helpers/auth.php");
  include("controller/controller_keluarga_detail.php");
  $curpage = "keluarga";
  $navpage = "Master";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?=$title['keluarga'];?></title>
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
                <li><a href="<?=$path['keluarga'].linkToIndex($_id, $_SERVER['QUERY_STRING']);?>">Keluarga Management</a></li>
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
                      <h4 class="widget-title">Keluarga "<?=correctDisplay($datas->name);?>"</h4>
                    </div>
                  </div>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                  <form id="form-keluarga" action="<?=$path['keluarga'];?>edit.php?action=edit" enctype="multipart/form-data" method="post" onsubmit="return confirmSubmit();">
                    <div class="panel-body">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 form-label"><strong>Nama Keluarga <span class="symbol-required">*</span></strong> :</div>
                          <div class="col-sm-5 col-xs-12">
                            <input name="old_name" type="hidden" value="<?=inputDisplay($datas->name);?>">
                            <input id="input-name" name="new_name" type="text" class="form-control input-style" placeholder="Nama Keluarga" maxlength="100" value="<?=inputDisplay($datas->name);?>">
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
                          <div class="col-sm-4 col-xs-12 up1 form-label"><strong>Sektor <span class="symbol-required">*</span></strong> :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <select id="input-sector" name="sector" class="form-control">
                              <option value="">Pilih Sektor</option>
                              <?php if(is_array($sectors)){ foreach($sectors as $sector){?>
                              <option <?=isSelected($datas->sector, $sector['value']);?> value="<?=$sector['value'];?>"><?=$sector['text'];?></option>
                              <?php }}?>
                            </select>
                            <div id="error-sector" class="is-error"></div>
                          </div>
                        </div>
                        <div class="row up1"></div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 up1 form-label">Tanggal Pernikahan :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <div class="input-group">
                              <input id="input-wedding-date" name="wedding_date" type="text" class="form-control input-style" data-plugin="datetimepicker" data-options="{format: 'DD-MMM-YYYY'}" placeholder="Tanggal Pernikahan" value="<?=($datas->wedding_date != "0000-00-00" ? date("d-M-Y", strtotime($datas->wedding_date)) : "");?>">
                              <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                            </div>
                            <div id="error-wedding-date" class="is-error"></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12"></div>
                          <div class="col-sm-5 col-xs-12">
                            <span class="note-input">
                              <i class="fa fa-info-circle"></i> Format: mm/dd/yyyy
                            </span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 up1 form-label">Alamat :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <textarea id="input-address" name="address" class="form-control" rows="3" placeholder="Alamat" maxlength="255"><?=str_replace("<br>", "", correctDisplay($datas->address));?></textarea>
                            <div id="error-address" class="is-error"></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12"></div>
                          <div class="col-sm-5 col-xs-12">
                            <span class="note-input">
                              <i class="fa fa-info-circle"></i> Max char 255
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
                            <input id="default-sector" name="default_sector" type="hidden" value="<?=$datas->sector;?>">
                            <input name="url" type="hidden" name="url" value="<?=$path['keluarga'].linkToIndex($_id, $_SERVER['QUERY_STRING']);?>">
                            <a href="<?=$path['keluarga'].linkToIndex($_id, $_SERVER['QUERY_STRING']);?>" class="btn btn-default"><i class='fa fa-times'></i> Cancel</a>
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
    <script type="text/javascript">
      function validateForm(){
        var name = $("#input-name").val();
        var sector = $("#input-sector").val();
        var wedding_date = $("#input-wedding-date").val();

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
        if(sector != ""){
          $("#error-sector").html("");
          $("#error-sector").hide();
          $("#input-sector").removeClass("input-error");
        } else {
          $("#error-sector").show();
          $("#error-sector").html("<i class='fa fa-warning'></i> This field is required.");
          $("#input-sector").addClass("input-error");
          $("#input-sector").focus();
          return false;
        }
        if(wedding_date != ""){
          if(moment(wedding_date, "DD-MMM-YYYY", true).isValid()){
            $("#error-wedding-date").html("");
            $("#error-wedding-date").hide();
            $("#input-wedding-date").removeClass("input-error");
          } else {
            $("#error-wedding-date").show();
            $("#error-wedding-date").html("<i class='fa fa-warning'></i> Invalid date format.");
            $("#input-wedding-date").addClass("input-error");
            $("#input-wedding-date").focus();
            return false;
          }
        }
        return true;
      }

      function confirmSubmit(){
        if(validateForm()){
          var name = document.getElementById("input-name");
          var sector = document.getElementById("input-sector");
          var wedding_date = document.getElementById("input-wedding-date");
          var address = document.getElementById("input-address");
          var status = document.getElementById("input-status");
          var default_sector = document.getElementById("default-sector");
          var array = [
            [name.defaultValue, name.value],
            [default_sector.defaultValue, sector.value],
            [wedding_date.defaultValue, wedding_date.value],
            [address.defaultValue, address.value],
            [status.defaultChecked, status.checked]
          ];
          if(isDataChanges(array)){
            var result = confirm("Are you sure want to edit ?");
            if(result){
              $("#btn-submit").attr('disabled', 'disabled');
              $("#btn-submit").html("<i class='fa fa-spinner fa-spin'></i> Loading");
              document.getElementById("form-keluarga").submit();
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