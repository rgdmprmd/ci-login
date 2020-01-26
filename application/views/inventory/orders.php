<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="cancel-order" data-cancelorder="<?= $this->session->flashdata('cancelorder'); ?>"></div>

    <div class="row">
        <div class="col-lg-6" id="tombolOrder" data-order="<?= $count; ?>">
            <!-- Tombolnya bakal digenerate sama js -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <!-- Info -->
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

    <div class="row">
        <div class="col-lg">
            <!-- Table Earning -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" width="50">#</th>
                        <th scope="col" width="250" class="text-center">Option</th>
                        <th scope="col">Transaction</th>
                        <th scope="col" class="text-right">Income</th>
                        <th scope="col" class="text-right">Outcome</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($orders as $order) : ?>
                        <tr>
                            <th scope="col"><?= $i++; ?></th>
                            <td class="text-center">
                                <a href="<?= base_url(); ?>user/earningDetail/<?= $order['idOrder']; ?>" class="badge badge-primary p-2 tombolEditEarning">Detail</a>
                                <a href="<?= base_url(); ?>user/earningEdit/<?= $order['idOrder']; ?>" class="badge badge-success p-2 tombolEditEarning" data-toggle="modal" data-target="#newEarningModal" data-id="<?= $order['idOrder']; ?>">Edit</a>
                                <a href="<?= base_url(); ?>user/earningDelete/<?= $order['idOrder']; ?>" class="badge badge-danger p-2 tombolHapus">Delete</a>
                            </td>
                            <td><?= $order['namaBarang']; ?></td>
                            <th class="text-right text-success"><?= number_format($order['totalHarga'], 0, ',', '.'); ?></th>
                            <th class="text-right text-danger"><?= number_format($order['profitOrder'], 0, ',', '.'); ?></th>
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

<!-- Modal -->
<div class="modal fade" id="newEarningModal" tabindex="-1" role="dialog" aria-labelledby="newEarningModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title judulModalEarning" id="newEarningModalLabel">Add New Earning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url(); ?>user/earning" class="formActive" method="POST">
                <input type="hidden" name="idEarning" id="idEarning">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Transaction" name="judulTransaksi" id="judulTransaksi">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Income" name="incomeTransaksi" id="incomeTransaksi">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Outcome" name="outcomeTransaksi" id="outcomeTransaksi">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Date" name="dateCreated" id="dateCreated" readonly value="<?= date('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitEarning">Add Earning</button>
                </div>
            </form>
        </div>
    </div>
</div>