const APP_URL = "http://localhost/AgendaApp/public";

let Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 5000,
});``

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
