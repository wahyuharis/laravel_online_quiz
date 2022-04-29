<?php

use Illuminate\Support\Env;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= env('APP_NAME')?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= url('bootstrap-4.0.0-dist/css/bootstrap.min.css') ?>">
  <script src="<?= url('js-plugin/jquery-3.6.0.min.js') ?>"></script>
  <script src="<?= url('bootstrap-4.0.0-dist/js/bootstrap.bundle.min.js') ?>"></script>
</head>

<body>

  <div class="container">

    <div class="row">
      <div class="col-md-4">
      </div>
      <div class="col-md-4">
        <br><br>
        <h2><?= env('APP_NAME')?></h2>
        
        <h2>Login Peserta</h2>
        <?php if (Session::get('status')) { ?>
          <div class="alert alert-danger" role="alert">
            <?= Session::get('status') ?>
          </div>
        <?php } ?>
        <form action="<?= url('') ?>">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" placeholder="Username" name="username">
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="col-md-4">
      </div>
    </div>



  </div>

</body>

</html>