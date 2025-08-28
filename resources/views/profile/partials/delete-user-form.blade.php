<div class="mb-4">
    <h4 class="text-danger">Hapus Akun</h4>
    <p class="text-muted">
        Setelah akun Anda dihapus, semua data akan hilang secara permanen. Pastikan Anda sudah mencadangkan data penting.
    </p>

    <!-- Tombol trigger modal -->
    <button type="button" class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
        Hapus Akun
    </button>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')

        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p>
                    Apakah Anda yakin ingin menghapus akun ini? Semua data akan dihapus secara permanen.
                </p>

                <div class="mb-3">
                    <label for="password" class="form-label">Masukkan Password untuk konfirmasi:</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                        placeholder="Password"
                        required
                    >
                    @error('password', 'userDeletion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Hapus Akun</button>
            </div>
        </div>
    </form>
  </div>
</div>
