<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Faktur Pembelian</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>

<body>

    <table width="100%">
        <tr>
            <td valign="top"><img src="{{asset('images/meteor-logo.png')}}" alt="" width="150" /></td>
            <td align="right">
                <h3>Shinra Electric power company</h3>
                <pre>
                Company representative name
                Company address
                Tax ID
                phone
                fax
            </pre>
            </td>
        </tr>

    </table>

    <table width="100%">
        <tr>
            <td><strong>From:</strong> Linblum - Barrio teatral</td>
            <td><strong>To:</strong> Linblum - Barrio Comercial</td>
        </tr>

    </table>

    <br />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th>Bahan</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $total;
            foreach ($dataPembelian->getResult() as $data) {
                // $total += $data->subtotal_pembelian;
            ?>
                <tr>
                    <th scope="row">1</th>
                    <td><?= $data->id_bahan; ?></td>
                    <td><?= $data->jumlah_pembelian; ?></td>
                    <td><?= $data->harga_pembelian; ?></td>
                    <td><?= $data->subtotal_pembelian; ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td align="right">Total: </td>
                <td align="right" class="gray"><?= 1000 ?></td>
            </tr>
        </tfoot>
    </table>

</body>

</html>