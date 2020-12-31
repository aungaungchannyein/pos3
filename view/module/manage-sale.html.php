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
 
 
