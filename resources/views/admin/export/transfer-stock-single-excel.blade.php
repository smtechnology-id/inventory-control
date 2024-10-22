<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transfer Stock</title>
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
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th colspan="4" rowspan="4">
                        <h2>Logo</h2>
                    </th>
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
                <th colspan="4"><label for="" style="font-size: 32px; weight: bold">Stock Transfer</label></th>
               </tr>
               <tr>
                <th colspan="3">From</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="4">No: {{ $transfer->nomor_do }}/TransferoutCMT-ELN/X/2024 </th>
               </tr>
               <tr>
                <td colspan="2">To : </td>
                <td colspan="3"></td>
                <td colspan="4"></td>
                <td>Via : </td>
                <td colspan="3"></td>
               </tr>
               <tr>
                <td colspan="2">Address : </td>
                <td colspan="3"></td>
                <td colspan="4"></td>
                <td>Carrier : </td>
                <td colspan="3"></td>
               </tr>
               <tr>
                <td colspan="5"></td>
                <td colspan="4"></td>
                <td>Reff : </td>
                <td colspan="3"></td>
               </tr>
               <tr>
                <td colspan="2">Date : </td>
                <td colspan="3"></td>
                <td colspan="4"></td>
                <td>Truck Num : </td>
                <td colspan="3"></td>
               </tr>
               <tr>
                <td colspan="2">Attn : </td>
                <td colspan="3"></td>
                <td colspan="4"></td>
                <td>Delivered By : </td>
                <td colspan="3"></td>
               </tr>
               <tr>
                <td colspan="13" style="height: 100px"></td>
               </tr>
               <tr>
                <th></th>
                <th></th>
                <th colspan="3" style="text-align: center; align-middle">From</th>
                <th colspan="3" style="text-align: center; align-middle">To</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
               </tr>
               <tr style="height: 22px">
                <th style="width: 100px; text-align: center; align-middle; height: 22px">No</th>
                <th style="width: 100px; text-align: center; align-middle; height: 22px">Qty</th>
                <th style="width: 100px; text-align: center; align-middle; height: 22px">Kode Barang</th>
                <th style="width: 100px; text-align: center; align-middle; height: 22px">Nama Barang</th>
                <th style="width: 100px; text-align: center; align-middle; height: 22px">Gudang</th>
                <th style="width: 100px; text-align: center; align-middle; height: 22px">Kode Barang</th>
                <th style="width: 100px; text-align: center; align-middle; height: 22px">Nama Barang</th>
                <th style="width: 100px; text-align: center; align-middle; height: 22px">Gudang</th>
                <th style="width: 100px; text-align: center; align-middle; height: 22px">Remark</th>
                <th style="width: 100px; text-align: center; align-middle; height: 22px">Refrensi</th>
                <th style="width: 100px; text-align: center; align-middle; height: 22px">Shipping Location</th>
                <th style="width: 100px; text-align: center; align-middle; height: 22px">Created At</th>

               </tr>
               <tr>
                <td>1</td>
                <td style="width: 100px; text-align: center; align-middle; height: 22px">{{ $transfer->quantity }}</td>
                <td style="width: 100px; text-align: center; align-middle; height: 22px">{{ $transfer->productAwal->kode_barang}}</td>
                <td style="width: 100px; text-align: center; align-middle; height: 22px">{{ $transfer->productAwal->nama_barang}}</td>
                <td style="width: 100px; text-align: center; align-middle; height: 22px">{{ $transfer->productAwal->gudang->name }}</td>
                <td style="width: 100px; text-align: center; align-middle; height: 22px">{{ $transfer->productTujuan->kode_barang}}</td>
                <td style="width: 100px; text-align: center; align-middle; height: 22px">{{ $transfer->productTujuan->nama_barang}}</td>
                <td style="width: 100px; text-align: center; align-middle; height: 22px">{{ $transfer->productTujuan->gudang->name }}</td>
                <td style="width: 100px; text-align: center; align-middle; height: 22px">{{ $transfer->keterangan }}</td>
                <td style="width: 100px; text-align: center; align-middle; height: 22px">{{ $transfer->refrensi }}</td>
                <td style="width: 100px; text-align: center; align-middle; height: 22px">{{ $transfer->lokasi_kirim }}</td>
                <td style="width: 100px; text-align: center; align-middle; height: 22px">{{ $transfer->created_at }}</td>
               </tr>
               @for ($i = 0; $i < 10; $i++)
               <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="4"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
               </tr>
               @endfor
               <tr>
                <th colspan="4" class="text-align: center; align-middle">
                    <p style="text-align: center; align-middle">Prepared By</p>
                </th>
                <th colspan="3" class="text-align: center; align-middle">
                    <p style="text-align: center; align-middle">Approved By</p>
                </th>
                <th colspan="3" class="text-align: center; align-middle">
                    <p style="text-align: center; align-middle">User Project</p>
                </th>
                <th colspan="4" class="text-align: center; align-middle">
                    <p style="text-align: center; align-middle">Received By</p>
                </th>
            </tr>
            <tr>
                <th colspan="4" style="height: 100px">
                    <p style="text-align: center; align-middle: height: 200px"></p>
                </th>
                <th colspan="3" style="height: 100px">
                    <p style="text-align: center; align-middle; height: 200px"></p>
                </th>
                <th colspan="3" style="height: 100px">
                    <p style="text-align: center; align-middle; height: 200px"></p>
                </th>
                <th colspan="4" style="height: 100px">
                    <p style="text-align: center; align-middle; height: 200px"></p>
                </th>
            </tr>
            </table>
        </div>
    </div>

</body>

</html>
