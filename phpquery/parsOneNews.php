<?php
include_once '../library/phpQuery.php';
include_once '../phpquery/pars.php';

$url = 'https://ru.oxu.az' . $newsLink;
$file = file_get_contents($url);
$doc = phpQuery::newDocument($file);


function getOneNewsText($link)
{
    $pq = pq($link);
    return $pq->find('.news-inner')->text();


}

$oneNewsText = getOneNewsText($doc);




