<!-- Tab "Статьи" in admin panel -->
<section class="col-md-12">
	<div class="block"> 
	  <a href="#add-article">Добавить</a>
	  <h3>Статьи</h3>
	    <div class="block__content block">
	    	<table class="table table-bordered" >
	    	 	 <thead>
	    	 	 	<tr style="text-align: center">
	    	 	 		<td>ID</td>
	    	 	 		<td>Иконка</td>
	    	 	 		<td>Название</td>
	    	 	 		<td>Текст</td>
	    	 	 		<td>Категория</td>
	    	 	 		<td>Дата публикации</td>
	    	 	 		<td>Количество просмотров</td>
	    	 	 	</tr>
	    	 	 </thead>
	    	 	 <tbody>
	    	 	 	<?php 
	    	 	 		$categories_q = mysqli_query($connection, "SELECT * FROM `articles_categories`"); 
			            $categories = [];
			            $offset = (($page * 10) - 10);  

			            while ( $cat = mysqli_fetch_assoc($categories_q) ) 
			              $categories[] = $cat;

			            $article = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `id` DESC LIMIT $offset, 10");

	    	 	 		while ( $art = mysqli_fetch_assoc($article) ) {
	    	 	 			?>
	    	 	 			<tr>
	    	 	 				<td style="text-align: center;"><?php echo $art['id'] ?></td>
	    	 	 				<td style="text-align: center;"><img class="article_img" src="../media/images/<?php echo $art['image'] ?>"></td>
	    	 	 				<td><?php echo $art['title'] ?></td>
	    	 	 				<td><?php echo mb_substr(strip_tags($art['text']), 0, 50, 'utf-8') . ' ...' ?></td>
	    	 	 				<?php 
	    	 	 					$art_cat = false;
	                                  foreach ( $categories as $cat ) 
	                                  {
	                                    if ( $cat['id'] == $art['categorie'] ) 
	                                    {
	                                      $art_cat = $cat;
	                                      break;
	                                    }
	                                  }
	    	 	 				 ?>
	    	 	 				<td><?php echo $art_cat['title'] ?></td>
	    	 	 				<td><?php echo $art['pubdate'] ?></td>
	    	 	 				<td style="text-align: center;"><?php echo $art['views'] ?></td>
	    	 	 			</tr>
		 	 			<?php
	    	 	 		}
	    	 	 	 	?>
	    	 	 </tbody>
	     	</table>
	     	<br>
	     	<div style="text-align: center">
	     		<!-- Paginator -->
	     		<?php
	     			$art_all = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `id`");
	     			$page_count = ceil(mysqli_num_rows($art_all) / 10);

					if ( $page_count > 1 ) {
						if ( $page == 1 ) {
							echo ' <a href="/pages/admin.php?tab=1&page=1" class="paginator_link active">1</a> ';
							echo ' <a href="/pages/admin.php?tab=1&page='.($page+1).'" class="paginator_link ">'.($page+1).'</a> ';
							if ( $page_count > 2 )
								echo '<span> ... </span>' . ' <a href="/pages/admin.php?tab=1&page='.$page_count.'" class="paginator_link ">'.$page_count.'</a> ';
							echo ' <a href="/pages/admin.php?tab=1&page='.($page+1).'" class="paginator_link icon">></a> ';
						}elseif ( $page > 1 ) {
							// Icon for return one page back back
							echo ' <a href="/pages/admin.php?tab=1&page='. ($page-1) .'" class="paginator_link icon"><</a> ';
							// First page
							echo ' <a href="/pages/admin.php?tab=1&page=1" class="paginator_link ">1</a> ';
							if ( $page > 3 ) 
								echo '<span> ... </span>' . ' <a href="/pages/admin.php?tab=1&page='.($page-1).'" class="paginator_link ">'.($page-1).'</a> ';
							if ( ($page > 2) and ( $page < 4 ) )
								echo ' <a href="/pages/admin.php?tab=1&page='.($page-1).'" class="paginator_link ">'.($page-1).'</a> ';
							echo ' <a href="/pages/admin.php?tab=1&page='.$page.'" class="paginator_link active">'.$page.'</a> ';
							if ( ($page+1) < $page_count ) {
								echo ' <a href="/pages/admin.php?tab=1&page='.($page+1).'" class="paginator_link ">'.($page+1).'</a> ' . '<span> ... </span>';
								echo ' <a href="/pages/admin.php?tab=1&page='.$page_count.'" class="paginator_link ">'.$page_count.'</a> ';
								echo ' <a href="/pages/admin.php?tab=1&page='.($page+1).'" class="paginator_link icon">></a> ';
							}elseif ( ($page+1) == $page_count ) {
								echo ' <a href="/pages/admin.php?tab=1&page='.$page_count.'" class="paginator_link ">'.$page_count.'</a> ';
								echo ' <a href="/pages/admin.php?tab=1&page='.($page+1).'" class="paginator_link icon">></a> ';
							}
						} 
					}
	 			?>
	     	</div>
	    </div>
	</div>
	<div class="block" id="add-article">
		<h3>Добавить статью</h3>
		<div class="block__content">
	 		<div class="row justify-content-center">
	 			<form action="/pages/admin.php?page=2#add-article" method="POST" class="form col-md-8" style="text-align: end">
	 				<?php 
							$date = $_POST;
							if ( isset($date['add_art']) ) {
								$errors = array();
								if ( trim($date['title']) == '' ) 
									$errors[] = 'Введите название статьи';

								if ( trim($date['categorie']) == '' ) 
									$errors[] = 'Введите название категории!';	

								if ( trim($date['text']) == '' ) 
									$errors[] = 'Введите текст';

								if ( empty($errors) ) {
									$article = R::dispense('articles');
									$article->title = $date['title'];
									$article->text = $date['text'];
									$article->categorie = $date['categorie'];
									R::store( $article );
									echo '<div style="color: green">Статья успешно добавлина</div>';
								} else 
									echo '<div style="color: red">' . array_shift($errors) . '</div>';
								
							}
					    ?>
	 			<div class="form__group">
	 				<div class="row">
	 					<div class="col-md-6">
	 						<input type="text" class="form__control" name="title" value="<?php echo $date['title'] ?>" placeholder="Название">
	 					</div>
	 					<div class="col-md-6">
	 						<input type="text" class="form__control" name="categorie" value="<?php echo $date['categorie'] ?>" placeholder="Категория">
	 					</div>
	 				</div>
	 			</div>
	 			<div class="form__group">
	 				<textarea class="form__control" name="text" placeholder="Текст статьи..."><?php echo $date['text'] ?></textarea>
	 			</div>
	 			<div class="form__group">
	 				<button class="btn btn-success" name="add_art">Добавить</button>
	 			</div>
	 		</form>
			  </div>
		</div>
	</div>
</section>
	          