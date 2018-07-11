<?php require APPROOT . '/views/inc/header.php'; ?>
<section class="contact-container">
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <article class="maps">
                <div id="map"></div>
            </article>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <article class="location">
                    <h2>ที่อยู่</h2>
                    <p>คณะเทคโนโลยีสารสนเทศ สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง เลขที่ 1 ซอยฉลองกรุง 1 แขวงลาดกระบัง เขตลาดกระบัง กรุงเทพฯ 10520 </p>
                </article>
            </div>
            <div class="col-lg-4 col-sm-12">
                <article class="contact">
                    <h2>สอบถามข้อมูลทั่วไป</h2>
                    <h5>โทรศัพท์</h5>
                        <p><i class="fas fa-phone"></i> 0-2723-4936 - 45</p>
                    <h5>อีเมล</h5>
                        <p><i class="fas fa-envelope"></i> <a href="mailto:openhouse@it.kmtil.ac.th">openhouse@it.kmtil.ac.th</a></p>
                    <h5>โซเชียลเน็ตเวิร์ก</h5>
                        <div class="social-wrapper">
                            <a href="https://www.facebook.com/ITLadkrabangOpenhouse" target="_blank"><i class="fab fa-facebook-square"></i></a>
                            <a href="https://twitter.com/ITKMITL" target="_blank"><i class="fab fa-twitter-square"></i></a>
                        </div>
                </article>
            </div>
        </div>
    </div>
</section>
<script>
      var map;
      function initMap() {

        var myLatLng = {lat: 13.7310664, lng: 100.7809616};

        var map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 16
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'KMITL'
        });

      }
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpm6EyB8FfCsb_btqZAeLtueLtGHk8YSg&callback=initMap" async defer></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>