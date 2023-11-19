@extends('utils.modal')
@section('modal-size', 'modal-lg')
@section('input-form')
  <div class="row">
    <div class="form-group mb-1 col-12">
      <div class="form-line">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>
    </div>
    <div class="form-group mb-1 col-12">
        <div class="form-line">
          <label for="name">Question Per Test</label>
          <input type="number" name="amount_question" class="form-control" required>
        </div>
      </div>
      <div class="form-group mb-1 col-12">
        <div class="form-line">
          <label for="name">Duration (Second)</label>
          <input type="number" name="duration" class="form-control" min="0" required>
        </div>
      </div>

    <div class="form-group mb-1 col-12">
      <div class="form-line">
        <label for="name">Description</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
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
        <label for="name">Note</label>
        <textarea name="note" class="form-control " id="myeditorinstance" rows="5"></textarea>
      </div>
    </div>
  </div>
@endsection
