<div id="back"></div>
<div class="login-box">
  <div class="login-logo">
     <img src="view/img/template/logo-blanco-bloque.png" class="img-responsive" style="padding: 30px 100px 0px 100px">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login to your system</p>

    <form  method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
       
        
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        
      </div>
      <br>

      <?php
          $login= new UserController();
          $login->ctrLogin();
        ?>
    </form>

    
   
  

  </div>
 
</div>

 