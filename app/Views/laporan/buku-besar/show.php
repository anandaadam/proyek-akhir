<tr>
    <?php helper('number');
    $dataSaldoAkhir = $dataSaldoAwal;
    // $abc;
    // if ($dataSaldoAwal > 0) {
    //     $abc = true;
    // } else {
    //     $abc = false;
    // }
    ?>
    <td></td>
    <td class="font-weight-bold">Saldo Awal</td>
    <td></td>
    <?php if ($dataSaldoAwal > 0) { ?>
        <th><?= number_to_currency($dataSaldoAwal, 'IDR', 'id_ID', 2) ?></th>
    <?php } else { ?>
        <th></th>
    <?php } ?>
    <?php if ($dataSaldoAwal < 0) { ?>
        <th><?= number_to_currency(abs($dataSaldoAwal), 'IDR', 'id_ID', 2) ?></th>
    <?php } else { ?>
        <th></th>
    <?php } ?>
    <?php if ($dataSaldoAkhir > 0) { ?>
        <th><?= number_to_currency($dataSaldoAkhir, 'IDR', 'id_ID', 2) ?></th>
    <?php } else { ?>
        <th></th>
    <?php } ?>
    <?php if ($dataSaldoAkhir < 0) { ?>
        <th><?= number_to_currency(abs($dataSaldoAkhir), 'IDR', 'id_ID', 2) ?></th>
    <?php } else { ?>
        <th></th>
    <?php } ?>
</tr>
<?php foreach ($dataBukuBesar->getResult() as $data) {
    if ($data->debit_kredit == 'Debit') {
        $dataSaldoAkhir += $data->nominal_jurnal;
    }
    if ($data->debit_kredit == 'Kredit') {
        $dataSaldoAkhir -= $data->nominal_jurnal;
    }
?>
    <tr>
        <td><?= $data->tanggal_jurnal ?></td>
        <td><?= $data->deskripsi_jurnal ?></td>
        <td><?= $data->kode_akun ?></td>
        <?php if ($data->debit_kredit == 'Debit') { ?>
            <td><?= number_to_currency($data->nominal_jurnal, 'IDR', 'id_ID', 2) ?></td>
        <?php } else { ?>
            <td></td>
        <?php } ?>
        <?php if ($data->debit_kredit == 'Kredit') { ?>
            <td><?= number_to_currency(abs($data->nominal_jurnal), 'IDR', 'id_ID', 2) ?></td>
        <?php } else { ?>
            <td></td>
        <?php } ?>
        <?php if ($dataSaldoAkhir > 0) { ?>
            <td><?= number_to_currency($dataSaldoAkhir, 'IDR', 'id_ID', 2) ?></td>
        <?php } else { ?>
            <td></td>
        <?php } ?>
        <?php if ($dataSaldoAkhir < 0) { ?>
            <td><?= number_to_currency(abs($dataSaldoAkhir), 'IDR', 'id_ID', 2) ?></td>
        <?php } else { ?>
            <td></td>
        <?php } ?>
    </tr>
<?php } ?>
<tr>
    <th colspan="5" class="text-center">Total</th>
    <?php if ($dataSaldoAkhir > 0) { ?>
        <th><?= number_to_currency($dataSaldoAkhir, 'IDR', 'id_ID', 2) ?></th>
    <?php } else { ?>
        <th></th>
    <?php } ?>
    <?php if ($dataSaldoAkhir < 0) { ?>
        <th><?= number_to_currency(abs($dataSaldoAkhir), 'IDR', 'id_ID', 2) ?></th>
    <?php } else { ?>
        <th></th>
    <?php } ?>
</tr>