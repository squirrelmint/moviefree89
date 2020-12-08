<div class="container" style="padding: 1rem;">
    <div class="row">
        <div class="col-sm-2">
            <h2 class="center-des-1">
                หมวดหมู่
            </h2>
            <ul class="list-group">
                <?php
                if (!empty($list_category)) {
                    foreach ($list_category as $val) {
                        $cateurl = urlencode(str_replace(' ', '-', $val['category_name']));
                ?>
                        <li class="list-group-item"><a href="<?= base_url('/av/category/' . $val['category_id'] . '/' . $cateurl) ?>" style="color:white;"><?= $val['category_name'] ?></a></li>
                <?php
                    }
                }
                ?>
            </ul>

            
        </div>


        <div class="col-sm-8">

            <h2 class="center-des-1">
                <?= $cate_name ?>
            </h2>

            <div id="movie-list" class="row">
                <?php if (!empty($list['list'])) { ?>
                    <ul id="list-movie" class="list-movie">
                        <?PHP
                        //echo "<pre>"; print_r($newmovie_1);die;
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
                                    <a onclick="goViewAv('<?= $val['movie_id'] ?>', '<?= $url_name ?>', '<?= $val['movie_type'] ?>')" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
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
                                $movie_thname = substr($val['movie_thname'],0,7);
                                ?>


                                <div class="title-in">
                                    <h2>
                                        <a onclick="goViewAv('<?= $val['movie_id'] ?>', '<?= $url_name ?>', '<?= $val['movie_type'] ?>')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $movie_thname ?></a>
                                        <!-- <a onclick="goViewAv('<?= $val['movie_id'] ?>', '<?= $url_name ?>', '<?= $val['movie_type'] ?>')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $val['movie_thname'] ?></a> -->
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
                                        <a onclick="goViewAv('<?= $val['movie_id'] ?>', '<?= $url_name ?>', '<?= $val['movie_type'] ?>')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $val['movie_thname'] ?></a>
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

            </div>
            <!-- Pagination -->
            <div class="box">
                <div class="navigation">
                    <ul>
                        <div class="topbar-filter ">
                            <div class="pagination2" style="text-align: center;">
                                <?= pagination($paginate['page'], $paginate['total_page']); ?>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
            <!-- /Pagination -->

        </div>
        <div class="col-sm-2">
            <h2 class="center-des-1">
                ประเภทหนัง
            </h2>
            <ul class="list-group">

                <li class="list-group-item"><a href="" style="color:white;">ALL JAV </a></li>
                <li class="list-group-item"><a href="" style="color:white;">SUB THAI</a></li>

            </ul>
            <div class="movie-social">
                <a><i class="fab fa-facebook-square"></i></a>
                <a><i class="fab fa-twitter"></i></a>
            </div>

            <h2 class="center-des-1 search-movie">
                ค้นหาหนัง
            </h2>
            <ul class="list-group">
                <li class="list-group-item">
                    <form id="movie-formsearch1">
                        <div class="input-group">
                            <?php
                            if (!empty($keyword)) {
                                $value = $keyword;
                            } else {
                                $value = '';
                            }
                            ?>
                            <input id="movie-search1" class="movie-search ml-auto" placeholder="Search..." value="<?php echo $value ?>" autocomplete="off">
                            <button type="submit" id="searchsubmit"> <i class="fas fa-search" aria-hidden="true"></i> </button>

                        </div>
                    </form>
                </li>
            </ul>
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
    $(document).ready(function() {
        ""
        var track_click = 2; //track user click on "load more" button, righ now it is 0 click
        var total_pages = '<?= $list['total_page'] ?>';
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