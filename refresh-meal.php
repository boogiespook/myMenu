<?php
// refresh-meal.php - Generate a single new meal for a specific day

header('Content-Type: text/html; charset=utf-8');

$dayOfWeek = isset($_GET['dayOfWeek']) ? intval($_GET['dayOfWeek']) : 0;
$restrictions = isset($_GET['restrictions']) ? $_GET['restrictions'] : 'NoRestrictions';

$vegetarianActive = ($restrictions == 'Vegetarian');

// Load meals
$string = file_get_contents("meals.json");
$mealsArray = json_decode($string, true);
shuffle($mealsArray);

// Find a meal for this day
$mealHtml = findDayMeal($dayOfWeek, $mealsArray, $vegetarianActive);

echo $mealHtml;

function findDayMeal($dayNum, &$mealsArray, $vegetarianActive) {
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

                $key = array_rand($mealsArray);
                $mealSelection = $mealsArray[$key];

                if ($mealSelection['day'] == $dayNum || $mealSelection['day'] == '0') {
                    unset($mealsArray[$key]);
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

                $key = array_rand($mealsArray);
                $mealSelection = $mealsArray[$key];

                if ($mealSelection['vegetarian'] == 'Y') {
                    $found++;
                }
            }
        }

        $str = "<b>" . $mealSelection['description'] . "</b>";
        $str .= getMealDisplay($mealSelection['description'], $mealSelection['vegetarian'], $mealSelection['mainComponent']);

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
