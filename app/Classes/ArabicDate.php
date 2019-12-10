<?php

namespace App\Classes;

class ArabicDate {

    static function GetDate($your_date)
    {
        $months = array("Jan" => "يناير", "Feb" => "فبراير", "Mar" => "مارس", "Apr" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "Jul" => "يوليو", "Aug" => "أغسطس", "Sep" => "سبتمبر", "Oct" => "أكتوبر", "Nov" => "نوفمبر", "Dec" => "ديسمبر");
        //$your_date = date('y-m-d'); // The Current Date
        $en_month = date("M", strtotime($your_date));
        foreach ($months as $en => $ar) {
            if ($en == $en_month) { $ar_month = $ar; }
        }

        $find = array ("Sat", "Sun", "Mon", "Tue", "Wed" , "Thu", "Fri");
        $replace = array ("السبت", "الأحد", "الإثنين", "الثلاثاء", "الأربعاء", "الخميس", "الجمعة");
        $ar_day_format = date("D", strtotime($your_date)); // The Current Day
        $ar_day = str_replace($find, $replace, $ar_day_format);

        header('Content-Type: text/html; charset=utf-8');
        $standard = array("0","1","2","3","4","5","6","7","8","9");
        $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
        //$current_date = $ar_day.' '.date('d', strtotime($your_date)).' / '.$ar_month.' / '.date('Y', strtotime($your_date));
        $current_date = date('d', strtotime($your_date)).' '.$ar_month.' '.date('Y', strtotime($your_date));
        $arabic_date = str_replace($standard , $eastern_arabic_symbols , $current_date);

        return $arabic_date;
    }

    static function TimeElapsed($time_ago, $full = false) {
        $time_ago = strtotime($time_ago);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );
        // Seconds
        if($seconds <= 60){
            return "منذ لحظات";
        }
        //Minutes
        else if($minutes <=60){
            if($minutes==1){
                return "منذ دقيقة واحدة";
            }
            elseif($minutes<10){
                return "منذ $minutes دقائق مضت";
            }
            else{
                return "منذ $minutes دقيقة مضت";
            }
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "منذ ساعة مضت";
            }else{
                return "منذ $hours ساعات مضت";
            }
        }
        //Days
        else if($days <= 7){
            if($days==1){
                return "بالأمس";
            }else{
                return "من $days أيام مضت";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                return "منذ أسبوع";
            }else{
                return "منذ $weeks أسابيع مضت";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "منذ شهر";
            }else{
                return "منذ $months شهور مضت";
            }
        }
        //Years
        else{
            if($years==1){
                return "منذ عام";
            }else{
                return "منذ $years أعوام مضت";
            }
        }
    }
}