<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <!-- Menu view -->
    <div class="row">
        <div class="col-lg-6">

            <!-- Errors and Message -->
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <!-- End Errors and Message -->

            <!-- Table Menu -->
            <table class="table table-hover">
                <!-- Tombol modal add new menu -->
                <a href="" class="btn btn-primary mb-3 tombolTambahMenu" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>
                <!-- End Tombol modal add new menu -->
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $m['namaMenu']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>menu/menuedit/<?= $m['idMenu']; ?>" class="badge badge-success tombolEditMenu" data-toggle="modal" data-target="#newMenuModal" data-id="<?= $m['idMenu']; ?>">edit</a>
                                <a href="<?= base_url(); ?>menu/menudelete/<?= $m['idMenu']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure want to delete this?')">delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- End Table Menu -->

        </div>
    </div>
    <!-- End Menu View -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Judul modal -->
            <div class="modal-header">
                <h5 class="modal-title judulModalMenu" id="newMenuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- End Judul modal -->

            <form action="<?= base_url(); ?>menu" class="formActive" method="POST">
                <input type="hidden" name="idMenu" id="idMenu">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="menu" id="menu" placeholder="Menu Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitMenu">Add Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->