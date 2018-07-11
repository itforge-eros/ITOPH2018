<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
    <div class="container">
        <?php flash('page_message'); ?>
        <section class="admin">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Admin Panel</h1>
                </div>
            </div>
            <section class="admin-tools">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="scrolling-wrapper">
                            <article class="admin-competitions">
                                <h2>การแข่งขัน</h2> <a href="<?php echo URLROOT; ?>/admin/add" class="btn"><i class="fas fa-plus"></i>เพิ่มการแข่งขัน</a>
                                <hr>
                                <div>    
                                    <?php foreach($data['competitions'] as $competition): ?>
                                        <p><a href="<?php echo URLROOT; ?>/pages/details/<?echo $competition->slug; ?>"><?php echo $competition->title; ?></a></p>
                                    <?php endforeach;?>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="card-columns">
                            <a href="" data-toggle="modal" data-target="">
                                <div id="getRegisters" class="card p-3">
                                    <p>ดูรายชื่อผู้สมัครเข้าชม</p>
                                </div>
                            </a>
                            <a href="" data-modal="" class="modal__trigger">
                                <div id="getCompetitionRegisters" class="card p-3">
                                    <p>ดูรายชื่อผู้สมัครแข่งขัน</p>
                                </div>
                            </a>
                            <a href="" data-modal="" class="modal__trigger">
                                <div id="getTestRegisters" class="card p-3">
                                    <p>ดูรายชื่อผู้สมัครเข้าทดสอบ</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </section>
            
        
    </div>

</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>