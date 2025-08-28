<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengajuanSuratExport;

class LaporanController extends Controller
{
    public function export(Request $request)
    {
        return Excel::download(new PengajuanSuratExport($request), 'laporan_pengajuan_surat.xlsx');
    }
} 