<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Transaksi</title>
    <style>
        @page {
            size: landscape;
            /* margin: 20mm;  */
        }
        
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        .td-produk {
            padding: 8px;
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>
                Jl. Jendral Sudirman
                <br>
                0851 0000 1111
            </td>
            <td style="text-align: center"><h3>PT. Smart Campus</h3></td>
            <td>
                Tanggal: <span id="currentDate"></span><br>
                {{-- Konsumen: {{ $dataPrint->getPelanggan->nama_pelanggan}} --}}
            </td>
        </tr>
    </table>
    {{-- <p>Nomor Faktur: {{ $dataPrint->kode_transaksi}}</p> --}}
    <table>
        <tr>
            <td class="td-produk"><strong>Nama Barang</strong></td>
            <td class="td-produk"><strong>Harga (Rp)</strong></td>
            <td class="td-produk"><strong>Jumlah Barang</strong></td>
            <td class="td-produk"><strong>Diskon</strong></td>
            <td class="td-produk"><strong>Sub Total (Rp)</strong></td>
        </tr>
        <tr>
            {{-- <td class="td-produk">{{ $dataPrint->getStok->nama_barang }}</td>
            <td class="td-produk">{{number_format($dataPrint->harga_jual, 0, ',', '.') }}</td>
            <td class="td-produk">{{ $dataPrint->jumlah_beli }}</td>
            <td class="td-produk">
                @if (is_null($dataPrint->diskon))
                    0
                @else
                {{ $dataPrint->diskon }}
                @endif
            </td>
            <td class="td-produk">{{ number_format($dataPrint->sub_total, 0, ',', '.') }}</td> --}}
        </tr>
        <tr>
            {{-- <td class="td-produk">&nbsp;</td>
            <td class="td-produk" colspan="2">Total Barang: {{ $dataPrint->jumlah_beli }}</td>
            <td class="td-produk" colspan="3">Total Harga: {{ 'Rp ' . number_format($dataPrint->sub_total, 0, ',', '.') }}</td> --}}

        </tr>
    </table>
<br>
    <table>
        <tr style="text-align: center">
            <td>Penerima</td>
            <td>Hormat Kami</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr style="text-align: center">
            <td><h3>_______________</h3></td>
            <td><h3>PT. Smart Campus</h3></td>
        </tr>
    </table>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentDateElement = document.getElementById('currentDate');
        const now = new Date();
        const day = String(now.getDate()).padStart(2, '0');
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const year = now.getFullYear();
        const formattedDate = `${day}/${month}/${year}`;
        currentDateElement.textContent = formattedDate;
    });
</script>

</html>