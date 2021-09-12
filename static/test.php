<!-- test time in second: 2020-04-02 15:52:17 -->

<?php
  $date = $_POST;
  $errors = [];
  $user = R::findOne('users', 'email = ?', array($date['email']));
  if ( isset($date['do_login']) ) 
  {
    if ( ! $user ) 
    {
      if ( trim($date['email']) == '' ) 
      {
        $errors[] = 'Введите email';
      } elseif ( $date['password'] == '' ) 
      {
        $errors[] = 'Введите пароль';
      } else 
      {
        $errors[] = 'Неверный логин или пароль';
      }
    } elseif ( $date['email'] == 'rootadmin@admin.php' ) 
    {
      if ( trim($date['email']) == '' ) 
      {
        $errors[] = 'Введите email';
      }
      elseif ( $date['password'] == '' ) 
      {
        $errors[] = 'Введите пароль';
      } else 
      {
        $errors[] = 'Неверный логин или пароль';
      }
      if ( password_verify($date['password'], $user->password) ) 
      {
        $_SESSION['logged_user'] = $user;
        header('location: /pages/admin.php?page=1');
      }
    } elseif ( password_verify($date['password'], $user->password ) ) 
    {
      $_SESSION['logged_user'] = $user;
      header('location: /static/index.php');
    }
    if ( ! empty($errors) ) 
    {
      echo '<div style="color: red">' . array_shift($errors) . '</div>';
    }
  }
 ?>
<?php
	
	echo date('j-m-Y G:i:s') . '<br>' . date('3-04-2020 17:06:59') . '<hr>';
	$delta = strtotime (date('j-m-Y G:i:s')) - strtotime ('3-04-2020 16:24:44');
	



	
	function delta_time ($delta) {
		// Dictionary for function "choose_plural"
		$dictionary_1 = ['секунда', 'секунды', 'секунд'];
		$dictionary_2 = ['минута', 'минуты', 'минут'];
		$dictionary_3 = ['час', 'часа', 'часов'];
		$dictionary_4 = ['день', 'дня', 'дней'];
		$dictionary_5 = ['месяц', 'месяца', 'месяцев'];
		$dictionary_6 = ['год', 'года', 'лет'];

		// function for selection form noun
		function choose_plural($date, $dictionary) {
			$x = $date % 10;
			$y = $date % 100;
			if ( ($x == 1) and ($y != 11) ) {
				return $dictionary[0];
			} elseif ( (in_array($x, range(2,4))) and (in_array($y, range(12, 14)) == false) ) {
				return $dictionary[1];
			}else {
				return $dictionary[2];
			}
		}
		// Past time [time]
		// Only second
		if ($delta < 60) {
			$x = $delta;
			echo $x . choose_plural($x, $dictionary_1);
		// Only minutes
		} elseif ( floor($delta / 60) < 60 ) {
			$x = floor($delta / 60);
			echo $x . choose_plural($x, $dictionary_2);
		// Only hours and minutes
		} elseif ( floor($delta / 3600) < 24 ) {
			// - in hours and minutes
			if ( floor(($delta / 60) % 60) > 0 ) {
				$x = floor($delta / 3600);
				$y = (($delta / 60) % 60);
				echo $x . choose_plural($x, $dictionary_3) . $y . choose_plural($y, 
					$dictionary_2);
			// - only at minutes
			} else {
				$x = floor($delta / 3600);
				echo $x . ' ' . choose_plural($x, $dictionary_3);
			}
		// Past tense [date]
		} else {
			// Only days
			if ( (date('j', $delta) > 0 ) and (date('m', $delta) <= 1) and (date('Y', $delta) <= 1970 ) ) {
				$x = (date('j', $delta) - 1);
				echo $x . ' ' . choose_plural($x, $dictionary_4);
			// Only months
			} elseif ( (date('m', $delta) > 0) and (date('Y', $delta) <= 1970 ) ) {
				$x = (date('m', $delta) - 1);
				echo  $x . ' ' . choose_plural($x, $dictionary_5);
			// Only years
			} else {
				$x = (date('Y', $delta) - 1970);
				echo $x . ' ' . choose_plural($x, $dictionary_6);
			}
		}
	}

	echo delta_time($delta);

	exit();

	// function delta_time ($delta, $x) {
	// 	// Past time [time]
	// 	// Only second
	// 	if ($delta < 60) {
	// 		echo $delta . ' sec';
	// 	// Only minutes
	// 	} elseif ( floor($delta / 60) < 60 ) {
	// 		echo floor($delta / 60) . ' min';
	// 	// Only hours and minutes
	// 	} elseif ( floor($delta / 3600) < 24 ) {
	// 		// - in hours and minutes
	// 		if ( floor(($delta / 60) % 60) > 0 ) {
	// 			echo floor($delta / 3600) . ' hours ' . floor(($delta / 60) % 60) . ' min';
	// 		// - only at minutes
	// 		} else {
	// 			echo floor($delta / 3600) . ' hours ';
	// 		}
	// 	// Past tense [date]
	// 	} else {
	// 		// Only days
	// 		if ( (date('j', $delta) > 0 ) and (date('m', $delta) <= 1) and (date('Y', $delta) <= 1970 ) ) {
	// 			echo (date('j', $delta) - 1) . 'day';
	// 		// Only months
	// 		} elseif ( (date('m', $delta) > 0) and (date('Y', $delta) <= 1970 ) ) {
	// 			echo (date('m', $delta) - 1) . 'month';
	// 		// Only years
	// 		} else {
	// 			echo (date('Y', $delta) - 1970) . ' years';
	// 		}
	// 	}
	// 	echo $x;
	// }



