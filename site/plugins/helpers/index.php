<?php

function getFilmCategories($film)
{
    $categories = [];

    if ($film->familienfilm()->isTrue())
        $categories[] = 'Familienfilm';
    if ($film->animation()->isTrue())
        $categories[] = 'Animation';
    if ($film->fantasy()->isTrue())
        $categories[] = 'Fantasy';
    if ($film->liebesfilm()->isTrue())
        $categories[] = 'Liebesfilm';
    if ($film->maerchenfilm()->isTrue())
        $categories[] = 'Märchenfilm';
    if ($film->musical()->isTrue())
        $categories[] = 'Musical';
    if ($film->kinderfilm()->isTrue())
        $categories[] = 'Kinderfilm';
    if ($film->drama()->isTrue())
        $categories[] = 'Drama';
    if ($film->komoedie()->isTrue())
        $categories[] = 'Komödie';
    if ($film->action()->isTrue())
        $categories[] = 'Action';
    if ($film->abenteuer()->isTrue())
        $categories[] = 'Abenteuer';
    if ($film->horror()->isTrue())
        $categories[] = 'Horror';

    return $categories;
}

function formatSpielzeiten($spielzeiten)
{
    $spielzeitenByDate = [];

    foreach ($spielzeiten as $spielzeit) {
        $spielzeitTimestamp = strtotime($spielzeit->date() . ' ' . $spielzeit->time());
        if ($spielzeitTimestamp < time()) {
            continue;
        }

        $dateKey = $spielzeit->date()->toDate('Y-m-d');
        if (!isset($spielzeitenByDate[$dateKey])) {
            $spielzeitenByDate[$dateKey] = [];
        }

        $spielzeitenByDate[$dateKey][] = $spielzeit;
    }

    return $spielzeitenByDate;
}

function getDateDisplay($dateKey)
{
    $date = date('d.m.Y', strtotime($dateKey));
    $today = date('d.m.Y');
    $tomorrow = date('d.m.Y', strtotime('+1 day'));

    $months = [
        '01' => 'JAN',
        '02' => 'FEB',
        '03' => 'MÄR',
        '04' => 'APR',
        '05' => 'MAI',
        '06' => 'JUN',
        '07' => 'JUL',
        '08' => 'AUG',
        '09' => 'SEP',
        '10' => 'OKT',
        '11' => 'NOV',
        '12' => 'DEZ'
    ];

    $weekdays = [
        'Mon' => 'MO',
        'Tue' => 'DI',
        'Wed' => 'MI',
        'Thu' => 'DO',
        'Fri' => 'FR',
        'Sat' => 'SA',
        'Sun' => 'SO'
    ];

    $weekday = $weekdays[date('D', strtotime($dateKey))];
    $monthKey = date('m', strtotime($dateKey));
    $dateDisplay = $weekday . '. (' . date('d', strtotime($dateKey)) . ' ' . $months[$monthKey] . '.)';

    $isToday = $date == $today;
    $isTomorrow = $date == $tomorrow;

    return [
        'display' => $dateDisplay,
        'isToday' => $isToday,
        'isTomorrow' => $isTomorrow
    ];
}