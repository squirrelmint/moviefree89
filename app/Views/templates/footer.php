  <!-- menu mobile -->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <?php
              foreach ($list_category as $val) {
                if ( !empty($cate_id) && $cate_id == $val['category_id']) {
                  $active = 'active';
                }else{
                  $active = '';
                }
              ?>
                <a class="dropdown-item <?= $active ?>" onclick="goCate('<?= ($val['category_id']) ?>','<?= $val['category_name'] ?>')"><?= $val['category_name'] ?></a>
              <?php
              } ?>
  </div>
  <!-- Footer -->
  <footer class="footer">
  <section id="movie-footer" class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- <img class="logo" src="<?= $path_setting . $setting['setting_logo'] ?> "> -->
        <img class="logo" src="<?= base_url() . '/public/logo.png' ?> ">
        <p><strong>ดูหนังฟรี</strong> โหลดไวแบบไม่มีสะดุดภาพคมชัดระดับ HD FullHD 4k ครบทุกเรื่องทุกรสดูได้ทุกที่ทุกเวลาทั้งบนมือถือ แท็บเล็ต เครื่องคอมพิวเตอร์ ระบบปฏิบัติการ Android และ IOS ดูอนิเมะใหม่ให้รับชมอีกมากมาย สามารถรับชมฟรีได้ทุกที่ทุกเวลาตลอด 24 ชั่วโมง</p>
      </div>
    </div>
  </div>
</section>

<nav class="navbar navbar-expand-lg navbar-light bg-light-header" style="height: 3rem;">

</nav>

  </footer>
  <script>
    $(document).ready(function() {
      var mySwiper = new Swiper('#HomeSlide', {
        loop: true,
        speed: 800,
        spaceBetween: 100,
        effect: 'fade',
        // Slide auto play
        autoplay: {
          delay: 5000,
        },
        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      })
    });
    function goView(id, name, type) {
      countView(id);
      var url = '';
      if(type=='se'){
        url = "<?=base_url()?>/series/" + id + '/' + decodeURI(name) ;
      }else{
        url = "<?=base_url()?>/video/" + id + '/' + decodeURI(name) ;
      }
      window.open(url, '_blank');
    }
    function goEP(id, name, index, epname) {
      countView(id);
      window.location.href = "<?=base_url()?>/series/" + id + '/' + decodeURI(name) + '/' + index + '/' + decodeURI(epname) ;
    }
  
    function countView(id) {
        // alert(id);
        var base_url = '<?= base_url() ?>';
        $.ajax({
          url: base_url + "/countview/" + id,
          method: "GET",
          async: true,
          success: function(response) {
            console.log(response); // server response
          }
        });
      }
    
    function goCate(id, name) {
      window.location.href = "<?=base_url()?>/category/" + id + '/' + name ;
    }
    /* Set the width of the side navigation to 0 */
    /* Set the width of the side navigation to 250px */
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
      document.body.style.overflow = 'hidden'
      document.getElementById("overlay").style.display = "block";
    }
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
      document.body.style.overflow = 'auto'
      document.getElementById("overlay").style.display = "none";
    }
    
  </script>
  </body>
  </html>