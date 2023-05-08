<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Input Pangkat</h1>

    <!-- Form Input Pangkat -->
    <div class="row">
        <div class="col-lg-6">
            <?= form_open('user/save_pangkat'); ?>
                <div class="form-group">
                    <label for="nama_pangkat">Nama Pangkat</label>
                    <input type="text" class="form-control" id="nama_pangkat" name="nama_pangkat" required>
                </div>
                <div class="form-group">
                    <label for="singkatan">Singkatan</label>
                    <input type="text" class="form-control" id="singkatan" name="singkatan" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->