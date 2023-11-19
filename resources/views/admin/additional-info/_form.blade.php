@extends('utils.modal')
@section('modal-size', 'modal-lg')
@section('input-form')
  <div class="row">
    <div class="form-group mb-1 col-12">
      <label for="">Type Information</label>
      <select name="additional_type_id" class="form-control" required>
        <option value="">-- Select Type --</option>
        @foreach ($types as $item)
          <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group mb-1 col-12">
      <div class="form-line">
        <label for="name">Title</label>
        <input type="text" name="title" class="form-control" required>
      </div>
    </div>
    <div class="form-group mb-1 col-12">
      <div class="form-line">
        <label for="name">Sub Title</label>
        <input type="text" name="sub_title" class="form-control" required>
      </div>
    </div>
    <div class="form-group mb-1 col-12">
      <div class="form-line">
        <label for="name">Icon</label>
        <input type="text" name="icon" class="form-control" >
      </div>
    </div>
    <div class="form-group mb-1 col-12">
      <div class="form-line">
        <label for="name">Image</label>
        <input type="file" name="image" class="form-control" accept="image/png, image/gif, image/jpeg">
      </div>
    </div>
    <div class="form-group mb-1 col-12">
      <div class="form-line">
        <label for="name">Description</label>
        <textarea name="description" class="form-control " id="myeditorinstance" rows="5"></textarea>
      </div>
    </div>
    <div class="from-group col-6">
      {{-- make start date input --}}
      <div class="form-line">
        <label for="name">Start Date</label>
        <input type="date" name="start_date" class="form-control datepicker">
      </div>
     </div>
     <div class="from-group col-6">
      {{-- make start date input --}}
      <div class="form-line">
        <label for="name">End Date</label>
        <input type="date" name="end_date" class="form-control datepicker">
      </div>
     </div>
  </div>
@endsection
