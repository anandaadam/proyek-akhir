<?php $no =  1;
$totalPembelian = 0;
helper('number');
foreach ($dataDetailPembelian->getResult() as $data) {
    $totalPembelian += $data->subtotal_pembelian ?>
    <tr>
        <th scope="col"><?= $no; ?></th>
        <th scope="col"><?= $data->nama_bahan ?></th>
        <th scope="col"><?= number_to_currency($data->harga_pembelian, 'IDR', 'id_ID', 2) ?></th>
        <th scope="col"><?= $data->jumlah_pembelian ?></th>
        <th scope="col"><?= number_to_currency($data->subtotal_pembelian, 'IDR', 'id_ID', 2) ?></th>
        <th scope="col"><button class="btn btn-danger btn-hapus-item" data-item="<?= $data->id_detail_pembelian ?>" type="button"><i class="fa fa-trash fa-xl"></i></button></th>
    </tr>
<?php $no++;
}
?>
<input type="hidden" value="<?= number_to_currency($totalPembelian, 'IDR', 'id_ID', 2) ?>" name="jumlah_total_pembelian" class="jumlah_total_pembelian">