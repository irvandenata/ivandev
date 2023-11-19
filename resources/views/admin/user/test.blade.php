@extends('layouts.admin')

@section('title', $title)
@section('breadcrumb', $breadcrumb)

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
              <div class="text-right">
                <div  class="btn btn-success btn-sm mb-2 phising" onclick="createItem()">Send Phising</div>
                <div class="btn btn-outline-warning btn-sm mb-2" onclick="reloadDatatable()">Reload Data</div>
              </div>
              <div class="table-responsive">
                <table id="datatable" style="max-width:100% !important" class="table m-t-30 table-striped">
                  <thead>
                    <tr>
                      <th >No</th>
                      @foreach ($rows['name'] as $item )
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
      </div>
    </div>
  </div>

  <div class="modal fade " id="modalForm" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered @yield('modal-size')" role="document">
        <div class="modal-content">
            <form  method="POST">
                @csrf
                @method('POST')
                <input id="id" type="hidden" name="id" value="">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalFormTitle">Modal title</h4>
                </div>
                <div class="modal-body">
                    @yield('input-form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-link waves-effect btn-primary" id='submit'>Simpan</button>
                    <button type="button" class="btn btn-link waves-effect btn-danger close-modal" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
 </div>


@include('admin.user._form')
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('script')
  @include('utils.js')
  <script>
        sessionStorage.setItem('location',null)
        sessionStorage.setItem('room',null)


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
                text: item.name,
                id: item.name,
              }
            })
          }
        }
      },
      placeholder: "--- Select an Option ---",
      allowClear: true
    });

    $('.select-location').select2({
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
                text: item.location,
                id: item.location,
              }
            })
          }
        }
      },
      placeholder: "--- Select an Option ---",
      allowClear: true
    });

    $('.select-2').select2();
    $('.select-location').on('change',function(){
        sessionStorage.setItem('location',$(this).val())
        reloadDatatable();
    })
    $('.select-room').on('change',function(){
        sessionStorage.setItem('room',$(this).val())
        reloadDatatable();
    })

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
        data: function(d){
         d.location = sessionStorage.getItem('location');
         d.room = sessionStorage.getItem('room');
            },
      },

      columns: [{
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false

        },
        @foreach($rows['column'] as $item)
        {
          data: '{{ $item }}',
          orderable: true,
        },
        @endforeach
        {
          data: 'action',
          name: '#',
          orderable: false,
          searchable: false
        },
      ]
    });
  </script>

  <script>
    function deleteItem(id) {
      deleteConfirm(id)
    }
  </script>

  <script>
    let limitOrder = 0;
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
