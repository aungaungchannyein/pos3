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
          <button class="btn btn-primary" data-toggle="modal" data-target="#modelAddCategory">
            Add Category
          </button>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tables">
            <thead>
              <tr>
                <th>#</th>
                <th>Category</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>
              <?php

              $item=null;
              $value=null;
              $category=CategoryController::ctrShowCategory($item,$value);
              

              foreach ($category as $key => $value) {
                
                echo' <tr> <td>'.($key+1).'</td>
              <td class="text-bold">'.$value["category"].'</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning btnEditCategory" idCategory="'.$value["id"].'" data-toggle="modal" data-target="#modalEditCategory"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger btnDeleteCategory" CategoryId="'.$value["id"].'"  ><i class="fa fa-times"></i></button>
                </div>
              </td></tr>';
              }


              ?>
            
            </tbody>
            
          </table>
        </div>
      
     
     
      </div>
 

    </section>
    
  </div>
 
 
  <div id="modelAddCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">

  
      <div class="modal-content">
        <form role="form" method="post" enctype="multipart/form-data">
      
      
      <div class="modal-header" style="background-color: #3c8dbc; color: white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add User</h4>
      </div>

      <div class="modal-body">
        <div class="box-body">
<!-- 
          Entry for name -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-th"></i></span>
              <input type="text" class="form-control input-group-lg" name="newCategory" id="newCategory" placeholder="enter Category" required >
            </div>
          </div>
        
         
         
        </div>
      </div>
   
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Category </button>
      </div>


      <?php
        $createCategory=new CategoryController();
        $createCategory-> ctrCreateCategory();
      ?>
        </form>

      </div>

    </div>
  </div>

  <div id="modalEditCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">

  
      <div class="modal-content">
        <form role="form" method="post" enctype="multipart/form-data">
      
      
      <div class="modal-header" style="background-color: #3c8dbc; color: white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit User</h4>
      </div>

      <div class="modal-body">
        <div class="box-body">
<!-- 
          Entry for name -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-th"></i></span>
              <input type="text" class="form-control input-group-lg" name="editCategory" id="editCategory" value="" required >
              <input type="hidden" name="idCategory" id="idCategory">
            </div>
          </div>
        
         
         
        </div>
      </div>
   
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Category </button>
      </div>


   <?php
        $editCategory=new CategoryController();
        $editCategory-> ctrEditCategory();
      ?>
        </form>

      </div>

    </div>
  </div>

  <?php

  $deleteCategory=new CategoryController();
  $deleteCategory-> ctrDeleteCategory();

  ?>