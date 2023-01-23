<?php $no =  1;
$totalReturPembelian = 0;
foreach ($dataDetailReturPembelian->getResult() as $data) {
    $totalReturPembelian += $data->subtotal_retur_pembelian
?>
    <tr>
        <th scope="col"><?= $no; ?></th>
        <th scope="col"><?= $data->nama_bahan ?></th>
        <th scope="col"><?= $data->jumlah_retur_pembelian ?></th>
        <th scope="col"><button class="btn btn-danger btn-hapus-retur-item" data-item="<?= $data->id_detail_retur_pembelian ?>" type="button"><i class="fa fa-trash fa-xl"></i></button></th>
    </tr>
<?php $no++;
}
?>
<input type="hidden" value="<?= $totalReturPembelian ?>" name="jumlah_total_retur_pembelian" class="jumlah_total_retur_pembelian">