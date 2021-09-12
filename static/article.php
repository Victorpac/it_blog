<?php 
  include '../includes/config.php';
    include '../includes/db_2.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Блог IT_Минималиста!</title>

  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="/media/assets/bootstrap-grid-only/css/grid12.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="/media/css/style.css">
</head>
<body>

  <div id="wrapper">

    <!-- header -->
    <?php include '../includes/header.php';

    $article = mysqli_query($connection, "SELECT * FROM `articles` WHERE `id` = " . (int) $_GET['id']);

    if ( mysqli_num_rows($article) <= 0 ) {
      ?>
      <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <h3>Стастья не найдена</h3>
              <div class="block__content">

                <div class="full-text">
                  Запрашиваемая вами статья не существует!
                </div>
              </div>
            </div>  
          </section>
          <!-- sidebar -->
          <?php include '../includes/sidebar.php' ?>
        </div>
      </div>
    </div>
      <?php
    }else 
    {
      $art = mysqli_fetch_assoc($article);
     ?>

    <div id="content">
      <div class="container">
        <div class="row">
          <section class="content__left col-md-8">
            <div class="block">
              <a><?php echo $art['views'] ?> просмотров</a>
              <h3><?php echo $art['title'] ?></h3>
              <div class="block__content">
                <img src="/media/images/post-image.jpg">
                <!-- text of post -->
                <div class="full-text">
                  <?php echo $art['text'] ?>
                </div>
              </div>
            </div>
            <!-- block comments -->
            <div class="block">
              <a href="#comment-add-form">Добавить свой</a>
              <h3>Комментарии к статье</h3>
              <div class="block__content">
                <div class="articles articles__vertical">
                  <?php 
                  
                    include '../includes/deltatime.php';


                    $date = date('j-m-Y G:i:s');

                    $comments = mysqli_query($connection, "SELECT * FROM `comments` ORDER BY `id` DESC");

                    if ( mysqli_num_rows($comments) <= 0 ) {
                      echo 'Нет комментириев';
                    }
                    while ( $com = mysqli_fetch_assoc($comments) )  {
                      $delta = strtotime($date) - strtotime($com['pub_date']);
                      ?>
                      <article class="article">
                        <div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=125);"></div>
                        <div class="article__info">
                          <a href="#"><?php echo $com['author']; ?></a>
                          <div class="article__info__meta">
                            <small></small>
                          </div>
                          <div class="article__info__preview"><?php echo $com['text']; ?></div>
                        </div>
                      </article>
                      <?php
                    }
                   ?>       
                </div>
              </div>
            </div>

            <div class="block" id="comment-add-form">
              <h3>Добавить комментарий</h3>
              <div class="block__content">
                <form class="form">
                  <div class="form__group">
                    <div class="row">
                      <div class="col-md-6">
                        <input type="text" class="form__control" required="" name="name" placeholder="Имя">
                      </div>
                      <div class="col-md-6">
                        <input type="text" class="form__control" required="" name="nickname" placeholder="Никнейм">
                      </div>
                    </div>
                  </div>
                  <div class="form__group">
                    <textarea name="text" required="" class="form__control" placeholder="Текст комментария ..."></textarea>
                  </div>
                  <div class="form__group">
                    <input type="submit" class="form__control" name="do_post" value="Добавить комментарий">
                  </div>
                </form>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>

    <footer id="footer">
      <div class="container">
        <div class="footer__logo">
          <h1>Блог IT_Минималиста</h1>
        </div>
        <nav class="footer__menu">
          <ul>
            <li><a href="#">Главная</a></li>
            <li><a href="#">Обо мне</a></li>
            <li><a href="#">Я Вконтакте</a></li>
            <li><a href="#">Правообладателям</a></li>
          </ul>
        </nav>
      </div>
    </footer>
        <?php
  }
     ?>
  </div>


</body>
</html>