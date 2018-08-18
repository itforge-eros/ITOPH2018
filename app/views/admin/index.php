<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
    <div class="container">
        <?php flash('page_message'); ?>

        <section class="admin standard-section">
            <!-- <div class="row">
                <div class="col-lg-12">
                    <h1>Admin Panel</h1>
                </div>
            </div> -->
            <section class="checkin">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>ยอดลงทะเบียนหน้างาน</h1>
                    </div>
                </div>
                <div class="row day-column">
                    <div class="col-lg-4 col-sm-12">
                        <h3>23 สิงหาคม</h3>
                        <h2><?php echo count($data["checkins23"]); ?></h2>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <h3>24 สิงหาคม</h3>
                        <h2><?php echo count($data["checkins24"]); ?></h2>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <h3>25 สิงหาคม</h3>
                        <h2><?php echo count($data["checkins25"]); ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-columns card-columns2 card-columns-sm-1">
                            <a href="<?php echo URLROOT; ?>/admin/registration">
                                <div id="" class="card card--yellow p-3">
                                    <div>
                                        <p>Check-in</p>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/allcheckin">
                                <div id="" class="card card--blue p-3">
                                    <div>
                                        <p>ดูรายชื่อลงทะเบียนทั้งหมด</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-lg-12">
                    <h2>ลงทะเบียนล่าสุด</h2>
                    <hr>
                </div>
            </div>
            <div class="row">

                    <div class="table-responsive latest-checkin">
                        <table>
                            <tr>
                                <th>เมื่อ</th>
                                <th>ชื่อ</th>
                                <th>ประเภท</th>
                            </tr>
                            <?php foreach($data["recentCheckins"] as $recent): ?>
                            <tr>
                                <td>
                                    <?php 
                                        $checkedInTime = $recent[1];
                                        $now = new DateTime();
                                        echo $checkedInTime;
                                        $checkedInTime = new DateTime($recent[1]);
                                        $now = new DateTime();
                                        $interval = $now->diff($checkedInTime);
                                        $days = $interval->format('%a');
                                        $hours = $interval->format('%h');
                                        $minutes = $interval->format('%i');
                                        $seconds = $interval->format('%s');
                                        if($days > 0) {
                                            $elasped = " ($days วัน $hours ชั่วโมงที่แล้ว)";
                                        } else if($hours > 0) {
                                            $elasped = " ($hours ชั่วโมง $minutes นาทีที่แล้ว)";
                                        } else if($minutes > 0){
                                            $elasped = " ($minutes นาทีที่แล้ว)";
                                        } else {
                                            $elasped = " ($seconds วินาทีที่แล้ว)";
                                        }
                                        echo $elasped;
                                    ?>
                                </td>
                                <td>
                                    <?php if(isset($recent[0][0]->team_name)):
                                        echo "ทีม ".$recent[0][0]->team_name;
                                    else:
                                        echo $recent[0][0]->candidate01_name;
                                    endif; ?> 
                                </td>
                                <td>
                                    <?php
                                    switch($recent[0][0]->category) {
                                        case "security":
                                            $type = "ความปลอดภัยของระบบคอมพิวเตอร์";
                                            break;
                                        case "game":
                                            $type = "กีฬาอิเล็กทรอนิกส์";
                                            break;
                                        case "skill":
                                            $type = "แก้ปัญหาเชิงวิเคราะห์";
                                            break;
                                        case "website":
                                            $type = "พัฒนาเว็บไซต์";
                                            break;
                                        case "multimedia":
                                            $type = "สายลับจับผิดภาพ";
                                            break;
                                        case "networks":
                                            $type = "เชื่อมต่อทุกสิ่งด้วย IoT";
                                            break;
                                        case "se":
                                            $type = "สร้างหุ่นยนต์ให้อัจฉริยะ";
                                            break;
                                        case "datascience":
                                            $type = "แกะรอยโปเกม่อน";
                                            break;
                                        case "individual":
                                            $type = "เข้าชมงาน";
                                            break;
                                        case "bebras":
                                            $type = "Bebras";
                                            break;
                                    }
                                    
                                    echo $type;?> 
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                
            </div>
            <section class="admin-tools">

                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="scrolling-wrapper">
                            <article class="admin-competitions">
                                <h2>การแข่งขัน</h2> <?php /*<a href="<?php echo URLROOT; ?>/admin/add" class="btn"> <i class="fas fa-plus"></i>เพิ่มการแข่งขัน</a> */ ?>
                                <hr>
                                <div>    
                                    <?php foreach($data['competitions'] as $competition): ?>
                                        <p><a href="<?php echo URLROOT; ?>/pages/details/<?php echo $competition->slug; ?>"><?php echo $competition->title; ?></a></p>
                                    <?php endforeach;?>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="card-columns card-columns2">
                            <a href="<?php echo URLROOT; ?>/admin/details/individual">
                                <div id="" class="card card--yellow p-3">
                                    <div>
                                        <h2><?php echo $data['individualCount']; ?></h2>
                                        <p>ผู้สมัครเข้าชมงาน</p>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/competition">
                                <div id="" class="card card--blue p-3">
                                    <div>
                                        <h2><?php echo $data['competitionCount']; ?></h2>
                                        <p>ทีมสมัครแข่งขัน</p>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/workshop">
                                <div id="" class="card card--blue p-3">
                                    <div>
                                        <h2><?php echo $data['workshopCount']; ?></h2>
                                        <p>ผู้สมัครเวิร์คชอป</p>
                                    </div>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/bebras">
                                <div id="" class="card card--blue p-3">
                                    <div>
                                        <h2><?php echo $data['bebrasCount']; ?></h2>
                                        <p>ผู้สมัครเข้าทดสอบ BEBRAS</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </section>
            
        
    </div>

</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>