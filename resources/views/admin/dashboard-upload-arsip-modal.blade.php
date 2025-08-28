<div class="modal fade" id="modalUploadArsipLama" tabindex="-1" aria-labelledby="modalUploadArsipLamaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.arsip-lama.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}">
        <div class="modal-header">
          <h5 class="modal-title" id="modalUploadArsipLamaLabel">Upload Arsip Lama</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="arsip_nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="arsip_nama" name="nama" required>
          </div>
          <div class="mb-3">
            <label for="arsip_nik" class="form-label">NIK</label>
            <input type="text" class="form-control" id="arsip_nik" name="nik" required>
          </div>
          <div class="mb-3">
            <label for="arsip_tanggal" class="form-label">Tanggal Pengajuan</label>
            <input type="date" class="form-control" id="arsip_tanggal" name="tanggal_pengajuan" required>
          </div>
          <div class="mb-3">
            <label for="arsip_jenis" class="form-label">Jenis Surat</label>
            <select class="form-select" id="arsip_jenis" name="jenis_surat" required>
              <option value="">Pilih Jenis Surat</option>
              <option value="SKTM">SKTM</option>
              <option value="SD">SD</option>
              <option value="SDU">SDU</option>
              <option value="SK">SK</option>
              <option value="SKBM">SKBM</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="arsip_pdf" class="form-label">File PDF</label>
            <input type="file" class="form-control" id="arsip_pdf" name="file_pdf" accept="application/pdf" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div> 