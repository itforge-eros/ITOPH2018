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
        <div class="row">
            <div class="d-flex flex-row mt-2">
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
                        <h1>รถตู้จาก SUVARNABHUMI AIRPORT BUS TERMINAL</h1>
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
                        <h1>รถเมล์จาก SUVARNABHUMI AIRPORT BUS TERMINAL</h1>
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
<?php require APPROOT . '/views/inc/footer.php'; ?>