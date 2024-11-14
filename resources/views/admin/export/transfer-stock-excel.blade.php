<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transfer Stock </title>
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
                        <th colspan="8" style="text-align: center; vertical-align: middle; font-weight: 700; height: 50px; font-size: 20px;">Laporan Barang Transfer {{ $from }} s/d {{ $to }}</th>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: center; vertical-align: middle; font-weight: 700; height: 30px; font-size: 14px;">Nama Perusahaan</td>
                        <td colspan="4" style="text-align: center; vertical-align: middle; font-weight: 700; height: 30px; font-size: 14px;">Nama Perusahaan</td>
                    </tr>   
                    <tr>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">No</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Produk Awal</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Produk Tujuan</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Refrensi</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Lokasi Kirim</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Jumlah</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Waktu</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transfers as $transfer)
                    <tr>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $loop->iteration }}</td>
                        
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $transfer->productAwal->nama_barang }} - {{ $transfer->productAwal->gudang->name }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $transfer->productTujuan->nama_barang }} - {{ $transfer->productTujuan->gudang->name }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $transfer->refrensi }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $transfer->lokasi_kirim }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $transfer->quantity }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $transfer->created_at->format('d-m-Y H:i') }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $transfer->keterangan }}</td>
                    </tr>
                    @endforeach
                </tbody>
               
            </table>
        </div>
    </div>

</body>

</html>