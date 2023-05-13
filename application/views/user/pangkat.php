<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Tambah Pangkat</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pangkat</th>
                        <th scope="col">Singkatan</th>
                        <th scope="col">Update at</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($PangkatOptions as $gP) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $gP['nama_pangkat']; ?></td>
                        <td><?= $gP['singkatan']; ?></td>
                        <td><?= $gP['created_at']; ?></td>
                        <td>
                            <a href="" class="badge badge-success">edit</a>
                            <a href="" class="badge badge-danger">delete</a>
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

</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- Modal -->
<!-- Form Input Pangkat -->
   <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open_multipart('user/pangkat'); ?>
                <div class="form-group">
                    <label for="nama_pangkat">Nama Pangkat</label>
                    <input type="text" class="form-control" id="nama_pangkat" name="nama_pangkat" value="<?= set_value('nama_pangkat'); ?>">
                    <?= form_error('nama_pangkat', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="singkatan">Singkatan</label>
                    <input type="text" class="form-control" id="singkatan" name="singkatan" value="<?= set_value('singkatan'); ?>">
                    <?= form_error('singkatan', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div>

