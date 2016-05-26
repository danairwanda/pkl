<!DOCTYPE html>
<html lang="en" ng-app="MetronicApp">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="node_modules/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="node_modules/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="node_modules/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="node_modules/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="node_modules/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="node_modules/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="node_modules/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
        <link href="node_modules/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="node_modules/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="node_modules/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="node_modules/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="node_modules/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="node_modules/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="node_modules/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="node_modules/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="node_modules/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="node_modules/layouts/layout4/css/themes/light.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="node_modules/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
        <base href="/">
</head>
<body ng-controller="AppController">
  <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top"> 
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE ACTIONS -->

                <!-- END PAGE ACTIONS -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                          
                            <!-- BEGIN QUICK SIDEBAR DROPDOWN -->
                            <li class="dropdown dropdown-extended quick-sidebar-toggler">
                               <button class="btn btn-danger" ng-click="user.logout()">Logout</button>
                            </li>
                            <!-- END QUICK SIDEBAR DROPDOWN -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->

        </div>
        <!-- END HEADER -->
        <div class="clearfix"> </div>
        <div class="page-container">
           <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper"> 
                <div class="page-sidebar navbar-collapse collapse">
                    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" ng-class="{'page-sidebar-menu-closed': settings.layout.pageSidebarClosed}">
                      
                      <li class="heading">
                          <h3 class="uppercase">Features</h3>
                      </li>
                      <li class="nav-item  ">
                          <a href="admin#/agendaHarian" class="nav-link nav-toggle">
                              <i class="fa fa-modx"></i>
                              <span class="title">Agenda Harian</span>
                          </a>
                      </li>
                      <li class="start nav-item">
                          <a href="admin#/detailAgenda">
                              <i class="icon-home"></i>
                              <span class="title">Detail Agenda</span>
                          </a>
                      </li>
                      <li class="nav-item  ">
                          <a href="admin#/accessPoint" class="nav-link nav-toggle">
                              <i class="fa fa-envelope"></i>
                              <span class="title">Access Point</span>
                          </a>
                    </li>
                      <li class="nav-item  ">
                          <a href="admin#/barangInven" class="nav-link nav-toggle">
                              <i class="fa fa-commenting"></i>
                              <span class="title">Barang Inven</span>
                          </a>
                      </li>
                      <li class="nav-item  ">
                          <a href="admin#/invenMasuk" class="nav-link nav-toggle">
                              <i class="fa fa-phone"></i>
                              <span class="title">Inven Masuk</span>
                          </a>
                      </li>

                      <li class="nav-item  ">
                          <a href="admin#/invenStatus" class="nav-link nav-toggle">
                              <i class="fa fa-random"></i>
                              <span class="title">Inven Status</span>
                          </a>
                      </li>
                      <li class="nav-item  ">
                          <a href="admin#/firewall" class="nav-link nav-toggle">
                              <i class="fa fa-calendar"></i>
                              <span class="title">Firewall</span>
                          </a>
                      </li>
                      <li class="nav-item  ">
                          <a href="admin#/gangguan" class="nav-link nav-toggle">
                              <i class="fa fa-shopping-basket"></i>
                              <span class="title">Gangguan</span>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="admin#/hub" class="nav-link nav-toggle">
                              <i class="fa fa-user"></i>
                              <span class="title">Hub</span>
                          </a>
                      </li>
                      <li class="nav-item  ">
                          <a href="admin#/kondisiAlat" class="nav-link nav-toggle">
                              <i class="fa fa-file-text-o"></i>
                              <span class="title">Kondisi Alat</span>
                          </a>
                      </li>
                      <li class="nav-item  ">
                          <a href="admin#/merekAlat" class="nav-link nav-toggle">
                              <i class="fa fa-file-text-o"></i>
                              <span class="title">Merek Alat</span>
                          </a>
                      </li>

                      <li class="nav-item  ">
                          <a href="admin#/namaForm" class="nav-link nav-toggle">
                              <i class="fa fa-file-text-o"></i>
                              <span class="title">Nama Form</span>
                          </a>
                      </li>
                      <li class="nav-item  ">
                          <a href="admin#/penanganan" class="nav-link nav-toggle">
                              <i class="fa fa-file-text-o"></i>
                              <span class="title">penanganan</span>
                          </a>
                      </li>

                      <li class="nav-item  ">
                          <a href="admin#/provider" class="nav-link nav-toggle">
                              <i class="fa fa-file-text-o"></i>
                              <span class="title">Provider</span>
                          </a>
                      </li>
                      <li class="nav-item  ">
                          <a href="admin#/switchCore" class="nav-link nav-toggle">
                              <i class="fa fa-file-text-o"></i>
                              <span class="title">switch_core</span>
                          </a>
                      </li>
                      <li class="nav-item  ">
                          <a href="admin#/switchSub" class="nav-link nav-toggle">
                              <i class="fa fa-file-text-o"></i>
                              <span class="title">Switch Sub</span>
                          </a>
                      </li>

                      <li class="nav-item  ">
                          <a href="admin#/pddBuffer" class="nav-link nav-toggle">
                              <i class="fa fa-file-text-o"></i>
                              <span class="title">PDD Buffer</span>
                          </a>
                      </li>

                      <li class="nav-item  ">
                          <a href="admin#/pddError" class="nav-link nav-toggle">
                              <i class="fa fa-file-text-o"></i>
                              <span class="title">PDD Error</span>
                          </a>
                      </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>

            </div>
            <!-- END SIDEBAR -->
             <div class="page-content-wrapper">
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD -->
                    <!-- END PAGE HEAD -->
                    <!-- BEGIN ACTUAL CONTENT -->
                    <div ui-view class="fade-in-up"> 
    
                    </div>
                    <!-- END ACTUAL CONTENT -->
                </div>
            </div>
        </div>
      <div class="page-footer"> 
                    <div class="page-footer-inner"> 2014 &copy; Metronic by keenthemes. </div>
                    <div class="scroll-to-top">
                        <i class="icon-arrow-up"></i>
                    </div>
                </div>
<script src="node_modules/global/plugins/jquery.min.js" type="text/javascript"></script>  
<script src="node_modules/global/plugins/angularjs/angular.min.js" type="text/javascript"></script>
<script src="node_modules/global/plugins/angularjs/angular-sanitize.min.js" type="text/javascript"></script>
<script src="node_modules/global/plugins/angularjs/angular-touch.min.js" type="text/javascript"></script>
<script src="node_modules/global/plugins/angularjs/plugins/angular-ui-router.min.js" type="text/javascript"></script>
<script src="node_modules/global/plugins/angularjs/plugins/ocLazyLoad.min.js" type="text/javascript"></script>
<script src="node_modules/global/plugins/angularjs/plugins/ui-bootstrap-tpls.min.js" type="text/javascript"></script>
<!-- <script src="js/app.js" type="text/javascript"></script> -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="node_modules/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="node_modules/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="node_modules/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="node_modules/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="node_modules/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="node_modules/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script src="js/main.js" type="text/javascript"></script>
<!-- <script src="script/components-date-time-pickers.js" type="text/javascript"></script> -->
<!-- <script src="js/storeFactory.js" type="text/javascript"></script> -->
</body>
</html>