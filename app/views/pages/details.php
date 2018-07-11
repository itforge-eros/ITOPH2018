<?php require APPROOT . '/views/inc/header.php';?>
<section class="standard-section">
    <div class="container">
        <section class="page-container">
            <div class="row">
                <?php if(isLoggedIn()) : ?>
                <div class="col-lg-12">
                    <a href="<?php echo URLROOT; ?>/admin" class="btn btn-light"><i class="fas fa-angle-left"></i> กลับ</a>
                    <a href="<?php echo URLROOT; ?>/admin/edit/<?php echo $data['competition']->id;?>" class="btn btn-dark"><i class="fas fa-edit"></i>แก้ไข</a>
                        <!--<form action="<?php //echo URLROOT; ?>/admin/delete/<?php //echo $data['competition']->id;?>" class="pull-right" method="post">
                            <input type="submit" value="ลบหน้านี้" class="btn btn-danger">
                        </form>-->
                    <hr>
                </div>
                <?php endif; ?>
                <div class="col-lg-12">
                    <article>
                        <?php echo $data['competition']->full_description; ?>

                        
                        <?php
                        if($data['competition']->slug == 'game'): ?>
                            <h2>ระบบสมัครยังไม่พร้อมใช้งาน</h2>
                        <?php else: ?>
                            <div class="button-wrapper">
                                <a href="<?php echo URLROOT; ?>/pages/registration/<?php echo $data['competition']->slug; ?>" class="btn btn-primary btn-lg active">สมัครแข่งขัน</a>
                            </div>
                        <?php endif; ?>
                    </article>
                </div>
            </div>
        </section>
    </div>
</section>


<?php require APPROOT . '/views/inc/footer.php'; ?>