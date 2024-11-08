<?php

namespace App\Helpers;

class DateHelper
{
    public static function getMonthName($date) {
        $date = date_create($date);
        $month = date_format($date,"n");
        $day = date_format($date,"d");
        $year = date_format($date,"Y");
        $name = array (1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
        return $day.' '.$name[$month].' '.$year;
    }

    public static function getShortMonthName($date) {
        $date = date_create($date);
        $month = date_format($date,"n");
        $day = date_format($date,"d");
        $year = date_format($date,"y");
        $name = array (1 =>   'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt','Nov','Des');
        return $day.' '.$name[$month].' '.$year;
    }
}