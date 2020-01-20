<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <table class="table table-hover">
                <a href="" class="btn btn-primary mb-3 tombolTambahRole" data-toggle="modal" data-target="#newMenuModal">Add New Role</a>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($role as $r) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $r['role']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>admin/roleaccess/<?= $r['idRole']; ?>" class="badge badge-primary">access</a>
                                <a href="<?= base_url(); ?>menu/menuedit/<?= $r['idRole']; ?>" class="badge badge-success tombolEditMenu" data-toggle="modal" data-target="#newMenuModal" data-id="<?= $r['idRole']; ?>">edit</a>
                                <a href="<?= base_url(); ?>menu/menudelete/<?= $r['idRole']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure want to delete this?')">delete</a>
                            </td>
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


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judulModalMenu" id="newMenuModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url(); ?>admin/role" class="formActive" method="POST">
                <input type="hidden" name="idMenu" id="idMenu">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="role" id="role" placeholder="Role Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitMenu">Add Role</button>
                </div>
            </form>
        </div>
    </div>
</div>