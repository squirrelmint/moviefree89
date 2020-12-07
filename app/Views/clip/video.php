<style>
    iframe {
        height: -webkit-fill-available;
    }
</style>
<div class="container" style="padding: 1rem;">
    <div class="row">

        <div class="col-sm-12">
            <h2 class="center-des-1">
            <?= $videodata['movie_thname'] ?> 
            </h2>
            <div class="col-sm-12">
                <!-- *** IFRAM CLIP ***  -->
                    <?php echo $videodata['movie_ensub1']; ?>
                <!-- *** //IFRAM CLIP ***  -->
            </div>
            <div id="movie-player">
              
                <div class="movie-header">
                    <div class="movie-trailer">
                        <?php //echo "<pre>";print_r($videodata['movie_ensub1']);die;
                        ?>
                        <!-- <iframe  src="<?php //echo $videodata['movie_ensub1']; 
                                            ?>" ></iframe> -->

                    </div>
                    <?php if (substr($videodata['movie_picture'], 0, 4) == 'http') {

                        $movie_picture = $videodata['movie_picture'];
                    } else {

                        $movie_picture = $path_thumbnail . $videodata['movie_picture'];
                    }

                    $url_name = urlencode(str_replace(' ', '-', $videodata['movie_thname']))

                    ?>

                </div>


                <?php
                if ($videodata['movie_type'] == "se") {
                    foreach ($videodata['epdata'] as $key => $val) {
                        $active = '';
                        if ($index == $key) {
                            $active = 'active-ep';
                        }
                        $url_nameep = urlencode(str_replace(' ', '-', $videodata['name_ep'][$key]));
                ?>
                        <div class="col-sm-12 text-ep">
                            <a class="" onclick="goEP('<?= $videodata['movie_id'] ?>','<?= $url_name ?>','<?= trim($key) ?>','<?= $url_nameep ?>')" tabindex="-1">
                                <span class="<?= $active ?> ep-series"><?= $videodata['name_ep'][$key] ?></span>
                            </a>
                        </div>
                <?php }
                }
                ?>


                <div id="movie-detail">
                    <div class="movie-card-detail">
                        <div class="movie-box">
                            <div class="movie-score">
                                <?php
                                // if (!empty($videodata['movie_ratescore']) && $videodata['movie_ratescore'] != 0) {
                                //   if (strpos($videodata['movie_ratescore'], '.')) {
                                //     $score = substr($videodata['movie_ratescore'], 0, 3);
                                //   } else {
                                //     $score = substr($videodata['movie_ratescore'], 0);
                                //   }
                                ?>
                                <!-- <i class="fas fa-star"></i> <?//= $score ?> -->
                                <?php //} 
                                ?>
                            </div>

                            <div class="movie-social">
                                <a href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u=<?= urlencode(base_url(uri_string())) ?>&display=popup&ref=plugin&src=share_button" target="_blank">
                                    <i class="fab fa-facebook-square"></i>
                                </a>
                                <a target="_blank" href="https://twitter.com/share?hashtags=ดูหนังออนไลน์,ดูหนังใหม่&text=<?= $url_name ?>">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://social-plugins.line.me/lineit/share?url=<?= urlencode(base_url(uri_string())) ?>" target="_blank">
                                    <i class="fab fa-line"></i>
                                </a>
                                <button class="movie-btn-report" onclick="get_Report()">แจ้งหนังเสีย</button>
                            </div>
                        </div>

                    </div>


                </div>

                <h2 class="movie-des-video">
                    เรื่องย่อ : <?= $videodata['movie_des'] ?>
                </h2>
                <h2 class="center-des-1">
                    คลิปแนะนำ
                </h2>
                <div id="movie-list" class="row">

                    <?php if (!empty($video_random['list'])) { ?>
                        <ul id="list-movie" class="list-movie">
                            <?PHP
                            //echo "<pre>"; print_r($newmovie_1);die;
                            foreach ($video_random['list'] as $val) {
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
                                        <a onclick="goViewCl('<?= $val['movie_id'] ?>', '<?= $url_name ?>', '<?= $val['movie_type'] ?>')" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
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
                                        <!-- <span class="movie-view"><?= $view ?> <i class="fas fa-eye"></i></span> -->
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
                                            <!-- <span class="movie-sound"><?= $sound ?></span> -->
                                        <?php } ?>
                                    </div>

                                    <?php
                                    if (strlen($val['movie_thname']) > 40) {
                                        //= substr($value['movie_thname'], 0, 40) . '...';
                                        $val['movie_thname'] = iconv_substr($val['movie_thname'], 0, 20, "UTF-8") . '...';
                                    }
                                    ?>


                                    <div class="title-in">
                                        <h2>
                                            <a onclick="goViewCl('<?= $val['movie_id'] ?>', '<?= $url_name ?>', '<?= $val['movie_type'] ?>')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $val['movie_sound'] . " " . $val['movie_quality'] . " (" . $val['movie_year'] . ") " ?></a>
                                            <!-- <a onclick="goViewCl('<?= $val['movie_id'] ?>', '<?= $url_name ?>', '<?= $val['movie_type'] ?>')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $val['movie_thname'] ?></a> -->
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
                                    <div class="title-name-out">
                                        <h2>
                                            <a onclick="goViewCl('<?= $val['movie_id'] ?>', '<?= $url_name ?>', '<?= $val['movie_type'] ?>')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $val['movie_thname'] ?></a>
                                        </h2>
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
                    if (!empty($video_random['list'])) {
                    ?>
                        <button id="movie-loadmore">SEE MORE CLIPS</button>

                    <?php
                    }
                    ?>
                </div>




            </div>
        </div>


    </div>
</div>
<!-- <section id="movie-footer" class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a class="navbar-brand" href="#"><img class="logo" src="<?= base_url() . '/public/logo/Logo-Anime-8k-1.png' ?> "></a>
        <p><strong>ดูหนังฟรี</strong> โหลดไวแบบไม่มีสะดุดภาพคมชัดระดับ HD FullHD 4k ครบทุกเรื่องทุกรสดูได้ทุกที่ทุกเวลาทั้งบนมือถือ แท็บเล็ต เครื่องคอมพิวเตอร์ ระบบปฏิบัติการ Android และ IOS ดูอนิเมะใหม่ให้รับชมอีกมากมาย สามารถรับชมฟรีได้ทุกที่ทุกเวลาตลอด 24 ชั่วโมง</p>
      </div>
    </div>
  </div>
</section> -->
<script>
    $(document).ready(function() {

        var track_click = 2; //track user click on "load more" button, righ now it is 0 click
        var total_pages = '<?= $video_random['total_page'] ?>';

        if (track_click >= total_pages) {
            $("#movie-loadmore").hide(0);
        }
        $("#movie-loadmore").click(function(e) { //user clicks on button
            if (track_click <= total_pages) //user click number is still less than total pages
            {
                //post page number and load returned data into result element
                $.get('<?php echo $url_loadmore ?>', {
                    'page': track_click
                }, function(data) {
                    console.log(data);
                    $("#list-movie").append(data); //append data received from server
                    track_click++; //user click increment on load button
                }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
                    alert(thrownError); //alert with HTTP error
                });
            }
            if (track_click >= total_pages) {
                $("#movie-loadmore").hide(0);
            }
        });
    });
</script>
</script>