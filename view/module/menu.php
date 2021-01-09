<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu">
			<?php
			if($_SESSION["profile"] =="Administrator"){

			echo'<li class="active">
				<a href="home">
					<i class="fa fa-home"></i>
					<span>Home</span>
				</a>
			</li>
			<li >
				<a href="user">
					<i class="fa fa-user"></i>
					<span>User</span>
				</a>
			</li>';
		}
			 if($_SESSION["profile"] =="Administrator" || $_SESSION["profile"] =="special"){
			echo'<li >
				<a href="category">
					<i class="fa fa-user"></i>
					<span>Category</span>
				</a>
			</li>
			<li >
				<a href="product">
					<i class="fa fa-product-hunt"></i>
					<span>Product</span>
				</a>
			</li>';
		}
		 if($_SESSION["profile"] =="Administrator" || $_SESSION["profile"] =="seller"){

			echo'<li >
				<a href="client">
					<i class="fa fa-users"></i>
					<span>client</span>
				</a>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-list-ul"></i>
					<span>Sale</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="manage-sale">
							<i class="fa fa-circle-o"></i>
							<span>Manage Sale</span>
						</a>
					</li>
					<li>
						<a href="create-sale">
							<i class="fa fa-circle-o"></i>
							<span>Create Sale</span>
						</a>
					</li>';
		}
		if($_SESSION["profile"] =="Administrator"){
					echo'<li>
						<a href="report">
							<i class="fa fa-circle-o"></i>
							<span>Sale Report</span>
						</a>
					</li>';}

					
					?>
				</ul>
			</li>

		</ul>
	</section>
</aside>