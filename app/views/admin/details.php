<?php 
require APPROOT . '/views/inc/header.php';
$registrationType = $data['registrationType'];
$competition = false;
$workshop = false;
$individual = false;
$bebras = false;

switch($registrationType){
    case "competition":
        $h2Text = "รายชื่อผู้ลงทะเบียนแข่งขัน";
        $competition = true;
        break;
    case "workshop":
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

<section class="standard-section">
    <div class="container">
        <div class="col-lg-12">
            <h2><?php echo $h2Text; ?></h2>
                <?php if($competition): ?>
                    <div class="card-columns">
                        <a href="<?php echo URLROOT; ?>/admin/details/individual">
                            <div id="getRegisters" class="card p-3">
                                <p>ความปลอดภัยของระบบคอมพิวเตอร์</p>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT; ?>/admin/details/competition">
                            <div id="getCompetitionRegisters" class="card p-3">
                                <p>กีฬาอิเล็กทรอนิกส์</p>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT; ?>/admin/details/workshop">
                            <div id="getCompetitionRegisters" class="card p-3">
                                <p>แก้ปัญหาเชิงวิเคราะห์</p>
                            </div>
                        </a>
                        <a href="<?php echo URLROOT; ?>/admin/details/bebras">
                            <div id="getTestRegisters" class="card p-3">
                                <p>พัฒนาเว็บไซต์</p>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>ประเภทการแข่งขัน</td>
                            <td>เวลาที่สมัคร</td>
                            <td>ชื่อทีม</td>
                            <td>โรงเรียน</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($data['registrationDataModel'] as $item): 
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
                                <td><?php echo sprintf("%'.05d", $item->id); ?></td>
                                <td><?php echo $type; ?></td>
                                <td><?php echo $item->registration_date; ?></td>
                                <td><?php echo $item->team_name; ?></td>
                                <td><?php echo $item->candidate01_school; ?></td>
                                <td>Actions</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
