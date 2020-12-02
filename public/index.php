<?php
$allHouses = [
    'house' => [1, 2, 3, 4, 5],
    'color' => ['Red', 'Blue', 'White', 'Yellow', 'Green'],
    'resident' => ['Norwegian', 'Englishman', 'Dane', 'German', 'Swede'],
    'cigarette' => ['Blend', 'Dunhill', 'Prince', 'PallMall', 'BlueMaster'],
    'pat' => ['Cat', 'Horse', 'Dog', 'Bird', 'Fish'],
    'drink' => ['Tea', 'Water', 'Milk', 'Beer', 'Coffee']
];
$allSortedHouses = [
    'firstHouse' => ['house'=> 1, 'color'=>'', 'resident'=>'', 'cigarette'=>'', 'pat'=>'', 'drink'=>''],
    'secondHouse' => ['house'=> 2, 'color'=>'', 'resident'=>'', 'cigarette'=>'', 'pat'=>'', 'drink'=>''],
    'thirdHouse' => ['house'=> 3, 'color'=>'', 'resident'=>'', 'cigarette'=>'', 'pat'=>'', 'drink'=>''],
    'fourthHouse' => ['house'=> 4, 'color'=>'', 'resident'=>'', 'cigarette'=>'', 'pat'=>'', 'drink'=>''],
    'fifthHouse' => ['house'=> 5, 'color'=>'', 'resident'=>'', 'cigarette'=>'', 'pat'=>'', 'drink'=>'']
];
//
// Функции для работы с исходным массивом
//
function delete_value_from_initial_array($needleValue){
    global $allHouses;
    foreach ($allHouses as &$arrData){
        if (in_array($needleValue, $arrData)){
            $valueKey = array_search($needleValue, $arrData);
            foreach ($arrData as $value){
                unset($arrData[$valueKey]);
            }
        }
    }
}
//
// Функции для работы с новым массивом
//
function add_value_to_sorted_array($toHouse, $characteristic, $newData){
    global $allSortedHouses;
    return $allSortedHouses[$toHouse][$characteristic] = $newData;
}

function get_value_by_house_number($houseNumber, $houseCharacteristic){
    global $allSortedHouses;
    foreach ($allSortedHouses as $house=>$arrays){
        foreach ($arrays as $item=>$value){
            if ($value == $houseNumber){
                return $allSortedHouses[$house][$houseCharacteristic];
            }
        }
    }
}

function get_house_from_sorted_array($needleValue){
    global $allSortedHouses;
    foreach ($allSortedHouses as $key=>$arrays){
        if (array_search($needleValue, $arrays)){
            return $key;
        }
    }
}

function get_house_number_from_sorted_array($needleValue){
    global $allSortedHouses;
    foreach ($allSortedHouses as $arrays){
        if (array_search($needleValue, $arrays)){
            $houseNumber = $arrays['house'];
            return $houseNumber;
        }
    }
}

function check_sorted_value_by_house($house, $column, $checkedValue){
    global $allSortedHouses;
    $value = $allSortedHouses[$house][$column];
    if ($value == $checkedValue){
        return true;
    } else {
        return false;
    }
}
// *********************************************************************************************************************
// Функции для условий задачи
//

// 15 (Норвежец живет рядом с синим домом)
function blue_house_number($houseNumber){
    if ($houseNumber == 1){
        return $blueHouse = ++$houseNumber;
    } elseif ($houseNumber == 5) {
        return $blueHouse = --$houseNumber;
    } else {
        echo 'Нельзя определить однозначно номер голубого дома';
    }
}
// 7 Тот, кто живет в центре, пьет молоко.
function middle_house($initialArray, $innerArrayName){
    $qty = count($initialArray[$innerArrayName]);
    $average = $qty / 2;
    return $middleHouse = round($average, 0, PHP_ROUND_HALF_UP);
}

//Зеленый дом находится левее белого.
$greenWhiteHouses = [];
function green_white_houses(){
    global $allHouses;
    global $allSortedHouses;
    global $greenWhiteHouses;
    $allColors = array_values($allHouses['color']);
    $sortedColors = array_column($allSortedHouses, 'color');
    $sortedHouses = array_column($allSortedHouses, 'house');
    $coloredHouses = array_combine($sortedHouses, $sortedColors);
    foreach ($coloredHouses as $house => $color){
        if (next($coloredHouses) === '' && $color === ''){
            $greenWhiteHouses[] = $house;
        }
    }
}
function whiteHouseNumber(){
    $greenHouse = get_house_number_from_sorted_array('Green');
    return $whiteHouse = $greenHouse + 1;
}

//Зеленый дом находится левее белого.
//Англичанин живет в красном доме.
function color_norwegian_house(){
    global $greenWhiteHouses;
    global $allHouses;
    global $allSortedHouses;
    $allColors = array_values($allHouses['color']);
    $norwegianHouseNumber = get_house_number_from_sorted_array('Norwegian');
    if (check_sorted_value_by_house('firstHouse', 'resident', 'Englishman')){
        $yellowKey = array_search('Yellow', $allColors);
        unset($allColors[$yellowKey]);
    } else {
        $redKey = array_search('Red', $allColors);
        unset($allColors[$redKey]);
    }
    if (!in_array($norwegianHouseNumber, $greenWhiteHouses)){
        $greenKey = array_search('Green', $allColors);
        $whiteKey = array_search('White', $allColors);
        unset($allColors[$greenKey]);
        unset($allColors[$whiteKey]);
    } else {
        echo 'Нельзя однозначно определить цвет норвежского дома';
    }
//Возвращаем оставшийся цвет
    foreach ($allColors as $color){
        return $color;
    }
}

//Зеленый дом находится левее белого.
//В зеленом доме пьют кофе.
function green_coffee_house(){
    global $greenWhiteHouses;
    foreach ($greenWhiteHouses as $value){
        $houseDrink = get_value_by_house_number($value, 'drink');
        if ($houseDrink == 'Coffee'){
            return $value;
        } elseif (!$houseDrink == 'Coffee' && $houseDrink == ''){
            return $value;
        }
    }

}

//Англичанин живет в красном доме.
function red_house_number(){
    global $allHouses;
    global $allSortedHouses;
    $allColors = array_values($allHouses['color']);
    $sortedColors = array_column($allSortedHouses, 'color');
    $sortedHouses = array_column($allSortedHouses, 'house');
    $coloredHouses = array_combine($sortedHouses, $sortedColors);
    if (count($allColors) == 1){
        foreach ($allColors as $color){
            foreach ($coloredHouses as $house => $col){
                if ($col == ''){
                    return $house;
                }
            }
        }
    } else {
        echo "Нельзя красный дом определить однозначно";
    }

}
function englishman_house($house, $column, $color){
    if (check_sorted_value_by_house($house, $column, $color)){
        return $house;
    } else {
        echo $house . ' не красный';
    }
}

// Напиток норвежца
//Датчанин пьет чай.
//Тот, кто курит Blue Master, пьет пиво
//Тот, кто живет в центре, пьет молоко.
//В зеленом доме пьют кофе.
function norwegian_drink(){
    global $norwegianHouse;
    if (check_sorted_value_by_house($norwegianHouse, 'resident', 'Dane')){
        return 'Tea';
    } elseif (check_sorted_value_by_house($norwegianHouse, 'cigarette', 'BlueMaster')){
        return 'Beer';
    } elseif (check_sorted_value_by_house($norwegianHouse, 'house', '3')){
        return 'Milk';
    } elseif (check_sorted_value_by_house($norwegianHouse, 'color', 'Green')){
        return 'Coffee';
    } else {
        return 'Water';
    }
}

//Сосед того, кто курит Blend, пьет воду.
function blend_house(){
    global $allSortedHouses;
    $sortedHouses = array_column($allSortedHouses, 'house');
    $sortedDrinks = array_column($allSortedHouses, 'drink');
    $sortedCigarettes = array_column($allSortedHouses, 'cigarette');
    $houseDrink = array_combine($sortedHouses, $sortedDrinks);
    $houseCigarette = array_combine($sortedHouses, $sortedCigarettes);
    $i = 0;
    foreach ($houseDrink as $house => $drink){
        if ($drink == ''){
            $houseDrink[$house] = ++$i;
        }
    }
    foreach ($houseCigarette as $house => $cigarette){
        if ($cigarette == ''){
            $houseCigarette[$house] = 'empty';
        }
    }
    $drinkCigarette = array_combine($houseDrink, $houseCigarette);
    foreach ($drinkCigarette as $drink => $cigarette){
        if ($drink == 'Water'){
            if (prev($drinkCigarette) == 'empty'){
                $blendKey = key($drinkCigarette);
                $drinkCigarette[$blendKey] = 'Blend';
            } else {
                reset($drinkCigarette);
            }
            if (next($drinkCigarette) == 'empty'){
                $blendKey = key($drinkCigarette);
                $drinkCigarette[$blendKey] = 'Blend';
            } else {
                reset($drinkCigarette);
            }
        }
    }
    $newHouseCigarette = array_combine($sortedHouses, array_values($drinkCigarette));
    return array_search('Blend', $newHouseCigarette);
}
// Функция, применимая для определения двух конфигураций одного дома, когда их результат однозначен
function two_configuration_house($firstConf, $secondConf, $needleFirstConf, $needleSecondConf){
    global $allSortedHouses;
    $sortedHouses = array_column($allSortedHouses, 'house');
    $sortedFirstConf = array_column($allSortedHouses, $firstConf);
    $sortedSecondConf = array_column($allSortedHouses, $secondConf);

    $houseFirstConf = array_combine($sortedHouses, $sortedFirstConf);
    $houseSecondConf = array_combine($sortedHouses, $sortedSecondConf);

    $firstConf = array_search($needleFirstConf, $houseFirstConf);
    $secondConf = array_search($needleSecondConf, $houseSecondConf);

    $emptyFirstConfHouse = [];
    $emptySecondConfHouse = [];

    if (!$firstConf && !$secondConf){
        foreach ($houseFirstConf as $house => $conf){
            if ($conf == null){
                $emptyFirstConfHouse[] = $house;
            }
        }
        foreach ($houseSecondConf as $house => $conf){
            if ($conf == null){
                $emptySecondConfHouse[] = $house;
            }
        }
    } else {
        echo 'Все на месте';
    }
    $emptyHouses = array_intersect($emptyFirstConfHouse, $emptySecondConfHouse);
    if (count($emptyHouses) == 1){
        return $emptyHouses[key($emptyHouses)];
    } else {
        echo 'Нельзя определить характеристики';
    }
}

//Функция, применимая для определения послеедней незаполненной конфигурации
function last_configuration_house($conf){
    global $allSortedHouses;
    $sortedHouses = array_column($allSortedHouses, 'house');
    $sortedConf = array_column($allSortedHouses, $conf);
    $houseConf = array_combine($sortedHouses, $sortedConf);
    $emptyConfHouse = [];
    foreach ($houseConf as $house => $value){
        if ($value == null){
            $emptyConfHouse[] = $house;
        }
    }
    if (count($emptyConfHouse) == 1){
        return $emptyConfHouse[key($emptyConfHouse)];
    } else {
        echo 'Кофигурация не последняя';
    }
}

//Тот, кто курит Blend, живет рядом с тем, кто выращивает кошек.
function cat_house(){
    global $allSortedHouses;
    $sortedHouses = array_column($allSortedHouses, 'house');
    $sortedPat = array_column($allSortedHouses, 'pat');
    $housePat = array_combine($sortedHouses, $sortedPat);
    $blendHouseNumber = get_house_number_from_sorted_array('Blend');
    foreach ($housePat as $house => $pat){
        if ($pat == ''){
            $housePat[$house] = 'empty';
        }
    }
    $catHouses = [];
    foreach ($housePat as $house => $pat) {
        if ($house == $blendHouseNumber) {
            $prev = $house - 1;
            $next = $house + 1;
            if ($housePat[$prev] == 'empty') {
                $catHouses[] = $prev;
                if ($housePat[$next] == 'empty') {
                    $catHouses[] = $next;
                    if ($housePat[$prev] == 'empty' && $housePat[$next] == 'empty') {
                        echo 'Нельзя определить. кто вырасчивает кошек';
                    }
                }
            }
        }
    }
    if (count($catHouses) == 1){
        foreach ($catHouses as $catHouse){
            return $catHouse;
        }
    }
}

//Оставшееся домашнее животное
function last_pat(){
    global $allHouses;
    $lastPats = array_values($allHouses['pat']);
    foreach ($lastPats as $pat){
        $fish = add_value_to_sorted_array('fourthHouse', 'pat', $pat);
        delete_value_from_initial_array($fish);
        //echo 'Немец вырасчивает ' . $pat;
    }
}
// *********************************************************************************************************************
// Решения. Применение функций
//

// Норвежец живет в первом доме.
$norwegian = add_value_to_sorted_array('firstHouse', 'resident', 'Norwegian');
delete_value_from_initial_array($norwegian);

// Норвежец живет рядом с синим домом.
$norwegianHouseNumber = get_house_number_from_sorted_array('Norwegian');
$blueHouseNumber = blue_house_number($norwegianHouseNumber);
$blueHouse = get_house_from_sorted_array($blueHouseNumber);
$blue = add_value_to_sorted_array($blueHouse, 'color', 'Blue');
delete_value_from_initial_array($blue);

// Тот, кто выращивает лошадей, живет в синем доме.
$horseHouse = get_house_from_sorted_array('Blue');
$horse = add_value_to_sorted_array($horseHouse, 'pat', 'Horse');
delete_value_from_initial_array($horse);

//Тот, кто живет в центре, пьет молоко.
$milkHouse = middle_house($allHouses, 'house');
$thirdHouse = get_house_from_sorted_array($milkHouse);
$milk = add_value_to_sorted_array($thirdHouse, 'drink', 'Milk');
delete_value_from_initial_array($milk);

//Зеленый дом находится левее белого.
//Англичанин живет в красном доме.
$suitableGreenWhite = green_white_houses();
$norwegianHouseColor = color_norwegian_house();
$norwegianHouse = get_house_from_sorted_array($norwegianHouseNumber);
$yellow = add_value_to_sorted_array($norwegianHouse, 'color', $norwegianHouseColor);
delete_value_from_initial_array($yellow);

//Тот, кто живет в желтом доме, курит Dunhill.
$dunhillHouse = get_house_from_sorted_array('Yellow');
$dunhill = add_value_to_sorted_array($dunhillHouse, 'cigarette', 'Dunhill');
delete_value_from_initial_array($dunhill);

//Зеленый дом находится левее белого.
//В зеленом доме пьют кофе.
$greenCoffeeHouseNumber = green_coffee_house();
$greenCoffeeHouse = get_house_from_sorted_array($greenCoffeeHouseNumber);
$coffee = add_value_to_sorted_array($greenCoffeeHouse, 'drink', 'Coffee');
$green = add_value_to_sorted_array($greenCoffeeHouse, 'color', 'Green');
delete_value_from_initial_array($coffee);
delete_value_from_initial_array($green);

$whiteHouseNumber = whiteHouseNumber();
$whiteHouse = get_house_from_sorted_array($whiteHouseNumber);
$white = add_value_to_sorted_array($whiteHouse, 'color', 'White');
delete_value_from_initial_array($white);

// Осталяся последний цвет: красный
$redHouseNumber = red_house_number();
$redHouse = get_house_from_sorted_array($redHouseNumber);
$red = add_value_to_sorted_array($redHouse, 'color', 'Red');
delete_value_from_initial_array($red);

//Англичанин живет в красном доме.
$englishmanHouse = englishman_house($redHouse, 'color', $red);
$englishman = add_value_to_sorted_array($englishmanHouse, 'resident', 'Englishman');
delete_value_from_initial_array($englishman);

// Напиток норвежца
//Датчанин пьет чай.
//Тот, кто курит Philip Morris, пьет пиво
//Тот, кто живет в центре, пьет молоко.
//В зеленом доме пьют кофе.
$norwegianDrink = norwegian_drink();
$water = add_value_to_sorted_array($norwegianHouse, 'drink', $norwegianDrink);
delete_value_from_initial_array($water);

//Сосед того, кто курит Blend, пьет воду.
$blendHouseNumber = blend_house();
$blendHouse = get_house_from_sorted_array($blendHouseNumber);
$blend = add_value_to_sorted_array($blendHouse, 'cigarette', 'Blend');
delete_value_from_initial_array($blend);

//Тот, кто курит Blue Master, пьет пиво.
$philippeMoriceBeerHouseNumber = two_configuration_house('cigarette', 'drink', 'BlueMaster', 'Beer');
$philippeMoriceBeerHouse = get_house_from_sorted_array($philippeMoriceBeerHouseNumber);
$beer = add_value_to_sorted_array($philippeMoriceBeerHouse, 'drink', 'Beer');
$philippeMorice = add_value_to_sorted_array($philippeMoriceBeerHouse, 'cigarette', 'BlueMaster');
delete_value_from_initial_array($beer);
delete_value_from_initial_array($philippeMorice);

//Датчанин пьет чай.
$daneTeaHouseNumber = two_configuration_house('resident', 'drink', 'Dane', 'Tea');
$daneTeaHouse = get_house_from_sorted_array($daneTeaHouseNumber);
$tea = add_value_to_sorted_array($daneTeaHouse, 'drink', 'Tea');
$dane = add_value_to_sorted_array($daneTeaHouse, 'resident', 'Dane');
delete_value_from_initial_array($tea);
delete_value_from_initial_array($dane);

//Немец курит Prince.
$germanPrinceHouseNumber = two_configuration_house('resident', 'cigarette', 'German', 'Prince');
$germanPrinceHouse = get_house_from_sorted_array($germanPrinceHouseNumber);
$mallboro = add_value_to_sorted_array($germanPrinceHouse, 'cigarette', 'Prince');
$german = add_value_to_sorted_array($germanPrinceHouse, 'resident', 'German');
delete_value_from_initial_array($mallboro);
delete_value_from_initial_array($german);

// Швед последний с списке резидентов остается
$swedeHouseNumber = last_configuration_house('resident');
$swedeHouse = get_house_from_sorted_array($swedeHouseNumber);
$swede = add_value_to_sorted_array($swedeHouse, 'resident', 'Swede');
delete_value_from_initial_array($swede);

// ПалМал последний с списке сигарет остается
$pallMallHouseNumber = last_configuration_house('cigarette');
$pallMallHouse = get_house_from_sorted_array($pallMallHouseNumber);
$pallMall = add_value_to_sorted_array($pallMallHouse, 'cigarette', 'PallMall');
delete_value_from_initial_array($pallMall);

//Швед выращивает собак.
$dogHouseNumber = $swedeHouseNumber;
$dogHouse = get_house_from_sorted_array($dogHouseNumber);
$dog = add_value_to_sorted_array($dogHouse, 'pat', 'Dog');
delete_value_from_initial_array($dog);

//Тот, кто курит Pall Mall, выращивает птиц.
$birdHouseNumber = $pallMallHouseNumber;
$birdHouse = get_house_from_sorted_array($birdHouseNumber);
$bird = add_value_to_sorted_array($birdHouse, 'pat', 'Bird');
delete_value_from_initial_array($bird);

//Тот, кто курит Blend, живет рядом с тем, кто выращивает кошек.
$catHouseNumber = cat_house();
$catHouse = get_house_from_sorted_array($catHouseNumber);
$cat = add_value_to_sorted_array($catHouse, 'pat', 'Cat');
delete_value_from_initial_array($cat);


//Вывод первоначального массива и отсортированного в соответствии с условиями
//var_export($allHouses);
//var_export($allSortedHouses);
last_pat();
?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<table>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Дом</th>
            <th scope="col">1</th>
            <th scope="col">2</th>
            <th scope="col">3</th>
            <th scope="col">4</th>
            <th scope="col">5</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">Цвет</th>
            <td><?=$allSortedHouses['firstHouse']['color']?></td>
            <td><?=$allSortedHouses['secondHouse']['color']?></td>
            <td><?=$allSortedHouses['thirdHouse']['color']?></td>
            <td><?=$allSortedHouses['fourthHouse']['color']?></td>
            <td><?=$allSortedHouses['fifthHouse']['color']?></td>
        </tr>
        <tr>
            <th scope="row">Национальность</th>
            <td><?=$allSortedHouses['firstHouse']['resident']?></td>
            <td><?=$allSortedHouses['secondHouse']['resident']?></td>
            <td><?=$allSortedHouses['thirdHouse']['resident']?></td>
            <td><?=$allSortedHouses['fourthHouse']['resident']?></td>
            <td><?=$allSortedHouses['fifthHouse']['resident']?></td>
        </tr>
        <tr>
            <th scope="row">Напиток</th>
            <td><?=$allSortedHouses['firstHouse']['drink']?></td>
            <td><?=$allSortedHouses['secondHouse']['drink']?></td>
            <td><?=$allSortedHouses['thirdHouse']['drink']?></td>
            <td><?=$allSortedHouses['fourthHouse']['drink']?></td>
            <td><?=$allSortedHouses['fifthHouse']['drink']?></td>
        </tr>
        <tr>
            <th scope="row">Сигареты</th>
            <td><?=$allSortedHouses['firstHouse']['cigarette']?></td>
            <td><?=$allSortedHouses['secondHouse']['cigarette']?></td>
            <td><?=$allSortedHouses['thirdHouse']['cigarette']?></td>
            <td><?=$allSortedHouses['fourthHouse']['cigarette']?></td>
            <td><?=$allSortedHouses['fifthHouse']['cigarette']?></td>
        </tr>
        <tr>
            <th scope="row">Животное</th>
            <td><?=$allSortedHouses['firstHouse']['pat']?></td>
            <td><?=$allSortedHouses['secondHouse']['pat']?></td>
            <td><?=$allSortedHouses['thirdHouse']['pat']?></td>
            <td><?=$allSortedHouses['fourthHouse']['pat']?></td>
            <td><?=$allSortedHouses['fifthHouse']['pat']?></td>
        </tr>
        </tbody>
    </table>
</table>
