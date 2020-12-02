<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Backend variety</title>
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

	<script src="<?=base_url('/global_assets/js/plugins/tables/datatables/datatables.min.js');?>"></script>
	<script src="<?=base_url('/global_assets/js/plugins/notifications/bootbox.min.js');?>"></script>
	<script src="<?=base_url('/global_assets/js/plugins/notifications/sweet_alert.min.js');?>"></script>
	<script src="<?=base_url('/global_assets/js/plugins/forms/selects/select2.min.js');?>"></script>
	<script src="<?=base_url('/global_assets/js/plugins/forms/validation/validate.min.js');?>"></script>
	<script src="<?=base_url('/global_assets/js/plugins/forms/styling/uniform.min.js');?>"></script>
	<script src="<?=base_url('/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js');?>"></script>

	<script src="<?=base_url('/global_assets/js/plugins/forms/styling/switchery.min.js');?>"></script>
	<script src="<?=base_url('/global_assets/js/plugins/forms/styling/switch.min.js');?>"></script>
	<script src="<?=base_url('/global_assets/js/plugins/forms/inputs/touchspin.min.js');?>"></script>

	<script src="<?=base_url('/assets/js/app.js');?>"></script>
	<script src="<?=base_url('global_assets/js/demo_pages/components_modals.js');?>"></script>

	

	<script src="<?=base_url('/global_assets/js/plugins/ui/ripple.min.js');?>"></script>
	<script src="<?=base_url('/global_assets/js/demo_pages/form_inputs.js');?>"></script>

	

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-inverse bg-indigo navbar-static-top">
		<div class="navbar-header">
			<!-- logo -->
			<a class="navbar-brand" href="<?=base_url()?>"></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

			<div class="navbar-right">
				<p class="navbar-text"><b>สวัสดี</b> <?= session()->get('uname'); ?>!</p>
				<p class="navbar-text"><span class="label bg-success-400">Online</span></p>
			</div>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main sidebar-default">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user-material">
						<div class="category-content">
							<div class="sidebar-user-material-content">
								<a href="#"><img src="<?php echo base_url('global_assets/images/placeholders/placeholder.jpg')?>" class="img-circle img-responsive" alt=""></a>
								<h6><?= session()->get('uname'); ?></h6>
							</div>
														
							<div class="sidebar-user-material-menu">
								<a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
							</div>
						</div>
						
						<div class="navigation-wrapper collapse" id="user-nav">
							<ul class="navigation">
								<li><a href="<?= base_url('/logout') ?>"><i class="icon-switch2"></i> <span>Logout</span></a></li>
							</ul>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
								<li class="active"><a href="<?=base_url('/dashboard')?>"><i class="icon-home4"></i> <span>หน้าแรก</span></a></li>

								<?php if(empty($branchsystem)){ 
											$brid = $_SESSION['brid'];

											if($_SESSION['brsystem']['id'.$brid] == 'manga'){
								?>
									<!-- Main Manga --> 
									<li class=""><a href="<?=base_url('/setting/branch/'.$brid)?>"><i class="icon-cog3"></i> <span>ตั้งค่าเว็บ</span></a></li>
									<li class=""><a href="<?=base_url('/seo/branch/'.$brid)?>"><i class="icon-hyperlink"></i> <span>SEO</span></a></li>
									<li class=""><a href="<?=base_url('/manga/branch/'.$brid.'/category/index')?>"><i class="icon-list"></i> <span>หมวดหมู่มังงะ</span></a></li>
									<li class=""><a href="<?=base_url('/manga/branch/'.$brid.'/subject/index')?>"><i class="icon-stack-picture"></i> <span>มังงะ</span></a></li>
									<li class=""><a href="<?=base_url('/mangaads/branch/'.$brid.'/index')?>"><i class="icon-coin-dollar"></i> <span>โฆษณา</span></a></li>
									<li class=""><a href="<?=base_url('/reportads/branch/'.$brid.'/index')?>"><i class=" icon-stats-growth"></i> <span>รายงานโฆษณา</span></a></li>
									<li class=""><a href="<?=base_url('/manga/branch/'.$brid.'/report/index')?>"><i class="icon-warning22"></i> <span>แจ้งเสีย</span></a></li>
									<li class=""><a href="<?=base_url('/manga/branch/'.$brid.'/request/index')?>"><i class="icon-stars"></i> <span>รายการมังงะที่ขอ</span></a></li>
									<li class=""><a href="<?=base_url('/content/branch/'.$brid.'/content/index')?>"><i class="icon-bubble-lines4"></i> <span>เนื้อหา</span></a></li>

											<?php }elseif($_SESSION['brsystem']['id'.$brid] == 'movie'){ ?>
									<!-- Main Movie -->
									<li class=""><a href="<?=base_url('/setting/branch/'.$brid)?>"><i class="icon-cog3"></i> <span>ตั้งค่าเว็บ</span></a></li>
									<li class=""><a href="<?=base_url('/seo/branch/'.$brid)?>"><i class="icon-hyperlink"></i> <span>SEO</span></a></li>
									<li class=""><a href="<?=base_url('/content/branch/'.$brid.'/content/index')?>"><i class="icon-bubble-lines4"></i> <span>เนื้อหา</span></a></li>
									<li class=""><a href="<?=base_url('/movie/branch/'.$brid.'/category/index')?>"><i class="icon-list"></i> <span>หมวดหมู่หนัง</span></a></li>
									<li class=""><a href="<?=base_url('/video/branch/'.$brid.'/video/index')?>"><i class="icon-film2"></i> <span>หนัง</span></a></li>
									<li class=""><a href="<?=base_url('/movieads/branch/'.$brid.'/index')?>"><i class="icon-coin-dollar"></i> <span>โฆษณารูปภาพ</span></a></li>
									<li class=""><a href="<?=base_url('/vdoads/branch/'.$brid.'/index')?>"><i class="icon-coin-dollar"></i> <span>โฆษณาวีดีโอ</span></a></li>
									<li class=""><a href="<?=base_url('/movie/branch/'.$brid.'/report/index')?>"><i class="icon-warning22"></i> <span>แจ้งเสีย</span></a></li>
									<li class=""><a href="<?=base_url('/movie/branch/'.$brid.'/request/index')?>"><i class="icon-bubbles10"></i> <span>หนังที่ขอ</span></a></li>
									<li class=""><a href="<?=base_url('/reportads/branch/'.$brid.'/index')?>"><i class="icon-graph"></i> <span>รายงานโฆษณารูปภาพ</span></a></li>
									<li class=""><a href="<?=base_url('/reportadsvideo/branch/'.$brid.'/index')?>"><i class="icon-graph"></i> <span>รายงานโฆษณาวีดีโอ</span></a></li>
									<li style="display: none;" class=""><a href="<?=base_url('/video/branch/'.$brid.'/livestream/index')?>"><i class="icon-presentation"></i> <span>รายการทีวี</span></a></li>
									<li class=""><a href="<?=base_url('/movie/requestads/branch/'.$brid)?>"><i class="icon-address-book3"></i> <span>คำขอลงโฆษณา</span></a></li>
									<li class=""><a href="<?=base_url('/movie/contact/branch/'.$brid)?>"><i class="icon-headset"></i> <span>ผู้ต้องการติดต่อ</span></a></li>
								<?php }} ?>

							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			
