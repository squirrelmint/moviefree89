<!-- Icons Grid -->
<section id="movie-banners" class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-12 ">
        <?php
        if (!empty($ads['pos1'])) {
          foreach ($ads['pos1'] as $val) {

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



<section class="text-center">
  <div class="container">
    <div id="movie-list" class="row">
      <div class="movie-title-list">
        <?php
        if (!empty($cate_name)) {
          $title = $cate_name;
        } else if (!empty($keyword)) {
          $title = 'คุณกำลังค้นหา : ' . $keyword;
        }
        ?>
        <h1><?= $title ?></h1>
      </div>
      <?php if (!empty($list['list'])) { ?>
        <ul id="list-movie" class="list-movie">
          <?PHP
          foreach ($list['list'] as $val) {
          ?>
            <li>
              <div class="movie-box">
                <?php if (substr($val['movie_picture'], 0, 4) == 'http') {
                  $movie_picture = $val['movie_picture'];
                } else {
                  $movie_picture = $path_thumbnail . $val['movie_picture'];
                }
                $url_name = urlencode(str_replace(' ', '-', $val['movie_thname']));
                ?>
                <a onclick="goView('<?= $val['movie_id'] ?>', '<?= $url_name ?>', '<?= $val['movie_type'] ?>')" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
                  <img src="<?= $movie_picture ?>" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
                </a>
                <div class="movie-overlay"></div>
                <?php
                if (!($val['movie_view'])) {
                  $view = 0;
                } else if (strlen($val['movie_view']) >= 5) {
                  $view =  substr($val['movie_view'], 0, -3) . 'k';
                } else {
                  $view = $val['movie_view'];
                }
                ?>
                <span class="movie-score"><?= $val['movie_ratescore'] ?><i class="fas fa-star"></i></span>
                <span class="movie-view"><?= $view ?> <i class="fas fa-eye"></i></span>
                <?php if (!empty($val['movie_quality'])) { ?>
                  <span class="movie-quality"><?= $val['movie_quality'] ?></span>
                <?php } ?>
                <?php
                if (!empty($val['movie_sound'])) {
                  $sound = $val['movie_sound'];
                  if (strtolower($val['movie_sound']) == 'th' || strtolower($val['movie_sound']) == 'thai') {
                    $sound = 'พากษ์ไทย';
                  } else if (strtolower($val['movie_sound']) == 'eng') {
                    $sound = 'พากษ์อังกฤษ';
                  }
                ?>
                  <span class="movie-sound"><?= $sound ?></span>
                <?php } ?>
              </div>

              <?php
              if (strlen($val['movie_thname']) > 40) {
                //= substr($value['movie_thname'], 0, 40) . '...';
                $val['movie_thname'] = iconv_substr($val['movie_thname'], 0, 40, "UTF-8") . '...';
              }
              ?>


              <div class="title-in">
                <h2>
                  <a onclick="goView('<?= $val['movie_id'] ?>', '<?= $url_name ?>', '<?= $val['movie_type'] ?>')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $val['movie_thname'] ?></a>
                </h2>
                <?php
                if (!empty($val['movie_ratescore']) && $val['movie_ratescore'] != 0) {
                  if (strpos($val['movie_ratescore'], '.')) {
                    $score = substr($val['movie_ratescore'], 0, 3);
                  } else {
                    $score = substr($val['movie_ratescore'], 0);
                  }
                ?>
                  <!-- <div class="movie-score">
                    <i class="fas fa-star"></i> <?= $score ?>
                  </div> -->
                <?php } ?>
              </div>
            </li>
          <?php  } ?>
        </ul>
      <?php
      } else {
      ?>
        <h3> ไม่พบหนังที่คุณค้นหา</h3>
      <?php } ?>
      <?php
      if (!empty($list['list'])) {
      ?>
        <button id="movie-loadmore">NEXT</button>
      <?php
      }
      ?>
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
<script>
  $(document).ready(function() {
    var track_click = 1; //track user click on "load more" button, righ now it is 0 click
    var total_pages = '<?= $list['total_page'] ?>';
    var keyword = "<?= $keyword ?>";
    if (track_click >= total_pages) {
      $("#movie-loadmore").hide(0);
    }
    track_click = 2;
    $("#movie-loadmore").click(function(e) { //user clicks on button
      if (track_click <= total_pages) //user click number is still less than total pages
      {
        //post page number and load returned data into result element
        $.get('<?php echo $url_loadmore ?>', {
          'page': track_click,
          'keyword': keyword,
        }, function(data) {
          //  $("#anime-loadmore").show(); //bring back load more button
          $("#list-movie").append(data); //append data received from server
          track_click++; //user click increment on load button
        }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
          alert(thrownError); //alert with HTTP error
        });
      }
      if (track_click >= total_pages) {
        $("#movie-loadmore").hide(0);
      }
      // alert(track_click+" "+total_pages)
    });
  });
</script>