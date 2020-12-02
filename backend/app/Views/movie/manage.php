<div class="row">

	<div class="col-sm-12 col-md-3">
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
						<label class="text-semibold">Phone number:</label>
						<span class="pull-right-sm">
						<?php
							if(!empty($user['user_tel'])){
								echo $user['user_tel'];
							}else{
								echo '<span class="text-muted">empty</span>';
							}
						?>
						</span>
					</div>

					<div class="form-group no-margin-bottom">
						<label class="text-semibold">Personal Email:</label>
						<span class="pull-right-sm">
						<?php
							if(!empty($user['user_tel'])){
								echo '<a href="#"><?=$user[\'user_email\'];?></a>';
							}else{
								echo '<span class="text-muted">empty</span>';
							}
						?>
							
						</span>
					</div>

				</div>

				<div class="list-group no-border no-padding-top no-margin">
					<div class="list-group-divider"></div>
					<a href="/profile/edit/<?=$user['user_id'];?>" class="list-group-item"><i class="icon-cog3"></i> Account settings</a>
				</div>
			</div>
		</div>

	</div>

	<div class="col-sm-12 col-md-9">

		<div class="col-md-4 col-xs-12">
			<!-- Chat widget -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h2 class="panel-title"><a href="<?= base_url('/setting/branch/'.$branch['branch_id'])?>">ตั้งค่าเว็บ</a></h2>
				</div>

				<div class="panel-footer panel-footer-condensed bg-info-400">
					<div class="heading-elements not-collapsible pull-right">
						<div class="col-xs-19">
							<ul class="icons-list icons-list-extended mt-10">
								<li><a href="<?= base_url('/setting/branch/'.$branch['branch_id'])?>" data-popup="tooltip" data-container="body" title="ตั้งค่าเว็บไซต์"><i class="icon-plus-circle2"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /chat widget -->
		</div>

		<div class="col-md-4 col-xs-12">
			<!-- Chat widget -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h2 class="panel-title"><a href="<?= base_url('/seo/branch/'.$branch['branch_id'])?>">ตั้งค่า SEO</a></h2>
				</div>

				<div class="panel-footer panel-footer-condensed bg-danger-400">
					<div class="heading-elements not-collapsible pull-right">
						<div class="col-xs-19">
							<ul class="icons-list icons-list-extended mt-10">
								<li><a href="<?= base_url('/seo/branch/'.$branch['branch_id'])?>" data-popup="tooltip" data-container="body" title="ตั้งค่า SEO"><i class="icon-plus-circle2"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /chat widget -->
		</div>

		<div class="col-md-4 col-xs-12">
			<!-- Chat widget -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h2 class="panel-title"><a href="<?= base_url('/movieads/branch/'.$branch['branch_id'].'/index')?>">โฆษณารูปภาพ</a></h2>
				</div>

				<div class="panel-footer panel-footer-condensed bg-pink-400">
					<div class="heading-elements not-collapsible pull-right">
						<div class="col-xs-19">
							<ul class="icons-list icons-list-extended mt-10">
								<li><a href="<?= base_url('/movieads/branch/'.$branch['branch_id'].'/add')?>" data-popup="tooltip" data-container="body" title="Add ads"><i class="icon-plus-circle2"></i></a></li>
								<li><a href="<?= base_url('/movieads/branch/'.$branch['branch_id'].'/index')?>" data-popup="tooltip" data-container="body" title="View ads"><i class="icon-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /chat widget -->
		</div>

		<div class="col-md-4 col-xs-12">
			<!-- Chat widget -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h2 class="panel-title"><a href="<?= base_url('/vdoads/branch/'.$branch['branch_id'].'/index')?>">โฆษณา(Video)</a></h2>
				</div>

				<div class="panel-footer panel-footer-condensed bg-purple-400">
					<div class="heading-elements not-collapsible pull-right">
						<div class="col-xs-19">
							<ul class="icons-list icons-list-extended mt-10">
								<li><a href="<?= base_url('/vdoads/branch/'.$branch['branch_id'].'/add')?>" data-popup="tooltip" data-container="body" title="Add ads video"><i class="icon-plus-circle2"></i></a></li>
								<li><a href="<?= base_url('/vdoads/branch/'.$branch['branch_id'].'/index')?>" data-popup="tooltip" data-container="body" title="View ads video"><i class="icon-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /chat widget -->
		</div>

		<div class="col-md-4 col-xs-12">
			<!-- Chat widget -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h2 class="panel-title"><a href="<?= base_url('/movie/branch/'.$branch['branch_id'].'/report/index')?>">แจ้งเสีย</a></h2>
				</div>

				<div class="panel-footer panel-footer-condensed bg-green-400">
					<div class="heading-elements not-collapsible pull-right">
						<div class="col-xs-19">
							<ul class="icons-list icons-list-extended mt-10">
								<li><a href="/movie/branch/<?=$branch['branch_id'] ?>/report/index" data-popup="tooltip" data-container="body" title="View report"><i class="icon-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4 col-xs-12">
			<!-- Chat widget -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h2 class="panel-title"><a href="<?= base_url('/movie/branch/'.$branch['branch_id'].'/request/index')?>">หนังที่ขอ</a></h2>
				</div>

				<div class="panel-footer panel-footer-condensed bg-brown-400">
					<div class="heading-elements not-collapsible pull-right">
						<div class="col-xs-19">
							<ul class="icons-list icons-list-extended mt-10">
								<li><a href="/movie/branch/<?=$branch['branch_id'] ?>/request/index" data-popup="tooltip" data-container="body" title="View request"><i class="icon-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4 col-xs-12" style="display:none">
			<!-- Chat widget -->
			<div class="panel panel-flat" >
				<div class="panel-heading">
					<h2 class="panel-title"><a href="<?= base_url('/video/branch/'.$branch['branch_id'].'/livestream/index')?>">รายการทีวี</a></h2>
				</div>

				<div class="panel-footer panel-footer-condensed bg-blue-400">
					<div class="heading-elements not-collapsible pull-right">
						<div class="col-xs-19">
							<ul class="icons-list icons-list-extended mt-10">
								<li><a href="<?= base_url('/video/branch/'.$branch['branch_id'].'/livestream/add')?>" data-popup="tooltip" data-container="body" title="Add Content"><i class="icon-plus-circle2"></i></a></li>
								<li><a href="<?= base_url('/video/branch/'.$branch['branch_id'].'/livestream/index')?>" data-popup="tooltip" data-container="body" title="View Content"><i class="icon-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /chat widget -->
		</div>

		<div class="col-md-4 col-xs-12">
			<!-- Chat widget -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h2 class="panel-title"><a href="<?= base_url('/content/branch/'.$branch['branch_id'].'/content/index')?>">เนื้อหา</a></h2>
				</div>

				<div class="panel-footer panel-footer-condensed bg-primary-400">
					<div class="heading-elements not-collapsible pull-right">
						<div class="col-xs-19">
							<ul class="icons-list icons-list-extended mt-10">
							<li><a href="<?= base_url('/content/branch/'.$branch['branch_id'].'/content/add')?>" data-popup="tooltip" data-container="body" title="Add live stream"><i class="icon-plus-circle2"></i></a></li>
							<li><a href="<?= base_url('/content/branch/'.$branch['branch_id'].'/content/index')?>" data-popup="tooltip" data-container="body" title="View report"><i class="icon-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /chat widget -->
		</div>

		<div class="col-md-4 col-xs-12">
			<!-- Chat widget -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h2 class="panel-title"><a href="<?= base_url($branch['branch_system'].'/branch/'.$branch['branch_id'].'/category/index')?>">หมวดหมู่หนัง</a></h2>
				</div>

				<div class="panel-footer panel-footer-condensed bg-warning-400">
					<div class="heading-elements not-collapsible pull-right">
						<div class="col-xs-19">
							<ul class="icons-list icons-list-extended mt-10">
								<li><a href="<?= base_url($branch['branch_system'].'/branch/'.$branch['branch_id'].'/category/add')?>" data-popup="tooltip" data-container="body" title="Add category"><i class="icon-plus-circle2"></i></a></li>
								<li><a href="<?= base_url($branch['branch_system'].'/branch/'.$branch['branch_id'].'/category/index')?>" data-popup="tooltip" data-container="body" title="View category"><i class="icon-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /chat widget -->
		</div>

		<div class="col-md-4 col-xs-12">
			<!-- Chat widget -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h2 class="panel-title"><a href="<?= base_url('/video/branch/'.$branch['branch_id'].'/video/index')?>">รายการหนัง</h2></a>
				</div>

				<div class="panel-footer panel-footer-condensed bg-teal-400">
					<div class="heading-elements not-collapsible pull-right">
						<div class="col-xs-19">
							<ul class="icons-list icons-list-extended mt-10">
								<li><a href="<?= base_url('/video/branch/'.$branch['branch_id'].'/video/add')?>" data-popup="tooltip" data-container="body" title="Add movie"><i class="icon-plus-circle2"></i></a></li>
								<li><a href="<?= base_url('/video/branch/'.$branch['branch_id'].'/video/index')?>" data-popup="tooltip" data-container="body" title="View movie"><i class="icon-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /chat widget -->
		</div>

		<div class="col-md-4 col-xs-12">
			<!-- Chat widget -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h2 class="panel-title"><a href="<?= base_url('/reportads/branch/'.$branch['branch_id'].'/index')?>">รายงานโฆษณา</a></h2>
				</div>

				<div class="panel-footer panel-footer-condensed bg-green-400">
					<div class="heading-elements not-collapsible pull-right">
						<div class="col-xs-19">
							<ul class="icons-list icons-list-extended mt-10">
								<li><a href="<?= base_url('/reportads/branch/'.$branch['branch_id'].'/index')?>" data-popup="tooltip" data-container="body" title="View ads"><i class="icon-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /chat widget -->
		</div>

		<div class="col-md-4 col-xs-12">
			<!-- Chat widget -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h2 class="panel-title"><a href="/reportadsvideo/branch/<?=$branch['branch_id']?>/index">รายงาน โฆษณาวีดีโอ</a></h2>
				</div>

				<div class="panel-footer panel-footer-condensed bg-pink-400">
					<div class="heading-elements not-collapsible pull-right">
						<div class="col-xs-19">
							<ul class="icons-list icons-list-extended mt-10">
								<li><a href="/reportadsvideo/branch/<?=$branch['branch_id']?>/index" data-popup="tooltip" data-container="body" title="View ads"><i class="icon-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /chat widget -->
		</div>

		<div class="col-md-4 col-xs-12">
			<!-- Chat widget -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h2 class="panel-title"><a href="<?= base_url('/movie/requestads/branch/'.$branch['branch_id'])?>">คำขอลงโฆษณา</a></h2>
				</div>

				<div class="panel-footer panel-footer-condensed bg-info-400">
					<div class="heading-elements not-collapsible pull-right">
						<div class="col-xs-19">
							<ul class="icons-list icons-list-extended mt-10">
								<li><a href="<?= base_url('/movie/requestads/branch/'.$branch['branch_id'])?>" data-popup="tooltip" data-container="body" title="คำขอลงโฆษณา"><i class="icon-plus-circle2"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /chat widget -->
		</div>

		<div class="col-md-4 col-xs-12">
			<!-- Chat widget -->
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h2 class="panel-title"><a href="<?= base_url('/movie/contact/branch/'.$branch['branch_id'])?>">ผู้ต้องการติดต่อ</a></h2>
				</div>

				<div class="panel-footer panel-footer-condensed bg-purple-400">
					<div class="heading-elements not-collapsible pull-right">
						<div class="col-xs-19">
							<ul class="icons-list icons-list-extended mt-10">
								<li><a href="<?= base_url('/movie/contact/branch/'.$branch['branch_id'])?>" data-popup="tooltip" data-container="body" title="View ads video"><i class="icon-eye"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /chat widget -->
		</div>
	
	</div>

</div>

<script>
	$( document ).ready(function() {
		//console.log( "ready!" );
		<?php getAlert(); ?>
	});
</script>