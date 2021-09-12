<!-- Tab "Категории" in admin panel -->
<section class="content__left col-md-12">
	<div class="block"> 
		<h3>Китегории</h3>
		<div class="block__content block">
			<div class="col-md-8" style="float: none">
				<table class="table table-bordered">
		    	 	<thead style="text-align: center;">
		    	 	 	<tr>
		    	 	 		<td>ID</td>
		    	 	 		<td>Название</td>
		    	 	 		<td title="Количество статей с данной категорией">Количество статей</td>
		    	 	 	</tr>
		    	 	 </thead>
		    	 	 <tbody>
			 			<?php 
								$categories = mysqli_query($connection, "SELECT * FROM `articles_categories`");
								while ( $cat = mysqli_fetch_assoc($categories) ) {
									$art = mysqli_query($connection, "SELECT * FROM `articles` WHERE `categorie` = " . $cat['id']);
									$art_count = mysqli_num_rows($art);
								 	?>
								 	<tr>
								 		<td><?php echo $cat['id'] ?></td>
								 		<td><?php echo $cat['title'] ?></td>
								 		<td><?php echo $art_count ?></td>
								 		<td style="border: none !important; background: #eee">
								 			<a type="submit" name="del" style="background: #eee !important; -webkit-appearance: attachment" href="/pages/admin.php?tab=3&delete=<?php echo $cat['id'] ?>&page=<?php echo $page ?>">Удалить</a>
								 		</td>
								 	</tr>
								 	<?php
								 } 
								?>
		    	 	 </tbody>
		     	</table>
			</div>
		</div>
	</div>
</section>