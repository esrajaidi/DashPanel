
<!doctype html>
<html dir="rtl" class="js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <!-- CSRF Token -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>طباعة</title>
        <!-- Main Styles -->
        <link href="{{ asset('assets/styles/style.min.css') }}" rel="stylesheet">
        <!-- RTL -->
        <link href="{{ asset('assets/styles/style-rtl.min.css') }}" rel="stylesheet">

        <link href="{{ asset('assets/styles/style.min.css') }}" rel="stylesheet" media="print">
        <!-- RTL -->
        <link href="{{ asset('assets/styles/style-rtl.min.css') }}" rel="stylesheet" media="print">

        <style>

 p{
     text-align: justify;
 }
  h4{
      font-size: 20px;
  }
     .kyc-title{
        font-size: 20px
  }
  .kyc-title-en{
    font-size: 20px
  }
  body, .form-control {
  font-size: 20px;
}

    .row {
  margin-right: -15px;
  margin-left: -15px;
}
    .box-content.card .box-title {
  margin-bottom: 0px;
  padding: 5px 5px 5px 5px;
  color: #ffffff !important;
  background-color: #3ba5e3 !important;
  font-size: 12px;
  line-height: 18px;

}
.color-row{

background-color: #3ba5e32b !important;
}
.form-group {
  margin-bottom: 0px;
}
ul {
  margin-bottom: 10px;
}
.form-control[disabled]{
    background-color: white !important;
    height: 25px;
}
.disbborder{
    border: 1px solid #0067a6;

}
.other{
    border-left: none;
    border-left-color: currentcolor;
  border-right: none;
    border-right-color: currentcolor;
  border-top: none;
    border-top-color: currentcolor;
  border-bottom-style: dashed;
  border-color: black;
}
.checkbox, .radio {
  margin-top: 0px;
  margin-bottom: 0px;

}
.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
  position: relative;
  min-height: 1px;
  padding-right: 10px;
  padding-left: 10px;
}
.box-content{
    margin: 0px
}
.table > thead:first-child > tr:first-child > th{

text-align: center
}

.checkbox + .checkbox, .radio + .radio {
  margin-top: 0;
}

.box-content.card .card-content {
    padding-bottom: 10px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 15px;
}
.table-bordered,
.table-bordered > tbody > tr > td,
.table-bordered > tbody > tr > th,
 .table-bordered > tfoot > tr > td,
 .table-bordered > tfoot > tr > th,
 .table-bordered > thead > tr > td,
 .table-bordered > thead > tr > th {
    border: 1px solid #0067a6;
    border-top-width: 1px;
    border-top-style: solid;
    border-top-color: rgb(0, 103, 166);
    border-bottom-width: 1px;
  border-top-width: 1px;
  border-top-style: solid;
  border-top-color: #0067a6;
  border-bottom-width: 1px;
}

.image_up{


    height: 150px;
}
.font_14{
    font-size: 12px;
}
.table{
    margin-bottom: 5px
}

.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
  padding: 4px;
}
@media print{
   @page {
    size: A4;
  }
  p{
     text-align: justify;
 }
    h4{
      font-size: 12px;
  }
    .image_up{
        height: 100px;
        margin-bottom: 5px;
    }
        .kyc-title{
        font-size: 14x
  }
  .kyc-title-en{
    font-size: 14px
  }

  body, .form-control {

  font-size: 10px;
}
    .row {
  margin-right: -15px;
  margin-left: -15px;
}
    .box-content.card .box-title {
  margin-bottom: 0px;
  padding: 5px 5px 5px 5px;
  color: #ffffff !important;
  background-color: #3ba5e3 !important;
  font-size: 12px;
  line-height: 18px;

}
.color-row{

background-color: #3ba5e32b !important;
}
.form-group {
  margin-bottom: 0px;
}
ul {
  margin-bottom: 10px;
}
.form-control[disabled]{
    background-color: white !important;
    height:  25px;
}
.disbborder{
    border: 1px solid #0067a6;

}
.other{
    border-left: none;
    border-left-color: currentcolor;
  border-right: none;
    border-right-color: currentcolor;
  border-top: none;
    border-top-color: currentcolor;
  border-bottom-style: dashed;
  border-color: black;
}
.checkbox, .radio {
  margin-top: 0px;
  margin-bottom: 0px;

}
.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
  position: relative;
  min-height: 1px;
  padding-right: 10px;
  padding-left: 10px;
}
.box-content{
    margin: 0px
}
.table > thead:first-child > tr:first-child > th{

text-align: center
}

.checkbox + .checkbox, .radio + .radio {
  margin-top: 0;
}

.box-content.card .card-content {

     padding-bottom: 10px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 15px;
}
.table-bordered,
.table-bordered > tbody > tr > td,
.table-bordered > tbody > tr > th,
 .table-bordered > tfoot > tr > td,
 .table-bordered > tfoot > tr > th,
 .table-bordered > thead > tr > td,
 .table-bordered > thead > tr > th {
    border: 1px solid #0067a6;
    border-top-width: 1px;
    border-top-style: solid;
    border-top-color: rgb(0, 103, 166);
    border-bottom-width: 1px;
  border-top-width: 1px;
  border-top-style: solid;
  border-top-color: #0067a6;
  border-bottom-width: 1px;
}
.font_14{
    font-size: 12px;
}

.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
  padding: 4px;
}
.table td, .table th {
        font-size: 10px;
    }
    .other_account td ,.other_account th{
         font-size: 8px;
    }
}
        </style>
    </head>
    <script>
window.onafterprint = function(event) {
    window.location.href = "{{URL::to('/local_block_lists')}}"
};
    </script>
<body >
<div class="col-xs-12" >
        <div class="box-content" >
            <table style="width: 100%">
                <tr>
                    <td>
                        <h4 class="kyc-title"><b> </b> ونمودج</h4>
                        <hr style="margin: 0px;  border-top-color: #e1b531;">
                        <h4 class="kyc-title-en">Title</h4>

                    </td>
                    <td>
                        <img  class="pull-left image_up" src="{{asset('/assets/images/logo.png')}}" alt="">

                    </td>
                </tr>

            </table>

            <div class="card-content">
              <div class="row">
                                  <div class="col-xs-12">
                                    <table>
                                      <tr>
                                        <td> الاسم </td>
                                        <td> {{$name}} </td>

                                      </tr>
                                      <tr>
                                        <td> World-Check Total Matches </td>
                                        <td> {{$matches}} </td>

                                      </tr>

                                      <tr>
                                        <td>Last Screened </td>
                                        <td> {{$date}}</td>

                                      </tr>
                                      <tr>
                                        <td>Case Created </td>
                                        <td> {{$date}}</td>

                                      </tr>

                                    </table>
                                  </div>
              </div>
            </div>


        </div>
</div>




        </body>

    </html>
