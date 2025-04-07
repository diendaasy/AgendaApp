<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold text-xl"><?= $data['judul'] ?></h3>
            <?php
            if ($_SESSION['user']['user_role'] === 'admin') :
            ?>
                <div class="d-flex justify-content-end mt-1">
                    <a href="<?= APP_URL; ?>/agendas/create" class="btn btn-primary">
                        <i class="fa fa-plus"></i> agenda
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr align="center" class="alert-dark">
                        <th>id</th>
                        <th>Karyawan</th>
                        <th>Jenis Agenda</th>
                        <th>Agenda Tanggal</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <!-- <th>Dibuat pada</th>
                        <th>Dibuat oleh</th> -->
                        <th>Diapprove pada</th>
                        <th>Diapprove oleh</th>
                        <?php
                        if ($_SESSION['user']['user_role'] === 'approver') :
                        ?>
                            <th>Approval</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data['agenda'] as $agenda):
                    ?>
                        <tr align="center">
                            <td><?= $agenda['agenda_id']; ?></td>
                            <td><?= $agenda['nama_karyawan']; ?></td>
                            <td><?= $agenda['jenis_agenda']; ?></td>
                            <td><?= $agenda['assign_at']; ?></td>
                            <?php
                            $status = '';
                            if ($agenda['status'] === 'created') {
                                $status = 'secondary';
                            } else if ($agenda['status'] === 'approved') {
                                $status = 'success';
                            } else if ($agenda['status'] === 'rejected') {
                                $status = 'danger';
                            } else if ($agenda['status'] === 'done') {
                                $status = 'primary';
                            }
                            ?>
                            <td><span class="badge badge-<?= $status; ?>"><?= $agenda['status']; ?></span></td>

                            <td><?= $agenda['keterangan']; ?></td>
                            <!-- <td><?= $agenda['created_at']; ?></td>
                            <td><?= $agenda['dibuat_oleh']; ?></td> -->
                            <td><?= $agenda['approved_at']; ?></td>
                            <td><?= $agenda['diapprove_oleh']; ?></td>
                            <?php
                            if ($_SESSION['user']['user_role'] === 'approver') :
                            ?>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="<?= APP_URL; ?>/agendas/approve/<?= $agenda['agenda_id']; ?>" class="btn btn-primary mr-2">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        <a href="<?= APP_URL; ?>/agenda/reject/<?= $agenda['agenda_id']; ?>" class="btn btn-danger" onclick="rejectConfirmation(event)">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>