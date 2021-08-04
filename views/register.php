<form action="" method="post">
    <h1 class="text-center display-6">
        Register
    </h1>
    <div class="mb-3 mt-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control <?php echo $model->hasError('username') ? ' is-invalid' : '' ?>" id="username" name="username">
        <div class="invalid-feedback">
            <?php
            echo $model->getFirstError('username');
            ?>
        </div>
    </div>
    <div class="mb-3 mt-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="my-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="my-3">
        <label for="password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="password" name="passwordConfirm">
    </div>




    <button type="submit" class="btn btn-primary">Submit</button>
</form>