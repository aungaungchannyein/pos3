 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Category Managment
      </h1>

      <ol class="breadcrumb">

        <li>
          <a href="#"><i class="fa fa-dashboard"></i>Home</a>
        </li>

        
        <li class="active">Category Management</li>
      </ol>

    </section>

    
    <section class="content">

      
      <div class="box">
        <div class="box-header with-border">
          <a href="create-sale">
          <button class="btn btn-primary">
            Add Sale
          </button>
        </a>
        <button type="button" class="btn btn-default pull-right daterange-btn" id="daterange-btn">
          <span>
              <i class="fa fa-calendar"></i> Date Range
            </span>

            <i class="fa fa-caret-down"></i>

        </button>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tables">
            <thead>
              <tr>
               <th style="width:10px">#</th>
               <th>Bill code</th>
               <th>Customer</th>
               <th>Seller</th>
               <th>Payment method</th>
               <th>Net cost</th>
               <th>Total cost</th>
               <th>Date</th>
               <th>Actions</th>

              </tr>
            </thead>
            <tbody>
              

            
            <?php

          if(isset($_GET["initialDate"])){

            $initialDate = $_GET["initialDate"];
            $finalDate = $_GET["finalDate"];

          }else{

            $initialDate = null;
            $finalDate = null;

          }

          //var_dump($initialDate);

          $answer = SaleController::ctrSalesDatesRange($initialDate, $finalDate);

          //var_dump($answer);
              

    
          foreach ($answer as $key => $value) {
                
                echo' <tr> <td>'.($key+1).'</td>
              <td>'.$value["code"].'</td>';

              $itemClient="id";
              $valueClient=$value["id_client"];
              $requestClient=ClientController::ctrShowClient($itemClient,$valueClient);

              echo'<td>'.$requestClient["name"].'</td>';


              $itemSeller="id";
              $valueSeller=$value["id_seller"];
              $requestSeller=UserController::ctrShowUser($itemSeller,$valueSeller);


              echo'<td>'.$requestSeller["name"].'</td>
              <td>'.$value["payment_method"].'</td>
              <td>'.number_format($value["net_price"]).'</td>
              <td>'.number_format($value["total"]).'</td>
              <td>'.$value["saledate"].'</td>
              <td>
                <div class="btn-group">
                 <button class="btn btn-info btnPrintSales" saleCode="'.$value["code"].'"><i class="fa fa-print"></i></button>

                  <button class="btn btn-warning btnEditSale" id="btnEditSale" idSale="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                  <button class="btn btn-danger btnDeleteSales" idSale="'.$value["id"].'"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr>';
              }


              ?>
            
            </tbody>
            
          </table>
          <?php
          $deleteSale=new SaleController();
          $deleteSale->ctrDeleteSale();

          ?>

         

        </div>
      
     
     
      </div>
 

    </section>
    
  </div>

 
 
 
