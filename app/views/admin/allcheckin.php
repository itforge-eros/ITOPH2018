<?php 
require APPROOT . '/views/inc/header.php';
$individualCheckin = $data["individualCheckin"];
$competitionCheckin = $data["competitionCheckin"];
$workshopCheckin = $data["workshopCheckin"];
$bebrasCheckin = $data["bebrasCheckin"];
?>

<section class="admin-details standard-section">
    <div class="container">
        <div class="col-lg-12">
            <a href="<?php echo URLROOT; ?>/admin" class="btn btn--export"><i class="fas fa-angle-left"></i> หน้าหลัก Admin</a> <a href="<?php echo URLROOT; ?>/admin/export/<?php echo $registrationType; ?>" class="btn btn--export disabled" disabled><i class="fas fa-file-export"></i> Export ตารางนี้</a>
            <hr>
            
            <div class="worko-tabs">
  
                <input class="state" type="radio" title="tab-one" name="tabs-state" id="tab-one" checked />
                <input class="state" type="radio" title="tab-two" name="tabs-state" id="tab-two" />
                <input class="state" type="radio" title="tab-three" name="tabs-state" id="tab-three" />
                <input class="state" type="radio" title="tab-four" name="tabs-state" id="tab-four" />

                <div class="tabs flex-tabs">
                    <div class="tabs-container">
                        <label for="tab-one" id="tab-one-label" class="tab">เข้าชมงาน</label>
                        <label for="tab-two" id="tab-two-label" class="tab">แข่งขัน</label>
                        <label for="tab-three" id="tab-three-label" class="tab">เวิร์คชอป</label>
                        <label for="tab-four" id="tab-four-label" class="tab">BEBRAS</label>
                    </div>

                    <div id="tab-one-panel" class="panel active">
                    <?php 
                        if(!$individualCheckin) {
                            echo "<p class='center'>ยังไม่มีผู้ลงทะเบียนเข้าชมงาน</p>";
                        } else { ?>
                            <div class="table-responsive">
                                <table id="individual-table" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>เวลาที่ Check-in</th>
                                            <th>ชื่อ</th>
                                            <th class="center">เลขประจำตัวประชาชน</th>
                                            <th class="center">อายุ</th>
                                            <th class="center">ระดับชั้น</th>
                                            <th>โรงเรียน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($individualCheckin as $item): ?>
                                            <tr>
                                                <td data-label="id"><?php echo sprintf("%'.05d", $item->id); ?></td>
                                                <td data-label="date"><?php echo date_format(date_create($item->checkin_time), 'y/m/d H:i:s'); ?></td>
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
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        <?php }
                    ?>
                    </div>
                    <div id="tab-two-panel" class="panel">
                    <?php 
                        if(!$competitionCheckin) {
                            echo "<p class='center'>ยังไม่มีผู้ลงทะเบียนแข่งขัน</p>";
                        } else { ?>
                            <div class="table-responsive">
                                <table id="individual-table" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>เวลาที่ Check-in</th>
                                            <th>ประเภท</th>
                                            <th>ชื่อทีม</th>
                                        </tr>
                                    </thead>
                                    <?php foreach($competitionCheckin as $item): 
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
                                        }
                                        ?>
                                    <tr>
                                        <td data-label="id"><?php echo sprintf("%'.05d", $item->id); ?></td>
                                        <td data-label="date"><?php echo date_format(date_create($item->checkin_time), 'y/m/d H:i:s'); ?></td>
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
                                    <?php endforeach;?>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        <?php }
                    ?>
                    </div>
                    <div id="tab-three-panel" class="panel">
                    <?php 
                        if(!$workshopCheckin) {
                            echo "<p class='center'>ยังไม่มีผู้ลงทะเบียนเวิร์คชอป</p>";
                        } else { ?>
                            <div class="table-responsive">
                                <table id="individual-table" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>เวลาที่ Check-in</th>
                                            <th>ประเภท</th>
                                            <th>ชื่อทีม</th>
                                        </tr>
                                    </thead>
                                    <?php foreach($workshopCheckin as $item): 
                                        $type = '';
                                        switch($item->category) {
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
                                        }
                                        ?>
                                    <tr>
                                        <td data-label="id"><?php echo sprintf("%'.05d", $item->id); ?></td>
                                        <td data-label="date"><?php echo date_format(date_create($item->checkin_time), 'y/m/d H:i:s'); ?></td>
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
                                    <?php endforeach;
                                    ?>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        <?php }
                    ?>
                    </div>
                    <div id="tab-four-panel" class="panel">
                    <?php 
                        if(!$bebrasCheckin) {
                            echo "<p class='center'>ยังไม่มีผู้ลงทะเบียน BEBRAS</p>";
                        } else { ?>
                            <div class="table-responsive">
                                <table id="bebras-table" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>เวลาที่ Check-in</th>
                                            <th>ชื่อ</th>
                                            <th class="center">เลขประจำตัวประชาชน</th>
                                            <th class="center">อายุ</th>
                                            <th class="center">ระดับชั้น</th>
                                            <th>โรงเรียน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($bebrasCheckin as $item): ?>
                                            <tr>
                                                <td data-label="id"><?php echo sprintf("%'.05d", $item->id); ?></td>
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
                        <?php } ?>
                    </div>

                </div>

            </div>

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
