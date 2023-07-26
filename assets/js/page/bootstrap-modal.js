"use strict";

$("#modal-1").fireModal({ body: 'Modal body text goes here.', title: 'VISI DAN MISI' });
$("#swal-6").click(function () {
  swal({
    title: 'Apakah anda yakin?',
    text: 'Pasitikan pilihan anda sudah sesuai',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
    .then((willDelete) => {
      if (willDelete) {
        swal('Sukses Memilih Paslon', {
          icon: 'success',
        });
      } else {
        swal('Pilihan dibatalkan');
      }
    });
});

$("#toastr-2").click(function () {
  iziToast.success({
    title: 'Hello, world!',
    message: 'This awesome plugin is made by iziToast',
    position: 'topRight'
  });
});

$("#toastr-3").click(function () {
  iziToast.warning({
    title: 'Hello, world!',
    message: 'This awesome plugin is made by iziToast',
    position: 'topRight'
  });
});

$("#toastr-4").click(function () {
  iziToast.error({
    title: 'Hello, world!',
    message: 'This awesome plugin is made by iziToast',
    position: 'topRight'
  });
});
$("#table-1").dataTable({
  searching: false,
});
$("#table-2").dataTable({
  dom: 'Bfrtip',
  buttons: [
    'excel', 'pdf'
  ],
  pagination: true
});