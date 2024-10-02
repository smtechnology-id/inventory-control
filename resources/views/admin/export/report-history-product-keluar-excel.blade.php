<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Barang Keluar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px; /* Meningkatkan padding untuk memberi ruang lebih */
            text-align: left;
            width: auto;
        }

        th {
            background-color: #f2f2f2;
            width: 150px;
            white-space: nowrap;
        }

        td {
            text-align: left;
            width: 150px;
            /* Atur lebar kolom sesuai kebutuhan */
            white-space: nowrap;
            /* Mencegah teks membungkus */
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>

    <div class="top">
        <div>
            <table>
                <thead>
                    <tr>
                        <th colspan="5" style="text-align: center; vertical-align: middle; font-weight: 700; height: 50px; font-size: 20px;">Laporan Barang Keluar {{ $from }} s/d {{ $to }}</th>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: center; vertical-align: middle; font-weight: 700; height: 30px; font-size: 14px;">Nama Perusahaan</td>
                        <td colspan="4" style="text-align: center; vertical-align: middle; font-weight: 700; height: 30px; font-size: 14px;">Nama Perusahaan</td>
                    </tr>   
                    <tr>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">No</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Kode Barang</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Nama Barang</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Gudang</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Jumlah</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Tanggal Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                    <tr>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $loop->iteration }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $report->stock->product->kode_barang }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $report->stock->product->nama_barang }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $report->stock->gudang->name }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $report->qty }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $report->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
               
            </table>
        </div>
    </div>

</body>

</html>