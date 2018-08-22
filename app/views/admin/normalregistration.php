<?php require APPROOT . '/views/inc/header.php';?>

<div class="row">
    <div class="container">
        <?php flash('page_message'); ?>
        <section class="standard-section">
            <div class="row">
                <div class="col-lg-12">
                    <h1>ระบบลงทะเบียนหน้างาน</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form action="<?php echo URLROOT; ?>/admin/normalregistration" id="registration-form" method="post">
                        <div class="form-group">
                            <label for="team_name">ชื่อ/ชื่อทีม</label>
                            <input type="text" name="team_name" class="form-control form-control-lg" value="">
                        </div>
                        <div class="row">
                            <input type="submit" value="ค้นหา" class="btn btn-registration btn-block">
                        </div>
                    </form>
                    <hr>
                </div>
            </div>
            <div class="row standard-section">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="normal-registration-table" class="table">
                                <?php 
                                if($data['searchResult']=='start'){
                                }
                                else if(!$data['searchResult']){
                                    echo "<p class='center'>ไม่พบข้อมูล</p>";
                                } else {
                                    echo "<tr>
                                        <th>ชื่อ</th>
                                        <th></th>
                                    </tr>";
                                    foreach($data['searchResult'] as $item): ?>
                                    <tr>
                                        <td><?php 
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
                                                case "individual":
                                                    $type = "เข้าชมงาน";
                                                    break;
                                                case "bebras":
                                                    $type = "Bebras";
                                                    break;
                                                case "walkin":
                                                    $type = "Walk-in";
                                                    break;
                                                case "special":
                                                    $type = "โรงเรียนเข้าชมงาน";
                                                    break;
                                            }
                                            if(isset($item->team_name)){
                                                echo $item->team_name." ($type)";
                                            } else {
                                                echo $item->candidate01_name." ($item->candidate01_id) $type";
                                            }
                                        ?></td>
                                        <td><a class="black" href="<?php echo URLROOT;?>/admin/checkin/<?php echo $item->id; ?>"><i class="fas fa-user-check"></i> ลงทะเบียน</a></td>
                                    </tr>
                                <?php endforeach; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>