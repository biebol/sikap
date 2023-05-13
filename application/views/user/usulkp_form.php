<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <?= form_open_multipart('user/usulkp_form'); ?>
<<<<<<< HEAD

=======
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">Full Name</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>" readonly>
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
>>>>>>> 078b90745829cd6218f4b94da82403dfa9c0cdad
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" value="<?= set_value('nip'); ?>">
                <?= form_error('nip', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= set_value('jabatan'); ?>">
                <?= form_error('jabatan', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="pangkat_lama">Pangkat Lama:</label>
                <select name="pangkat_lama" id="pangkat_lama" class="form-control">
                    <option value="">Pilih Pangkat Lama</option>
                    <?php foreach ($pangkat_lama as $key => $value) : ?>
                        <option value="<?= $key; ?>"><?= $value; ?></option>
                    <?php endforeach; ?>
                </select>
                <?= form_error('pangkat_lama', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="pangkat_baru">Pangkat Baru:</label>
                <select name="pangkat_baru" id="pangkat_baru" class="form-control">
                    <option value="">Pilih Pangkat Baru</option>
                    <?php foreach ($pangkat_baru as $key => $value) : ?>
                        <option value="<?= $key; ?>"><?= $value; ?></option>
                    <?php endforeach; ?>
                </select>
                <?= form_error('pangkat_baru', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="jenis_kenaikan">Jenis Kenaikan Pangkat:</label>
                <select name="jenis_kenaikan" id="jenis_kenaikan" class="form-control">
                    <option value="">Pilih Jenis Kenaikan Pangkat</option>
                    <option value="Regional">Reguler</option>
                    <option value="Fungsional">Fungsional</option>
                    <option value="Struktural">Struktural</option>
                </select>
                <?= form_error('jenis_kenaikan', '<small class="text-danger">', '</small>'); ?>
            </div>
           
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" >Simpan</button>
                    <button type="submit" class="btn btn-primary" formaction="<?= site_url('user/usulkp'); ?>">Selanjutnya</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </div>

            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->