<html>
<title>Monthly Menu Selector - Chrisj</title>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://overpass-30e2.kxcdn.com/overpass.css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
  $( function() {
    $( "#month" ).selectmenu(); 
 } );
 
$("#monthChange").change(function(){ $("#monthChange").submit() }) 
  </script>

</head>

<body>
<?php
$curentYear= date("Y");

global $components;
print "<table><tr><td><form action=index.php method=post id=monthChange>

<select name=month id=month>
<option value='January,1,$curentYear'>January</option>
<option value='February,2,$curentYear'>February</option>
<option value='March,3,$curentYear'>March</option>
<option value='April,4,$curentYear'>April</option>
<option value='May,5,$curentYear'>May</option>
<option value='June,6,$curentYear'>June</option>
<option value='July,7,$curentYear'>July</option>
<option value='August,8,$curentYear'>August</option>
<option value='September,9,$curentYear'>September</option>
<option value='October,10,$curentYear'>October</option>
<option value='November,11,$curentYear'>November</option>
<option value='December,12,$curentYear'>December</option>
</select></td>";

print '<td><input type="submit" value="Get Menu!"></td></tr>';
print "</table>";

if (isset($_REQUEST['month'])) {
$parts = explode(",",$_REQUEST['month']);
#print_r($parts);

echo '<h1>'.$parts[0].' ' . $curentYear . '</h1>';
echo draw_calendar($parts[1],$parts[2]);


#print '<h2>Summary</h2><ul>';
#arsort($components);
#foreach ($components as $component => $val) {
#print "<li>$component - $val</li>";
#}
#print "</ul>";
} else {
$mon1 = date("n");
$mon2 = date("F");
echo '<h1>'.$mon2 . ' '  . $curentYear . '</h1>';
echo draw_calendar($mon1,$currentYear);
}
echo '<p id="legal"> Designed by <a href="http://www.chrisj.co.uk">chrisj.co.uk 2018 &copy </a></p>';
/* draws a calendar */
function draw_calendar($month,$year){
global $mealsArray;
#global $selections;

$mealsArray = array();
$string = file_get_contents("meals.json");

$mealsArray = json_decode($string, true);
# Randomise the results
shuffle($mealsArray);

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';

			$str = '';

			$str =  findDayMeal($running_day + 1);

		    $calendar.= str_repeat('<p>' . $str . '</p>',1);

		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';

	/* all done, return result */
	return $calendar;
}


function findDayMeal($dayNum) {
global $mealsArray;
global $components;

if (!preg_match("/^1$|^6$|^7$/",$dayNum)) {
## WeekDay
$found = '0';
while ($found == '0') {
  $mealSelection = array($key = array_rand($mealsArray), $mealsArray[$key]);
  if (($mealSelection[1]['day']) || (!$mealSelection[1]['description']) ) {
    $mealSelection = array($key = array_rand($mealsArray), $mealsArray[$key]);
    } else {
    $found = '1';
	}
}
unset($mealsArray[$key]);
# Check for book and page
$str = "<b>" . $mealSelection[1]['description'] . "</b><br><center>";
#if ($mealSelection[1]['image']) {
#$str .= "<br><center><img border=0 src='" . $mealSelection[1]['image'] . "'>";
#}
$str .= putImages($mealSelection[1]['description'],$mealSelection[1]['vegetarian']);

$str .= "</center>";


if ($mealSelection[1]['recipeBook']) {
  $str .= "<br>" . $mealSelection[1]['recipeBook'] . "";
  if ($mealSelection[1]['page']) {
  $str .= "<i> (page " . $mealSelection[1]['page'] . ")</i>";
  }
}


$components[$mealSelection[1]['mainComponent']]++;
return $str;
} else {
## Weekend
$found = 0;
$mealSelection = array($nkey = array_rand($mealsArray), $mealsArray[$nkey]);
while ($found < 1) {
if ($mealSelection[1]['day'] == $dayNum)  {
      $found++;
	  } else {
	  $mealSelection = array($nkey = array_rand($mealsArray), $mealsArray[$nkey]);
	  }
  }

unset($mealsArray[$nkey]);
$components[$mealSelection[1]['mainComponent']]++;
# Check for book and page
$str = "<b>" . $mealSelection[1]['description'] . "</b><br><center>";
if ($mealSelection[1]['image']) {
$str .= "<br><center><img border=0 src='" . $mealSelection[1]['image'] . "'>";
}
$str .= putImages($mealSelection[1]['description'],$mealSelection[1]['vegetarian']);

$str .= "</center>";

if ($mealSelection[1]['recipeBook']) {
  $str .= "<br>" . $mealSelection[1]['recipeBook'];
  if ($mealSelection[1]['page']) {
  $str .= "<i> (page " . $mealSelection[1]['page'] . ")</i>";
  }
}


return $str;
}

}

function putImages($desc,$vegetarian) {
$str = '';

if (preg_match('/chips/i',$desc)) {
 $str .= "<img src=images/chips.jpg>";
}

if (preg_match('/sausage|banger|bacon|gammon|ham|chorizo|splonk|pork/i',$desc)) {
 $str .= "<img src=images/pig.png>";
}

if (preg_match('/fish/i',$desc)) {
 $str .= "<img src=images/fish.jpg>";
}

if (preg_match('/prawn/i',$desc)) {
 $str .= "<img src=images/prawn.gif>";
}
if (preg_match('/halloumi|camenbert|cheese/i',$desc)) {
 $str .= "<img src=images/cheese.gif>";
}
if (preg_match('/lamb/i',$desc)) {
 $str .= "<img src=images/sheep.jpg>";
}

if (preg_match('/chicken/i',$desc)) {
 $str .= "<img src=images/chicken.gif>";
}
if (preg_match('/mash|wedge|cottage|spud|potato/i',$desc)) {
 $str .= "<img src=images/potato.jpg>";
}

if (preg_match('/greek|stifado|souvlakia|moussaka/i',$desc)) {
 $str .= "<img src=images/greek.jpg>";
}


if (preg_match('/teriyaki/i',$desc)) {
 $str .= "<img src=images/japan.gif>";
}

if (preg_match('/malay/i',$desc)) {
 $str .= "<img src=images/maylasia.gif>";
}


if (preg_match('/tortilla/i',$desc)) {
 $str .= "<img src=images/mexico.gif>";
}

if (preg_match('/brocolli|broccoli/i',$desc)) {
 $str .= "<img src=images/brocolli.jpg>";
}

if (preg_match('/mushroom/i',$desc)) {
 $str .= "<img src=images/mushroom.jpg>";
}

if (preg_match('/stilton/i',$desc)) {
 $str .= "<img src=images/blueCheese.jpg>";
}

if (preg_match('/vegetarian/i',$desc)) {
 $str .= "<img src=images/vegetarian.gif>";
}
if (preg_match('/spinach/i',$desc)) {
 $str .= "<img src=images/spinach.png>";
}

if (preg_match('/stir fry/i',$desc)) {
 $str .= "<img src=images/wok.jpg>";
}

if (preg_match('/beef|burgers|Beouf|meatballs|steak|cottage pie/i',$desc)) {
$str .= "<img src=images/cow.png>";
}

if (preg_match('/omlette|egg/i',$desc)) {
 $str .= "<img src=images/egg.jpg>";
}

if (preg_match('/pepper/i',$desc)) {
 $str .= "<img src=images/pepper.jpg>";
}

if (preg_match('/garlic/i',$desc)) {
 $str .= "<img src=images/garlic.jpg>";
}
if (preg_match('/taco/i',$desc)) {
 $str .= "<img src=images/taco.jpg>";
}
if (preg_match('/chilli/i',$desc)) {
 $str .= "<img src=images/chilli.jpg>";
}
if (preg_match('/thai/i',$desc)) {
 $str .= "<img src=images/thai.gif>";
}

if (preg_match('/pasta|carbona|penne|spaghetti|arrabiat/i',$desc)) {
 $str .= "<img src=images/pasta.jpg>";
}

if ($vegetarian == "Y") {
 $str .= "<img src=images/vegetarian.png>";
}

return $str;
}


?>
</body>
</html>