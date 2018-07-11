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
                                <h2>การแข่งขัน</h2> <?php /*<a href="<?php echo URLROOT; ?>/admin/add" class="btn"> <i class="fas fa-plus"></i>เพิ่มการแข่งขัน</a> */ ?>
                                <hr>
                                <div>    
                                    <?php foreach($data['competitions'] as $competition): ?>
                                        <p><a href="<?php echo URLROOT; ?>/pages/details/<?php echo $competition->slug; ?>"><?php echo $competition->title; ?></a></p>
                                    <?php endforeach;?>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="card-columns">
                            <a href="<?php echo URLROOT; ?>/admin/details/individual">
                                <div id="" class="card card--yellow p-3">
                                    <p>ดูรายชื่อผู้สมัครเข้าชม</p>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/competition">
                                <div id="" class="card card--blue p-3">
                                    <p>ดูรายชื่อผู้สมัครแข่งขัน</p>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/workshop">
                                <div id="" class="card card--blue p-3">
                                    <p>ดูรายชื่อผู้สมัครเวิร์คชอป</p>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/admin/details/bebras">
                                <div id="" class="card card--blue p-3">
                                    <p>ดูรายชื่อผู้สมัครเข้าทดสอบ BEBRAS</p>
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