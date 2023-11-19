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
                  <div class="form-group mb-3 col-12">
                    <div class="form-line">
                      <label for="title">Title</label>
                      <input type="text" name="title" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group mb-3 col-12">
                    <div class="form-line">
                      <label for="source">Source</label>
                      <input type="text" name="source" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group mb-3 col-12">
                    <div class="form-line">
                      <label for="title">Category</label>
                        <select name="category_id" id="" class="form-control select2" required>
                            @foreach ($categories as $category)
                            <option disabled selected value="">Select an Option</option>
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="form-group mb-3 col-12">
                    <div class="form-line">
                      <label for="image">Cover</label>
                      <input type="file" name="image" class="form-control preview">
                       <div style="width: 100%" class="m-4 text-center" id="preview">
                        <img src="{{ asset('assets/img/no-image.png') }}"  style="width: 50%;" class="mx-auto" alt="">
                       </div>
                    </div>
                  </div>

                  <div class="form-group mb-3 col-12">
                    <div class="form-line">
                      <label for="energy">Body</label>
                      <textarea name="body"  class="form-control myeditorinstance"  rows="10"></textarea>
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
  <script src="https://cdn.tiny.cloud/1/i1nnds4l5jeoaufjhsu6l45pa8zxzdwc4vwh9dktv8d5gig4/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script> --}}
@endpush

@push('script')


  <script>

tinymce.init({
       selector: 'textarea.myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
       plugins: 'code table lists',
       toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
     });

    function getError(errors) {
      $.each(errors, function(index, value) {
        toastr.error(value, 'Error', {
          closeButton: true,
          progressBar: true,
        });
      });
    }

    $('.preview').on('change', function() {
      preview(this)
    })

    function preview(e) {
      if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#preview>img').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
        $('#preview>img').removeClass('d-none');
      }
    }
  </script>
@endpush
