<?php if(isset($_SESSION['user_id'])): ?>
    <section class="admin-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>สวัสดี <?php echo $_SESSION['user_username']; ?></p>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URLROOT; ?>">
            <img src="<?php echo URLROOT; ?>/assets/img/logo-sym.svg" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <?php if(isset($_SESSION['user_id'])): ?>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/admin">หน้าหลัก(Admin)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/admin/registration">Check-in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/pages/timetable">กำหนดการ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">ออกจากระบบ</a>
                </li>
            </ul>
        </div>

        <?php else: ?>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/pages/timetable">กำหนดการ</a>
                </li>
            </ul>
        </div>

        <?php endif; ?>
    </div>
</nav>