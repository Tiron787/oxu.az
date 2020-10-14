<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('content-type: text/html; charset=utf-8');


/*
1 Переключатель времени обновления страницы
2 Переключатель звукового сопровождения
3 Количество новостей с текустом о ...
4 Частота выходов новостей 20мин.-2часа-3-5...
5 Количество символов в новости.
*/


include '../library/phpQuery.php';
include '../database/queryBuilder.php';
include '../phpquery/pars.php';
include '../phpquery/parsOneNews.php';


//интервал секунд. равный часу
$FixTimeInterval = 3600;
//создаём новый экземпляр класса queryBuilder

//название таблицы
$table = 'oxu_news';
//текущее время unix
$UNIX = time();
//$date = date('');
$date = date("m.d.y h:i ");

$howManyCharacters = iconv_strlen($oneNewsText) - 338;
$db = new queryBuilder($dsn, $user, $password);
$tasks = $db->getAll($table);

$difference = CheekDifferenceB($tasks, $minute);


$data =
    [
        "news" => $news,
        "hour" => $hour,
        "minute" => $minute,
        "year" => $year,
        "mouth" => $mouth,
        "day" => $day,
        "difference" => $difference,
        "UNIX" => $UNIX,
        "newsLink" => $newsLink,
        "Characters" => $howManyCharacters,
        "date" => $date

    ];
addNewNews($table, $data, $tasks, $db);
function CheekDifferenceB($oldMin, $lastMin)
{           //вычесляем разницу между новостями
    if ($lastMin < $oldMin[0]['minute']) {
        $var = 60 - $oldMin[0]['minute'];
        $result = $var + $lastMin;
    } else {
        $result = $lastMin - $oldMin[0]['minute'];
    }
    return $result;
}

function addNewNews($table, $data, $tasks, $db)
{
    $lastBaseNews = $tasks[0]['hour'] . $tasks[0]['minute'];
    $NewsRelease = $data ['hour'] . $data ['minute'];
    if (strcmp($lastBaseNews, $NewsRelease) !== 0) {
        $db->store($data, $table);

    }
}

function timeTrim($UnixTime, $interval)
{  //вычесляем интервал, отнимаем от текущего времени unix Фиксированый интервал.
    return $result = $UnixTime - $interval;
}


//заносим интервал в переменную $ResultInterval
$ResultInterval = timeTrim($UNIX, $FixTimeInterval);
//выбираем из базы поля которые меньше текущего времени - (1 час)
$NewsCount = ($db->getSpecialTime($table, $ResultInterval));
//получаем колличество вернувшихся полей UNIX из базы, получаем количество новостей в час
$HowManyNews = count($NewsCount);


//обращаемся к методу queryBuilder
$average = $db->getAverageTime($table, $ResultInterval);
//считаем Среднее время выхода новостей за последний
function getAverageMin($average)
{
    $coin = count($average);  //считаем колличество новостей
    $sum = 0;
    foreach ($average as $value) {
        $sum += $value['difference'];
    }
    $text = $sum / $coin; // делим сумму новостей на колличество новостей
    $result = mb_eregi_replace("(.*)[^.]{12}$", '\\1', $text); //отрезаем 12 символов с конца


    return $result;
}

$averageNews = getAverageMin($average);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/style.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['minute', 'интервал'],
                [0, <?=$tasks[0]['difference']?>],
                [1, <?=$tasks[1]['difference']?>],
                [2, <?=$tasks[2]['difference']?>],
                [3, <?=$tasks[3]['difference']?>],
                [4, <?=$tasks[4]['difference']?>],
                [5, <?=$tasks[5]['difference']?>],
                [6, <?=$tasks[6]['difference']?>],
                [7, <?=$tasks[7]['difference']?>],
                [8, <?=$tasks[8]['difference']?>],
                [9, <?=$tasks[9]['difference']?>],
                [10, <?=$tasks[10]['difference']?>],
                [11, <?=$tasks[11]['difference']?>],
                [12, <?=$tasks[12]['difference']?>],
                [13, <?=$tasks[13]['difference']?>],
                [14, <?=$tasks[14]['difference']?>],
                [15, <?=$tasks[15]['difference']?>],
                [16, <?=$tasks[16]['difference']?>],
                [17, <?=$tasks[17]['difference']?>],
                [18, <?=$tasks[18]['difference']?>],
                [19, <?=$tasks[19]['difference']?>],
                [20, <?=$tasks[20]['difference']?>],


            ]);

            var options = {
                title: 'График нагрузки',
                hAxis: {title: 'количество новостей', titleTextStyle: {color: '#333'}},
                vAxis: {title: 'частота минут', minValue: 0}
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>

    <!--автообновление-->
    <meta http-equiv="Refresh" content="30"/>
    <title>oxu.az voice control</title>
</head>
<body>

<!--<script src="https://cdn.anychart.com/js/latest/anychart-bundle.min.js"></script>
<script src="../Chart/LineChart.js"></script>-->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="display-5">oxu.az voice control</h3>
            <h5 class="display-5">Колличество новостей за последний час: '<? echo $HowManyNews ?>' </h5>
            <h5 class="display-5">Среднее время выхода новостей за последний час: '<? echo $averageNews ?>' мин.</h5>
            <div id="chart_div" style="width: 100%; height: 300px;"></div>
            <table class="table table-inverse">
                <thead>
                <tr>
                    <th>news</th>
                    <th>link</th>
                    <th>Время(Az)</th>
                    <th>Дата(Az)</th>
                    <th>symbol</th>
                    <th>interval(мин.)</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>

                        <td><?= $task['news']; ?></td>
                        <td><p><a href="<?= 'https://ru.oxu.az/' . $task['newsLink'] ?>">Link</a>
                        <td><?= $task['hour'] . ':' ?><?= (iconv_strlen($task['minute']) >= 2) ? $task['minute'] : '0' . $task['minute']; ?></td>
                        <td><?= $task['day'] . '.' . $task ['mouth'] . '.' . $task['year'] ?></td>
                        <td><?= $task['Characters']; ?></td>
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

?>


