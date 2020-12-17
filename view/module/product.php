 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Product Management
      </h1>

      <ol class="breadcrumb">

        <li>
          <a href="#"><i class="fa fa-dashboard"></i>Home</a>
        </li>

        
        <li class="active">Product Management</li>
      </ol>

    </section>

    
    <section class="content">

      
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modelAddProduct">
            Add Product
          </button>
        </div>


        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tableProduct">
            <thead>
              <tr>
                <th>#</th>
                <th>Image</th>
                <th>Code</th>
                <th>Description</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Sale price</th>
                <th>Buy price</th>
                <th>Date</th>
                <th>Action</th>


              </tr>
         
          </table>
        </div>
      
     
     
      </div>
 

    </section>
    
  </div>
 
  
  <div id="modelAddProduct" class="modal fade" role="dialog">
    <div class="modal-dialog">

  
      <div class="modal-content">
        <form role="form" method="post" enctype="multipart/form-data">
      
      
      <div class="modal-header" style="background-color: #3c8dbc; color: white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Product</h4>
      </div>

      <div class="modal-body">
        <div class="box-body">

           <!-- Entry for Category -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-th"></i></span>
              <select class="form-control input-group-lg" id="newCategory" name="newCategory" required>
                <option value="">Select Category</option>
                <?php
                  $item=null;
                  $value=null;
                  $category=CategoryController::ctrShowCategory($item,$value);

                  foreach ($category as $key => $value) {
                    # code...
                    echo'<option value="'.$value["id"].'">'.$value["category"].'</option>' ;
                  }
                ?>
              </select>
            </div>
          </div>
<!-- 
          Entry for name -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-code"></i></span>
              <input type="text" class="form-control input-group-lg" name="newCode" id="newCode" placeholder="enter code" required readonly >
            </div>
          </div>
        <!-- Entry for user  -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
              <input type="text" class="form-control input-group-lg" name="newDescription" placeholder="enter Description " required >
            </div>
          </div>
       
         

           <!-- Entry for user  -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-check"></i></span>
              <input type="number" class="form-control input-group-lg" name="newStock" min="0" placeholder="Stock " required >
            </div>
          </div>

          <div class="form-group row">
            <div class="col-xs-6">
                 <div class="form-group">
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                    <input type="number" class="form-control input-group-lg" name="newbuyprice" id="newbuyprice" min="0" placeholder="Buying price('ဝယ် ဈေး')" required >
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                  <input type="number" class="form-control input-group-lg" name="newsaleprice" id="newsaleprice" min="0" placeholder="Selling price('ရောင်း ဈေး')" required >
               </div>
            </div>
            <br>
            <div class="col-xs-6">
              <div class="form-group">
                <label>
                  <input type="checkbox" class="minimal percent" checked>
                  use percentage
                </label>  
              </div>
            </div>
            <div class="col-xs-6">
              <div class="input-group">
                <input type="number" class="form-control input-group-lg newpercentage" min="0" value="40" required>
                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
              </div>
            </div>

            </div>
            

          </div>





        

        

          <div class="form-group">
            <div class="panel">Add Photo</div>
            <input type="file" id="newPhoto" name="newPhoto">
            <p class="help-block">maximum of 2MB</p>
            <img src="view/img/users/default/anonymous.png" class="img-thumbnail" width="100px">
          </div>
        </div>
      </div>
   
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Change </button>
      </div>
        </form>

      </div>

    </div>
  </div>


  <div id="modalEditProduct" class="modal fade" role="dialog">
    <div class="modal-dialog">

  
      <div class="modal-content">
        <form role="form" method="post" enctype="multipart/form-data">
      
      
      <div class="modal-header" style="background-color: #3c8dbc; color: white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Product</h4>
      </div>

      <div class="modal-body">
        <div class="box-body">
<!-- 
          Entry for name -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-code"></i></span>
              <input type="text" class="form-control input-group-lg" name="newCode" placeholder="enter code" required >
            </div>
          </div>
        <!-- Entry for user  -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
              <input type="text" class="form-control input-group-lg" name="newDescription" placeholder="enter Description " required >
            </div>
          </div>
       
          <!-- Entry for Category -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-th"></i></span>
              <select class="form-control input-group-lg" name="newProfile">
                <option value="">Select Category</option>
                <option value="administrator">Administrator</option>
                <option value="special">Special</option>
                <option value="seller">Seller</option>
              </select>
            </div>
          </div>

           <!-- Entry for user  -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-check"></i></span>
              <input type="number" class="form-control input-group-lg" name="newStock" min="0" placeholder="Stock " required >
            </div>
          </div>

          <div class="form-group row">
            <div class="col-xs-6">
                 <div class="form-group">
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                    <input type="number" class="form-control input-group-lg" name="newbuyprice" min="0" placeholder="Buying price('ဝယ် ဈေး')" required >
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                  <input type="number" class="form-control input-group-lg" name="newsaleprice" min="0" placeholder="Selling price('ရောင်း ဈေး')" required >
               </div>
            </div>
            <br>
            <div class="col-xs-6">
              <div class="form-group">
                <label>
                  <input type="checkbox" class="minimal percent" checked>
                  use percentage
                </label>  
              </div>
            </div>
            <div class="col-xs-6">
              <div class="input-group">
                <input type="number" class="form-control input-group-lg newpercentage" min="0" value="40" required>
                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
              </div>
            </div>

            </div>
            

          </div>





        

        

          <div class="form-group">
            <div class="panel">Add Photo</div>
            <input type="file" id="newPhoto" name="newPhoto">
            <p class="help-block">maximum of 2MB</p>
            <img src="view/img/users/default/anonymous.png" class="img-thumbnail" width="100px">
          </div>
        </div>
      </div>
   
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Change </button>
      </div>
        </form>

      </div>

    </div>
  </div>