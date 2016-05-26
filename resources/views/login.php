
<!-- resources/views/index.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Puskom</title>
     <!-- <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css"> -->
     <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="node_modules/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="node_modules/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="node_modules/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="node_modules/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
    <link href="node_modules/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
   <!-- END GLOBAL MANDATORY STYLES -->
   <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="node_modules/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="node_modules/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="node_modules/global/css/login.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    
        
</head>
<body ng-app="authApp" class="login">
    
    <div class="container">
        <!-- BEGIN LOGO -->
        <div ui-view></div>

    </div>
</body>

<!-- Application Scripts -->


<!-- BEGIN CORE PLUGINS -->
<script src="node_modules/global/plugins/angularjs/angular.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
    <script src="node_modules/angular-ui-router/release/angular-ui-router.js"></script>
    <script src="node_modules/satellizer/satellizer.js"></script>

    <!-- Application Scripts -->
    <script src="script/route-login.js"></script>
    <script src="script/authController.js"></script>
    <script src="script/userController.js"></script>
</html>