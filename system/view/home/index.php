<?php
  include("../../helpers/require.php");
  include("../../helpers/auth.php");
  include("controller/controller_home.php");
  $curpage = "home";
  $navpage = "Home";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?=$title['home'];?></title>
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
            <!-- start: PAGE CONTENT -->
      			<div class="col-md-12">
      				<div class="widget p-lg">
      					<h1 class="m-b-lg">Hello, <?=$_SESSION['GpibKharis']['admin']['name'];?></h1>
      					<p class="m-b-lg docs" style="font-size: 17px;">
      						Welcome to administrator <?=$seo['company-name'];?>.
      					</p>
      				</div>
      			</div>
            <!-- end: PAGE CONTENT-->
      		</div><!-- .row -->

          <div class="row">
            <div class="col-md-3 col-sm-6">
              <div class="widget stats-widget">
                <div class="widget-body clearfix">
                  <div class="pull-left">
                    <h3 class="widget-title text-primary"><span class="counter" data-plugin="counterUp">66.136</span>k</h3>
                    <small class="text-color">Total Jemaat</small>
                  </div>
                  <span class="pull-right big-icon watermark"><i class="fa fa-file-text-o"></i></span>
                </div>
                <footer class="widget-footer bg-primary">
                  <small>Sektor 1</small>
                  <span class="small-chart pull-right" data-plugin="sparkline" data-options="[4,3,5,2,1], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                </footer>
              </div><!-- .widget -->
            </div>

            <div class="col-md-3 col-sm-6">
              <div class="widget stats-widget">
                <div class="widget-body clearfix">
                  <div class="pull-left">
                    <h3 class="widget-title text-danger"><span class="counter" data-plugin="counterUp">3.490</span>k</h3>
                    <small class="text-color">Total Jemaat</small>
                  </div>
                  <span class="pull-right big-icon watermark"><i class="fa fa-file-text-o"></i></span>
                </div>
                <footer class="widget-footer bg-danger">
                  <small>Sektor 2</small>
                  <span class="small-chart pull-right" data-plugin="sparkline" data-options="[1,2,3,5,4], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                </footer>
              </div><!-- .widget -->
            </div>

            <div class="col-md-3 col-sm-6">
              <div class="widget stats-widget">
                <div class="widget-body clearfix">
                  <div class="pull-left">
                    <h3 class="widget-title text-success"><span class="counter" data-plugin="counterUp">8.378</span>k</h3>
                    <small class="text-color">Total Jemaat</small>
                  </div>
                  <span class="pull-right big-icon watermark"><i class="fa fa-file-text-o"></i></span>
                </div>
                <footer class="widget-footer bg-success">
                  <small>Sektor 3</small>
                  <span class="small-chart pull-right" data-plugin="sparkline" data-options="[2,4,3,4,3], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                </footer>
              </div><!-- .widget -->
            </div>

            <div class="col-md-3 col-sm-6">
              <div class="widget stats-widget">
                <div class="widget-body clearfix">
                  <div class="pull-left">
                    <h3 class="widget-title text-warning"><span class="counter" data-plugin="counterUp">3.490</span>k</h3>
                    <small class="text-color">Total Jemaat</small>
                  </div>
                  <span class="pull-right big-icon watermark"><i class="fa fa-file-text-o"></i></span>
                </div>
                <footer class="widget-footer bg-warning">
                  <small>Sektor 4</small>
                  <span class="small-chart pull-right" data-plugin="sparkline" data-options="[5,4,3,5,2],{ type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
                </footer>
              </div><!-- .widget -->
            </div>
          </div><!-- .row -->

          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="widget">
                <header class="widget-header">
                  <h4 class="widget-title">Ulang Tahun Pernikahan dalam minggu yang berjalan</h4>
                </header>
                <hr class="widget-separator"/>
                <div class="widget-body">
                  <div class="media-group feeds-group">

                    <div class="media-group-item">
                      <div class="media">
                        <div class="media-left">
                          <div class="avatar avatar-sm avatar-circle">
                            <img src="<?=$global['absolute-url-admin'];?>assets/images/217.jpg" alt="">
                          </div>
                        </div>
                        <div class="media-body">
                          <h5><a href="javascript:void(0)" class="text-color">Some of the fantastic things people have had to say about Ooooh</a></h5>
                          <small class="text-muted">2 days ago</small>
                        </div>
                      </div>
                    </div><!-- .media-group-item -->

                    <div class="media-group-item">
                      <div class="media">
                        <div class="media-left">
                          <div class="avatar avatar-sm avatar-circle">
                            <img src="<?=$global['absolute-url-admin'];?>assets/images/218.jpg" alt="">
                          </div>
                        </div>
                        <div class="media-body">
                          <h5><a href="javascript:void(0)" class="text-color">Here are just some of the magazine reviews we have had</a></h5>
                          <small class="text-muted">1 day ago</small>
                        </div>
                      </div>
                    </div><!-- .media-group-item -->

                    <div class="media-group-item">
                      <div class="media">
                        <div class="media-left">
                          <div class="avatar avatar-sm avatar-circle">
                            <img src="<?=$global['absolute-url-admin'];?>assets/images/219.jpg" alt="">
                          </div>
                        </div>
                        <div class="media-body">
                          <h5><a href="javascript:void(0)" class="text-color">Lorem ipsum dolor amet, consectetur adipisicing elit.</a></h5>
                          <small class="text-muted">2 days ago</small>
                        </div>
                      </div>
                    </div><!-- .media-group-item -->

                    <div class="media-group-item">
                      <div class="media">
                        <div class="media-left">
                          <div class="avatar avatar-sm avatar-circle">
                            <img src="<?=$global['absolute-url-admin'];?>assets/images/215.jpg" alt="">
                          </div>
                        </div>
                        <div class="media-body">
                          <h5><a href="javascript:void(0)" class="text-color">“It’s just brilliant. I will recommend it to everyone!”</a></h5>
                          <small class="text-muted">2 mins ago</small>
                        </div>
                      </div>
                    </div><!-- .media-group-item -->

                    <div class="media-group-item">
                      <div class="media">
                        <div class="media-left">
                          <div class="avatar avatar-sm avatar-circle">
                            <img src="<?=$global['absolute-url-admin'];?>assets/images/221.jpg" alt="">
                          </div>
                        </div>
                        <div class="media-body">
                          <h5><a href="javascript:void(0)" class="text-color">John has just started working on the project</a></h5>
                          <small class="text-muted">right now</small>
                        </div>
                      </div>
                    </div><!-- .media-group-item -->
                  </div>
                </div>
              </div><!-- .widget -->
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="widget">
                <header class="widget-header">
                  <h4 class="widget-title">Ulang Tahun Kelahiran dalam minggu yang berjalan</h4>
                </header>
                <hr class="widget-separator"/>
                <div class="widget-body">
                  <div class="streamline m-l-lg">
                    <div class="sl-item p-b-md">
                      <div class="sl-avatar avatar avatar-sm avatar-circle">
                        <img class="img-responsive" src="<?=$global['absolute-url-admin'];?>assets/images/221.jpg" alt="avatar"/>
                      </div><!-- .avatar -->
                      <div class="sl-content m-l-xl">
                        <h5 class="m-t-0"><a href="javascript:void(0)" class="m-r-xs theme-color">John Doe</a><small class="text-muted fz-sm">last month</small></h5>
                        <p>John has just started working on the project</p>
                      </div>
                    </div><!-- .sl-item -->

                    <div class="sl-item p-b-md">
                      <div class="sl-avatar avatar avatar-sm avatar-circle">
                        <img class="img-responsive" src="<?=$global['absolute-url-admin'];?>assets/images/214.jpg" alt="avatar"/>
                      </div><!-- .avatar -->
                      <div class="sl-content m-l-xl">
                        <h5 class="m-t-0"><a href="javascript:void(0)" class="m-r-xs theme-color">Jane Doe</a><small class="text-muted fz-sm">last month</small></h5>
                        <p>Jane sent you invitation to attend the party</p>
                      </div>
                    </div><!-- .sl-item -->

                    <div class="sl-item p-b-md">
                      <div class="sl-avatar avatar avatar-sm avatar-circle">
                        <img class="img-responsive" src="<?=$global['absolute-url-admin'];?>assets/images/217.jpg" alt="avatar"/>
                      </div><!-- .avatar -->
                      <div class="sl-content m-l-xl">
                        <h5 class="m-t-0"><a href="javascript:void(0)" class="m-r-xs theme-color">Sally Mala</a><small class="text-muted fz-sm">last month</small></h5>
                        <p>Sally added you to her circles</p>
                      </div>
                    </div><!-- .sl-item -->

                    <div class="sl-item p-b-md">
                      <div class="sl-avatar avatar avatar-sm avatar-circle">
                        <img class="img-responsive" src="<?=$global['absolute-url-admin'];?>assets/images/211.jpg" alt="avatar"/>
                      </div><!-- .avatar -->
                      <div class="sl-content m-l-xl">
                        <h5 class="m-t-0"><a href="javascript:void(0)" class="m-r-xs theme-color">Sara Adams</a><small class="text-muted fz-sm">last month</small></h5>
                        <p>Sara has finished her task</p>
                      </div>
                    </div><!-- .sl-item -->
                    <div class="sl-item p-b-md">
                      <div class="sl-avatar avatar avatar-sm avatar-circle">
                        <img class="img-responsive" src="<?=$global['absolute-url-admin'];?>assets/images/214.jpg" alt="avatar"/>
                      </div><!-- .avatar -->
                      <div class="sl-content m-l-xl">
                        <h5 class="m-t-0"><a href="javascript:void(0)" class="m-r-xs theme-color">Sandy Doe</a><small class="text-muted fz-sm">last month</small></h5>
                        <p>Sara has finished her task</p>
                      </div>
                    </div><!-- .sl-item -->
                  </div><!-- .streamline -->
                </div>
              </div><!-- .widget -->
            </div>
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
    </script>
  </body>
</html>