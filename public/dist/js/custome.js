$(function () {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        "buttons": ["excel"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "buttons": ["excel"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});


window.setTimeout(function () {
    $(".alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 3000);

$(document).ready(function () {
    $(".add").click(function () {
        var html = $(".copy").html();
        $(".add-more").after(html);
    });
    $("body").on("click", ".remove", function () {
        $(this).parents(".form-group").remove();
    });
});


$(document).ready(function () {
    $(".add-perangkat").click(function () {
        var html = $(".add-data").html();
        $(".add-more-perangkat").after(html);
    });
    $("body").on("click", ".remove-row", function () {
        $(this).parents(".form-group").remove();
    });
});

$(function () {
    bsCustomFileInput.init();
});


function nik() {
    var tes = document.getElementById("nama_user").value;
    document.getElementById("nik_user").value = tes;
}


var url = window.location;
$('ul.nav-sidebar a').filter(function () {
    return this.href == url;
}).addClass('active');
$('ul.nav-treeview a').filter(function () {
    return this.href == url;
}).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

$(document).ready(function () {
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});


$('#nama_user').on('change', function () {
    const nik = $('#nama_user option:selected').data('nik');
    $('[name=nik_user]').val(nik);

});

function upperCase() {
    const x = document.getElementById("up");
    x.value = x.value.toUpperCase();
};


$('.conf').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href');
Swal.fire({
    title: 'Warning !!!',
    text: "Pastikan Perangkat Telah Diterima Oleh Pihak Store.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, proses'
  }).then((result) => {
    if (result.isConfirmed) {
      document.location.href = href;
    }
  })
  });


$('.hapus').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href');
Swal.fire({
    title: 'Hapus Data',
    text: "Data Akan Dihapus ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Hapus'
  }).then((result) => {
    if (result.isConfirmed) {
      document.location.href = href;
    }
  })
  });

  
$('.reset').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href');
Swal.fire({
    title: 'Reset Maintenance',
    text: "Periode Maintenance Akan DI Reset ?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Reset'
  }).then((result) => {
    if (result.isConfirmed) {
      document.location.href = href;
    }
  })
  });


    function submitForm(form) {
        Swal.fire({
            title: 'Warning !!!',
            text: "Pastikan Perangkat Telah Diterima Oleh Pihak Store.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, proses'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
        return false;
    }


    function updateForm(form) {
        Swal.fire({
            title: 'Update Data',
            text: "Data akan di perbarui.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Update'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
        return false;
    }

    function hapusForm(form) {
        Swal.fire({
            title: 'Hapus Data',
            text: "Data akan di hapus ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
        return false;
    }
    



// //Disable cut copy paste

// document.oncopy = function(){alert("copy option disabled"); return false;}

// document.oncut = function(){alert("cut option disabled");return false;}

// document.onpaste = function(){alert("paste option disabled");return false;}




// //Disable mouse right click

// document.onmousedown = disableclick;

// msg = "Right Click Disabled";

// function disableclick(e)

// {

//      if(event.button==2)

//      {

//      alert(msg);

//      return false;

//    }

// }


// window.oncontextmenu = function () {
//             return false;
//         }
//         $(document).keydown(function (event) {
//             if (event.keyCode == 123) {
//                 return false;
//             }
//             else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74)) {
//                 return false;
//             }
//         });