<nav id="sidebarMenu" class="col-2 d-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column fs-6">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="home"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/mahasiswa*') ? 'active' : '' }}" href="/dashboard/mahasiswa">
            <span data-feather="user-plus"></span>
            Mahasiswa
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/rumpun*') ? 'active' : '' }}" href="/dashboard/rumpun">
            <span data-feather="layers"></span>
            Rumpun
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/karyailmiah*') ? 'active' : '' }}" href="/dashboard/karyailmiah">
            <span data-feather="book"></span>
            Karya Ilmiah
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/reports*') ? 'active' : '' }}" href="/dashboard/reports">
            <span data-feather="clipboard"></span>
            Reports
          </a>
        </li>
      </ul>
    </div>
  </nav>
