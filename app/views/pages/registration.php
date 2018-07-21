<?php
require APPROOT . '/views/inc/header.php';

$competition = false;
$workshop = false;
$bebras = false;
$individual = false;
if(!isset($data['registrationDataModel'])){
    $registrationType = $data['registrationType'];
    if($registrationType == "bebras"){
        $bebras = true;
        $pageTitle = "สมัครเข้าทดสอบการแข่งขันทักษะการคิดทางคอมพิวเตอร์ระดับชาติประจำปี 2018";
        $registrationTitle = "(BEBRAS)";
        $maxCandidate = 1;
        $slug = 'bebras';
    }else{
        $individual = true;
        $pageTitle = "ลงทะเบียนเข้าชมงาน IT Openhouse 2018";
        $registrationTitle = "";
        $maxCandidate = 1;
        $slug = 'individual';
    }    
    
}else{
    $registrationTitle = $data['registrationDataModel']->title;
    $slug = $data['registrationDataModel']->slug;

    if($slug == 'security' || $slug == 'game' || $slug == 'skill' || $slug == 'website'){
        $competition = true;
        $pageTitle = "สมัครเข้าแข่งขัน";
    } else {
        $workshop = true;
        $pageTitle = "สมัครเข้าร่วม Workshop";
    }

    switch ($slug) {
        case "individual":
        case "multimedia":
        case "se":
        case "networks":
        case "datascience":
            $maxCandidate = 1;
            break;
        case "security":
        case "website":
            $maxCandidate = 2;
            break;
        case "skill":
            $maxCandidate = 3;
            break;
        case "game":
            $maxCandidate = 6;
            break;
    }
}

if($workshop):
    if($data['registratorsCount'] > 20 && $data['registratorsCount'] <= 25){
        $pageTitle = "สมัครเข้าร่วม Workshop (สำรอง)";
    }
    if($data['registratorsCount'] > 25){ ?>
        <section class="standard-section">
            <div class="container">
                <section class="page-container registration">
                    <div class="row">
                        <div class="col-lg-12">
                            <header class="page-header">
                                <div>
                                    <h1><?php echo "ขออภัย ขณะนี้มีผู้สมัครเข้าร่วม Workshop รายการ ".$registrationTitle." ครบจำนวนแล้ว"; ?></h1>
                                </div>
                            </header>
                        </div>
                    </div>
                </section>
            </div>
        </section>
<?php
    exit(0);
    }
endif;
?>

<section class="standard-section">
    <div class="container">
        <section class="page-container registration">
            <div class="row">
                <div class="col-lg-12">
                    <header class="page-header">
                        <div>
                            <h1><?php echo $pageTitle; ?></h1>
                            <h2><?php echo $registrationTitle; ?></h2>
                        </div>
                    </header>
                </div>
                <div class="col-lg-12">
                    <article>
                        <form action="<?php echo URLROOT; ?>/pages/registration/<?php echo $slug; ?>" method="post">
                            <!-- TEAM INFO -->
                            <?php if($competition):?>
                                <div class="form-group">
                                    <label for="team_name">ชื่อทีม<sup>*</sup></label>
                                    <input type="text" name="team_name" class="form-control form-control-lg <?php echo (!empty($data['team_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['team_name']; ?>">
                                    <span class="invalid-feedback"><?php echo $data['team_name_err']; ?></span>
                                </div>
                            <?php endif; ?>
                            <!-- SCHOOL -->
                            <?php if($competition && $slug != 'game'):?>
                                <div class="form-group">
                                    <label for="school_name">ชื่อสถานศึกษา<sup>*</sup></label>
                                    <input type="text" name="school_name" class="form-control form-control-lg <?php echo (!empty($data['school_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['school_name']; ?>">
                                    <span class="invalid-feedback"><?php echo $data['school_name_err']; ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if($competition && $slug == 'game'):?>
                                <div class="team-type">
                                    <h3>ประเภทการสมัคร</h3>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="teamtype" id="teamtype_freestyle" value="freestyle">
                                        <label class="form-check-label" for="teamtype_freestyle">สมัครแบบทีมอิสระ</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="teamtype" id="teamtype_school" value="school" checked="checked">
                                        <label class="form-check-label" for="teamtype_school">สมัครในนามโรงเรียน</label>
                                    </div>
                                </div>
                                
                                <script>
                                    $("#teacher-info-group").hide('slow');
                                    $('input[type="radio"]').click(function(){
                                            if($(this).attr("value")=="school"){
                                                $("#teacher-info-group").show('slow');
                                            }
                                            else{
                                                $("#teacher-info-group").hide('slow');

                                            }        
                                        });
                                    $('input[type="radio"]').trigger('click');
                                </script>
                            <?php endif; ?>

                            <div class="info-wrapper">
                            
                            <?php for($i=1; $i<=$maxCandidate; $i++): ?>
                            <!-- Candidate #<?php echo $i; ?>-->
                                <?php if($competition){
                                    $h3Text = "ข้อมูลสมาชิกคนที่ $i";
                                    $nameInputText = "ชื่อ-นามสกุล สมาชิกคนที่ $i";
                                } else {
                                    $h3Text = "ข้อมูลผู้สมัคร";
                                    $nameInputText = "ชื่อ-นามสกุล";
                                } ?>
                                <h3><?php echo $h3Text; ?></h3>
                                <div class="info-group">
                                    <div class="form-group">
                                        <label for="candidate0<?php echo $i; ?>_name"><?php echo $nameInputText; ?><?php if($slug == "skill" && $i == 3): ?><?php else: ?><sup>*</sup></label><?php endif; ?>
                                        <input type="text" name="candidate0<?php echo $i; ?>_name" class="form-control form-control-lg <?php echo (!empty($data['candidate0'.$i.'_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['candidate0'.$i.'_name']; ?>">
                                        <span class="invalid-feedback"><?php echo $data['candidate0'.$i.'_name_err']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="candidate0<?php echo $i; ?>_id">หมายเลขประจำตัวประชาชน<?php if($slug == "skill"  && $i == 3): ?><?php else: ?><sup>*</sup></label><?php endif; ?></label>
                                        <input type="number" name="candidate0<?php echo $i; ?>_id" class="form-control form-control-lg <?php echo (!empty($data['candidate0'.$i.'_id_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['candidate0'.$i.'_id']; ?>">
                                        <span class="invalid-feedback"><?php echo $data['candidate0'.$i.'_id_err']; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="candidate0<?php echo $i; ?>_age">อายุ<?php if($slug == "skill" && $i == 3): ?><?php else: ?><sup>*</sup></label><?php endif; ?></label>
                                                <input type="number" name="candidate0<?php echo $i; ?>_age" class="form-control form-control-lg <?php echo (!empty($data['candidate0'.$i.'_age_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['candidate0'.$i.'_age']; ?>">
                                                <span class="invalid-feedback"><?php echo $data['candidate0'.$i.'_age_err']; ?></span>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="candidate0<?php echo $i; ?>_grade">ระดับชั้น<?php if($slug == "skill" && $i == 3): ?><?php else: ?><sup>*</sup></label><?php endif; ?></label>
                                                <select class="form-control form-control-lg" name="candidate0<?php echo $i; ?>_grade">
                                                    <option value="4">มัธยมศึกษาปีที่ 4</option>
                                                    <option value="5">มัธยมศึกษาปีที่ 5</option>
                                                    <option value="6">มัธยมศึกษาปีที่ 6</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($slug == 'game' || $slug == 'bebras' || $slug == 'individual' || $slug == 'multimedia' || $slug == 'se' || $slug == 'networks' || $slug == 'datascience'):?>
                                        <div class="form-group">
                                            <label for="candidate0<?php echo $i; ?>_school">ชื่อสถานศึกษา<sup>*</sup></label>
                                            <input type="text" name="candidate0<?php echo $i; ?>_school" class="form-control form-control-lg <?php echo (!empty($data['candidate0'.$i.'_school_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['candidate0'.$i.'_school']; ?>">
                                            <span class="invalid-feedback"><?php echo $data['candidate0'.$i.'_school_err']; ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label for="candidate0<?php echo $i; ?>_phone">เบอร์โทรศัพท์<?php if(($slug == "skill" || $slug == "website")  && $i >= 2): ?><?php else: ?><sup>*</sup></label><?php endif; ?></label>
                                                <input type="tel" name="candidate0<?php echo $i; ?>_phone" class="form-control form-control-lg <?php echo (!empty($data['candidate0'.$i.'_phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['candidate0'.$i.'_phone']; ?>">
                                                <span class="invalid-feedback"><?php echo $data['candidate0'.$i.'_phone_err']; ?></span>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="candidate0<?php echo $i; ?>_email">อีเมล<?php if(($slug == "skill" || $slug == "website")  && $i >= 2): ?><?php else: ?><sup>*</sup></label><?php endif; ?></label>
                                                <input type="email" name="candidate0<?php echo $i; ?>_email" class="form-control form-control-lg <?php echo (!empty($data['candidate0'.$i.'_email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['candidate0'.$i.'_email']; ?>">
                                                <span class="invalid-feedback"><?php echo $data['candidate0'.$i.'_email_err']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor;?>
                            </div>

                            <?php 
                            if($competition):?>
                                <!-- Teacher -->
                                <div id="teacher-info-group">
                                    <h3>ข้อมูลอาจารย์ที่ปรึกษา</h3>
                                    <div class="info-group" id="teacher">
                                        <div class="form-group">
                                            <label for="teacher_name">ชื่อ-นามสกุล อาจารย์ที่ปรึกษา<sup>*</sup></label>
                                            <input type="text" name="teacher_name" class="form-control form-control-lg <?php echo (!empty($data['teacher_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['teacher_name']; ?>">
                                            <span class="invalid-feedback"><?php echo $data['teacher_name_err']; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="teacher_email">อีเมล<sup>*</sup></label>
                                                    <input type="text" name="teacher_email" class="form-control form-control-lg <?php echo (!empty($data['teacher_email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['teacher_email']; ?>">
                                                    <span class="invalid-feedback"><?php echo $data['teacher_email_err']; ?></span>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="teacher_phone">เบอร์โทรศัพท์<sup>*</sup></label>
                                                    <input type="text" name="teacher_phone" class="form-control form-control-lg <?php echo (!empty($data['teacher_phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['teacher_phone']; ?>">
                                                    <span class="invalid-feedback"><?php echo $data['teacher_phone_err']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>

                            <?php if($competition){$btnText = "ลงทะเบียนแข่งขัน";} else {$btnText = "ลงทะเบียน";} ?>

                            <div class="row">
                                <input type="submit" value="<?php echo $btnText; ?>" class="btn btn-registration btn-block">
                            </div>

                        </form>
                    </article>
                </div>
            </div>
        </section>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>