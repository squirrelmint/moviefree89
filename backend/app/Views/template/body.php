			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							<h4><a href="javascript:history.back()"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold"><?= $module_name ?></span></h4>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<?php 
								$i = 0;
								$len = count($module_level);
								foreach ($module_level as $key => $value) {

									if ($i == 0) {
										?> <li><a href="<?=base_url('/')?>"><i class="icon-home2 position-left"></i> Home</a></li> <?php
									} else if ($i == $len - 1) {
										?> <li class="active"><?= $value['name'] ?></li> <?php
									}else{
										?> <li><a href="<?=base_url($value['url'])?>"> <?= $value['name'] ?></a></li> <?php
									}
									$i++;
								}
							?>
						</ul>
					</div>
				</div>
				<!-- /page header -->

				<!-- Content area -->
				<div class="content">
					