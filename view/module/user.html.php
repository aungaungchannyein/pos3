 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       User Management
      </h1>

      <ol class="breadcrumb">

        <li>
          <a href="#"><i class="fa fa-dashboard"></i>Home</a>
        </li>

        
        <li class="active">User Management</li>
      </ol>

    </section>

    
    <section class="content">

      
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modelAddUser">
            Add User
          </button>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped dt-responsive tables">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Username</th>
                <th>Picture</th>
                <th>Profile</th>
                <th>Status</th>
                <th>Last login</th>
                <th>Action</th>

              </tr>
            </thead>
            <tbody>
              <td>1</td>
              <td>User Administrator</td>
              <td>Admin</td>
              <td><img src="view/img/users/default/anonymous.png" class="img-thumbnail" width="40px"></td>
              <td>Administrator</td>
              <td><button class="btn btn-success btn-xs">Activated</button></td>
              <td>30asdk</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tbody>
            
          </table>
        </div>
      
     
     
      </div>
 

    </section>
    
  </div>
 
  
  <div id="modelAddUser" class="modal fade" role="dialog">
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
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" class="form-control input-group-lg" name="newName" placeholder="enter name" required >
            </div>
          </div>
        <!-- Entry for user  -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-key"></i></span>
              <input type="text" class="form-control input-group-lg" name="newUser" placeholder="enter user" required >
            </div>
          </div>
          <!-- Entry for password -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock"></i></span>
              <input type="text" class="form-control input-group-lg" name="newPassword" placeholder="enter password" required >
            </div>
          </div>
          <!-- Entry for profile -->
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-users"></i></span>
              <select class="form-control input-group-lg" name="newProfile">
                <option value="">Select Profile</option>
                <option value="administrator">Administrator</option>
                <option value="special">Special</option>
                <option value="seller">Seller</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="panel">Add Photo</div>
            <input type="file" id="newPicture" name="newPicture">
            <p class="help-block">maximum of 200MB</p>
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