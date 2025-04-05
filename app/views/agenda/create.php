<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-tittle"><?= $data['judul']; ?></h3>
    </div>

    <form action="<?= APP_URL; ?>/agendas/save" method="post">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <label for="user_id" class="col-sm-2 col-form-label">Karyawan<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select class="custom-select select2" id="user_id" name="user_id">
                            <option value="">Pilih Karyawan</option>
                            <?php
                            foreach ($data['karyawan'] as $karyawan):
                            ?>
                                <option value="<?= $karyawan['user_id']; ?>"><?= $karyawan['nama_karyawan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="jenis_agenda_id" class="col-sm-2 col-form-label">Jenis Agenda<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select class="custom-select select2" id="jenis_agenda_id" name="jenis_agenda_id">
                            <option value="">Pilih Jenis Agenda</option>
                            <?php
                            foreach ($data['jenisAgenda'] as $jenisAgenda):
                            ?>
                                <option value="<?= $jenisAgenda['jenis_agenda_id']; ?>"><?= $jenisAgenda['nama_jenis']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="assigndate" class="col-sm-2 col-form-label">tanggal agenda</label>
                    <div class="col-sm-10 input-group date" data-target-input="nearest" id="datetimepicker">
                        <input class="form-control datetimepicker-input" name="assigndate" data-target="#datetimepicker">
                        <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="keterangan" name="keterangan" style="height: 100px"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <div>
                    <a class="btn btn-info" href="<?= APP_URL; ?>/agendas">Kembali</a>
                </div>
                <div>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan data</button>
                </div>
            </div>
        </div>
    </form>
</div>