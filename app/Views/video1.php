<div class="container" style="padding: 1rem;">
    <div class="row">
        <div class="col-sm-2">
            <h2 class="center-des-1">
                ประเภทหนัง
            </h2>
            <ul class="list-group">
                <li class="list-group-item"><a class="color-genres" href="<?php echo base_url('/category/7/' . urlencode('หนังบู๊')); ?>" alt="" title="">Action(แอคชั่น)</a></li>
                <li class="list-group-item"><a class="color-genres" href="<?php echo base_url('/genres/40/' . urlencode('หนังผจญภัย')); ?>" alt="" title="">Adventure(ผจญภัย)</a></li>
                <li class="list-group-item"><a class="color-genres" href="<?php echo base_url('/genres/41/' . urlencode('หนังสงคราม')); ?>" alt="" title="">War(สงคราม)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/category/44/' . urlencode('หนังตลก')); ?>" alt="" title="">Comady(ตลก)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/category/46/' . urlencode('หนังดราม่า')); ?>" alt="" title="">Drama(ชีวิต)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/genres/44/' . urlencode('หนังวิทยาศาสตร์')); ?>" alt="" title="">Sci-fi(วิทยาศาสตร์)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/genres/45/' . urlencode('หนังครอบครัว')); ?>" alt="" title="">Family(ครอบครัว)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/genres/46/' . urlencode('หนังระทึกขวัญ')); ?>" alt="" title="">Thiller(ระทึกขวัญ)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/category/50/' . urlencode('หนังสยองขวัญ')); ?>" alt="" title="">Horror(สยองขวัญ)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/category/45/' . urlencode('หนังอาชยากรรม')); ?>" alt="" title="">Crime(อาชญากรรม)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/genres/49/' . urlencode('หนังสารคดี')); ?>" alt="" title="">Documentaries(สารคดี)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/genres/50/' . urlencode('หนังอีโรติก')); ?>" alt="" title="">Erotic(อีโรติก)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/genres/51/' . urlencode('หนังเทพนิยาย')); ?>" alt="" title="">Fantasy(เทพนิยาย)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/genres/52/' . urlencode('หนังแนวเพลง')); ?>" alt="" title="">Music(เพลง)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/genres/53/' . urlencode('หนังกีฬา')); ?>" alt="" title="">Sport(กีฬา)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/genres/54/' . urlencode('หนังโรแมนติก')); ?>" alt="" title="">Romance(โรแมนติก)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/genres/55/' . urlencode('หนังประวัติศาสตร์')); ?>" alt="" title="">History(ประวัติศาสตร์)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/genres/56/' . urlencode('หนังชีวประวัติ')); ?>" alt="" title="">Biography(ชีวประวัติ)</a></li>
                <li class="list-group-item"> <a class="color-genres" href="<?php echo base_url('/genres/57/' . urlencode('หนังคาวบอย')); ?>" alt="" title="">Westren(คาวบอย)</a></li>
            </ul>
            <h2 class="center-des-1 search-movie">
                ค้นหาหนัง
            </h2>
            <ul class="list-group">
                <li class="list-group-item">
                    <form role="search" method="get" id="formsearch">
                        <div class="input-group">
                            <input class="form-control size-search" type="text" value="" placeholder="ค้นหาหนัง..." id="search">
                            <button type="submit" id="searchsubmit"> <i class="fas fa-search" aria-hidden="true"></i> </button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
        <div class="col-sm-8">
            <h2 class="center-des-1">
                ดูหนังดัง แนะนำหนังใหม่
            </h2>
            <div class="col-sm-12">
                <iframe id="player" class="player iframe-video" src="<?= base_url('player/' . $videodata['movie_id'] . '/' . $index) ?>" scrolling="no" frameborder="0" allowfullscreen="yes"></iframe>
            </div>
            <div id="movie-player">
                <h1 class="movie-title"><?= $videodata['movie_thname'] ?> </h1>
                <div class="movie-header">
                    <div class="movie-trailer">
                        <?php
                        $yb = explode('?v=', $videodata['movie_preview']);
                        if (count($yb) > 1) {
                            $urlyb = "https://www.youtube.com/embed/" . $yb[1];
                        } else {
                            $urlyb = "https://www.youtube.com/embed/" . $yb[0];
                        }
                        ?>
                        <iframe src="<?= $urlyb ?>" frameborder="0" allowfullscreen=""></iframe>
                    </div>
                    <?php if (substr($videodata['movie_picture'], 0, 4) == 'http') {

                        $movie_picture = $videodata['movie_picture'];
                    } else {

                        $movie_picture = $path_thumbnail . $videodata['movie_picture'];
                    }

                    $url_name = urlencode(str_replace(' ', '-', $videodata['movie_thname']))

                    ?>
                    <div class="movie-thumbnail">
                        <img src="<?php echo $videodata['movie_picture']; ?>" alt="<?= $videodata['movie_thname'] ?>" title="<?= $videodata['movie_thname'] ?>">
                    </div>
                </div>
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
                    หนังแนะนำ
                </h2>
                <div id="movie-list" class="row">

                    <?php if (!empty($video_random)) { ?>
                        <ul id="list-movie" class="list-movie">
                            <?PHP
                            //echo "<pre>"; print_r($newmovie_1);die;
                            foreach ($video_random as $val) {
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
                                            <a onclick="goView('<?= $val['movie_id'] ?>', '<?= $url_name ?>', '<?= $val['movie_type'] ?>')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $val['movie_sound'] . " " . $val['movie_quality'] . " (" . $val['movie_year'] . ") " ?></a>
                                            <!-- <a onclick="goView('<?= $val['movie_id'] ?>', '<?= $url_name ?>', '<?= $val['movie_type'] ?>')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $val['movie_thname'] ?></a> -->
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
                                            <a onclick="goView('<?= $val['movie_id'] ?>', '<?= $url_name ?>', '<?= $val['movie_type'] ?>')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $val['movie_thname'] ?></a>
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
                    // if (!empty($list['list'])) {
                    ?>
                    <!-- <button id="movie-loadmore">NEXT</button> -->
                    <?php
                    // }
                    ?>
                </div>

            </div>
        </div>

        <div class="col-sm-2">
            <h2 class="center-des-1">
                หมวดหมู่
            </h2>
            <ul class="list-group">
                <?php foreach ($list_category as $val) { ?>
                    <li class="list-group-item"><a style="color:white;"><?= $val['category_name'] ?></a></li>
                <?php } ?>
            </ul>
            <div class="movie-social">
                <a><i class="fab fa-facebook-square"></i></a>
                <a><i class="fab fa-twitter"></i></a>
            </div>
            <h2 class="center-des-1">
                ปีหนัง
            </h2>
            <div class="row">
                <div class="col-sm-12">
                    <ul class="list-group">
                        <?php foreach ($listyear as $val) {
                            if ($val['movie_year'] > '1988') {
                        ?>
                                <li class="list-group-item" style="width: 100%;float: left;">
                                    <a class="color-genres" href="<?php echo base_url('/page/year/' . $val['movie_year']); ?>"><?php echo $val['movie_year']; ?>
                                </li>
                        <?php }
                        } ?>
                    </ul>
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
    window.onload = function() {
        var swiper = new Swiper('#Nextpopular', {
            speed: 800,
            slidesPerView: 1,
            slidesPerGroup: 1,
            loopFillGroupWithBlank: true,
            spaceBetween: 10,
            // mousewheel: true,
            freeMode: true,
            initialSlide: '1',
            pagination: {
                el: '.swiper-pagination',
                dynamicBullets: true,
                clickable: true,
                renderBullet: function(index, className) {
                    return '<span class="' + className + '">' + (index + 1) + '</span>';
                },
            },
            // Navigation arrows
            navigation: {
                nextEl: '.button-next-Nextpopular',
                prevEl: '.button-prev-Nextpopular',
            },
            breakpoints: {
                320: {
                    slidesPerView: 2,
                    slidesPerGroup: 2,
                    spaceBetween: 20
                },
                // when window width is >= 480px
                480: {
                    slidesPerView: 2,
                    slidesPerGroup: 2,
                    spaceBetween: 30
                },
                768: {
                    slidesPerView: 3,
                    slidesPerGroup: 3,
                    spaceBetween: 30
                },
                968: {
                    slidesPerView: 4,
                    slidesPerGroup: 4,
                    spaceBetween: 40
                },
                1200: {
                    slidesPerView: 5,
                    slidesPerGroup: 5,
                    spaceBetween: 50
                }
            },
        });
        var swiper = new Swiper('#Nextnew', {
            speed: 800,
            slidesPerView: 1,
            slidesPerGroup: 1,
            loopFillGroupWithBlank: true,
            spaceBetween: 10,
            // mousewheel: true,
            freeMode: true,
            initialSlide: '1',
            pagination: {
                el: '.swiper-pagination',
                dynamicBullets: true,
                clickable: true,
                renderBullet: function(index, className) {
                    return '<span class="' + className + '">' + (index + 1) + '</span>';
                },
            },
            // Navigation arrows
            navigation: {
                nextEl: '.button-next-Nextnew',
                prevEl: '.button-prev-Nextnew',
            },
            breakpoints: {
                320: {
                    slidesPerView: 2,
                    slidesPerGroup: 2,
                    spaceBetween: 20
                },
                // when window width is >= 480px
                480: {
                    slidesPerView: 2,
                    slidesPerGroup: 2,
                    spaceBetween: 30
                },
                768: {
                    slidesPerView: 3,
                    slidesPerGroup: 3,
                    spaceBetween: 30
                },
                968: {
                    slidesPerView: 4,
                    slidesPerGroup: 4,
                    spaceBetween: 40
                },
                1200: {
                    slidesPerView: 5,
                    slidesPerGroup: 5,
                    spaceBetween: 50
                }
            },
        });
        <?php foreach ($get_list_video_bycate as $val_cate) { ?>
            var swiper = new Swiper('#next<?php echo $val_cate['list'][0]['category_id'] ?>', {
                speed: 800,
                slidesPerView: 1,
                slidesPerGroup: 1,
                loopFillGroupWithBlank: true,
                spaceBetween: 10,
                // mousewheel: true,
                freeMode: true,
                initialSlide: '1',
                pagination: {
                    el: '.swiper-pagination',
                    dynamicBullets: true,
                    clickable: true,
                    renderBullet: function(index, className) {
                        return '<span class="' + className + '">' + (index + 1) + '</span>';
                    },
                },
                // Navigation arrows
                navigation: {
                    nextEl: '.button-next-next<?php echo $val_cate['list'][0]['category_id'] ?>',
                    prevEl: '.button-prev-next<?php echo $val_cate['list'][0]['category_id'] ?>',
                },
                breakpoints: {
                    320: {
                        slidesPerView: 2,
                        slidesPerGroup: 2,
                        spaceBetween: 20
                    },
                    // when window width is >= 480px
                    480: {
                        slidesPerView: 2,
                        slidesPerGroup: 2,
                        spaceBetween: 30
                    },
                    768: {
                        slidesPerView: 3,
                        slidesPerGroup: 3,
                        spaceBetween: 30
                    },
                    968: {
                        slidesPerView: 4,
                        slidesPerGroup: 4,
                        spaceBetween: 40
                    },
                    1200: {
                        slidesPerView: 5,
                        slidesPerGroup: 5,
                        spaceBetween: 50
                    }
                },
            });
        <?php } ?>
    };
</script>