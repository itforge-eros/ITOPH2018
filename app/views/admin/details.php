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

<section class="admin-details standard-section">
    <div class="container">
        <div class="col-lg-12">
            <h2><?php echo $h2Text; ?></h2>
            <a href="#" class="btn btn--export"><i class="fas fa-file-export"></i> Export</a>
                <?php if($competition || $workshop): ?>
                    <?php if($competition): ?>
                        <div class="card-columns">
                            <a href="<?php echo URLROOT; ?>/admin/details/individual">
                                <div id="" class="card card--blue p-3">
                                    <p>ความปลอดภัยของระบบคอมพิวเตอร์</p>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/competition">
                                <div id="" class="card card--blue p-3">
                                    <p>กีฬาอิเล็กทรอนิกส์</p>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/workshop">
                                <div id="" class="card card--blue p-3">
                                    <p>แก้ปัญหาเชิงวิเคราะห์</p>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/bebras">
                                <div id="" class="card card--blue p-3">
                                    <p>พัฒนาเว็บไซต์</p>
                                </div>
                            </a>
                        </div>
                <?php else: ?>
                <?php endif; ?>
                    <div class="table-responsive">
                        <table id="competition-table" class="table">
                            <thead>
                                <tr>
                                    <td>
                                        #
                                        <div class="sort-table-arrows">
                                            <a href="javascript:sort(true, 'id', 'competition-table');"><button class="table__button"><i class="fa fa-chevron-down"></i></button></a>
                                            <a href="javascript:sort(false, 'id', 'competition-table');"><button class="table__button"><i class="fa fa-chevron-up"></i></button></a>
                                        </div>
                                    </td>
                                    <td>
                                        ประเภทการแข่งขัน
                                        <div class="sort-table-arrows">
                                            <a href="javascript:sort(true, 'category', 'competition-table');"><button class="table__button"><i class="fa fa-chevron-down"></i></button></a>
                                            <a href="javascript:sort(false, 'category', 'competition-table');"><button class="table__button"><i class="fa fa-chevron-up"></i></button></a>
                                        </div>
                                    </td>
                                    <td>เวลาที่สมัคร</td>
                                    <td>ชื่อทีม</td>
                                    <td>โรงเรียน</td>
                                    <td>Actions</td>
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
                                        }
                                ?>
                                    <tr>
                                        <td data-label="id"><?php echo sprintf("%'.05d", $item->id); ?></td>
                                        <td data-label="category"><?php echo $type; ?></td>
                                        <td data-label="date"><?php echo $item->registration_date; ?></td>
                                        <td data-label="team-name"><?php echo $item->team_name; ?></td>
                                        <td data-label="school"><?php echo $item->candidate01_school; ?></td>
                                        <td>
                                            <a href="<?php echo URLROOT; ?>/admin/delete/<?php echo $item->id; ?>" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                            <a href="#"><i class="far fa-eye"></i></a>
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
                                    <td>#</td>
                                    <td>เวลาที่สมัคร</td>
                                    <td>ชื่อ-นามสกุล</td>
                                    <td>เลขประจำตัวประชาชน</td>
                                    <td>อายุ</td>
                                    <td>ชั้น</td>
                                    <td>โรงเรียน</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($data['registrationDataModel'] as $item): 
                                ?>
                                    <tr>
                                        <td><?php echo sprintf("%'.05d", $item->id); ?></td>
                                        <td><?php echo $item->registration_date; ?></td>
                                        <td><?php echo $item->candidate01_name; ?></td>
                                        <td><?php echo id_crypt($item->candidate01_id, 'd'); ?></td>
                                        <td><?php echo $item->candidate01_age; ?></td>
                                        <td><?php echo $item->candidate01_grade; ?></td>
                                        <td><?php echo $item->candidate01_school; ?></td>
                                        <td><a href="<?php echo URLROOT; ?>/admin/delete/<?php echo $item->id; ?>" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a></td>
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
	function sort(ascending, columnClassName, tableId) {
		var tbody = document.getElementById(tableId).getElementsByTagName(
				"tbody")[0];
		var rows = tbody.getElementsByTagName("tr");
		var unsorted = true;
		while (unsorted) {
			unsorted = false
			for (var r = 0; r < rows.length - 1; r++) {
				var row = rows[r];
				var nextRow = rows[r + 1];
				var value = row.getElementsByClassName(columnClassName)[0].innerHTML;
				var nextValue = nextRow.getElementsByClassName(columnClassName)[0].innerHTML;
				value = value.replace(',', ''); // in case a comma is used in float number
				nextValue = nextValue.replace(',', '');
				if (!isNaN(value)) {
					value = parseFloat(value);
					nextValue = parseFloat(nextValue);
				}
				if (ascending ? value > nextValue : value < nextValue) {
					tbody.insertBefore(nextRow, row);
					unsorted = true;
				}
			}
		}
	};
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>
