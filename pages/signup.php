<?php 
  include '../includes/config.php';
  require '../includes/db_2.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Регистрация</title>

  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="/media/assets/bootstrap-grid-only/css/grid12.css">

  <!-- Connect bootstrap --> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="/media/css/style.css">

</head>
<body>
  <div class="wrapper">

    <!-- header -->
    <?php include '../includes/header.php' ?>

    <!-- content -->
    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <a href="/pages/login.php">Войти</a>
              <h3>Регистрация</h3>
              <div class="block__content">
                <?php 
                  $date = $_POST;

                  if ( isset($date['do_signup']) ) 
                  {
                    $errors = array();
                    if( trim($date['login']) == '' ) 
                    {
                      $errors[] = 'Введите логин';
                    }
                    if ( trim($date['email']) == '' )
                    {
                      $errors[] = 'Введите email';
                    }
                    if ( $date['password'] == '' )
                    {
                      $errors[] = 'Введите пароль';
                    }
                    if ( $date['re_password'] == '' )
                    {
                      $errors[] = 'Вы не ввели пороль второй раз';
                    }
                    if ( $date['password'] != $date['re_password'] ) 
                    {
                      $errors[] = 'Пароли не совпадают';
                    }
                    if ( empty($errors) )
                    {
                      //registre user
                      $user = R::dispense('users');
                      $user->login = $date['login'];
                      $user->email = $date['email'];
                      $user->password = password_hash($date['password'], PASSWORD_DEFAULT);
                      R::store( $user );
                      echo '<div style="color: green">Всё хорошо, вы зарагестрированы! Теперь вы можите <a href="/pages/login.php">войти</a></div>';
                    } else
                    {
                      echo '<div style="color: red">' . array_shift($errors) . '</div>';
                    }
                  }
                 ?>
                <!-- Authorisation form -->
               <form class="form-horizontal" method="POST" action="/pages/signup.php">
                <div class="form-group">
                  <label>Логин</label>
                  <input type="text" class="form-control" name="login" placeholder="Введите ваш логин" value="<?php echo $date['login'] ?>"><br>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" value="<?php echo $date['email'] ?>" placeholder="Введите email"><br>
                </div>
                <div class="form-group">
                  <label>Пароль</label>
                  <input type="password" class="form-control" name="password" value="<?php echo $date['password'] ?>" placeholder="Введите пароль"><br>
                </div>
                <div class="form-group">
                  <label>Повторите пароль</label>
                  <input type="password" class="form-control" name="re_password" value="<?php echo $date['re_password'] ?>" placeholder="Введите пароль ещё раз">
                </div>
                <button class="btn btn-success col-md-3" name="do_signup" style="float: right;">Войти</button><br><br>
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