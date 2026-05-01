<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyMenu - Monthly Meal Planner</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f0f1e 0%, #1a1a2e 50%, #16213e 100%);
            color: #ccc;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        header {
            text-align: center;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #12bbd4 0%, #9ec7fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #9ec7fc;
            font-size: 1.1rem;
        }

        /* Controls Card */
        .controls-card {
            background: rgba(26, 26, 46, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(18, 187, 212, 0.2);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .controls-grid {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 20px;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: 500;
            color: #9ec7fc;
            font-size: 0.9rem;
        }

        select {
            background: rgba(42, 42, 62, 0.8);
            color: #ccc;
            border: 1px solid rgba(13, 96, 248, 0.3);
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        select:hover,
        select:focus {
            border-color: #0d60f8;
            outline: none;
            box-shadow: 0 0 0 3px rgba(13, 96, 248, 0.1);
        }

        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        input[type="radio"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #0d60f8;
        }

        button {
            background: linear-gradient(135deg, #0d60f8 0%, #12bbd4 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(13, 96, 248, 0.4);
            font-family: 'Poppins', sans-serif;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 96, 248, 0.6);
        }

        /* Calendar */
        .calendar-card {
            background: rgba(26, 26, 46, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(18, 187, 212, 0.2);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            overflow-x: auto;
        }

        table.calendar {
            width: 100%;
            border-collapse: collapse;
        }

        .calendar-day-head {
            background: rgba(13, 96, 248, 0.2);
            color: #12bbd4;
            font-weight: 600;
            text-align: center;
            padding: 15px 10px;
            border: 1px solid rgba(18, 187, 212, 0.2);
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .calendar-day,
        .calendar-day-np {
            border: 1px solid rgba(18, 187, 212, 0.2);
            padding: 10px;
            vertical-align: top;
            min-height: 120px;
            height: 150px;
            position: relative;
            background: rgba(42, 42, 62, 0.4);
            transition: all 0.3s ease;
        }

        .calendar-day:hover {
            background: rgba(42, 42, 62, 0.6);
            border-color: rgba(18, 187, 212, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(18, 187, 212, 0.2);
        }

        .calendar-day-np {
            background: rgba(42, 42, 62, 0.2);
            opacity: 0.5;
        }

        .day-number {
            position: absolute;
            top: 8px;
            right: 8px;
            background: linear-gradient(135deg, #0d60f8 0%, #12bbd4 100%);
            color: white;
            font-weight: 600;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
        }

        .refresh-meal {
            position: absolute;
            top: 8px;
            left: 8px;
            background: rgba(18, 187, 212, 0.2);
            border: 1px solid rgba(18, 187, 212, 0.4);
            color: #12bbd4;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0;
            font-size: 0.85rem;
        }

        .calendar-day:hover .refresh-meal {
            opacity: 1;
        }

        .refresh-meal:hover {
            background: rgba(18, 187, 212, 0.4);
            transform: rotate(180deg);
            border-color: #12bbd4;
        }

        .refresh-meal.spinning {
            animation: spin 0.6s linear;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .calendar-day p {
            margin-top: 35px;
            padding: 5px;
        }

        .calendar-day b {
            color: #9ec7fc;
            font-size: 0.9rem;
            display: block;
            margin-bottom: 8px;
        }

        .meal-icons {
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: center;
            margin: 8px 0;
            flex-wrap: wrap;
        }

        .meal-icon {
            font-size: 1.5rem;
            color: #12bbd4;
            filter: drop-shadow(0 2px 4px rgba(18, 187, 212, 0.3));
        }

        .calendar-day:hover .meal-icon {
            transform: scale(1.1);
            transition: transform 0.2s ease;
        }

        .meal-badges {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            margin-top: 8px;
            justify-content: center;
        }

        .badge {
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-vegetarian {
            background: rgba(81, 207, 102, 0.2);
            color: #51cf66;
            border: 1px solid rgba(81, 207, 102, 0.3);
        }

        .badge-weekend {
            background: rgba(255, 107, 107, 0.2);
            color: #ff6b6b;
            border: 1px solid rgba(255, 107, 107, 0.3);
        }

        .badge-naughty {
            background: rgba(255, 184, 0, 0.2);
            color: #ffb800;
            border: 1px solid rgba(255, 184, 0, 0.3);
        }

        /* Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .stat-card {
            background: rgba(26, 26, 46, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(18, 187, 212, 0.2);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
        }

        .stat-card h3 {
            color: #9ec7fc;
            font-size: 1rem;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .stat-card .icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        /* Footer */
        footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            color: rgba(158, 199, 252, 0.6);
            font-size: 0.9rem;
        }

        footer a {
            color: #12bbd4;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .controls-grid {
                grid-template-columns: 1fr;
            }

            .calendar-day,
            .calendar-day-np {
                min-height: 100px;
                height: auto;
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .calendar-card {
                padding: 10px;
            }

            /* Hide traditional table on mobile */
            table.calendar {
                display: none;
            }

            /* Show card-based layout instead */
            .mobile-calendar {
                display: block !important;
            }

            .mobile-day-card {
                background: rgba(42, 42, 62, 0.4);
                border: 1px solid rgba(18, 187, 212, 0.2);
                border-radius: 12px;
                padding: 15px;
                margin-bottom: 15px;
                position: relative;
                transition: all 0.3s ease;
            }

            .mobile-day-card:hover {
                background: rgba(42, 42, 62, 0.6);
                border-color: rgba(18, 187, 212, 0.5);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(18, 187, 212, 0.2);
            }

            .mobile-day-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 12px;
                padding-bottom: 10px;
                border-bottom: 1px solid rgba(18, 187, 212, 0.2);
            }

            .mobile-day-info {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .mobile-day-name {
                font-size: 0.85rem;
                color: rgba(158, 199, 252, 0.7);
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .mobile-day-number {
                background: linear-gradient(135deg, #0d60f8 0%, #12bbd4 100%);
                color: white;
                font-weight: 600;
                width: 32px;
                height: 32px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.9rem;
            }

            .mobile-meal-content {
                margin-top: 10px;
            }

            .mobile-meal-content b {
                color: #9ec7fc;
                font-size: 1rem;
                display: block;
                margin-bottom: 10px;
            }

            /* Always show refresh icon on mobile */
            .mobile-day-card .refresh-meal {
                opacity: 1;
                position: static;
            }
        }

        /* Hide mobile calendar on desktop */
        .mobile-calendar {
            display: none;
        }

        @media (min-width: 769px) {
            .mobile-calendar {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-utensils"></i> MyMenu</h1>
            <p class="subtitle">Your Monthly Meal Planning Made Easy</p>
        </header>

        <div class="controls-card">
            <form method="post" action="index.php">
                <div class="controls-grid">
                    <div class="form-group">
                        <label for="month"><i class="fas fa-calendar"></i> Select Month</label>
                        <select name="month" id="month">
                            <?php
                            $currentYear = date("Y");
                            $monNum = date("n");
                            $monFull = date("F");
                            $monInt = 1;
                            $months = array(
                                'January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'August', 'September', 'October', 'November', 'December'
                            );

                            function selectdCheck($value1, $value2) {
                                if ($value1 == $value2) {
                                    return 'selected="selected"';
                                }
                            }

                            foreach ($months as $month) {
                                $str = selectdCheck($monFull, $month);
                                print "<option value='" . $month . "," . $monInt . "," . $currentYear . "' $str>$month $currentYear</option>\n";
                                $monInt++;
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-filter"></i> Meal Restrictions</label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="Restrictions" value="NoRestrictions" id="noRestrictions" checked>
                                <span>No Restrictions</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="Restrictions" value="Vegetarian" id="vegetarian">
                                <span><i class="fas fa-leaf"></i> Vegetarian Only</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit"><i class="fas fa-sync-alt"></i> Generate Menu</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="calendar-card">
            <?php
            global $vegetarianActive;
            global $mealsArray;
            $isVeg = array('veg' => 0, 'meat' => 0);

            // Restrictions Request
            if (isset($_REQUEST['Restrictions'])) {
                if ($_REQUEST['Restrictions'] == 'NoRestrictions') {
                    $vegetarianActive = false;
                }
                if ($_REQUEST['Restrictions'] == 'Vegetarian') {
                    $vegetarianActive = true;
                }
            }

            if (isset($_REQUEST['month'])) {
                $parts = explode(",", $_REQUEST['month']);
                echo draw_calendar($parts[1], $parts[2]);
            } else {
                echo draw_calendar($monNum, $currentYear);
            }

            /* draws a calendar */
            function draw_calendar($month, $year) {
                global $mealsArray;

                $mealsArray = array();
                $string = file_get_contents("meals.json");

                $mealsArray = json_decode($string, true);
                # Randomise the results
                shuffle($mealsArray);

                /* draw table */
                $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

                /* table headings */
                $headings = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                $calendar .= '<tr class="calendar-row"><td class="calendar-day-head">' . implode('</td><td class="calendar-day-head">', $headings) . '</td></tr>';

                /* days and weeks vars now ... */
                $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
                $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
                $days_in_this_week = 1;
                $day_counter = 0;
                $dates_array = array();

                /* row for week one */
                $calendar .= '<tr class="calendar-row">';

                /* print "blank" days until the first of the current week */
                for ($x = 0; $x < $running_day; $x++):
                    $calendar .= '<td class="calendar-day-np">&nbsp;</td>';
                    $days_in_this_week++;
                endfor;

                /* keep going with days.... */
                for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
                    $dayOfWeek = $running_day + 1;
                    $calendar .= '<td class="calendar-day" data-day="' . $list_day . '" data-dayofweek="' . $dayOfWeek . '">';
                    /* add in the day number */
                    $calendar .= '<div class="refresh-meal" onclick="refreshMeal(' . $list_day . ', ' . $dayOfWeek . ', this)" title="Change this meal"><i class="fas fa-sync-alt"></i></div>';
                    $calendar .= '<div class="day-number">' . $list_day . '</div>';

                    $str = '';

                    $str = findDayMeal($dayOfWeek);

                    $calendar .= str_repeat('<p class="meal-content">' . $str . '</p>', 1);

                    $calendar .= '</td>';
                    if ($running_day == 6):
                        $calendar .= '</tr>';
                        if (($day_counter + 1) != $days_in_month):
                            $calendar .= '<tr class="calendar-row">';
                        endif;
                        $running_day = -1;
                        $days_in_this_week = 0;
                    endif;
                    $days_in_this_week++;
                    $running_day++;
                    $day_counter++;
                endfor;

                /* finish the rest of the days in the week */
                if ($days_in_this_week < 8):
                    for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
                        $calendar .= '<td class="calendar-day-np">&nbsp;</td>';
                    endfor;
                endif;

                /* final row */
                $calendar .= '</tr>';

                /* end the table */
                $calendar .= '</table>';

                /* Generate mobile-friendly card view */
                $calendar .= '<div class="mobile-calendar">';
                $dayNames = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

                $running_day_mobile = date('w', mktime(0, 0, 0, $month, 1, $year));
                for ($mobile_day = 1; $mobile_day <= $days_in_month; $mobile_day++) {
                    $dayOfWeek = $running_day_mobile + 1;
                    $dayName = $dayNames[$running_day_mobile];

                    $mealContent = findDayMeal($dayOfWeek);

                    $calendar .= '<div class="mobile-day-card" data-day="' . $mobile_day . '" data-dayofweek="' . $dayOfWeek . '">';
                    $calendar .= '<div class="mobile-day-header">';
                    $calendar .= '<div class="mobile-day-info">';
                    $calendar .= '<div class="mobile-day-number">' . $mobile_day . '</div>';
                    $calendar .= '<div class="mobile-day-name">' . $dayName . '</div>';
                    $calendar .= '</div>';
                    $calendar .= '<div class="refresh-meal" onclick="refreshMealMobile(' . $mobile_day . ', ' . $dayOfWeek . ', this)" title="Change this meal"><i class="fas fa-sync-alt"></i></div>';
                    $calendar .= '</div>';
                    $calendar .= '<div class="mobile-meal-content meal-content">' . $mealContent . '</div>';
                    $calendar .= '</div>';

                    $running_day_mobile++;
                    if ($running_day_mobile == 7) {
                        $running_day_mobile = 0;
                    }
                }
                $calendar .= '</div>';

                /* all done, return result */
                return $calendar;
            }

            function findDayMeal($dayNum) {
                global $mealsArray;
                global $components;
                global $isVeg;
                global $vegetarianActive;

                // Safety check: if meals array is empty, reload it
                if (empty($mealsArray)) {
                    $string = file_get_contents("meals.json");
                    $mealsArray = json_decode($string, true);
                    shuffle($mealsArray);
                }

                if (!preg_match("/^1$|^6$|^7$/", $dayNum)) {
                    ## WeekDay
                    $found = '0';
                    $attempts = 0;
                    $maxAttempts = 100; // Prevent infinite loops

                    while ($found == '0' && $attempts < $maxAttempts) {
                        $attempts++;

                        if (empty($mealsArray)) {
                            // Reload meals if we've exhausted the array
                            $string = file_get_contents("meals.json");
                            $mealsArray = json_decode($string, true);
                            shuffle($mealsArray);
                        }

                        $key = array_rand($mealsArray);
                        $mealSelection = $mealsArray[$key];

                        /* WeekDay 'No Restrictions' Check */
                        if ((($mealSelection['day']) || (!$mealSelection['description'])) && $vegetarianActive == false) {
                            continue;
                        } elseif ($vegetarianActive == false) {
                            unset($mealsArray[$key]);
                            $found = '1';
                        }

                        /* WeekDay 'Vegetarian' Check */
                        if ((($mealSelection['day']) || (!$mealSelection['description'])) && $vegetarianActive == true && $mealSelection['vegetarian'] == 'N') {
                            continue;
                        } elseif ($vegetarianActive == true && $mealSelection['vegetarian'] == 'Y') {
                            $found = '1';
                        }
                    }

                    $str = "<b>" . $mealSelection['description'] . "</b>";
                    $str .= getMealDisplay($mealSelection['description'], $mealSelection['vegetarian'], $mealSelection['mainComponent']);

                    if ($mealSelection['vegetarian'] == "Y") {
                        $isVeg['veg']++;
                    } else {
                        $isVeg['meat']++;
                    }

                    return $str;
                } else {
                    ## Weekend
                    $found = 0;
                    $attempts = 0;
                    $maxAttempts = 100; // Prevent infinite loops

                    /* Weekend 'No Restrictions' Check */
                    if ($vegetarianActive == false) {
                        while ($found < 1 && $attempts < $maxAttempts) {
                            $attempts++;

                            if (empty($mealsArray)) {
                                // Reload meals if we've exhausted the array
                                $string = file_get_contents("meals.json");
                                $mealsArray = json_decode($string, true);
                                shuffle($mealsArray);
                            }

                            $nkey = array_rand($mealsArray);
                            $mealSelection = $mealsArray[$nkey];

                            if ($mealSelection['day'] == $dayNum || $mealSelection['day'] == '0') {
                                unset($mealsArray[$nkey]);
                                $found++;
                            }
                        }
                    }

                    /* Weekend 'Vegetarian' Check */
                    if ($vegetarianActive == true) {
                        while ($found < 1 && $attempts < $maxAttempts) {
                            $attempts++;

                            if (empty($mealsArray)) {
                                // Reload meals if we've exhausted the array
                                $string = file_get_contents("meals.json");
                                $mealsArray = json_decode($string, true);
                                shuffle($mealsArray);
                            }

                            $nkey = array_rand($mealsArray);
                            $mealSelection = $mealsArray[$nkey];

                            if ($mealSelection['vegetarian'] == 'Y') {
                                $found++;
                            }
                        }
                    }

                    $str = "<b>" . $mealSelection['description'] . "</b>";
                    $str .= getMealDisplay($mealSelection['description'], $mealSelection['vegetarian'], $mealSelection['mainComponent']);

                    if ($mealSelection['vegetarian'] == "Y") {
                        $isVeg['veg']++;
                    } else {
                        $isVeg['meat']++;
                    }

                    return $str;
                }
            }

            function getMealDisplay($desc, $vegetarian, $mainComponent) {
                $icons = '';
                $badges = '';

                // Determine main category icon based on mainComponent
                $categoryIcon = '';
                switch ($mainComponent) {
                    case 'Chicken':
                        $categoryIcon = '<i class="fas fa-drumstick-bite meal-icon" title="Chicken"></i>';
                        break;
                    case 'Beef':
                    case 'Minced Beef':
                        $categoryIcon = '<i class="fas fa-burger meal-icon" title="Beef"></i>';
                        break;
                    case 'Pork':
                        $categoryIcon = '<i class="fas fa-bacon meal-icon" title="Pork"></i>';
                        break;
                    case 'Lamb':
                        $categoryIcon = '<i class="fas fa-drumstick-bite meal-icon" title="Lamb"></i>';
                        break;
                    case 'Fish':
                        $categoryIcon = '<i class="fas fa-fish meal-icon" title="Fish"></i>';
                        break;
                    case 'Prawn':
                        $categoryIcon = '<i class="fas fa-fish meal-icon" title="Seafood"></i>';
                        break;
                    case 'Duck':
                        $categoryIcon = '<i class="fas fa-drumstick-bite meal-icon" title="Duck"></i>';
                        break;
                    case 'Turkey':
                        $categoryIcon = '<i class="fas fa-drumstick-bite meal-icon" title="Turkey"></i>';
                        break;
                    case 'Vegetables':
                        $categoryIcon = '<i class="fas fa-carrot meal-icon" title="Vegetarian"></i>';
                        break;
                    case 'Eggs':
                        $categoryIcon = '<i class="fas fa-egg meal-icon" title="Eggs"></i>';
                        break;
                    case 'Naughty':
                        $categoryIcon = '<i class="fas fa-pizza-slice meal-icon" title="Treat"></i>';
                        break;
                    default:
                        $categoryIcon = '<i class="fas fa-utensils meal-icon"></i>';
                }

                $icons = '<div class="meal-icons">' . $categoryIcon . '</div>';

                // Add badges
                $badgesList = array();

                // Vegetarian badge
                if ($vegetarian == "Y") {
                    $badgesList[] = '<span class="badge badge-vegetarian"><i class="fas fa-leaf"></i> Veggie</span>';
                }

                // Weekend special badge
                if (preg_match('/takeaway|take-away|pub|pizza/i', $desc)) {
                    $badgesList[] = '<span class="badge badge-weekend"><i class="fas fa-star"></i> Weekend</span>';
                }

                // Naughty/Treat badge
                if ($mainComponent == 'Naughty') {
                    $badgesList[] = '<span class="badge badge-naughty"><i class="fas fa-heart"></i> Treat</span>';
                }

                if (count($badgesList) > 0) {
                    $badges = '<div class="meal-badges">' . implode('', $badgesList) . '</div>';
                }

                return $icons . $badges;
            }
            ?>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                <h3>Total Meals</h3>
                <p style="color: #12bbd4; font-size: 2rem; font-weight: 700;">91</p>
            </div>
            <div class="stat-card">
                <div class="icon"><i class="fas fa-leaf"></i></div>
                <h3>Vegetarian Options</h3>
                <p style="color: #51cf66; font-size: 2rem; font-weight: 700;">32</p>
            </div>
            <div class="stat-card">
                <div class="icon"><i class="fas fa-drumstick-bite"></i></div>
                <h3>Meat Options</h3>
                <p style="color: #ff6b6b; font-size: 2rem; font-weight: 700;">59</p>
            </div>
        </div>

        <footer>
            <p>&copy; 2026 MyMenu | Made with <i class="fas fa-heart" style="color: #ff6b6b;"></i> by ChrisJ</p>
            <p style="margin-top: 10px; font-size: 0.85rem;">
                <a href="https://github.com/boogiespook/myMenu" target="_blank">
                    <i class="fab fa-github"></i> View on GitHub
                </a>
            </p>
        </footer>
    </div>

    <script>
        // Store current restrictions for meal refresh
        const currentRestrictions = '<?php echo isset($_REQUEST['Restrictions']) ? $_REQUEST['Restrictions'] : 'NoRestrictions'; ?>';

        // Refresh individual meal (desktop)
        function refreshMeal(dayNum, dayOfWeek, element) {
            element.classList.add('spinning');
            const cell = element.closest('.calendar-day');
            const mealContent = cell.querySelector('.meal-content');

            fetch('refresh-meal.php?dayOfWeek=' + dayOfWeek + '&restrictions=' + currentRestrictions)
                .then(response => response.text())
                .then(data => {
                    mealContent.innerHTML = data;
                    setTimeout(() => {
                        element.classList.remove('spinning');
                    }, 600);
                })
                .catch(error => {
                    console.error('Error refreshing meal:', error);
                    element.classList.remove('spinning');
                });
        }

        // Refresh individual meal (mobile)
        function refreshMealMobile(dayNum, dayOfWeek, element) {
            element.classList.add('spinning');
            const card = element.closest('.mobile-day-card');
            const mealContent = card.querySelector('.mobile-meal-content');

            fetch('refresh-meal.php?dayOfWeek=' + dayOfWeek + '&restrictions=' + currentRestrictions)
                .then(response => response.text())
                .then(data => {
                    mealContent.innerHTML = data;
                    setTimeout(() => {
                        element.classList.remove('spinning');
                    }, 600);
                })
                .catch(error => {
                    console.error('Error refreshing meal:', error);
                    element.classList.remove('spinning');
                });
        }
    </script>
</body>
</html>
