<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-tittle"><?= $data['judul']; ?></h3>
    </div>

    <form action="<?= APP_URL; ?>/agendas/savejoinagenda" method="post">
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <label for="assigndate" class="col-sm-2 col-form-label">Tanggal agenda</label>
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