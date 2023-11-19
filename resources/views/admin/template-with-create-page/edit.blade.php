@extends('layouts.admin')

@section('title', $title)
@section('breadcrumb', $breadcrumb)

@push('css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/css/bootstrap-modal.min.css"
    integrity="sha512-888I2nScRzrb/WNZ3qsa5kiZNmaEsvz8HEVQZRGokIEOj/sMnUlLClqP7itKJYDhXWsmp+1usxoCidSEfW2rWw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

@endpush

@push('style')
@endpush

@section('content')
  <div class="row">
    <div class="col-xl-12 col-xxl-12 ">
      <div class="w-100">
        <div class="row">
          <div class="col-12">
            <div class="card p-4">
              <form action="{{ $updateLink }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-4 mb-4">
                      <div class="image">
                        <img src="{{ $item->photo_url?"/storage/$item->photo_url":asset('assets/img/no-image.png') }}" id="preview" style="width: 100%" alt="">
                      </div>
                    </div>
                    <div class="col-8 mb-4">
                      <div class="form-group mb-3">
                        <div class="form-line">
                          <label for="name">Equipment</label>
                          <select name="equipment_id" class="form-control select-equipment" required disabled>
                            <option value="{{ $item->equipment->id }}" selected>{{ $item->equipment->name }}</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group mb-3">
                        <div class="form-line">
                          <label for="name">Type</label>
                          <input type="text" class="form-control" id="type" value='{{ $item->equipment->type }}' disabled>
                        </div>
                      </div>
                      <div class="form-group mb-3">
                        <div class="form-line">
                          <label for="name">Brand</label>
                          <input type="text" class="form-control" id="brand" value='{{ $item->equipment->brand->name }}' disabled>
                        </div>
                      </div>
                      <div class="form-group mb-3">
                        <div class="form-line">
                          <label for="name">Category</label>
                          <input type="text" class="form-control" id="category" value='{{ $item->equipment->category->name }}' disabled>
                        </div>
                      </div>

                    </div>
                    <div class="form-group mb-3 col-6">
                      <div class="form-line">
                        <label for="name">Photo</label>
                        <input type="file" name="photo" class="form-control preview" disabled>
                      </div>
                    </div>

                    <div class="form-group mb-3 col-6">
                      <div class="form-line">
                        <label for="name">Installation Date</label>
                        <input type="date" name="installation_date" value="{{ $item->installation_date }}" class="form-control date" onfocus="this.showPicker()"
                          required disabled>
                      </div>
                    </div>
                    <div class="form-group mb-3 col-12">
                      <div class="form-line">
                        <label for="name">Room</label>
                        <select name="room_id" class="form-control select-room" required disabled>
                          <option value="{{ $item->room->id }}" selected> {{ $item->room->name }} - {{ $item->room->location }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group mb-3 col-6">
                      <div class="form-line">
                        <label for="name">Serial Number</label>
                        <input type="text" name="serial_number" class="form-control sr" value="{{ $item->serial_number }}" required disabled>
                      </div>
                    </div>
                    <div class="form-group mb-3 col-6">
                      <div class="form-line">
                        <label for="name">Price</label>
                        <input type="number" name="price" class="form-control price" value="{{ $item->price }}" required disabled>
                      </div>
                    </div>
                  </div>
                <div>
                  <a href="{{ $indexLink }}" class="btn btn-secondary mt-2">Back</a>
                  <div id="button" style="display: inline">
                    <button  class="btn btn-warning mt-2"  id="edit">Edit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header ">
                    <h4>Complaint History</h4>
                </div>
                <div class="table-responsive mt-2  p-4">
                    <table id="datatable-complaint" class="table m-t-30">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Technician</th>
                          <th>Report Date</th>
                          <th>Handling Date</th>
                          <th>Status</th>
                          <th>Condition Inventory</th>
                          <th width="10%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($item->complaints()->orderByDesc('report_date')->get() as $complaint )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $complaint->technician? ($complaint->technician->name .' - '. $complaint->technician->code):'-' }} </td>
                            <td>{{ $complaint->report_date }}</td>
                            <td>{{ $complaint->handling_date??'-' }}</td>
                            <td>{!! $complaint->status==1?'<small class="px-2 rounded text-white text-center bg-success">Resolved</small>':'<small class="px-2 rounded text-white text-center bg-warning">Waiting</small>' !!}</td>
                            <td>{!! $complaint->condition==1?'<small class="px-2 rounded text-white text-center bg-success">Good</small>':($complaint->condition==2?'<small class="px-2 rounded text-white text-center bg-warning">In Trouble</small>':'<small class="px-2 rounded text-white text-center bg-danger">Damaged</small>') !!}</td>
                            <td>{!! '
                                <a class="btn btn-danger btn-sm"  onclick="deleteItem(' . $complaint->id . ')"><i class="fas fa-trash text-white"></i></span></a> <a class="btn btn-warning btn-sm" href="' . route('admin.complaints.edit', $complaint->id) . '" ><i class="fas fa-pencil text-white    "></i></span></a><a class="btn btn-primary mt-1 btn-sm" href="'.route('admin.complaints.show',$complaint->id).'" ><i class="fas fa-eye text-white    "></i></span></a>' !!}</td>
                                </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('js')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modal.min.js"
    integrity="sha512-0wCoO9w07Mu4MnC918HEsFyXhVJVoxeq+RD4XXYukmLswUHMCRbBomZE+NjxBtv88QTU/fImTY+PclhlMpJ4JA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
@endpush

@push('script')
<script>
    $('#datatable-complaint').DataTable()
</script>
<script>
    let tampEquipment;
    $('.select-equipment').select2({
      ajax: {
        url: "/api/get-equipments",
        data: function(params) {
          var data = {
            data: params.term
          }
          return data;
        },
        processResults: function(data) {
          tampEquipment = data
          return {
            results: $.map(data, function(item) {
              return {
                text: item.name + ' - ' + item.type,
                id: item.id,
              }
            })
          }
        }
      },
      placeholder: "--- Select an Option ---",
      allowClear: true
    });
    $('.select-room').select2({
      ajax: {
        url: "/api/get-rooms",
        data: function(params) {
          var data = {
            data: params.term
          }
          return data;
        },
        processResults: function(data) {
          tampEquipment = data
          return {
            results: $.map(data, function(item) {
              return {
                text: item.name + ' - ' + item.location,
                id: item.id,
              }
            })
          }
        }
      },
      placeholder: "--- Select an Option ---",
      allowClear: true
    });

    $('.select-equipment').on('change', function() {
      console.log(tampEquipment)
      console.log()
      let id = $(this).val();
      let indexEquipment = tampEquipment.findIndex(function(item) {
        return item['id'] == id;
      })
      let data = tampEquipment[indexEquipment];
      $('#brand').val(data.brand.name)
      $('#category').val(data.category.name)
      $('#type').val(data.type)
    })
  </script>
  <script>

    $('#edit').on('click',function(){
        $('#button').empty()
        $('#button').append(`<button type="submit" class="btn btn-success mt-2" id="submit">Save</button>`)
        $('.select-equipment').attr('disabled',false)
        $('.preview').attr('disabled',false)
        $('.date').attr('disabled',false)
        $('.select-room').attr('disabled',false)
        $('.sr').attr('disabled',false)
        $('.price').attr('disabled',false)
    })
    function deleteItem(id) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true,
      })

      swalWithBootstrapButtons.fire({
        title: 'Are You Sure ?',
        text: "You will delete this data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete!',
        cancelButtonText: 'No, Quit!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          deleteData(id).then((result) => {

            if (result) {

              swalWithBootstrapButtons.fire(
                'Deleted!',
                'Data Has Been Deleted',
                'success'
              ).then(() => {
                limitOrder--;

                reloadDatatable();

              })
            }
          });


        } else if (
          // Read more about handling dismissals
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancel',
            'Process Has Been Canceled',
            'error'
          )
        }
      })
    }

    /** hapus data dari database **/
    function deleteData(id) {

      return new Promise((resolve, reject) => {
        var url = child_url + '/' + id;
        let result = false;
        Swal.fire({
          text: 'Please wait.',
          icon: 'warning',
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
          success: function(result) {
            resolve(true)
            // toastr.success('Berhasil Dihapus', 'Success');
          },
          error: function(errors) {

            getError(errors.responseJSON);
            Swal.fire({
              icon: 'error',
              text: 'Terjadi Kesalahan !',
              showCancelButton: false,
            })
            reject(false)
          }
        })
      })

    }
  </script>
  <script>



    @if (session('error'))
      @foreach (session('error') as $error)
        Toast.fire({
          icon: 'error',
          name: '{{ $error }}'
        })
      @endforeach
    @endif
  </script>

  <script>
    $('.close-modal').on('click', function() {
      $('.modal').modal('hide')

    })
    $('#createCategory').on('click', function(e) {
      if ($('.nameCategory').val() != '') {
        e.preventDefault();
        $.ajax({
          url: '/api/create-category',
          type: "post",
          cache: false,
          dataType: 'json',
          data: new FormData($('#modalCategory form')[0]),
          contentType: false,
          processData: false,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(result) {
            Toast.fire({
              icon: 'success',
              title: result.message
            })
            $('.modal').modal('hide')

            // toastr.success('Berhasil Disimpan', 'Success');
          },
          error: async function(result) {
            Swal.fire({
              icon: 'error',
              text: 'Terjadi Kesalahan !',
              showCancelButton: false,
            }).then(() => {
              if (result.responseJSON) {
                console.log(result.responseJSON)
                getError(result.responseJSON);
              } else {
                console.log(result);
              }
            })

          },
        })
      }
    })

    $('#createBrand').on('click', function(e) {
      if ($('.nameBrand').val() != '') {
        e.preventDefault();
        $.ajax({
          url: '/api/create-brand',
          type: "post",
          cache: false,
          dataType: 'json',
          data: new FormData($('#modalBrand form')[0]),
          contentType: false,
          processData: false,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(result) {
            Toast.fire({
              icon: 'success',
              title: result.message
            })
            $('.modal').modal('hide')
            // toastr.success('Berhasil Disimpan', 'Success');
          },
          error: async function(result) {
            Swal.fire({
              icon: 'error',
              text: 'Terjadi Kesalahan !',
              showCancelButton: false,
            }).then(() => {
              if (result.responseJSON) {
                console.log(result.responseJSON)
                getError(result.responseJSON);
              } else {
                console.log(result);
              }
            })

          },
        })
      }
    })

    $('.showModalCategory').on('click', function() {
      $('#modalCategory').modal('show');
      $('#modalCategory form')[0].reset();

    })
    $('.showModalBrand').on('click', function() {
      $('#modalBrand').modal('show');
      $('#modalBrand form')[0].reset();

    })
  </script>
@endpush
