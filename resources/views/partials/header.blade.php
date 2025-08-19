<!-- Header (Static Kaiadmin Style) -->
<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
  <div class="container-fluid">

    <!-- Tombol hamburger -->
    <button class="btn btn-toggle toggle-sidebar">
    <i class="bi bi-list fs-2 text-dark"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar">
    {{-- isi sidebar --}}
    </div>

      {{-- Logo (opsional) --}}
      {{-- <a class="navbar-brand fw-bold text-primary" href="{{ route(Auth::user()->role->nm_role . '.dashboard') }}">
          <i class="fas fa-layer-group me-2"></i> {{ config('app.name', 'MyApp') }}
      </a> --}}

      <ul class="navbar-nav ms-auto align-items-center">

          {{-- Notifikasi --}}
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                 data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-bell" style="color:#A3A2A2;"></i>
                  <span class="notification badge bg-danger" id="notif-count">0</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="notifDropdown" style="width:300px; max-height:400px; overflow:auto;">
                  <li class="dropdown-header fw-bold">Notifikasi</li>
                  <li>
                      <div id="notif-body" class="px-3 py-2 text-center text-muted">
                          Memuat notifikasi...
                      </div>
                  </li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                      <a class="dropdown-item text-center fw-bold" href="javascript:void(0);">
                          Lihat semua notifikasi <i class="fa fa-angle-right"></i>
                      </a>
                  </li>
              </ul>
          </li>
          {{-- End Notifikasi --}}

          {{-- Profile --}}
          <li class="nav-item dropdown ms-3">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button"
                 data-bs-toggle="dropdown" aria-expanded="false">
                  {{-- <img src="{{ Auth::user()->profile_image ? 'data:image/jpeg;base64,'.Auth::user()->profile_image : asset('assets/img/avatars/default.jpg') }}"
                       class="rounded-circle me-2" alt="profile" width="40" height="40" style="object-fit:cover;">
                  <span class="fw-bold">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span> --}}
              </a>
              <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="profileDropdown" style="min-width: 250px;">
                  <li class="px-3 py-2 text-center">
                      <p class="text-muted mb-1" style="font-size:12px;">Login sebagai</p>
                      {{-- <h6 class="mb-2 fw-bold">{{ Auth::user()->position->nm_position }}</h6> --}}
                  </li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                      <a class="dropdown-item" href="{{ route('edit-profile.superadmin') }}">
                          <i class="fas fa-user me-2"></i> Profil
                      </a>
                  </li>
                  <li>
                      <form action="{{ route('logout') }}" method="POST">
                          @csrf
                          <button class="dropdown-item text-danger" type="submit">
                              <i class="fas fa-sign-out-alt me-2"></i> Keluar
                          </button>
                      </form>
                  </li>
              </ul>
          </li>
          {{-- End Profile --}}
      </ul>
  </div>
</nav>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.querySelector(".toggle-sidebar");
    const sidebar = document.querySelector(".sidebar");

    toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("active");
    });
});
</script>


{{-- JS Notifikasi --}}
{{-- <script>
document.addEventListener("DOMContentLoaded", function() {
    function fetchNotificationCount() {
        fetch("{{ route('notifications.count') }}")
            .then(res => res.json())
            .then(data => {
                document.getElementById("notif-count").textContent = data.count > 0 ? data.count : "";
            });
    }

    function formatDate(dateString) {
        let options = { day: '2-digit', month: 'short', year: 'numeric',
                        hour: '2-digit', minute: '2-digit', hour12: false };
        return new Intl.DateTimeFormat('id-ID', options).format(new Date(dateString)).replace(',', ' -');
    }

    function fetchNotifications() {
        fetch("{{ route('notifications.index') }}")
            .then(res => res.json())
            .then(data => {
                let notifBody = document.getElementById("notif-body");
                notifBody.innerHTML = "";
                if(data.notifications.length === 0){
                    notifBody.innerHTML = '<p class="text-muted">Tidak ada notifikasi terbaru.</p>';
                } else {
                    data.notifications.forEach(notif => {
                        notifBody.innerHTML += `
                            <div class="border-bottom py-2 text-start ${!notif.dibaca ? 'bg-light' : ''}">
                                <div class="fw-bold">${notif.judul}</div>
                                <small>Perihal: ${notif.judul_document}</small><br>
                                <small class="text-muted">${formatDate(notif.updated_at)}</small>
                            </div>
                        `;
                    });
                }
            });
    }

    document.getElementById("notifDropdown").addEventListener("click", function(){
        fetch("{{ route('notifications.markAsRead') }}")
            .then(() => fetchNotificationCount());
        fetchNotifications();
    });

    fetchNotificationCount();
});
</script> --}}
