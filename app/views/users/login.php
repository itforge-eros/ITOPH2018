<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="admin-login">

    <div class="card card-body login-card">
        <h2>Login</h2>
        <form action="<?php echo URLROOT; ?>/users/login" method="post">
            <div class="form-group">
                <label for="email"> Email: </label>
                <input type="email" name="email" class="form-control form-control-lg <?echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="password"> Password: </label>
                <input type="password" name="password" class="form-control form-control-lg <?echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
            </div>
            <div class="row">
                <div class="col">
                    <input type="submit" value="log in" class="btn login-btn">
                </div>
            </div>
        </form>
    </div>

</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
