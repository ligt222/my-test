<?php
    function trim_p($str) {
        if (strpos($str, '{}') !== false || strpos($str, '()') !== false || strpos($str, '[]') !== false) {
            $str = preg_replace('/{}/', '', $str);
            $str = preg_replace('/\(\)/', '', $str);
            $str = preg_replace('/\[\]/', '', $str);
        } else return $str;

        return trim_p($str);
    }

    function isCorrect($str) {
        $str = preg_replace('|[^{}()[]]|', '', $str);
        if (strlen($str) % 2 != 0) return false;
        $str = trim_p($str);
        if (!empty($str)) {
            return false;
        } else return true;
    }

    $str = '';
    if (isCorrect($str)) {
        echo 'строка коректна';
    } else echo 'строка НЕ коректна';
?>