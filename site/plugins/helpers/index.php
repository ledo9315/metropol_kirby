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
        '01' => 'Januar',
        '02' => 'Februar',
        '03' => 'März',
        '04' => 'April',
        '05' => 'Mai',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'August',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Dezember'
    ];

    $weekdays = [
        'Mon' => 'Montag',
        'Tue' => 'Dienstag',
        'Wed' => 'Mittwoch',
        'Thu' => 'Donnerstag',
        'Fri' => 'Freitag',
        'Sat' => 'Samstag',
        'Sun' => 'Sonntag'
    ];

    $isToday = $date == $today;
    $isTomorrow = $date == $tomorrow;

    if ($isToday) {
        $dateDisplay = 'Heute';
    } else if ($isTomorrow) {
        $dateDisplay = 'Morgen';
    } else {
        $weekday = $weekdays[date('D', strtotime($dateKey))];
        $dateDisplay = $weekday;
    }

    return [
        'display' => $dateDisplay,
        'isToday' => $isToday,
        'isTomorrow' => $isTomorrow
    ];
}