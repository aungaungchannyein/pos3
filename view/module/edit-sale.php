<?php

if($_SESSION["profile"] == "seller" || $_SESSION["profile"] == "special"){

  echo '<script>

    window.location = "home";

  </script>';

  return;

}

?>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Sale Managment
      </h1>

      <ol class="breadcrumb">

        <li>
          <a href="#"><i class="fa fa-dashboard"></i>Home</a>
        </li>

        
        <li class="active">Sale Management</li>
      </ol>

    </section>

    
    <section class="content">
      <div class="row">
        <div class="col-lg-5 col-xs-12">
           <div class="box box-success">
             <div class="box-header with-border"></div>
<form role="form" method="post" class="formSale">
              <div class=box-body>
               
                 <div class="box">
                  <?php
                        $item="id";
                        $value=$_GET["idSale"];
                         $sale=SaleController::ctrShowSale($item,$value);
                         //var_dump($sale);

                         $itemSeller="id";
                          $valueSeller=$sale["id_seller"];
                          $requestSeller=UserController::ctrShowUser($itemSeller,$valueSeller);

                          $itemClient="id";
                          $valueClient=$sale["id_client"];
                          $requestClient=ClientController::ctrShowClient($itemClient,$valueClient);

                          $taxpercentage=$sale["tax"] * 100 / $sale["net_price"]



                      ?>
                  <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="newSeller" id="newSeller" value="<?php echo $requestSeller["name"];?>" readonly>
                        <input type="hidden" name="idSeller" id="idSeller" value="<?php echo $requestSeller["id"];?>">
                    </div>
                    </div>

                   <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="text" class="form-control" name="editSale" id="editSale" value="<?php echo $sale["code"]; ?>" readonly>
                         
                       
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <select class="form-control" name="selectCustomer" id="selectCustomer" required>
                        <option value="<?php echo $requestClient["id"];?>"><?php echo $requestClient["name"];?></option>
                        <?php
                          $item=null;
                          $value=null;
                          $client=ClientController::ctrShowClient($item,$value);
                          foreach($client as $key =>$value){
                            echo' <option value="'.$value["id"].'">'.$value["name"].'</option>';
                          }


                         ?>
                        </select>
                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAddClient" data-dismiss="modal">Add Client</button></span>
                    </div>
                  </div>

                  <div class="form-group row newProduct"> 

                    <?php

                    $productList=json_decode($sale["product"],true);
                    //var_dump($productList);

                    foreach($productList as $key =>$value){
                      $itemproduct="id";
                      $valueproduct=$value["id"];
                      $order="id";
                      $requestProduct=ProductController::ctrShowProduct($itemproduct,$valueproduct,$order);
                      $stock=$requestProduct["stock"]+$value["quantity"];

                       echo'<div class="row" style="padding:5px 15px">
                <div class="col-xs-6" style="padding-right:0px">
                      <div class="input-group">
                        <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct="'.$value["id"].'"><i class="fa fa-times"></i></button></span>
                        <input type="text" class="form-control newDescriptionProduct" idProduct="'.$value["id"].'" name="newDescriptionProduct" value="'.$value["description"].'" required>
                      </div>
                    </div>
                    <div class="col-xs-3">
                        <input type="number" class="form-control Productqty" name="Productqty" min="1" value="'.$value["quantity"].'" stock="'.$stock.'" newStock="'.$value["stock"].'" required>
                    </div>
                      <div class="col-xs-3 enterPrice" style="padding-left:0px">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                        <input type="text" class="form-control newProductPrice" realPrice="'.$requestProduct["selling_price"].'" name="newProductPrice"  value="'.$value["totalPrice"].'" readonly required>
                        <input type="hidden" class="form-control newWholeProductPrice" realWholePrice="'.$requestProduct["whole_selling_price"].'" name="newWholeProductPrice"  value="'.$value["totalPrice"].'" readonly required>
                        
                      </div>
                    </div>
                    </div>';
                    }

                     ?>
                    
                  </div>
                   <input type="hidden" name="productsList" id="productsList">

                  <button type="button" class="btn btn-default hidden-lg btnAddProduct">Add product</button>
                  <hr>
                  <div class="row">
                    <div class="col-xs-8 pull-right">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Tax</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="width:50%">
                              <div class="input-group">
                                <input type="number" class="form-control input-lg" name="newTaxSale" id="newTaxSale"  value="<?php echo $taxpercentage;?>"  required>
                                <input type="hidden" name="newTaxPrice" id="newTaxPrice" value="<?php echo $sale["tax"];?>">
                                <input type="hidden" name="newNetPrice" id="newNetPrice" value="<?php echo $sale["net_price"];?>">
                                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                              </div>
                            </td>
                              <td style="width:50%">
                              <div class="input-group">
                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                <input type="text" class="form-control input-lg newSaleTotal" name="newSaleTotal" id="newSaleTotal" totalSale="<?php echo $sale["net_price"];?>" value="<?php echo $sale["total"];?>" readonly required>
                                <input type="hidden" name="saleTotal" id="saleTotal" value="<?php echo $sale["total"];?>">
                                
                              </div>
                            </td>
                          </tr>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <hr>
                  <div class="form-group row">
                    <div class="col-xs-6" style="padding-right: 0px">
                       <div class="input-group">
                          <select class="form-control" name="newPaymentMethod" id="newPaymentMethod" required>
                            
                              <option value="">Select payment method</option>
                              <option value="cash">Cash</option>
                              <option value="CC">Credit Card</option>
                              <option value="DC">Debit Card</option>
                              <option value="notPaid">Not Paid</option>

                          </select>
                        </div>
                    </div>

                    <div class="paymentMethodBoxes"></div>
                    <input type="hidden" name="listPaymentMethod" id="listPaymentMethod">

                    <!-- <div class="col-xs-6" style="padding-left: 0px">
                       <div class="input-group">
                         <input type="number" class="form-control" name="newCodeTransition" id="newCodeTransition" placeholder="0" readonly required>
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                    </div> -->
                    <br>
                  </div>
                 
              </div>
              
             </div>
             <div class="box-footer">
               <button type="submit" class="btn btn-primary pull-right">Save changes</button>
             </div>
</form>

           <?php

            $editSale = new SaleController();
            $editSale -> ctrEditSale();
            
          ?>



           
           </div>
        </div>

        <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
          <div class="box box-warning">
            <div class="box-header with-border"></div>
            <div class="box-body">
               <table class="table table-bordered table-striped dt-responsive saleTable">
                  
                <thead>

                   <tr>
                     
                     <th style="width:10px">#</th>
                     <th>Image</th>
                     <th style="width:30px">Code</th>
                     <th>Description</th>
                     <th>Stock</th>
                     <th>Actions</th>

                   </tr> 

                </thead>

              </table>
            </div>
          </div>
          
        </div>

      </div>
 

    </section>
    
  </div>

  <div id="modalAddClient" class="modal fade" role="dialog">
    <div class="modal-dialog">

  
      <div class="modal-content">
        <form role="form" method="post" enctype="multipart/form-data">
      
      
      <div class="modal-header" style="background-color: #3c8dbc; color: white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Client</h4>
      </div>

      <div class="modal-body">
        <div class="box-body">


          <!-- Entry for name -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control input-group-lg" name="newName" id="newName" placeholder="enter Client" required >
            </div>
          </div>

            <!-- Entry for ID Document -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="text" min="0" class="form-control input-group-lg" name="newDocumentId" id="newDocumentId" placeholder="enter DocumentID" >
            </div>
          </div>

           <!-- Entry for ID Document -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
              <input type="email" min="0" class="form-control input-group-lg" name="newEmail" id="newEmail" placeholder="enter Email">
            </div>
          </div>

           <!-- Entry for ID Document -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="text" min="0" class="form-control input-group-lg" name="newPhone" id="newPhone" placeholder="enter Phone Number" data-inputmask="'mask':'(09) 999-999-999'" data-mask >
            </div>
          </div>

           <!-- Entry for ID Document -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <input type="text" min="0" class="form-control input-group-lg" name="newAddress" id="newAddress" placeholder="enter Address" required >
            </div>
          </div>

            <!-- Entry for ID Document -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input type="text" min="0" class="form-control input-group-lg" name="newBirthDate" id="newBirthDate" placeholder="EnterBirthDate" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
            </div>
          </div>
        
         
         
        </div>
      </div>
   
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Client </button>
      </div>


       </form>
              <?php
        $createClient=new ClientController();
        $createClient-> ctrCreateClient();
      ?>


      </div>

    </div>
  </div>
 
 
