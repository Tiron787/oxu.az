<?php
/*
1 Переключатель времени обновления страницы
2 Переключатель звукового сопровождения
3 Количество новостей с текустом о ...
4 Частота выходов новостей 20мин.-2часа-3-5...
5 Количество символов в новости.
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('content-type: text/html; charset=utf-8');

include '../library/phpQuery.php';
include '../database/queryBuilder.php';
include '../phpquery/pars.php';



$db = new queryBuilder($dsn, $user, $password);

$table = 'oxu_news';
$UNIX = time();

$tasks = $db->getAll($table);
$difference = CheekDifference($tasks, $UNIX);
$data =
    [
        "news" => $news,
        "hour" => $hour,
        "minute" => $minute,
        "year" => $year,
        "mouth" => $mouth,
        "day" => $day,
        "difference" => $difference,
        "UNIX" => $UNIX

    ];


$lastBaseNews = $tasks[0]['hour'] . $tasks[0]['minute'];
$NewsRelease = $data ['hour'] . $data ['minute'];
if (strcmp($lastBaseNews, $NewsRelease) !== 0) {
    $db->store($data);
    echo $sound = '/www/action.od.ua/oxu.az/content/s.mp3';

    $audio = "";

    echo $audio;
}

function CheekDifference($lastTime, $timeNow)
{
    $sec = $timeNow - $lastTime[0]['UNIX'];
    return $minutes = floor($sec / 60);
}


$interval = 3600;

function timeTrim($time, $interval)
{
    return $result = $time - $interval;

}

$result = timeTrim($UNIX, $interval);
$NewsCount = ($db->getSpecialTime($table, $result));
$HowManyNews = count($NewsCount);

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
              crossorigin="anonymous">

        <!--автообновление-->
        <meta http-equiv="Refresh" content="30"/>
        <title>oxu.az voice control</title>
    </head>


    <body>
    <h5 class="display-5">oxu.az voice control</h5>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <h5 class="display-4">Amount of news per hour </h5>
                <h5 class="display-4">&nbsp;'<? echo $HowManyNews ?>'</h5>

            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <table class="table table-inverse">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>news</th>
                        <th>hour (Az)</th>
                        <th>minute</th>
                        <th>day</th>
                        <th>mouth</th>
                        <th>interval</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?= $task['id']; ?></td>
                            <td><?= $task['news']; ?></td>
                            <td><?= $task['hour']; ?></td>
                            <td><?= (iconv_strlen($task['minute']) >= 2) ? $task['minute'] : '0' . $task['minute'] ?></td>
                            <td><?= $task['day']; ?></td>
                            <td><?= $task['mouth']; ?></td>

                            <td><?= $task['difference']; ?></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    </html>

<?php
/*if ($NewsRelease !== $NewsRelease) {

} else {
    exit;
}*/
?>


<?php
/*function time($h,$m){

}
time();*/
/*foreach ($time2 as $key => $value){
/*
$time1[$key]  = $value;
print_r($time1['2']);
}*/

/*

$day = str_split($time1, 2);
//$arr1 = str_split($time1);
echo "<br>";
echo '<pre>';
print_r($time1[1]);
echo '</pre>';*/

//print_r($arr1);
/*foreach ($arr1 as $value){
    $second[] = mktime(2, 4, 0, 7, 20, 2020);

    var_dump($second);

}*/
//


//parse_str($dateDay, $output)


//$date[] = $dateDay;


/*  foreach($date as $value) {

      print_r($second);

  }*/

//$minute = $second / 60;

/*function getSecond($hour, $minute, $month, $day, $month, $day)
{

    echo $minute;
getSecond($one_news_time);
}*/

/*$ent = pq($row);
$name = $ent->text();

$data['breadcrumbs'][$name] = $url;*/

/*
echo '<pre>';
print_r($one_news_time);
echo '</pre>';*/


/*;*/

//вырезаем 6 символов из строки и зансим их в массив каждый с отдельными
// индексами


/*getSecond($hour);
echo "<br>";
print_r(hour($one_news_time));
echo 'Сейчас:' . date('d-m-Y') . "\n";*/


/*foreach ($one_news_time as $value ){




}

}
function minute($one_news_time)
{
    $m = $one_news_time['0'];
}


//print_r (hour($one_news_time)) ;
echo "<br>";
//возвращаем



//getSecond();



//$difference
//$str = $doc->find('#selectByPb div:')->text();
//var_dump($pieces);
//$time = explode(" ", $pieces);

echo "<br>";


//echo time('h-m');
//print_r(date_parse("2006-12-12 10:00:00.5"));


//list($var1, $var2, $var3) = explode(" ", $result);
//echo $var1; // foo
//echo $var2; // **/


//echo htmlspecialchars($article_time);
/*$one = 2;
$two = 5;
function  one_and_two($one,$two)
{ global  $sum;
    global $min;
    global $prod;
    $sum = $one + $two;
    $min = $one - $two;
    $prod = $one * $two;*/
?>