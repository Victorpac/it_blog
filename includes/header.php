<header id="header">
  <div class="header__top">
    <div class="container">
      <div class="header__top__logo">
        <h1><?php echo $config['title']; ?></h1>
      </div>
      <nav class="header__top__menu">
        <ul>

          <li><a href="/static">Главная</a></li>
          <?php
          session_start();
            if ( isset($_SESSION['logged_user']) ) {
                echo '<li><a href="/pages/profil.php">Профиль</a></li>';
            }else 
              echo '<li><a href="/pages/login.php">Войти</a></li>';
           ?>
        </ul>
      </nav>
    </div>
  </div>

  <div class="header__bottom">
    <div class="container">
      <nav>
        <ul>
          <?php
            $categories_q = mysqli_query($connection, "SELECT * FROM `articles_categories`"); 
            $categories = array();

            while ( $cat = mysqli_fetch_assoc($categories_q) ) {
              $categories[] = $cat;
            }

            foreach ($categories as $cat) {
              ?>
              <li><a href="/pages/categorie.php?id=<?php echo $cat['id']; ?>"><?php echo $cat['title'] ?></a></li>
              <?php            
            }
           ?>

        </ul>
      </nav>
    </div>
  </div>
</header>