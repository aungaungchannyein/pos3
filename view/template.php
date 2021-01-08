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

   <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="view/plugins/iCheck/all.css">

   <!-- Daterange picker -->
  <link rel="stylesheet" href="view/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Morris chart -->
  <link rel="stylesheet" href="view/bower_components/morris.js/morris.css">

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

 

<!-- iCheck 1.0.1 -->
<script src="view/plugins/iCheck/icheck.min.js"></script>

<!-- InputMask -->
<script src="view/plugins/input-mask/jquery.inputmask.js"></script>
<script src="view/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="view/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="view/plugins/jqueryNumber/jqueryNumber.min.js"></script>

<!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="view/bower_components/moment/min/moment.min.js"></script>
  <script src="view/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>


   <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="view/bower_components/raphael/raphael.min.js"></script>
  <script src="view/bower_components/morris.js/morris.min.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <script src="view/bower_components/chart.js/Chart.js"></script>
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
           $_GET["root"] == "edit-sale" ||
           $_GET["root"] == "report" ||
           $_GET["root"] == "logout" ||
           $_GET["root"] == "sale"){
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
 <script src="view/js/category.js"></script>
 <script src="view/js/product.js"></script>
 <script src="view/js/client.js"></script>
 <script src="view/js/sale.js"></script>
 <script src="view/js/report.js"></script>
</body>
</html>
