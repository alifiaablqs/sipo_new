@extends('layouts.app')

@section('title', 'Memo')

@section('content')
<div class="container-fluid px-4 py-0 mt-0">
  <div class="card shadow-sm border-0">
    <div class="card-body py-3">

      <h3 class="fw-bold mb-3">Memo</h3>

      {{-- Breadcrumb --}}
      <div class="row mb-3">
        <div class="col-12">
          <div class="bg-white border rounded-2 px-3 py-2 w-100 d-flex align-items-center">
            <a href="{{ route('superadmin.dashboard') }}" class="text-decoration-none text-primary">Beranda</a>
            <span class="text-muted ms-1">/ Memo</span>
          </div>
        </div>
      </div>

      @php
        // Normalisasi nilai agar placeholder muncul bila tidak valid/kosong
        $allowedStatus = ['pending','approved','rejected'];
        $status   = old('status', request('status'));
        if (!in_array($status, $allowedStatus, true)) $status = null;

        $allowedDiv   = ['IT','HR','Finance'];
        $division = old('division', request('division'));
        if (!in_array($division, $allowedDiv, true)) $division = null;
      @endphp

      {{-- Row Filter --}}
      <form class="row g-2 align-items-center" method="GET" action="{{ route('superadmin.memo.index') }}">
        {{-- Status --}}
        <div class="col-12 col-md-auto">
          <select class="form-select rounded-3" name="status" aria-label="Status">
            <option value="" @selected(is_null($status)) disabled>Status</option>
            <option value="pending"  @selected($status === 'pending')>Pending</option>
            <option value="approved" @selected($status === 'approved')>Approved</option>
            <option value="rejected" @selected($status === 'rejected')>Rejected</option>
          </select>
        </div>

        {{-- Tanggal Awal --}}
        <div class="col-12 col-md-auto">
          <input type="date" class="form-control rounded-3" name="start_date"
                 value="{{ request('start_date') }}" placeholder="Tanggal Awal" aria-label="Tanggal Awal">
        </div>

        {{-- Separator panah (hidden di mobile) --}}
        <div class="col-auto d-none d-md-flex align-items-center">
          <span class="mx-1">→</span>
        </div>

        {{-- Tanggal Akhir --}}
        <div class="col-12 col-md-auto">
          <input type="date" class="form-control rounded-3" name="end_date"
                 value="{{ request('end_date') }}" placeholder="Tanggal Akhir" aria-label="Tanggal Akhir">
        </div>

        {{-- Pencarian --}}
        <div class="col-12 col-md">
          <div class="input-group">
            <span class="input-group-text rounded-start-3"><i class="fas fa-search"></i></span>
            <input type="text" class="form-control rounded-end-3" name="q"
                   value="{{ request('q') }}" placeholder="Cari" aria-label="Cari">
          </div>
        </div>

        {{-- Divisi --}}
        <div class="col-12 col-md-auto">
          <select class="form-select rounded-3" name="division" aria-label="Pilih Divisi">
            <option value="" @selected(is_null($division)) disabled>Pilih Divisi</option>
            <option value="IT"      @selected($division === 'IT')>IT</option>
            <option value="HR"      @selected($division === 'HR')>HR</option>
            <option value="Finance" @selected($division === 'Finance')>Finance</option>
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
              <th class="text-center" style="width:25%;">Nama Dokumen</th>
              <th class="text-center" style="width:12%;">Tanggal Memo</th>
              <th class="text-center" style="width:5%;">Seri</th>
              <th class="text-center" style="width:25%;">Dokumen</th>
              <th class="text-center" style="width:12%;">Tanggal Disahkan</th>
              <th class="text-center" style="width:10%;">Pengirim</th>
              <th class="text-center" style="width:8%;">Status</th>
              <th class="text-center" style="width:8%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($memos as $index => $memo)
                    <tr>
                        <td class="nomor">{{ $index + 1 }}</td>
                        <td class="nama-dokumen 
                                {{ $memo->status == 'reject' ? 'text-danger' : ($memo->status == 'correction' ? 'text-warning' : ($memo->status == 'approve' ? 'text-success' : '')) }}"
                            style="{{ $memo->status == 'pending' ? 'color: #0dcaf0;' : '' }}">
                            {{ $memo->judul ?? '-' }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($memo->tgl_dibuat)->format('d-m-Y') ?? '-'}}</td>
                        <td>{{ $memo->seri_surat ?? '-' }}</td>
                        <td>{{ $memo->nomor_memo ?? '-' }}</td>
                        <td>{{ $memo->tgl_disahkan ? \Carbon\Carbon::parse($memo->tgl_disahkan)->format('d-m-Y') : '-' }}</td>
                        <td>{{ $memo->kode ?? '-' }}</td>
                        </td>
                        <td>
                            @if ($memo->status == 'reject')
                                <span class="badge bg-danger">Ditolak</span>
                            @elseif ($memo->status == 'pending')
                                <span class="badge bg-info">Diproses</span>
                            @elseif ($memo->status == 'correction')
                                <span class="badge bg-warning">Dikoreksi</span>
                            @else
                                <span class="badge bg-success">Diterima</span>
                            @endif
                        </td>
                                                 <td class="text-center">
                             <div class="d-flex justify-content-center gap-2">
                                 @if ($memo->status == 'approve' || $memo->status == 'reject')
                                     {{-- Button Arsip untuk status approve/reject --}}
                                     <form action="{{ route('arsip.archive', ['document_id' => $memo->id_memo, 'jenis_document' => 'Memo']) }}" 
                                           method="POST" style="display: inline;">
                                         @csrf
                                         @method('POST')
                                         <button type="submit" 
                                                 class="btn btn-sm rounded-circle text-white border-0"
                                                 style="background-color:#FFAD46; width:30px; height:30px; display:flex; align-items:center; justify-content:center;"
                                                 title="Arsip"
                                                 onclick="return confirm('Apakah Anda yakin ingin mengarsipkan memo ini?')">
                                             <i class="fa-solid fa-archive"></i>
                                         </button>
                                     </form>
                                 @else
                                     {{-- Button Arsip untuk status pending/correction --}}
                                     <button type="button" 
                                             class="btn btn-sm rounded-circle text-white border-0"
                                             style="background-color:#FFAD46; width:30px; height:30px; display:flex; align-items:center; justify-content:center;"
                                             onclick="showArsipModal({{ $memo->id_memo }}, '{{ $memo->judul ?? $memo->nama_dokumen }}')"
                                             title="Arsip">
                                         <i class="fa-solid fa-archive"></i>
                                     </button>
                                     
                                     {{-- Button Delete --}}
                                     <button type="button" 
                                             class="btn btn-sm rounded-circle text-white border-0"
                                             style="background-color:#F25961; width:30px; height:30px; display:flex; align-items:center; justify-content:center;"
                                             onclick="showDeleteModal({{ $memo->id_memo }}, '{{ $memo->judul ?? $memo->nama_dokumen }}')"
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
            {{ $memos->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>

    </div>
  </div>
</div>


{{-- Modal Arsip --}}
<div class="modal fade" id="arsipModal" tabindex="-1" aria-labelledby="arsipModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="arsipModalLabel">Arsip Memo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin mengarsipkan memo <strong id="arsipMemoTitle"></strong>?</p>
        <p class="text-muted">Memo yang diarsipkan akan dipindahkan ke arsip dan tidak akan muncul di daftar utama.</p>
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
        <h5 class="modal-title" id="deleteModalLabel">Hapus Memo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus memo <strong id="deleteMemoTitle"></strong>?</p>
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
let currentMemoId = null;


// Function untuk menampilkan modal arsip
function showArsipModal(memoId, memoTitle) {
  currentMemoId = memoId;
  document.getElementById('arsipMemoTitle').textContent = memoTitle;
  
  const modal = new bootstrap.Modal(document.getElementById('arsipModal'));
  modal.show();
}

// Function untuk menampilkan modal delete
function showDeleteModal(memoId, memoTitle) {
  currentMemoId = memoId;
  document.getElementById('deleteMemoTitle').textContent = memoTitle;
  
  const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
  modal.show();
}

// Function untuk konfirmasi arsip
function confirmArsip() {
  if (!currentMemoId) return;
  
  // Implement AJAX call untuk arsip
  fetch(`/superadmin/memo/${currentMemoId}/arsip`, {
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
      showNotification('Memo berhasil diarsipkan', 'success');
      
      // Reload page or update table
      setTimeout(() => {
        window.location.reload();
      }, 1000);
    } else {
      showNotification('Gagal mengarsipkan memo', 'error');
    }
  })
  .catch(error => {
    showNotification('Terjadi kesalahan', 'error');
  });
}

// Function untuk konfirmasi delete
function confirmDelete() {
  if (!currentMemoId) return;
  
  // Implement AJAX call untuk delete
  fetch(`/superadmin/memo/${currentMemoId}`, {
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
      showNotification('Memo berhasil dihapus', 'success');
      
      // Reload page or update table
      setTimeout(() => {
        window.location.reload();
      }, 1000);
    } else {
      showNotification('Gagal menghapus memo', 'error');
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
