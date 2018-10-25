<!DOCTYPE HTML>
<!--
	Intensify by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>MyMenu</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<script src="assets/js/Chart.js"></script>	
		<link rel="stylesheet" type="text/css" href="http://overpass-30e2.kxcdn.com/overpass.css"/>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		
  <script>
  $( function() {
    $( document ).tooltip({
      position: {
        my: "center bottom-20",
        at: "center top",
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
            .addClass( feedback.vertical )
            .addClass( feedback.horizontal )
            .appendTo( this );
        }
      }
    });
  } );
  </script> 

  
   <style>
  .ui-tooltip, .arrow:after {
    background: black;
    border: 2px solid white;
  }
  .ui-tooltip {
    padding: 10px 20px;
    color: white;
    border-radius: 20px;
    font: 14px "Overpass";
    box-shadow: 0 0 7px black;
  }
  .arrow {
    width: 70px;
    height: 16px;
    overflow: hidden;
    position: absolute;
    left: 50%;
    margin-left: -35px;
    bottom: 16px;
  }
  .arrow.top {
    top: -16px;
    bottom: auto;
  }
  .arrow.left {
    left: 20%;
  }
  .arrow:after {
    content: "";
    position: absolute;
    left: 20px;
    top: -20px;
    width: 25px;
    height: 25px;
    box-shadow: 6px 5px 9px -9px black;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }
  .arrow.top:after {
    bottom: -20px;
    top: auto;
  }
  </style>
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<nav class="left">
					<a href="#menu"><span>Menu</span></a>
				</nav>
				<a href="index.php" class="logo">MyMenu</a>
				<nav class="right">
					<a href="https://github.com/boogiespook/myMenu" target=_blank class="button alt">Github Repo</a>
				</nav>
			</header>

		<!-- Menu -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.php">Home</a></li>
					<li><a href="https://github.com/boogiespook/myMenu" target=_blank>Git Repo</a></li>
					<p>If you would like to submit more menus, please do a pull request from meals.json in the repo</p>
					<li>Credits</li>
					<p><a href='https://ubisafe.org'>https://ubisafe.org</a></p>
					<p><div>Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div></p?
				</ul>
				<ul class="actions vertical">
					<li><a href="#" class="button fit">Login</a></li>
				</ul>
			</nav>

		<!-- Banner -->
			<section id="banner">
				<div class="content">
<?php
$currentYear= date("Y");
$monNum = date("n");
$monFull = date("F");
$monInt = 1;
$months = array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July ',
    'August',
    'September',
    'October',
    'November',
    'December',
);
$isVeg['veg'] = 0;
$isVeg['meat'] = 0;


function selectdCheck($value1,$value2)
   {
     if ($value1 == $value2) 
     {
      return 'selected="selected"';
     } 
   }

   
global $components;
print "<table class=menu><tr><td class=menu><form action=index.php method=post id=monthChange>
<select name=month id=month>";
foreach ($months as $month) {
	$str = selectdCheck($monFull,$month);
	print "<option value='" . $month . "," . $monInt . "," . $currentYear . "' $str>$month</option>\n";
	$monInt++;
}
print "</select>Select Month</td>";
print '<td><input type="submit" value="Get Menu!"><br>Click to refresh menu</td></tr>';
print "</table>";
print "<p>Hover over a meal which is underlined for more information</p>";
if (isset($_REQUEST['month'])) {
$parts = explode(",",$_REQUEST['month']);

#echo '<h1 class="logo">'.$parts[0] .' ' . $currentYear . '</h1>';
echo draw_calendar($parts[1],$parts[2]);

} else {

#echo '<h1 class="logo">'.$monFull . ' '  . $currentYear . '</h1>';
echo draw_calendar($monNum,$currentYear);
}

/* draws a calendar */
function draw_calendar($month,$year){
global $mealsArray;

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
global $isVeg;
#$isVeg['veg'] = 0;
#$isVeg['meat'] = 0;

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
$tooltip = '';
$closeTooptip = '';
if ($mealSelection[1]['notes'] != null) {
$tooltip = "<a href=# title='" . $mealSelection[1]['notes'] . "'>";
$closeTooptip = "</a>";
}
$str = "<b>" . $tooltip . $mealSelection[1]['description'] . "</b>" . $closeTooptip . "<br><center>";
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

if ($mealSelection[1]['vegetarian'] == "Y") {
	$isVeg['veg']++;
} else {
	$isVeg['meat']++;
}


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
$tooltip = '';
$closeTooptip = '';
if ($mealSelection[1]['notes'] != null) {
$tooltip = "<a href=# title='" . $mealSelection[1]['notes'] . "'>";
$closeTooptip = "</a>";
}
$str = "<b>" . $tooltip . $mealSelection[1]['description'] . "</b>" . $closeTooptip . "<br><center>";
#$str = "<b>" . $mealSelection[1]['description'] . "</b><br><center>";
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

if ($mealSelection[1]['vegetarian'] == "Y") {
	$isVeg['veg']++;
} else {
	$isVeg['meat']++;
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

if (preg_match('/turkey/i',$desc)) {
 $str .= "<img src=images/turkey.png>";
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

if (preg_match('/polish/i',$desc)) {
 $str .= "<img src=images/polish.jpg>";
}

if (preg_match('/duck/i',$desc)) {
 $str .= "<img src=images/duck.png>";
}

if (preg_match('/pasta|carbona|penne|spaghetti|arrabiat/i',$desc)) {
 $str .= "<img src=images/pasta.jpg>";
}

if ($vegetarian == "Y") {
 $str .= "<img src=images/vegetarian.png>";
}

return $str;
}

$componentName = $componentNumber = $componentColour = array();
 
foreach ($components as $componentPart => $value) {
$color = 'rgb(' . rand(0,255) . ',' . rand(0,255) . ',' . rand(0, 255) . ')';	
#print $componentPart . " has " . $value . "<br>";
#array_push($dataPointsMain,array("label"=>$componentPart, "y"=>$value));
array_push($componentName,$componentPart);
array_push($componentNumber,$value);
array_push($componentColour,$color);
} 
#var_dump($componentNumber);

$namesForChart = json_encode($componentName);
$numbersForChart = json_encode($componentNumber);
$colorsForChart = json_encode($componentColour);
global $namesForChart;
#var_dump($namesForChart);
#var_dump($numbersForChart);
?>

				</div>
			</section>

			<section id="three" class="wrapper">
				<div class="inner flex flex-3">
					<div class="flex-item box">
						<div class="content">
							<h3>Key</h3>
<!-- 							<canvas id="pie-chart" ></canvas> -->
<p><img src="images/vegetarian.png"> Vegetarian</p>
						</div>
					</div>

					<div class="flex-item box">
						<div class="content">
							<h3>% of Vegetarian Meals</h3>
<!-- 							<canvas id="pie-chart" ></canvas> -->
<p>To Do</p>
						</div>
					</div>

					<div class="flex-item box">
						<div class="content">
							<h3>Meal Breakdown</h3>
							<p>To Do - breakdown by major food type</p>	
    					</div>
					</div>
				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="copyright">
					&copy; 2018 chrisj.co.uk <a href="http://www.chrisj.co.uk"></a>. Images by <a href="https://unsplash.com">Unsplash</a>.
				</div>
			</footer>

		<!-- Scripts -->

			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>



	</body>
</html>