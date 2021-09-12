<?php

	function delta_time($delta) 
	{
		// Dictionary for function "choose_plural"
		$dictionary_1 = ['секунда', 'секунды', 'секунд'];
		$dictionary_2 = ['минута', 'минуты', 'минут'];
		$dictionary_3 = ['час', 'часа', 'часов'];
		$dictionary_4 = ['день', 'дня', 'дней'];
		$dictionary_5 = ['месяц', 'месяца', 'месяцев'];
		$dictionary_6 = ['год', 'года', 'лет'];

		// function for selection form noun
		function choose_plural($date, $dictionary) 
		{
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
			echo $x  . choose_plural($x, $dictionary_1);
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
?>