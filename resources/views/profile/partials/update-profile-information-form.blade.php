<div class="mb-5">
    <h4>Informasi Profil</h4>
    <p class="text-muted">
        Perbarui informasi akun dan alamat email Anda.
    </p>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="form-control @error('name') is-invalid @enderror"
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="form-control @error('email') is-invalid @enderror"
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-warning">
                        Alamat email Anda belum diverifikasi.
                        <button form="send-verification" class="btn btn-link p-0 align-baseline">
                            Klik di sini untuk mengirim ulang verifikasi.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success text-sm mt-1">
                            Tautan verifikasi baru telah dikirim ke email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mt-4 d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">Simpan</button>

            @if (session('status') === 'profile-updated')
                <p class="text-success mb-0">Berhasil disimpan.</p>
            @endif
        </div>
    </form>
</div>
