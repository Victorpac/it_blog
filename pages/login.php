<?php 
  include '../includes/config.php';
  require '../includes/db_2.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Войти</title>

  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="/media/assets/bootstrap-grid-only/css/grid12.css">

  <!-- connected style for form -->
  <link rel="stylesheet" type="text/css" href="../media/css/form.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="/media/css/style.css">

</head>
<body>
  <div class="wrapper">
    <style type="text/css">
      @media (min-width: 1366px) {
        .header__top > .container, .header__bottom > .container {
          max-width: 1400px !important;
        }
      }
    </style>

    <!-- header -->
    <?php include '../includes/header.php'; ?>

    <!-- content -->
    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8" style="max-width: 57%; margin-left: 6.666667%;">
            <div class="block">
              <a href="/pages/signup.php">Регистрация</a>
              <h3>Вход</h3>
              <div class="block__content">
                <!-- Authorisation form -->
               <form class="" method="POST" action="/pages/login.php">
                <?php
                  $date = $_POST;
                  $errors = [];
                  $user = R::findOne('users', 'email = ?', array($date['email']));
                  if ( isset($date['do_login']) ) 
                  {
                    if ( ! $user ) {
                      if ( trim($date['email']) == '' ) 
                        $errors[] = 'Введите email';
                      elseif ( $date['password'] == '' ) 
                        $errors[] = 'Введите пароль';
                      else 
                        $errors[] = 'Неверный логин или пароль';
                    }elseif ( $date['email'] == 'rootadmin@admin.php' ) {
                      if ( trim($date['email']) == '' ) 
                        $errors[] = 'Введите email';

                      elseif ( $date['password'] == '' ) 
                        $errors[] = 'Введите пароль';

                      else 
                        $errors[] = 'Неверный логин или пароль';
                      
                      if ( password_verify($date['password'], $user->password) ) {
                        $_SESSION['logged_user'] = $user;
                        header('location: /pages/admin.php?tab=1&page=1');
                      }
                    }elseif ( password_verify($date['password'], $user->password ) ) {
                      $_SESSION['logged_user'] = $user;
                      header('location: /static/index.php');
                    }
                    if ( ! empty($errors) ) 
                      echo '<div style="color: red">' . array_shift($errors) . '</div>';
                  }
                 ?>
                <div class="form-group">
                  <label class="">Email</label>
                  <input type="email" class="form-control" name="email" value="<?php echo $date['email'] ?>" placeholder="Введите email">
                </div>
                <div class="form-group">
                  <label class="">Пароль</label>
                  <input type="password" class="form-control" name="password" value="<?php echo $date['password'] ?>" placeholder="Введите пароль">
                </div>
                <button class="btn btn-success col-md-3" name="do_login" style="float: right;">Войти</button><br><br>
               </form>
              </div>
            </div>        
          </section>

          <!-- Connection sidebar -->
          <?php include '../includes/sidebar.php' ?>
        </div>
      </div>
    </div>

    <!-- Connection footer -->
    <?php include '../includes/footer.php' ?>
  </div>
</body>
</html>