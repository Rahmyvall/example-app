<!DOCTYPE html>
<html>

<head>
    <title>Financial Summary</title>

    <style>
    body {
        font-family: sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 8px;
    }

    th {
        background: #f2f2f2;
    }
    </style>
</head>

<body>

    <h2>Financial Summary Report</h2>

    <table>

        <thead>

            <tr>
                <th>Category</th>
                <th>January</th>
                <th>February</th>
                <th>March</th>
                <th>Total</th>
            </tr>

        </thead>

        <tbody>

            @foreach($reports as $item)

            <tr>

                <td>{{ $item->category }}</td>

                <td>{{ number_format($item->amount_2022_01) }}</td>

                <td>{{ number_format($item->amount_2022_02) }}</td>

                <td>{{ number_format($item->amount_2022_03) }}</td>

                <td>
                    {{ number_format(
                    $item->amount_2022_01 +
                    $item->amount_2022_02 +
                    $item->amount_2022_03
                ) }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</body>

</html>
