<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public static function getBeritaPublik()
    {
        return \App\Models\Berita::orderBy('tanggal', 'desc')->take(12)->get();
    }

    public static function getGaleriPublik()
    {
        return \App\Models\Galeri::orderBy('tanggal', 'desc')->take(12)->get();
    }

    public static function getPrestasiPublik()
    {
        return \App\Models\Prestasi::orderBy('tahun', 'desc')->get();
    }
}
