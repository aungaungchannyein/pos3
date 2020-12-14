<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventory System</title>
  <link rel="icon" href="view/img/template/icono-negro.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="view/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="view/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="view/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="view/dist/css/AdminLTE.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="view/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="view/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="view/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="view/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="view/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="view/dist/js/demo.js"></script>
  <!-- DataTables -->
<script src="view/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="view/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="view/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="view/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>


<script src="view/plugins/sweetalert2/sweetalert2.all.js"></script>
  </head>
<body class="hold-transition skin-blue sider-collapse sidebar-mini login-page">
<!-- Site wrapper -->
 <?php
  if(isset($_SESSION["beginSession"]) && $_SESSION["beginSession"] =="ok"){
 
    echo'<div class="wrapper">';
      /*=============================================
      =            Header            =
      =============================================*/
      include "module/header.php";

      /*=============================================
      =            Menubar           =
      =============================================*/

      include "module/menu.php";

      /*=============================================
      =            Content        =
      =============================================*/
       if(isset($_GET["root"])){
        if($_GET["root"] == "home" ||
           $_GET["root"] == "user" ||
           $_GET["root"] == "category" ||
           $_GET["root"] == "product" ||
           $_GET["root"] == "client" ||
           $_GET["root"] == "manage-sale" ||
           $_GET["root"] == "create-sale" || 
           $_GET["root"] == "report" ||
           $_GET["root"] == "logout"){
          include "module/".$_GET["root"].".php";
        }
        else{
        include "module/404.php";
       }
       }else{
        include "module/home.php";
       }

      

       /*=============================================
      =            Footer        =
      =============================================*/
      
      include "module/footer.php";

      echo'</div>';
    }else{

      include "module/login.php";
    }
    
  ?>


 <!-- ./wrapper -->


 <script src="view/js/template.js"></script>
 <script src="view/js/user.js"></script>
</body>
</html>
