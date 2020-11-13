<?php

function timezone_list()
{
    static $timezones = null;

    if ($timezones === null) {
        $timezones = [];
        $offsets = [];
        $now = new DateTime('now', new DateTimeZone('UTC'));

        foreach (DateTimeZone::listIdentifiers() as $timezone) {
            $now->setTimezone(new DateTimeZone($timezone));
            $offsets[] = $offset = $now->getOffset();
            // $timezones[$timezone] = '(' . format_GMT_offset($offset) . ') ' . format_timezone_name($timezone);
            $timezones[$timezone] = [
                'title' => [
                    'offset' => format_GMT_offset($offset),
                    'name' => format_timezone_name($timezone)
                ],
                'value' => [
                    'offset' => $offset
                ]
            ];
        }

        array_multisort($offsets, $timezones);
    }

    return $timezones;
}

function format_GMT_offset($offset)
{
    $hours = intval($offset / 3600);
    $minutes = abs(intval($offset % 3600 / 60));
    return 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
}

function format_timezone_name($name)
{
    $name = str_replace('/', ', ', $name);
    $name = str_replace('_', ' ', $name);
    $name = str_replace('St ', 'St. ', $name);
    return $name;
}

function get_timezone_date($date)
{
    if (isset($_SESSION['timezone_offset'])) {
        $offset = $_SESSION['timezone_offset']; //+08:00 > 28800
        return date('Y-m-d H:i:s', strtotime($date) + $offset);
    } else {
        return false;
    }
}

function get_utc_date($date)
{
    if (isset($_SESSION['timezone_offset'])) {
        $offset = $_SESSION['timezone_offset']; //+08:00 > 28800
        return date('Y-m-d H:i:s', strtotime($date) - $offset);
    } else {
        return false;
    }
}

function get_offset()
{
    if (isset($_SESSION['timezone_offset'])) {
        return $_SESSION['timezone_offset']; //+08:00 > 28800
    } else {
        return 0;
    }
}