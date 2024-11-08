<header class="navbar navbar-header navbar-header-fixed">
      <a href="" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
      <div class="navbar-brand">
        <!--<a href="{{ url('dashboard') }}" class="df-logo">laki<span>ekspress</span></a>-->
        <img src="{{ asset('img/logo.jpeg') }}" class="df-logo" height="40px" width="100px" alt="lakiekspress logo" />
      </div><!-- navbar-brand -->
      <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
          <a href="{{ url('dashboard') }}" class="df-logo">LK<span>E</span></a>
          <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
        </div><!-- navbar-menu-header -->
        <ul class="nav navbar-menu">
          <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li>

          @can('menu_dashboard')
          <li class="nav-item active"><a href="{{ url('dashboard') }}" class="nav-link"><i data-feather="pie-chart"></i> Dashboard</a></li>
          @endcan

          @can('menu_transaction')
          <li class="nav-item with-sub">
            <a href="#" class="nav-link"><i data-feather="layers"></i> Transaksi</a>
            <div class="navbar-menu-sub">
              <div class="d-lg-flex">
                <ul>
                  @can('menu_transaction_order')
                  <li class="nav-label">Order</li>
                  @can('order_create')
                  <li class="nav-sub-item"><a href="{{ url('transaction/orders/create') }}" class="nav-sub-link"><i data-feather="log-in"></i> Tambah Baru</a></li>
                  @endcan
                  <!--<li class="nav-sub-item"><a href="{{ url('transaction/orders') }}" class="nav-sub-link"><i data-feather="log-in"></i> Draft</a></li>
                  <li class="nav-sub-item"><a href="{{ url('transaction/orders') }}" class="nav-sub-link"><i data-feather="log-in"></i> Dalam Perjalanan</a></li>-->
                  <li class="nav-sub-item"><a href="{{ url('transaction/orders') }}" class="nav-sub-link"><i data-feather="log-in"></i> Semua Data</a></li>
                  @endcan

                  @can('menu_transaction_document')
                  <li class="nav-label mg-t-20"">STT Balik</li>
                  <li class="nav-sub-item"><a href="{{ url('transaction/documents') }}" class="nav-sub-link"><i data-feather="user-plus"></i> Dokumen STT Balik</a></li>
                  @endcan
                  <!--
                  <li class="nav-label mg-t-20"">Retur</li>
                  <li class="nav-sub-item"><a href="page-signup.html" class="nav-sub-link"><i data-feather="user-plus"></i> Data Retur</a></li>
                  -->
                </ul>
              </div>
            </div><!-- nav-sub -->
          </li>
          @endcan

          @can('menu_master_data')
          <li class="nav-item with-sub">
            <a href="#" class="nav-link"><i data-feather="layers"></i> Master</a>
            <div class="navbar-menu-sub">
              <div class="d-lg-flex">
                <ul>
                  @can('menu_master_data_general')
                  <li class="nav-label">Umum</li>
                  <li class="nav-sub-item"><a href="{{ url('master/drivers') }}" class="nav-sub-link"><i data-feather="log-in"></i> Driver</a></li>
                  <li class="nav-sub-item"><a href="{{ url('master/trucks') }}" class="nav-sub-link"><i data-feather="log-in"></i> Armada</a></li>
                  <li class="nav-sub-item"><a href="{{ url('master/truck-types') }}" class="nav-sub-link"><i data-feather="log-in"></i> Jenis Armada</a></li>
                  <!--<li class="nav-sub-item"><a href="{{ url('master/services') }}" class="nav-sub-link"><i data-feather="log-in"></i> Layanan</a></li>
                  <li class="nav-sub-item"><a href="{{ url('master/service-groups') }}" class="nav-sub-link"><i data-feather="log-in"></i> Group Layanan</a></li>-->
                  @endcan

                  @can('menu_master_data_location')
                  <li class="nav-label mg-t-20"">Lokasi</li>
                  <li class="nav-sub-item"><a href="{{ url('master/provinces') }}" class="nav-sub-link"><i data-feather="user-plus"></i> Provinsi</a></li>
                  <li class="nav-sub-item"><a href="{{ url('master/cities') }}" class="nav-sub-link"><i data-feather="user-plus"></i> Kota</a></li>
                  <!--<li class="nav-sub-item"><a href="{{ url('master/areas') }}" class="nav-sub-link"><i data-feather="user-plus"></i> Area</a></li>-->
                  <li class="nav-sub-item"><a href="{{ url('master/branchs') }}" class="nav-sub-link"><i data-feather="users"></i> Cabang (LKE)</a></li>
                  @endcan
                </ul>
                <ul>
                  @can('menu_master_data_partner')
                  <li class="nav-label">Rekanan</li>
                  <li class="nav-sub-item"><a href="{{ url('master/customers') }}" class="nav-sub-link"><i data-feather="user"></i> Customer</a></li>
                  <li class="nav-sub-item"><a href="{{ url('master/agents') }}" class="nav-sub-link"><i data-feather="users"></i> Agent</a></li>
                  @endcan

                  @can('menu_master_data_price')
                  <li class="nav-label mg-t-20"">Harga</li>
                  <li class="nav-sub-item"><a href="{{ url('master/payment-types') }}" class="nav-sub-link"><i data-feather="user-plus"></i> Jenis Pembayaran</a></li>
                  <li class="nav-sub-item"><a href="{{ url('master/banks') }}" class="nav-sub-link"><i data-feather="user-plus"></i> Bank</a></li>
                  <li class="nav-sub-item"><a href="{{ url('master/locations') }}" class="nav-sub-link"><i data-feather="log-in"></i> Tarif Reguler</a></li>
                  <li class="nav-sub-item"><a href="{{ url('master/trucking-prices') }}" class="nav-sub-link"><i data-feather="log-in"></i> Tarif Trucking</a></li>
                  <!--<li class="nav-label mg-t-20"">Status</li>
                  <li class="nav-sub-item"><a href="{{ url('master/status-orders') }}" class="nav-sub-link"><i data-feather="user-plus"></i> Status Order</a></li>
                  <li class="nav-sub-item"><a href="{{ url('master/status-awbs') }}" class="nav-sub-link"><i data-feather="user-plus"></i> Status AWB</a></li>
                  -->
                  @endcan
                </ul>
                </div>
            </div><!-- nav-sub -->
          </li>
          @endcan

          @can('menu_warehouse')
          <li class="nav-item with-sub">
            <a href="#" class="nav-link"><i data-feather="layers"></i> Gudang</a>
            <div class="navbar-menu-sub">
              <div class="d-lg-flex">
                <ul>
                  <li class="nav-label">Data</li>
                  <li class="nav-sub-item"><a href="{{ url('warehouse/order') }}" class="nav-sub-link"><i data-feather="user"></i> List Order STT</a></li>
                  <li class="nav-sub-item"><a href="{{ url('warehouse/manifest') }}" class="nav-sub-link"><i data-feather="user"></i> List Manifest</a></li>
                  <li class="nav-sub-item"><a href="{{ url('warehouse/trip') }}" class="nav-sub-link"><i data-feather="user"></i> List Pengiriman</a></li>
                  <li class="nav-sub-item"><a href="{{ url('warehouse/delivery-schedule') }}" class="nav-sub-link"><i data-feather="user"></i> Jadwal Pengiriman</a></li>
                </ul>
                </div>
            </div><!-- nav-sub -->
          </li>
          @endcan

          @can('menu_administration')
          <li class="nav-item with-sub">
            <a href="#" class="nav-link"><i data-feather="layers"></i> Administrasi</a>
            <div class="navbar-menu-sub">
              <div class="d-lg-flex">
                <ul>
                  @can('menu_administration_approval')
                  <li class="nav-label">Approval</li>
                  <li class="nav-sub-item"><a href="{{ url('approval/customer-master-prices') }}" class="nav-sub-link"><i data-feather="user"></i> Harga Customer</a></li>
                  <li class="nav-sub-item"><a href="{{ url('approval/customer-trucking-prices') }}" class="nav-sub-link"><i data-feather="user"></i> Harga Trucking Customer</a></li>
                  <li class="nav-sub-item"><a href="{{ url('approval/invoices') }}" class="nav-sub-link"><i data-feather="user"></i> Appr. Invoice (AR)</a></li>
                  @endcan

                  @can('menu_administration_accounting')
                  <li class="nav-label mg-t-20">Akunting</li>
                  <li class="nav-sub-item"><a href="{{ url('accounting/invoice') }}" class="nav-sub-link"><i data-feather="user"></i> Invoices (AR)</a></li>
                  <li class="nav-sub-item"><a href="{{ url('accounting/bill') }}" class="nav-sub-link"><i data-feather="user"></i> Invoice Agent (AP)</a></li>
                  <li class="nav-sub-item"><a href="#" class="nav-sub-link"><i data-feather="user"></i> General Ledger</a></li>
                  <!--<li class="nav-sub-item"><a href="{{ url('accounting/cash-receipt') }}" class="nav-sub-link"><i data-feather="user-plus"></i> Kasbon Realisasi</a></li>-->
                  @endcan
                  
                </ul>
                <ul>
                  @can('menu_administration_company_profile')
                  <li class="nav-label">Company Profile</li>
                  <li class="nav-sub-item"><a href="{{ url('marketing/compro-service') }}" class="nav-sub-link"><i data-feather="user"></i> Layanan</a></li>
                  <li class="nav-sub-item"><a href="{{ url('marketing/compro-post') }}" class="nav-sub-link"><i data-feather="user"></i> Artikel</a></li>
                  <li class="nav-sub-item"><a href="{{ url('marketing/compro-gallery') }}" class="nav-sub-link"><i data-feather="user"></i> Gallery</a></li>
                  <li class="nav-sub-item"><a href="{{ url('marketing/compro-main-banner') }}" class="nav-sub-link"><i data-feather="user"></i> Banner Utama</a></li>
                  <li class="nav-sub-item"><a href="{{ url('marketing/compro-banner') }}" class="nav-sub-link"><i data-feather="user"></i> Banner</a></li>
                  <li class="nav-sub-item"><a href="{{ url('marketing/compro-contact') }}" class="nav-sub-link"><i data-feather="user"></i> Calon Customer</a></li>
                  @endcan
                </ul>
                </div>
            </div><!-- nav-sub -->
          </li>
          @endcan

          @can('menu_driver')
          <li class="nav-item with-sub">
            <a href="#" class="nav-link"><i data-feather="layers"></i> Driver</a>
            <div class="navbar-menu-sub">
              <div class="d-lg-flex">
                <ul>
                  <li class="nav-label">Data</li>
                  <li class="nav-sub-item"><a href="{{ url('driver/manifest') }}" class="nav-sub-link"><i data-feather="user"></i> List Manifest</a></li>
                  <!--<li class="nav-sub-item"><a href="{{ url('driver/schedule') }}" class="nav-sub-link"><i data-feather="user"></i> Jadwal Pengiriman</a></li>
                  <li class="nav-sub-item"><a href="{{ url('driver/cash-receipt') }}" class="nav-sub-link"><i data-feather="user"></i> Kasbon</a></li>-->
                </ul>
                </div>
            </div><!-- nav-sub -->
          </li>
          @endcan

          @can('menu_report')
          <li class="nav-item with-sub">
            <a href="#" class="nav-link"><i data-feather="layers"></i> Laporan</a>
            <div class="navbar-menu-sub">
              <div class="d-lg-flex">
                <ul>
                  @can('menu_report_transaction')
                  <li class="nav-label">Transaksi</li>
                  <li class="nav-sub-item"><a href="{{ url('report/order') }}" class="nav-sub-link"><i data-feather="user"></i> Order</a></li>
                  @endcan
                  <li class="nav-label mg-t-20"">Data</li>
                  <li class="nav-sub-item"><a href="{{ url('report/agent') }}" class="nav-sub-link"><i data-feather="user-plus"></i> Agent</a></li>
                </ul>
                </div>
            </div><!-- nav-sub -->
          </li>
          @endcan

          @can('menu_setting')
          <li class="nav-item with-sub">
            <a href="#" class="nav-link"><i data-feather="layers"></i> Setting</a>
            <div class="navbar-menu-sub">
              <div class="d-lg-flex">
                <ul>
                  <li class="nav-label">General</li>
                  <li class="nav-sub-item"><a href="{{ url('setting/users') }}" class="nav-sub-link"><i data-feather="user"></i> List User</a></li>
                  <li class="nav-sub-item"><a href="{{ url('setting/departemens') }}" class="nav-sub-link"><i data-feather="user"></i> List Departemen</a></li>
                  
                  <!--<li class="nav-label mg-t-20"">Workflow</li>
                  <li class="nav-sub-item"><a href="{{ url('setting/approval') }}" class="nav-sub-link"><i data-feather="user-plus"></i> Approval</a></li>
                  -->
                </ul>
                </div>
            </div><!-- nav-sub -->
          </li>
          @endcan

        </ul>
      </div><!-- navbar-menu-wrapper -->
      <div class="navbar-right">
        <!--<a id="navbarSearch" href="" class="search-link"><i data-feather="search"></i></a>-->
        <div class="dropdown dropdown-notification">
          <a href="" class="dropdown-link new-indicator" data-toggle="dropdown">
            <i data-feather="bell"></i>
            <span id="notifCount">0</span>
          </a>

          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header">Notifikasi</div>
            <div id="notif"></div>
            
            <div class="dropdown-footer"><a href="{{ url('profile') }}">Lihat Semua Notifikasi</a></div>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->

        <div class="dropdown dropdown-profile">
          <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static">
            <!--<div class="avatar avatar-sm"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>-->
              <div class="avatar avatar-sm"><span class="avatar-initial rounded-circle bg-dark">
                {{ substr(Session::get('user')->name,0,1) }}
              </span></div>
          </a><!-- dropdown-link -->
          <div class="dropdown-menu dropdown-menu-right tx-13">
            <!--<div class="avatar avatar-lg mg-b-15"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>-->
            <div class="avatar avatar-lg mg-b-15"><span class="avatar-initial rounded-circle bg-dark">
                {{ substr(Session::get('user')->name,0,1) }}
              </span></div>
            <h6 class="tx-semibold mg-b-5">{{ Session::get('user')->name }}</h6>
            <p class="mg-b-25 tx-12 tx-color-03">NIK : {{ Session::get('user')->nik }}</p>

            @can('menu_profile')
            <a href="{{ url('profile') }}" class="dropdown-item"><i data-feather="user"></i> Lihat Profil</a>
            @endcan
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"><i data-feather="log-out"></i>Keluar</a>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </div><!-- navbar-right -->

      <div class="navbar-search">
        <div class="navbar-search-header">
          <input type="search" class="form-control" placeholder="Type and hit enter to search...">
          <button class="btn"><i data-feather="search"></i></button>
          <a id="navbarSearchClose" href="" class="link-03 mg-l-5 mg-lg-l-10"><i data-feather="x"></i></a>
        </div><!-- navbar-search-header -->
        <div class="navbar-search-body">
          <label class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Recent Searches</label>
          <ul class="list-unstyled">
            <li><a href="dashboard-one.html">modern dashboard</a></li>
            <li><a href="app-calendar.html">calendar app</a></li>
            <li><a href="../../collections/modal.html">modal examples</a></li>
            <li><a href="../../components/el-avatar.html">avatar</a></li>
          </ul>

          <hr class="mg-y-30 bd-0">

          <label class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Search Suggestions</label>

          <ul class="list-unstyled">
            <li><a href="dashboard-one.html">cryptocurrency</a></li>
            <li><a href="app-calendar.html">button groups</a></li>
            <li><a href="../../collections/modal.html">form elements</a></li>
            <li><a href="../../components/el-avatar.html">contact app</a></li>
          </ul>
        </div><!-- navbar-search-body -->
      </div><!-- navbar-search -->
    </header><!-- navbar -->