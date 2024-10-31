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
                        <th colspan="5" style="text-align: center; vertical-align: middle; font-weight: 700; height: 50px; font-size: 20px;">Laporan Product {{ $gudang->name }}</th>
                    </tr>
                    <tr>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">No</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Nomor Material</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Kode Barang</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Nama Barang</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Gudang</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Satuan</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Kategori</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Stock Minimal</th>
                        <th style="width: 200px; text-align: center; vertical-align: middle; font-weight: 700;">Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $loop->iteration }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $product->nomor_material }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $product->kode_barang }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $product->nama_barang }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $product->gudang->name }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $product->unit->name }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $product->category->name }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $product->stock_minimal }} {{ $product->unit->name }}</td>
                        <td style="width: 200px; text-align: center; vertical-align: middle">{{ $product->stock }} {{ $product->unit->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
               
            </table>
        </div>
    </div>
</body>
</html>