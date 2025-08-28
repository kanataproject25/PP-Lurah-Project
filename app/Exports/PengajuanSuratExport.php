<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\Sktm;
use App\Models\Skbm;
use App\Models\Sk;
use App\Models\Sd;
use App\Models\Sdu;
use App\Models\ArsipLama;

class PengajuanSuratExport implements FromCollection, WithHeadings, Responsable
{
    use \Maatwebsite\Excel\Concerns\Exportable;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $data = collect();
        // Gabungkan semua surat sesuai filter
        $jenis = $this->request->jenis_surat;
        $nama = $this->request->nama;
        $nik = $this->request->nik;
        $tanggal = $this->request->tanggal;

        // Helper untuk filter
        $filter = function($query) use ($nama, $nik, $tanggal) {
            if ($nama) $query->where('nama', 'like', "%$nama%");
            if ($nik) $query->where('nik', 'like', "%$nik%");
            if ($tanggal) $query->whereDate('created_at', $tanggal);
        };

        if (!$jenis || $jenis == 'SKTM') {
            $q = Sktm::query()->whereIn('status', ['approved', 'rejected']); $filter($q);
            foreach ($q->get() as $item) {
                $data->push([
                    'SKTM', $item->nama, $item->nik, optional($item->created_at)->format('d/m/Y'), ucfirst($item->status ?? '-')
                ]);
            }
        }
        if (!$jenis || $jenis == 'SKBM') {
            $q = Skbm::query()->whereIn('status', ['approved', 'rejected']); $filter($q);
            foreach ($q->get() as $item) {
                $data->push([
                    'SKBM', $item->nama, $item->nik, optional($item->created_at)->format('d/m/Y'), ucfirst($item->status ?? '-')
                ]);
            }
        }
        if (!$jenis || $jenis == 'SK') {
            $q = Sk::query()->whereIn('status', ['approved', 'rejected']); $filter($q);
            foreach ($q->get() as $item) {
                $data->push([
                    'SK', $item->nama, $item->nik, optional($item->created_at)->format('d/m/Y'), ucfirst($item->status ?? '-')
                ]);
            }
        }
        if (!$jenis || $jenis == 'SD') {
            $q = Sd::query()->whereIn('status', ['approved', 'rejected']); $filter($q);
            foreach ($q->get() as $item) {
                $data->push([
                    'SD', $item->nama, $item->nik, optional($item->created_at)->format('d/m/Y'), ucfirst($item->status ?? '-')
                ]);
            }
        }
        if (!$jenis || $jenis == 'SDU') {
            $q = Sdu::query()->whereIn('status', ['approved', 'rejected']); $filter($q);
            foreach ($q->get() as $item) {
                $data->push([
                    'SDU', $item->nama, $item->nik, optional($item->created_at)->format('d/m/Y'), ucfirst($item->status ?? '-')
                ]);
            }
        }
        // Tambahkan arsip lama
        $arsipLama = ArsipLama::query();
        if ($jenis) $arsipLama->where('jenis_surat', $jenis);
        if ($nama) $arsipLama->where('nama', 'like', "%$nama%");
        if ($nik) $arsipLama->where('nik', 'like', "%$nik%");
        if ($tanggal) $arsipLama->whereDate('tanggal_pengajuan', $tanggal);
        foreach ($arsipLama->get() as $arsip) {
            $data->push([
                $arsip->jenis_surat, $arsip->nama, $arsip->nik, optional($arsip->tanggal_pengajuan)->format('d/m/Y'), 'Arsip Lama'
            ]);
        }
        return $data;
    }

    public function headings(): array
    {
        return ['Jenis Surat', 'Nama', 'NIK', 'Tanggal Pengajuan', 'Status'];
    }
} 