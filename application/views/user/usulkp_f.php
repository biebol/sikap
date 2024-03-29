<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open_multipart('user/usulkp_f'); ?>
                      <div class="form-group row">
                <label class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" readonly>
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="jenis_kenaikan" class="col-sm-2 col-form-label">Jenis Kenaikan</label>
                <div class="col-sm-10">
                    <select name="jenis_kenaikan" id="jenis_kenaikan" class="form-control" disabled>
                        <?php foreach ($jenis_kenaikan as $key => $value) : ?>
                            <?php if ($key == $usulkp['kp_id']) : ?>
                                <option value="<?= $key; ?>" selected><?= $value; ?></option>
                            <?php else : ?>
                                <option value="<?= $key; ?>"><?= $value; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('jenis_kenaikan', '<small class="text-danger">', '</small>'); ?>
                </div>
            </div>

            <!-- Upload File Fields -->
            <div class="form-group row">
                <label for="KepPangkatTerakhir" class="col-sm-6 col-form-label">Kep Pangkat Terakhir (PDF, max 2MB)</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control-file" id="KepPangkatTerakhir" name="KepPangkatTerakhir" accept=".pdf" max-size="2048000">
                    <?= form_error('KepPangkatTerakhir', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="KepJabatanTerakhir" class="col-sm-6 col-form-label">Kep Jabatan Terakhir (PDF, max 2MB)</label>
                <div class="col-sm-6">
    <input type="file" class="form-control-file" id="KepJabatanTerakhir" name="KepJabatanTerakhir" accept=".pdf" max-size="2048000">
    <?= form_error('KepJabatanTerakhir', '<small class="text-danger pl-3">', '</small>'); ?>
</div>
</div>
<div class="form-group row">
    <label for="IjazahDikumti" class="col-sm-6 col-form-label">Ijazah Dikumti (PDF, max 2MB)</label>
    <div class="col-sm-6">
        <input type="file" class="form-control-file" id="IjazahDikumti" name="IjazahDikumti" accept=".pdf" max-size="2048000">
        <?= form_error('IjazahDikumti', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
</div>
<div class="form-group row">
    <label for="PAK" class="col-sm-6 col-form-label">PAK (PDF, max 2MB)</label>
    <div class="col-sm-6">
        <input type="file" class="form-control-file" id="PAK" name="PAK" accept=".pdf" max-size="2048000">
        <?= form_error('PAK', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
</div>
<div class="form-group row">
    <label for="SKP2ThnTerakhir" class="col-sm-6 col-form-label">SKP 2 Thn Terakhir (PDF, max 2MB)</label>
    <div class="col-sm-6">
        <input type="file" class="form-control-file" id="SKP2ThnTerakhir" name="SKP2ThnTerakhir" accept=".pdf" max-size="2048000">
        <?= form_error('SKP2ThnTerakhir', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
</div>
<!-- End of Upload File Fields -->
<div class="form-group row justify-content-end">
    <div class="col-sm-8">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="submit" class="btn btn-primary">Kembali</button>
    </div>
</div>
</div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
```
