<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('user/usulkp'); ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Full name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Picture</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upload File Fields -->
            <div class="form-group row">
                <label for="kep_pangkat" class="col-sm-2 col-form-label">Kep Pangkat Terakhir</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" id="kep_pangkat" name="kep_pangkat">
                </div>
            </div>
            <div class="form-group row">
                <label for="kep_jabatan" class="col-sm-2 col-form-label">Kep Jabatan Terakhir</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" id="kep_jabatan" name="kep_jabatan">
                </div>
            </div>
            <div class="form-group row">
                <label for="ijazah_dikumti" class="col-sm-2 col-form-label">Ijazah Dikumti</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" id="ijazah_dikumti" name="ijazah_dikumti">
                </div>
            </div>
            <div class="form-group row">
                        <label for="ijazah_ud" class="col-sm-2 col-form-label">Ijazah Ujian Dinas</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" id="ijazah_ud" name="ijazah_ud">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="algol" class="col-sm-2 col-form-label">Algol (khusus ke III/a)</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" id="algol" name="algol">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="skp" class="col-sm-2 col-form-label">SKP 2 Thn Terakhir</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" id="skp" name="skp">
                        </div>
                    </div>
            <!-- End of Upload File Fields -->

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>

            </form>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content --> 