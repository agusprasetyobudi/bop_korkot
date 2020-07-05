<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{!! asset('assets/img/Logo_kemen_PU.jpg') !!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      {{-- <span class="brand-text font-weight-light">AdminLTE 3</span> --}}
      <span class="brand-text font-weight-light">{!! env('APP_NAMES') !!}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library --> 
          <li class="nav-item">
            <a href="{!! route('home') !!}" class="nav-link @if(Request::segment(1)=='home') active @endif">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          <!-- Firm Transfer -->
          <li class="nav-item">
            <a href="{!! route('firmView') !!}" class="nav-link @if(Request::segment(1)=='firm') active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Firm Transfer 
              </p>
            </a> 
          </li> 
          <!-- Rekapitulasi -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link @if(Request::segment(1)=='rekapitulasi') active @endif">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Rekapitulasi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{!! route('buktiTransferView') !!}" class="nav-link @if(Request::segment(2)=='bukti-transfer') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bukti Transfer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!! route('buktiPengeluaranView') !!}" class="nav-link @if(Request::segment(2)=='bukti-pengeluaran') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bukti Pengeluaran</p>
                </a>
              </li> 
            </ul>
          </li>
          <!-- Buku Kas -->
          <li class="nav-item">
            <a href="{!! route('bukuKasView') !!}" class="nav-link @if(Request::segment(1)=='buku-kas') active @endif">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Buku Kas 
              </p>
            </a> 
          </li>
          <!-- Buku Bank -->
          <li class="nav-item">
            <a href="{!! route('bukuBankView') !!}" class="nav-link @if(Request::segment(1)=='buku-bank') active @endif">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Buku Bank
              </p>
            </a> 
          </li>
          <!-- Kontrak -->
          <li class="nav-item">
            <a href="{!! route('KontrakHome') !!}" class="nav-link @if(Request::segment(1)=='kontrak') active @endif">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Kontrak 
              </p>
            </a> 
          </li>
          <!-- Level PMU -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link @if(Request::segment(1)=='pmu') active @endif">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Level PMU
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{!! route('rekapInputView') !!}" class="nav-link @if(Request::segment(2)=='rekap-input') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rekapitulasi Input </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!! route('invoiceTerakhirView') !!}" class="nav-link @if(Request::segment(2)=='invoice-terakhir') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice Terakhir</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!! route('rekapKontrakView') !!}" class="nav-link @if(Request::segment(2)=='rekap-kontrak') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rekapitulasi Sisa Kontrak</p>
                </a>
              </li> 
            </ul>
          </li>
          <!-- Report -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link @if(Request::segment(1)=='report') active @endif">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{!! route('firmTransferReporting') !!}" class="nav-link @if(Request::segment(2)=='firm-transfer') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Firm Transfer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!! route('penerimaTransferReporting') !!}" class="nav-link @if(Request::segment(2)=='penerimaan-transfer') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penerimaan Transfer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!! route('pengeluaranTransferReporting') !!}" class="nav-link @if(Request::segment(2)=='pengeluaran-transfer') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengeluaran Transfer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!! route('bukuBankReporting') !!}" class="nav-link @if(Request::segment(2)=='buku-bank') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buku Bank</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Data Master -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link @if(Request::segment(1)=='master') active @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{!! route('provinsiView') !!}" class="nav-link @if(Request::segment(2)=='provinsi') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Provinsi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!! route('KabupatenKotaView') !!}" class="nav-link @if(Request::segment(2)=='kabupaten') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kabupaten / Kota</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!! route('OSPView') !!}" class="nav-link @if(Request::segment(2)=='osp') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>OSP</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!! route('KantorView') !!}" class="nav-link @if(Request::segment(2)=='kantor') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kantor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!! route('JabatanView') !!}" class="nav-link @if(Request::segment(2)=='jabatan') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jabatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!! route('KomponenBiayaView') !!}" class="nav-link @if(Request::segment(2)=='komponen') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Komponen Biaya</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!! route('AmandemenView') !!}" class="nav-link @if(Request::segment(2)=='amandemen') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Amandemen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!! route('AktifitasView') !!}" class="nav-link @if(Request::segment(2)=='aktifitas') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aktifitas</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Pengguna -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link @if(Request::segment(1)=='pengguna') active @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Pengguna
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{!! route('KelompokPenggunaView') !!}" class="nav-link @if(Request::segment(2)=='kelompok-pengguna') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelompok Pengguna</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{!! route('PenggunaView') !!}" class="nav-link @if(Request::segment(2)=='user') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengguna</p>
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