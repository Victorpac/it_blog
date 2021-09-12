<?php 
  include '../includes/config.php';
  
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
                <h3>Статья не найдена</h3>
                <div class="block__content">
                 Запрашиваемая вами статья не существует!
                  <div class="full-text">
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
    }else {
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
                      $comments_q = mysqli_query($connection, "SELECT * FROM `comments`" );
                      $comments = [];

                      while ( $com = mysqli_fetch_assoc($comments_q) ) {
                        $comments[] = $com;
                      }

                      foreach ($comments as $com) {
                        $delta = strtotime($date) - strtotime($com['pub_date']);
                        ?>
                        <article class="article">
                        <div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=125);"></div>
                        <div class="article__info">
                          <a href="#"><?php echo $com['author'] ?></a>
                          <div class="article__info__meta">
                            <span><?php echo $com['pub_date'] ?></span>
                          </div>
                          <div class="article__info__preview"><?php echo $com['text'] ?></div>
                        </div>
                      </article>
                        <?php
                      }
                     ?>
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
}
 ?>

    <?php include '../includes/footer.php'?>

  </div>

</body>
</html>