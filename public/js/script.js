const APP_URL = "http://localhost/AgendaApp/public";

let Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 5000,
});
``;

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
    showLoaderOnConfirm: true,
    preConfirm: async (reason) => {
      try {
        const dataBody = {
          reason: reason,
        };
        $.ajax({
          url: baseUrl,
          type: "post",
          dataType: "json",
          data: JSON.stringify(dataBody),
          success: () => {
            console.log("success");
            ;
          },
        });
      } catch (error) {
        Swal.showValidationMessage(`Request failed: ${error}`);
      }
    },
    allowOutsideClick: () => !Swal.isLoading(),
  });
}
