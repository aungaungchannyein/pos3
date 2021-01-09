 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard စာရင်း
        <small>Control Panel</small>
      </h1>

      <ol class="breadcrumb">

        <li>
          <a href="home"><i class="fa fa-dashboard"></i>Home</a>
        </li>

        
        <li class="active">Dashboard</li>
      </ol>

    </section>

   
    <section class="content">

      <div class="row">
        <?php
        include "home/top-boxes.php";
        ?>
      </div>

       <div class="row">


    <!--   <div class="col-lg-12">

      <?php

        //if($_SESSION["profile"] =="Administrator"){

          include "reports/sales-graph.php";

        //}

      ?>
      
      </div> -->

      <div class="col-lg-6">
        
        <?php

          if($_SESSION["profile"] =="Administrator"){

            include "reports/bestseller-products.php";

          }

        ?>

      </div>

       <div class="col-lg-6">
        
        <?php

          if($_SESSION["profile"] =="Administrator"){

            include "home/recent-products.php";

          }

        ?>

      </div>

      <div class="col-lg-12">
           
        <?php

        if($_SESSION["profile"] =="special" || $_SESSION["profile"] =="seller"){

           echo '<div class="box box-success">

           <div class="box-header">

           <h1>Welcome ' .$_SESSION["name"].'</h1>

           </div>

           </div>';

        }

        ?>

      </div> 

    </div>

      

    </section>
  
  </div>