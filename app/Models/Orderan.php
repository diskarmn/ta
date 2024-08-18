<?php

namespace App\Models;

class Orderan
{
    private static $semuaorder = 'cs-dashboard.semua-orderan'; // Nama view file

    public static function all()
    {
        return view(self::$semuaorder, ["title" => "Daftar semua Order"]);
    }

    public static function blmproses(){

    }
}

