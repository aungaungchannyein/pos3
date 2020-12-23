 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Client Managment
      </h1>

      <ol class="breadcrumb">

        <li>
          <a href="#"><i class="fa fa-dashboard"></i>Home</a>
        </li>

        
        <li class="active">Client Management</li>
      </ol>

    </section>

    
    <section class="content">

      
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddClient">
            Add Client
          </button>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tables">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Document ID</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>BirthDate</th>
                <th>Total Purchase</th>
                <th>Last Purchase</th>
                <th>Register Date</th>
                <th>Button</th>

              </tr>
            </thead>
            <tbody>
            	<?php

            	$item=null;
            	$value=null;
            	$client=ClientController::ctrShowClient($item,$value);
            

            	foreach ($client as $key=>$value){
            		echo'<tr>
                <td>'.($key+1).'</td>
                <td>'.$value["name"].'</td>
                <td>'.$value["document_id"].'</td>
                <td>'.$value["email"].'</td>
                <td>'.$value["phone"].'</td>
                <td>'.$value["address"].'</td>
                <td>'.$value["birth_date"].'</td>
                <td>'.$value["total_purchase"].'</td>
                <td>Last Purchase</td>
                <td>'.$value["register_date"].'</td>
                <td>
                <div class="btn-group">
                  <button class="btn btn-warning btnEditClient" idClient="'.$value["id"].'" data-toggle="modal" data-target="#modalEditClient"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger btnDeleteClient" ClientId="'.$value["id"].'"  ><i class="fa fa-times"></i></button>
                </div>
              </td></tr>';


            	}

            	?>

             
                
                
                
                
                
                
                
                
              


             


         <!--      <?php

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


              ?> -->
            
            </tbody>
            
          </table>
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
        $createCategory=new ClientController();
        $createCategory-> ctrCreateClient();
      ?>


      </div>

    </div>
  </div>

 
  <div id="modalEditClient" class="modal fade" role="dialog">
    <div class="modal-dialog">

  
      <div class="modal-content">
        <form role="form" method="post" enctype="multipart/form-data">
      
      
      <div class="modal-header" style="background-color: #3c8dbc; color: white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Client</h4>
      </div>

      <div class="modal-body">
        <div class="box-body">


          <!-- Entry for name -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control input-group-lg" name="editName" id="editName" placeholder="enter Client" required >
            </div>
          </div>

            <!-- Entry for ID Document -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="text" min="0" class="form-control input-group-lg" name="editDocumentId" id="editDocumentId" placeholder="enter DocumentID" >
            </div>
          </div>

           <!-- Entry for ID Document -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
              <input type="email" min="0" class="form-control input-group-lg" name="editEmail" id="editEmail" placeholder="enter Email">
            </div>
          </div>

           <!-- Entry for ID Document -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="text" min="0" class="form-control input-group-lg" name="editPhone" id="editPhone" placeholder="enter Phone Number" data-inputmask="'mask':'(09) 999-999-999'" data-mask >
            </div>
          </div>

           <!-- Entry for ID Document -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <input type="text" min="0" class="form-control input-group-lg" name="editAddress" id="editAddress" placeholder="enter Address" required >
            </div>
          </div>

            <!-- Entry for ID Document -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input type="text" min="0" class="form-control input-group-lg" name="editBirthDate" id="editBirthDate" placeholder="EnterBirthDate" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
            </div>
          </div>
        
         
         
        </div>
      </div>
   
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Client </button>
      </div>


       </form>
     


      </div>

    </div>
  </div>



 