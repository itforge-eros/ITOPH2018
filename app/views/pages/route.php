<?php require APPROOT . '/views/inc/header.php'; ?>
<section class="route-container">
    <div class="row">
        <div class="col-lg-12">
                <article class="maps">
                    <div id="map"></div>
                </article>
        </div>
    </div>
    <div class="container">
        <section class="page-container">
            <div class="row">
                <div class="col-lg-12">
                    <article class="route">

                        <div class="card-columns">
                            <a href="" data-modal="#arlmodal" class="modal__trigger">
                                <div id="arl" class="card p-3">
                                    <h2>รถไฟฟ้า AIRPORT RAIL LINK</h2>
                                </div>
                            </a>
                            <a href="" data-modal="#trainmodal" class="modal__trigger">
                                <div id="train" class="card p-3">
                                    <h2>รถไฟ</h2>
                                </div>
                            </a>
                            <a href="" data-modal="#localmodal" class="modal__trigger">
                                <div id="local" class="card p-3">
                                    <h2>รถสองแถว</h2>
                                </div>
                            </a>
                            <a href="" data-modal="#expressvanmodal" class="modal__trigger">
                                <div id="expressvan" class="card p-3">
                                    <h2>รถตู้ด่วนพิเศษ</h2>
                                </div>
                            </a>
                            <a href="" data-modal="#vanmodal" class="modal__trigger">
                                <div id="van" class="card p-3">
                                    <h2>รถตู้ประจำทาง</h2>
                                </div>
                            </a>
                            <a href="" data-modal="#carmodal" class="modal__trigger">
                                <div id="car" class="card p-3">
                                    <h2>รถยนต์</h2>
                                </div>
                            </a>
                            <a href="" data-modal="#sabtmodal" class="modal__trigger">
                                <div id="sabt" class="card p-3">
                                    <h2>SUVARNABHUMI AIRPORT BUS TERMINAL</h2>
                                </div>
                            </a>
                            <a href="" data-modal="#busmodal" class="modal__trigger">
                                <div id="bus" class="card p-3">
                                    <h2>รถเมล์</h2>
                                </div>
                            </a>
                        </div>

                    </article>
                </div>
            </div>
        </section>
    </div>
</section>

<div id="arlmodal" class="modal modal__bg" role="dialog" aria-hidden="true">
    <div class="modal__dialog">
        <div class="modal__content">
            <h1>AIRPORT RAIL LINK</h1>
            <p>จากสถานีพญาไท ผ่านสถานีราชปรารภ มักกะสัน รามคำแหง หัวหมาก บ้านทับช้าง ใช้เวลาประมาณ 30 นาทีลงที่สถานีลาดกระบังแล้วต่อรถไฟที่สถานีรถไฟลาดกระบัง หรือต่อรถสองแถวสาย 777 (เขียนว่าเข้าเทคโนฯ)</p>      
            <a href="" class="modal__close modal-close">
                <svg class="" viewBox="0 0 24 24"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path d="M0 0h24v24h-24z" fill="none"/></svg>
            </a>
        </div>
    </div>
</div>
<div id="trainmodal" class="modal modal__bg" role="dialog" aria-hidden="true">
    <div class="modal__dialog">
        <div class="modal__content">
            <h1>รถไฟ</h1>
            <p>สายตะวันออก : สถานีต้นทางกรุงเทพฯ(หัวลำโพง) ผ่าน ยมราช อุรุพงศ์ พญาไท มักกะสัน อโศก คลองตัน สุขุมวิท71 หัวหมาก บ้านทับช้าง ซอยวัดลานบุญ ลาดกระบัง พระจอมเกล้า ปลายทางสถานีหัวตะเข้</p>
            <ul>
                <li>ขบวนจากกรุงเทพ (หัวลำโพง)</li>
                <ul>
                    <li>379 (กรุงเทพ - หัวตะเข้) ถึงหัวตะเข้ 05.10 *วันจันทร์-ศุกร์</li>
                    <li>275 (กรุงเทพ - อรัญประเทศ) ถึงหัวตะเข้ 07.02</li>
                    <li>283 (กรุงเทพ - บ้านพลูตาหลวง) ถึงหัวตะเข้ 08.13 *วันจันทร์-ศุกร์</li>
                    <li>285 (กรุงเทพ - ชุมทางฉะเชิงเทรา) ถึงหัวตะเข้ 08.13 *วันเสาร์-อาทิตย์-วันหยุดพิเศษ</li>
                    <li>281 (กรุงเทพ - กบินทร์บุรี) ถึงหัวตะเข้ 08.56 </li>
                </ul>
                <li>ขบวนออกจากชุมทางฉะเชิงเทรา</li>
                <ul>
                    <li>384 (ชุมทางฉะเชิงเทรา – กรุงเทพ) ถึงหัวตะเข้ 06.25 *วันจันทร์-ศุกร์</li>
                    <li>372 (ปราจีนบุรี – กรุงเทพ) ถึงหัวตะเข้ 06.59</li>
                    <li>388 (ชุมทางฉะเชิงเทรา – กรุงเทพ) ถึงหัวตะเข้ 07.34</li>
                    <li>278 (กบินทร์บุรี – กรุงเทพ) ถึงหัวตะเข้ 09.09</li>
                </ul>
                <li>ขบวนออกจากรังสิต</li>
                <ul>
                    <li>376 (รังสิต - หัวตะเข้) ออกรังสิต 05.35 ถึงหัวตะเข้ 07.40 *รถขบวนนี้ไม่เข้าหัวลำโพง และไม่มีบริการวันเสาร์ อาทิตย์ วันหยุดพิเศษ</li>
                </ul>
            </ul>  
            <a href="" class="modal__close modal-close">
                <svg class="" viewBox="0 0 24 24"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path d="M0 0h24v24h-24z" fill="none"/></svg>
            </a>
        </div>
    </div>
</div>
<div id="localmodal" class="modal modal__bg" role="dialog" aria-hidden="true">
    <div class="modal__dialog">
        <div class="modal__content">
            <h1>รถสองแถว</h1>
            <ul>
                <li>วงกลมวนซ้ายแอร์พอร์ตลิงค์ 7 บาท 5.00-22.00 15 นาที</li>
                <li>หัวตะเข้ – เทคโน – หนองจอก	7 บาท 5.00-22.00 10 นาที</li>
                <li>หัวตะเข้ – เทคโน – ฮอนด้า 7 บาท 5.00-22.00 10 นาที</li>
                <li>วัดราชโกษา – เทคโน – ร่มเกล้า 7 บาท 5.00-20.00 20 นาที</li>
                <li>หัวตะเข้ – เทคโน – วัดอุทัย 10 บาท 5.00-17.30 40 นาที</li>
                <li>หัวตะเข้ – เทคโน – บึงบัว 10 บาท 5.00-17.30 30 นาที</li>
            </ul>  
            <a href="" class="modal__close modal-close">
                <svg class="" viewBox="0 0 24 24"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path d="M0 0h24v24h-24z" fill="none"/></svg>
            </a>
        </div>
    </div>
</div>
<div id="expressvanmodal" class="modal modal__bg" role="dialog" aria-hidden="true">
    <div class="modal__dialog">
        <div class="modal__content">
            <h1>รถตู้ด่วนพิเศษ</h1>
            <ul>
                <li>หมอชิตใหม่ - พระจอมเกล้าลาดกระบัง (ทางด่วน)</li>
                <li>อนุสาวรีย์ชัย - พระจอมเกล้าลาดกระบัง (ทางด่วน)</li>
                <li>รังสิตฟิวเจอร์ - พระจอมเกล้าลาดกระบัง (ทางด่วน)</li>
                <li>แฮปปี้แลนด์ - พระจอมเกล้าลาดกระบัง (ทางด่วน)</li>
            </ul>  
            <a href="" class="modal__close modal-close">
                <svg class="" viewBox="0 0 24 24"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path d="M0 0h24v24h-24z" fill="none"/></svg>
            </a>
        </div>
    </div>
</div>
<div id="vanmodal" class="modal modal__bg" role="dialog" aria-hidden="true">
    <div class="modal__dialog">
        <div class="modal__content">
            <h1>รถตู้ประจำทาง</h1>
            <ul>
                <li>หัวตะเข้ – หนองจอก</li>
                <li>มีนบุรี – บึงบัว – หัวตะเข้</li>
                <li>มีนบุรี – นิคม – หัวตะเข้</li>
                <li>หัวตะเข้ – ซีคอนสแควร์*</li>
                <li>หัวตะเข้ – บางพลี*</li>
            </ul>
            <p>*ลงที่หน้าตลาดหัวตะเข้ รถไม่ได้เข้ามาภายในสถาบัน</p>
            <a href="" class="modal__close modal-close">
                <svg class="" viewBox="0 0 24 24"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path d="M0 0h24v24h-24z" fill="none"/></svg>
            </a>
        </div>
    </div>
</div>
<div id="carmodal" class="modal modal__bg" role="dialog" aria-hidden="true">
    <div class="modal__dialog">
        <div class="modal__content">
            <h1>รถยนต์ส่วนบุคคล</h1>
            <ul>
                <li><strong>เริ่มจากเส้นทางถนนศรีนครินทร์ที่แยกอ่อนนุช</strong> เข้าถนนอ่อนนุช (สุขุมวิท77) ระยะทางประมาณ 16 กม. แยกเข้าถนนฉลองกรุง</li>
                <li><strong>เริ่มจากกรุงเทพฯ</strong> ใช้เส้นทางด่วนพิเศษ กรุงเทพฯ–ชลบุรี (มอเตอร์เวย์)</li>
                <ul>
                    <li>ออกจากมอเตอร์เวย์ที่จุดกลับรถใต้สะพานเล็กๆ ให้เลยทางออกสุวรรณภูมิมาก่อน</li>
                    <li>ให้สังเกตอาคารเรียนคณะเทคโนโลยีสารสนเทศ จะเป็นอาคารเรียน 6 ชั้นติดกระจก หากเลยมาแล้วให้ชิดซ้าย ใต้สะพาน เลยไปประมาณ 800 เมตร จะมีทางออกเล็กๆ ให้กลับรถ จากนั้นเลี้ยวขวา เมื่อถึงใต้สะพานแล้วให้เลี้ยวซ้าย</li>
                </ul>
                <li><strong>เริ่มจากชลบุรี</strong>ใช้เส้นทางด่วนพิเศษ กรุงเทพฯ–ชลบุรี(มอเตอร์เวย์) ออกจากมอเตอร์เวย์ที่ทางเข้าสนามบินสุวรรณภูมิ ทางเบี่ยงถนนคู่ขนานมอเตอร์เวย์ ถนนฉลองกรุง</li>
            </ul>  
            <a href="" class="modal__close modal-close">
                <svg class="" viewBox="0 0 24 24"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path d="M0 0h24v24h-24z" fill="none"/></svg>
            </a>
        </div>
    </div>
</div>
<div id="sabtmodal" class="modal modal__bg" role="dialog" aria-hidden="true">
    <div class="modal__dialog">
        <div class="modal__content">
            <h1>SUVARNABHUMI AIRPORT BUS TERMINAL</h1>
            <p>รถตู้</p>
            <ul>
                <li>549 มีนบุรี – สุวรรณภูมิ</li>
                <li>552 อ่อนนุช - สุวรรณภูมิ</li>
                <li>552A ปากน้ำ – สุวรรณภูมิ (เฉพาะเช้า-เย็น)</li>
                <li>554 สะพานใหม่ – สุวรรณภูมิ (เฉพาะเช้า-เย็น)</li>
                <li>555 สุวรรณภูมิ - ดอนเมือง</li>
                <li>559 สุวรรณภูมิ – รังสิตฟิวเจอร์</li>
            </ul>
            <p>รถเมล์</p>
            <ul>
                <li>554 รังสิต – สุวรรณภูมิ (ทางด่วนลงรามอินทรา)</li>
                <li>555 รังสิต – สุวรรณภูมิ (ทางด่วนลงดินแดง)</li>
                <li>558 พระราม 2 - สุวรรณภูมิ (ทางด่วนลงสุขสวัสดิ์)</li>
            </ul>  
            <a href="" class="modal__close modal-close">
                <svg class="" viewBox="0 0 24 24"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path d="M0 0h24v24h-24z" fill="none"/></svg>
            </a>
        </div>
    </div>
</div>
<div id="busmodal" class="modal modal__bg" role="dialog" aria-hidden="true">
    <div class="modal__dialog">
        <div class="modal__content">
            <h1>รถเมล์</h1>
            <ul>
                <li>สาย 1013 แฮปปี้แลนด์ - หัวตะเข้ (รถร่วมบริการ) ลงรถตรงข้ามสวนพระนคร จากนั้นต่อรถสองแถวจากหน้าสวนพระนครเข้ามายังสถาบัน</li>
            </ul>
            <a href="" class="modal__close modal-close">
                <svg class="" viewBox="0 0 24 24"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path d="M0 0h24v24h-24z" fill="none"/></svg>
            </a>
        </div>
    </div>
</div>

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

    var Modal = (function() {
        var trigger = $qsa('.modal__trigger'); // what you click to activate the modal
        var modals = $qsa('.modal'); // the entire modal (takes up entire window)
        var modalsbg = $qsa('.modal__bg'); // the entire modal (takes up entire window)
        var content = $qsa('.modal__content'); // the inner content of the modal
        var closers = $qsa('.modal__close'); // an element used to close the modal
        var w = window;
        var isOpen = false;
        var contentDelay = 0; // duration after you click the button and wait for the content to show
        var len = trigger.length;
        // make it easier for yourself by not having to type as much to select an element
        function $qsa(el) {
            return document.querySelectorAll(el);
        }
        var getId = function(event) {
            event.preventDefault();
            var self = this;
            // get the value of the data-modal attribute from the button
            var modalId = self.dataset.modal;
            var len = modalId.length;
            // remove the '#' from the string
            var modalIdTrimmed = modalId.substring(1, len);
            // select the modal we want to activate
            var modal = document.getElementById(modalIdTrimmed);
            // execute function that creates the temporary expanding div
            makeDiv(self, modal);
        };
        var makeDiv = function(self, modal) {
        var fakediv = document.getElementById('modal__temp');
        /**
        * if there isn't a 'fakediv', create one and append it to the button that was
        * clicked. after that execute the function 'moveTrig' which handles the animations.
        */
        if (fakediv === null) {
            var div = document.createElement('div');
            div.id = 'modal__temp';
            self.appendChild(div);
            moveTrig(self, modal, div);
        }
        };
        var moveTrig = function(trig, modal, div) {
        var trigProps = trig.getBoundingClientRect();
        var m = modal;
        var mProps = m.querySelector('.modal__content').getBoundingClientRect();
        var transX, transY, scaleX, scaleY;
        var xc = w.innerWidth / 2;
        var yc = w.innerHeight / 2;
            // if the modal is aligned to the top then move the button to the center-y of the modal instead of the window
        if (m.classList.contains('modal--align-top')) {
            transY = Math.round(mProps.height / 2 + mProps.top - trigProps.top - trigProps.height / 2);
        }
            window.setTimeout(function() {
                window.requestAnimationFrame(function() {
                    open(m, div);
                });
            }, contentDelay);
        };
        var open = function(m, div) {
        if (!isOpen) {
            // select the content inside the modal
            var content = m.querySelector('.modal__content');
            // reveal the modal
            m.classList.add('modal--active');
            // reveal the modal content
            content.classList.add('modal__content--active');
            /**
            * when the modal content is finished transitioning, fadeout the temporary
            * expanding div so when the window resizes it isn't visible ( it doesn't
            * move with the window).
            */
            content.addEventListener('transitionend', hideDiv, false);
            isOpen = true;
        }
        function hideDiv() {
            // fadeout div so that it can't be seen when the window is resized
            div.style.opacity = '0';
            content.removeEventListener('transitionend', hideDiv, false);
        }
        };
        var close = function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            var target = event.target;
            var div = document.getElementById('modal__temp');
            /**
            * make sure the modal__bg or modal__close was clicked, we don't want to be able to click
            * inside the modal and have it close.
            */
            if (isOpen && target.classList.contains('modal__bg') || target.classList.contains('modal__close')) {
                // make the hidden div visible again and remove the transforms so it scales back to its original size
                div.style.opacity = '1';
                div.removeAttribute('style');
                    /**
                    * iterate through the modals and modal contents and triggers to remove their active classes.
                * remove the inline css from the trigger to move it back into its original position.
                    */
                    for (var i = 0; i < len; i++) {
                        modals[i].classList.remove('modal--active');
                        content[i].classList.remove('modal__content--active');
                        trigger[i].style.transform = 'none';
                trigger[i].style.webkitTransform = 'none';
                        trigger[i].classList.remove('modal__trigger--active');
                    }
                // when the temporary div is opacity:1 again, we want to remove it from the dom
                    div.addEventListener('transitionend', removeDiv, false);
                isOpen = false;
            }
            function removeDiv() {
                setTimeout(function() {
                window.requestAnimationFrame(function() {
                    // remove the temp div from the dom with a slight delay so the animation looks good
                    div.remove();
                });
                }, contentDelay);
            }
        };
        var bindActions = function() {
            for (var i = 0; i < len; i++) {
                trigger[i].addEventListener('click', getId, false);
                closers[i].addEventListener('click', close, false);
                modalsbg[i].addEventListener('click', close, false);
            }
        };
        var init = function() {
        bindActions();
        };
        return {
        init: init
        };
    }());
    Modal.init();
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>