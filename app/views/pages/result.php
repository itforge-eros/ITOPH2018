<?php require APPROOT . '/views/inc/header.php';?>
<div class="heading-group heading-group--extra">
    <h2>รายชื่อทีมที่มีสิทธิ์เข้าร่วมการแข่งขัน</h2>
    <h3><?php echo $data['competition']->title; ?></h3>
</div>
<section class="standard-section">
    <div class="container">
        <section class="page-container">
            <div class="row">
                <div class="col-lg-12">
                    <article>
                    <p><?php echo $data['competition']->final_team; ?></p>
                    <div class="button-wrapper">
                        <a href="<?php echo URLROOT; ?>/pages/details/<?php echo $data['competition']->slug; ?>" class="btn btn-primary btn-lg active">อ่านกติกาการแข่งขัน</a>
                    </div>
                    </article>
                </div>
            </div>
        </section>
    </div>
</section>


<?php require APPROOT . '/views/inc/footer.php'; ?>