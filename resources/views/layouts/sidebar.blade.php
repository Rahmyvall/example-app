 <div data-simplebar>
     <ul class="app-menu">

         <li class="menu-title">Menu Utama</li>

         <!-- Dashboard -->
         <li class="menu-item">
             <a href="{{ route('dashboard') }}" class="menu-link waves-effect waves-light">
                 <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                 <span class="menu-text">Dashboard</span>
             </a>
         </li>

         <li class="menu-title">Master Data</li>

         <!-- Kategori -->
         <li class="menu-item">
             <a href="{{ route('admin.categories.index') }}" class="menu-link waves-effect waves-light">
                 <span class="menu-icon"><i class="bx bx-category"></i></span>
                 <span class="menu-text"> Kategori COA </span>
             </a>
         </li>

         <!-- Chart of Account -->
         <li class="menu-item">
             <a href="{{ route('admin.chart-of-accounts.index') }}" class="menu-link waves-effect waves-light">
                 <span class="menu-icon"><i class="bx bx-list-ul"></i></span>
                 <span class="menu-text"> Chart of Accounts </span>
             </a>
         </li>

         <li class="menu-title">Transaksi</li>

         <!-- Transaksi -->
         <li class="menu-item">
             <a href="#transactionSubmenu" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">
                 <span class="menu-icon"><i class="bx bx-transfer"></i></span>
                 <span class="menu-text"> Transaksi </span>
                 <span class="menu-arrow"></span>
             </a>

             <div class="collapse" id="transactionSubmenu">
                 <ul class="sub-menu">

                     <li class="menu-item">
                         <a href="{{ route('admin.transactions.index') }}" class="menu-link">
                             <span class="menu-text">Daftar Transaksi</span>
                         </a>
                     </li>

                     <li class="menu-item">
                         <a href="{{ route('admin.transactions.create') }}" class="menu-link">
                             <span class="menu-text">Tambah Transaksi</span>
                         </a>
                     </li>

                     <li class="menu-item">
                         <a href="{{ route('admin.transactions.report') }}" class="menu-link">
                             <span class="menu-text">Laporan</span>
                         </a>
                     </li>

                 </ul>
             </div>
         </li>

         <li class="menu-title">Laporan</li>

         <!-- Profit & Loss -->
         <li class="menu-item">
             <a href="{{ route('admin.financial-summary.index') }}" class="menu-link waves-effect waves-light">
                 <span class="menu-icon"><i class="bx bx-chart"></i></span>
                 <span class="menu-text">Financial Profit/Loss</span>
             </a>
         </li>

         <!-- Optional: Laporan lain -->
         <li class="menu-item">
             <a data-bs-toggle="collapse" href="#reportMenu" class="menu-link">
                 <span class="menu-icon"><i class="bx bx-file"></i></span>
                 <span class="menu-text">Laporan</span>
             </a>

             <div class="collapse" id="reportMenu">
                 <ul class="menu-sub">

                     <li class="menu-item">
                         <a href="{{ route('admin.monthly-report.index') }}" class="menu-link">
                             Laporan Bulanan
                         </a>
                     </li>

                 </ul>
             </div>
         </li>

         <li class="menu-title">Pengaturan</li>

         <li class="menu-item">
             <a href="{{ route('admin.users.index') }}" class="menu-link waves-effect waves-light">
                 <span class="menu-icon"><i class="bx bx-user-circle"></i></span>
                 <span class="menu-text">Pengguna</span>
             </a>
         </li>
     </ul>
 </div>
