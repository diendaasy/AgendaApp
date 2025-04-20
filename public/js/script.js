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

function deleteUserConfirmation(e) {
  e.preventDefault();
  let url = e.currentTarget.getAttribute("href");
  let nama = e.currentTarget.getAttribute("data-nama");
  Swal.fire({
    title: "Pesan Konfirmasi",
    html: `Apakah anda yakin ingin menghapus data <b>${nama}</b> ?`,
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

function popupUpload(e) {
  e.preventDefault();

  let url = e.currentTarget.getAttribute("href");
  let path = e.currentTarget.getAttribute("data-path");
  let filename = e.currentTarget.getAttribute("data-filename");
  filename = filename.replaceAll(" ", "_");

  // Set form action
  const form = document.querySelector("#staticBackdrop form");
  form.setAttribute("action", url);

  // Set preview image src
  const previewImg = document.querySelector("#staticBackdrop img#preview");
  previewImg.setAttribute(
    "src",
    path ? path : APP_URL + "/img/no_image_found.png"
  );

  let hiddenInput = form.querySelector('input[name="filename"]');
  hiddenInput.value = filename;
}

function showBuktiAbsen(e) {
  e.preventDefault();

  let path = e.currentTarget.getAttribute("data-path");

  // Set preview image src
  const previewImg = document.querySelector("#showAbsen img#preview");
  previewImg.setAttribute(
    "src",
    path ? path : APP_URL + "/img/no_image_found.png"
  );
}

function previewImage(event) {
  const input = event.target;
  const preview = document.getElementById("preview");

  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function (e) {
      preview.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
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
    minDate: moment(),
  });

  // Reset form and image when modal is closed
  $("#staticBackdrop").on("hidden.bs.modal", function () {
    const form = document.querySelector("#staticBackdrop form");
    const previewImg = document.querySelector("#staticBackdrop img#preview");
    let hiddenInput = form.querySelector('input[name="filename"]');

    form.setAttribute("action", "");
    previewImg.setAttribute("src", APP_URL + "/img/no_image_found.png");

    // Optional: clear the file input too
    const fileInput = form.querySelector('input[type="file"]');
    if (fileInput) fileInput.value = "";
    if (hiddenInput) hiddenInput.value = "";
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
