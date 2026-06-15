<!DOCTYPE html>
<html lang="en" id="htmlRoot">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Keuangan Cerdas dengan AI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Bootstrap 5.3 -->
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!-- AOS Animate on Scroll -->
    <link href="{{asset('frontend/css/aos.css')}}" rel="stylesheet" />
    <!-- Swiper -->
    <link href="{{asset('frontend/css/swiper-bundle.min.css')}}" rel="stylesheet" />
    <!-- all min css -->
    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}" />
    <!-- magnific CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}" />

</head>

<body>
    <!-- ======================== LANDING PAGE ======================== -->
    <div id="landing">
        <!-- NAVBAR -->
        <nav id="nbar">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <a href="#" class="d-flex align-items-center gap-2"
                        style="font-size:1.2rem;font-weight:700;color:var(--tx)">

                        <div class="logo-i">
                            <i class="fa-solid fa-wallet"></i>
                        </div>

                        <span>KeuanganKu</span>
                    </a>
                    <div class="d-flex align-items-center gap-2">
                        <button class="boc d-flex align-items-center justify-content-center" id="thbtn"
                            style="width:38px;height:38px;padding:0;border-radius:12px" aria-label="Toggle theme">
                            <i class="fa-solid fa-sun" id="suni" style="display:none"></i>
                            <i class="fa-solid fa-moon" id="mooni"></i>
                        </button>
                        <button type="button" class="boc px-3 py-2 d-none d-sm-flex align-items-center gap-1"
                            onclick="window.location='{{ route('login') }}'">
                            <i class="fa-regular fa-user fa-sm"></i> Log in
                        </button>
                        <button class="boc d-lg-none px-2 py-2" id="mbtog" style="border-radius:10px">
                            <i class="fa-solid fa-bars" id="barIcon"></i>
                            <i class="fa-solid fa-xmark" id="xIcon" style="display:none"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        <div id="mbmenu">
            <a href="#features" class="nav-link d-block py-3 border-bottom"
                style="border-color:var(--bd)!important">Features</a>
            <a href="#integrations" class="nav-link d-block py-3 border-bottom"
                style="border-color:var(--bd)!important">Integrations</a>
            <a href="#pricing" class="nav-link d-block py-3 border-bottom"
                style="border-color:var(--bd)!important">Pricing</a>
            <a href="#faq" class="nav-link d-block py-3">FAQ</a>
            <div class="d-flex gap-2 mt-3">
                <button type="button" class="boc flex-fill py-2 btn" onclick="goToLogin()">
                    Log in
                </button>
            </div>
        </div>
        <!-- HERO -->
        <section id="hero" style="position:relative;overflow:hidden">

            <!-- BACKGROUND IMAGE (optional pengganti aur) -->
            <div style="
        position:absolute;
        inset:0;
        background:url('assets/img/hero-bg.jpg') center/cover no-repeat;
        opacity:.08;
        z-index:0;">
            </div>

            <div class="container position-relative" style="z-index:2">

                <!-- HERO TEXT -->
                <div class="text-center">

                    <span class="badge rounded-pill text-bg-light px-3 py-2">
                        🚀 Platform Intelijen Keuangan Berbasis AI
                    </span>

                    <h1 class="display-4 fw-bold mt-4">
                        Kelola Keuangan Bisnis
                        <span class="text-primary">Lebih Cerdas</span>
                    </h1>

                    <p class="lead text-secondary mx-auto mt-3" style="max-width:700px;">
                        Pantau arus kas secara real-time, otomatisasi laporan keuangan,
                        analisis performa bisnis, dan dapatkan insight berbasis AI
                        untuk mendukung pertumbuhan perusahaan Anda.
                    </p>

                    <div class="d-flex justify-content-center gap-3 flex-wrap mt-4">
                        <a href="#" class="btn btn-primary btn-lg px-4">
                            Mulai Gratis
                        </a>

                        <a href="#" class="btn btn-outline-secondary btn-lg px-4">
                            Lihat Demo
                        </a>
                    </div>

                    <div class="row justify-content-center text-center mt-5 g-4">

                        <div class="col-6 col-md-3">
                            <h3 class="fw-bold mb-1">10K+</h3>
                            <small class="text-muted">Transaksi Diproses</small>
                        </div>

                        <div class="col-6 col-md-3">
                            <h3 class="fw-bold mb-1">99.9%</h3>
                            <small class="text-muted">Uptime Sistem</small>
                        </div>

                        <div class="col-6 col-md-3">
                            <h3 class="fw-bold mb-1">24/7</h3>
                            <small class="text-muted">Monitoring AI</small>
                        </div>

                    </div>

                </div>

                <div class="row justify-content-center mt-5">

                    <div class="col-lg-10">

                        <div class="card shadow border-0">

                            <div class="card-body p-2">

                                <img src="{{ asset('frontend/img/logo.png') }}" alt="Dashboard Keuangan AI"
                                    class="img-fluid rounded">

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>
        <!-- PROBLEM -->
        <section class="sp position-relative py-5 bg-soft">
            <div class="container position-relative">

                <!-- HEADER -->
                <div class="text-center mb-5 rv">
                    <span class="badge-modern">
                        Categories
                    </span>

                    <h2 class="stitle mt-3 fw-bold">
                        Manage your <span class="text-primary">data</span>
                    </h2>

                    <p class="ssub mx-auto text-muted" style="max-width:520px">
                        Click a category card to instantly view its stored data.
                    </p>
                </div>

                <!-- GRID -->
                <div class="row g-4">

                    @foreach($categories as $cat)
                    <div class="col-12 col-md-6 col-lg-4 rv">

                        <div class="category-card modern-card h-100 p-4 rounded-4" data-bs-toggle="modal"
                            data-bs-target="#categoryModal" data-id="{{ $cat->id }}" data-name="{{ $cat->name }}">

                            <!-- ICON -->
                            <div class="icon-wrap mb-3">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>

                            <!-- TITLE -->
                            <h3 class="card-title">
                                {{ $cat->name }}
                            </h3>

                            <!-- DESC -->
                            <p class="card-desc">
                                Klik untuk melihat detail data <strong>{{ $cat->name }}</strong>
                            </p>

                        </div>

                    </div>
                    @endforeach

                </div>

            </div>
        </section>
        <!-- ================= MODAL ================= -->
        <div class="modal fade" id="categoryModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">

                <div class="modal-content modal-modern">

                    <!-- HEADER -->
                    <div class="modal-header border-0 pb-0">
                        <div>
                            <h5 class="fw-bold mb-0" id="modalTitle">Category</h5>
                            <small class="text-muted">Detail data category</small>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- BODY -->
                    <div class="modal-body pt-3">

                        <div class="table-responsive">
                            <table class="table table-modern align-middle mb-0">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>

                                <tbody id="categoryTableBody">
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            Klik category untuk menampilkan data
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!-- FEATURES -->
        <section id="features" class="sp" style="background:var(--bg2)">
            <div class="container">

                <!-- HEADER -->
                <div class="text-center mb-5 rv">
                    <span class="slbl">Categories</span>
                    <h2 class="stitle">
                        Chart of <span class="gt">Accounts Features</span>
                    </h2>
                    <p class="ssub mx-auto">
                        Manage your financial accounts with structured categories and clean organization.
                    </p>
                </div>

                <!-- GRID FEATURES -->
                <div class="row g-3">
                    @forelse($accounts as $account)
                    <div class="col-md-4 rv">

                        <div class="gc p-4 h-100 coa-card" style="cursor:pointer;"
                            onclick="loadChart({{ $account->id }})">

                            <div class="ftico">
                                <i class="fa-solid fa-file-invoice"></i>
                            </div>

                            <h3 class="fs-5 fw-semibold mb-2">
                                {{ $account->name }}
                            </h3>

                            <p style="font-size:.875rem;color:var(--tx2)">
                                Code: {{ $account->code }} <br>
                                Category: {{ $account->category->name ?? '-' }}
                            </p>

                            <span class="ftag">
                                COA • {{ strtoupper($account->category->name ?? 'GENERAL') }}
                            </span>

                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No accounts found.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </section>
        <div class="modal fade" id="coaModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 id="coaTitle" class="mb-0">Chart</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div style="height:300px;">
                        <canvas id="coaChart"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <!-- HOW IT WORKS -->
        <section id="how" class="sp" style="background:var(--bg3); padding:70px 0;">
            <div class="container">

                <!-- HEADER -->
                <div class="text-center mb-5 rv">
                    <span class="slbl">Accounting System</span>
                    <h2 class="stitle">COA <span class="gt">Interactive Ledger</span></h2>
                    <p style="color:var(--tx2); font-size:.95rem;">
                        Klik COA untuk filter transaksi secara real-time
                    </p>
                </div>

                <div class="row g-4">

                    <!-- TABLE -->
                    <div class="col-12 rv">

                        <div class="p-4 bg-white rounded-4 shadow-sm">

                            <!-- HEADER -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-semibold mb-0">Transactions Ledger</h5>
                                <span class="badge bg-dark px-3 py-2">LIVE DATA</span>
                            </div>

                            <div class="table-responsive">

                                <table class="table align-middle table-hover">

                                    <thead style="background:#f8f9fa;">
                                        <tr>
                                            <th style="font-size:13px;">Date</th>
                                            <th style="font-size:13px;">Account</th>
                                            <th style="font-size:13px;">Description</th>
                                            <th class="text-end" style="font-size:13px;">Debit</th>
                                            <th class="text-end" style="font-size:13px;">Credit</th>
                                        </tr>
                                    </thead>

                                    <tbody id="trxTable">

                                        @forelse($transactions as $trx)
                                        <tr>

                                            <td style="font-weight:500;">
                                                {{ $trx->transaction_date }}
                                            </td>

                                            <td>
                                                <div style="font-weight:600;">
                                                    {{ $trx->coa->code ?? '-' }}
                                                </div>
                                                <small style="color:#777;">
                                                    {{ $trx->coa->name ?? '-' }}
                                                </small>
                                            </td>

                                            <td style="color:#555;">
                                                {{ $trx->description ?? '-' }}
                                            </td>

                                            <td class="text-end text-success fw-semibold">
                                                {{ number_format($trx->debit, 2) }}
                                            </td>

                                            <td class="text-end text-danger fw-semibold">
                                                {{ number_format($trx->credit, 2) }}
                                            </td>

                                        </tr>
                                        @empty

                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">
                                                No transactions available
                                            </td>
                                        </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>
        <footer id="foot" style="padding:100px 0 40px;border-top:1px solid var(--bd);">
            <div class="container">

                <div class="row g-5">

                    <!-- BRAND -->
                    <div class="col-lg-5">

                        <a href="#" class="d-flex align-items-center gap-3 text-decoration-none mb-3">

                            <div class="rounded-3 border d-flex align-items-center justify-content-center"
                                style="width:44px;height:44px;">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>

                            <div>
                                <h5 class="mb-0 fw-bold">Kelola Keuangan Cerdas dengan AI</h5>
                                <small class="text-muted">
                                    AI Financial Intelligence Platform
                                </small>
                            </div>

                        </a>

                        <p class="text-secondary mb-4" style="max-width:420px;">
                            Membantu bisnis mengambil keputusan keuangan yang lebih cepat,
                            akurat, dan berbasis data melalui teknologi kecerdasan buatan.
                        </p>

                        <div class="d-flex gap-3 flex-wrap">

                            <span class="badge text-bg-dark px-3 py-2">
                                🔒 Keamanan Data
                            </span>

                            <span class="badge text-bg-dark px-3 py-2">
                                ⚡ Real-time Analytics
                            </span>

                            <span class="badge text-bg-dark px-3 py-2">
                                🤖 AI Insights
                            </span>

                        </div>

                    </div>

                    <!-- MENU -->
                    <div class="col-6 col-md-2">

                        <h6 class="fw-semibold mb-3">Produk</h6>

                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Dashboard</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Analitik</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Laporan AI</a></li>
                            <li><a href="#" class="text-decoration-none text-secondary">Integrasi</a></li>
                        </ul>

                    </div>

                    <div class="col-6 col-md-2">

                        <h6 class="fw-semibold mb-3">Perusahaan</h6>

                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Tentang Kami</a>
                            </li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Karier</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Blog</a></li>
                            <li><a href="#" class="text-decoration-none text-secondary">Kontak</a></li>
                        </ul>

                    </div>

                    <div class="col-6 col-md-3">

                        <h6 class="fw-semibold mb-3">Legal</h6>

                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Kebijakan
                                    Privasi</a></li>
                            <li class="mb-2"><a href="#" class="text-decoration-none text-secondary">Syarat &
                                    Ketentuan</a></li>
                            <li><a href="#" class="text-decoration-none text-secondary">Keamanan Data</a></li>
                        </ul>

                    </div>

                </div>

                <!-- BOTTOM -->

                <hr class="my-5">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">

                    <p class="text-secondary mb-0">
                        © 2026 Kelola Keuangan Cerdas dengan AI. All rights reserved.
                    </p>

                    <div class="d-flex gap-3">

                        <a href="#" class="text-secondary">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>

                        <a href="#" class="text-secondary">
                            <i class="fa-brands fa-instagram"></i>
                        </a>

                        <a href="#" class="text-secondary">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>

                        <a href="#" class="text-secondary">
                            <i class="fa-brands fa-youtube"></i>
                        </a>

                    </div>

                </div>

            </div>
        </footer>

    </div>

    <!-- /dashboard -->
    <!-- ======================== SCRIPTS ======================== -->
    <!-- jQuery -->
    <script src="{{asset('frontend/js/jquery-3.7.1.min.js')}}"></script>
    <!-- Bootstrap 5 -->
    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AOS -->
    <script src="{{asset('frontend/js/aos.js')}}"></script>
    <!-- Swiper -->
    <script src="{{asset('frontend/js/chart.umd.min.js')}}"></script>
    <!-- CounterUp -->
    <script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Main js -->
    <script src="{{asset('frontend/js/main.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- ================= SCRIPT ================= -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        const modal = document.getElementById('categoryModal');

        modal.addEventListener('show.bs.modal', function(event) {

            const button = event.relatedTarget;

            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');

            // modal title
            document.getElementById('modalTitle').textContent =
                'Category: ' + name;

            // loading state
            document.getElementById('categoryTableBody').innerHTML = `
            <tr>
                <td colspan="3" class="text-center text-muted">Loading...</td>
            </tr>
        `;

            // FIXED FETCH (IMPORTANT)
            fetch(`/api/categories/${id}`)
                .then(res => res.json())
                .then(data => {

                    document.getElementById('categoryTableBody').innerHTML = `
                    <tr>
                        <td>${data.id}</td>
                        <td>${data.name}</td>
                        <td>${data.created_at ?? '-'}</td>
                    </tr>
                `;
                })
                .catch(err => {
                    console.log(err);

                    document.getElementById('categoryTableBody').innerHTML = `
                    <tr>
                        <td colspan="3" class="text-center text-danger">
                            Failed load data
                        </td>
                    </tr>
                `;
                });

        });

    });
    </script>

    <script>
    let chartInstance = null;

    function loadChart(id) {

        fetch(`/coa/chart/${id}`)
            .then(res => res.json())
            .then(res => {

                console.log(res);

                document.getElementById('coaTitle').innerText =
                    res.account.name + ' (' + res.account.code + ')';

                const labels = res.data.map(i => i.month);
                const values = res.data.map(i => i.total);

                // buka modal dulu (IMPORTANT)
                let modalEl = document.getElementById('coaModal');
                let modal = new bootstrap.Modal(modalEl);
                modal.show();

                // tunggu modal tampil baru render chart
                modalEl.addEventListener('shown.bs.modal', function handler() {

                    const ctx = document
                        .getElementById('coaChart')
                        .getContext('2d');

                    // destroy chart lama
                    if (chartInstance) {
                        chartInstance.destroy();
                    }

                    chartInstance = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'COA Movement',
                                data: values,
                                borderWidth: 2,
                                tension: 0.3
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });

                    // hapus listener biar tidak double trigger
                    modalEl.removeEventListener('shown.bs.modal', handler);
                });
            })
            .catch(err => {
                console.error('Fetch error:', err);
                alert('Gagal load data chart');
            });
    }
    </script>
</body>

</html>
