<nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm">
  <div class="container-fluid">

    <!-- Sidebar Toggle -->
    <button class="btn toggle-sidebar" type="button">
      <i class="fa fa-bars" style="color:#BEA6EB;background:#E9E6FB;padding:10px;border-radius:10px;"></i>
    </button>

    <!-- Area kosong untuk layout -->
    <div class="flex-grow-1"></div>

    <!-- Header Icons -->
    <ul class="navbar-nav ms-auto align-items-center" style="gap:24px;">

      <!-- Notifikasi -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
           data-bs-toggle="dropdown" aria-expanded="false"
           style="background:#E9E6FB; padding:8px 12px; border-radius:20px;">
          <i class="fa fa-bell" style="color:#BEA6EB;font-size:20px;"></i>
          <span class="notification badge bg-danger" id="notif-count">0</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="notifDropdown" style="width:300px; max-height:400px; overflow:auto;">
          <li class="dropdown-header fw-bold">Notifikasi</li>
          <li><div id="notif-body" class="px-3 py-2 text-center text-muted">Memuat notifikasi...</div></li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <a class="dropdown-item text-center fw-bold" href="javascript:void(0);">
              Lihat semua notifikasi <i class="fa fa-angle-right"></i>
            </a>
          </li>
        </ul>
      </li>

      <!-- Profile & Settings Gabung Satu Bulatan -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
           data-bs-toggle="dropdown" aria-expanded="false"
           style="background:#E9E6EB; padding:10px 22px; border-radius:16px; display: flex; align-items: center; justify-content: center; gap:10px;">
          <i class="fa fa-user-circle" style="color:#BEA6EB;font-size:20px;"></i>
          <i class="fa fa-cog" style="color:#56C7EB;font-size:20px;"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="profileDropdown" style="min-width: 260px;">
          <li class="px-3 py-2">
            <div class="fw-bold mb-1">Selamat Datang, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</div>
            <div class="text-muted mb-2" style="font-size:14px;">{{ Auth::user()->position->nm_position }}</div>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <a class="dropdown-item" href="{{ route('edit-profile') }}">
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
