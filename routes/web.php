<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Sktm;
use App\Http\Controllers\SduController;
use App\Http\Controllers\SdController;
use App\Http\Controllers\SkController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\SktmController;
use App\Models\ArsipLama;

// Halaman utama publik (sebelum login)
Route::get('/', function () {
    $beritas = App\Http\Controllers\Controller::getBeritaPublik();
    $galeris = App\Http\Controllers\Controller::getGaleriPublik();
    $prestasis = App\Http\Controllers\Controller::getPrestasiPublik();
    return view('home', compact('beritas', 'galeris', 'prestasis'));
})->name('home');

// Setelah login arahkan sesuai role
Route::get('/dashboard', function () {
    return redirect()->route('redirect.dashboard');
})->middleware(['auth'])->name('dashboard');

// Arahkan dashboard berdasarkan role
Route::middleware(['auth'])->get('/redirect-dashboard', function () {
    $user = Auth::user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->name('redirect.dashboard');

// Dashboard Admin (hanya view)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        $tahun = request('tahun', null);
        $bulan = request('bulan', null);
        
        $countSktm = \App\Models\Sktm::when($tahun, function($q) use ($tahun) { return $q->whereYear('created_at', $tahun); })
            ->when($bulan, function($q) use ($bulan) { return $q->whereMonth('created_at', $bulan); })
            ->count();
        $countSdu = \App\Models\Sdu::when($tahun, function($q) use ($tahun) { return $q->whereYear('created_at', $tahun); })
            ->when($bulan, function($q) use ($bulan) { return $q->whereMonth('created_at', $bulan); })
            ->count();
        $countSd = \App\Models\Sd::when($tahun, function($q) use ($tahun) { return $q->whereYear('created_at', $tahun); })
            ->when($bulan, function($q) use ($bulan) { return $q->whereMonth('created_at', $bulan); })
            ->count();
        $countSk = \App\Models\Sk::when($tahun, function($q) use ($tahun) { return $q->whereYear('created_at', $tahun); })
            ->when($bulan, function($q) use ($bulan) { return $q->whereMonth('created_at', $bulan); })
            ->count();
        $countSkbm = \App\Models\Skbm::when($tahun, function($q) use ($tahun) { return $q->whereYear('created_at', $tahun); })
            ->when($bulan, function($q) use ($bulan) { return $q->whereMonth('created_at', $bulan); })
            ->count();
        $countPrestasi = \App\Models\Prestasi::when($tahun, function($q) use ($tahun) { return $q->whereYear('created_at', $tahun); })
            ->when($bulan, function($q) use ($bulan) { return $q->whereMonth('created_at', $bulan); })
            ->count();
        // Gabungkan semua surat (untuk tabel/paginated)
        $allSurat = collect();
        $allSurat = $allSurat->concat(
            \App\Models\Sktm::whereIn('status', ['approved', 'rejected'])
                ->when($tahun, function($q) use ($tahun) { return $q->whereYear('created_at', $tahun); })
                ->when($bulan, function($q) use ($bulan) { return $q->whereMonth('created_at', $bulan); })
                ->select('id', 'nama', 'nik', 'created_at', 'pdf_path')
                ->addSelect(\DB::raw("'SKTM' as jenis"))
                ->get()
                ->map(function($item) { $item->arsip_lama = false; return $item; })
        );
        $allSurat = $allSurat->concat(
            \App\Models\Sdu::whereIn('status', ['approved', 'rejected'])
                ->when($tahun, function($q) use ($tahun) { return $q->whereYear('created_at', $tahun); })
                ->when($bulan, function($q) use ($bulan) { return $q->whereMonth('created_at', $bulan); })
                ->select('id', 'nama', \DB::raw('NULL as nik'), 'created_at', 'pdf_path')
                ->addSelect(\DB::raw("'SDU' as jenis"))
                ->get()
                ->map(function($item) { $item->arsip_lama = false; return $item; })
        );
        $allSurat = $allSurat->concat(
            \App\Models\Sd::whereIn('status', ['approved', 'rejected'])
                ->when($tahun, function($q) use ($tahun) { return $q->whereYear('created_at', $tahun); })
                ->when($bulan, function($q) use ($bulan) { return $q->whereMonth('created_at', $bulan); })
                ->select('id', 'nama', \DB::raw('NULL as nik'), 'created_at', 'pdf_path')
                ->addSelect(\DB::raw("'SD' as jenis"))
                ->get()
                ->map(function($item) { $item->arsip_lama = false; return $item; })
        );
        $allSurat = $allSurat->concat(
            \App\Models\Sk::whereIn('status', ['approved', 'rejected'])
                ->when($tahun, function($q) use ($tahun) { return $q->whereYear('created_at', $tahun); })
                ->when($bulan, function($q) use ($bulan) { return $q->whereMonth('created_at', $bulan); })
                ->select('id', 'nama', 'nik', 'created_at', 'pdf_path')
                ->addSelect(\DB::raw("'SK' as jenis"))
                ->get()
                ->map(function($item) { $item->arsip_lama = false; return $item; })
        );
        $allSurat = $allSurat->concat(
            \App\Models\Skbm::whereIn('status', ['approved', 'rejected'])
                ->when($tahun, function($q) use ($tahun) { return $q->whereYear('created_at', $tahun); })
                ->when($bulan, function($q) use ($bulan) { return $q->whereMonth('created_at', $bulan); })
                ->select('id', 'nama', 'nik', 'created_at', 'pdf_path')
                ->addSelect(\DB::raw("'SKBM' as jenis"))
                ->get()
                ->map(function($item) { $item->arsip_lama = false; return $item; })
        );
        $allSurat = $allSurat->concat(
            ArsipLama::select('id', 'nama', 'nik', 'tanggal_pengajuan as created_at', 'jenis_surat as jenis', 'file_pdf')
                ->get()
                ->map(function($item) {
                    $item->arsip_lama = true;
                    return $item;
                })
        );
        $allSurat = $allSurat->sortByDesc('created_at');
        if(request('jenis_surat')) {
            $allSurat = $allSurat->where('jenis', request('jenis_surat'));
        }
        if(request('nama')) {
            $allSurat = $allSurat->filter(function($item) {
                return stripos($item->nama, request('nama')) !== false;
            });
        }
        if(request('nik')) {
            $allSurat = $allSurat->filter(function($item) {
                return isset($item->nik) && stripos($item->nik, request('nik')) !== false;
            });
        }
        $page = request('page', 1);
        $perPage = request('perPage', 10);
        $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $allSurat->forPage($page, $perPage),
            $allSurat->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        return view('admin.dashboard', compact('countSktm', 'countSdu', 'countSd', 'countSk', 'countSkbm', 'countPrestasi', 'paginated'));
    })->name('admin.dashboard');
});

// Dashboard User (bisa diarahkan ke view khusus user)
Route::middleware(['auth'])->get('/user/dashboard', function () {
    $beritas = App\Http\Controllers\Controller::getBeritaPublik();
    $galeris = App\Http\Controllers\Controller::getGaleriPublik();
    $prestasis = App\Http\Controllers\Controller::getPrestasiPublik();
    return view('home', compact('beritas', 'galeris', 'prestasis'));
})->name('user.dashboard');

// Rute User (Profil, bisa diakses tanpa verified)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute User (Pengajuan Surat, hanya untuk user yang sudah verified)
Route::middleware(['auth', 'verified'])->group(function () {
    // SKTM User
    Route::get('/sktm/create', [App\Http\Controllers\SktmController::class, 'create'])->name('sktm.create');
    Route::post('/sktm', [App\Http\Controllers\SktmController::class, 'store'])->name('sktm.store');
    Route::get('/user/sktm', [App\Http\Controllers\SktmController::class, 'mySktm'])->name('user.sktm.index');
    Route::get('/user/sktm/{id}', [App\Http\Controllers\SktmController::class, 'show'])->name('sktm.show');
    Route::get('/user/sktm/{id}/download', [App\Http\Controllers\SktmController::class, 'download'])->name('user.sktm.download');

    // SDU User
    Route::get('/sdu/create', [SduController::class, 'create'])->name('sdu.create');
    Route::post('/sdu', [SduController::class, 'store'])->name('sdu.store');
    Route::get('/user/sdu', [SduController::class, 'index'])->name('sdu.index');
    Route::get('/user/sdu/{id}', [SduController::class, 'show'])->name('sdu.show');
    Route::delete('/user/sdu/{id}', [SduController::class, 'destroy'])->name('sdu.destroy');
    Route::get('/user/sdu/{id}/download', [App\Http\Controllers\SduController::class, 'download'])->name('user.sdu.download');

    // SD User
    Route::get('/sd/create', [SdController::class, 'create'])->name('sd.create');
    Route::post('/sd', [SdController::class, 'store'])->name('sd.store');
    Route::get('/user/sd', [SdController::class, 'index'])->name('sd.index');
    Route::get('/user/sd/{id}', [SdController::class, 'show'])->name('sd.show');
    Route::delete('/user/sd/{id}', [SdController::class, 'destroy'])->name('sd.destroy');
    Route::get('/user/sd/{id}/download', [App\Http\Controllers\SdController::class, 'download'])->name('user.sd.download');

    // SK User
    Route::get('/sk/create', [SkController::class, 'create'])->name('sk.create');
    Route::post('/sk', [SkController::class, 'store'])->name('sk.store');
    Route::get('/user/sk', [SkController::class, 'index'])->name('sk.index');
    Route::get('/user/sk/{id}', [SkController::class, 'show'])->name('sk.show');
    Route::delete('/user/sk/{id}', [SkController::class, 'destroy'])->name('sk.destroy');
    Route::get('/user/sk/{id}/download', [App\Http\Controllers\SkController::class, 'download'])->name('user.sk.download');

    // SKBM User
    Route::get('/skbm', [App\Http\Controllers\SkbmController::class, 'index'])->name('skbm.index');
    Route::get('/skbm/create', [App\Http\Controllers\SkbmController::class, 'create'])->name('skbm.create');
    Route::post('/skbm', [App\Http\Controllers\SkbmController::class, 'store'])->name('skbm.store');
    Route::get('/skbm/{id}', [App\Http\Controllers\SkbmController::class, 'show'])->name('skbm.show');
    Route::delete('/skbm/{id}', [App\Http\Controllers\SkbmController::class, 'destroy'])->name('skbm.destroy');
    Route::get('/skbm/{id}/download', [App\Http\Controllers\SkbmController::class, 'download'])->name('user.skbm.download');
});

// Rute Admin (Admin\SuratController & Admin\SktmController)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Surat
    Route::get('surat', [App\Http\Controllers\Admin\SuratController::class, 'index'])->name('surat.index');
    Route::post('arsip-lama/upload', [App\Http\Controllers\Admin\SuratController::class, 'uploadArsipLama'])->name('arsip-lama.upload');

    // SKTM Admin
    Route::get('surat/sktm', [App\Http\Controllers\Admin\SktmController::class, 'index'])->name('sktm.index');
    Route::get('surat/sktm/create', [App\Http\Controllers\Admin\SktmController::class, 'create'])->name('sktm.create');
    Route::post('surat/sktm', [App\Http\Controllers\Admin\SktmController::class, 'store'])->name('sktm.store');
    Route::get('surat/sktm/{sktm}', [App\Http\Controllers\Admin\SktmController::class, 'show'])->name('sktm.show');
    Route::get('surat/sktm/{sktm}/download', [App\Http\Controllers\Admin\SktmController::class, 'download'])->name('sktm.download');
    Route::post('surat/sktm/{sktm}/approve', [App\Http\Controllers\Admin\SktmController::class, 'approve'])->name('sktm.approve');
    Route::post('surat/sktm/{sktm}/reject', [App\Http\Controllers\Admin\SktmController::class, 'reject'])->name('sktm.reject');

    // SDU Admin
    Route::get('surat/sdu/create', [App\Http\Controllers\Admin\SduController::class, 'create'])->name('sdu.create');
    Route::get('surat/sdu/{sdu}', [App\Http\Controllers\Admin\SduController::class, 'show'])->name('sdu.show');
    Route::get('surat/sdu/{sdu}/download', [App\Http\Controllers\Admin\SduController::class, 'download'])->name('sdu.download');
    Route::post('surat/sdu/{sdu}/approve', [App\Http\Controllers\Admin\SduController::class, 'approve'])->name('sdu.approve');
    Route::post('surat/sdu/{sdu}/reject', [App\Http\Controllers\Admin\SduController::class, 'reject'])->name('sdu.reject');
    Route::get('surat/sdu', [App\Http\Controllers\Admin\SduController::class, 'index'])->name('sdu.index');
    Route::post('surat/sdu', [App\Http\Controllers\Admin\SduController::class, 'store'])->name('sdu.store');

    // SD Admin
    Route::get('surat/sd/create', [App\Http\Controllers\Admin\SdController::class, 'create'])->name('sd.create');
    Route::get('surat/sd/{sd}', [App\Http\Controllers\Admin\SdController::class, 'show'])->name('sd.show');
    Route::get('surat/sd/{sd}/download', [App\Http\Controllers\Admin\SdController::class, 'download'])->name('sd.download');
    Route::post('surat/sd/{sd}/approve', [App\Http\Controllers\Admin\SdController::class, 'approve'])->name('sd.approve');
    Route::post('surat/sd/{sd}/reject', [App\Http\Controllers\Admin\SdController::class, 'reject'])->name('sd.reject');
    Route::get('surat/sd', [App\Http\Controllers\Admin\SdController::class, 'index'])->name('sd.index');
    Route::post('surat/sd', [App\Http\Controllers\Admin\SdController::class, 'store'])->name('sd.store');

    // SK Admin
    Route::get('surat/sk/create', [App\Http\Controllers\Admin\SkController::class, 'create'])->name('sk.create');
    Route::get('surat/sk/{sk}', [App\Http\Controllers\Admin\SkController::class, 'show'])->name('sk.show');
    Route::get('surat/sk/{sk}/download', [App\Http\Controllers\Admin\SkController::class, 'download'])->name('sk.download');
    Route::post('surat/sk/{sk}/approve', [App\Http\Controllers\Admin\SkController::class, 'approve'])->name('sk.approve');
    Route::post('surat/sk/{sk}/reject', [App\Http\Controllers\Admin\SkController::class, 'reject'])->name('sk.reject');
    Route::get('surat/sk', [App\Http\Controllers\Admin\SkController::class, 'index'])->name('sk.index');
    Route::post('surat/sk', [App\Http\Controllers\Admin\SkController::class, 'store'])->name('sk.store');
    Route::get('/admin/sk/kematian/{id}/cetak', [App\Http\Controllers\Admin\SkController::class, 'cetakKematian'])->name('sk.kematian.cetak');

    // SKBM Admin
    Route::get('surat/skbm', [App\Http\Controllers\Admin\SkbmController::class, 'index'])->name('skbm.index');
    Route::get('surat/skbm/create', [App\Http\Controllers\Admin\SkbmController::class, 'create'])->name('skbm.create');
    Route::post('surat/skbm', [App\Http\Controllers\Admin\SkbmController::class, 'store'])->name('skbm.store');
    Route::get('surat/skbm/{skbm}', [App\Http\Controllers\Admin\SkbmController::class, 'show'])->name('skbm.show');
    Route::get('surat/skbm/{skbm}/download', [App\Http\Controllers\Admin\SkbmController::class, 'download'])->name('skbm.download');
    Route::post('surat/skbm/{skbm}/approve', [App\Http\Controllers\Admin\SkbmController::class, 'approve'])->name('skbm.approve');
    Route::post('surat/skbm/{skbm}/reject', [App\Http\Controllers\Admin\SkbmController::class, 'reject'])->name('skbm.reject');
    Route::get('surat/skbm/{skbm}/detail', [App\Http\Controllers\Admin\SkbmController::class, 'show'])->name('skbm.detail');

    Route::resource('berita', App\Http\Controllers\Admin\BeritaController::class);
    Route::resource('galeri', App\Http\Controllers\Admin\GaleriController::class);
    Route::resource('prestasi', App\Http\Controllers\Admin\PrestasiController::class);
    Route::delete('surat/delete/{jenis}/{id}', [App\Http\Controllers\Admin\SuratController::class, 'delete'])->name('surat.delete');
    Route::delete('arsip-lama/delete/{id}', [App\Http\Controllers\Admin\SuratController::class, 'deleteArsipLama'])->name('arsip-lama.delete');
    Route::get('arsip-lama/{id}/download', [App\Http\Controllers\Admin\SuratController::class, 'downloadArsipLama'])->name('arsip-lama.download');
});

// Route export laporan pengajuan surat (admin)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('laporan/export', [App\Http\Controllers\Admin\LaporanController::class, 'export'])->name('laporan.export');
});

require __DIR__.'/auth.php';

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Route test untuk cek middleware verified
Route::middleware(['auth', 'verified'])->get('/test-verified', function () {
    return 'Kamu sudah verifikasi email!';
});

Route::get('/verifikasi/surat/{id}', [App\Http\Controllers\SktmController::class, 'verifikasi'])->name('verifikasi.surat');
Route::post('/kirim-pesan', [App\Http\Controllers\ContactController::class, 'send'])->name('kirim.pesan');
