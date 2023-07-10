<?php

use CodeIgniter\I18n\Time;

if (!function_exists('uniqueID')) {
    function uniqueID($key, $table, $field)
    {
        $db = \Config\Database::connect();
        $nourut = $db->table($table)
            ->select('RIGHT(' . $field . ', 4) AS nourut')
            ->orderBy($field, 'DESC')
            ->get()->getRowArray();
        if ($nourut) {
            $nourut = ((int) $nourut['nourut']) + 1;
            if ($nourut < 10) {
                $nourut = '000' . $nourut;
            } elseif ($nourut < 100) {
                $nourut = '00' . $nourut;
            } elseif ($nourut < 1000) {
                $nourut = '0' . $nourut;
            } elseif ($nourut < 10000) {
                $nourut = '' . $nourut;
            }
        } else {
            $nourut = '0001';
        }

        $tanggal = Time::now()->format('Ymd');
        return $key . $tanggal . $nourut;
    }
}
