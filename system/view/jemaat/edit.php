<?php
  include("../../helpers/require.php");
  include("../../helpers/auth.php");
  include("controller/controller_jemaat_detail.php");
  $curpage = "jemaat";
  $navpage = "Master";
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
                <li><a href="<?=$path['jemaat'].linkToIndex($_id, $_SERVER['QUERY_STRING']);?>">Jemaat Management</a></li>
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
                      <h4 class="widget-title">Jemaat "<?=correctDisplay($datas->full_name);?>"</h4>
                    </div>
                  </div>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                  <form id="form-jemaat" action="<?=$path['jemaat'];?>edit.php?action=edit" enctype="multipart/form-data" method="post" onsubmit="return confirmSubmit();">
                    <div class="panel-body">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 form-label"><strong>Nama Depan <span class="symbol-required">*</span></strong> :</div>
                          <div class="col-sm-5 col-xs-12">
                            <input id="input-first-name" name="first_name" type="text" class="form-control input-style" placeholder="Nama Depan" maxlength="100" value="<?=inputDisplay($datas->first_name);?>">
                            <div id="error-first-name" class="is-error"></div>
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
                          <div class="col-sm-4 col-xs-12 up1 form-label">Nama Tengah :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <input id="input-middle-name" name="middle_name" type="text" class="form-control input-style" placeholder="Nama Tengah" maxlength="100" value="<?=inputDisplay($datas->middle_name);?>">
                            <div id="error-middle-name" class="is-error"></div>
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
                          <div class="col-sm-4 col-xs-12 up1 form-label"><strong>Nama Marga <span class="symbol-required">*</span></strong> :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <input id="input-last-name" name="last_name" type="text" class="form-control input-style" placeholder="Nama Marga" maxlength="100" value="<?=inputDisplay($datas->last_name);?>">
                            <div id="error-last-name" class="is-error"></div>
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
                          <div class="col-sm-4 col-xs-12 up1 form-label"><strong>Nama Keluarga <span class="symbol-required">*</span></strong> :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <select id="input-keluarga" name="keluarga" class="form-control">
                              <option value="">Pilih Nama Keluarga</option>
                              <?php if(is_array($keluargas)){ foreach($keluargas as $keluarga){?>
                              <option <?=isSelected($datas->keluarga_id, $keluarga->id);?> value="<?=$keluarga->id;?>"><?=$keluarga->name;?></option>
                              <?php }}?>
                            </select>
                            <div id="error-keluarga" class="is-error"></div>
                          </div>
                        </div>
                        <div class="row up1"></div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 up1 form-label"><strong>Jenis Kelamin <span class="symbol-required">*</span></strong> :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <label class="radio-inline">
                              <input <?=isChecked($datas->gender, "m");?> id="input-gender-1" type="radio" name="gender" value="m"> Laki-laki
                            </label>
                            <label class="radio-inline">
                              <input <?=isChecked($datas->gender, "f");?> id="input-gender-2" type="radio" name="gender" value="f"> Perempuan
                            </label>
                            <div id="error-gender" class="is-error"></div>
                          </div>
                        </div>
                        <div class="row up1"></div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 up1 form-label">Tanggal Lahir :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <div class="input-group">
                              <input id="input-birthday" name="birthday" type="text" class="form-control input-style" data-plugin="datetimepicker" data-options="{format: 'DD-MMM-YYYY'}" placeholder="Tanggal Lahir" value="<?=($datas->birthday != "0000-00-00" ? date("d-M-Y", strtotime($datas->birthday)) : "");?>">
                              <span class="input-group-addon"> <i class="fa fa-calendar"></i> </span>
                            </div>
                            <div id="error-birthday" class="is-error"></div>
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
                          <div class="col-sm-4 col-xs-12 up1 form-label">No. HP 1 :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <input id="input-phone1" name="phone1" type="text" class="form-control input-style" placeholder="No. HP 1" value="<?=$datas->phone1;?>">
                            <div id="error-phone1" class="is-error"></div>
                          </div>
                        </div>
                        <div class="row up1"></div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 up1 form-label">No. HP 2 :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <input id="input-phone2" name="phone2" type="text" class="form-control input-style" placeholder="No. HP 2" value="<?=$datas->phone2;?>">
                            <div id="error-phone2" class="is-error"></div>
                          </div>
                        </div>
                        <div class="row up1"></div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 up1 form-label">No. HP 3 :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <input id="input-phone3" name="phone3" type="text" class="form-control input-style" placeholder="No. HP 3" value="<?=$datas->phone3;?>">
                            <div id="error-phone3" class="is-error"></div>
                          </div>
                        </div>
                        <div class="row up1"></div>
                        <div class="row">
                          <div class="col-sm-4 col-xs-12 up1 form-label">Catatan :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <textarea id="input-notes" name="notes" class="form-control" rows="3" placeholder="Catatan" maxlength="255"><?=str_replace("<br>", "", correctDisplay($datas->notes));?></textarea>
                            <div id="error-notes" class="is-error"></div>
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
                          <div class="col-sm-4 col-xs-12 up1 form-label">Status Menikah :</div>
                          <div class="col-sm-5 col-xs-12 up1">
                            <div class="checkbox checkbox-primary">
                              <input <?=isChecked($datas->married, 1);?> id="input-married" name="married" type="checkbox" value="1">
                              <label for="input-married">
                                <span class="note-input">Checked if status married</span>
                              </label>
                            </div>
                          </div>
                        </div>
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
                            <input name="old_name" type="hidden" value="<?=inputDisplay($datas->full_name);?>">
                            <input name="url" type="hidden" value="<?=$path['jemaat'].linkToIndex($_id, $_SERVER['QUERY_STRING']);?>">
                            <a href="<?=$path['jemaat'].linkToIndex($_id, $_SERVER['QUERY_STRING']);?>" class="btn btn-default"><i class='fa fa-times'></i> Cancel</a>
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
      $(document).ready(function(){
        $("#input-keluarga").select2();
      });
      
      function validateForm(){
        var first_name = $("#input-first-name").val();
        var last_name = $("#input-last-name").val();
        var keluarga = $("#input-keluarga").val();
        var gender = document.getElementsByName('gender');
        var birthday = $("#input-birthday").val();
        var phone1 = $("#input-phone1").val();
        var phone2 = $("#input-phone2").val();
        var phone3 = $("#input-phone3").val();        
        var phoneformat = /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g;
        var is_gender = false;

        for(var i=0; i < gender.length; i++){
            if(gender[i].checked == true){
                is_gender = true;    
            }
        }
        if(first_name != ""){
          $("#error-first-name").html("");
          $("#error-first-name").hide();
          $("#input-first-name").removeClass("input-error");
        } else {
          $("#error-first-name").show();
          $("#error-first-name").html("<i class='fa fa-warning'></i> This field is required.");
          $("#input-first-name").addClass("input-error");
          $("#input-first-name").focus();
          return false;
        }
        if(last_name != ""){
          $("#error-last-name").html("");
          $("#error-last-name").hide();
          $("#input-last-name").removeClass("input-error");
        } else {
          $("#error-last-name").show();
          $("#error-last-name").html("<i class='fa fa-warning'></i> This field is required.");
          $("#input-last-name").addClass("input-error");
          $("#input-last-name").focus();
          return false;
        }
        if(keluarga != ""){
          $("#error-keluarga").html("");
          $("#error-keluarga").hide();
          $("#input-keluarga").removeClass("input-error");
        } else {
          $("#error-keluarga").show();
          $("#error-keluarga").html("<i class='fa fa-warning'></i> This field is required.");
          $("#input-keluarga").addClass("input-error");
          $("#input-keluarga").focus();
          return false;
        }
        if(is_gender){
          $("#error-gender").html("");
          $("#error-gender").hide();
          $("#input-gender").removeClass("input-error");
        } else {
          $("#error-gender").show();
          $("#error-gender").html("<i class='fa fa-warning'></i> This field is required.");
          $("#input-gender").addClass("input-error");
          $("#input-gender").focus();
          return false;
        }
        if(birthday != ""){
          if(moment(birthday, "DD-MMM-YYYY", true).isValid()){
            $("#error-birthday").html("");
            $("#error-birthday").hide();
            $("#input-birthday").removeClass("input-error");
          } else {
            $("#error-birthday").show();
            $("#error-birthday").html("<i class='fa fa-warning'></i> Invalid date format.");
            $("#input-birthday").addClass("input-error");
            $("#input-birthday").focus();
            return false;
          }
        }
        if(phone1 != ""){
          if(phone1.match(phoneformat)){
            $("#error-phone1").html("");
            $("#error-phone1").hide();
            $("#input-phone1").removeClass("input-error");
          } else {
            $("#error-phone1").show();
            $("#error-phone1").html("<i class='fa fa-warning'></i> Invalid phone number format.");
            $("#input-phone1").addClass("input-error");
            $("#input-phone1").focus();
            return false;
          }
        }
        if(phone2 != ""){
          if(phone2.match(phoneformat)){
            $("#error-phone2").html("");
            $("#error-phone2").hide();
            $("#input-phone2").removeClass("input-error");
          } else {
            $("#error-phone2").show();
            $("#error-phone2").html("<i class='fa fa-warning'></i> Invalid phone number format.");
            $("#input-phone2").addClass("input-error");
            $("#input-phone2").focus();
            return false;
          }
        }
        if(phone3 != ""){
          if(phone3.match(phoneformat)){
            $("#error-phone3").html("");
            $("#error-phone3").hide();
            $("#input-phone3").removeClass("input-error");
          } else {
            $("#error-phone3").show();
            $("#error-phone3").html("<i class='fa fa-warning'></i> Invalid phone number format.");
            $("#input-phone3").addClass("input-error");
            $("#input-phone3").focus();
            return false;
          }
        }
        return true;
      }
      
      function confirmSubmit(){
        if(validateForm()){
          var first_name = document.getElementById("input-first-name");
          var middle_name = document.getElementById("input-middle-name");
          var last_name = document.getElementById("input-last-name");
          var keluarga = document.getElementById("input-keluarga");
          var gender = document.getElementsByName("gender");
          var birthday = document.getElementById("input-birthday");
          var phone1 = document.getElementById("input-phone1");
          var phone2 = document.getElementById("input-phone2");
          var phone3 = document.getElementById("input-phone3");
          var notes = document.getElementById("input-notes");
          var married = document.getElementById("input-married");
          var status = document.getElementById("input-status");
          var default_keluarga = "<?=$datas->keluarga_id;?>";
          var array = [
            [first_name.defaultValue, first_name.value],
            [middle_name.defaultValue, middle_name.value],
            [last_name.defaultValue, last_name.value],
            [default_keluarga, keluarga.value],
            [gender[0].defaultChecked, gender[0].checked],
            [gender[1].defaultChecked, gender[1].checked],
            [birthday.defaultValue, birthday.value],
            [phone1.defaultValue, phone1.value],
            [phone2.defaultValue, phone2.value],
            [phone3.defaultValue, phone3.value],
            [notes.defaultValue, notes.value],
            [married.defaultChecked, married.checked],
            [status.defaultChecked, status.checked]
          ];
          if(isDataChanges(array)){
            var result = confirm("Are you sure want to edit ?");
            if(result){
              $("#btn-submit").attr('disabled', 'disabled');
              $("#btn-submit").html("<i class='fa fa-spinner fa-spin'></i> Loading");
              document.getElementById("form-jemaat").submit();
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