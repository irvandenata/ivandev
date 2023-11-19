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
              <form action="{{ $updateLink }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group mb-3 col-12">
                      <div class="form-line">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $item->title }}" required>
                      </div>
                    </div>
                    <div class="form-group mb-3 col-12">
                        <div class="form-line">
                          <label for="source">Source</label>
                          <input type="text" name="source" class="form-control" value="{{ $item->source }}" required>
                        </div>
                      </div>
                    <div class="form-group mb-3 col-12">
                      <div class="form-line">
                        <label for="title">Category</label>
                          <select name="category_id" id="" class="form-control select2" required>
                              @foreach ($categories as $category)
                              <option value="{{ $category->id }}" {{ selectedOption($category->id,$item->category_id) }}>{{ $category->name }}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="form-group mb-3 col-12">
                      <div class="form-line">
                        <label for="image">Cover</label>
                        <input type="file" name="image" class="form-control preview">
                         <div style="width: 100%" class="m-4 text-center" id="preview">
                          <img src="{{ $item->image ?'/storage/'.$item->image:asset('assets/img/no-image.png') }}"  style="width: 50%;" class="mx-auto" alt="">

                         </div>
                      </div>
                    </div>

                    <div class="form-group mb-3 col-12">
                      <div class="form-line">
                        <label for="energy">Body</label>
                        <textarea name="body"  class="form-control myeditorinstance"  rows="10">
                          {{ $item->body }}
                        </textarea>
                      </div>
                    </div>
                  </div>
                <a href="{{ $indexLink }}" class="btn btn-secondary mt-2">Back</a>
                <div id="button" style="display: inline">
                  <button type="submit" class="btn btn-success mt-2" id="submit">Save</button>
                </div>
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
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.tiny.cloud/1/i1nnds4l5jeoaufjhsu6l45pa8zxzdwc4vwh9dktv8d5gig4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
@endpush

@push('script')
  <script>

tinymce.init({
       selector: 'textarea.myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
       plugins: 'code table lists',
       toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
     });
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
