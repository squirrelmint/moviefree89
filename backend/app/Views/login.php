<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{blog_title}</title>
	<!-- <title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title> -->

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?=base_url('/global_assets/css/icons/icomoon/styles.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('/assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('/assets/css/core.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('/assets/css/components.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?=base_url('/assets/css/colors.min.css');?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?=base_url('/global_assets/js/plugins/loaders/pace.min.js');?>"></script>
	<script src="<?=base_url('/global_assets/js/core/libraries/jquery.min.js');?>"></script>
	<script src="<?=base_url('/global_assets/js/core/libraries/bootstrap.min.js');?>"></script>
	<script src="<?=base_url('/global_assets/js/plugins/loaders/blockui.min.js');?>"></script>
	<!-- /core JS files -->

	<script src="<?=base_url('/global_assets/js/plugins/notifications/sweet_alert.min.js');?>"></script>
	<script src="<?=base_url('/global_assets/js/plugins/forms/selects/select2.min.js');?>"></script>

	<script src="<?=base_url('/assets/js/app.js');?>"></script>

	<script src="<?=base_url('global_assets/js/demo_pages/components_modals.js');?>"></script>

	<script src="<?=base_url('/global_assets/js/plugins/ui/ripple.min.js');?>"></script>
	<!-- /theme JS files -->

</head>

<body class="login-container">

	<!-- Main navbar -->
	<div class="navbar navbar-inverse bg-indigo navbar-static-top">
		<div class="navbar-header">
			

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#">
						<i class="icon-display4"></i> <span class="visible-xs-inline-block position-right"> Go to website</span>
					</a>
				</li>

				<li>
					<a href="#">
						<i class="icon-user-tie"></i> <span class="visible-xs-inline-block position-right"> Contact admin</span>
					</a>
				</li>

				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cog3"></i>
						<span class="visible-xs-inline-block position-right"> Options</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Simple login form -->
					<form action="<?php echo base_url('user/authenticate'); ?>" method="post">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
								<h5 class="content-group">Login to your account <small class="display-block">Enter your credentials below</small></h5>
							</div>

							<?php  
								if(isset($_SESSION['msg'])){
							?>
								<div class="alert alert-danger no-border">
									<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
									<a href="#" class="alert-link"><?php echo $_SESSION['msg']; ?></a>.
								</div>
							<?php
								}
							?>

							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" placeholder="Username" name="username" id="username">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Password" name="password" id="password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn bg-pink-400 btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
							</div>

							<div class="text-center">
								<a href="login_password_recover.html">Forgot password?</a>
							</div>
						</div>
					</form>
					<!-- /simple login form -->


					<!-- Footer -->
					<div class="footer text-muted text-center">
						&copy; 2020.
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

<script>

	$( document ).ready(function() {

		//console.log( "ready!" );
		<?php helper(['alert']);getAlert(); ?>

	});

</script>

</body>
</html>
