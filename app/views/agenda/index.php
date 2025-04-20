<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold text-xl"><?= $data['judul'] ?></h3>
            <?php
            if ($_SESSION['user']['user_role'] === 'admin') :
            ?>
                <div class="d-flex justify-content-end mt-1">
                    <a href="<?= APP_URL; ?>/agendas/create" class="btn btn-primary mr-2">
                        <i class="fa fa-plus"></i> Agenda
                    </a>
                    <a href="<?= APP_URL; ?>/agendas/createJoinAgenda" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Agenda kebersamaan
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
                        <?php
                        if ($_SESSION['user']['user_role'] !== 'karyawan') :
                        ?>
                            <th>Diapprove pada</th>
                            <th>Diapprove oleh</th>
                        <?php endif; ?>
                        <?php
                        if ($_SESSION['user']['user_role'] === 'approver') :
                        ?>
                            <th>Approval</th>
                        <?php endif; ?>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data['agenda'] as $agenda):
                    ?>
                        <tr align="center">
                            <td><?= $agenda['agenda_id']; ?></td>
                            <td><?= $agenda['nama_karyawan']; ?></td>
                            <?php
                            if (isset($agenda['jenis_agenda'])):
                            ?>
                                <td><?= $agenda['jenis_agenda']; ?></td>
                            <?php else: ?>
                                <td><span class="badge badge-primary">Agenda Kebersamaan</span></td>
                            <?php endif; ?>
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
                            <?php
                            if ($_SESSION['user']['user_role'] !== 'karyawan') :
                            ?>
                                <td><?= $agenda['approved_at']; ?></td>
                                <td><?= $agenda['diapprove_oleh']; ?></td>
                            <?php endif; ?>
                            <?php
                            if ($_SESSION['user']['user_role'] === 'approver') :
                            ?>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <?php
                                        if ($agenda['status'] === 'created') :
                                        ?>
                                            <a href="<?= APP_URL; ?>/agendas/approve/<?= $agenda['agenda_id']; ?>" class="btn btn-primary mr-2">
                                                <i class="fa fa-check"></i>
                                            </a>
                                            <a href="<?= APP_URL; ?>/agendas/reject/<?= $agenda['agenda_id']; ?>" class="btn btn-danger" onclick="rejectConfirmation(event)">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            <?php endif; ?>
                            <?php
                            if ($_SESSION['user']['user_role'] === 'admin') :
                            ?>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <?php if (!isset($agenda['jenis_agenda'])): ?>
                                            <a href="<?= APP_URL; ?>/agendas/editJoinAgenda/<?= $agenda['agenda_id']; ?>" class="btn btn-primary mr-2">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a href="<?= APP_URL; ?>/agendas/deleteJoinAgenda/<?= $agenda['agenda_id']; ?>" class="btn btn-danger mr-2" data-keterangan="<?= $agenda['keterangan']; ?>" onclick="deleteConfirmation(event)">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php
                                        if ($agenda['status'] === 'done'):
                                        ?>
                                            <a href="#" data-path="<?= APP_URL . '/' . $agenda['file_path_absen'] ?? APP_URL . '/img/no_image_found.png'; ?>" class="btn btn-secondary mr-2" onclick="showBuktiAbsen(event)" data-toggle="modal" data-target="#showAbsen">
                                                <i class="fa fa-image"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            <?php elseif ($_SESSION['user']['user_role'] === 'karyawan'): ?>
                                <td>
                                    <a href="<?= APP_URL; ?>/agendas/absen/<?= $agenda['agenda_id']; ?>" data-path="<?= $agenda['file_path_absen']; ?>" data-filename="<?= $agenda['agenda_id']; ?>_<?= $_SESSION['user']['nama_karyawan']; ?>_<?= $agenda['assign_at']; ?>" class="btn btn-secondary mr-2" onclick="popupUpload(event)" data-toggle="modal" data-target="#staticBackdrop">
                                        <i class="fa fa-image"></i>
                                    </a>
                                </td>
                            <?php else : ?>
                                <td>-</td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Unggah Foto Absensi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="filename">
                        <div class="row">
                            <input type="file" accept=".png, .jpg, .jpeg" onchange="previewImage(event)" name="bukti_absen">
                        </div>
                        <div class="row">
                            <img id="preview" src="<?= APP_URL; ?>/img/no_image_found.png" alt="Profile Preview" class="img-thumbnail">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="showAbsen" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Unggah Foto Absensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <img id="preview" src="<?= APP_URL; ?>/img/no_image_found.png" alt="Profile Preview" class="img-thumbnail">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>