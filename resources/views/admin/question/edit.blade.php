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
                  <div class="form-group mb-3 col-12">
                    <div class="form-line">
                      <label for="title">Category</label>
                      <select name="category_id" id="" class="form-control select2" required>
                        <option disabled selected value="">Select an Option</option>
                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}" {{ selectedOption($category->id, $item->category_id) }}>
                            {{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>


                  <div class="form-group mb-3 col-12">
                    <div class="form-line">
                      <label for="energy">Question</label>
                      <textarea name="question" class="form-control myeditorinstance" rows="10">
                        {{ $item->question }}
                        </textarea>
                    </div>
                  </div>


                  <div class="form-group mb-3 col-12">
                    <button class="btn btn-primary mb-4" type="button" id="addOption">Add Option</button>
                    <div id="option">
                      @foreach ($item->options as $option)
                        <div class="form-line option">
                          <label for="energy">Option {{ $loop->iteration }}</label>
                          <div class="row">
                            <div class="col-10">
                              <input type="text" data-id="{{ $loop->iteration }}" name="option[]"
                                class="form-control inputOption" value="{{ $option->option }}">
                            </div>
                            <div class="col-2">
                              <button class="btn btn-danger removeOption" type="button">Remove</button>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

                  <div class="form-group mb-3 col-12">
                    <label for="energy">Answer</label>
                    <select name="answer" id="" class="form-control" required>
                      <option disabled selected value="">Select an Option</option>
                      @foreach ($item->options as $option)
                        <option value="{{ $loop->iteration }}" @if ($option->is_correct == 1) selected @endif>
                          Option {{ $loop->iteration }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group mb-3 col-12">
                    <div class="form-line">
                      <label for="explanation">Explanation</label>
                      <textarea name="explanation" class="form-control myeditorinstance" rows="10">
                        {{ $item->explanation }}
                      </textarea>
                    </div>
                  </div>


                  <div class="form-group mb-3 col-12">
                    <div class="form-line">
                      <label for="image">Image</label>
                      <input type="file" name="image" class="form-control preview">
                      <div style="width: 100%" class="m-4 text-center" id="preview">
                        <img src="/storage/{{ $item->image }}" style="width: 50%;" class="mx-auto"
                          alt="">
                      </div>
                    </div>
                  </div>
                </div>
                <a href="{{ $indexLink }}" class="btn btn-secondary mt-2">Back</a>
                <button type="submit" class="btn btn-primary mt-2">Update</button>
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
    <script src="https://cdn.tiny.cloud/1/i1nnds4l5jeoaufjhsu6l45pa8zxzdwc4vwh9dktv8d5gig4/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
@endpush

@push('script')
<script>
    tinymce.init({
      selector: 'textarea.myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
      plugins: 'code table lists',
      toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
    });

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
    $('#addOption').on('click', function() {
      var length = $('.option').length + 1;
      var id = length;
      $('#option').append(`
      <div class="form-line option">
                        <label for="energy">Option ` + length + `</label>
                        <div class="row">
                          <div class="col-10">
                            <input type="text" data-id="` + id + `" name="option[]" class="form-control inputOption">
                          </div>
                          <div class="col-2">
                            <button class="btn btn-danger removeOption" type="button" >Remove</button>
                          </div>
                        </div>
                      </div>`)

      $('select[name="answer"]').append(`<option data-id="` + id + `" value="` + length + `">Option ` + length +
        `</option>`)
      $('.removeOption').on('click', function() {
        $(this).parent().parent().parent().remove();
        $('select[name="answer"]').empty();
        $('.option').each(function(index, value) {
          $(this).find('label').text('Option ' + (index + 1))
          $('select[name="answer"]').append(`<option  value="` + (index + 1) +
            `">Option ` + (index + 1) + `</option>`)
        })

      })
    })

    $('.removeOption').on('click', function() {
      $(this).parent().parent().parent().remove();
      $('select[name="answer"]').empty();
      $('.option').each(function(index, value) {
        $(this).find('label').text('Option ' + (index + 1))
        $('select[name="answer"]').append(`<option value="` + (index + 1) + `">Option ` + (
          index + 1) + `</option>`)
      })
    })
  </script>
@endpush
