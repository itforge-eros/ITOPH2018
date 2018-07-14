<?php
/* THIS IS FOR COMPETITION */
require APPROOT . '/views/inc/header.php';

?>
<section class="standard-section">
    <div class="container">
        <section class="page-container">
            <div class="row">
                <div class="col-lg-12">
                    <article>
                        <h1>การสมัครแข่งขันเสร็จสิ้น</h1>
                        <p>ใบสมัครได้ถูกส่งไปยังอีเมลของอาจารย์ผู้ดูแล และสามารถดาวน์โหลดได้โดยกดปุ่มด้านล่าง</p>
                        <div class="button-wrapper">
                            <a href="<?php echo URLROOT; ?>/registration/<?php echo $data['filename']; ?>.pdf" class="btn btn-primary btn-lg active">ดาวน์โหลด PDF</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php';?>