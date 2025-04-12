const APP_URL = "http://localhost/AgendaApp/public";

let Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 5000,
});

function deleteConfirmation(e) {
  e.preventDefault();
  let url = e.currentTarget.getAttribute("href");
  let keterangan = e.currentTarget.getAttribute("data-keterangan");
  Swal.fire({
    title: "Pesan Konfirmasi",
    html: `Apakah anda yakin ingin menghapus data <b>${keterangan}</b> ?`,
    icon: "warning",
    showCancelButton: true,
    confirmbuttoncolor: "#d33",
    cancelbuttoncolor: "#3085d6",
    confirmButtonText: "hapus!",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = url;
    }
  });
}

$(function () {
  $(".select2").select2({
    theme: "bootstrap4",
  });

  $("#datatable")
    .DataTable({
      responsive: true,
      lengthChange: true,
      autoWidth: false,
      buttons: ["excel", "pdf", "print"],
    })
    .buttons()
    .container()
    .appendTo("#datatable_wrapper .col-md-6:eq(0)");

  $("#datetimepicker").datetimepicker({
    format: "YYYY-MM-DD",
    useCurrent: false,
  });
});

function rejectConfirmation(e) {
  e.preventDefault();
  let baseUrl = e.currentTarget.getAttribute("href");

  Swal.fire({
    title: "Alasan Penolakan",
    input: "text",
    inputAttributes: {
      autocapitalize: "off",
    },
    inputValidator: (value) => {
      if (!value) {
        return "Alasan wajib diisi!";
      }
    },
    showCancelButton: true,
    confirmButtonText: "Submit",
  }).then((result) => {
    if (result.isConfirmed && result.value) {
      $.ajax({
        url: baseUrl,
        method: "POST",
        data: { reason: result.value },
        success: function (response) {
          Swal.fire({
            icon: response.status,
            title: response.message,
          }).then(() => {
            window.location.href = response.redirect;
          });
        },
      });
    }
  });
}
