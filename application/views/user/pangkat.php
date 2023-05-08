<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Input Pangkat</h1>

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

</div>
<!-- /.container-fluid -->