<?php
  include("../../helpers/require.php");
  include("../../helpers/auth.php");
  include("controller/controller_jemaat.php");
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
                <li class="active">Jemaat Management</li>
              </ol>
      			</div>

            <!-- start: PAGE CONTENT -->
            <div class="col-md-12">
              <div class="widget">
                <header class="widget-header">
                  <div class="row">
                    <div class="col-sm-6">
                      <h4 class="widget-title">Manage Jemaat</h4>
                    </div>
                    <div class="hidden-xs">
                      <div class="col-sm-6 text-right">
                        <a href="<?=$path['jemaat-add'];?>" class="btn btn-xs btn-outline btn-primary"><i class='fa fa-plus'></i> Create New Jemaat</a>
                      </div>
                    </div>
                    <div class="visible-xs">
                      <div class="col-sm-6 text-left up1">
                        <a href="<?=$path['jemaat-add'];?>" class="btn btn-xs btn-outline btn-primary"><i class='fa fa-plus'></i> Create New Jemaat</a>
                      </div>
                    </div>
                  </div>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                  <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                      <div class="form-group">
                        <div class="search-wrap">
                          <form action="" enctype="multipart/form-data" method="get">
                            <div class="search-group">
                              <div class="search-input">
                                <input name="page" type="hidden" value="1">
                                <input name="keyword" type="text" class="form-control input-style" placeholder="What are you looking for" autocomplete="off" value="<?=inputDisplay($_keyword);?>">
                              </div>
                              <span class="search-group-btn">
                                <button class="btn btn-default" type="submit"><i class='fa fa-search'></i> Search</button>
                              </span>
                            </div>
                            <div class="link-search">
                              <a href="javascript:void(0)" onclick="exportExcel('<?=$_keyword;?>', '<?=$_sector;?>', '<?=$_pelkat;?>', '<?=$_gender;?>', '<?=$_married;?>', '<?=$_status;?>')"><span id="loading-export" class="hide"><i class='fa fa-spinner fa-spin'></i></span> Export Excel</a> <span>&nbsp;|&nbsp;</span> <a href="javascript:void(0)" data-toggle="modal" data-target="#panel-advanced-search">Advanced Search</a> <?php if(!empty($searchs)){?> <span>&nbsp;|&nbsp;</span> <a href="<?=$path['jemaat'];?>">Clear Advanced Search</a> <?php }?>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-4"></div>
                  </div>
                  <?php if(!empty($searchs)){?>
                  <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                      <div class="form-group">
                        <div class="table-responsive">
                          <table class="table table-horizontal-scroll">
                            <tbody>
                              <?php if(is_array($filters)){ foreach($filters as $filter){ if($filter['value'] != ""){?>
                              <tr>
                                <td><a href="<?=$path['jemaat']."?".RemoveAdvancedSearch($_page, $filter['param'], $filter['value'], $_SERVER['QUERY_STRING']);?>"><i class="fa fa-remove" style="color:#444;"></i></a></td>
                                <td><?=TextAdvancedSearch($filter['param'], $filter['value']);?></td>
                              </tr>
                              <?php }}}?>
                            </tbody>
                          </table>
                        </div> 
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-4"></div>
                  </div>
                  <?php }?>
                  <div class="table-responsive">
                    <table class="table table-striped table-horizontal-scroll">
                      <tbody>
                        <tr>
                          <th class="text-left">#</th>
                          <th class="text-center">Action</th>
                          <th class="text-center">Status</th>
                          <th>Nama Jemaat</th>
                          <th>Nama Keluarga</th>
                          <th class="text-center">Sektor</th>
                          <th>Jenis Kelamin</th>
                          <th>No. HP</th>
                          <th>Tanggal Lahir</th>
                          <th class="text-center">Umur</th>
                          <th>Status Menikah</th>
                          <th>Create Date</th>
                          <th>Last Updated</th>
                        </tr>
                        <?php $num=1; if(hasProperty($datas, "data")){ foreach($datas->data as $data){?>
                        <tr>
                          <td class="text-left"><?=($_page-1)*20+$num;?>.</td>
                          <td class="text-center">
                            <a href="<?=$path['jemaat-edit']."?id=".$data->id.linkToEdit($_SERVER['QUERY_STRING']);?>" class="btn btn-xs btn-outline btn-success"><i class='fa fa-edit'></i> Edit</a>
                            <a href="javascript:void(0)" onclick="confirmDelete('<?=$data->id;?>', '<?=$data->full_name;?>');" class="btn btn-xs btn-outline btn-danger"><i class="fa fa-trash"></i> Delete</a>
                          </td>
                          <td class="text-center"><?=checkStatus($data->status);?></td>
                          <td><?=correctDisplay($data->full_name);?></td>
                          <td><?=correctDisplay($data->keluarga->name);?></td>
                          <td class="text-center"><?=$data->keluarga->sector;?></td>
                          <td><?=checkGender($data->gender);?></td>
                          <td><?=charLength(checkPhone(array($data->phone1, $data->phone2, $data->phone3)), 20);?></td>
                          <td><?=($data->birthday != "0000-00-00" ? date("d-M-Y", strtotime($data->birthday)) : "-");?></td>
                          <td class="text-center"><?=((string) $data->age != null ? $data->age : "-");?></td>
                          <td><?=checkMarried($data->married);?></td>
                          <td><?=date("d-M-Y, H:i:s", strtotime($data->datetime));?></td>
                          <td><?=($data->datetime != $data->timestamp ? time_ago($data->timestamp) : "-");?></td>
                        </tr>
                        <?php $num++;}}else{?>
                        <tr>
                          <td colspan="13">There is no data!</td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  </div>
                  <div id="default-datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap up2">
                    <div class="row">
                      <div class="col-sm-5">
                        <?php if(hasProperty($datas, "data")){?>
                        <div class="dataTables_info" id="default-datatable_info" role="status" aria-live="polite"><?="Showing ".(($_page-1)*20+1)." to ".($total_data+(($_page-1)*20))." of ".$total_data_all." entries";?></div>
                        <?php }?>
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

            <!-- start: PANEL SEARCH MODAL FORM -->
            <div class="modal fade" id="panel-advanced-search" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                      &times;
                    </button>
                    <h4 class="modal-title">Advanced Search</h4>
                  </div>
                  <form name="form-advanced-search" action="" enctype="multipart/form-data" method="get">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 form-label">Kata Kunci :</div>
                        <div class="col-sm-8 col-xs-12">
                          <input name="page" type="hidden" value="1">
                          <input id="input-keyword" name="keyword" type="text" class="form-control input-style" placeholder="Cari berdasarkan Nama, Keluarga, No. HP, atau Alamat" value="<?=inputDisplay($_keyword);?>">
                        </div>
                      </div>
                      <div class="row up1"></div>
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 form-label">Sektor :</div>
                        <div class="col-sm-8 col-xs-12">
                          <select id="input-sector" name="sector" class="form-control">
                            <option value="">Pilih Sektor</option>
                            <?php if(is_array($sectors)){ foreach($sectors as $sector){?>
                            <option <?=isSelected($_sector, $sector['value']);?> value="<?=$sector['value'];?>"><?=$sector['text'];?></option>
                            <?php }}?>
                          </select>
                        </div>
                      </div>
                      <div class="row up1"></div>
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 form-label">Pelkat :</div>
                        <div class="col-sm-8 col-xs-12">
                          <select id="input-pelkat" name="pelkat" class="form-control">
                            <option value="">Pilih Pelkat</option>
                            <?php if(is_array($pelkats)){ foreach($pelkats as $pelkat){?>
                            <option <?=isSelected($_pelkat, $pelkat['value']);?> value="<?=$pelkat['value'];?>"><?=$pelkat['text'];?></option>
                            <?php }}?>
                          </select>
                        </div>
                      </div>
                      <div class="row up1"></div>
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 form-label">Jenis Kelamin :</div>
                        <div class="col-sm-8 col-xs-12">
                          <select id="input-gender" name="gender" class="form-control">
                            <option value="">Pilih Jenis Kelamin</option>
                            <?php if(is_array($genders)){ foreach($genders as $gender){?>
                            <option <?=isSelected($_gender, $gender['value']);?> value="<?=$gender['value'];?>"><?=$gender['text'];?></option>
                            <?php }}?>
                          </select>
                        </div>
                      </div>
                      <div class="row up1"></div>
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 form-label">Status Menikah :</div>
                        <div class="col-sm-8 col-xs-12">
                          <select id="input-married" name="married" class="form-control">
                            <option value="">Pilih Status Menikah</option>
                            <?php if(is_array($marrieds)){ foreach($marrieds as $married){?>
                            <option <?=isSelected($_married, $married['value']);?> value="<?=$married['value'];?>"><?=$married['text'];?></option>
                            <?php }}?>
                          </select>
                        </div>
                      </div>
                      <div class="row up1"></div>
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 form-label">Status :</div>
                        <div class="col-sm-8 col-xs-12">
                          <select id="input-status" name="status" class="form-control">
                            <option value="">Pilih Status</option>
                            <?php if(is_array($statuss)){ foreach($statuss as $status){?>
                            <option <?=isSelected($_status, $status['value']);?> value="<?=$status['value'];?>"><?=$status['text'];?></option>
                            <?php }}?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer f5-bg">
                      <div class="btn-group">
                        <button type="reset" class="btn btn-default" data-dismiss="modal"><i class='fa fa-times'></i> Cancel</button>
                        <button type="submit" class="btn btn-primary btn-md"><i class="fa fa-check"></i> Submit</button>
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
    <!-- JS Kendo UI !-->
    <script src="<?=$global['absolute-url-admin'];?>libraries/kendo-ui/2017.3.1026/js/jszip.min.js"></script>
    <script src="<?=$global['absolute-url-admin'];?>libraries/cloudflare/cdnjs/ajax/libs/jszip/2.4.0/jszip.js"></script>
    <script src="<?=$global['absolute-url-admin'];?>libraries/kendo-ui/2017.3.1026/js/kendo.all.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        clear();
        change($("#input-pelkat").val());
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

      $("#input-pelkat").change(function(){
        clear();
        change(this.value);        
      });

      function clear(){
        $("#input-gender").val("");
        $("#input-married").val("");
        $("#input-gender").removeClass("disable-state");
        $("#input-married").removeClass("disable-state");
      }

      function change(pelkat){
        if(pelkat == "pa" || pelkat == "pt" || pelkat == "gp"){
          $("#input-married").val("0");
          $("#input-married").addClass("disable-state");
        }else if(pelkat == "pkp"){
          $("#input-gender").val("f");
          $("#input-married").val("1");
          $("#input-gender").addClass("disable-state");
          $("#input-married").addClass("disable-state");
        }else if(pelkat == "pkb"){
          $("#input-gender").val("m");
          $("#input-married").val("1");
          $("#input-gender").addClass("disable-state");
          $("#input-married").addClass("disable-state");
        }else if(pelkat == "pklu"){
          $("#input-married").val("1");
          $("#input-married").addClass("disable-state");
        }
      }

      function exportExcel(keyword, sector, pelkat, gender, married, status){
        $("#loading-export").removeClass("hide");
        var admin_id = "<?=$_SESSION['GpibKharis']['admin']['id'];?>";
        var auth_code = "<?=$_SESSION['GpibKharis']['admin']['auth_code'];?>";
        var url = "<?=$global['api'];?>jemaat/export/";

        //form data
        var data = new FormData();
        data.append('admin_id', admin_id);
        data.append('auth_code', auth_code);
        data.append('keyword', keyword);
        data.append('sector', sector);
        data.append('pelkat', pelkat);
        data.append('gender', gender);
        data.append('married', married);
        data.append('status', status);

        $.ajax({
          url: url, 
          data: data, 
          processData: false,
          contentType: false,
          type: 'POST', 
          success:function(result){
          var status = result.status;
          if(status != 400){
            if(result.data != null){
              $("#loading-export").addClass("hide");
              var rows = result.data;
              var workbook = new kendo.ooxml.Workbook({
              sheets: [
                {
                  columns: [ //column settings (width)
                    { width: 35 }, //no
                    { width: 100 }, //status
                    { width: 300 }, //full name
                    { width: 300 }, //family name
                    { width: 75 }, //sector
                    { width: 120 }, //gender
                    { width: 150 }, //phone
                    { width: 150 }, //birthday
                    { width: 75 }, //age
                    { width: 150 }, //married
                  ],
                  title: "Jemaat", //title of the sheet
                  rows: rows
                }
              ]});
              kendo.saveAs({
                  dataURI: workbook.toDataURL(),
                  fileName: "Jemaat-" + formatDatePicker(new Date()) + ".xlsx"
              });
            } else {
              $("#loading-export").addClass("hide");
              errorAlert("Something is wrong with your export data");
            }
          } else {
            $("#loading-export").addClass("hide");
            errorAlert("Something is wrong with your export data");
          }
        }});
      }

      function confirmDelete(id, name){
        var x = confirm("Are you sure want to delete \""+name+"\" ?");
        if(x == true){
          window.location.href = "index.php?action=delete&id="+id+"&name="+name;
        }else{
          //nothing
        }
      }
    </script>
  </body>
</html>