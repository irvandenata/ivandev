@extends('layouts.admin')

@section('title', $title)
@section('breadcrumb', $breadcrumb)

@push('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('style')
  <style>
    #datatable_filter {
      margin-bottom: 10px !important;
    }
  </style>
@endpush

@section('content')
  <div class="row">
    <div class="col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
      <div class="card p-4">
        <div class="text-right">
          <div class="btn btn-success btn-sm mb-2" onclick="createItem()">Create Item</div>
          <div class="btn btn-outline-warning btn-sm mb-2" onclick="reloadDatatable()">Reload Data</div>
        </div>
        <div class="table-responsive">
          <table id="datatable" style="max-width:100% !important" class="table m-t-30">
            <thead>
              <tr>
                <th>No</th>
                @foreach ($rows['name'] as $item)
                  <th>{{ $item }}</th>
                @endforeach
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @include($view . '._form')
@endsection

@push('js')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('script')
  @include('utils.js')
  <script>
    $('.select-2').select2();
    let dataTable = $('#datatable').DataTable({
      dom: 'lBfrtip',
      responsive: true,
      processing: true,
      serverSide: true,
      searching: true,
      pageLength: 5,
      lengthMenu: [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      ajax: {
        url: child_url,
        type: 'GET',
      },
      columns: [{
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        @foreach ($rows['column'] as $item)
          {
            data: '{{ $item }}',
            orderable: true,
          },
        @endforeach {
          data: 'action',
          name: '#',
          orderable: false,
          searchable: false
        },
      ]
    });
  </script>

  <script>
    function createItem() {
      setForm('create', 'POST', ('Create {{ $title }}'), true)
      $('#preview>img').addClass('d-none');
      $('#preview>img').attr('src', '');
    }

    function editItem(id) {

      setForm('update', 'PUT', 'Edit {{ $title }}', true)
      editData(id)
    }

    function deleteItem(id) {
      deleteConfirm(id)

    }
  </script>

  <script>
    /** set data untuk edit**/
    function setData(result) {
      $('input[name=id]').val(result.id);
      $('input[name=name]').val(result.name);
    }


    /** reload dataTable Setelah mengubah data**/
    function reloadDatatable() {
      dataTable.ajax.reload();
    }

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
