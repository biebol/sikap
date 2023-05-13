<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
 
    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newpangkat">Tambah Pangkat</a>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pangkat</th>
                            <th scope="col">Singkatan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pangkat as $p) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $p['nama_pangkat']; ?></td>
                            <td><?= $p['singkatan']; ?></td>
                            <td>
                                <a href="" class="badge badge-success" data-toggle="modal" data-target="#editpangkat<?= $p['pangkat_id']; ?>">edit</a>
                                <a href="<?= base_url('admin/pangkat/deletePangkat/' . $p['pangkat_id']); ?>" class="badge badge-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
                </table>


            </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal Edit Pangkat -->
<?php foreach ($pangkat as $p) : ?>
<div class="modal fade" id="editpangkat<?= $p['pangkat_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editpangkatLabel<?= $p['pangkat_id']; ?>" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editpangkatLabel<?= $p['pangkat_id']; ?>">Edit Pangkat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- Form Edit Pangkat -->
            <form action="<?= base_url('admin/pangkat/update/'. $p['pangkat_id']); ?>" method="post">
                <div class="form-group">
                    <label for="editNamaPangkat<?= $p['pangkat_id']; ?>">Nama Pangkat</label>
                    <input type="text" class="form-control" id="editNamaPangkat<?= $p['pangkat_id']; ?>" name="nama_pangkat" placeholder="Masukkan Nama Pangkat" value="<?= $p['nama_pangkat']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="editSingkatanPangkat<?= $p['pangkat_id']; ?>">Singkatan Pangkat</label>
                    <input type="text" class="form-control" id="editSingkatanPangkat<?= $p['pangkat_id']; ?>" name="singkatan" placeholder="Masukkan Singkatan Pangkat" value="<?= $p['singkatan']; ?>" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Form Input Pangkat -->
<div class="modal fade" id="newpangkat" tabindex="-1" role="dialog" aria-labelledby="newpangkatLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newpangkatLabel">Tambah Pangkat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form Tambah Pangkat -->
        <form action="<?= base_url('admin/pangkat'); ?>" method="post">
          <div class="form-group">
            <label for="namaPangkat">Nama Pangkat</label>
            <input type="text" class="form-control" id="namaPangkat" name="nama_pangkat" placeholder="Masukkan Nama Pangkat" required>
          </div>
          <div class="form-group">
            <label for="singkatanPangkat">Singkatan Pangkat</label>
            <input type="text" class="form-control" id="singkatanPangkat" name="singkatan" placeholder="Masukkan Singkatan Pangkat" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>