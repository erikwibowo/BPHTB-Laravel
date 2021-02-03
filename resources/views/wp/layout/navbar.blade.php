<nav class="main-header navbar navbar-expand-md navbar-dark">
    <div class="container">
      <a href="{{ route('index') }}" class="navbar-brand">
        <img src="{{ asset('data_file/logo.png') }}" alt="AdminLTE Logo" class="brand-image" style="opacity: 1">
        <span class="brand-text font-weight-light">{{ config('variable.webname') }}</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{ route('index') }}" class="nav-link active">Beranda</a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Pelayanan BPHTB</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{ route('wp.login') }}" class="dropdown-item">Login WP </a></li>
              <li><a href="#" class="dropdown-item">Some other action</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Informasi</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Some action </a></li>
              <li><a href="#" class="dropdown-item">Some other action</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">PPAT</a>
          </li>
        </ul>

        <!-- SEARCH FORM -->
        {{-- <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form> --}}
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" id="btntheme">
            <i id="icontheme" class="fas fa-sun"></i>
          </a>
        </li>
        <script>
          $(document).ready(function(){
            $("#btntheme").on("click", function(){
              if (localStorage.getItem('theme') == 'light' || localStorage.getItem('theme') == null) {
                localStorage.setItem('theme', 'dark-mode')
                document.querySelector('body').classList.add(localStorage.getItem('theme'));
                document.querySelector('body').classList.remove('light');
                $("#icontheme").attr("class","fas fa-moon");
              }else{
                localStorage.setItem('theme', 'light')
                document.querySelector('body').classList.add(localStorage.getItem('theme'));
                document.querySelector('body').classList.remove('dark-mode');
                $("#icontheme").attr("class","fas fa-sun");
              }
            });
            localStorage.getItem('theme') == "light" || localStorage.getItem('theme') == null ? $("#icontheme").attr("class","fas fa-sun"):$("#icontheme").attr("class","fas fa-moon");
            document.querySelector('body').classList.add(localStorage.getItem('theme'));
          });
        </script>
        <!-- Notifications Dropdown Menu -->
        {{-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li> --}}
      </ul>
    </div>
  </nav>