<!-- Tab "Обо мне" in admin panel -->
<head>
	<link rel="stylesheet" type="text/css" href="../media/css/a_me_css.css">
</head>
<section class="content__left col-md-12">
	<div class="block" >
		<?php
			$date = $_POST;
			if( isset($date['apply_changes']) ) {
				exit("UPDATE `admin_info` SET `text` = '".$date['admin_text']."' WHERE `admin_info`.`id` = 1");
				mysql_query($connection, "");
				echo '<p style="color:green;">Изменения  применены</p>';
			}
		 ?> 
		<form action="/pages/admin.php?tab=4" method="POST">

			<div class="admin_name" tabindex="0" contenteditable="true" id="im_editable0" role="textbox" aria-multiline="true"><h3 name="admin_name">Admin Name</h3></div>
		    <div>
		    	<div class="block__content block">
		        	<div>
		        		<img src="https://www.mk.ru/upload/entities/2018/08/02/photoreportsImages/detailPicture/eb/c3/e5/c7/3267012_6804350.jpg" name="admin_image" class="admin_image">
		        	</div>
		        	<div class="admin_text">
		        		<input type="text" class="textarea full-text" tabindex="0" name="admin_text" contenteditable="true" role="textbox" aria-multiline="true" value="<h1>You</h1>

							<p>Upon seas. Upon <em>waters</em> don&#39;t upon was. Sea bearing fill Behold be, fourth be fourth It sixth <em>unto</em> also i give <strong>hath</strong> great made is the creeping. <em>You&#39;re</em> of fill night day given rule tree give every sixth moved. Fowl days to Winged. Creeping earth set fruit multiply may. I there, place for good created stars.</p>

							<h2>Yielding</h2>
							<p>Image forth shall place shall won&#39;t and, isn&#39;t <strong>tree</strong> bearing don&#39;t upon moveth set. Their subdue own moving morning herb own you&#39;re midst life so female the, sea deep beast. Good <strong>second</strong> made to Spirit seasons beginning. Grass fruitful cattle. Kind their evening one them said was fourth deep. Abundantly beginning brought gathered.</p>

							<h2>Two Replenish Fish Fifth</h2>
							<p>Whales multiply there. Second Is <strong>first</strong> moving make unto said creature fourth multiply have whales dominion dry from you&#39;re life meat, greater <em>fill</em> don&#39;t dominion. To greater forth may stars <strong>sixth</strong> so male first darkness dry creature yielding deep upon Called moved all Fly.</p>

							<p>Over after can&#39;t spirit their two, which which days were rule, all great image creature very, wherein man itself shall is second morning divided green under divide hath divide you&#39;re tree replenish male is i heaven deep days, may. Deep third was. Good i. Said seed creeping two fill saying creeping earth.</p>

							<h2>Grass Divide Male Heaven His It Forth Second</h2>
							<p>Day subdue moved form meat fill fly spirit there living dry created it bring you face his every. Beast upon so appear creature make that Midst cattle good creepeth lights land fill created. Winged midst won&#39;t god. Subdue. Fowl greater hath Fifth to signs deep together great after light divide made, deep abundantly. Whales subdue Darkness first darkness greater waters divide and, darkness unto moveth place given bearing them beast kind herb gathering years us can&#39;t lights tree. Fifth is cattle us there night make greater us fruit also hath every very <strong>creepeth</strong> evening whose.</p>">

	        				

		        	</div>
		        	<button class="btn btn-success col-md-2" style="float: right;" name="apply_changes" type="submit">Применить</button>
			    </div>
		    </div>
	    </form>
	</div>
</section>