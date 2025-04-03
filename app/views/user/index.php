<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold text-xl"><?= $data['judul'] ?></h3>
            <div class="d-flex justify-content-end mt-1">
                <a href="<?= APP_URL; ?>/users/create" class="btn btn-primary">
                    <i class="fa fa-plus"></i> User
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-striped">
                <thead>
                    <tr align="center" class="alert-dark">
                        <th>id</th>
                        <th>Nama Karyawan</th>
                        <th>Jabatan</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data['user'] as  $user):
                    ?>
                        <tr align="center">
                            <td><?= $user['user_id']; ?></td>
                            <td><?= $user['nama_karyawan']; ?></td>
                            <td><?= $user['jabatan']; ?></td>
                            <td><span class="badge badge-<?= $user['user_role'] === 'admin' ? 'success' : 'primary' ?>"><?= $user['user_role']; ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>