<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan Bulanan</title>
    <style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 12px;
        color: #333;
        margin: 30px;
    }

    .header {
        border-bottom: 3px solid #1e3a8a;
        padding-bottom: 10px;
        margin-bottom: 25px;
    }

    .company-name {
        font-size: 22px;
        font-weight: bold;
        color: #1e3a8a;
    }

    .company-desc {
        font-size: 11px;
        color: #666;
    }

    .title {
        margin-top: 15px;
        text-align: center;
    }

    .title h2 {
        margin: 0;
        font-size: 20px;
    }

    .title p {
        margin-top: 5px;
        color: #666;
    }

    .summary {
        width: 100%;
        margin-top: 20px;
        margin-bottom: 25px;
    }

    .summary td {
        width: 33%;
        padding: 8px;
    }

    .card {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
        border-radius: 5px;
    }

    .card-title {
        font-size: 11px;
        color: #666;
    }

    .card-value {
        margin-top: 5px;
        font-size: 16px;
        font-weight: bold;
    }

    .income {
        background: #f0fdf4;
    }

    .expense {
        background: #fef2f2;
    }

    .profit {
        background: #eff6ff;
    }

    .detail-table {
        width: 100%;
        border-collapse: collapse;
    }

    .detail-table th {
        background: #1e3a8a;
        color: white;
        padding: 10px;
        text-align: left;
    }

    .detail-table td {
        border: 1px solid #ddd;
        padding: 10px;
    }

    .detail-table tr:nth-child(even) {
        background: #f8fafc;
    }

    .amount {
        text-align: right;
        font-weight: bold;
    }

    .profit-positive {
        color: #16a34a;
    }

    .profit-negative {
        color: #dc2626;
    }

    .footer {
        margin-top: 60px;
    }

    .signature {
        width: 220px;
        float: right;
        text-align: center;
    }

    .signature-line {
        margin-top: 70px;
        border-top: 1px solid #000;
        padding-top: 5px;
    }
    </style>

</head>

<body>
    @php
    $months = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember',
    ];
    @endphp

    <div class="header">

        <div class="company-name">
            PT Trans Berjaya Khatulistiwa
        </div>

        <div class="company-desc">
            Sistem Informasi Keuangan
        </div>

    </div>

    <div class="title">
        <h2>LAPORAN KEUANGAN BULANAN</h2>

        <p>
            Periode :
            {{ $months[$report->month] ?? $report->month }}
            {{ $report->year }}
        </p>
    </div>

    <table class="summary">
        <tr>

            <td>
                <div class="card income">
                    <div class="card-title">
                        TOTAL PEMASUKAN
                    </div>

                    <div class="card-value">
                        Rp {{ number_format($report->total_income,0,',','.') }}
                    </div>
                </div>
            </td>

            <td>
                <div class="card expense">
                    <div class="card-title">
                        TOTAL PENGELUARAN
                    </div>

                    <div class="card-value">
                        Rp {{ number_format($report->total_expense,0,',','.') }}
                    </div>
                </div>
            </td>

            <td>
                <div class="card profit">
                    <div class="card-title">
                        LABA BERSIH
                    </div>

                    <div class="card-value">
                        Rp {{ number_format($report->profit,0,',','.') }}
                    </div>
                </div>
            </td>

        </tr>
    </table>

    <table class="detail-table">

        <thead>
            <tr>
                <th width="40%">Keterangan</th>
                <th width="60%">Nilai</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>Bulan</td>
                <td>
                    {{ $months[$report->month] ?? $report->month }}
                </td>
            </tr>

            <tr>
                <td>Tahun</td>
                <td>{{ $report->year }}</td>
            </tr>

            <tr>
                <td>Total Pemasukan</td>
                <td class="amount">
                    Rp {{ number_format($report->total_income,0,',','.') }}
                </td>
            </tr>

            <tr>
                <td>Total Pengeluaran</td>
                <td class="amount">
                    Rp {{ number_format($report->total_expense,0,',','.') }}
                </td>
            </tr>

            <tr>
                <td>Laba Bersih</td>
                <td class="amount">
                    <span class="{{ $report->profit >= 0 ? 'profit-positive' : 'profit-negative' }}">
                        Rp {{ number_format($report->profit,0,',','.') }}
                    </span>
                </td>
            </tr>

        </tbody>

    </table>

    <div class="footer">

        <div class="signature">

            {{ now()->format('d F Y') }}

            <div class="signature-line">
                Finance Manager
            </div>

        </div>

    </div>
</body>

</html>