<header>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo base_url();?>index.php/welcome/">Super Site com CodeIgniter</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
				<ul class="nav navbar-nav">
					<li <?php echo (setMenuItemActive($active_menu == 'home')) ?>>
						<a href="<?php echo base_url();?>">home<span class="sr-only">(current)</span></a>
					</li>
					<li <?php echo (setMenuItemActive($active_menu == 'about')) ?>>
						<a href="<?php echo base_url();?>welcome/about">about</a>
					</li>
					<li <?php echo (setMenuItemActive($active_menu == 'contact')) ?>>
						<a href="<?php echo base_url();?>welcome/contact">contact</a>
					</li>
					<li <?php echo (setMenuItemActive($active_menu == 'books')) ?>>
						<a href="<?php echo base_url();?>Books/">Books</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a></li>
							<li class="divider"></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li>
				</ul>
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Link</a></li>
				</ul>
			</div>
		</div>
	</nav>
</header>