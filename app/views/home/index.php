  <?php
  if (isset($data['agenda']) && count($data['agenda']) > 0):
  ?>
    <div class="notification-container">
      <?php
      foreach ($data['agenda'] as $agenda):
      ?>
        <div class="notification">
          <div class="left-section">
            <div class="notification-details">
              <strong><?= $agenda['jenis_agenda']; ?></strong>
              <p><?= $agenda['keterangan']; ?></p>
              <span><?= $agenda['nama_pembuat']; ?></span>
            </div>
          </div>
          <div class="time"><i>🕒</i> <?= $agenda['assign_at']; ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div class="notification-container mt-4">
    <table class="table table-bordered table-striped">
      <thead>
        <tr align="center" class="alert-dark">
          <th>Jenis Agenda</th>
          <th>Keterangan</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($data['agendaKebersamaan'] as $agendaKebersamaan):
        ?>
          <tr align="center">
            <td><span class="badge badge-primary">Agenda Kebersamaan</span></td>
            <td><?= $agendaKebersamaan['keterangan']; ?></td>
            <td><?= $agendaKebersamaan['assign_at']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>