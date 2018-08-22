<?php require APPROOT . '/views/inc/header.php';?>

<div class="row">
    <div class="container">
        <?php flash('page_message'); ?>
        <section class="standard-section">
            <div class="container">
                <section class="page-container registration">
                    <div class="row">
                        <div class="col-lg-12">
                            <header class="page-header">
                                <div>
                                    <h1>ลงทะเบียน Walk-in</h1>
                                </div>
                            </header>
                        </div>
                        <div class="col-lg-12">
                            <article>
                                <form action="<?php echo URLROOT; ?>/admin/walkinregistration/" id="registration-form" method="post">
                                    <div class="info-wrapper">
                                        <h3>ข้อมูลผู้สมัคร</h3>
                                        <div class="info-group">
                                            <div class="form-group">
                                                <label for="candidate01_name">ชื่อ-นามสกุล<sup>*</sup></label>
                                                <input type="text" name="candidate01_name" class="form-control form-control-lg <?php echo (!empty($data['candidate01_name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['candidate01_name']; ?>">
                                                <span class="invalid-feedback"><?php echo $data['candidate01_name_err']; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="candidate01_id">หมายเลขประจำตัวประชาชน<sup>*</sup></label>
                                                <input type="number" name="candidate01_id" class="form-control form-control-lg <?php echo (!empty($data['candidate01_id_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['candidate01_id']; ?>">
                                                <span class="invalid-feedback"><?php echo $data['candidate01_id_err']; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="candidate01_age">อายุ<sup>*</sup></label>
                                                        <input type="number" name="candidate01_age" class="form-control form-control-lg <?php echo (!empty($data['candidate01_age_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['candidate01_age']; ?>">
                                                        <span class="invalid-feedback"><?php echo $data['candidate01_age_err']; ?></span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="candidate01_grade">ระดับชั้น<sup>*</sup>
                                                        <select class="form-control form-control-lg" name="candidate01_grade">
                                                            <option value="4">มัธยมศึกษาปีที่ 4</option>
                                                            <option value="5">มัธยมศึกษาปีที่ 5</option>
                                                            <option value="6">มัธยมศึกษาปีที่ 6</option>
                                                            <option value="98">ปวช.</option>
                                                            <option value="99">ปวส.</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="candidate01_school">ชื่อสถานศึกษา<sup>*</sup></label>
                                                <input type="text" name="candidate01_school" class="form-control form-control-lg <?php echo (!empty($data['candidate01_school_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['candidate01_school']; ?>">
                                                <span class="invalid-feedback"><?php echo $data['candidate01_school_err']; ?></span>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label for="candidate01_phone">เบอร์โทรศัพท์<sup>*</sup></label>
                                                        <input type="tel" name="candidate01_phone" class="form-control form-control-lg <?php echo (!empty($data['candidate01_phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['candidate01_phone']; ?>">
                                                        <span class="invalid-feedback"><?php echo $data['candidate01_phone_err']; ?></span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="candidate01_email">อีเมล<sup>*</sup></label>
                                                        <input type="email" name="candidate01_email" class="form-control form-control-lg <?php echo (!empty($data['candidate01_email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['candidate01_email']; ?>">
                                                        <span class="invalid-feedback"><?php echo $data['candidate01_email_err']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <input type="submit" value="ลงทะเบียน" class="btn btn-registration btn-block">
                                    </div>

                                </form>
                            </article>
                        </div>
                    </div>
                </section>
            </div>
        </section>
        <script>
        $('#registration-form').one('submit', function() {
            $(this).find('input[type="submit"]').attr('disabled','disabled');
            setTimeout(function(){
                $(this).find('input[type="submit"]').prop('disabled', false);
            }, 5000);
        });
        </script>
    </div>

</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>