<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan Bulanan</title>
    <style>
    @page {
        size: A4 portrait;
        margin: 10mm;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        color: #333;
    }

    .header {
        border-bottom: 2px solid #1e3a8a;
        padding-bottom: 8px;
        margin-bottom: 12px;
    }

    .header table {
        width: 100%;
    }

    .company-name {
        font-size: 18px;
        font-weight: bold;
        color: #1e3a8a;
    }

    .company-desc {
        font-size: 11px;
        color: #666;
    }

    .print-info {
        text-align: right;
        font-size: 10px;
    }

    .title {
        text-align: center;
        margin: 10px 0 15px;
    }

    .title h2 {
        font-size: 16px;
    }

    .summary {
        width: 100%;
        margin-bottom: 15px;
        border-collapse: collapse;
    }

    .summary td {
        width: 33.33%;
        padding: 8px;
    }

    .card {
        border-radius: 6px;
        padding: 10px;
        color: white;
    }

    .income {
        background: #16a34a;
    }

    .expense {
        background: #dc2626;
    }

    .profit {
        background: #2563eb;
    }

    .card-label {
        font-size: 10px;
    }

    .card-value {
        font-size: 14px;
        font-weight: bold;
        margin-top: 3px;
    }

    .report-table {
        width: 100%;
        border-collapse: collapse;
    }

    .report-table th {
        background: #1e3a8a;
        color: white;
        padding: 8px;
        border: 1px solid #ddd;
        font-size: 11px;
    }

    .report-table td {
        padding: 7px;
        border: 1px solid #ddd;
        font-size: 11px;
    }

    .report-table tbody tr:nth-child(even) {
        background: #f8fafc;
    }

    .report-table tfoot {
        background: #e5e7eb;
        font-weight: bold;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .positive {
        color: #16a34a;
        font-weight: bold;
    }

    .negative {
        color: #dc2626;
        font-weight: bold;
    }

    .footer {
        margin-top: 25px;
    }

    .signature {
        width: 180px;
        margin-left: auto;
        text-align: center;
        font-size: 11px;
    }

    .signature-line {
        margin-top: 45px;
        border-top: 1px solid #000;
        padding-top: 4px;
    }
    </style>
</head>

<body onload="window.print()">

    @php
    $months = [
    1=>'Januari',
    2=>'Februari',
    3=>'Maret',
    4=>'April',
    5=>'Mei',
    6=>'Juni',
    7=>'Juli',
    8=>'Agustus',
    9=>'September',
    10=>'Oktober',
    11=>'November',
    12=>'Desember'
    ];
    @endphp

    <div class="header">

        <table>
            <tr>
                <td>
                    <div class="company-name">
                        PT Trans Berjaya Khatulistiwa
                    </div>

                    <div class="company-desc">
                        Sistem Informasi Keuangan
                    </div>
                </td>

                <td class="print-info">
                    Dicetak:
                    <br>
                    {{ now()->format('d/m/Y H:i') }}
                </td>
            </tr>
        </table>

    </div>

    <div class="title">
        <h2>LAPORAN KEUANGAN BULANAN</h2>
    </div>

    <table class="summary">
        <tr>

            <td>
                <div class="card income">
                    <div class="card-label">TOTAL PEMASUKAN</div>
                    <div class="card-value">
                        Rp {{ number_format($reports->sum('total_income'),0,',','.') }}
                    </div>
                </div>
            </td>

            <td>
                <div class="card expense">
                    <div class="card-label">TOTAL PENGELUARAN</div>
                    <div class="card-value">
                        Rp {{ number_format($reports->sum('total_expense'),0,',','.') }}
                    </div>
                </div>
            </td>

            <td>
                <div class="card profit">
                    <div class="card-label">TOTAL LABA</div>
                    <div class="card-value">
                        Rp {{ number_format($reports->sum('profit'),0,',','.') }}
                    </div>
                </div>
            </td>

        </tr>
    </table>

    <table class="report-table">

        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Bulan</th>
                <th width="10%">Tahun</th>
                <th width="20%">Pemasukan</th>
                <th width="20%">Pengeluaran</th>
                <th width="20%">Laba</th>
            </tr>
        </thead>

        <tbody>

            @forelse($reports as $report)
            <tr>

                <td class="text-center">
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $months[$report->month] ?? $report->month }}
                </td>

                <td class="text-center">
                    {{ $report->year }}
                </td>

                <td class="text-right">
                    Rp {{ number_format($report->total_income,0,',','.') }}
                </td>

                <td class="text-right">
                    Rp {{ number_format($report->total_expense,0,',','.') }}
                </td>

                <td class="text-right">
                    <span class="{{ $report->profit >= 0 ? 'positive' : 'negative' }}">
                        Rp {{ number_format($report->profit,0,',','.') }}
                    </span>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">
                    Tidak ada data laporan bulanan
                </td>
            </tr>
            @endforelse

        </tbody>

        <tfoot>
            <tr>
                <td colspan="3" class="text-center">
                    TOTAL
                </td>

                <td class="text-right">
                    Rp {{ number_format($reports->sum('total_income'),0,',','.') }}
                </td>

                <td class="text-right">
                    Rp {{ number_format($reports->sum('total_expense'),0,',','.') }}
                </td>

                <td class="text-right">
                    Rp {{ number_format($reports->sum('profit'),0,',','.') }}
                </td>
            </tr>
        </tfoot>

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
