<script>


const child_url = "{!!Request::url() !!}";
function setForm(saved,method,title) {
 save_method = saved;
 $('input[name=_method]').val(method);
 $('#modalForm form')[0].reset();
 $(':input[name=id]').val('');
 $('#modalFormTitle').text(title);
 $('#modalForm').modal('show');
}

function editData(id) {
 $.ajax({
  url: child_url + "/" + id + "/edit",
  type: "GET",
  dataType: "json",
  success: function (result) {

   setData(result);
  },
  error: function (result) {
   console.log(result);
  }
 })
}

function setUrl() {
 var id = $('#id').val();
 if(save_method == "create") url = child_url;
 else url = child_url + '/' + id;

 return url;
}

/** ambil data error**/
function getError(errors) {
 $.each(errors,function (index,value) {
  value.filter(function (obj) {
   return error = obj;
  });
  toastr.error(error,'Error',{
   closeButton: true,
   progressBar: true,
  });
 });
}

/** save data onsubmit**/
$(function () {
 $('#modalForm form').on('submit',function (e) {
  if(!e.isDefaultPrevented()) {
   saveAjax(setUrl());
   return false;
  }

 });
});

function saveAjax(url) {
 Swal.fire({
  type: 'warning',
  text: 'Please wait.',
  showCancelButton: false,
  confirmButtonText: "ok",
  allowOutsideClick: false,
  allowEscapeKey: false
 })
 Swal.showLoading()

 $.ajax({
  url: url,
  type: "post",
  cache: false,
  dataType: 'json',
  data: new FormData($('#modalForm form')[0]),
  contentType: false,
  processData: false,
  headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  success: function (result) {
   reloadDatatable();
   $('#modalForm').modal('hide');
   Toast.fire({
    icon: 'success',
    title: result.message
   })

   // toastr.success('Berhasil Disimpan', 'Success');
  },
  error: function (result) {
   $('#modalForm').modal('hide');
   Toast.fire({
    icon: 'error',
    title: result.responseJSON.message.errorInfo[2]
   })

   if(result.responseJSON) {
    getError(result.responseJSON.errors);
   } else {
    console.log(result);
   }
  },
 })
}

/** konfirmasi hapus data **/
function deleteConfirm(id) {
 Swal.fire({
  title: "Anda akan Menghapus Data ini",
  text: "Anda tidak akan dapat mengembalikannya!",
  type: "warning",
  showCancelButton: !0,
  confirmButtonText: "Yes!",
  cancelButtonText: "Cancel!",
  confirmButtonClass: "btn btn-sm btn-success mt-2",
  cancelButtonClass: "btn btn-sm btn-danger ml-2 mt-2",
  buttonsStyling: !1
 })
  .then(function (t) {
   if(t.value) {
    deleteData(id);
    Swal.fire({
     title: "Deleted!",
     text: "Data Anda telah dihapus.",
     icon: "success"
    });
    reloadDatatable();
   } else {
    Swal.fire({
     title: "Cancelled",
     text: "Data Anda aman :)",
     icon: "error"
    });
   }
  })


}

/** hapus data dari database **/
function deleteData(id) {
 var url = child_url + '/' + id;
 Swal.fire({
  type: 'warning',
  text: 'Please wait.',
  showCancelButton: false,
  confirmButtonText: "ok",
  allowOutsideClick: false,
  allowEscapeKey: false
 })
 Swal.showLoading()
 $.ajax({
  url: url,
  type: "DELETE",

  headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },

  success: function (result) {
   reloadDatatable();
   Toast.fire({
    type: 'success',
    title: result.message
   })

   // toastr.success('Berhasil Dihapus', 'Success');
  },
  error: function (errors) {
     Toast.fire({
    icon: 'error',
    title: errors.responseJSON.message.errorInfo[2]
   })
   getError(errors.responseJSON.errors);
  }
 });
}


</script>
