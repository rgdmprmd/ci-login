<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="cancel-deals" data-canceldeals="<?= $this->session->flashdata('canceldeals'); ?>"></div>
    <div class="delete-deals" data-deletedeals="<?= $this->session->flashdata('deletedeals'); ?>"></div>
    <div class="edit-deals" data-editdeals="<?= $this->session->flashdata('editdeals'); ?>"></div>
    <div class="fail-edit-deals" data-faileditdeals="<?= $this->session->flashdata('faileditdeals'); ?>"></div>
    <div class="proses-deals" data-prosesdeals="<?= $this->session->flashdata('prosesdeals'); ?>"></div>

    <!-- Toambol -->
    <div class="row">
        <div class="col-lg-6" id="tombolDeals" data-deals="<?= $count; ?>">
            <!-- Tombolnya bakal digenerate sama js -->
        </div>
    </div>

    <!-- Info -->
    <div class="row">
        <div class="col-lg">
            <div class="d-flex justify-content-between mt-3 mb-2">
                <div class="">
                    <h6 class="h6">Tanggal&nbsp;&nbsp;:&nbsp; <?= date('l, d M Y'); ?></h6>
                </div>
                <div class="">
                    <h6 class="h6">Jumlah Order&nbsp;&nbsp;:&nbsp; <?= $count; ?> </h6>
                </div>
                <div class="">
                    <h6 class="h6">Total Order&nbsp;&nbsp;:&nbsp; Rp. <?= number_format($total, 0, '.', ','); ?></h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="row">
        <div class="col-lg">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" width="50">#</th>
                        <th scope="col" width="250" class="text-center">Option</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col" class="text-right">Stok Barang</th>
                        <th scope="col" class="text-right">Qty</th>
                        <th scope="col" class="text-right">Harga Satuan</th>
                        <th scope="col" class="text-right">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($deals as $order) : ?>
                        <tr>
                            <th scope="col"><?= $i++; ?></th>
                            <td class="text-center">
                                <a href="<?= base_url(); ?>inventory/orderDetail/<?= $order['idOrder']; ?>" class="badge badge-primary p-2 tombolEditOrder">Detail</a>
                                <a href="<?= base_url(); ?>inventory/editOrder/<?= $order['idOrder']; ?>" class="badge badge-success p-2 tombolEditOrder" data-toggle="modal" data-target="#editOrderModal" data-id="<?= $order['idOrder']; ?>">Edit</a>
                                <a href="<?= base_url(); ?>inventory/deleteOrder/<?= $order['idOrder']; ?>" class="badge badge-danger p-2 tombolHapus">Delete</a>
                            </td>
                            <td><?= $order['namaBarang']; ?></td>
                            <td class="text-right"><?= $order['stokBarang']; ?></td>
                            <td class="text-right"><?= $order['qtyOrder']; ?></td>
                            <th class="text-right text-success"><?= number_format($order['hargaJual'], 0, ',', '.'); ?></th>
                            <th class="text-right text-danger"><?= number_format($order['totalHarga'], 0, ',', '.'); ?></th>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->