<style>

	a h2.panel-title {

		color: #000;

	}

</style>



<div class="col-sm-6 col-lg-3">

	<div class="content-group">

		<div class="panel-body bg-grey-800 text-center">

			<div class="display-inline-block">

				<i class="icon-user icon-3x"></i>

			</div>



			<h6 class="text-semibold no-margin-bottom">

				<a href="#" class="text-white"><?=ucwords(strtolower($user['user_label']));?></a>

				<!-- <small class="display-block">Lead UX designer</small> -->

			</h6>



		</div>

		<div class="panel">

			<div class="panel-body no-border-top no-border-radius-top">



				<div class="form-group">

					<label class="text-semibold">เบอร์ :</label>

					<span class="pull-right-sm">

					<?php

						if(!empty($user['user_tel'])){

							echo $user['user_tel'];

						}else{

							echo '<span class="text-muted">ไม่มี</span>';

						}

					?>

					</span>

				</div>



				<div class="form-group no-margin-bottom">

					<label class="text-semibold">อีเมล :</label>

					<span class="pull-right-sm">

					<?php

						if(!empty($user['user_tel'])){

							echo '<a href="#"><?=$user[\'user_email\'];?></a>';

						}else{

							echo '<span class="text-muted">ไม่มี</span>';

						}

					?>

						

					</span>

				</div>



			</div>



			<div class="list-group no-border no-padding-top no-margin">

				<div class="list-group-divider"></div>

				<a href="<?php echo base_url('/profile/edit/'.$user['user_id']);?>" class="list-group-item"><i class="icon-cog3"></i> ตั้งค่าบัญชีผู้ใช้</a>

			</div>

		</div>

	</div>



</div>



<div class="col-sm-6 col-lg-3">

	<!-- Chat widget -->

	<div class="panel panel-flat">

		<div class="panel-heading">

			<a href="<?php echo base_url('/setting/branch/'.$branch['branch_id']);?>">

				<h2 class="panel-title">ตั้งค่าเว็บ</h2>

			</a>

		</div>



		<div class="panel-footer panel-footer-condensed bg-primary-400">

			<div class="heading-elements not-collapsible pull-right">

				<div class="col-xs-19">

					<ul class="icons-list icons-list-extended mt-10">

						<li><a href="<?php echo base_url('/setting/branch/'.$branch['branch_id']);?>" data-popup="tooltip" data-container="body" title="ตั้งค่าเว็บไซต์"><i class="icon-plus-circle2"></i></a></li>

					</ul>

				</div>

			</div>

		</div>

	</div>

	<!-- /chat widget -->

</div>



<div class="col-sm-6 col-lg-3">

	<!-- Chat widget -->

	<div class="panel panel-flat">

		<div class="panel-heading">

			<a href="<?php echo base_url('/seo/branch/'.$branch['branch_id']);?>">

				<h2 class="panel-title">SEO</h2>

			</a>

		</div>



		<div class="panel-footer panel-footer-condensed bg-brown-400">

			<div class="heading-elements not-collapsible pull-right">

				<div class="col-xs-19">

					<ul class="icons-list icons-list-extended mt-10">

						<li><a href="<?php echo base_url('/seo/branch/'.$branch['branch_id']);?>" data-popup="tooltip" data-container="body" title="ตั้งค่า SEO"><i class="icon-plus-circle2"></i></a></li>

					</ul>

				</div>

			</div>

		</div>

	</div>

	<!-- /chat widget -->

</div>



<div class="col-sm-6 col-lg-3">

	<!-- Chat widget -->

	<div class="panel panel-flat">

		<div class="panel-heading">

			<a href="<?php echo base_url('/'.$branch['branch_system'].'/branch/'.$branch['branch_id'].'/category/index');?>">

				<h2 class="panel-title">หมวดหมู่มังงะ</h2>

			</a>

		</div>



		<div class="panel-footer panel-footer-condensed bg-warning-400">

			<div class="heading-elements not-collapsible pull-right">

				<div class="col-xs-19">

					<ul class="icons-list icons-list-extended mt-10">

						<li><a href="<?php echo base_url('/'.$branch['branch_system'].'/branch/'.$branch['branch_id'].'/category/add');?>" data-popup="tooltip" data-container="body" title="เพิ่มหมวดหมู่"><i class="icon-plus-circle2"></i></a></li>

						<li><a href="<?php echo base_url('/'.$branch['branch_system'].'/branch/'.$branch['branch_id'].'/category/index');?>" data-popup="tooltip" data-container="body" title="รายการหมวดหมู่"><i class="icon-eye"></i></a></li>

					</ul>

				</div>

			</div>

		</div>

	</div>

	<!-- /chat widget -->

</div>



<div class="col-sm-6 col-lg-3">

	<!-- Chat widget -->

	<div class="panel panel-flat">

		<div class="panel-heading">

			<a href="<?php echo base_url('/'.$branch['branch_system'].'/branch/'.$branch['branch_id'].'/subject/index');?>">

				<h2 class="panel-title">มังงะ</h2>

			</a>

		</div>



		<div class="panel-footer panel-footer-condensed bg-teal-400">

			<div class="heading-elements not-collapsible pull-right">

				<div class="col-xs-19">

					<ul class="icons-list icons-list-extended mt-10">

						<li><a href="<?php echo base_url('/'.$branch['branch_system'].'/branch/'.$branch['branch_id'].'/subject/add');?>" data-popup="tooltip" data-container="body" title="เพิ่มมังงะ"><i class="icon-plus-circle2"></i></a></li>

						<li><a href="<?php echo base_url('/'.$branch['branch_system'].'/branch/'.$branch['branch_id'].'/subject/index');?>" data-popup="tooltip" data-container="body" title="รายการมังงะ"><i class="icon-eye"></i></a></li>

					</ul>

				</div>

			</div>

		</div>

	</div>

	<!-- /chat widget -->

</div>



<div class="col-sm-6 col-lg-3">

	<!-- Chat widget -->

	<div class="panel panel-flat">

		<div class="panel-heading">

			<a href="<?php echo base_url('/mangaads/branch/'.$branch['branch_id'].'/index');?>">

				<h2 class="panel-title">โฆษณา</h2>

			</a>

		</div>



		<div class="panel-footer panel-footer-condensed bg-pink-400">

			<div class="heading-elements not-collapsible pull-right">

				<div class="col-xs-19">

					<ul class="icons-list icons-list-extended mt-10">

						<li><a href="<?php echo base_url('/mangaads/branch/'.$branch['branch_id'].'/add');?>" data-popup="tooltip" data-container="body" title="เพิ่มโฆษณา"><i class="icon-plus-circle2"></i></a></li>

						<li><a href="<?php echo base_url('/mangaads/branch/'.$branch['branch_id'].'/index');?>" data-popup="tooltip" data-container="body" title="รายการโฆษณา"><i class="icon-eye"></i></a></li>

					</ul>

				</div>

			</div>

		</div>

	</div>

	<!-- /chat widget -->

</div>



<div class="col-sm-6 col-lg-3">

	<!-- Chat widget -->

	<div class="panel panel-flat">

		<div class="panel-heading">

			<a href="<?php echo base_url('/manga/branch/'.$branch['branch_id'].'/report/index');?>">

				<h2 class="panel-title">แจ้งเสีย</h2>

			</a>

		</div>



		<div class="panel-footer panel-footer-condensed bg-purple-400">

			<div class="heading-elements not-collapsible pull-right">

				<div class="col-xs-19">

					<ul class="icons-list icons-list-extended mt-10">

						<li><a href="<?php echo base_url('/manga/branch/'.$branch['branch_id'].'/report/index');?>" data-popup="tooltip" data-container="body" title="รายการแจ้งเสีย"><i class="icon-eye"></i></a></li>

					</ul>

				</div>

			</div>

		</div>

	</div>

	<!-- /chat widget -->

</div>

<div class="col-sm-6 col-lg-3">

	<!-- Chat widget -->

	<div class="panel panel-flat">

		<div class="panel-heading">

			<a href="<?php echo base_url('/manga/branch/'.$branch['branch_id'].'/request/index');?>">

				<h2 class="panel-title">รายการมังงะที่ขอ</h2>

			</a>

		</div>



		<div class="panel-footer panel-footer-condensed bg-green-400">

			<div class="heading-elements not-collapsible pull-right">

				<div class="col-xs-19">

					<ul class="icons-list icons-list-extended mt-10">

						<li><a href="<?php echo base_url('/manga/branch/'.$branch['branch_id'].'/request/index');?>" data-popup="tooltip" data-container="body" title="รายการมังงะที่ขอ"><i class="icon-eye"></i></a></li>

					</ul>

				</div>

			</div>

		</div>

	</div>

	<!-- /chat widget -->

</div>



<div class="col-sm-6 col-lg-3">

	<!-- Chat widget -->

	<div class="panel panel-flat">

		<div class="panel-heading">

			<a href="<?php echo base_url('/content/branch/'.$branch['branch_id'].'/content/index');?>">

				<h2 class="panel-title">เนื้อหา</h2>

			</a>

		</div>



		<div class="panel-footer panel-footer-condensed bg-info-400">

			<div class="heading-elements not-collapsible pull-right">

				<div class="col-xs-19">

					<ul class="icons-list icons-list-extended mt-10">

					<li><a href="<?php echo base_url('/content/branch/'.$branch['branch_id'].'/content/add');?>" data-popup="tooltip" data-container="body" title="Add live stream"><i class="icon-plus-circle2"></i></a></li>

					<li><a href="<?php echo base_url('/content/branch/'.$branch['branch_id'].'/content/index');?>" data-popup="tooltip" data-container="body" title="View report"><i class="icon-eye"></i></a></li>

					</ul>

				</div>

			</div>

		</div>

	</div>

	<!-- /chat widget -->

</div>



<div class="col-sm-6 col-lg-3">

	<!-- Chat widget -->

	<div class="panel panel-flat">

		<div class="panel-heading">

			<a href="<?php echo base_url('/reportads/branch/'.$branch['branch_id'].'/index');?>">

				<h2 class="panel-title">รายงานโฆษณา</h2>

			</a>

		</div>



		<div class="panel-footer panel-footer-condensed bg-orange-400">

			<div class="heading-elements not-collapsible pull-right">

				<div class="col-xs-19">

					<ul class="icons-list icons-list-extended mt-10">

					<li><a href="<?php echo base_url('/reportads/branch/'.$branch['branch_id'].'/index');?>" data-popup="tooltip" data-container="body" title="View report ads"><i class="icon-eye"></i></a></li>

					</ul>

				</div>

			</div>

		</div>

	</div>

	<!-- /chat widget -->

</div>



<script>

	$( document ).ready(function() {

		//console.log( "ready!" );

		<?php getAlert(); ?>

	});

</script>