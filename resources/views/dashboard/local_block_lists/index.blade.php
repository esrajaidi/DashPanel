
@extends('layouts.dashboard_app')
@section('title', 'قوائم الحظر المحلية ')
@section('content')
<div class="row small-spacing">
    <div class="col-xs-12">
      <div class="box-content">
        <h3 ><i class="ico fa fa-comment-o"></i> @yield('title')</h3>
        <br>

        @can('local_block_lists_uplode')

        <a class="btn btn-success" href="{{ route('local_block_lists/uplode') }}">تحميل ملف  قوائم الحظر المحلية</a>

       @endcan  
     
       @can('local_block_lists_create')

        <a class="btn btn-success" href="{{ route('local_block_lists/create') }}">اضافة شركة لقوائم الحظر المحلية</a>

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
                    <label>تاريخ الواردة </label>
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
          </div>
          </div>

        </div>
  <div class="table-responsive">
    <table class="table table-striped" style="width: 100%" id="local_block_lists_tbl">
      <thead>
         <tr>
           <th></th>
          <th>ر.ت</th>
          <th>البيان</th>
          <th>الجهة التي أصدرت التجميد</th>

          <th> تاريخ الرسالة الواردة</th>
          <th>الرقم الاشاري</th>
          <th>الملاحظات</th>
          <th></th>

         </tr>
      </thead> 
      <tbody>
      
      </tbody>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  
      <script type="text/javascript">



$(document).ready(function(){
  fill_datatable();
      

          //   $("#statement").keyup(function(){
          //     table.draw();
          // });

          // $("#index").keyup(function(){
          //     table.draw();
          // });
          function fill_datatable(statement='',index='',dateofreceivedMessage='')
          {
            var table = $('#local_block_lists_tbl').DataTable({
            processing: true,
            serverSide: true,
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
                  {data: 'rt', name: 'rt'},
                  {data: 'statement', name: 'statement'},
                  {data: 'hiddenBy', name: 'hiddenBy'},
                  {data: 'dateofreceivedMessage', name: 'dateofreceivedMessage'},
                  {data: 'index', name: 'index'},
                  {data: 'notes', name: 'notes'},
                  {data: 'statu', name: 'statu'},
                  // {data: 'file_name', name: 'file_name'},

                  
                  
                  
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


         $('#filter').click(function(){
        var statement = $('#statement').val();
        var index = $('#index').val();
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



