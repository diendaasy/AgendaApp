<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-tittle"><?= $data['judul']; ?></h3>
    </div>

    <form action="<?= APP_URL; ?>/users/save" method="post">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <label for="nama_karyawan" class="col-sm-2 col-form-label"> Nama lengkap<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" autocomplete="off" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="username" class="col-sm-2 col-form-label"> Username<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" autocomplete="off" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jabatan" name="jabatan" autocomplete="off" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                    <div class="col-sm-10 input-group date" data-target-input="nearest" id="datetimepicker">
                        <input class="form-control datetimepicker-input" name="tanggal_lahir" data-target="#datetimepicker">
                        <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis kelamin<span class="text-danger">*</span></label>
                    <div class="col-sm-2">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="Laki-laki" /> Laki-laki
                    </div>
                    <div class="col-sm-8">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="Perempuan" /> Perempuan
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="password" class="col-sm-2 col-form-label"> Password<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="confirm_password" class="col-sm-2 col-form-label"> konfirmasi password<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <div>
                    <a class="btn btn-info" href="<?= APP_URL; ?>/users">Kembali</a>
                </div>
                <div>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan data</button>
                </div>
            </div>
        </div>
    </form>
</div>