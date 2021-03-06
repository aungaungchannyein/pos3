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
             <form role="form" method="post">
             <div class=box-body>
               
                 <div class="box">
                  <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="newSeller" id="newSeller" value="<?php echo $SESSION["name"];?>" readonly>
                    </div>
                  </div>

                   <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="text" class="form-control" name="newSale" id="newSale" value="10001" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <select class="form-control" name="selectCustomer" id="selectCustomer" required>
                        <option value="">SelectClient</option>
                        </select>
                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAddClient" data-dismiss="modal">Add Client</button></span>
                    </div>
                  </div>

                  <div class="form-group row newProduct">
                    <div class="col-xs-6" style="padding-right:0px">
                      <div class="input-group">
                        <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>
                        <input type="text" class="form-control" name="newProduct" id="newProduct" placeholder="Descripion of product" required>
                      </div>
                    </div>
                    <div class="col-xs-3">
                        <input type="number" class="form-control" name="Productqty" id="Productqty" min="1" placeholder="0" required>
                    </div>
                      <div class="col-xs-3" style="padding-left:0px">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                        <input type="number" class="form-control" name="newProductPrice" id="newProductPrice" placeholder="0000000" readonly required>
                        
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-default hidden-lg">Add product</button>
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
                                <input type="number" class="form-control" name="newTaxSale" id="newTaxSale" placeholder="0" readonly required>
                                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                              </div>
                            </td>
                              <td style="width:50%">
                              <div class="input-group">
                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                <input type="number" class="form-control" name="newSaleTotal" id="newSaleTotal" placeholder="0" readonly required>
                                
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

                          </select>
                        </div>
                    </div>

                    <div class="col-xs-6" style="padding-left: 0px">
                       <div class="input-group">
                         <input type="number" class="form-control" name="newCodeTransition" id="newCodeTransition" placeholder="0" readonly required>
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                    </div>
                    <br>
                  </div>
                 
                 </div>
              
             </div>
             <div class="box-footer">
               <button type="submit" class="btn btn-primary pull-right">Save sale</button>
             </div>
           </form>

           </div>
        </div>

        <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
          <div class="box box-warning">
            <div class="box-header with-border"></div>
            <div class="box-body">
               <table class="table table-bordered table-striped dt-responsive salesTable">
                  
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
 
 
  