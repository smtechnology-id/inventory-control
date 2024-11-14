<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1 style="text-align: center; font-size: 20px;">Transfer Stock Barang Gudang</h1>
    <h2 style="text-align: center; font-size: 16px;">{{ $transfer->nomor_do }}/StockoutCMT-ELN/X/2024</h2>

    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <table style="width: 100%;">
            <tr style="width: 100%;">
                <td style="width: 50%;">
                    <table>
                        <tr>
                            <td>Dari</td>
                            <td>:</td>
                            <td>{{ $transfer->gudangAwal->name }}</td>
                        </tr>
                        <tr>
                            <td>Ke</td>
                            <td>:</td>
                            <td>{{ $transfer->gudangTujuan->name }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>{{ $transfer->created_at->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>Attendant</td>
                            <td>:</td>
                            <td>{{ $transfer->attendant }}</td>
                        </tr>
                        <tr>
                            <td>Delivered By</td>
                            <td>:</td>
                            <td>{{ $transfer->delivered_by }}</td>
                        </tr>
                        <tr>
                            <td>Lokasi Kirim</td>
                            <td>:</td>
                            <td>{{ $transfer->lokasi_kirim }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%;">
                    <table>
                        <tr>
                            <td>No DO</td>
                            <td>:</td>
                            <td>{{ $transfer->nomor_do }}/StockoutCMT-ELN/X/2024
                            </td>
                        </tr>
                        <tr>
                            <td>Via</td>
                            <td>:</td>
                            <td>{{ $transfer->via }}</td>
                        </tr>
                        <tr>
                            <td>Carrier</td>
                            <td>:</td>
                            <td>{{ $transfer->carrier }}</td>
                        </tr>
                        <tr>
                            <td>Referensi</td>
                            <td>:</td>
                            <td>{{ $transfer->refrensi }}</td>
                        </tr>
                        <tr>
                            <td>Truck Number</td>
                            <td>:</td>
                            <td>{{ $transfer->truck_number }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td>{{ $transfer->keterangan }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="container" style="margin-bottom: 50px;">
        <table style="width: 100%;">
            <thead style="background-color: #dadada; color: #000;">
                <tr>
                    <th></th>
                    <th colspan="2" style="text-align: center;">{{ $transfer->gudangAwal->name }}</th>
                    <th colspan="2" style="text-align: center;">{{ $transfer->gudangTujuan->name }}</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Qty</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transferProducts as $item)
                    <tr style="text-align: center;">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->productGudangAwal->kode_barang }}</td>
                        <td>{{ $item->productGudangAwal->nama_barang }}</td>
                        <td>{{ $item->productGudangTujuan->kode_barang }}</td>
                        <td>{{ $item->productGudangTujuan->nama_barang }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    {{-- Tandatangan --}}
    <div class="container" style="margin-top: 200px;">
        <table style="width: 100%;" border="1">
            <tr style="width: 100%;">
                <td style="width: 25%;">Prepared By</td>
                <td style="width: 25%;">Approved By</td>
                <td style="width: 25%;">User Project</td>
                <td style="width: 25%;">User Project</td>
            </tr>
            <tr>
                <td style="width: 25%;">
                    <div style="height: 100px;"></div>
                </td>
                <td style="width: 25%;"></td>
                <td style="width: 25%;"></td>
                <td style="width: 25%;"></td>
            </tr>
        </table>
    </div>
</body>

</html>
