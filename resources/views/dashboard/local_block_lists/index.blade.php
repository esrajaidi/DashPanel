
@extends('layouts.dashboard_app')
@section('title', 'قوائم الحظر المحلية ')
@section('content')
<div class="row small-spacing">
    <div class="col-xs-12">
      <div class="box-content">
        <h3 ><i class="ico fa fa-list-ul"></i> @yield('title')</h3>
        <br>

        @can('local_block_lists-uplode')

        <a class="btn btn-success" href="{{ route('local_block_lists/uplode') }}">تحميل ملف  قوائم الحظر المحلية</a>

       @endcan

       @can('local_block_lists-create')

        <a class="btn btn-success" href="{{ route('local_block_lists/create') }}">اضافة شركة لقوائم الحظر المحلية</a>

       @endcan
       @can('local_block_lists-export')

       <a class="btn btn-success" href="{{ route('local_block_lists/export') }}">تصدير  قوائم الحظر المحلية</a>

      @endcan

        <br>
        <br>
        @can('local_block_lists')
        <div class="row">
          <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>البيان</label>
                    <input type="text" name="statement" id="statement" class="form-control" placeholder="بحث من خلال البيان فقط">

                </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                  <label>الرقم الاشاري</label>
                  <input type="text" name="index" id="index" class="form-control" placeholder="بحث من خلال الرقم الاشاري فقط">

              </div>
            </div>
              <div class="col-md-3">
                <div class="form-group">
                    <label>تاريخ  الرسالة الواردة </label>
                    <input type="date" name="dateofreceivedMessage" id="dateofreceivedMessage" class="form-control">

                </div>
              </div>
              <div>
              </div>

          </div>
          <div class="row">
            <div class="form-group" align="center">
              <button type="button" name="filter" id="filter" class="btn btn-info">بحث</button>

              <button type="button" name="reset" id="reset" class="btn btn-default">تحديث</button>


              <button type="button" name="print" id="print" style="display: none" class="btn btn-warning">طباعة</button>

          </div>
          </div>

        </div>
  <div class="table-responsive">
    <table class="table table-striped" style="width: 100%" id="local_block_lists_tbl">
      <thead>
         <tr>
          <th>ر.ت</th>
          <th>البيان</th>
          <th>الجهة التي أصدرت التجميد</th>
          <th> تاريخ الرسالة الواردة</th>
          <th>الرقم الاشاري</th>
          <th>الملاحظات</th>
          <th></th>
          <th></th>
         </tr>
      </thead>
      <tbody>

      </tbody>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
      <script type="text/javascript">



$(document).ready(function(){
  fill_datatable();
          function fill_datatable(statement='',index='',dateofreceivedMessage='')
          {
            var table = $('#local_block_lists_tbl').DataTable({
            processing: true,
            serverSide: true,
            searching: true,

            ajax: {
              url: "{{ route('local_block_lists') }}",
              data:{statement:statement,
                 index:index,
                 dateofreceivedMessage:dateofreceivedMessage
              }

            },

              columns: [
                   {
                      "data": "id",
                      render: function (data, type, row, meta) {

                          return meta.row + meta.settings._iDisplayStart + 1;
                      }
                  },
                  {data: 'statement', name: 'statement'},
                  {data: 'hiddenBy', name: 'hiddenBy'},
                  {data: 'dateofreceivedMessage', name: 'dateofreceivedMessage'},
                  {data: 'index', name: 'index'},
                  {data: 'notes', name: 'notes'},
                  {data: 'statu', name: 'statu'},
                  {data: 'edit', name: 'edit'},




              ]
          });
          }

        $('#reset').click(function(){
        $('#statement').val('');
        $('#index').val('');
        $('#dateofreceivedMessage').val('');
        $('#local_block_lists_tbl').DataTable().destroy();
        fill_datatable();
         });


         $('#print').click(function(){

            var tdcount=$('#local_block_lists_tbl tbody tr td').length;
            var statement = $('#statement').val();
            var tbl=$('#local_block_lists_tbl').DataTable();
            var totalRecords =$("#local_block_lists_tbl").DataTable().page.info().recordsDisplay;
            var array=[statement,totalRecords];
            info = array.toString();
            var url = '{{ url("local_block_lists/print", "paramters") }}';
            url = url.replace('paramters', info);


            window.location.href =  url;
         });



         $('#filter').click(function(){
        var statement = $('#statement').val();
        var index = $('#index').val();


          $("#print").css("display", "inline-block");


        var dateofreceivedMessage = $('#dateofreceivedMessage').val();
            $('#local_block_lists_tbl').DataTable().destroy();
            fill_datatable(statement, index,dateofreceivedMessage);


    });
        });


      </script>
    </table>

  </div>


  @endcan
      </div>
  </div>



@endsection



