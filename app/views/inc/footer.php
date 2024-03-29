        <div class="sponsors">
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <img src="<?php echo URLROOT; ?>/assets/img/logo-sym.svg">
                        <h2>คณะเทคโนโลยีสารสนเทศ</h2>
                        <h5>สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง</h5>
                        <p>เลขที่ 1 ซอยฉลองกรุง 1 แขวงลาดกระบัง เขตลาดกระบัง กรุงเทพฯ 10520 </p>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="contact-bar">
                            <div class="phone">
                                <div class="ico-tab"><i class="fas fa-phone"></i></div>
                                <div class="text-tab">
                                    <h5>โทรศัพท์</h5>
                                    <p>0-2723-4936 - 45</p>
                                </div>
                            </div>
                            <div class="email">
                                <div class="ico-tab"><i class="fas fa-envelope"></i></div>
                                <div class="text-tab">
                                    <h5>อีเมล</h5>
                                    <p><a href="mailto:openhouse@it.kmitl.ac.th">openhouse@it.kmitl.ac.th</a></p>
                                </div>
                            </div>
                            <div class="social">
                                <div class="text-tab">
                                    <a href="https://www.facebook.com/ITLadkrabangOpenhouse" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://twitter.com/ITKMITL" target="_blank"><i class="fab fa-twitter"></i></a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <hr>
                    <div class="col-lg-12"><span class="text-muted">©2018 Faculty of Information Technology, KMITL</span></div>
                </div>
            </div>
        </footer>
        <script>
            var map;
            function initMap() {
                var myLatLng = {lat: 13.7310664, lng: 100.7809616};
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: myLatLng,
                    zoom: 15
                });
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    title: 'KMITL'
                });
            }

            jQuery(document).ready( function($) {
 
                // Disable scroll when focused on a number input.
                $('form').on('focus', 'input[type=number]', function(e) {
                    $(this).on('wheel', function(e) {
                        e.preventDefault();
                    });
                });

                // Restore scroll on number inputs.
                $('form').on('blur', 'input[type=number]', function(e) {
                    $(this).off('wheel');
                });

                // Disable up and down keys.
                $('form').on('keydown', 'input[type=number]', function(e) {
                    if ( e.which == 38 || e.which == 40 )
                        e.preventDefault();
                });
            
            });
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpm6EyB8FfCsb_btqZAeLtueLtGHk8YSg&callback=initMap" async defer></script>
        <script src="https://unpkg.com/scroll-hint@latest/js/scroll-hint.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script>
           new ScrollHint('.scrolling-wrapper', { i18n: { scrollable: 'เลื่อน' } });
           new ScrollHint('.table-responsive', { i18n: { scrollable: 'เลื่อน' } });
        </script>
    </body>
</html>