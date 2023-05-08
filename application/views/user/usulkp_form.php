<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <?= form_open_multipart('user/usulkp_form'); ?>
            
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" value="<?= set_value('nip'); ?>">
                <?= form_error('nip', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name'); ?>">
                <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= set_value('jabatan'); ?>">
                <?= form_error('jabatan', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="pangkat_lama">Pangkat Lama</label>
                <select class="form-control" id="pangkat_lama" name="pangkat_lama">
                    <option value="">Pilih Pangkat Lama</option>
                    <?php foreach ($pangkat_lama as $pangkat) : ?>
                        <option value="<?= $pangkat['pangkatlama_id']; ?>"><?= $pangkat['nama_jabatan']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?= form_error('pangkat_lama', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="pangkat_baru">Pangkat Baru</label>
                <select class="form-control" id="pangkat_baru" name="pangkat_baru">
                    <option value="">Pilih Pangkat Baru</option>
                    <?php foreach ($pangkat_baru as $pangkat) : ?>
                        <option value="<?= $pangkat['pangkatbaru_id']; ?>"><?= $pangkat['nama_pangkat_baru']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?= form_error('pangkat_baru', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
                <label for="jenis_kenaikan">Jenis Kenaikan Pangkat</label>
                <select class="form-control" id="jenis_kenaikan" name="jenis_kenaikan">
                    <option value="">Pilih Jenis Kenaikan Pangkat</option>
                    <option value="Regional">Regional</option>
                    <option value="Fungsional">Fungsional</option>
                    <option value="Struktural">Struktural</option>
                </select>
                <?= form_error('jenis_kenaikan', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Next</button>
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