<?php helper('number');
$totalDebit = 0;
$totalKredit = 0;
foreach ($dataJurnalUmum->getResult() as $data) {
    if ($data->debit_kredit == 'Debit') {
        $totalDebit += $data->nominal_jurnal;
    }
    if ($data->debit_kredit == 'Kredit') {
        $totalKredit += $data->nominal_jurnal;
    }
?>
    <tr>
        <td scope="col"><?= $data->tanggal_jurnal; ?></td>
        <?php if ($data->debit_kredit == 'Debit') { ?>
            <td scope="col"><?= $data->nama_akun ?></td>
        <?php } ?>
        <?php if ($data->debit_kredit == 'Kredit') { ?>
            <td scope="col">&emsp;&emsp;<?= $data->nama_akun ?></td>
        <?php } ?>
        <td scope="col"><?= $data->kode_akun ?></td>
        <?php if ($data->debit_kredit == 'Debit') { ?>
            <td scope="col"><?= number_to_currency($data->nominal_jurnal, 'IDR', 'id_ID', 2) ?></td>
        <?php } else { ?>
            <td scope="col"></td>
        <?php  } ?>
        <?php if ($data->debit_kredit == 'Kredit') { ?>
            <td scope="col"><?= number_to_currency($data->nominal_jurnal, 'IDR', 'id_ID', 2) ?></td>
        <?php } else { ?>
            <td scope="col"></td>
        <?php  } ?>
    </tr>
<?php } ?>
<tr>
    <th colspan="3" class="text-center font-weight-bold">Total</th>
    <th><?= number_to_currency($totalDebit, 'IDR', 'id_ID', 2) ?></th>
    <th><?= number_to_currency($totalKredit, 'IDR', 'id_ID', 2) ?></th>
</tr>