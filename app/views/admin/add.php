<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row admin">
    <div class="container">
        <div class="col-md-12 mx-auto mt-60">
            <a href="<?php echo URLROOT; ?>/admin" class="btn btn-light"><i class="fas fa-chevron-circle-left"></i> กลับ</a>
            <div class="card card-body bg-light mt-5">
                <h2>เพิ่มการแข่งขัน</h2>
                <form action="<?php echo URLROOT; ?>/admin/edit/<?php echo $data['id']; ?>" method="post">
                    <div class="form-group">
                        <label for="title"> Title: </label>
                        <input type="text" name="title" class="form-control form-control-lg <?echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                        <span class="invalid-feedback"><?php echo data['title_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="slug"> Slug: </label>
                        <input type="text" name="slug" class="form-control form-control-lg <?echo (!empty($data['slug_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['slug']; ?>">
                        <span class="invalid-feedback"><?php echo data['slug_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="content"> Short Description: </label>
                        <textarea name="short_description" class="form-control form-control-lg <?echo (!empty($data['short_description_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['short_description']; ?></textarea>
                        <span class="invalid-feedback"><?php echo data['short_description_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="content"> Full Description: </label>
                        <textarea name="full_description" class="form-control form-control-lg <?echo (!empty($data['full_description_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['full_description']; ?></textarea>
                        <span class="invalid-feedback"><?php echo data['full_description_err']; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="slug"> Logo filename: </label>
                        <input type="text" name="logo_src" class="form-control form-control-lg <?echo (!empty($data['logo_src_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['logo_src']; ?>">
                        <span class="invalid-feedback"><?php echo data['logo_src_err']; ?></span>
                    </div>
                    <div class="row">
                        <input type="submit" class="btn btn-success" value="เพิ่มการแข่งขัน">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
