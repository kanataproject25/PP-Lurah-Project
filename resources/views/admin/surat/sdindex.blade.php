@if($sd->status === 'approved' && $sd->pdf_path)
    <a href="{{ route('admin.sd.download', $sd->id) }}" class="btn btn-outline-success btn-sm d-inline-flex align-items-center justify-content-center" style="border-radius:6px; padding:4px 10px; margin-left:4px;" title="Download PDF" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download PDF SD">
        <i class="bi bi-file-earmark-arrow-down" style="font-size:1.1rem;"></i> PDF
    </a>
@endif 