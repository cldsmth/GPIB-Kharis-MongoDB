<!-- START APP ASIDE -->
<aside id="menubar" class="menubar light">
  <div class="app-user">
    <div class="media">
      <div class="media-left">
        <div class="avatar avatar-md avatar-circle">
          <a href="javascript:void(0)"><img class="img-responsive" src="<?=$path['decrypt-fie']."admin/thmb/".($_SESSION['GpibKharis']['admin']['img'] != "" ? $_SESSION['GpibKharis']['admin']['img'] : "null")."/";?>" alt="avatar"/></a>
        </div><!-- .avatar -->
      </div>
      <div class="media-body">
        <div class="foldable">
          <h5><a href="javascript:void(0)" class="username"><?=$_SESSION['GpibKharis']['admin']['name'];?></a></h5>
          <ul>
            <li class="dropdown">
              <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <small>Web Developer</small>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu animated flipInY">
                <li>
                  <a class="text-color" href="<?=$path['home'];?>">
                    <span class="m-r-xs"><i class="fa fa-home"></i></span>
                    <span>Home</span>
                  </a>
                </li>
                <li>
                  <a class="text-color" href="#">
                    <span class="m-r-xs"><i class="fa fa-user"></i></span>
                    <span>My Profile</span>
                  </a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <a class="text-color" href="<?=$path['logout'];?>">
                    <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                    <span>Sign Out</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- .media-body -->
    </div><!-- .media -->
  </div><!-- .app-user -->

  <div class="menubar-scroll">
    <div class="menubar-scroll-inner">
      <ul class="app-menu">
        <!-- Home !-->
        <li class="<?=($curpage == "home" ? "active" : "");?>">
          <a href="<?=$path['home'];?>">
            <i class="menu-icon fa fa-home"></i>
            <span class="menu-text">Home</span>
          </a>
        </li>

        <!-- Master !-->
        <li class="has-submenu <?=(in_array_any(array($curpage), array("keluarga", "jemaat")) ? "active open" : "");?>">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon fa fa-tasks"></i>
            <span class="menu-text">Master</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu" style="<?=(in_array_any(array($curpage), array("keluarga", "jemaat")) ? "display: block;" : "");?>">
            <!-- Module Kepala Keluarga !-->
            <li class="<?=($curpage == "keluarga" ? "active" : "");?>">
              <a href="<?=$path['keluarga'];?>">
                <span class="menu-text">Keluarga</span>
              </a>
            </li>

            <!-- Module Jemaat !-->
            <li class="<?=($curpage == "jemaat" ? "active" : "");?>">
              <a href="<?=$path['jemaat'];?>">
                <span class="menu-text">Jemaat</span>
              </a>
            </li>
          </ul>
        </li>

        <!-- Article !-->
        <li class="has-submenu <?=(in_array_any(array($curpage), array("article-category")) ? "active open" : "");?>">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon fa fa-newspaper-o"></i>
            <span class="menu-text">Article</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu" style="<?=(in_array_any(array($curpage), array("article-category")) ? "display: block;" : "");?>">
            <!-- Module Category !-->
            <li class="<?=($curpage == "article-category" ? "active" : "");?>">
              <a href="<?=$path['article-category'];?>">
                <span class="menu-text">Category</span>
              </a>
            </li>

            <!-- Module Article !-->
            <!--<li>
              <a href="#">
                <span class="menu-text">List</span>
              </a>
            </li>!-->
          </ul>
        </li>

        <!-- Event !-->
        <li class="has-submenu <?=(in_array_any(array($curpage), array("event-category")) ? "active open" : "");?>">
        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon fa fa-calendar"></i>
            <span class="menu-text">Event</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu" style="<?=(in_array_any(array($curpage), array("event-category")) ? "display: block;" : "");?>">
            <!-- Module Category !-->
            <li class="<?=($curpage == "event-category" ? "active" : "");?>">
              <a href="<?=$path['event-category'];?>">
                <span class="menu-text">Category</span>
              </a>
            </li>

            <!-- Module Event !-->
            <!--<li>
              <a href="#">
                <span class="menu-text">List</span>
              </a>
            </li>!-->
          </ul>
        </li>

        <?php /*
        <!-- Database Jemaat !-->
        <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon fa fa-database"></i>
            <span class="menu-text">Database Jemaat</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="#"><span class="menu-text">Seluruh Jemaat</span></a></li>
            <li class="has-submenu">
              <a href="javascript:void(0)" class="submenu-toggle">
                <span class="menu-text">Sektor</span>
                <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
              </a>
              <ul class="submenu">
                <li><a href="#"><span class="menu-text">Sektor 1</span></a></li>
                <li><a href="#"><span class="menu-text">Sektor 2</span></a></li>
                <li><a href="#"><span class="menu-text">Sektor 3</span></a></li>
                <li><a href="#"><span class="menu-text">Sektor 4</span></a></li>
              </ul>
            </li>
            <li class="has-submenu">
              <a href="javascript:void(0)" class="submenu-toggle">
                <span class="menu-text">Pelkat</span>
                <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
              </a>
              <ul class="submenu">
                <li><a href="#"><span class="menu-text">Pelkat PA</span></a></li>
                <li><a href="#"><span class="menu-text">Pelkat PT</span></a></li>
                <li><a href="#"><span class="menu-text">Pelkat GP</span></a></li>
                <li><a href="#"><span class="menu-text">Pelkat PKP</span></a></li>
                <li><a href="#"><span class="menu-text">Pelkat PKB</span></a></li>
                <li><a href="#"><span class="menu-text">Pelkat PKLU</span></a></li>
              </ul>
            </li>
            <li><a href="#"><span class="menu-text">Daftar Kehadiran</span></a></li>
          </ul>
        </li>

        <!-- Warta Jemaat !-->
        <li>
          <a href="#">
            <i class="menu-icon fa fa-file-pdf-o"></i>
            <span class="menu-text">Warta Jemaat</span>
          </a>
        </li>

        <!-- Tata Ibadah !-->
        <li>
          <a href="#">
            <i class="menu-icon fa fa-file-text-o"></i>
            <span class="menu-text">Tata Ibadah</span>
          </a>
        </li>
        */?>

        <!-- Setting !-->
        <li class="has-submenu <?=(in_array_any(array($curpage), array("import-jemaat")) ? "active open" : "");?>">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon fa fa-cogs"></i>
            <span class="menu-text">Setting</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu" style="<?=(in_array_any(array($curpage), array("import-jemaat")) ? "display: block;" : "");?>">
            <!-- Module Role Access !-->
            <!--<li>
              <a href="#">
                <span class="menu-text">Role Access</span>
              </a>
            </li>!-->

            <!-- Import !-->
            <li class="has-submenu <?=(in_array_any(array($curpage), array("import-jemaat")) ? "active open" : "");?>">
              <a href="javascript:void(0)" class="submenu-toggle">
                <span class="menu-text">Import</span>
                <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
              </a>
              <ul class="submenu" style="<?=(in_array_any(array($curpage), array("import-jemaat")) ? "display: block;" : "");?>">
                <!-- Module Import Jemaat !-->
                <li class="<?=($curpage == "import-jemaat" ? "active" : "");?>">
                  <a href="<?=$path['jemaat-import'];?>">
                    <span class="menu-text">Jemaat</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>

        <!-- Administrator !-->
        <li class="<?=($curpage == "admin" ? "active" : "");?>">
          <a href="<?=$path['admin'];?>">
            <i class="menu-icon fa fa-users"></i>
            <span class="menu-text">Administrator</span>
          </a>
        </li>

        <li class="menu-separator"><hr></li>
        
        <!-- Action !-->
        <li>
          <a href="<?=$path['logout'];?>">
            <i class="menu-icon fa fa-power-off"></i>
            <span class="menu-text">Sign Out</span>
          </a>
        </li>
      </ul><!-- .app-menu -->
    </div><!-- .menubar-scroll-inner -->
  </div><!-- .menubar-scroll -->
</aside>
<!-- END APP ASIDE -->