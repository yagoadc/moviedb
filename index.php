<?php  
  $day = new DateTime('NOW');
  $version = date('dm',$day->getTimestamp());
  // $version = 31072;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title>Actas</title>

    <!-- CORE CSS-->        
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/style.css?version=<?php echo $version; ?>" rel="stylesheet">

    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-3.3.1.slim.min.js"></script>

    <!-- angularjs js -->
    <script src="js/plugins/angular.js"></script>
    <script src="js/plugins/angular-ui-router.js"></script>

    <!-- bootstrap js -->
    <script src="js/plugins/popper.min.js"></script>
    <script src="js/plugins/bootstrap.min.js"></script>

    <!-- your app's js -->
    <script src="js/app.js?version=<?php echo $version; ?>"></script>
    <script src="js/controllers.js?version=<?php echo $version; ?>"></script>
    <script src="js/services.js?version=<?php echo $version; ?>"></script>

  </head>

  <body ng-app="starter">
  
    <div ui-view></div>

  <script type="text/javascript" src="js/plugins/sweetalert.min.js"></script> 
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script> 
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap4.min.js"></script> 
  </body>
</html>
