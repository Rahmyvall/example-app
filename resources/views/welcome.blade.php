<!DOCTYPE html>
<html lang="en" id="htmlRoot">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexusAI - Automate Everything with AI Agents</title>
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

                    <span class="hbadge">
                        <span class="bdot"></span>
                        Platform Intelijen Keuangan Berbasis AI
                    </span>

                    <h1 class="h1 mt-3">
                        Ambil Keputusan Keuangan Lebih Cerdas<br>
                        dengan <span class="gt">Kecerdasan AI</span>
                    </h1>

                    <p style="
        max-width:620px;
        margin:20px auto 35px;
        font-size:clamp(.95rem,1.8vw,1.2rem);
        color:var(--tx2);
        line-height:1.6;
    ">
                        Otomatiskan pengelolaan anggaran, pantau arus kas secara real-time,
                        deteksi anomali transaksi, dan hasilkan laporan keuangan yang lebih akurat
                        melalui satu dashboard cerdas berbasis AI.
                    </p>

                    <!-- TRUST INDICATORS -->
                    <div class="mt-4 text-muted" style="font-size:.9rem;">
                        Dipercaya oleh perusahaan, UMKM, dan tim keuangan • Aman • Real-time • Didukung AI
                    </div>

                </div>

                <!-- DASHBOARD IMAGE REPLACEMENT -->
                <div class="row justify-content-center mt-5">

                    <div class="col-lg-10 text-center">

                        <img src="{{asset('frontend/img/logo.png')}}" alt="AI Finance Dashboard" class="img-fluid"
                            style="
                        border-radius:18px;
                        box-shadow:0 25px 70px rgba(0,0,0,.35);
                        transform:translateY(10px);
                    ">

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
        <footer id="foot" style="padding:80px 0 30px;border-top:1px solid var(--bd);">
            <div class="container">

                <!-- TOP -->
                <div class="row g-5 mb-5">

                    <!-- BRAND -->
                    <div class="col-lg-4">
                        <a href="#"
                            style="display:flex;align-items:center;gap:10px;margin-bottom:15px;font-size:1.2rem;font-weight:700;color:var(--tx);text-decoration:none;">
                            <div
                                style="width:38px;height:38px;display:grid;place-items:center;border-radius:10px;background:rgba(255,255,255,0.05);border:1px solid var(--bd);">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                            NexusAI
                        </a>

                        <p style="font-size:.9rem;color:var(--tx3);line-height:1.7;max-width:320px;margin:0;">
                            The most powerful AI automation platform for modern teams.
                        </p>

                        <!-- SUBSCRIBE -->
                        <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:15px;">
                            <input type="email" placeholder="your@email.com"
                                style="flex:1;min-width:180px;padding:10px 12px;border-radius:10px;border:1px solid var(--bd);background:transparent;color:var(--tx);outline:none;">
                            <button
                                style="padding:10px 16px;border-radius:10px;border:none;cursor:pointer;font-size:.85rem;font-weight:600;color:#fff;background:linear-gradient(135deg,#6d5efc,#4fd1c5);">
                                Subscribe
                            </button>
                        </div>
                    </div>

                    <!-- LINKS -->
                    <div class="col-6 col-md-2">
                        <h5 style="font-size:.95rem;margin-bottom:12px;color:var(--tx);">Product</h5>
                        <a href="#"
                            style="display:block;margin-bottom:8px;font-size:.85rem;color:var(--tx3);text-decoration:none;">Features</a>
                        <a href="#"
                            style="display:block;margin-bottom:8px;font-size:.85rem;color:var(--tx3);text-decoration:none;">Integrations</a>
                        <a href="#"
                            style="display:block;margin-bottom:8px;font-size:.85rem;color:var(--tx3);text-decoration:none;">Pricing</a>
                        <a href="#"
                            style="display:block;margin-bottom:8px;font-size:.85rem;color:var(--tx3);text-decoration:none;">Changelog</a>
                        <a href="#"
                            style="display:block;font-size:.85rem;color:var(--tx3);text-decoration:none;">Status</a>
                    </div>

                    <div class="col-6 col-md-2">
                        <h5 style="font-size:.95rem;margin-bottom:12px;color:var(--tx);">Resources</h5>
                        <a href="#"
                            style="display:block;margin-bottom:8px;font-size:.85rem;color:var(--tx3);text-decoration:none;">Documentation</a>
                        <a href="#"
                            style="display:block;margin-bottom:8px;font-size:.85rem;color:var(--tx3);text-decoration:none;">API
                            Reference</a>
                        <a href="#"
                            style="display:block;margin-bottom:8px;font-size:.85rem;color:var(--tx3);text-decoration:none;">Blog</a>
                        <a href="#"
                            style="display:block;margin-bottom:8px;font-size:.85rem;color:var(--tx3);text-decoration:none;">Case
                            Studies</a>
                        <a href="#"
                            style="display:block;font-size:.85rem;color:var(--tx3);text-decoration:none;">Community</a>
                    </div>

                    <div class="col-6 col-md-2">
                        <h5 style="font-size:.95rem;margin-bottom:12px;color:var(--tx);">Company</h5>
                        <a href="#"
                            style="display:block;margin-bottom:8px;font-size:.85rem;color:var(--tx3);text-decoration:none;">About</a>
                        <a href="#"
                            style="display:block;margin-bottom:8px;font-size:.85rem;color:var(--tx3);text-decoration:none;">Careers</a>
                        <a href="#"
                            style="display:block;margin-bottom:8px;font-size:.85rem;color:var(--tx3);text-decoration:none;">Press</a>
                        <a href="#"
                            style="display:block;margin-bottom:8px;font-size:.85rem;color:var(--tx3);text-decoration:none;">Privacy</a>
                        <a href="#"
                            style="display:block;font-size:.85rem;color:var(--tx3);text-decoration:none;">Terms</a>
                    </div>

                </div>

                <!-- BOTTOM -->
                <div
                    style="display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center;gap:15px;padding-top:20px;border-top:1px solid var(--bd);">

                    <p style="font-size:.8rem;color:var(--tx3);margin:0;line-height:1.5;">
                        © 2025 NexusAI, Inc. All rights reserved.
                        <br>
                        Design by
                        <a href="https://bestwpware.com/" target="_blank"
                            style="color:#6d5efc;font-weight:600;text-decoration:none;">Bestwpware</a>
                        & distributed by
                        <a href="https://themewagon.com" target="_blank"
                            style="color:#6d5efc;font-weight:600;text-decoration:none;">ThemeWagon</a>
                    </p>

                    <!-- SOCIAL -->
                    <div style="display:flex;gap:10px;">
                        <a href="#"
                            style="width:38px;height:38px;display:grid;place-items:center;border-radius:10px;border:1px solid var(--bd);color:var(--tx3);text-decoration:none;">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                        <a href="#"
                            style="width:38px;height:38px;display:grid;place-items:center;border-radius:10px;border:1px solid var(--bd);color:var(--tx3);text-decoration:none;">
                            <i class="fa-brands fa-github"></i>
                        </a>
                        <a href="#"
                            style="width:38px;height:38px;display:grid;place-items:center;border-radius:10px;border:1px solid var(--bd);color:var(--tx3);text-decoration:none;">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a href="#"
                            style="width:38px;height:38px;display:grid;place-items:center;border-radius:10px;border:1px solid var(--bd);color:var(--tx3);text-decoration:none;">
                            <i class="fa-brands fa-discord"></i>
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