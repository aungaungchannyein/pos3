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
              <select class="form-control input-group-lg newCategory" id="newCategory" name="newCategory" required>
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
              <input type="text" class="form-control input-group-lg" name="newDescription" id="newDescription" placeholder="enter Description " required >
            </div>
          </div>
       
         

           <!-- Entry for user  -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-check"></i></span>
              <input type="number" class="form-control input-group-lg" name="newStock" id="newStock" min="0" placeholder="Stock " required >
            </div>
          </div>

          <div class="form-group row">
            <div class="col-xs-12 col-sm-6">
                 <div class="form-group">
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                    <input type="number" class="form-control input-group-lg" name="newBuyprice" id="newBuyprice" min="0" step="any" placeholder="Buying price('ဝယ် ဈေး')" required >
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                  <input type="number" class="form-control input-group-lg" name="newSaleprice" id="newSaleprice" min="0" step="any" placeholder="Selling price('ရောင်း ဈေး')" required >
               </div>
            </div>
            <br>
            <div class="col-xs-6">
              <div class="form-group">
                <label>
                  <input type="checkbox" class=" percent" checked>
                  use percentage
                </label>  
              </div>
            </div>
            <div class="col-xs-6">
              <div class="input-group">
                <input type="number" class="form-control input-group-lg newPercentage" min="0" value="40" required>
                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
              </div>
            </div>

            </div>
            

          </div>





        

        

          <div class="form-group">
            <div class="panel">Add Photo</div>
            <input type="file" class="newPhoto" id="newPhoto" name="newPhoto">
            <p class="help-block">maximum of 2MB</p>
            <img src="view/img/products/default/anonymous.png" class="img-thumbnail preview" width="100px">
          </div>
        </div>
      </div>
   
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Change </button>
      </div>
       
        </form>

        <?php
        $createProduct=new ProductController();
        $createProduct->ctrCreateProduct();
          ?>

      </div>

    </div>
  </div>

  <div id="modalEditProduct" class="modal fade" role="dialog">
    <div class="modal-dialog">

  
      <div class="modal-content">
        <form role="form" method="post" enctype="multipart/form-data">
      
      
      <div class="modal-header" style="background-color: #3c8dbc; color: white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Product</h4>
      </div>

      <div class="modal-body">
        <div class="box-body">

           <!-- Entry for Category -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-th"></i></span>
              <select class="form-control input-group-lg" name="editCategory" readonly required>
                <option id="editCategory">Select Category</option>

                
              </select>
            </div>
          </div>
<!-- 
          Entry for name -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-code"></i></span>
              <input type="text" class="form-control input-group-lg" name="editCode" id="editCode" placeholder="enter code" required readonly >
            </div>
          </div>
        <!-- Entry for user  -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
              <input type="text" class="form-control input-group-lg" name="editDescription" id="editDescription" placeholder="enter Description " required >
            </div>
          </div>
       
         

           <!-- Entry for user  -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-check"></i></span>
              <input type="number" class="form-control input-group-lg" name="editStock" id="editStock" min="0" required >
            </div>
          </div>

          <div class="form-group row">
            <div class="col-xs-12 col-sm-6">
                 <div class="form-group">
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                    <input type="number" class="form-control input-group-lg" name="editBuyprice" id="editBuyprice" min="0" step="any" required >
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                  <input type="number" class="form-control input-group-lg" name="editSaleprice" id="editSaleprice" min="0" step="any"  required >
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
                <input type="number" class="form-control input-group-lg newPercentage" min="0" value="40" required>
                <span class="input-group-addon"><i class="fa fa-percent"></i></span>
              </div>
            </div>

            </div>
          </div>
          <div class="form-group">
            <div class="panel">Add Photo</div>
            <input type="file" class="newPhoto" id="editPhoto" name="editPhoto">
            <p class="help-block">maximum of 2MB</p>
            <img src="view/img/products/default/anonymous.png" class="img-thumbnail preview" width="100px">
            <input type="hidden" name="currentPhoto" id="currentPhoto" value="">
          </div>
        </div>
      </div>
   
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Change </button>
      </div>
   
       
        </form>


        <?php
        $editProduct=new ProductController();
        $editProduct->ctrEditProduct();
          ?>

      </div>

    </div>
  </div>
 <?php

  $deleteProduct=new ProductController();
  $deleteProduct-> ctrDeleteProduct();

  ?> 
 