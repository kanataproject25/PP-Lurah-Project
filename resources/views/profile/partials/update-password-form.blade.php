<div class="mb-5">
    <h4>Perbarui Password</h4>
    <p class="text-muted">
        Pastikan akun Anda menggunakan password yang panjang dan acak untuk menjaga keamanan.
    </p>

    <form method="POST" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">Password Saat Ini</label>
            <input
                type="password"
                name="current_password"
                id="current_password"
                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                autocomplete="current-password"
            >
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input
                type="password"
                name="password"
                id="password"
                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                autocomplete="new-password"
            >
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                autocomplete="new-password"
            >
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>

        @if (session('status') === 'password-updated')
            <div class="alert alert-success mt-3 mb-0 py-2 px-3">
                Password berhasil diperbarui.
            </div>
        @endif
    </form>
</div>
