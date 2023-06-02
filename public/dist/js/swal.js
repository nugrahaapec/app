
const flashData = $('.flash-data').data('flashdata');
if (flashData) {
    Swal.fire({
        title: flashData,
        text: "Silahkan login kembali",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
      }).then((result) => {
        window.location.href = '/app/public/logout';
      })
}

const DataMaintenance = $('.data-maintenance').data('maintenance');
if (DataMaintenance) {
  Swal.fire({
      title: DataMaintenance,
      text: "",
      icon: 'success',
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok'
    })
    
}

const Dataperangkat = $('.data-perangkat').data('perangkat');
if (Dataperangkat) {
  Swal.fire({
      title: 'Berhasil',
      text: Dataperangkat,
      icon: 'success',
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok'
    })
}

const Cancel = $('.data-cancel').data('cancel');
if (Cancel) {
  Swal.fire({
      title: 'Berhasil',
      text: Cancel,
      icon: 'success',
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok'
    })
}


const error = $('.data-error').data('error');
if (error) {
  Swal.fire({
      title: "Gagal",
      text: error,
      icon: 'error',
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ok'
    })
}
