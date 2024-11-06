<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1 style="text-align: center; font-size: 20px;">Surat Jalan</h1>
    <h2 style="text-align: center; font-size: 16px;">{{ $suratJalan->nomor_do }}/StockoutCMT-ELN/X/2024</h2>

    <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <table style="width: 100%;">
            <tr style="width: 100%;">
                <td style="width: 50%;">
                    <table>
                       
                        <tr>
                            <td>Ke</td>
                            <td>:</td>
                            <td>{{ $suratJalan->konsumen->name }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $suratJalan->konsumen->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>{{ $suratJalan->created_at->format('d-m-Y') }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%;">
                    <table>
                        <tr>
                            <td>No DO</td>
                            <td>:</td>
                            <td>{{ $suratJalan->nomor_do }}/StockoutCMT-ELN/X/2024</td>
                        </tr>
                        <tr>
                            <td>Via</td>
                            <td>:</td>
                            <td>{{ $suratJalan->via }}</td>
                        </tr>
                        <tr>
                            <td>Carrier</td>
                            <td>:</td>
                            <td>{{ $suratJalan->carrier }}</td>
                        </tr>
                        
                        <tr>
                            <td>Truck Number</td>
                            <td>:</td>
                            <td>{{ $suratJalan->truck_number }}</td>
                        </tr>
                        <tr>
                            <td>Delivered By</td>
                            <td>:</td>
                            <td>{{ $suratJalan->delivered_by }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="container" style="margin-bottom: 50px;">
        <table style="width: 100%; border: 1px solid #dadada;">
            <thead style="background-color: #dadada; color: #000; ">
               
                <tr style="text-align: center; ">
                    <th>No</th>
                    <th>Qty</th>
                    <th>UoM</th>
                    <th>Equipment Number</th>
                    <th>Desciption</th>
                    <th>Wirehouse</th>
                    <th>Remark</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suratJalanProducts as $suratJalanProduct)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $suratJalanProduct->qty }}</td>
                        <td>{{ $suratJalanProduct->product->unit->name }}</td>
                        <td>{{ $suratJalanProduct->product->kode_barang }}</td>
                        <td>{{ $suratJalanProduct->product->nama_barang }}</td>
                        <td>{{ $suratJalanProduct->product->gudang->name }}</td>
                        <td>{{ $suratJalanProduct->keterangan ?? '-' }}</td>
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
