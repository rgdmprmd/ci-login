<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="success-add" data-addProd="<?= $this->session->flashdata('addProd'); ?>"></div>
    <div class="fail-add" data-addFail="<?= $this->session->flashdata('addFail'); ?>"></div>

    <div class="row">
        <div class="col-lg">
            <!-- Trigger modal -->
            <a href="" class="btn btn-primary mb-3 tombolTambahProduk" data-toggle="modal" data-target="#tambahProduk">Tambah Barang Baru</a>

            <!-- Table Produk -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" width="50">#</th>
                        <th scope="col" width="250" class="text-center">Opsi</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col" class="text-right">Stok</th>
                        <th scope="col" class="text-right">Terjual</th>
                        <th scope="col" class="text-right">Harga Beli</th>
                        <th scope="col" class="text-right">Harga Jual</th>
                        <th scope="col" class="text-right">Profit</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($produk as $p) : ?>
                        <tr>
                            <th scope="col"><?= $i++; ?></th>
                            <td class="text-center">
                                <a href="<?= base_url(); ?>inventory/orderProduk/<?= $p['idProduk']; ?>" class="badge badge-primary p-2 tombolOrder" data-toggle="modal" data-target="#formModal" data-id="<?= $p['idProduk']; ?>">Order</a>
                                <a href="<?= base_url(); ?>inventory/produkEdit/<?= $p['idProduk']; ?>" class="badge badge-success p-2 tombolEditProduk" data-toggle="modal" data-target="#tambahProduk" data-id="<?= $p['idProduk']; ?>">Edit</a>
                                <a href="<?= base_url(); ?>inventory/produkDelete/<?= $p['idProduk']; ?>" class="badge badge-danger p-2 tombolHapus">Delete</a>
                            </td>
                            <td><?= $p['namaProduk']; ?></td>
                            <td class="text-right"><?= number_format($p['stokProduk'], 0, ',', '.'); ?></td>
                            <td class="text-right"><?= number_format($p['terjualProduk'], 0, ',', '.'); ?></td>
                            <td class="text-right"><?= number_format($p['hargaBeli'], 0, ',', '.'); ?></td>
                            <td class="text-right"><?= number_format($p['hargaJual'], 0, ',', '.'); ?></td>
                            <th class="text-right text-success"><?= number_format($p['profitProduk'], 0, ',', '.'); ?></th>
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
<div class="modal fade" id="tambahProduk" tabindex="-1" role="dialog" aria-labelledby="tambahProdukLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title judulModalTambahProduk" id="tambahProdukLabel">Tambah Produk Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url(); ?>inventory" class="formActive" method="POST">
                <input type="hidden" name="idProduk" id="idProduk">
                <input type="hidden" name="idCabang" id="idCabang">
                <input type="hidden" name="email" id="email">
                <input type="hidden" name="dateCreated" id="dateCreated">
                <input type="hidden" name="dateModified" id="dateModified">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama Produk" name="namaProduk" id="namaProduk" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="cabang" id="cabang">
                            <option value="0" disabled selected>Pilih Cabang</option>
                            <?php foreach ($cabang as $cab) : ?>
                                <option value="<?= $cab['idCabang']; ?>"><?= $cab['namaCabang']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Stok Produk" name="stokProduk" id="stokProduk" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Harga Beli" name="hargaBeli" id="hargaBeli" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Harga Jual" name="hargaJual" id="hargaJual" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitProduk">Add Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Tambah Data Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url(); ?>inventory/order" class="formActive" method="POST">
                <input type="hidden" name="idProduk" id="idProduk">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="produk">Produk</label>
                        <input type="text" class="form-control" id="produk" name="produk" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label for="stoky">Stok</label>
                        <input type="number" class="form-control" id="stoky" name="stoky" autocomplete="off" readonly>
                    </div>
                    <div class="form-group">
                        <label for="qty">Quantity</label>
                        <input type="number" class="form-control" id="qty" name="qty" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="text" class="form-control" id="date" name="date" value="<?= date('Y-m-d'); ?>" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submitData">Tambah Order</button>
                </div>
            </form>
        </div>
    </div>
</div>