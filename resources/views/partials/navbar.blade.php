<nav class="navbar bg-body-tertiary" style="background-image: url('/img/nav/bg.png');">
  <div class="container grid gap-4" style="justify-content: flex-start">
  <img src="/img/nav/piksilogo.png" alt="logo" class="d-inline-block align-text-top">
    <a class="navbar-brand text-white" href="/" >
    </a>
  </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #905E96;">
  <div class="container column-gap-5" class="text-light-emphasis">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
              <li class="nav-item pe-3">
                  <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Beranda</a>
              </li>
              <li class="nav-item pe-3">
                <a class="nav-link {{ Request::is('/karyailmiah?tipe=Jurnal') ? 'active' : '' }}" href="/karyailmiah?tipe=Jurnal">Jurnal</a>
              </li>
              <li class="nav-item pe-3">
                <a class="nav-link {{ Request::is('/karyailmiah?tipe=Skripsi / Tugas Akhir') ? 'active' : '' }}" href="/karyailmiah?tipe=Skripsi / Tugas Akhir">Skripsi dan Tugas Akhir</a>
              </li>
              <li class="nav-item pe-3">
                <a class="nav-link {{ Request::is('/karyailmiah?tipe=HKI') ? 'active' : '' }}" href="/karyailmiah?tipe=HKI">HKI</a>
              </li>
              <li class="nav-item pe-3">
                <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">Tentang Kami</a>
              </li>
              @can('user')
              <li class="nav-item pe-3">
                <a class="nav-link {{ Request::is('karyailmiah/create') ? 'active' : '' }}" href="/karyailmiah/create">Unggah Karya Ilmiah</a>
              </li>
              @endcan
          </ul>

          <ul class="navbar-nav ms-auto">
                @auth
                  <li class="nav-item dropdown">
                  <div class="btn-group dropdown-us">
                    <button type="button" class="btn dropdown-toggle border-0" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        <img src="/img/user/user.png" alt="user" style="width: 40px;">
                        @if ($notif)
                            <span class="position-absolute badge p-2 bg-danger border border-light rounded-circle" style="top: 5%; left: 50%;">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end p-" aria-labelledby="navbarDropdown">
                        @can('admin')
                            <li><a class="dropdown-item" href="/dashboard">Dashboard Admin</a></li>
                            <li><hr class="dropdown-divider"></li>
                        @endcan
                        <li><a class="dropdown-item" href="/user/{{ auth()->user()->id }}/edit">Ubah Kata Sandi</a></li>
                        @can('user')
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item position-relative" href="/user/post">Postingan Saya
                                @if ($notif)
                                    <span class="position-absolute badge p-1 bg-danger border border-light rounded-circle" style="top: 35%; left: 89%;">
                                        <span class="visually-hidden">New alerts</span>
                                    </span>
                                @endif
                            </a>
                        </li>
                        @endcan
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="/logout" method="post">
                                    @csrf
                                <button type="submit" class="dropdown-item">Keluar</button>
                            </form>
                        </li>
                    </ul>
                  </li>
                @else
                <ul class="navbar-nav ms auto">
                  <li class="nav-item">
                    <a class="btn btn-dark border-0 btn-masuk my-2 my-sm-0" type="submit" style="background-color: #800080;" href="/login">Masuk</a>
                  </li>
                </ul>
                </li>
                @endauth
            </ul>
      </div>
  </div>
</nav>
