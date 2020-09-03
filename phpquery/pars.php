<?php
$url = 'https://ru.oxu.az/';
$file = file_get_contents($url);
$doc = phpQuery::newDocument($file);
//парсим из страницы содержимое
//test !!!



function getLink($link)
{
    //return $link->find('')->text();
}

function getYear($years)
{
    $y = $years->find('.date-year')->text();

    $year = strtok($y, " \n");
    return $year;

}

function getTitle($title)
{
    return $title = $title->find('.title')->text();
}

function getDay($days)
{
    $day = $days->find('.date-day')->text();
    return $OneDay = strtok($day, " \n");
}

function getMonth($mounts)
{
    $dateMonth = $mounts->find('.date-month')->text();
    $mou = strtok($dateMonth, " \n");   //strtok() разбивает строку str на подстроки (токены),
    $mouth = mb_substr("$mou", 0, 3);


    function mouthSwish($mouthName)
    {
        $mouth = 0;
        switch ($mouthName) {
            case 'янв':
                $mouth = 1;
                break;
            case 'фев':
                $mouth = 2;
                break;
            case 'мар':
                $mouth = 3;
                break;
            case 'апр':
                $mouth = 4;
                break;
            case 'мая':
                $mouth = 5;
                break;
            case 'июн':
                $mouth = 6;
                break;
            case 'июл':
                $mouth = 7;
                break;
            case 'авг':
                $mouth = 8;
                break;
            case 'сен':
                $mouth = 9;
                break;
            case 'окт':
                $mouth = 10;
                break;
            case 'ноя':
                $mouth = 11;
                break;
            case 'дек':
                $mouth = 12;
                break;
            default :
                $mouth = 0;

        }
        return $mouth;
    }

    return $mouthNumber = mouthSwish($mouth);

}

function getTimeSplit($doc)
{
    $time = $doc->find('.when-time')->text();
    $OneNews = str_split($time, 6);
    return $value = (explode(":", $OneNews[0]));
}
$newsAll = getTitle($doc);
$news = mb_strimwidth($newsAll, 0, 70, "...");
$day = (int)getDay($doc);
$mouth = (string)getMonth($doc);
$year = (int)getYear($doc);
$hour = (int)getTimeSplit($doc)[0];
$minute = (int)getTimeSplit($doc)[1];
//$getLink = getLink($doc);



//
/*$data =
    [
        "news" => $news,
        "hour" => $day,
        "minute" => $minute,
        "year" => $year,
        "mouth"=> $mouth,
        "day"=> $day
    ];*/


//var_dump($news,$day,$mouth,$year,$hour,$minute);
/*if (!isset($news,$day,$mouth,$year,$hour,$minute)) {
    echo 'parse ok';
} else {
    echo 'parse error';
}*/

