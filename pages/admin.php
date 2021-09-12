<?php 
  // Connect Database settings and settings of RedBean
  include '../includes/config.php';
  include '../includes/db_2.php';

  if ( ! isset($_SESSION['logged_user']['login']) ) {
  	header('location: /pages/login.php');
  }else {
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Войти</title>

  <!-- Bootstrap Grid -->
  <link rel="stylesheet" type="text/css" href="/media/assets/bootstrap-grid-only/css/grid12.css">

  <!-- Connect bootstrap --> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

  <!-- Custom -->
  <link rel="stylesheet" type="text/css" href="/media/css/style.css">

  <!-- connect admin.css -->
  <link rel="stylesheet" type="text/css" href="../media/css/admin.css">

  <meta name="viewport" content="width=device-width">

</head>
<body>
	<div class="wrapper">

		<!-- Header of Admin panel -->
		<header id="header">
		  <div class="header__top">
		    <div class="container">
		      <div class="header__top__logo">
		        <h1>Панель администратора</h1>
		      </div>
		      <nav class="header__top__menu">
		        <ul>
		          <li><a href="/static">Главная</a></li>
		          <li><a href="/pages/about_me.php">Обо мне</a></li>
		          <li><a href=" <?php echo $config['VK']; ?> ">Я Вконтакте</a></li>
		          <li><a href="/pages/logout.php">ВЫЙТИ</a></li>
		        </ul>
		      </nav>
		    </div>
		  </div>

		  <div class="header__bottom">
		    <div class="container">
		      <nav>
		        <ul>
	               <li><a href="?tab=1&page=1">Статьи</a></li>
	               <li><a href="/pages/admin.php?tab=2&page=1">Комментарии</a></li>
	               <li><a href="/pages/admin.php?tab=3&page=1">Категории</a></li>
	               <li><a href="/pages/admin.php?tab=4&page=1">Обо мне</a></li>
		        </ul>
		      </nav>
		    </div>
		  </div>
		</header>

		<!-- Content -->
	    <div id="content">
	      <div class="container">
	        <div class="row">
	        	<?php 
        			$tab = (int) $_GET['tab'];
		          	$delete = (int) $_GET['delete'];
		          	$page = (int) $_GET['page'];

		          	// Output and edit article
		          	if ( $tab == 1 )  
		          		//Connect tab "Комментарии" for admin panel
		          		require_once '../includes/a_art.php';

		          	// Output and edit comments
		          	if ( $tab == 2 ) {
		          		if ( $delete ) {
		          			mysqli_query($connection, "DELETE FROM `comments` WHERE `comments`.`id` = $delete");
		          			header('location: /pages/admin.php?tab=2&page='.$page);
		          		}
		          		//Connect tab "Комментарии" for admin panel
		          		require_once '../includes/a_com.php';
		          	}

		          	// Output and edit categories
		          	if ( $tab == 3 ) {
		          		if ( $delete ) {
		          			mysqli_query($connection, "DELETE FROM `articles_categories` WHERE `articles_categories`.`id` = $delete");
		          			header('location: /pages/admin.php?tab=3&page='.$page);
		          		}
		          		// Connect tab "Категории" for admin panel
		          		require_once '../includes/a_cat.php';
		         	 }
		          
	 			  	if ( $tab == 4 ) 
	 			  		// Connect tab "Обо мне" for admin panel
		           		require_once '../includes/a_me.php';
	        	?>
	        </div>
	      </div>
	    </div>

		<!-- Connect footer -->
	    <?php include '../includes/footer.php' ?>
	</div>
</body>
</html>
<?php } ?>