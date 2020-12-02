  <!-- Icons Grid -->


  <section>
    <div class="container">
      <div id="movie-list" class="row">
        <div class="movie-title-list">
          <h1>Category</h1>
        </div>
        <ul class="ilst-catagory">

        <?php 
         foreach($list_category as $val ){ 
          $catename = str_replace(' ','-',$val['category_name']);
        ?>
          <li>
            <a  href="<?php echo base_url().'/category/'.$val['category_id'].'/'.$catename ?>"alt="<?= $val['category_name'] ?>" title="<?= $val['category_name'] ?>">           
            <div class="movie-area">
               
                <h1  class="movie-title-th"><?= $val['category_name'] ?></h1>
              </div>

           
              <img src="<?= $path_bg_cate . $val['category_id'].'.jpg';?>">

            </a>
          </li>
        <?php } ?>
              
        </ul>
      </div>
    </div>
  </section>

  <section id="movie-banners" class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12 ">
        <?php
        if (!empty($ads['pos2'])) {
          foreach ($ads['pos2'] as $val) {

            if (substr($val['ads_picture'], 0, 4) == 'http') {
              $ads_picture = $val['ads_picture'];
            } else {
              $ads_picture = $path_ads . $val['ads_picture'];
            }
        ?>
            <a href="<?= $val['ads_url'] ?>" alt="<?= $val['ads_name'] ?>" title="<?= $val['ads_name'] ?>">
              <img class="banners" src="<?= $ads_picture ?>" alt="<?= $val['ads_name'] ?>" title="<?= $val['ads_name'] ?>">
            </a>
        <?php
          }
        }
        ?>
      </div>
    </div>
  </div>
</section>

