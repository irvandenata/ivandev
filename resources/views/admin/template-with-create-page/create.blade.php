@extends('layouts.admin')

@section('title', $title)
@section('breadcrumb', $breadcrumb)

@push('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/css/bootstrap-modal.min.css"
    integrity="sha512-888I2nScRzrb/WNZ3qsa5kiZNmaEsvz8HEVQZRGokIEOj/sMnUlLClqP7itKJYDhXWsmp+1usxoCidSEfW2rWw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
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
              <form action="{{ $storeLink }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-4 mb-4">
                    <div class="image">
                      <img src="{{ asset('assets/img/no-image.png') }}" id="preview" style="width: 100%" alt="">
                    </div>
                  </div>
                  <div class="col-8 mb-4">
                    <div class="form-group mb-3">
                      <div class="form-line">
                        <label for="name">Equipment</label>
                        <select name="equipment_id" class="form-control select-equipment" required>
                          <option value=""></option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group mb-3">
                      <div class="form-line">
                        <label for="name">Type</label>
                        <input type="text" class="form-control" id="type" value='' disabled>
                      </div>
                    </div>
                    <div class="form-group mb-3">
                      <div class="form-line">
                        <label for="name">Brand</label>
                        <input type="text" class="form-control" id="brand" value='' disabled>
                      </div>
                    </div>
                    <div class="form-group mb-3">
                      <div class="form-line">
                        <label for="name">Category</label>
                        <input type="text" class="form-control" id="category" value='' disabled>
                      </div>
                    </div>

                  </div>
                  <div class="form-group mb-3 col-6">
                    <div class="form-line">
                      <label for="name">Photo</label>
                      <input type="file" name="photo" class="form-control preview">
                    </div>
                  </div>
                  <div class="form-group mb-3 col-6">
                    <div class="form-line">
                      <label for="name">Installation Date</label>
                      <input type="date" name="installation_date" class="form-control" onfocus="this.showPicker()"
                        required>
                    </div>
                  </div>
                  <div class="form-group mb-3 col-12">
                    <div class="form-line">
                      <label for="name">Room</label>
                      <select name="room_id" class="form-control select-room" required>
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group mb-3 col-6">
                    <div class="form-line">
                      <label for="name">Serial Number</label>
                      <input type="text" name="serial_number" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group mb-3 col-6">
                    <div class="form-line">
                      <label for="name">Price</label>
                      <input type="number" name="price" class="form-control preview" required>
                    </div>
                  </div>
                </div>
                <div class="mt-4">
                  <a href="{{ $indexLink }}" class="btn btn-secondary mt-2">Back</a>
                  <button type="submit" class="btn btn-success mt-2" id="submit">Save</button>
                </div>
              </form>
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
@endpush

@push('script')
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
    $('.preview').on('change', function() {
      preview(this)
    })
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



    function getError(errors) {
      $.each(errors, function(index, value) {
        toastr.error(value, 'Error', {
          closeButton: true,
          progressBar: true,
        });
      });
    }
  </script>
@endpush
