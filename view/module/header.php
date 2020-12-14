<header class="main-header">

	<a href="#" class="logo">
		<span class="logo-mini">
			<img src="view/img/template/icono-blanco.png" class="img-responsive"
			style="padding: 10px">
		</span>
      	<!-- logo for regular state and mobile devices -->
      	<span class="logo-lg">
      		<img src="view/img/template/logo-blanco-lineal.png" class="img-responsive"
			style="padding: 10px 0px">
      	</span>
    </a>

    
		<!-- navigationButton -->

	<nav class="navbar navbar-static-top" >
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>

		</a>

	<!-- 	UserProfile -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
            		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
            			<?php
            				if($_SESSION["photo"] != ""){
            					echo '<img src="'.$_SESSION["photo"].'" class="user-image">';
            				}else{
            					echo '<img src="view/img/users/default/anonymous.png" class="user-image">';

            				}

            					?>
              			
              			<span class="hidden-xs"><?php
              				echo $_SESSION["name"]
              			 ?></span>
            		</a>

            		<ul class="dropdown-menu">
						<li class="user-body">
                			<div class="pull-right">
                				<a href="logout" class="btn btn-default btn-flat ">Logout</a>
                			</div>                
              			</li>
			
					</ul>
		
            	</li>
				
			</ul>
			
		</div>

	

		
	</nav>
	
	

</header>