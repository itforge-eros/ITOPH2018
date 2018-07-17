<?php require APPROOT . '/views/inc/header.php';?>
<section class="standard-section">
    <div class="container">
        <section class="page-container">
            <div class="row">
                <?php if(isLoggedIn()) : ?>
                <div class="col-lg-12">
                    <a href="<?php echo URLROOT; ?>/admin" class="btn btn-light"><i class="fas fa-angle-left"></i> กลับหน้าหลัก Admin</a>
                    <hr>
                </div>
                <?php endif; ?>
                <div class="col-lg-12">
                    <article>
                        <?php echo $data['competition']->full_description; ?>

                            <div class="button-wrapper">
                                <a href="<?php echo URLROOT; ?>/pages/registration/<?php echo $data['competition']->slug; ?>" class="btn btn-primary btn-lg active">สมัครแข่งขัน</a>
                            </div>
                    </article>
                </div>
            </div>
        </section>
    </div>
</section>


<?php require APPROOT . '/views/inc/footer.php'; ?>