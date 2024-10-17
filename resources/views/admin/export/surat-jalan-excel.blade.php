<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Masuk</title>
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
            padding: 12px;
            /* Meningkatkan padding untuk memberi ruang lebih */
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
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th colspan="4" rowspan="4">
                        <h2>Logo</h2>
                    </th>
                    <th style="height: 22px; width: 150px" >Alamat</th>
                    <th colspan="3">{{ $suratJalan->konsumen->alamat }}</th>
                    
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
               <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="4"><label for="" style="font-size: 32px; weight: bold">Delivery Order</label></th>
               </tr>
               <tr>
                <th colspan="3">From</th>
                <th></th>
                <th></th>
                <th colspan="4">No: {{ $suratJalan->nomor_do }}/StockoutCMT-ELN/X/2024 </th>
               </tr>
               <tr>
                <td colspan="2">To : </td>
                <td colspan="3">{{ $suratJalan->konsumen->name }}</td>
                <td>Via : </td>
                <td colspan="3"> {{ $suratJalan->via }}</td>
               </tr>
               <tr>
                <td colspan="2">Address : </td>
                <td colspan="3">{{ $suratJalan->konsumen->alamat }}</td>
                <td>Carrier : </td>
                <td colspan="3">{{ $suratJalan->carrier }}</td>
               </tr>
               <tr>
                <td colspan="5"></td>
                <td>Reff : </td>
                <td colspan="3">{{ $suratJalan->reff }}</td>
               </tr>
               <tr>
                <td colspan="2">Date : </td>
                <td colspan="3">{{ $suratJalan->created_at->format('d-m-Y') }}</td>
                <td>Truck Num : </td>
                <td colspan="3">{{ $suratJalan->truck_number }}</td>
               </tr>
               <tr>
                <td colspan="2">Attn : </td>
                <td colspan="3"></td>
                <td>Delivered By : </td>
                <td colspan="3">{{ $suratJalan->delivered_by }}</td>
               </tr>
               <tr>
                <td colspan="9" style="height: 100px"></td>
               </tr>
               <tr style="height: 22px">
                <th style="width: 75px; text-align: center; align-middle; height: 22px">No</th>
                <th style="width: 75px; text-align: center; align-middle; height: 22px">Qty</th>
                <th style="width: 75px; text-align: center; align-middle; height: 22px">UoM</th>
                <th style="width: 150px; text-align: center; align-middle; height: 22px">Equipment Num</th>
                <th colspan="3" style="width: 300px; text-align: center; align-middle; height: 22px">Description</th>
                <th style="width: 100px; text-align: center; align-middle; height: 22px">Gudang</th>
                <th style="width: 100px; text-align: center; align-middle; height: 22px">Remark</th>
               </tr>
               @foreach ($suratJalanProducts as $item)
               <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ $item->product->unit->name }}</td>
                <td>{{ $item->product->kode_barang}}</td>
                <td colspan="3">{{ $item->product->nama_barang }}</td>
                <td>{{ $item->product->gudang->name }}</td>
                <td>{{ $item->keterangan }}</td>
               </tr>
               @endforeach
               @for ($i = 0; $i < 10; $i++)
               <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="4"></td>
                <td></td>
               </tr>
               @endfor
               <tr>
                <th colspan="3" class="text-align: center; align-middle">
                    <p style="text-align: center; align-middle">Prepared By</p>
                </th>
                <th colspan="2" class="text-align: center; align-middle">
                    <p style="text-align: center; align-middle">Approved By</p>
                </th>
                <th colspan="2" class="text-align: center; align-middle">
                    <p style="text-align: center; align-middle">User Project</p>
                </th>
                <th colspan="2" class="text-align: center; align-middle">
                    <p style="text-align: center; align-middle">Received By</p>
                </th>
            </tr>
            <tr>
                <th colspan="3" style="height: 100px">
                    <p style="text-align: center; align-middle: height: 200px"></p>
                </th>
                <th colspan="2" style="height: 100px">
                    <p style="text-align: center; align-middle; height: 200px"></p>
                </th>
                <th colspan="2" style="height: 100px">
                    <p style="text-align: center; align-middle; height: 200px"></p>
                </th>
                <th colspan="2" style="height: 100px">
                    <p style="text-align: center; align-middle; height: 200px"></p>
                </th>
            </tr>
            </table>
        </div>
    </div>

</body>

</html>
