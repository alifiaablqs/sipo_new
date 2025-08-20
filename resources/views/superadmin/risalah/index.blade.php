@extends('layouts.app')

@section('title', 'Risalah')

@section('content')
<div class="container-fluid px-4 py-0 mt-0">
  <div class="card shadow-sm border-0">
    <div class="card-body py-3">

      <h3 class="fw-bold mb-3">Risalah</h3>

      {{-- Breadcrumb --}}
      <div class="row mb-3">
        <div class="col-12">
          <div class="bg-white border rounded-2 px-3 py-2 w-100 d-flex align-items-center">
            <a href="{{ route('superadmin.dashboard') }}" class="text-decoration-none text-primary">Beranda</a>
            <span class="text-muted ms-1">/ Risalah</span>
          </div>
        </div>
      </div>

      @php
        // Normalisasi nilai agar placeholder muncul bila tidak valid/kosong
        $allowedStatus = ['pending','approve','reject','correction'];
        $status   = old('status', request('status'));
        if (!in_array($status, $allowedStatus, true)) $status = null;

        $allowedKode = $kode->toArray();
        $selectedKode = old('kode', request('kode'));
        if (!in_array($selectedKode, $allowedKode, true)) $selectedKode = null;

        $allowedDivisi = $divisi->pluck('id_divisi')->toArray();
        $selectedDivisi = old('divisi_id_divisi', request('divisi_id_divisi'));
        if (!in_array($selectedDivisi, $allowedDivisi, true)) $selectedDivisi = null;
      @endphp

      {{-- Row Filter --}}
      <form class="row g-2 align-items-center" method="GET" action="{{ route('superadmin.risalah.index') }}">
        {{-- Status --}}
        <div class="col-12 col-md-auto">
          <select class="form-select rounded-3" name="status" aria-label="Status">
            <option value="" @selected(is_null($status)) disabled>Status</option>
            <option value="pending"  @selected($status === 'pending')>Pending</option>
            <option value="approve" @selected($status === 'approve')>Approved</option>
            <option value="reject" @selected($status === 'reject')>Rejected</option>
            <option value="correction" @selected($status === 'correction')>Correction</option>
          </select>
        </div>

        {{-- Tanggal Awal --}}
        <div class="col-12 col-md-auto">
          <input type="date" class="form-control rounded-3" name="tgl_dibuat_awal"
                 value="{{ request('tgl_dibuat_awal') }}" placeholder="Tanggal Awal" aria-label="Tanggal Awal">
        </div>

        {{-- Separator panah (hidden di mobile) --}}
        <div class="col-auto d-none d-md-flex align-items-center">
          <span class="mx-1">→</span>
        </div>

        {{-- Tanggal Akhir --}}
        <div class="col-12 col-md-auto">
          <input type="date" class="form-control rounded-3" name="tgl_dibuat_akhir"
                 value="{{ request('tgl_dibuat_akhir') }}" placeholder="Tanggal Akhir" aria-label="Tanggal Akhir">
        </div>

        {{-- Pencarian --}}
        <div class="col-12 col-md">
          <div class="input-group">
            <span class="input-group-text rounded-start-3"><i class="fas fa-search"></i></span>
            <input type="text" class="form-control rounded-end-3" name="search"
                   value="{{ request('search') }}" placeholder="Cari judul atau nomor risalah" aria-label="Cari">
          </div>
        </div>

        {{-- Kode --}}
        <div class="col-12 col-md-auto">
          <select class="form-select rounded-3" name="kode" aria-label="Pilih Kode">
            <option value="" @selected(is_null($selectedKode)) disabled>Pilih Kode</option>
            @foreach($kode as $k)
              <option value="{{ $k }}" @selected($selectedKode === $k)>{{ $k }}</option>
            @endforeach
          </select>
        </div>

        {{-- Divisi --}}
        <div class="col-12 col-md-auto">
          <select class="form-select rounded-3" name="divisi_id_divisi" aria-label="Pilih Divisi">
            <option value="" @selected(is_null($selectedDivisi)) disabled>Pilih Divisi</option>
            @foreach($divisi as $d)
              <option value="{{ $d->id_divisi }}" @selected($selectedDivisi == $d->id_divisi)>{{ $d->nm_divisi }}</option>
            @endforeach
          </select>
        </div>

        {{-- Tombol Filter --}}
        <div class="col-12 col-md-auto">
          <button type="submit" class="btn btn-primary rounded-3">
            <i class="fas fa-filter me-1"></i>Filter
          </button>
        </div>
      </form>

      {{-- Tabel --}}
      <div class="table-responsive mt-3">
        <table class="table table-bordered custom-table-bagian">
          <thead>
            <tr>
              <th class="text-center" style="width:5%;">No</th>
              <th class="text-center" style="width:20%;">Judul Risalah</th>
              <th class="text-center" style="width:12%;">Tanggal Dibuat</th>
              <th class="text-center" style="width:8%;">Seri</th>
              <th class="text-center" style="width:15%;">Nomor Risalah</th>
              <th class="text-center" style="width:12%;">Agenda</th>
              <th class="text-center" style="width:10%;">Tempat</th>
              <th class="text-center" style="width:8%;">Status</th>
              <th class="text-center" style="width:10%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($risalahs as $index => $risalah)
                    <tr>
                        <td class="nomor">{{ $index + 1 }}</td>
                        <td class="nama-dokumen 
                                {{ $risalah->status == 'reject' ? 'text-danger' : ($risalah->status == 'correction' ? 'text-warning' : ($risalah->status == 'approve' ? 'text-success' : '')) }}"
                            style="{{ $risalah->status == 'pending' ? 'color: #0dcaf0;' : '' }}">
                            {{ $risalah->judul ?? '-' }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($risalah->tgl_dibuat)->format('d-m-Y') ?? '-'}}</td>
                        <td>{{ $risalah->seri_surat ?? '-' }}</td>
                        <td>{{ $risalah->nomor_risalah ?? '-' }}</td>
                        <td>{{ $risalah->agenda ?? '-' }}</td>
                        <td>{{ $risalah->tempat ?? '-' }}</td>
                        <td>
                            @if ($risalah->status == 'reject')
                                <span class="badge bg-danger">Ditolak</span>
                            @elseif ($risalah->status == 'pending')
                                <span class="badge bg-info">Diproses</span>
                            @elseif ($risalah->status == 'correction')
                                <span class="badge bg-warning">Dikoreksi</span>
                            @else
                                <span class="badge bg-success">Diterima</span>
                            @endif
                        </td>
                        <td class="text-center">
                             <div class="d-flex justify-content-center gap-2">
                                 @if ($risalah->status == 'approve' || $risalah->status == 'reject')
                                     {{-- Button Arsip untuk status approve/reject --}}
                                     <form action="{{ route('arsip.archive', ['document_id' => $risalah->id_risalah, 'jenis_document' => 'Risalah']) }}" 
                                           method="POST" style="display: inline;">
                                         @csrf
                                         @method('POST')
                                         <button type="submit" 
                                                 class="btn btn-sm rounded-circle text-white border-0"
                                                 style="background-color:#FFAD46; width:30px; height:30px; display:flex; align-items:center; justify-content:center;"
                                                 title="Arsip"
                                                 onclick="return confirm('Apakah Anda yakin ingin mengarsipkan risalah ini?')">
                                             <i class="fa-solid fa-archive"></i>
                                         </button>
                                     </form>
                                 @else
                                     {{-- Button Arsip untuk status pending/correction --}}
                                     <button type="button" 
                                             class="btn btn-sm rounded-circle text-white border-0"
                                             style="background-color:#FFAD46; width:30px; height:30px; display:flex; align-items:center; justify-content:center;"
                                             onclick="showArsipModal({{ $risalah->id_risalah }}, '{{ $risalah->judul ?? $risalah->nama_dokumen }}')"
                                             title="Arsip">
                                         <i class="fa-solid fa-archive"></i>
                                     </button>
                                     
                                     {{-- Button Delete --}}
                                     <button type="button" 
                                             class="btn btn-sm rounded-circle text-white border-0"
                                             style="background-color:#F25961; width:30px; height:30px; display:flex; align-items:center; justify-content:center;"
                                             onclick="showDeleteModal({{ $risalah->id_risalah }}, '{{ $risalah->judul ?? $risalah->nama_dokumen }}')"
                                             title="Hapus">
                                         <i class="fa-solid fa-trash"></i>
                                     </button>
                                 @endif
                             </div>
                         </td>
                    </tr>
                @endforeach
          </tbody>
        </table>
      </div>
      
      <!-- Pagination -->
      <div class="d-flex justify-content-end mt-3">
          {{ $risalahs->onEachSide(1)->links('pagination::bootstrap-5') }}
      </div>

    </div>
  </div>
</div>

{{-- Modal Arsip --}}
<div class="modal fade" id="arsipModal" tabindex="-1" aria-labelledby="arsipModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="arsipModalLabel">Arsip Risalah</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin mengarsipkan risalah <strong id="arsipRisalahTitle"></strong>?</p>
        <p class="text-muted">Risalah yang diarsipkan akan dipindahkan ke arsip dan tidak akan muncul di daftar utama.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-warning" onclick="confirmArsip()">
          <i class="fa-solid fa-archive me-1"></i>Arsip
        </button>
      </div>
    </div>
  </div>
</div>

{{-- Modal Delete --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Hapus Risalah</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus risalah <strong id="deleteRisalahTitle"></strong>?</p>
        <p class="text-danger"><i class="fa-solid fa-exclamation-triangle me-1"></i>Tindakan ini tidak dapat dibatalkan!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" onclick="confirmDelete()">
          <i class="fa-solid fa-trash me-1"></i>Hapus
        </button>
      </div>
    </div>
  </div>
</div>

<script>
let currentRisalahId = null;

// Function untuk menampilkan modal arsip
function showArsipModal(risalahId, risalahTitle) {
  currentRisalahId = risalahId;
  document.getElementById('arsipRisalahTitle').textContent = risalahTitle;
  
  const modal = new bootstrap.Modal(document.getElementById('arsipModal'));
  modal.show();
}

// Function untuk menampilkan modal delete
function showDeleteModal(risalahId, risalahTitle) {
  currentRisalahId = risalahId;
  document.getElementById('deleteRisalahTitle').textContent = risalahTitle;
  
  const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
  modal.show();
}

// Function untuk konfirmasi arsip
function confirmArsip() {
  if (!currentRisalahId) return;
  
  // Implement AJAX call untuk arsip
  fetch(`/superadmin/risalah/${currentRisalahId}/arsip`, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'Content-Type': 'application/json',
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Close modal
      const modal = bootstrap.Modal.getInstance(document.getElementById('arsipModal'));
      modal.hide();
      
      // Show success message
      showNotification('Risalah berhasil diarsipkan', 'success');
      
      // Reload page or update table
      setTimeout(() => {
        window.location.reload();
      }, 1000);
    } else {
      showNotification('Gagal mengarsipkan risalah', 'error');
    }
  })
  .catch(error => {
    showNotification('Terjadi kesalahan', 'error');
  });
}

// Function untuk konfirmasi delete
function confirmDelete() {
  if (!currentRisalahId) return;
  
  // Implement AJAX call untuk delete
  fetch(`/superadmin/risalah/${currentRisalahId}`, {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'Content-Type': 'application/json',
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Close modal
      const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
      modal.hide();
      
      // Show success message
      showNotification('Risalah berhasil dihapus', 'success');
      
      // Reload page or update table
      setTimeout(() => {
        window.location.reload();
      }, 1000);
    } else {
      showNotification('Gagal menghapus risalah', 'error');
    }
  })
  .catch(error => {
    showNotification('Terjadi kesalahan', 'error');
  });
}

// Function untuk menampilkan notifikasi
function showNotification(message, type) {
  // Implement sesuai dengan library notifikasi yang digunakan
  // Contoh menggunakan SweetAlert atau library lain
  if (typeof Swal !== 'undefined') {
    Swal.fire({
      title: type === 'success' ? 'Berhasil!' : 'Error!',
      text: message,
      icon: type,
      timer: 3000,
      showConfirmButton: false
    });
  } else {
    // Fallback alert
    alert(message);
  }
}
</script>
@endsection
