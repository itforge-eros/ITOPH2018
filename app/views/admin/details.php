<?php 
require APPROOT . '/views/inc/header.php';
$registrationType = $data['registrationType'];
$competition = false;
$workshop = false;
$individual = false;
$bebras = false;

switch($registrationType){
    case "competition":
    case "security":
    case "game":
    case "skill":
    case "website":
        $h2Text = "รายชื่อผู้ลงทะเบียนแข่งขัน";
        $competition = true;
        break;
    case "workshop":
    case "multimedia":
    case "se":
    case "networks":
    case "datascience":
        $h2Text = "รายชื่อผู้ลงทะเบียนเวิร์คชอป";
        $workshop = true;
        break;
    case "individual":
        $h2Text = "รายชื่อผู้ลงทะเบียนเข้าชมงาน Openhouse";
        $individual = true;
        break;
    case "bebras":
        $h2Text = "รายชื่อผู้ลงทะเบียนทดสอบ BEBRAS";
        $bebras = true;
        break;
}
?>

<section class="admin-details standard-section">
    <div class="container">
        <div class="col-lg-12">
            <a href="<?php echo URLROOT; ?>/admin" class="btn btn--export"><i class="fas fa-angle-left"></i> หน้าหลัก Admin</a> <a href="<?php echo URLROOT; ?>/admin/export/<?php echo $registrationType; ?>" class="btn btn--export"><i class="fas fa-file-export"></i> Export ตารางนี้</a>
            <hr>
            <h2><?php echo $h2Text; ?></h2>
                <?php if($competition || $workshop): ?>
                    <?php if($competition): ?>
                        <div class="card-columns card-columns4">
                            <a href="<?php echo URLROOT; ?>/admin/details/security">
                                <div id="" class="card card--blue p-3">
                                    <h2><?php echo $data['securityCount']; ?></h2>
                                    <p>ความปลอดภัยของระบบคอมพิวเตอร์</p>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/game">
                                <div id="" class="card card--blue p-3">
                                    <h2><?php echo $data['gameCount']; ?></h2>
                                    <p>กีฬาอิเล็กทรอนิกส์</p>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/skill">
                                <div id="" class="card card--blue p-3">
                                    <h2><?php echo $data['skillCount']; ?></h2>
                                    <p>แก้ปัญหาเชิงวิเคราะห์</p>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/website">
                                <div id="" class="card card--blue p-3">
                                    <h2><?php echo $data['websiteCount']; ?></h2>
                                    <p>พัฒนาเว็บไซต์</p>
                                </div>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="card-columns card-columns4">
                            <a href="<?php echo URLROOT; ?>/admin/details/multimedia">
                                <div id="" class="card card--blue p-3">
                                    <h2><?php echo $data['multiCount']; ?></h2>
                                    <p>สายลับจับผิดภาพ</p>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/networks">
                                <div id="" class="card card--blue p-3">
                                    <h2><?php echo $data['networksCount']; ?></h2>
                                    <p>เชื่อมต่อทุกสิ่งด้วย IoT</p>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/se">
                                <div id="" class="card card--blue p-3">
                                    <h2><?php echo $data['seCount']; ?></h2>
                                    <p>สร้างหุ่นยนต์ให้อัจฉริยะ</p>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/datascience">
                                <div id="" class="card card--blue p-3">
                                    <h2><?php echo $data['datascienceCount']; ?></h2>
                                    <p>แกะรอยโปเกม่อน</p>
                                </div>
                            </a>
                        </div>
                <?php endif; ?>
                    <div class="table-responsive">
                        <table id="competition-table" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>เวลาที่สมัคร</th>
                                    <th>ประเภท</th>
                                    <th>รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($data['registrationDataModel'] as $item): 
                                        $type = '';
                                        switch($item->category) {
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
                                        } ?>
                                    <tr>
                                        <td data-label="id"><a href="<?php echo URLROOT; ?>/admin/delete/<?php echo $item->id; ?>" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a> <?php echo sprintf("%'.05d", $item->id); ?></td>
                                        <td data-label="date"><?php echo date_format(date_create($item->registration_date), 'y/m/d H:i:s'); ?></td>
                                        <td data-label="category"><?php echo $type; ?></td>
                                        <td data-label="details">
                                        ​<?php if(isset($item->team_name)){
                                            echo "<h2>ชื่อทีม: $item->team_name </h2>";
                                            if($item->category != 'game'){echo "<p><strong>".$item->candidate01_school."</strong></p>"; }
                                            echo "<strong>สมาชิก</strong>";
                                        } ?>
                                            <?php 
                                                for($i=1; $i<=6; $i++){
                                                    $namefield = "candidate0".$i."_name";
                                                    if(!isset($item->$namefield)){break;}
                                                    $idfield = "candidate0".$i."_id";
                                                    $schoolfield = "candidate0".$i."_school";
                                                    $gradefield = "candidate0".$i."_grade";
                                                    $phonefield = "candidate0".$i."_phone";
                                                    $emailfield = "candidate0".$i."_email";

                                                    if($item->$gradefield == 98){$grade = "ระดับชั้น ปวช.";}
                                                    else if($item->$gradefield == 99){$grade = "ระดับชั้น ปวส.";}
                                                    else {$grade = "ระดับชั้นมัธยมศึกษาปีที่ ".$item->$gradefield;}

                                                    if(!empty($item->$namefield)){echo "<p><strong>$i. ".$item->$namefield."</strong><span class='citizenid' id='id-".$item->id."000".$i."'>".$item->$idfield.'</span> <a class="id-viewer-btn" onclick="idToggle('.$item->id.'000'.$i.')"><i class="fas fa-eye"></i></a></p>';}
                                                    if($item->category == 'game'){echo "<p>".$item->$schoolfield."<br>".$grade."</p>";}
                                                    else{echo "<p>".$grade."</p>";}
                                                    echo "<i class='fas fa-envelope'></i> ".$item->$emailfield.", <i class='fas fa-phone'></i> ".$item->$phonefield."<br>";
                                                }
                                                if(isset($item->teacher_name)){echo "<hr><strong>อาจารย์ผู้ดูแล:</strong> <br>".$item->teacher_name."<br><i class='fas fa-envelope'></i> ".$item->teacher_email.", <i class='fas fa-phone'></i> ".$item->teacher_phone;}
                                                if(isset($item->additional_note)){echo "หมายเหตุ: ".$item->additional_note;}
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>เวลาที่สมัคร</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th class="center">เลขประจำตัวประชาชน</th>
                                    <th class="center">อายุ</th>
                                    <th class="center">ระดับชั้น</th>
                                    <th>โรงเรียน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($data['registrationDataModel'] as $item): 
                                ?>
                                    <tr>
                                        <td data-label="id"><a href="<?php echo URLROOT; ?>/admin/delete/<?php echo $item->id; ?>" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a> <?php echo sprintf("%'.05d", $item->id); ?></td>
                                        <td data-label="date"><?php echo date_format(date_create($item->registration_date), 'y/m/d H:i:s'); ?></td>
                                        <td><?php echo $item->candidate01_name; ?></td>
                                        <td class="center" data-label="citizen-id"><span class="citizenid" id="id-<?php echo $item->id; ?>"><?php echo $item->candidate01_id; ?></span> <a class="id-viewer-btn" onclick="idToggle(<?php echo $item->id; ?>)"><i class="fas fa-eye"></i></a></td>
                                        <?php
                                            if($item->candidate01_grade==98){
                                                $item->candidate01_grade = "ปวช.";
                                            } else if($item->candidate01_grade==99){
                                                $item->candidate01_grade = "ปวส.";
                                            }
                                            else {
                                                $item->candidate01_grade = "ม. $item->candidate01_grade";
                                            }
                                        ?>
                                        <td class="center" data-label="age"><?php echo $item->candidate01_age; ?></td>
                                        <td class="center" data-label="grade"><?php echo $item->candidate01_grade; ?></td>
                                        <td data-label="school"><?php echo $item->candidate01_school; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
        </div>
    </div>
</section>

<script>
	function idToggle(id) {
        var elementID = "id-"+id;
        var userId = document.getElementById(elementID);
        if (!userId.style.display || userId.style.display == "none") {
            userId.style.display = "inline";
        } else {
            userId.style.display = "none";
        }
    }
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>
