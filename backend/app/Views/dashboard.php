<div class="row">

<?php
	if( !empty($branch) ){
		foreach ($branch as $br) {
?>
	<div class="col-sm-6 col-md-4 col-lg-3">

		<div class="panel ">

			<div class="panel-heading">
				<h6 class="panel-title"></h6>
				<div class="heading-elements">
					<!-- <span class="label <?php echo $branch_statusstyle[$br['branch_status']]; ?> heading-text"><?php echo $branch_status[$br['branch_status']]; ?></span> -->
					<ul class="icons-list">
                		<li class="dropdown">
                			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
							<ul class="dropdown-menu dropdown-menu-right">
							<?php
								if($br['branch_status']!=1){
							?>
								<li><a href="/dashboard/update/branch/<?php echo $br['branch_id']?>/status/1"><i class="icon-sphere"></i> เปิดการใช้งาน</a></li>
							<?php
								}
							?>

							<?php
								if($br['branch_status']!=2){	
							?>
							<li><a href="/dashboard/update/branch/<?php echo $br['branch_id']?>/status/2"><i class="icon-eye-blocked"></i> ปรับปรุงระบบ</a></li>
							<?php 
								} 
							?>

							<?php
								if($br['branch_status']!=0){
							?>
								<li><a href="/dashboard/update/branch/<?php echo $br['branch_id']?>/status/0"><i class="icon-switch"></i> ปิดการใช้งาน</a></li>
							<?php
								}
							?>
							</ul>
                		</li>
                	</ul>
				</div>
			</div>

			<div class="panel-body text-center">
				<div class="content-group mt-5">
					<!-- <h1>Logo</h1> -->
					<?php
						$logo = base_url('/global_assets/images/placeholders/placeholder.jpg');
						if(!empty($br['branch_logo'])){
							$logo = $logo = base_url('/logo/'.$br['branch_logo']);
						}
					?>
					<center><img src="<?=$logo?>" class="img-circle img-responsive" width=120px"></center>
				</div>

				<h6 class="text-semibold"><a href="#" class="text-default"><?php echo strtoupper($br['branch_name']); ?></a></h6>
				<ul class="list-inline list-inline-condensed">
					<li>
						<span class="status-mark <?php echo $branch_statusstyle[$br['branch_status']]; ?>"></span>
					</li>
					<li>
						<span class="text-muted"><?php echo $branch_status[$br['branch_status']]; ?></span>
					</li>
				</ul>

				<a href="/management/branch/<?php echo $br['branch_id']; ?>" type="button" class="btn bg-success-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b> การจัดการ</a>
			</div>
		</div>

	</div>
<?php
		}
	}
?>

</div>

<div class="row">

	<div class="col-sm-6 col-lg-3">

	</div>
	
</div>

<div class="col-sm-6 col-lg-3">


</div>

<div class="col-sm-6 col-lg-3">

</div>

<script>

	$( document ).ready(function() {

		//console.log( "ready!" );
		<?php getAlert(); ?>

	});

</script>