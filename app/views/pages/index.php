<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="wrapper">
        <div id="biglogo">
            <img id="logo" class="main-logo" src="<?php echo URLROOT; ?>/assets/img/openhouse-2018-logo.svg">
            <div id="bg-animate">
                <div id="stick01" class="light-stick light-stick--blue"></div>
                <div id="stick02" class="light-stick light-stick--blue"></div>
                <div id="stick03" class="light-stick light-stick--yellow"></div>
                <div id="stick04" class="light-stick light-stick--yellow"></div>
                <div id="bubble01" class="bubble bubble--blue"></div>
            </div>
        </div>
        <div id="main" class="main">
            <section id="infosection">
                <div class="container" id="info">
                    <div>
                        <h1>เปิดมุมมองใหม่ สร้างโอกาสที่มากกว่า</h1>
                        <h2>23 - 25 สิงหาคม 2561</h2>
                        <h2>ตั้งแต่เวลา 9.00 เป็นต้นไป</h2>
                        <p>เปิดบ้านไอทีลาดกระบัง "IT LADKRABANG OPEN HOUSE 2018" กลับมาอีกครั้งกับการเปิดบ้านสร้างมุมมองใหม่ ค้นหาคำตอบในสิ่งที่ชอบ พร้อมด้วยการสร้างโอกาสในการเตรียมตัวสู่ไอทีลาดกระบัง มาพบคำตอบได้ในงานนี้ทั้งสาระและความสนุกจากกิจกรรมมากมาย จัดโดยคณะเทคโนโลยีสารสนเทศ สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง</p>
                        <a href="<?php echo URLROOT; ?>/pages/timetable/" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">กำหนดการ</a>
                        <a href="<?php echo URLROOT;?>/pages/registration/individual/" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">ลงทะเบียนสำหรับผู้เข้าชมงาน</a>
                    </div> 
                </div>
            </section>

            <section id="bebras">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 img-container">
                            <img id="bebras-banner" src="<?php echo URLROOT; ?>/assets/img/bebras-logo.png">
                        </div>
                        <div class="col-lg-6 col-sm-12 info">
                            <h2>Thai Bebras Computational Thinking Challenge 2018</h2>
                            <h6>การแข่งขันทักษะการคิดทางคอมพิวเตอร์ระดับชาติประจำปี 2018</h6>
                            <hr>
                            <p><strong>ครั้งแรกในประเทศไทย</strong> กับการแข่งขันกระบวนการแก้ปัญหาเชิงตรรกะ (Logical problem solving) ออนไลน์ที่ถูกออกแบบสำหรับนักเรียนระดับมัธยมต้นถึงมัธยมปลาย ผู้เข้าแข่งขันไม่จำเป็นต้องมีประสบการณ์เกี่ยวกับวิทยาการคอมพิวเตอร์โดยตรง โดยมีวัตถุประสงค์เพื่อส่งเสริมการเรียน การสอน และ สร้างความตื่นตัวแก่นักเรียนที่สนใจทางด้านวิทยาการคอมพิวเตอร์ </p>
                            <?php //<a href="" class="right" aria-pressed="true">อ่านรายละเอียดและสมัครทดสอบ ></a>?>
                            <a href="#" class="right" aria-pressed="true">เร็ว ๆ นี้ ></a>
                        </div>
                    </div>
                </div>
            </section>
            <section id="seminartrigger" class="seminar">
                <div>
                    <div>
                        <h1>เสวนา</h1>
                    </div>
                    <div>
                        <article id="seminar" class="seminar-card">
                            <h2>เรื่องราวดีๆ ที่ IT ลาดกระบัง</h2>
                            <h3>เรื่อง TCAS กับไอทีเลือดใหม่ เรียนอย่างไรให้ “Success”</h3>
                            <p>การใช้ชีวิตในไอที ลาดกระบัง การเรียน อยู่หอ เรื่องราวดีๆ ที่พี่อยากมาแบ่งบันน้องๆ ทุกคน</p>
                        </article>
                    </div>
                </div>
            </section>
                
            <section id="selectingsection">
                <div class="container">
                    <article class="featured">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <article id="events" class="events">
                                    <h2>กิจกรรม</h2>
                                    <hr>
                                    <div class="scrolling-wrapper">
                                        <?php foreach($data['events'] as $event): ?>
                                            <a id="event<?php echo $event->id; ?>" href="#<?php echo $event->slug; ?>Modal">
                                                <div id="<?php echo $event->slug; ?>" class="scrolling-card">
                                                    <div>
                                                        <img src="<?php echo URLROOT; ?>/assets/img/<?php echo $event->logo_src;?>">
                                                        <h2><?php echo $event->title;?></h2>
                                                        <p><?php echo $event->short_description;?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php foreach($data['events'] as $event): ?>
                                        <!--MODAL-->
                                        <div id="<?php echo $event->slug;?>Modal">
                                            <div class="close-<?php echo $event->slug;?>Modal"> 
                                                <i class="fas fa-times-circle"></i>
                                            </div>
                                                
                                            <div class="modal-content">
                                                <div class="container"><?php echo $event->full_description; ?></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </article>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <article class="competitions">
                                    <h2>การแข่งขัน</h2>
                                    <hr>
                                    <div class="scrolling-wrapper">
                                        <?php foreach($data['competitions'] as $compet): ?>
                                            <a href="<?php echo URLROOT;?>/pages/details/<?php echo $compet->slug;?>">
                                                <div id="<?php echo $compet->slug; ?>" class="scrolling-card">
                                                    <div>
                                                        <img src="<?php echo URLROOT; ?>/assets/img/<?php echo $compet->logo_src;?>">
                                                        <h2><?php echo $compet->title;?></h2>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </article>
                </div>
                <article class="workshops">
                    <div class="container">
                        <h2>เวิร์คชอป</h2>
                        <hr>
                        <div class="row">
                            <?php $workshopCount = 1; foreach($data['workshops'] as $workshop): ?>
                                <?php if($workshopCount >= 3 && $workshopCount % 2 == 1): ?>
                                    </div>
                                    <div class="row">
                                <?php endif; ?>
                                <div class="col-lg-6 col-sm-12">
                                    <a id="workshop<?php echo $workshop->id;?>" href="#<?php echo $workshop->slug;?>Modal">
                                        <div id="<?php echo $workshop->slug; ?>" class="row">
                                        
                                            <div class="col-lg-3 logo">
                                                <img src="<?php echo URLROOT; ?>/assets/img/<?php echo $workshop->logo_src;?>">
                                            </div>
                                            <div class="col-lg-9 info">
                                                <h2><?php echo $workshop->title;?></h2>
                                                <p><?php echo $workshop->short_description;?></p>
                                            </div>
                                        
                                        </div>
                                    </a>
                                </div>
                            <?php $workshopCount += 1; endforeach; ?>
                        <?php if($workshopCount != 3): ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php foreach($data['workshops'] as $workshop): ?>
                        <!--MODAL-->
                        <div id="<?php echo $workshop->slug;?>Modal">
                            <div class="modal-content">
                                <div>
                                    <?php echo $workshop->full_description; ?>
                                </div>
                                <div>
                                    <a href="<?php echo URLROOT; ?>/pages/registration/<?php echo $workshop->slug; ?>/" class="btn">ลงทะเบียนเวิร์คชอป</a>
                                    <a href="#" class="btn close-<?php echo $workshop->slug;?>Modal">ปิด</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </article>

                <article class="rallys standard-section">
                    <div class="container">
                        <h2>กิจกรรมชุมนุมของนักศึกษา</h2>
                        <hr>
                        <div class="scrolling-wrapper">
                            <?php foreach($data['rallys'] as $rally): ?>
                                <a id="rally<?php echo $rally->id;?>" href="#<?php echo $rally->slug;?>Modal">
                                    <div id="<?php echo $rally->slug; ?>" class="scrolling-card">
                                        <div>
                                            <img src="<?php echo URLROOT; ?>/assets/img/<?php echo $rally->logo_src;?>">
                                            <h2><?php echo $rally->title;?></h2>
                                            <p><?php echo $rally->short_description;?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php foreach($data['rallys'] as $rally): ?>
                        <!--MODAL-->
                        <div id="<?php echo $rally->slug;?>Modal">     
                            <div class="modal-content">
                                <div>
                                    <h2><?php echo $rally->title; ?></h2>
                                    <?php echo $rally->full_description; ?>
                                </div>
                                <div>
                                    <a href="#" class="btn close-<?php echo $rally->slug;?>Modal">ปิด</a>
                                </div>
                            </div>                           
                        </div>
                    <?php endforeach; ?>
                </article>

            </section>

            <section class="route-container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>การเดินทาง</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <article class="maps">
                            <div id="map"></div>
                        </article>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="d-flex flex-row">
                            <ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left" role="navigation">
                                <li class="nav-item">
                                    <a href="#metro" class="nav-link active" data-toggle="tab" role="tab" aria-controls="metro"><i class="fas fa-subway"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#train" class="nav-link" data-toggle="tab" role="tab" aria-controls="train"><i class="fas fa-train"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#sontaew" class="nav-link" data-toggle="tab" role="tab" aria-controls="sontaew"><i class="fas fa-bus-alt"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#van" class="nav-link" data-toggle="tab" role="tab" aria-controls="van"><i class="fas fa-shuttle-van"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#car" class="nav-link" data-toggle="tab" role="tab" aria-controls="car"><i class="fas fa-car"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#bus" class="nav-link" data-toggle="tab" role="tab" aria-controls="bus"><i class="fas fa-bus"></i></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="metro" role="tabpanel">
                                    <h1>AIRPORT RAIL LINK</h1>
                                    <p>จากสถานีพญาไท ผ่านสถานีราชปรารภ มักกะสัน รามคำแหง หัวหมาก บ้านทับช้าง ใช้เวลาประมาณ 30 นาทีลงที่สถานีลาดกระบังแล้วต่อรถไฟที่สถานีรถไฟลาดกระบัง หรือต่อรถสองแถวสาย 777 (เขียนว่าเข้าเทคโนฯ)</p>
                                </div>
                                <div class="tab-pane fade" id="train" role="tabpanel">
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
                                </div>
                                <div class="tab-pane fade" id="sontaew" role="tabpanel">
                                    <h1>รถสองแถว</h1>
                                    <ul>
                                        <li>วงกลมวนซ้ายแอร์พอร์ตลิงค์ 7 บาท 5.00-22.00 15 นาที</li>
                                        <li>หัวตะเข้ – เทคโน – หนองจอก	7 บาท 5.00-22.00 10 นาที</li>
                                        <li>หัวตะเข้ – เทคโน – ฮอนด้า 7 บาท 5.00-22.00 10 นาที</li>
                                        <li>วัดราชโกษา – เทคโน – ร่มเกล้า 7 บาท 5.00-20.00 20 นาที</li>
                                        <li>หัวตะเข้ – เทคโน – วัดอุทัย 10 บาท 5.00-17.30 40 นาที</li>
                                        <li>หัวตะเข้ – เทคโน – บึงบัว 10 บาท 5.00-17.30 30 นาที</li>
                                    </ul>  
                                </div>
                                <div class="tab-pane fade" id="van" role="tabpanel">
                                    <h1>รถตู้ด่วนพิเศษ</h1>
                                    <ul>
                                        <li>หมอชิตใหม่ - พระจอมเกล้าลาดกระบัง (ทางด่วน)</li>
                                        <li>อนุสาวรีย์ชัย - พระจอมเกล้าลาดกระบัง (ทางด่วน)</li>
                                        <li>รังสิตฟิวเจอร์ - พระจอมเกล้าลาดกระบัง (ทางด่วน)</li>
                                        <li>แฮปปี้แลนด์ - พระจอมเกล้าลาดกระบัง (ทางด่วน)</li>
                                    </ul>
                                    <h1>รถตู้ประจำทาง</h1>
                                    <ul>
                                        <li>หัวตะเข้ – หนองจอก</li>
                                        <li>มีนบุรี – บึงบัว – หัวตะเข้</li>
                                        <li>มีนบุรี – นิคม – หัวตะเข้</li>
                                        <li>หัวตะเข้ – ซีคอนสแควร์*</li>
                                        <li>หัวตะเข้ – บางพลี*</li>
                                    </ul>
                                    <p>*ลงที่หน้าตลาดหัวตะเข้ รถไม่ได้เข้ามาภายในสถาบัน</p>
                                    <h1>รถตู้ SUVARNABHUMI AIRPORT BUS TERMINAL</h1>
                                    <p></p>
                                    <ul>
                                        <li>549 มีนบุรี – สุวรรณภูมิ</li>
                                        <li>552 อ่อนนุช - สุวรรณภูมิ</li>
                                        <li>552A ปากน้ำ – สุวรรณภูมิ (เฉพาะเช้า-เย็น)</li>
                                        <li>554 สะพานใหม่ – สุวรรณภูมิ (เฉพาะเช้า-เย็น)</li>
                                        <li>555 สุวรรณภูมิ - ดอนเมือง</li>
                                        <li>559 สุวรรณภูมิ – รังสิตฟิวเจอร์</li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="car" role="tabpanel">
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
                                </div>
                                <div class="tab-pane fade" id="bus" role="tabpanel">
                                    <h1>รถเมล์</h1>
                                    <ul>
                                        <li>สาย 1013 แฮปปี้แลนด์ - หัวตะเข้ (รถร่วมบริการ) ลงรถตรงข้ามสวนพระนคร จากนั้นต่อรถสองแถวจากหน้าสวนพระนครเข้ามายังสถาบัน</li>
                                    </ul>
                                    <h1>รถเมล์ SUVARNABHUMI AIRPORT BUS TERMINAL</h1>
                                    <ul>
                                        <li>554 รังสิต – สุวรรณภูมิ (ทางด่วนลงรามอินทรา)</li>
                                        <li>555 รังสิต – สุวรรณภูมิ (ทางด่วนลงดินแดง)</li>
                                        <li>558 พระราม 2 - สุวรรณภูมิ (ทางด่วนลงสุขสวัสดิ์)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                </div>
            </section>

        </div>

    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/gsap/2.0.1/TweenMax.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js"></script>
    <script type="text/javascript" src="<?php echo URLROOT; ?>/assets/js/animatedModal.js"></script>
    <script>

        $("#workshop1").animatedModal({ modalTarget: 'multimediaModal'});
        $("#workshop2").animatedModal({ modalTarget: 'networksModal'});
        $("#workshop3").animatedModal({ modalTarget: 'seModal'});
        $("#workshop4").animatedModal({ modalTarget: 'datascienceModal'});

        $("#event1").animatedModal({ modalTarget: 'tobeitModal'});
        $("#event2").animatedModal({ modalTarget: 'tourModal'});
        $("#event3").animatedModal({ modalTarget: 'cirrModal'});
        $("#event4").animatedModal({ modalTarget: 'exhibitionModal'});

        $("#rally1").animatedModal({ modalTarget: 'itforgeModal'});
        $("#rally2").animatedModal({ modalTarget: 'animeModal'});
        $("#rally3").animatedModal({ modalTarget: 'agapeModal'});
        $("#rally4").animatedModal({ modalTarget: 'fotoModal'});
        $("#rally5").animatedModal({ modalTarget: 'inphonicModal'});

        var controller = new ScrollMagic.Controller();

        if (/Mobi|Android/i.test(navigator.userAgent) || $(window).width() <= 768) {
            var offset20 = 0
            var offset100 = 0
            var offset200 = 0
            var offset300 = 0
        } else {
            var offset20 = 20
            var offset100 = 100
            var offset200 = 200
            var offset300 = 300
        }
        
        var info_fade_in = new ScrollMagic.Scene({tweenChanges: true, offset: offset100})
            .setTween("#infosection", 0.5, {opacity: 1})
            .addTo(controller)

        var at0 = new TimelineMax()
            .add(TweenMax.to("#stick01", 0.5, {width: "100vw", ease: Back.easeOut}), 1)
            .add(TweenMax.to("#bubble01", 0.75, {transform: "matrix(1, 0, 0, 1, 0.512012, 88.331832)", ease: Back.easeOut}), 1)
            .add(TweenMax.to("#stick02", 0.25, {width: "92vw", ease: Back.easeOut}), 1.5)
            .add(TweenMax.to("#stick03", 0.5, {width: "95vw", ease: Back.easeOut}), 1)
            .add(TweenMax.to("#stick04", 0.25, {width: "88vw", ease: Back.easeOut}), 1.5)

        var at200 = new TimelineMax()
            .add(TweenMax.to("#selectingsection", 0.5, {opacity: 1}))

        var at300 = new TimelineMax()
            .add([
                TweenMax.to("#registergeneral", 0.5, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0),
                TweenMax.to("#registercompet", 0.5, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0.1),
                TweenMax.to("#registertest", 0.5, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0.1)
            ])

        var atevents = new TimelineMax()
            .add([
                TweenMax.to("#tobeit", 1, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0),
                TweenMax.to("#tour", 1, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0.25),
                TweenMax.to("#cirr", 1, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0.5),
                TweenMax.to("#exhibition", 1, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0.75),
                TweenMax.to("#security", 1, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0),
                TweenMax.to("#game", 1, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0.25),
                TweenMax.to("#skill", 1, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0.5),
                TweenMax.to("#website", 1, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0.75)
            ])
            .add([
                TweenMax.to("#multimedia", 0.45, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0),
                TweenMax.to("#networks", 0.25, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0),
                TweenMax.to("#se", 0.25, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0),
                TweenMax.to("#datascience", 0.25, {ease: Power4.easeOut, transform: "translateX(0)", opacity: 1}, 0)
            ])
            .add([
                TweenMax.to("#itforge", 0.25, {ease: Power4.easeOut, opacity: 1}, 0),
                TweenMax.to("#anime", 0.25, {ease: Power4.easeOut, opacity: 1}, 0),
                TweenMax.to("#agape", 0.25, {ease: Power4.easeOut, opacity: 1}, 0),
                TweenMax.to("#foto", 0.25, {ease: Power4.easeOut, opacity: 1}, 0),
                TweenMax.to("#inphonic", 0.25, {ease: Power4.easeOut, opacity: 1}, 0),
                TweenMax.to("#movies", 0.25, {ease: Power4.easeOut, opacity: 1}, 0),
            ])
        
        /*var bg_light_stick = new ScrollMagic.Scene({tweenChanges: true, offset: 0})
            .setTween(at0)
            .addTo(controller)*/

        var bebras = new ScrollMagic.Scene({tweenChanges: true, offset: offset300})
            .setTween("#bebras", 0.5, {transform: "scale(1)", ease: Back.easeOut})
            .addTo(controller)

        var registergeneral_card_slide_left = new ScrollMagic.Scene({tweenChanges: true, offset: offset300})
            .setTween(at300)
            .addTo(controller)

        var events_slide = new ScrollMagic.Scene({tweenChanges: true, triggerElement: "#selectingsection"})
            .setTween(atevents)
            .addTo(controller)

        var seminar = new ScrollMagic.Scene({tweenChanges: true, triggerElement: "#seminartrigger"})
            .setTween("#seminar", 0.75, {transform: "scale(1.3)", ease: Back.easeOut})
            .addTo(controller)
        
        $("#biglogo").mousemove(function(e) {
            parallaxIt(e, "#stick01", -100);
            parallaxIt(e, "#stick02", -300);
            parallaxIt(e, "#stick03", -200);
            parallaxIt(e, "#stick04", -460);
            //parallaxIt(e, "#bubble01", -1);
        });

        function parallaxIt(e, target, movement) {
        var $this = $("#biglogo");
        var relX = e.pageX - $this.offset().left;
        var relY = e.pageY - $this.offset().top;

        TweenMax.to(target, 1, {
            x: (relX - $this.width() / 2) / $this.width() * movement,
            y: (relY - $this.height() / 2) / $this.height() * movement
        });
        }

    </script>
<?php require APPROOT . '/views/inc/footer.php'; ?>