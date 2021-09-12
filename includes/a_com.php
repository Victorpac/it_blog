<!-- Tab "Комментарии" in admin panel -->
<section class="col-md-12">
	<div class="block"> 
	  <h3>Комментарии</h3>
	    <div class="block__content block">
	    	<table class="table table-bordered">
	    	 	 <thead>
	    	 	 	<tr style="text-align: center;">
	    	 	 		<td>ID</td>
	    	 	 		<td>Автор</td>
	    	 	 		<td>Текст</td>
	    	 	 		<td>Дата публикации</td>
	    	 	 		<td>Название статьи</td>
	    	 	 	</tr>
	    	 	 </thead>
	    	 	 <tbody>
	    	 	 	<?php 
	    	 	 		$offset = (($page * 20) - 20);
	    	 	 		$comments = mysqli_query($connection, "SELECT * FROM `comments` ORDER BY `id` DESC LIMIT $offset, 20");
	    	 	 		while ( $com = mysqli_fetch_assoc($comments) ) {
	    	 	 			?>
	    	 	 			<tr>
	    	 	 				<td style="text-align: center;"><?php echo $com['id'] ?></td>
	    	 	 				<td><?php echo $com['author'] ?></td>
	    	 	 				<td><?php echo $com['text'] ?></td>
	    	 	 				<td style="text-align: center;"><?php echo $com['pub_date'] ?></td>
	    	 	 				<td><?php echo $com['article_id'] ?></td>
	    	 	 				<td style="border: none !important; background: #eee">
	    	 	 					<a type="submit" name="del" style="background: #eee; -webkit-appearance: attachment" href="/pages/admin.php?tab=2&delete=<?php echo $com['id'] ?>&page=<?php echo $page ?>">Удалить</a>
	    	 	 				</td>
	    	 	 			</tr>
	    	 	 			<?php
	    	 	 		}
	    	 	 	 ?>
	    	 	 </tbody>
	     	</table>
	 		<div style="text-align: center;">
	 			<!-- Paginator -->
	     		<?php
	     			$com_all = mysqli_query($connection, "SELECT * FROM `comments` ORDER BY `id`");
	     			$page_count = ceil(mysqli_num_rows($com_all) / 20);

					if ( $page_count > 1 ) {
						if ( $page == 1 ) {
							echo ' <a href="/pages/admin.php?tab=2&page=1" class="paginator_link active">1</a> ';
							echo ' <a href="/pages/admin.php?tab=2&page='.($page+1).'" class="paginator_link ">'.($page+1).'</a> ';
							if ( $page_count > 2 )
								echo '<span> ... </span>' . ' <a href="/pages/admin.php?tab=2&page='.$page_count.'" class="paginator_link ">'.$page_count.'</a> ';
							echo ' <a href="/pages/admin.php?tab=2&page='.($page+1).'" class="paginator_link icon">></a> ';
						}elseif ( $page > 1 ) {
							// Icon for return one page back back
							echo ' <a href="/pages/admin.php?tab=2&page='. ($page-1) .'" class="paginator_link icon"><</a> ';
							// First page
							echo ' <a href="/pages/admin.php?tab=2&page=1" class="paginator_link ">1</a> ';
							if ( $page > 3 ) 
								echo '<span> ... </span>' . ' <a href="/pages/admin.php?tab=2&page='.($page-1).'" class="paginator_link ">'.($page-1).'</a> ';
							if ( ($page > 2) and ( $page < 4 ) )
								echo ' <a href="/pages/admin.php?tab=2&page='.($page-1).'" class="paginator_link ">'.($page-1).'</a> ';
							echo ' <a href="/pages/admin.php?tab=2&page='.$page.'" class="paginator_link active">'.$page.'</a> ';
							if ( ($page+1) < $page_count ) {
								echo ' <a href="/pages/admin.php?tab=2&page='.($page+1).'" class="paginator_link ">'.($page+1).'</a> ' . '<span> ... </span>';
								echo ' <a href="/pages/admin.php?tab=2&page='.$page_count.'" class="paginator_link ">'.$page_count.'</a> ';
								echo ' <a href="/pages/admin.php?tab=2&page='.($page+1).'" class="paginator_link icon">></a> ';
							}elseif ( ($page+1) == $page_count ) {
								echo ' <a href="/pages/admin.php?tab=2&page='.$page_count.'" class="paginator_link ">'.$page_count.'</a> ';
								echo ' <a href="/pages/admin.php?tab=2&page='.($page+1).'" class="paginator_link icon">></a> ';
							}
						} 
					}
	 			?>
	 		</div>
	    </div>
	</div>
</section>