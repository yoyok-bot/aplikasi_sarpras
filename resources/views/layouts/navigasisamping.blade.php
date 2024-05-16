<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('asset/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SARPRAS 1 DAWUHAN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{route('dashboard')}}" class="nav-link {{(request()->is('dashboard','/')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
                </a>
            </li>
            @canany(['CRUD ADMIN','CRUD KEPSEK'])
          <li class="nav-header">DATA MASTER</li>
          <li class="nav-item {{(request()->is('barang*','ruangan*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{(request()->is('barang*','ruangan*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                DATA MASTER
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('barang')}}" class="nav-link {{(request()->is('barang*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>BARANG</p>
                </a>
              </li>
              @can('CRUD ADMIN')
              <li class="nav-item">
                <a href="{{url('ruangan')}}" class="nav-link {{(request()->is('ruangan*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>RUANG</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcanany
          <li class="nav-header">TRANSAKSI BARANG</li>
          <li class="nav-item {{(request()->is('pinjam*')) ? 'menu-open' : '' }}">
            <a href="{{url('pinjam')}}" class="nav-link {{(request()->is('pinjam*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                TRANSAKSI BARANG
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{url('pinjam')}}" class="nav-link {{(request()->is('pinjam*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>PINJAMAN</p>
                </a>
            </li>
            </ul>
          </li>
          @can('CRUD ADMIN')
          <li class="nav-header">DATA USER</li>
          <li class="nav-item {{(request()->is('siswa*','guru*','kepsek*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{(request()->is('siswa*','guru*','kepsek*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                DATA USER
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{url('kepsek')}}" class="nav-link {{(request()->is('kepsek*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>KEPALA SEKOLAH</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('guru')}}" class="nav-link {{(request()->is('guru*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>GURU</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('siswa')}}" class="nav-link {{(request()->is('siswa*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>SISWA</p>
                </a>
            </li>
            </ul>
        </li>
        @endcan
        <li class="nav-header">DATA BARANG RUSAK</li>
        <li class="nav-item {{(request()->is('sampah*','service*')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{(request()->is('sampah*','service*')) ? 'active' : '' }}">
              <i class="nav-icon far fa-image"></i>
              <p>
                DATA BARANG RUSAK
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{url('sampah')}}" class="nav-link {{(request()->is('sampah*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>RUSAK BERAT</p>
                </a>
                </li>
                <li class="nav-item">
                <a href="{{url('service')}}" class="nav-link {{(request()->is('service*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>RUSAK RINGAN</p>
                </a>
                </li>
            </ul>
          </li>
    </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
