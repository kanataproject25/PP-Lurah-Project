@extends('layouts.app')

@section('content')
<style>
/* Force Font Change */
body, h1, h2, h3, h4, h5, h6, p, span, div, a, button, input, textarea, select {
    font-family: Arial, Helvetica, sans-serif !important;
}

/* --- Perkecil logo Jambi secara paksa --- */
.logo-3d {
  max-width: 250px !important;
  width: 100% !important;
}

/* ...css sebelumnya... */
.hero-img {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  padding-right: 15rem;
}

/* ===== GALERI KEGIATAN ===== */
.galeri-img-wrap {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.08);
  overflow: hidden;
  transition: box-shadow 0.3s;
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 340px;
  position: relative;
}
.galeri-img-wrap:hover {
  box-shadow: 0 8px 32px rgba(0,0,0,0.15);
}
.galeri-img {
  width: 100%;
  max-height: 260px;
  object-fit: cover;
  border-radius: 16px 16px 0 0;
  background: #f3f3f3;
}
.galeri-caption {
  padding: 16px 12px 10px 12px;
  font-size: 1rem;
  color: #333;
  text-align: center;
  font-weight: 500;
  background: #fff;
  width: 100%;
  border-radius: 0 0 16px 16px;
  min-height: 60px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
@media (max-width: 768px) {
  .galeri-img-wrap { min-height: 260px; }
  .galeri-img { max-height: 180px; }
}
@media (max-width: 576px) {
  .galeri-img-wrap { min-height: 180px; }
  .galeri-img { max-height: 120px; }
  .galeri-caption { font-size: 0.95rem; padding: 10px 6px; }
}

/* Modal Styles */
.modal-berita .modal-content {
    border-radius: 18px;
    box-shadow: 0 8px 40px 0 rgba(37,99,235,0.13);
    border: 1.5px solid #e5e7eb;
    overflow: hidden;
}
.modal-berita .modal-header {
    background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
    color: #fff;
    border-radius: 18px 18px 0 0;
    border: none;
    padding: 1.5rem 2.2rem 1.1rem 2.2rem;
    align-items: flex-start;
    box-shadow: 0 2px 12px 0 rgba(37,99,235,0.08);
}
.modal-berita .modal-title {
    font-size: 1.7rem;
    font-weight: 800;
    color: #fff;
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    letter-spacing: 0.01em;
}
.modal-berita .badge-headline {
    background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
    color: #fff;
    font-weight: 600;
    border-radius: 8px;
    padding: 2px 12px;
    font-size: 0.97rem;
    margin-right: 8px;
    display: inline-block;
}
.modal-berita .btn-close {
    background: transparent;
    border: none;
    border-radius: 50%;
    color: #22223b;
    opacity: 0.85;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    box-shadow: none;
    transition: background 0.15s, color 0.15s;
}
.modal-berita .btn-close:hover {
    background: #e5e7eb;
    color: #111827;
    opacity: 1;
    transform: none;
}
.modal-berita .btn-close svg {
    width: 20px;
    height: 20px;
    display: block;
}
.modal-berita .modal-body {
    padding: 2.5rem 2.5rem 2.2rem 2.5rem;
    background: #f8fafc;
    border-radius: 0 0 18px 18px;
    display: flex;
    flex-direction: row;
    gap: 2.8rem;
    align-items: flex-start;
}
.modal-berita .berita-img-modal {
    border-radius: 14px;
    box-shadow: 0 4px 24px 0 rgba(37,99,235,0.10);
    max-width: 420px;
    min-width: 220px;
    max-height: 340px;
    aspect-ratio: 16/10;
    object-fit: cover;
    background: #e5e7eb;
    flex-shrink: 0;
    display: block;
    margin-top: 0.5rem;
}
.modal-berita .berita-content-wrap {
    flex: 1 1 0%;
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 0.7rem;
}
.modal-berita .berita-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 0.2rem;
    color: #2563eb;
    font-size: 1.04rem;
    font-weight: 600;
}
.modal-berita .berita-deskripsi {
    color: #64748b;
    font-size: 1.08rem;
    margin-bottom: 0.2rem;
    font-style: italic;
    line-height: 1.5;
}
.modal-berita .berita-content {
    font-size: 1.13rem;
    color: #22223b;
    line-height: 1.8;
    padding: 0.5rem 0.2rem 0 0.2rem;
    letter-spacing: 0.01em;
    font-family: 'Segoe UI', Arial, sans-serif;
}
@media (max-width: 900px) {
    .modal-berita .modal-body {
        flex-direction: column;
        gap: 1.2rem;
        align-items: stretch;
        padding: 1.2rem 0.7rem 1.2rem 0.7rem;
    }
    .modal-berita .berita-img-modal {
        max-width: 100%;
        min-width: 0;
        margin-bottom: 1.2rem;
    }
    .modal-berita .modal-header { padding: 1.1rem 1rem 0.8rem 1rem; }
    .modal-berita .modal-title { font-size: 1.1rem; }
}

/* ...style sebelumnya... */
.berita-headline-badge {
    display: inline-block;
    background: #2563eb;
    color: #fff;
    font-weight: 600;
    border-radius: 8px;
    padding: 3px 10px 2px 10px;
    font-size: 0.97rem;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin-bottom: 6px;
}

.modal-berita .modal-dialog {
    max-width: 550px;
}
@media (max-width: 600px) {
    .modal-berita .modal-dialog {
        max-width: 98vw;
    }
}
.modal-berita .modal-body,
.modal-berita-body-centered {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    padding: 2.5rem 2.5rem 2.2rem 2.5rem;
    background: #f8fafc;
    border-radius: 0 0 18px 18px;
    gap: 1.5rem;
}
.berita-img-modal-centered {
    border-radius: 14px;
    box-shadow: 0 4px 24px 0 rgba(37,99,235,0.10);
    width: 100%;
    max-width: 100%;
    aspect-ratio: 16/9;
    height: auto;
    object-fit: cover;
    background: #e5e7eb;
    display: block;
    margin: 0 auto 1.2rem auto;
}
.berita-content-wrap-centered {
    width: 100%;
    max-width: 800px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.7rem;
}
@media (max-width: 1200px) {
    .modal-berita .modal-dialog {
        max-width: 98vw;
    }
    .modal-berita .modal-body,
    .modal-berita-body-centered {
        padding: 1.2rem 0.7rem 1.2rem 0.7rem;
    }
    .berita-img-modal-centered {
        max-width: 100%;
        margin-bottom: 1.2rem;
    }
    .berita-content-wrap-centered {
        max-width: 100%;
    }
}

.berita-modal-content-custom {
  border-radius: 18px;
  box-shadow: 0 8px 32px 0 rgba(37,99,235,0.13);
  background: #fff;
  overflow: hidden;
}
.berita-modal-header-custom {
  background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
  color: #fff;
  border-radius: 18px 18px 0 0;
  border: none;
  padding: 2.2rem 2.5rem 1.3rem 2.5rem;
  box-shadow: 0 2px 12px 0 rgba(37,99,235,0.08);
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: space-between;
}
.berita-modal-title-custom {
  font-size: 2.1rem;
  font-weight: 800;
  color: #fff;
  letter-spacing: 0.01em;
  line-height: 1.1;
}
.berita-modal-headline-custom {
  font-size: 1.13rem;
  color: #e0e7ff;
  font-weight: 500;
  margin-bottom: 0.2rem;
  margin-top: 0.1rem;
  text-shadow: 0 1px 2px rgba(0,0,0,0.07);
}
.berita-modal-date-custom {
  font-size: 1.01rem;
  color: #dbeafe;
  font-weight: 400;
  margin-bottom: 0.1rem;
}
.berita-modal-img-wrap {
  width: 100%;
  background: #e5e7eb;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0;
}
.berita-modal-img-custom {
  width: 100%;
  max-width: 100%;
  height: auto;
  object-fit: contain;
  border-radius: 0;
  display: block;
  background: #e5e7eb;
}
.berita-modal-body-custom {
  padding: 2.5rem 2.5rem 2.2rem 2.5rem;
  background: #fff;
  border-radius: 0 0 18px 18px;
  display: flex;
  flex-direction: column;
  gap: 1.2rem;
  align-items: flex-start;
}
.berita-modal-deskripsi-custom {
  color: #64748b;
  font-size: 1.13rem;
  font-style: italic;
  margin-bottom: 0.2rem;
  line-height: 1.5;
}
.berita-modal-content-custom-text {
  font-size: 1.18rem;
  color: #22223b;
  line-height: 1.8;
  letter-spacing: 0.01em;
  font-family: 'Segoe UI', Arial, sans-serif;
}
@media (max-width: 1500px) {
  .modal-berita .modal-dialog {
    max-width: 98vw;
  }
  .berita-modal-header-custom, .berita-modal-body-custom {
    padding-left: 1.1rem;
    padding-right: 1.1rem;
  }
}
@media (max-width: 900px) {
  .berita-modal-title-custom { font-size: 1.2rem; }
  .berita-modal-header-custom, .berita-modal-body-custom {
    padding: 1.1rem 0.7rem 1.1rem 0.7rem;
  }
}
.berita-modal-divider {
  width: 100%;
  height: 3px;
  background: #e11d48;
  margin: 0 0 0.5rem 0;
  border-radius: 2px;
}
.berita-modal-info-bar {
  border-bottom: 1px solid #f1f1f1;
  background: #fff;
  margin-bottom: 0.5rem;
}
.berita-modal-img-caption {
  background: #fff;
  border-bottom: 1px solid #f3f4f6;
}

/* Custom Close Button for Berita Modal */
.btn-close-custom {
  background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
  border: none;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 24px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
  position: relative;
  z-index: 10;
}

.btn-close-custom:hover {
  background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
  transform: scale(1.1);
  box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
  color: #fff;
}

.btn-close-custom:active {
  transform: scale(0.95);
}

.btn-close-custom:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
}

/* Modal Prestasi Styles */
.modal-prestasi .modal-content {
    border-radius: 18px;
    box-shadow: 0 8px 40px 0 rgba(37,99,235,0.13);
    border: 1.5px solid #e5e7eb;
    overflow: hidden;
}
.prestasi-modal-content-custom {
  border-radius: 18px;
  box-shadow: 0 8px 32px 0 rgba(37,99,235,0.13);
  background: #fff;
  overflow: hidden;
}
.prestasi-modal-header-custom {
  background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
  color: #fff;
  border-radius: 18px 18px 0 0;
  border: none;
  padding: 2.2rem 2.5rem 1.3rem 2.5rem;
  box-shadow: 0 2px 12px 0 rgba(37,99,235,0.08);
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: space-between;
}
.prestasi-modal-title-custom {
  font-size: 2.1rem;
  font-weight: 800;
  color: #fff;
  letter-spacing: 0.01em;
  line-height: 1.1;
}
.prestasi-modal-divider {
  width: 100%;
  height: 3px;
  background: #e11d48;
  margin: 0 0 0.5rem 0;
  border-radius: 2px;
}
.prestasi-modal-info-bar {
  border-bottom: 1px solid #f1f1f1;
  background: #fff;
  margin-bottom: 0.5rem;
}
.prestasi-modal-img-wrap {
  width: 100%;
  background: #e5e7eb;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0;
}
.prestasi-modal-img-custom {
  width: 100%;
  max-width: 100%;
  height: auto;
  object-fit: contain;
  border-radius: 0;
  display: block;
  background: #e5e7eb;
}
.prestasi-modal-body-custom {
  padding: 2.5rem 2.5rem 2.2rem 2.5rem;
  background: #fff;
  border-radius: 0 0 18px 18px;
  display: flex;
  flex-direction: column;
  gap: 1.2rem;
  align-items: flex-start;
}
.prestasi-modal-deskripsi-custom {
  color: #64748b;
  font-size: 1.13rem;
  font-style: italic;
  margin-bottom: 0.2rem;
  line-height: 1.5;
}
@media (max-width: 1500px) {
  .modal-prestasi .modal-dialog {
    max-width: 98vw;
  }
  .prestasi-modal-header-custom, .prestasi-modal-body-custom {
    padding-left: 1.1rem;
    padding-right: 1.1rem;
  }
}
@media (max-width: 900px) {
  .prestasi-modal-title-custom { font-size: 1.2rem; }
  .prestasi-modal-header-custom, .prestasi-modal-body-custom {
    padding: 1.1rem 0.7rem 1.1rem 0.7rem;
  }
}

.close-icon {
  line-height: 1;
  font-family: Arial, sans-serif;
}

.prestasi-card-home {
  background: #f8fafc;
  border-radius: 18px;
  box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08);
  padding: 2.2rem 1.5rem 1.5rem 1.5rem;
  margin-bottom: 2rem;
  min-height: 340px;
  max-height: 340px;
  height: 340px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  transition: all 0.3s ease;
  position: relative;
  width: 270px;
  box-sizing: border-box;
}
.prestasi-card-home:hover {
  box-shadow: 0 8px 32px 0 rgba(37,99,235,0.13);
  transform: translateY(-2px);
  transition: all 0.3s ease;
}
.prestasi-img-home {
  width: 110px;
  height: 110px;
  object-fit: cover;
  border-radius: 16px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.07);
  border: 2px solid #e5e7eb;
  margin-bottom: 12px;
  background: #fff;
}
.prestasi-title-home {
  font-size: 1.13rem;
  font-weight: 700;
  color: #22223b;
  margin-bottom: 0.2rem;
  margin-top: 0.2rem;
  font-family: inherit;
  letter-spacing: 0.01em;
  text-transform: uppercase;
  text-align: center;
  max-width: 100%;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.prestasi-desc-home {
  min-height: 38px;
  font-size: 0.98rem;
  color: #6c757d;
  margin-bottom: 0.5rem;
  font-family: inherit;
  text-align: center;
  max-width: 100%;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.prestasi-badge-wrapper {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: flex-end;
  min-height: 38px;
  position: absolute;
  left: 0;
  bottom: 18px;
}
.prestasi-badge-home {
  display: inline-block;
  font-weight: 700;
  font-size: 0.93rem;
  border-radius: 8px;
  padding: 3px 12px;
  color: #fff;
  background: #fd7e14;
  margin-top: 0.2rem;
  letter-spacing: 1px;
  font-family: inherit;
}
.prestasi-badge-home.badge-1 { background: #28a745; }
.prestasi-badge-home.badge-2 { background: #007bff; }
.prestasi-badge-home.badge-3 { background: #fd7e14; }
@media (max-width: 900px) {
  .prestasi-card-home { width: 90vw; min-width: 220px; max-width: 98vw; height: auto; min-height: 260px; }
  .prestasi-img-home { width: 70px; height: 70px; }
}

.prestasi-slider-wrap {
  position: relative;
  width: 100%;
  overflow: hidden;
}
.prestasi-slider {
  display: flex;
  gap: 24px;
  overflow-x: auto;
  scroll-behavior: smooth;
  padding-bottom: 8px;
}
.prestasi-card-home {
  min-width: 270px;
  max-width: 270px;
  flex: 0 0 270px;
  display: flex;
  flex-direction: column;
  align-items: center;
  height: 100%;
}
.prestasi-slider-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 2;
  background: rgba(255,255,255,0.85);
  border: 1.5px solid #2563eb;
  color: #2563eb;
  border-radius: 50%;
  width: 38px;
  height: 38px;
  font-size: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 2px 8px rgba(37,99,235,0.08);
  transition: background 0.18s, color 0.18s;
  opacity: 0.85;
}
.prestasi-slider-btn:hover {
  background: #2563eb;
  color: #fff;
  opacity: 1;
}
.prestasi-slider-btn.left { left: 0; }
.prestasi-slider-btn.right { right: 0; }
@media (max-width: 600px) {
  .prestasi-card-home { min-width: 210px; max-width: 210px; }
  .prestasi-slider-btn.left { left: 0; }
  .prestasi-slider-btn.right { right: 0; }
}

.flex-spacer {
  flex: 1 1 auto;
}

.prestasi-slider-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 2;
  background: rgba(255,255,255,0.85);
  border: 1.5px solid #2563eb;
  color: #2563eb;
  border-radius: 50%;
  width: 38px;
  height: 38px;
  font-size: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 2px 8px rgba(37,99,235,0.08);
  transition: background 0.18s, color 0.18s;
  opacity: 0.85;
}
.prestasi-slider-btn:hover {
  background: #2563eb;
  color: #fff;
  opacity: 1;
}
.prestasi-slider-btn.left { left: 0; }
.prestasi-slider-btn.right { right: 0; }
@media (max-width: 600px) {
  .prestasi-card-home { min-width: 210px; max-width: 210px; }
  .prestasi-slider-btn.left { left: 0; }
  .prestasi-slider-btn.right { right: 0; }
}

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

.struktur-bagan {
  display: flex;
  flex-direction: column;
  align-items: center;
  font-family: 'Poppins', Arial, sans-serif;
}

.bagan-lurah, .bagan-sekretaris {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.bagan-lurah-box, .bagan-sekretaris-box, .bagan-kasi-box, .bagan-pelaksana-box {
  border: 2px solid #1976d2;
  border-radius: 14px;
  background: #fff;
  padding: 18px 36px;
  margin: 0 auto 12px auto;
  text-align: center;
  min-width: 260px;
  box-shadow: 0 4px 16px rgba(25, 118, 210, 0.07);
  transition: box-shadow 0.2s, border-color 0.2s;
  font-size: 1.08em;
}

.bagan-lurah-box, .bagan-sekretaris-box {
  font-weight: 600;
  letter-spacing: 0.5px;
}

.bagan-lurah-box:hover, .bagan-sekretaris-box:hover, .bagan-kasi-box:hover, .bagan-pelaksana-box:hover {
  box-shadow: 0 8px 32px rgba(25, 118, 210, 0.15);
  border-color: #1565c0;
}

.bagan-kasi-row {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.bagan-line-vertical {
  width: 0;
  height: 32px;
  border-left: 3px solid #1976d2;
  margin: 0 auto;
}

.bagan-line-horizontal {
  width: 900px;
  height: 0;
  border-top: 3px solid #1976d2;
  margin-bottom: 18px;
}

.bagan-kasi {
  display: flex;
  flex-direction: row;
  justify-content: center;
  gap: 48px;
}

.bagan-kasi-col {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.bagan-kasi-box {
  font-weight: 600;
  min-width: 320px;
  margin-bottom: 0;
}

.bagan-line-vertical-pelaksana {
  width: 0;
  height: 28px;
  border-left: 2px solid #90caf9;
  margin: 0 auto 8px auto;
}

.bagan-pelaksana {
  display: flex;
  flex-direction: row;
  justify-content: center;
  gap: 18px;
  margin-bottom: 8px;
}

.bagan-pelaksana-box {
  min-width: 200px;
  font-size: 1em;
  font-weight: 500;
  border-radius: 10px;
}

@media (max-width: 1200px) {
  .bagan-line-horizontal { width: 98vw; }
  .bagan-kasi { gap: 18px; }
  .bagan-kasi-box { min-width: 220px; }
}
@media (max-width: 900px) {
  .bagan-kasi { flex-direction: column; gap: 18px; }
  .bagan-kasi-box { min-width: 200px; }
  .bagan-line-horizontal { width: 95vw; }
}

.layanan-card {
  border-radius: 16px;
  box-shadow: 0 4px 24px 0 rgba(0,0,0,0.08);
  transition: transform 0.2s, box-shadow 0.2s;
  position: relative;
  overflow: hidden;
  background: #fff;
  margin-bottom: 24px;
  min-height: 120px;
  display: flex;
  align-items: center;
  padding: 18px 24px 18px 24px;
}
.layanan-card:hover {
  transform: scale(1.035);
  box-shadow: 0 8px 32px 0 rgba(0,0,0,0.14);
  z-index: 2;
}
.layanan-card .icon {
  font-size: 2.2rem;
  margin-right: 18px;
  flex-shrink: 0;
}
.layanan-card .layanan-title {
  font-size: 1.1rem;
  font-weight: 600;
  color: #2563eb;
  margin-bottom: 0;
}
.layanan-card .layanan-badge {
  position: absolute;
  top: 16px;
  right: 24px;
  background: #e0f2fe;
  color: #2563eb;
  font-weight: bold;
  border-radius: 50px;
  padding: 4px 14px;
  font-size: 0.95rem;
  box-shadow: 0 2px 8px 0 rgba(37,99,235,0.08);
}
.layanan-card.disabled {
  opacity: 0.6;
  pointer-events: none;
}

.toast-notification {
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 9999;
  background: white;
  border-radius: 10px;
  box-shadow: 0 5px 20px rgba(0,0,0,0.15);
  padding: 1rem 1.5rem;
  transform: translateX(400px);
  transition: transform 0.3s ease;
  max-width: 300px;
}

.toast-notification.show {
  transform: translateX(0);
}

.toast-success {
  border-left: 4px solid #28a745;
}

.toast-error {
  border-left: 4px solid #dc3545;
}

.toast-content {
  display: flex;
  align-items: center;
  font-size: 0.9rem;
}

.toast-success .toast-content i {
  color: #28a745;
}

.toast-error .toast-content i {
  color: #dc3545;
}

        .dropdown { z-index: 1100 !important; }
        
        /* Fix dropdown position to right */
        .navmenu .dropdown ul {
          left: auto !important;
          right: 0 !important;
          min-width: 200px;
        }
        
        .navmenu .dropdown .dropdown ul {
          left: auto !important;
          right: 100% !important;
          top: 0;
        }
        
        /* Ensure dropdown doesn't overlap content */
        .navmenu .dropdown:hover > ul {
          display: block;
        }
        
        /* Additional dropdown positioning fixes */
        .navmenu .dropdown > ul {
          position: absolute;
          top: 100%;
          right: 0;
          background: #fff;
          border: 1px solid #ddd;
          border-radius: 8px;
          box-shadow: 0 4px 12px rgba(0,0,0,0.1);
          min-width: 220px;
        }
        
        .navmenu .dropdown .dropdown > ul {
          position: absolute;
          top: 0;
          right: 100%;
          background: #fff;
          border: 1px solid #ddd;
          border-radius: 8px;
          box-shadow: 0 4px 12px rgba(0,0,0,0.1);
          min-width: 250px;
        }
        
                /* Profil Kelurahan Styles */
        .profil-card {
          background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
          border: 1px solid #e9ecef !important;
          transition: all 0.3s ease;
        }
        
        .profil-card:hover {
          transform: translateY(-2px);
          box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
        }
        
        .info-item strong {
          color: #495057;
          font-size: 0.9rem;
        }
        
        .info-item p {
          color: #6c757d;
          font-size: 0.95rem;
        }
        
        .visi-card, .misi-card {
          border-left: 4px solid;
          transition: all 0.3s ease;
        }
        
        .visi-card {
          border-left-color: #0d6efd;
        }
        
        .misi-card {
          border-left-color: #198754;
        }
        
        .visi-card:hover, .misi-card:hover {
          transform: translateX(5px);
        }
        
        .sidebar-content .card {
          transition: all 0.3s ease;
        }
        
        .sidebar-content .card:hover {
          transform: translateY(-3px);
          box-shadow: 0 6px 20px rgba(0,0,0,0.12) !important;
        }
        
        .website-info {
          background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
          border: 1px solid #dee2e6;
        }
        
        .text-justify {
          text-align: justify;
        }
        
        @media (max-width: 768px) {
          .profil-card {
            margin-bottom: 2rem;
          }
          
          .sidebar-content .card {
            margin-bottom: 1.5rem;
          }
        }
         

        
        /* Responsive Design */
        @media (max-width: 768px) {
          .info-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
          }
          
          .info-card {
            padding: 1rem;
          }
          
          .content-section {
            padding: 1.5rem;
          }
          
          .sidebar-sticky {
            position: static;
            margin-top: 2rem;
          }
          
          .kelurahan-header {
            padding: 3rem 1.5rem !important;
          }
          
          .kelurahan-header h1 {
            font-size: 2rem;
          }
        }
        
        @media (max-width: 576px) {
          .info-card {
            flex-direction: column;
            text-align: center;
          }
          
          .info-icon {
            margin-bottom: 0.5rem;
          }
          
          .card-header-custom {
            flex-direction: column;
            text-align: center;
            gap: 0.5rem;
          }
        }
        
        /* Berita Card Hover Effects */
        .berita-card {
          transition: all 0.3s ease;
        }
        
        .berita-card:hover {
          transform: translateY(-5px);
          box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
        }
        
        /* Share Dropdown Styles */
        .dropdown-menu {
          border: none;
          box-shadow: 0 5px 20px rgba(0,0,0,0.1);
          border-radius: 10px;
        }
        
        .dropdown-item {
          padding: 0.75rem 1rem;
          transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
          background-color: #f8f9fa;
          transform: translateX(5px);
        }
        
        .dropdown-item i {
          width: 20px;
        }
        
        /* Toast Notification Styles */
        .toast-notification {
          position: fixed;
          top: 20px;
          right: 20px;
          z-index: 9999;
          background: white;
          border-radius: 10px;
          box-shadow: 0 5px 20px rgba(0,0,0,0.15);
          padding: 1rem 1.5rem;
          transform: translateX(400px);
          transition: transform 0.3s ease;
          max-width: 300px;
        }
        
        .toast-notification.show {
          transform: translateX(0);
        }
        
        .toast-success {
          border-left: 4px solid #28a745;
        }
        
        .toast-error {
          border-left: 4px solid #dc3545;
        }
        
        .toast-content {
          display: flex;
          align-items: center;
          font-size: 0.9rem;
        }
        
        .toast-success .toast-content i {
          color: #28a745;
        }
        
        .toast-error .toast-content i {
          color: #dc3545;
        }

.navmenu > ul.d-flex {
  gap: 18px;
}
.navmenu > ul.d-flex > li {
  margin-right: 0 !important;
  position: relative;
}
.navmenu > ul.d-flex > li:last-child {
  margin-right: 0;
}
.navmenu > ul.d-flex > li > a,
.navmenu > ul.d-flex > li > .dropdown > a {
  padding: 8px 14px;
  border-radius: 6px;
  transition: background 0.15s, color 0.15s;
  font-weight: 500;
  font-size: 1.04rem;
}
.navmenu > ul.d-flex > li > a:hover,
.navmenu > ul.d-flex > li > .dropdown > a:hover,
.navmenu > ul.d-flex > li.active > a {
  background: #e3eafc;
  color: #2563eb;
}
.navmenu .dropdown ul {
  min-width: 230px;
  padding: 8px 0;
  border-radius: 10px;
  box-shadow: 0 6px 24px rgba(37,99,235,0.10);
  margin-top: 8px;
}
.navmenu .dropdown ul li a {
  padding: 8px 20px;
  font-size: 1.01rem;
  border-radius: 5px;
  transition: background 0.13s, color 0.13s;
}
.navmenu .dropdown ul li a:hover {
  background: #f1f5fb;
  color: #2563eb;
}
.navmenu .dropdown > a {
  display: flex;
  align-items: center;
  gap: 4px;
}
.navmenu .dropdown {
  margin-right: 0 !important;
}
@media (max-width: 1200px) {
  .navmenu > ul.d-flex { gap: 10px; }
  .navmenu .dropdown ul { min-width: 180px; }
}
@media (max-width: 992px) {
  .navmenu > ul.d-flex { gap: 4px; }
}

.navmenu > ul.d-flex > li.dropdown.ms-2 {
  margin-left: 18px !important;
        }

.galeri-scroll-row {
  display: flex;
  flex-direction: row;
  gap: 24px;
  overflow-x: auto;
  padding-bottom: 8px;
  scroll-snap-type: x mandatory;
}
.galeri-scroll-row::-webkit-scrollbar {
  height: 10px;
}
.galeri-scroll-row::-webkit-scrollbar-thumb {
  background: #e0e7ef;
  border-radius: 8px;
}
.galeri-scroll-item {
  flex: 0 0 320px;
  max-width: 320px;
  min-width: 260px;
  scroll-snap-align: start;
  margin-bottom: 0;
}
@media (max-width: 600px) {
  .galeri-scroll-item { flex-basis: 85vw; max-width: 95vw; }
        }
      </style>
<body class="index-page">

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
            <h1 class="fw-bold text-uppercase">PEMERINTAHAN KELURAHAN PASIR PUTIH JAMBI</h1>
            <p>Selamat datang di website resmi Kelurahan Pasir Putih, Kecamatan Jambi Selatan, Kota Jambi.<br>Kami siap melayani kebutuhan administrasi dan informasi masyarakat.</p>
            <!-- Tombol di bawah ini dihapus sesuai permintaan -->
            <!-- <div class="d-flex">
              <a href="#about" class="btn-get-started">Get Started</a>
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div> -->
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ asset('img/logo-jambi.png') }}" class="img-fluid animated logo-3d" alt="Logo Jambi" style="background: transparent !important; filter: drop-shadow(0 4px 12px rgba(0,0,0,0.15));">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Profil Kelurahan Section -->
    <section id="profil" class="about section">
      <div class="container py-4">
        <div class="text-center mb-4">
          <h2 class="fw-bold mb-2" style="color: #222; font-size: 2.2rem;">Profil Kelurahan</h2>
          <p class="mb-0" style="color: #555; font-size: 1.1rem;">Mengenal Lebih Dekat Kelurahan Pasir Putih yang Maju dan Sejahtera</p>
        </div>

        <div class="row gy-5">
          <!-- Informasi Umum -->
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
            <div class="profil-card card h-100 shadow-sm border-0" style="border-radius: 16px;">
              <div class="card-header bg-white text-dark py-3 border-bottom" style="border-radius: 16px 16px 0 0;">
                <h4 class="mb-0 fw-semibold" style="font-size: 1.3rem;">Informasi Umum Kelurahan</h4>
              </div>
              <div class="card-body p-4">
                <div class="row g-4 mb-4">
                  <div class="col-md-6">
                    <div class="info-item-enhanced p-3 bg-light rounded-3 border-start border-4 border-success">
                      <div class="d-flex align-items-center mb-2">
                        <strong class="text-dark">Lokasi</strong>
                      </div>
                      <p class="mb-0 text-muted">Kecamatan Jambi Selatan, Kota Jambi</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-item-enhanced p-3 bg-light rounded-3 border-start border-4 border-info">
                      <div class="d-flex align-items-center mb-2">
                        <strong class="text-dark">Jumlah Penduduk</strong>
                      </div>
                      <p class="mb-0 text-muted">± 15.000 Jiwa (2024)</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-item-enhanced p-3 bg-light rounded-3 border-start border-4 border-warning">
                      <div class="d-flex align-items-center mb-2">
                        <strong class="text-dark">Jumlah RT/RW</strong>
                      </div>
                      <p class="mb-0 text-muted">15 RT / 3 RW</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="info-item-enhanced p-3 bg-light rounded-3 border-start border-4 border-danger">
                      <div class="d-flex align-items-center mb-2">
                        <strong class="text-dark">Dibentuk</strong>
                      </div>
                      <p class="mb-0 text-muted">Tahun 1980</p>
                    </div>
                  </div>
                </div>
                <div class="description-section">
                  <h5 class="text-primary mb-3 fw-bold" style="font-size: 1.1rem;">Deskripsi Kelurahan</h5>
                  <div class="row">
                    <div class="col-lg-8">
                      <p class="text-justify mb-3">
                        Kelurahan Pasir Putih merupakan salah satu kelurahan yang terletak di Kecamatan Jambi Selatan, Kota Jambi. 
                        Kelurahan ini memiliki luas wilayah sekitar 2,5 km² dan berbatasan langsung dengan Kelurahan Telanaipura di sebelah utara, 
                        Kelurahan Murni di sebelah selatan, Kelurahan Solok Sipin di sebelah barat, dan Kelurahan Tanjung Sari di sebelah timur.
                      </p>
                      <p class="text-justify mb-0">
                        Sebagai kelurahan yang berkembang pesat, Pasir Putih memiliki karakteristik masyarakat yang heterogen dengan 
                        berbagai latar belakang sosial ekonomi. Mayoritas penduduk bekerja di sektor perdagangan, jasa, dan industri 
                        yang tersebar di berbagai kawasan komersial dan industri di sekitar kelurahan.
                      </p>
                    </div>
                    <div class="col-lg-4">
                      <div class="stats-card bg-light text-dark p-4 rounded-3 text-center border">
                        <h4 class="mb-2">2.5 km²</h4>
                        <p class="mb-0">Luas Wilayah</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Visi & Misi -->
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="row g-4">
              <div class="col-12">
                <div class="visi-card card h-100 shadow-sm border-0" style="border-radius: 16px; border-left: 5px solid #0d6efd;">
                  <div class="card-header bg-white text-dark py-3 border-bottom" style="border-radius: 16px 16px 0 0; border-left: none;">
                    <h4 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Visi</h4>
                  </div>
                  <div class="card-body p-4">
                    <p class="card-text text-justify fst-italic mb-0">
                      "Terwujudnya Kelurahan Pasir Putih yang Maju, Mandiri, dan Sejahtera dengan Pelayanan Publik yang Berkualitas"
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="misi-card card h-100 shadow-sm border-0" style="border-radius: 16px; border-left: 5px solid #198754;">
                  <div class="card-header bg-white text-dark py-3 border-bottom" style="border-radius: 16px 16px 0 0; border-left: none;">
                    <h4 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Misi</h4>
                  </div>
                  <div class="card-body p-4">
                    <ul class="list-unstyled mb-0">
                      <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-success me-3 mt-1" style="font-size: 1.1rem;"></i>
                        <span>Meningkatkan kualitas pelayanan publik</span>
                      </li>
                      <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-success me-3 mt-1" style="font-size: 1.1rem;"></i>
                        <span>Mengembangkan perekonomian masyarakat</span>
                      </li>
                      <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-success me-3 mt-1" style="font-size: 1.1rem;"></i>
                        <span>Meningkatkan kesejahteraan sosial</span>
                      </li>
                      <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-success me-3 mt-1" style="font-size: 1.1rem;"></i>
                        <span>Membangun infrastruktur yang berkelanjutan</span>
                      </li>
                      <li class="d-flex align-items-start">
                        <i class="bi bi-check-circle-fill text-success me-3 mt-1" style="font-size: 1.1rem;"></i>
                        <span>Menguatkan tata kelola pemerintahan</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Keunggulan & Fasilitas -->
          <div class="col-12" data-aos="fade-up" data-aos-delay="300">
            <div class="card shadow-sm border-0" style="border-radius: 16px;">
              <div class="card-header bg-white text-dark py-3 border-bottom" style="border-radius: 16px 16px 0 0;">
                <h4 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Keunggulan & Fasilitas</h4>
              </div>
              <div class="card-body p-4">
                <div class="row g-4">
                  <div class="col-md-6 col-lg-3">
                    <div class="feature-card text-center p-4 bg-light rounded-3 h-100 border-0 shadow-sm">
                      <h5 class="text-primary fw-bold mb-2">Keamanan</h5>
                      <p class="text-muted mb-0">Sistem keamanan yang terintegrasi dengan patroli rutin dan pos kamling yang aktif 24/7</p>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                    <div class="feature-card text-center p-4 bg-light rounded-3 h-100 border-0 shadow-sm">
                      <h5 class="text-danger fw-bold mb-2">Kesehatan</h5>
                      <p class="text-muted mb-0">Fasilitas kesehatan lengkap dengan puskesmas, klinik swasta, dan apotek</p>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                    <div class="feature-card text-center p-4 bg-light rounded-3 h-100 border-0 shadow-sm">
                      <h5 class="text-success fw-bold mb-2">Pendidikan</h5>
                      <p class="text-muted mb-0">Sekolah dari TK hingga SMA dengan kualitas pendidikan terbaik dan akreditasi A</p>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                    <div class="feature-card text-center p-4 bg-light rounded-3 h-100 border-0 shadow-sm">
                      <h5 class="text-warning fw-bold mb-2">Ekonomi</h5>
                      <p class="text-muted mb-0">Pusat perbelanjaan modern dan pasar tradisional yang mendukung UMKM lokal</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Prestasi & Penghargaan -->
          <div class="col-12" data-aos="fade-up" data-aos-delay="400">
            <div class="card shadow-sm border-0" style="border-radius: 16px;">
              <div class="card-header bg-white text-dark py-3 border-bottom" style="border-radius: 16px 16px 0 0;">
                <h4 class="mb-0 fw-semibold" style="font-size: 1.2rem;">Prestasi & Penghargaan</h4>
              </div>
              <div class="card-body p-4">
                <div class="prestasi-slider-wrap">
                  <div class="prestasi-slider" id="prestasiSlider">
                    @foreach($prestasis as $item)
                      <div class="prestasi-card-home" style="position:relative; display:flex; flex-direction:column; justify-content:space-between; align-items:center; min-height:320px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#prestasiModal{{ $item->id }}">
                        @if($item->gambar)
                          <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Prestasi" class="prestasi-img-home">
                        @endif
                        <div class="prestasi-title-home">{{ $item->judul }}</div>
                        <div class="prestasi-desc-home">{{ $item->deskripsi ?? $item->tahun }}</div>
                        <div style="flex:1 1 auto;width:100%"></div>
                        <div class="prestasi-badge-wrapper" style="width:100%;display:flex;justify-content:center;align-items:flex-end;min-height:38px;">
                          @php
                              $badgeClass = 'prestasi-badge-home';
                              if (strtolower($item->badge) == '1' || strtolower($item->badge) == 'juara 1') $badgeClass .= ' badge-1';
                              elseif (strtolower($item->badge) == '2' || strtolower($item->badge) == 'juara 2') $badgeClass .= ' badge-2';
                              elseif (strtolower($item->badge) == '3' || strtolower($item->badge) == 'juara 3') $badgeClass .= ' badge-3';
                          @endphp
                          <span class="{{ $badgeClass }}">{{ $item->badge }}</span>
                        </div>
                      </div>
                    @endforeach
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Modal Prestasi dinamis -->
        @foreach($prestasis as $item)
        <div class="modal fade modal-prestasi" id="prestasiModal{{ $item->id }}" tabindex="-1" aria-labelledby="prestasiModalLabel{{ $item->id }}" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width:550px;">
            <div class="modal-content prestasi-modal-content-custom">
              <div class="modal-header prestasi-modal-header-custom" style="background: #fff; color: #222; border-radius: 18px 18px 0 0; box-shadow: none; padding-bottom: 0.7rem;">
                <div class="w-100">
                  <h2 class="prestasi-modal-title-custom" style="color:#222; font-size:2.3rem; font-weight:800; margin-bottom:0.2rem;">{{ $item->judul }}</h2>
                </div>
                <button type="button" class="btn-close-custom align-self-start" data-bs-dismiss="modal" aria-label="Close">
                  <span class="close-icon">×</span>
                </button>
              </div>
              <div class="prestasi-modal-divider"></div>
              <div class="prestasi-modal-info-bar d-flex align-items-center gap-3 px-4 py-2" style="font-size:1.08rem; color:#444;">
                <span><i class="bi bi-calendar me-1"></i> Tahun: {{ $item->tahun }}</span>
                <span><i class="bi bi-tag me-1"></i> Kategori: {{ $item->kategori }}</span>
                <span><i class="bi bi-trophy me-1"></i> {{ $item->badge }}</span>
              </div>
              @if($item->gambar)
              <div class="prestasi-modal-img-wrap">
                <img src="{{ asset('storage/' . $item->gambar) }}" class="prestasi-modal-img-custom" alt="Gambar Prestasi">
              </div>
              @endif
              <div class="modal-body prestasi-modal-body-custom">
                @if($item->deskripsi)
                  <div class="prestasi-modal-deskripsi-custom">
                    {!! nl2br(e($item->deskripsi)) !!}
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </section><!-- /Profil Section -->

    <!-- Struktur Organisasi Section -->
    <section id="struktur" class="section light-background">
      <div class="container section-title" data-aos="fade-up">
        <h2>Struktur Organisasi</h2>
        <p>Kelurahan Pasir Putih, Kecamatan Jambi Selatan</p>
      </div>
      <div class="container d-flex justify-content-center">
        <div class="struktur-bagan">
          <div class="bagan-lurah">
            <div class="bagan-box bagan-lurah-box">
              <strong>LURAH PASIR PUTIH</strong><br>
              UBAIDILLAH, S.KOM<br>
              NIP: 197803242010011006
                        </div>
                        </div>
          <div class="bagan-sekretaris">
            <div class="bagan-line-vertical"></div>
            <div class="bagan-box bagan-sekretaris-box">
              <strong>SEKRETARIS LURAH</strong><br>
              SYAFRUL<br>
              NIP: 197006121992031006
                      </div>
                      </div>
          <div class="bagan-kasi-row">
            <div class="bagan-line-horizontal"></div>
            <div class="bagan-kasi">
              <!-- Kasi 1 -->
              <div class="bagan-kasi-col">
                <div class="bagan-box bagan-kasi-box">
                  <strong>KASI PEMERINTAHAN DAN PELAYANAN UMUM</strong><br>
                  CHAIRISMA, SE<br>
                  NIP: 196707281986032001
                    </div>
                <div class="bagan-line-vertical-pelaksana"></div>
                <div class="bagan-pelaksana">
                  <div class="bagan-box bagan-pelaksana-box">
                    RATUMAS ZAINAH<br>
                    NIP: 196906141991022001
                  </div>
                  <div class="bagan-box bagan-pelaksana-box">
                    SOLEHUDIN<br>
                    NIP: 196810251988031001
                        </div>
                        </div>
                      </div>
              <!-- Kasi 2 -->
              <div class="bagan-kasi-col">
                <div class="bagan-box bagan-kasi-box">
                  <strong>KASI PEMBERDAYAAN DAN KESEJAHTERAAN SOSIAL</strong><br>
                  EKA ROMANINGSIH, SE<br>
                  NIP: 198505292008012002
                      </div>
                <div class="bagan-line-vertical-pelaksana"></div>
                <div class="bagan-pelaksana">
                  <div class="bagan-box bagan-pelaksana-box">
                    IWANAH<br>
                    NIP: 196909181997022022
                    </div>
                  </div>
                        </div>
              <!-- Kasi 3 -->
              <div class="bagan-kasi-col">
                <div class="bagan-box bagan-kasi-box">
                  <strong>KASI KETENTRAMAN DAN KETERTIBAN</strong><br>
                  HERLEANSYAH PUTRA GUMAY<br>
                  NIP: 19790262008011003
                        </div>
                <div class="bagan-line-vertical-pelaksana"></div>
                <div class="bagan-pelaksana">
                  <div class="bagan-box bagan-pelaksana-box">
                    SITI HAZRIATI<br>
                    NIP: 197905192014072003
                      </div>
                      </div>
                    </div>
                  </div>
                        </div>
                        </div>
                      </div>
      <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        .struktur-bagan {
          display: flex;
          flex-direction: column;
          align-items: center;
          font-family: 'Poppins', Arial, sans-serif;
        }

        .bagan-lurah, .bagan-sekretaris {
          display: flex;
          flex-direction: column;
          align-items: center;
        }

        .bagan-lurah-box, .bagan-sekretaris-box, .bagan-kasi-box, .bagan-pelaksana-box {
          border: 2px solid #1976d2;
          border-radius: 14px;
          background: #fff;
          padding: 18px 36px;
          margin: 0 auto 12px auto;
          text-align: center;
          min-width: 260px;
          box-shadow: 0 4px 16px rgba(25, 118, 210, 0.07);
          transition: box-shadow 0.2s, border-color 0.2s;
          font-size: 1.08em;
        }

        .bagan-lurah-box, .bagan-sekretaris-box {
          font-weight: 600;
          letter-spacing: 0.5px;
        }

        .bagan-lurah-box:hover, .bagan-sekretaris-box:hover, .bagan-kasi-box:hover, .bagan-pelaksana-box:hover {
          box-shadow: 0 8px 32px rgba(25, 118, 210, 0.15);
          border-color: #1565c0;
        }

        .bagan-kasi-row {
          width: 100%;
          display: flex;
          flex-direction: column;
          align-items: center;
        }

        .bagan-line-vertical {
          width: 0;
          height: 32px;
          border-left: 3px solid #1976d2;
          margin: 0 auto;
        }

        .bagan-line-horizontal {
          width: 900px;
          height: 0;
          border-top: 3px solid #1976d2;
          margin-bottom: 18px;
        }

        .bagan-kasi {
          display: flex;
          flex-direction: row;
          justify-content: center;
          gap: 48px;
        }

        .bagan-kasi-col {
          display: flex;
          flex-direction: column;
          align-items: center;
        }

        .bagan-kasi-box {
          font-weight: 600;
          min-width: 320px;
          margin-bottom: 0;
        }

        .bagan-line-vertical-pelaksana {
          width: 0;
          height: 28px;
          border-left: 2px solid #90caf9;
          margin: 0 auto 8px auto;
        }

        .bagan-pelaksana {
          display: flex;
          flex-direction: row;
          justify-content: center;
          gap: 18px;
          margin-bottom: 8px;
        }

        .bagan-pelaksana-box {
          min-width: 200px;
          font-size: 1em;
          font-weight: 500;
          border-radius: 10px;
        }

        @media (max-width: 1200px) {
          .bagan-line-horizontal { width: 98vw; }
          .bagan-kasi { gap: 18px; }
          .bagan-kasi-box { min-width: 220px; }
        }
        @media (max-width: 900px) {
          .bagan-kasi { flex-direction: column; gap: 18px; }
          .bagan-kasi-box { min-width: 200px; }
          .bagan-line-horizontal { width: 95vw; }
        }
      </style>
    </section>

    <!-- Layanan Section -->
    <section id="layanan" class="section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Layanan Kelurahan</h2>
      </div>
      <div class="container">
        <div class="row gy-4">
          <div class="col-12" data-aos="fade-up" data-aos-delay="100">
            <style>
              .layanan-card {
                border-radius: 16px;
                box-shadow: 0 4px 24px 0 rgba(0,0,0,0.08);
                transition: transform 0.2s, box-shadow 0.2s;
                position: relative;
                overflow: hidden;
                background: #fff;
                margin-bottom: 24px;
                min-height: 120px;
                display: flex;
                align-items: center;
                padding: 18px 24px 18px 24px;
              }
              .layanan-card:hover {
                transform: scale(1.035);
                box-shadow: 0 8px 32px 0 rgba(0,0,0,0.14);
                z-index: 2;
              }
              .layanan-card .icon {
                font-size: 2.2rem;
                margin-right: 18px;
                flex-shrink: 0;
              }
              .layanan-card .layanan-title {
                font-size: 1.1rem;
                font-weight: 600;
                color: #2563eb;
                margin-bottom: 0;
              }
              .layanan-card .layanan-badge {
                position: absolute;
                top: 16px;
                right: 24px;
                background: #e0f2fe;
                color: #2563eb;
                font-weight: bold;
                border-radius: 50px;
                padding: 4px 14px;
                font-size: 0.95rem;
                box-shadow: 0 2px 8px 0 rgba(37,99,235,0.08);
              }
              .layanan-card.disabled {
                opacity: 0.6;
                pointer-events: none;
              }
            </style>
            <div class="row justify-content-center">
              <div class="col-md-6 col-lg-4">
                <a href="{{ route('sktm.create') }}" class="layanan-card text-decoration-none">
                  <span class="icon text-primary"><i class="bi bi-file-earmark-person"></i></span>
                  <span class="layanan-title">Pembuatan Surat Keterangan Tidak Mampu</span>
                  <span class="layanan-badge">SKTM</span>
                </a>
              </div>
              <div class="col-md-6 col-lg-4">
                <a href="{{ route('sdu.create') }}" class="layanan-card text-decoration-none">
                  <span class="icon text-info"><i class="bi bi-briefcase"></i></span>
                  <span class="layanan-title">Pembuatan Surat Domisili Usaha</span>
                  <span class="layanan-badge">SDU</span>
                </a>
              </div>
              <div class="col-md-6 col-lg-4">
                <a href="{{ route('sd.create') }}" class="layanan-card text-decoration-none">
                  <span class="icon text-success"><i class="bi bi-house"></i></span>
                  <span class="layanan-title">Pembuatan Surat Keterangan Domisili</span>
                  <span class="layanan-badge">SD</span>
                </a>
              </div>
              <div class="col-md-6 col-lg-4">
                <a href="{{ route('sk.create') }}" class="layanan-card text-decoration-none">
                  <span class="icon text-warning"><i class="bi bi-person-x"></i></span>
                  <span class="layanan-title">Pembuatan Surat Kematian</span>
                  <span class="layanan-badge">SK</span>
                </a>
              </div>
              <div class="col-md-6 col-lg-4">
                <a href="{{ route('skbm.create') }}" class="layanan-card text-decoration-none">
                  <span class="icon text-secondary"><i class="bi bi-person-badge"></i></span>
                  <span class="layanan-title">Pembuatan Surat Belum Pernah Menikah</span>
                  <span class="layanan-badge">SKBM</span>
                </a>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="layanan-card disabled">
                  <span class="icon text-muted"><i class="bi bi-gear"></i></span>
                  <span class="layanan-title text-muted">Pelayanan administrasi kependudukan lainnya</span>
                  <span class="layanan-badge bg-light text-muted">LAINNYA</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Berita Section -->
    <section id="berita" class="section light-background">
      <div class="container section-title" data-aos="fade-up">
        <h2>Berita Kelurahan</h2>
        <p>Informasi terbaru seputar kegiatan dan pengumuman Kelurahan Pasir Putih</p>
      </div>
      <div class="container">
        <div class="row gy-4" id="berita-list">
          @forelse($beritas as $berita)
          <div class="col-lg-3 col-md-6 berita-item" data-index="{{ $loop->iteration }}" style="display:block;">
            <div class="card h-100 shadow-sm border-0 berita-card" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#beritaModal{{ $berita->id }}">
              @if($berita->image_path)
                <img src="{{ asset('storage/' . $berita->image_path) }}" class="card-img-top" alt="Gambar Berita" style="height: 180px; object-fit: cover;">
              @endif
              <div class="card-body p-4">
                @if($berita->headline)
                  <span class="berita-headline-badge">{{ Str::limit($berita->headline, 50) }}</span>
                @endif
                <div class="d-flex align-items-center mb-3">
                  <i class="bi bi-calendar-event text-primary me-2"></i>
                  <small class="text-muted">{{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</small>
                </div>
                <h5 class="card-title mb-2">{{ $berita->judul }}</h5>
                @if($berita->deskripsi)
                  <p class="card-text text-muted mb-2">{{ Str::limit(strip_tags($berita->deskripsi), 100) }}</p>
                @endif
                <p class="card-text text-muted">{{ Str::limit(strip_tags($berita->isi), 100) }}</p>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center text-muted">Belum ada berita.</div>
          @endforelse
        </div>
        <!-- Modal berita dinamis -->
        @foreach($beritas as $berita)
        <div class="modal fade modal-berita" id="beritaModal{{ $berita->id }}" tabindex="-1" aria-labelledby="beritaModalLabel{{ $berita->id }}" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width:550px;">
            <div class="modal-content berita-modal-content-custom">
              <div class="modal-header berita-modal-header-custom" style="background: #fff; color: #222; border-radius: 18px 18px 0 0; box-shadow: none; padding-bottom: 0.7rem;">
                <div class="w-100">
                  <h2 class="berita-modal-title-custom" style="color:#222; font-size:2.3rem; font-weight:800; margin-bottom:0.2rem;">{{ $berita->judul }}</h2>
                </div>
                <button type="button" class="btn-close-custom align-self-start" data-bs-dismiss="modal" aria-label="Close">
                  <span class="close-icon">×</span>
                </button>
              </div>
              <div class="berita-modal-divider"></div>
              <div class="berita-modal-info-bar d-flex align-items-center gap-3 px-4 py-2" style="font-size:1.08rem; color:#444;">
                <span><i class="bi bi-calendar me-1"></i> Diposting: {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</span>
              </div>
              <div class="berita-modal-img-wrap">
                <img src="{{ asset('storage/' . $berita->image_path) }}" class="berita-modal-img-custom" alt="Gambar Berita">
              </div>
              <div class="berita-modal-img-caption px-4 pt-2 pb-1" style="font-style:italic; color:#6b7280; font-size:1.04rem;">{{ $berita->headline ?? $berita->judul }}</div>
              <div class="modal-body berita-modal-body-custom">
                @if($berita->deskripsi)
                  <div class="berita-modal-deskripsi-custom">{{ $berita->deskripsi }}</div>
                @endif
                <div class="berita-modal-content-custom-text">
                  {!! nl2br(e($berita->isi)) !!}
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="section">
      <div class="container section-title" data-aos="fade-up">
        <h2 class="text-center mb-2">Galeri Kegiatan</h2>
        <p class="mb-4 text-center text-muted">Dokumentasi kegiatan terbaru Kelurahan Pasir Putih</p>
      </div>
      <div class="container">
        <!-- Swiper -->
        <div class="swiper galeri-swiper">
          <div class="swiper-wrapper">
            @forelse($galeris as $galeri)
            <div class="swiper-slide">
              <div class="galeri-img-wrap w-100" style="min-height:420px; max-width:370px; margin:auto;">
                @if($galeri->image_path)
                  <img src="{{ asset('storage/' . $galeri->image_path) }}" class="galeri-img" alt="{{ $galeri->judul }}" style="height:260px; max-height:320px; object-fit:cover; width:100%; border-radius:18px 18px 0 0;">
                @endif
                <div class="galeri-caption" style="font-size:1.13rem; min-height:90px;">
                  <span class="fw-bold" style="font-size:1.18rem;">{{ $galeri->judul }}</span>
                  <span class="text-muted d-block" style="font-size:1.05em;">{{ \Carbon\Carbon::parse($galeri->tanggal)->format('d M Y') }}</span>
                  @if($galeri->deskripsi)
                    <span class="d-block mt-1" style="font-size:1.07em; color:#666;">{{ $galeri->deskripsi }}</span>
                  @endif
                </div>
              </div>
            </div>
            @empty
            <div class="swiper-slide">
              <div class="col-12 text-center text-muted">Belum ada galeri kegiatan.</div>
            </div>
            @endforelse
          </div>
          <!-- Add Arrows -->
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </div>
    </section>

    <!-- Tambahkan SwiperJS CDN jika belum ada -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
      new Swiper('.galeri-swiper', {
        slidesPerView: 3,
        spaceBetween: 32,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        breakpoints: {
          1200: { slidesPerView: 3 },
          900: { slidesPerView: 2 },
          0: { slidesPerView: 1 }
        },
        loop: true,
        centeredSlides: true,
        grabCursor: true,
        effect: 'slide',
      });
    });
    </script>

    <style>
    .galeri-img-wrap {
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 6px 32px rgba(0,0,0,0.10);
      overflow: hidden;
      transition: box-shadow 0.3s;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 420px;
      max-width: 370px;
      margin: auto;
    }
    .galeri-img-wrap:hover {
      box-shadow: 0 12px 40px rgba(0,0,0,0.18);
    }
    .galeri-img {
      width: 100%;
      height: 260px;
      max-height: 320px;
      object-fit: cover;
      border-radius: 18px 18px 0 0;
      background: #f3f3f3;
    }
    .galeri-caption {
      padding: 22px 18px 16px 18px;
      font-size: 1.13rem;
      color: #333;
      text-align: center;
      font-weight: 500;
      background: #fff;
      width: 100%;
      border-radius: 0 0 18px 18px;
      min-height: 90px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .swiper-button-next, .swiper-button-prev {
      color: #2563eb;
      background: #fff;
      border-radius: 50%;
      box-shadow: 0 2px 8px rgba(37,99,235,0.10);
      width: 44px;
      height: 44px;
      top: 45%;
      transition: background 0.18s, color 0.18s;
    }
    .swiper-button-next:hover, .swiper-button-prev:hover {
      background: #2563eb;
      color: #fff;
    }
    @media (max-width: 1200px) {
      .galeri-img-wrap { min-height: 340px; max-width: 98vw; }
      .galeri-img { height: 180px; max-height: 220px; }
    }
    @media (max-width: 600px) {
      .galeri-img-wrap { min-height: 220px; max-width: 98vw; }
      .galeri-img { height: 120px; max-height: 140px; }
      .galeri-caption { font-size: 1rem; padding: 10px 6px; }
    }
    </style>

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-5">

            <div class="info-wrap">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Address</h3>
                  <p>Jl. KH Ibrahim, Pasir Putih, Kec. Jambi Sel., Kota Jambi, Jambi 36129.</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>Call Us</h3>
                  <p></p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email Us</h3>
                  <p>info@example.com</p>
                </div>
              </div><!-- End Info Item -->

              <iframe src="https://www.google.com/maps?q=-1.621111, 103.632500&hl=id&z=17&output=embed" frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>

          <div class="col-lg-7">
            <form action="{{ route('kirim.pesan') }}" method="POST">
                @csrf
                <div class="row gy-4">
                    <div class="col-md-6">
                        <label for="name-field" class="pb-2">Your Name</label>
                        <input type="text" name="name" id="name-field" class="form-control" required="">
                    </div>
                    <div class="col-md-6">
                        <label for="email-field" class="pb-2">Your Email</label>
                        <input type="email" class="form-control" name="email" id="email-field" required="">
                    </div>
                    <div class="col-md-12">
                        <label for="subject-field" class="pb-2">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject-field" required="">
                    </div>
                    <div class="col-md-12">
                        <label for="message-field" class="pb-2">Message</label>
                        <textarea class="form-control" name="message" rows="10" id="message-field" required=""></textarea>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" style="background:#29b6f6;color:#fff;padding:10px 30px;border:none;border-radius:20px;font-weight:bold;box-shadow:0 2px 8px #b3e5fc;transition:background 0.2s;">Send Message</button>
                    </div>
                </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

    <hr style="margin: 40px 0 30px 0; border-top: 2px solidrgb(0, 5, 10);">

  </main>

  <footer id="footer" class="footer">
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-12 text-center">
          <h4 class="fw-bold mb-2" style="color: #2c3e50; letter-spacing: 1px;">KELURAHAN PASIR PUTIH</h4>
          <p class="mb-1">Jl. KH Ibrahim, Pasir Putih, Kec. Jambi Sel., Kota Jambi, Jambi 36129</p>
          <p class="mb-1">Telepon: (isi nomor telepon kelurahan)</p>
          <p class="mb-0">Email: (isi email kelurahan)</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('arsha/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('arsha/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('arsha/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('arsha/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('arsha/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('arsha/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
  <script src="{{ asset('arsha/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('arsha/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('arsha/assets/js/main.js') }}"></script>

  <!-- Share Functionality Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Share functionality
      document.querySelectorAll('.share-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          
          const platform = this.getAttribute('data-platform');
          const title = this.getAttribute('data-title');
          const url = this.getAttribute('data-url');
          const text = 'Berita terbaru dari Kelurahan Pasir Putih: ' + title;
          
          let shareUrl = '';
          
          switch(platform) {
            case 'whatsapp':
              shareUrl = `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`;
              break;
            case 'facebook':
              shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}&quote=${encodeURIComponent(text)}`;
              break;
            case 'twitter':
              shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`;
              break;
            case 'telegram':
              shareUrl = `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
              break;
            case 'copy':
              // Copy to clipboard
              navigator.clipboard.writeText(url).then(function() {
                showToast('Link berhasil disalin ke clipboard!', 'success');
              }).catch(function() {
                showToast('Gagal menyalin link', 'error');
              });
              return;
          }
          
          if (shareUrl) {
            window.open(shareUrl, '_blank', 'width=600,height=400');
          }
        });
      });
      
      // Toast notification function
      function showToast(message, type) {
        const toast = document.createElement('div');
        toast.className = `toast-notification toast-${type}`;
        toast.innerHTML = `
          <div class="toast-content">
            <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
            ${message}
          </div>
        `;
        
        document.body.appendChild(toast);
        
        // Show toast
        setTimeout(() => {
          toast.classList.add('show');
        }, 100);
        
        // Hide toast after 3 seconds
        setTimeout(() => {
          toast.classList.remove('show');
          setTimeout(() => {
            document.body.removeChild(toast);
          }, 300);
        }, 3000);
      }
    });
  </script>

  <!-- Modal Berita 1 -->
  <div class="modal fade modal-berita" id="beritaModal1" tabindex="-1" aria-labelledby="beritaModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="beritaModal1Label">
            <i class="bi bi-newspaper me-2"></i>
            Pelantikan Lurah Pasir Putih yang Baru
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="berita-meta">
            <div class="d-flex align-items-center">
              <i class="bi bi-calendar-event text-primary me-2"></i>
              <span class="text-muted">14 Juli 2025</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-person text-primary me-2"></i>
              <span class="text-muted">Admin Kelurahan</span>
            </div>
            <span class="badge bg-primary">Pemerintahan</span>
          </div>
          <div class="berita-content">
            <p><strong>Kelurahan Pasir Putih, Jambi</strong> - Hari ini dilaksanakan pelantikan Lurah Pasir Putih yang baru, Bapak Ahmad Rizki, S.Sos. Pelantikan dilakukan oleh Camat Jambi Selatan di Balai Kelurahan Pasir Putih dengan dihadiri oleh tokoh masyarakat dan perangkat kelurahan.</p>
            
            <p>Pelantikan ini menandai dimulainya kepemimpinan baru di Kelurahan Pasir Putih untuk periode 2025-2028. Bapak Ahmad Rizki sebelumnya menjabat sebagai Sekretaris Lurah di Kelurahan Telanaipura dan memiliki pengalaman lebih dari 10 tahun dalam pelayanan publik.</p>
            
            <p>Dalam sambutannya, Lurah yang baru menyampaikan komitmennya untuk meningkatkan pelayanan kepada warga Kelurahan Pasir Putih dan mengembangkan berbagai program yang bermanfaat bagi masyarakat.</p>
          </div>
          <div class="berita-footer">
            <div class="row">
              <div class="col-md-6">
                <small class="text-muted">
                  <i class="bi bi-eye me-1"></i>
                  Dibaca: 245 kali
                </small>
              </div>
              <div class="col-md-6 text-end">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-share me-1"></i>
                    Bagikan berita ini
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item share-btn" href="#" data-platform="whatsapp" data-title="Pelantikan Lurah Pasir Putih yang Baru" data-url="{{ url()->current() }}#berita1">
                      <i class="bi bi-whatsapp text-success me-2"></i>WhatsApp
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="facebook" data-title="Pelantikan Lurah Pasir Putih yang Baru" data-url="{{ url()->current() }}#berita1">
                      <i class="bi bi-facebook text-primary me-2"></i>Facebook
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="twitter" data-title="Pelantikan Lurah Pasir Putih yang Baru" data-url="{{ url()->current() }}#berita1">
                      <i class="bi bi-twitter-x text-dark me-2"></i>Twitter/X
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="telegram" data-title="Pelantikan Lurah Pasir Putih yang Baru" data-url="{{ url()->current() }}#berita1">
                      <i class="bi bi-telegram text-info me-2"></i>Telegram
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="copy" data-title="Pelantikan Lurah Pasir Putih yang Baru" data-url="{{ url()->current() }}#berita1">
                      <i class="bi bi-clipboard text-secondary me-2"></i>Salin Link
                    </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Berita 2 -->
  <div class="modal fade modal-berita" id="beritaModal2" tabindex="-1" aria-labelledby="beritaModal2Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="beritaModal2Label">
            <i class="bi bi-lightning me-2"></i>
            Pemadaman Listrik Terjadwal di Pasir Putih
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="berita-meta">
            <div class="d-flex align-items-center">
              <i class="bi bi-calendar-event text-primary me-2"></i>
              <span class="text-muted">13 Juli 2025</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-person text-primary me-2"></i>
              <span class="text-muted">Admin Kelurahan</span>
            </div>
            <span class="badge bg-warning">Infrastruktur</span>
          </div>
          <div class="berita-content">
            <p><strong>Kelurahan Pasir Putih, Jambi</strong> - PLN akan melakukan pemadaman listrik terjadwal di Kelurahan Pasir Putih pada tanggal 16-17 Juli 2025 untuk pemeliharaan jaringan. Pemadaman akan dilakukan mulai pukul 08.00-16.00 WIB di beberapa RT.</p>
            
            <p><strong>Jadwal Pemadaman:</strong></p>
            <ul>
              <li><strong>Tanggal 16 Juli 2025:</strong> RT 01, RT 02, RT 03 (08.00-12.00 WIB)</li>
              <li><strong>Tanggal 17 Juli 2025:</strong> RT 04, RT 05, RT 06 (08.00-16.00 WIB)</li>
            </ul>
            
            <p>Pemadaman ini dilakukan untuk pemeliharaan rutin jaringan listrik guna memastikan keandalan pasokan listrik di Kelurahan Pasir Putih. Warga diharapkan mempersiapkan cadangan penerangan dan mengamankan peralatan elektronik.</p>
            
            <p>Untuk informasi lebih lanjut, warga dapat menghubungi PLN Care di nomor 123 atau melalui aplikasi PLN Mobile.</p>
          </div>
          <div class="berita-footer">
            <div class="row">
              <div class="col-md-6">
                <small class="text-muted">
                  <i class="bi bi-eye me-1"></i>
                  Dibaca: 189 kali
                </small>
              </div>
              <div class="col-md-6 text-end">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-share me-1"></i>
                    Bagikan berita ini
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item share-btn" href="#" data-platform="whatsapp" data-title="Pemadaman Listrik Terjadwal di Pasir Putih" data-url="{{ url()->current() }}#berita2">
                      <i class="bi bi-whatsapp text-success me-2"></i>WhatsApp
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="facebook" data-title="Pemadaman Listrik Terjadwal di Pasir Putih" data-url="{{ url()->current() }}#berita2">
                      <i class="bi bi-facebook text-primary me-2"></i>Facebook
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="twitter" data-title="Pemadaman Listrik Terjadwal di Pasir Putih" data-url="{{ url()->current() }}#berita2">
                      <i class="bi bi-twitter-x text-dark me-2"></i>Twitter/X
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="telegram" data-title="Pemadaman Listrik Terjadwal di Pasir Putih" data-url="{{ url()->current() }}#berita2">
                      <i class="bi bi-telegram text-info me-2"></i>Telegram
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="copy" data-title="Pemadaman Listrik Terjadwal di Pasir Putih" data-url="{{ url()->current() }}#berita2">
                      <i class="bi bi-clipboard text-secondary me-2"></i>Salin Link
                    </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Berita 3 -->
  <div class="modal fade modal-berita" id="beritaModal3" tabindex="-1" aria-labelledby="beritaModal3Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="beritaModal3Label">
            <i class="bi bi-cup-hot me-2"></i>
            Festival Kuliner Pasir Putih 2025
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="berita-meta">
            <div class="d-flex align-items-center">
              <i class="bi bi-calendar-event text-primary me-2"></i>
              <span class="text-muted">12 Juli 2025</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-person text-primary me-2"></i>
              <span class="text-muted">Admin Kelurahan</span>
            </div>
            <span class="badge bg-warning">Ekonomi</span>
          </div>
          <div class="berita-content">
            <p><strong>Kelurahan Pasir Putih, Jambi</strong> - Kelurahan Pasir Putih akan mengadakan Festival Kuliner Pasir Putih 2025 pada tanggal 25-27 Juli 2025. Event ini akan menampilkan berbagai kuliner khas Jambi dan UMKM lokal dengan target 50 stand makanan.</p>
            
            <p><strong>Jadwal Acara:</strong></p>
            <ul>
              <li><strong>25 Juli 2025:</strong> Pembukaan Festival (18.00 WIB)</li>
              <li><strong>26 Juli 2025:</strong> Lomba Masak Tradisional Jambi</li>
              <li><strong>27 Juli 2025:</strong> Penutupan dan Pengumuman Pemenang</li>
            </ul>
            
            <p>Festival ini bertujuan untuk mempromosikan kuliner khas Jambi dan mendukung UMKM lokal. Beberapa makanan yang akan ditampilkan antara lain Tempoyak, Gulai Ikan Patin, dan berbagai jajanan tradisional Jambi.</p>
            
            <p>Pendaftaran stand masih dibuka hingga tanggal 20 Juli 2025. Untuk informasi pendaftaran, silakan menghubungi panitia di Balai Kelurahan Pasir Putih.</p>
          </div>
          <div class="berita-footer">
            <div class="row">
              <div class="col-md-6">
                <small class="text-muted">
                  <i class="bi bi-eye me-1"></i>
                  Dibaca: 312 kali
                </small>
              </div>
              <div class="col-md-6 text-end">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-share me-1"></i>
                    Bagikan berita ini
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item share-btn" href="#" data-platform="whatsapp" data-title="Festival Kuliner Pasir Putih 2025" data-url="{{ url()->current() }}#berita3">
                      <i class="bi bi-whatsapp text-success me-2"></i>WhatsApp
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="facebook" data-title="Festival Kuliner Pasir Putih 2025" data-url="{{ url()->current() }}#berita3">
                      <i class="bi bi-facebook text-primary me-2"></i>Facebook
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="twitter" data-title="Festival Kuliner Pasir Putih 2025" data-url="{{ url()->current() }}#berita3">
                      <i class="bi bi-twitter-x text-dark me-2"></i>Twitter/X
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="telegram" data-title="Festival Kuliner Pasir Putih 2025" data-url="{{ url()->current() }}#berita3">
                      <i class="bi bi-telegram text-info me-2"></i>Telegram
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="copy" data-title="Festival Kuliner Pasir Putih 2025" data-url="{{ url()->current() }}#berita3">
                      <i class="bi bi-clipboard text-secondary me-2"></i>Salin Link
                    </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Berita 4 -->
  <div class="modal fade modal-berita" id="beritaModal4" tabindex="-1" aria-labelledby="beritaModal4Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="beritaModal4Label">
            <i class="bi bi-people me-2"></i>
            Pemilihan Ketua RW dan RT Periode 2025-2028
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="berita-meta">
            <div class="d-flex align-items-center">
              <i class="bi bi-calendar-event text-primary me-2"></i>
              <span class="text-muted">11 Juli 2025</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-person text-primary me-2"></i>
              <span class="text-muted">Admin Kelurahan</span>
            </div>
            <span class="badge bg-primary">Pemerintahan</span>
          </div>
          <div class="berita-content">
            <p><strong>Kelurahan Pasir Putih, Jambi</strong> - Pemilihan ketua RW dan RT untuk periode 2025-2028 telah selesai dilaksanakan. Sebanyak 8 RW dan 32 RT telah memilih ketua baru yang akan menjabat selama 3 tahun ke depan.</p>
            
            <p><strong>Hasil Pemilihan:</strong></p>
            <ul>
              <li><strong>RW 01:</strong> Bapak Samsul Hadi (terpilih kembali)</li>
              <li><strong>RW 02:</strong> Ibu Nurul Hidayah (ketua baru)</li>
              <li><strong>RW 03:</strong> Bapak Ahmad Fauzi (terpilih kembali)</li>
              <li><strong>RW 04:</strong> Bapak M. Ridwan (ketua baru)</li>
              <li><strong>RW 05:</strong> Ibu Siti Aminah (terpilih kembali)</li>
              <li><strong>RW 06:</strong> Bapak Joko Susilo (ketua baru)</li>
              <li><strong>RW 07:</strong> Bapak Bambang Sutrisno (terpilih kembali)</li>
              <li><strong>RW 08:</strong> Ibu Ratna Sari (ketua baru)</li>
            </ul>
            
            <p>Pelantikan ketua RW dan RT baru akan dilaksanakan pada tanggal 15 Juli 2025 di Balai Kelurahan Pasir Putih. Seluruh ketua yang terpilih akan mengikuti orientasi dan pelatihan kepemimpinan pada minggu depan.</p>
          </div>
          <div class="berita-footer">
            <div class="row">
              <div class="col-md-6">
                <small class="text-muted">
                  <i class="bi bi-eye me-1"></i>
                  Dibaca: 178 kali
                </small>
              </div>
              <div class="col-md-6 text-end">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-share me-1"></i>
                    Bagikan berita ini
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item share-btn" href="#" data-platform="whatsapp" data-title="Pemilihan Ketua RW dan RT Periode 2025-2028" data-url="{{ url()->current() }}#berita4">
                      <i class="bi bi-whatsapp text-success me-2"></i>WhatsApp
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="facebook" data-title="Pemilihan Ketua RW dan RT Periode 2025-2028" data-url="{{ url()->current() }}#berita4">
                      <i class="bi bi-facebook text-primary me-2"></i>Facebook
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="twitter" data-title="Pemilihan Ketua RW dan RT Periode 2025-2028" data-url="{{ url()->current() }}#berita4">
                      <i class="bi bi-twitter-x text-dark me-2"></i>Twitter/X
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="telegram" data-title="Pemilihan Ketua RW dan RT Periode 2025-2028" data-url="{{ url()->current() }}#berita4">
                      <i class="bi bi-telegram text-info me-2"></i>Telegram
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="copy" data-title="Pemilihan Ketua RW dan RT Periode 2025-2028" data-url="{{ url()->current() }}#berita4">
                      <i class="bi bi-clipboard text-secondary me-2"></i>Salin Link
                    </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Berita 5 -->
  <div class="modal fade modal-berita" id="beritaModal5" tabindex="-1" aria-labelledby="beritaModal5Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="beritaModal5Label">
            <i class="bi bi-heart-pulse me-2"></i>
            Kegiatan Posyandu Lansia dan Balita
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="berita-meta">
            <div class="d-flex align-items-center">
              <i class="bi bi-calendar-event text-primary me-2"></i>
              <span class="text-muted">10 Juli 2025</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-person text-primary me-2"></i>
              <span class="text-muted">Admin Kelurahan</span>
            </div>
            <span class="badge bg-success">Kesehatan</span>
          </div>
          <div class="berita-content">
            <p><strong>Kelurahan Pasir Putih, Jambi</strong> - Posyandu Kelurahan Pasir Putih mengadakan kegiatan pemeriksaan kesehatan rutin untuk lansia dan balita. Kegiatan ini diikuti oleh 45 lansia dan 60 balita dengan pemeriksaan kesehatan lengkap.</p>
            
            <p><strong>Jenis Pemeriksaan:</strong></p>
            <ul>
              <li><strong>Untuk Lansia:</strong> Tekanan darah, gula darah, berat badan, dan konsultasi kesehatan</li>
              <li><strong>Untuk Balita:</strong> Tinggi badan, berat badan, lingkar kepala, dan imunisasi</li>
            </ul>
            
            <p>Kegiatan ini dilaksanakan di Balai Kelurahan Pasir Putih dengan didukung oleh Puskesmas Jambi Selatan. Tim medis terdiri dari 2 dokter, 3 perawat, dan 2 bidan yang melayani pemeriksaan secara bergantian.</p>
            
            <p>Hasil pemeriksaan menunjukkan bahwa mayoritas lansia dan balita di Kelurahan Pasir Putih memiliki kondisi kesehatan yang baik. Beberapa lansia dengan kondisi khusus telah dirujuk ke Puskesmas untuk pemeriksaan lebih lanjut.</p>
            
            <p>Kegiatan Posyandu akan dilaksanakan secara rutin setiap bulan pada minggu kedua. Warga yang belum mengikuti pemeriksaan dapat mendaftar di kantor kelurahan.</p>
          </div>
          <div class="berita-footer">
            <div class="row">
              <div class="col-md-6">
                <small class="text-muted">
                  <i class="bi bi-eye me-1"></i>
                  Dibaca: 156 kali
                </small>
              </div>
              <div class="col-md-6 text-end">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-share me-1"></i>
                    Bagikan berita ini
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item share-btn" href="#" data-platform="whatsapp" data-title="Kegiatan Posyandu Lansia dan Balita" data-url="{{ url()->current() }}#berita5">
                      <i class="bi bi-whatsapp text-success me-2"></i>WhatsApp
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="facebook" data-title="Kegiatan Posyandu Lansia dan Balita" data-url="{{ url()->current() }}#berita5">
                      <i class="bi bi-facebook text-primary me-2"></i>Facebook
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="twitter" data-title="Kegiatan Posyandu Lansia dan Balita" data-url="{{ url()->current() }}#berita5">
                      <i class="bi bi-twitter-x text-dark me-2"></i>Twitter/X
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="telegram" data-title="Kegiatan Posyandu Lansia dan Balita" data-url="{{ url()->current() }}#berita5">
                      <i class="bi bi-telegram text-info me-2"></i>Telegram
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="copy" data-title="Kegiatan Posyandu Lansia dan Balita" data-url="{{ url()->current() }}#berita5">
                      <i class="bi bi-clipboard text-secondary me-2"></i>Salin Link
                    </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Berita 6 -->
  <div class="modal fade modal-berita" id="beritaModal6" tabindex="-1" aria-labelledby="beritaModal6Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="beritaModal6Label">
            <i class="bi bi-recycle me-2"></i>
            Kegiatan Kerja Bakti Bersih Lingkungan
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="berita-meta">
            <div class="d-flex align-items-center">
              <i class="bi bi-calendar-event text-primary me-2"></i>
              <span class="text-muted">8 Juli 2025</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-person text-primary me-2"></i>
              <span class="text-muted">Admin Kelurahan</span>
            </div>
            <span class="badge bg-secondary">Lingkungan</span>
          </div>
          <div class="berita-content">
            <p><strong>Kelurahan Pasir Putih, Jambi</strong> - Warga Kelurahan Pasir Putih mengadakan kerja bakti membersihkan lingkungan dalam rangka menyambut Hari Kemerdekaan RI. Kegiatan ini diikuti oleh 150 warga dari berbagai RW dan RT.</p>
            
            <p><strong>Lokasi Pembersihan:</strong></p>
            <ul>
              <li>Jalan utama dan gang-gang di semua RW</li>
              <li>Sungai kecil di sekitar Kelurahan Pasir Putih</li>
              <li>Taman dan area publik</li>
              <li>Saluran air dan drainase</li>
            </ul>
            
            <p>Kegiatan dimulai pukul 07.00 WIB dan berakhir pukul 11.00 WIB. Warga membawa peralatan kebersihan seperti sapu, cangkul, dan karung untuk mengumpulkan sampah. Sampah yang terkumpul kemudian dibawa ke tempat pembuangan akhir.</p>
            
            <p>Hasil kerja bakti berhasil mengumpulkan 2 ton sampah yang terdiri dari sampah organik dan anorganik. Kegiatan ini tidak hanya membersihkan lingkungan tetapi juga mempererat tali silaturahmi antar warga.</p>
            
            <p>Kepala Kelurahan Pasir Putih mengapresiasi semangat gotong royong warga dan berharap kegiatan serupa dapat dilaksanakan secara rutin untuk menjaga kebersihan lingkungan kelurahan.</p>
          </div>
          <div class="berita-footer">
            <div class="row">
              <div class="col-md-6">
                <small class="text-muted">
                  <i class="bi bi-eye me-1"></i>
                  Dibaca: 203 kali
                </small>
              </div>
              <div class="col-md-6 text-end">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-share me-1"></i>
                    Bagikan berita ini
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item share-btn" href="#" data-platform="whatsapp" data-title="Kegiatan Kerja Bakti Bersih Lingkungan" data-url="{{ url()->current() }}#berita6">
                      <i class="bi bi-whatsapp text-success me-2"></i>WhatsApp
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="facebook" data-title="Kegiatan Kerja Bakti Bersih Lingkungan" data-url="{{ url()->current() }}#berita6">
                      <i class="bi bi-facebook text-primary me-2"></i>Facebook
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="twitter" data-title="Kegiatan Kerja Bakti Bersih Lingkungan" data-url="{{ url()->current() }}#berita6">
                      <i class="bi bi-twitter-x text-dark me-2"></i>Twitter/X
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="telegram" data-title="Kegiatan Kerja Bakti Bersih Lingkungan" data-url="{{ url()->current() }}#berita6">
                      <i class="bi bi-telegram text-info me-2"></i>Telegram
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="copy" data-title="Kegiatan Kerja Bakti Bersih Lingkungan" data-url="{{ url()->current() }}#berita6">
                      <i class="bi bi-clipboard text-secondary me-2"></i>Salin Link
                    </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Berita 7 -->
  <div class="modal fade modal-berita" id="beritaModal7" tabindex="-1" aria-labelledby="beritaModal7Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="beritaModal7Label">
            <i class="bi bi-calendar-event me-2"></i>
            Sosialisasi Program Sekolah Ramah Anak
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="berita-meta">
            <div class="d-flex align-items-center">
              <i class="bi bi-calendar-event text-primary me-2"></i>
              <span class="text-muted">7 Juli 2025</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-person text-primary me-2"></i>
              <span class="text-muted">Admin Kelurahan</span>
            </div>
            <span class="badge bg-info">Pendidikan</span>
          </div>
          <div class="berita-content">
            <p><strong>Kelurahan Pasir Putih, Jambi</strong> - Kelurahan Pasir Putih bersama Dinas Pendidikan mengadakan sosialisasi Sekolah Ramah Anak di SDN 45. Kegiatan ini diikuti oleh guru, orang tua, dan siswa untuk menciptakan lingkungan belajar yang aman dan nyaman.</p>
            
            <p>Kegiatan ini bertujuan untuk meningkatkan kualitas pendidikan dan memperkuat hubungan antara sekolah, orang tua, dan masyarakat. Selain itu, kegiatan ini juga bertujuan untuk meningkatkan kesadaran masyarakat akan pentingnya pendidikan anak.</p>
            
            <p>Kegiatan akan dilaksanakan pada hari Sabtu, 7 Juli 2025, di Balai Kelurahan Pasir Putih. Waktu pelaksanaan mulai pukul 09.00-11.00 WIB. Peserta diharapkan datang tepat waktu dan membawa alat tulis dan buku pelajaran.</p>
          </div>
          <div class="berita-footer">
            <div class="row">
              <div class="col-md-6">
                <small class="text-muted">
                  <i class="bi bi-eye me-1"></i>
                  Dibaca: 120 kali
                </small>
              </div>
              <div class="col-md-6 text-end">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-share me-1"></i>
                    Bagikan berita ini
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item share-btn" href="#" data-platform="whatsapp" data-title="Sosialisasi Program Sekolah Ramah Anak" data-url="{{ url()->current() }}#berita7">
                      <i class="bi bi-whatsapp text-success me-2"></i>WhatsApp
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="facebook" data-title="Sosialisasi Program Sekolah Ramah Anak" data-url="{{ url()->current() }}#berita7">
                      <i class="bi bi-facebook text-primary me-2"></i>Facebook
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="twitter" data-title="Sosialisasi Program Sekolah Ramah Anak" data-url="{{ url()->current() }}#berita7">
                      <i class="bi bi-twitter-x text-dark me-2"></i>Twitter/X
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="telegram" data-title="Sosialisasi Program Sekolah Ramah Anak" data-url="{{ url()->current() }}#berita7">
                      <i class="bi bi-telegram text-info me-2"></i>Telegram
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="copy" data-title="Sosialisasi Program Sekolah Ramah Anak" data-url="{{ url()->current() }}#berita7">
                      <i class="bi bi-clipboard text-secondary me-2"></i>Salin Link
                    </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Berita 8 -->
  <div class="modal fade modal-berita" id="beritaModal8" tabindex="-1" aria-labelledby="beritaModal8Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="beritaModal8Label">
            <i class="bi bi-calendar-event me-2"></i>
            Bantuan Sembako untuk Warga Kurang Mampu
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="berita-meta">
            <div class="d-flex align-items-center">
              <i class="bi bi-calendar-event text-primary me-2"></i>
              <span class="text-muted">6 Juli 2025</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-person text-primary me-2"></i>
              <span class="text-muted">Admin Kelurahan</span>
            </div>
            <span class="badge bg-danger">Sosial</span>
          </div>
          <div class="berita-content">
            <p><strong>Kelurahan Pasir Putih, Jambi</strong> - Sebanyak 120 paket sembako dibagikan kepada warga kurang mampu di Kelurahan Pasir Putih. Bantuan ini merupakan hasil kerjasama dengan Baznas Kota Jambi dan donatur lokal. Paket sembako terdiri dari beras, gula, minyak goreng, dan lain-lain.</p>
            
            <p>Bantuan ini bertujuan untuk membantu warga yang sedang mengalami kesulitan ekonomi akibat kondisi sosial ekonomi yang sulit. Selain itu, bantuan ini juga bertujuan untuk meningkatkan kualitas hidup warga dan membantu mereka untuk memenuhi kebutuhan pokok.</p>
            
            <p>Pengajuan bantuan dilakukan melalui kantor kelurahan. Warga yang membutuhkan bantuan harus mengisi formulir pengajuan dan menunjukkan bukti kekurangan ekonomi. Setelah itu, formulir akan diperiksa oleh panitia kelurahan. Jika warga memenuhi kriteria, bantuan akan diberikan langsung kepada mereka.</p>
          </div>
          <div class="berita-footer">
            <div class="row">
              <div class="col-md-6">
                <small class="text-muted">
                  <i class="bi bi-eye me-1"></i>
                  Dibaca: 100 kali
                </small>
              </div>
              <div class="col-md-6 text-end">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-share me-1"></i>
                    Bagikan berita ini
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item share-btn" href="#" data-platform="whatsapp" data-title="Bantuan Sembako untuk Warga Kurang Mampu" data-url="{{ url()->current() }}#berita8">
                      <i class="bi bi-whatsapp text-success me-2"></i>WhatsApp
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="facebook" data-title="Bantuan Sembako untuk Warga Kurang Mampu" data-url="{{ url()->current() }}#berita8">
                      <i class="bi bi-facebook text-primary me-2"></i>Facebook
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="twitter" data-title="Bantuan Sembako untuk Warga Kurang Mampu" data-url="{{ url()->current() }}#berita8">
                      <i class="bi bi-twitter-x text-dark me-2"></i>Twitter/X
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="telegram" data-title="Bantuan Sembako untuk Warga Kurang Mampu" data-url="{{ url()->current() }}#berita8">
                      <i class="bi bi-telegram text-info me-2"></i>Telegram
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="copy" data-title="Bantuan Sembako untuk Warga Kurang Mampu" data-url="{{ url()->current() }}#berita8">
                      <i class="bi bi-clipboard text-secondary me-2"></i>Salin Link
                    </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Berita 9 -->
  <div class="modal fade modal-berita" id="beritaModal9" tabindex="-1" aria-labelledby="beritaModal9Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="beritaModal9Label">
            <i class="bi bi-calendar-event me-2"></i>
            Penanaman 500 Pohon di Bantaran Sungai
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="berita-meta">
            <div class="d-flex align-items-center">
              <i class="bi bi-calendar-event text-primary me-2"></i>
              <span class="text-muted">5 Juli 2025</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-person text-primary me-2"></i>
              <span class="text-muted">Admin Kelurahan</span>
            </div>
            <span class="badge bg-success">Lingkungan</span>
          </div>
          <div class="berita-content">
            <p><strong>Kelurahan Pasir Putih, Jambi</strong> - Dalam rangka Hari Lingkungan Hidup, warga Kelurahan Pasir Putih melakukan penanaman 500 bibit pohon di bantaran Sungai Batanghari untuk mencegah erosi dan memperindah lingkungan. Kegiatan ini dilakukan bersama-sama dengan Dinas Kehutanan dan Dinas Lingkungan Hidup.</p>
            
            <p>Kegiatan ini bertujuan untuk meningkatkan kualitas lingkungan dan meningkatkan kesadaran masyarakat akan pentingnya perlindungan lingkungan. Selain itu, kegiatan ini juga bertujuan untuk meningkatkan kesejahteraan ekonomi warga melalui pengembangan industri kehutanan.</p>
            
            <p>Kegiatan akan dilaksanakan pada hari Minggu, 5 Juli 2025, di lokasi penanaman pohon. Waktu pelaksanaan mulai pukul 08.00-11.00 WIB. Peserta diharapkan datang tepat waktu dan membawa alat penanaman pohon dan air untuk menjaga kelembapan tanah.</p>
          </div>
          <div class="berita-footer">
            <div class="row">
              <div class="col-md-6">
                <small class="text-muted">
                  <i class="bi bi-eye me-1"></i>
                  Dibaca: 100 kali
                </small>
              </div>
              <div class="col-md-6 text-end">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-share me-1"></i>
                    Bagikan berita ini
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item share-btn" href="#" data-platform="whatsapp" data-title="Penanaman 500 Pohon di Bantaran Sungai" data-url="{{ url()->current() }}#berita9">
                      <i class="bi bi-whatsapp text-success me-2"></i>WhatsApp
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="facebook" data-title="Penanaman 500 Pohon di Bantaran Sungai" data-url="{{ url()->current() }}#berita9">
                      <i class="bi bi-facebook text-primary me-2"></i>Facebook
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="twitter" data-title="Penanaman 500 Pohon di Bantaran Sungai" data-url="{{ url()->current() }}#berita9">
                      <i class="bi bi-twitter-x text-dark me-2"></i>Twitter/X
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="telegram" data-title="Penanaman 500 Pohon di Bantaran Sungai" data-url="{{ url()->current() }}#berita9">
                      <i class="bi bi-telegram text-info me-2"></i>Telegram
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="copy" data-title="Penanaman 500 Pohon di Bantaran Sungai" data-url="{{ url()->current() }}#berita9">
                      <i class="bi bi-clipboard text-secondary me-2"></i>Salin Link
                    </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Berita 10 -->
  <div class="modal fade modal-berita" id="beritaModal10" tabindex="-1" aria-labelledby="beritaModal10Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="beritaModal10Label">
            <i class="bi bi-calendar-event me-2"></i>
            Pelatihan Digital Marketing untuk UMKM
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="berita-meta">
            <div class="d-flex align-items-center">
              <i class="bi bi-calendar-event text-primary me-2"></i>
              <span class="text-muted">4 Juli 2025</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-person text-primary me-2"></i>
              <span class="text-muted">Admin Kelurahan</span>
            </div>
            <span class="badge bg-warning">Ekonomi</span>
          </div>
          <div class="berita-content">
            <p><strong>Kelurahan Pasir Putih, Jambi</strong> - Pelaku UMKM di Kelurahan Pasir Putih mengikuti pelatihan digital marketing untuk meningkatkan penjualan online. Kegiatan ini didukung oleh Dinas Koperasi dan pelatih profesional. Kegiatan ini bertujuan untuk meningkatkan kemampuan UMKM dalam menggunakan teknologi digital untuk meningkatkan penjualan dan efisiensi operasional.</p>
            
            <p>Kegiatan akan dilaksanakan pada hari Senin, 4 Juli 2025, di Balai Kelurahan Pasir Putih. Waktu pelaksanaan mulai pukul 10.00-12.00 WIB. Peserta diharapkan datang tepat waktu dan membawa laptop atau perangkat lain yang dapat digunakan untuk mengikuti pelatihan.</p>
          </div>
          <div class="berita-footer">
            <div class="row">
              <div class="col-md-6">
                <small class="text-muted">
                  <i class="bi bi-eye me-1"></i>
                  Dibaca: 80 kali
                </small>
              </div>
              <div class="col-md-6 text-end">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-share me-1"></i>
                    Bagikan berita ini
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item share-btn" href="#" data-platform="whatsapp" data-title="Pelatihan Digital Marketing untuk UMKM" data-url="{{ url()->current() }}#berita10">
                      <i class="bi bi-whatsapp text-success me-2"></i>WhatsApp
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="facebook" data-title="Pelatihan Digital Marketing untuk UMKM" data-url="{{ url()->current() }}#berita10">
                      <i class="bi bi-facebook text-primary me-2"></i>Facebook
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="twitter" data-title="Pelatihan Digital Marketing untuk UMKM" data-url="{{ url()->current() }}#berita10">
                      <i class="bi bi-twitter-x text-dark me-2"></i>Twitter/X
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="telegram" data-title="Pelatihan Digital Marketing untuk UMKM" data-url="{{ url()->current() }}#berita10">
                      <i class="bi bi-telegram text-info me-2"></i>Telegram
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="copy" data-title="Pelatihan Digital Marketing untuk UMKM" data-url="{{ url()->current() }}#berita10">
                      <i class="bi bi-clipboard text-secondary me-2"></i>Salin Link
                    </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Berita 11 -->
  <div class="modal fade modal-berita" id="beritaModal11" tabindex="-1" aria-labelledby="beritaModal11Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="beritaModal11Label">
            <i class="bi bi-heart-pulse me-2"></i>
            Pemeriksaan Kesehatan Gratis untuk Lansia
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="berita-meta">
            <div class="d-flex align-items-center">
              <i class="bi bi-calendar-event text-primary me-2"></i>
              <span class="text-muted">3 Juli 2025</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-person text-primary me-2"></i>
              <span class="text-muted">Admin Kelurahan</span>
            </div>
            <span class="badge bg-success">Kesehatan</span>
          </div>
          <div class="berita-content">
            <p><strong>Kelurahan Pasir Putih, Jambi</strong> - Puskesmas Jambi Selatan mengadakan pemeriksaan kesehatan gratis untuk lansia di Balai Kelurahan Pasir Putih. Layanan meliputi cek tekanan darah, gula darah, dan konsultasi dokter. Kegiatan ini bertujuan untuk meningkatkan kesehatan fisik dan mental lansia, serta meningkatkan kesadaran masyarakat akan pentingnya pemeriksaan kesehatan rutin.</p>
            
            <p>Kegiatan akan dilaksanakan pada hari Selasa, 3 Juli 2025, di Balai Kelurahan Pasir Putih. Waktu pelaksanaan mulai pukul 09.00-11.00 WIB. Peserta diharapkan datang tepat waktu dan membawa kartu BPJS atau surat keterangan kesehatan lainnya.</p>
          </div>
          <div class="berita-footer">
            <div class="row">
              <div class="col-md-6">
                <small class="text-muted">
                  <i class="bi bi-eye me-1"></i>
                  Dibaca: 90 kali
                </small>
              </div>
              <div class="col-md-6 text-end">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-share me-1"></i>
                    Bagikan berita ini
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item share-btn" href="#" data-platform="whatsapp" data-title="Pemeriksaan Kesehatan Gratis untuk Lansia" data-url="{{ url()->current() }}#berita11">
                      <i class="bi bi-whatsapp text-success me-2"></i>WhatsApp
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="facebook" data-title="Pemeriksaan Kesehatan Gratis untuk Lansia" data-url="{{ url()->current() }}#berita11">
                      <i class="bi bi-facebook text-primary me-2"></i>Facebook
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="twitter" data-title="Pemeriksaan Kesehatan Gratis untuk Lansia" data-url="{{ url()->current() }}#berita11">
                      <i class="bi bi-twitter-x text-dark me-2"></i>Twitter/X
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="telegram" data-title="Pemeriksaan Kesehatan Gratis untuk Lansia" data-url="{{ url()->current() }}#berita11">
                      <i class="bi bi-telegram text-info me-2"></i>Telegram
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="copy" data-title="Pemeriksaan Kesehatan Gratis untuk Lansia" data-url="{{ url()->current() }}#berita11">
                      <i class="bi bi-clipboard text-secondary me-2"></i>Salin Link
                    </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Berita 12 -->
  <div class="modal fade modal-berita" id="beritaModal12" tabindex="-1" aria-labelledby="beritaModal12Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="beritaModal12Label">
            <i class="bi bi-calendar-event me-2"></i>
            Musyawarah Perencanaan Pembangunan (Musrenbang)
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="berita-meta">
            <div class="d-flex align-items-center">
              <i class="bi bi-calendar-event text-primary me-2"></i>
              <span class="text-muted">2 Juli 2025</span>
            </div>
            <div class="d-flex align-items-center">
              <i class="bi bi-person text-primary me-2"></i>
              <span class="text-muted">Admin Kelurahan</span>
            </div>
            <span class="badge bg-primary">Pemerintahan</span>
          </div>
          <div class="berita-content">
            <p><strong>Kelurahan Pasir Putih, Jambi</strong> - Musrenbang Kelurahan Pasir Putih membahas prioritas pembangunan tahun 2026. Warga, RT/RW, dan perangkat kelurahan aktif memberikan usulan demi kemajuan bersama. Kegiatan ini dilakukan untuk menentukan prioritas pembangunan yang akan dilaksanakan di Kelurahan Pasir Putih pada tahun 2026.</p>
            
            <p>Kegiatan akan dilaksanakan pada hari Rabu, 2 Juli 2025, di Balai Kelurahan Pasir Putih. Waktu pelaksanaan mulai pukul 14.00-16.00 WIB. Peserta diharapkan datang tepat waktu dan membawa ide-ide kreatif untuk pembangunan Kelurahan Pasir Putih.</p>
          </div>
          <div class="berita-footer">
            <div class="row">
              <div class="col-md-6">
                <small class="text-muted">
                  <i class="bi bi-eye me-1"></i>
                  Dibaca: 80 kali
                </small>
              </div>
              <div class="col-md-6 text-end">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-share me-1"></i>
                    Bagikan berita ini
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item share-btn" href="#" data-platform="whatsapp" data-title="Musyawarah Perencanaan Pembangunan (Musrenbang)" data-url="{{ url()->current() }}#berita12">
                      <i class="bi bi-whatsapp text-success me-2"></i>WhatsApp
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="facebook" data-title="Musyawarah Perencanaan Pembangunan (Musrenbang)" data-url="{{ url()->current() }}#berita12">
                      <i class="bi bi-facebook text-primary me-2"></i>Facebook
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="twitter" data-title="Musyawarah Perencanaan Pembangunan (Musrenbang)" data-url="{{ url()->current() }}#berita12">
                      <i class="bi bi-twitter-x text-dark me-2"></i>Twitter/X
                    </a></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="telegram" data-title="Musyawarah Perencanaan Pembangunan (Musrenbang)" data-url="{{ url()->current() }}#berita12">
                      <i class="bi bi-telegram text-info me-2"></i>Telegram
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item share-btn" href="#" data-platform="copy" data-title="Musyawarah Perencanaan Pembangunan (Musrenbang)" data-url="{{ url()->current() }}#berita12">
                      <i class="bi bi-clipboard text-secondary me-2"></i>Salin Link
                    </a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
  function slidePrestasi(direction) {
    const slider = document.getElementById('prestasiSlider');
    const card = slider.querySelector('.prestasi-card-home');
    const scrollAmount = card ? card.offsetWidth + 24 : 300;
    slider.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
  }
  </script>

  <script>
  const slider = document.getElementById('prestasiSlider');
  const card = slider.querySelector('.prestasi-card-home');
  const scrollAmount = card ? card.offsetWidth + 24 : 300;
  let autoScrollDirection = 1; // 1 = kanan, -1 = kiri
  let autoScrollInterval = null;

  function slidePrestasi(direction) {
    slider.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
  }

  function startAutoScroll() {
    if (autoScrollInterval) clearInterval(autoScrollInterval);
    autoScrollInterval = setInterval(() => {
      // Cek posisi scroll
      const maxScroll = slider.scrollWidth - slider.clientWidth;
      if (slider.scrollLeft >= maxScroll - 2) {
        autoScrollDirection = -1;
      } else if (slider.scrollLeft <= 2) {
        autoScrollDirection = 1;
      }
      slider.scrollBy({ left: autoScrollDirection * scrollAmount, behavior: 'smooth' });
    }, 2200); // jeda 2.2 detik, bisa diubah sesuai keinginan
  }

  // Pause auto scroll saat mouse hover
  slider.addEventListener('mouseenter', () => clearInterval(autoScrollInterval));
  slider.addEventListener('mouseleave', startAutoScroll);

  document.addEventListener('DOMContentLoaded', startAutoScroll);
  </script>

</body>

@endsection
