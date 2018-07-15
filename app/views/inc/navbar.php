<?php /*<div class="version-needs-attention">
    <h2>ALPHA 180710B05 - THIS SITE IS BEING DEVELOPED</h2>
</div> */
?>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URLROOT; ?>">
            <img src="<?php echo URLROOT; ?>/assets/img/favicon.png" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
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
                    <?php if(isset($_SESSION['user_id'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">ออกจากระบบ</a>
                        </li>
                    <?php endif; ?>
                </ul>
            
        </div>
    </div>
</nav>