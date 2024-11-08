@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Driver</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manifest</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">List Manifest Saya</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">
        
        <div data-label="Example" class="df-example demo-table">
          <table id="table_data" class="table mg-b-0" width="100%">
            <thead>
                <tr>
                    <th class="wd-20p">No Manifest</th>
                    <th class="wd-10p">Tgl</th>
                    <th class="wd-15p">Total Colly</th>
                    <th class="wd-30p">STT</th>
                    <th class="wd-10p">Tujuan</th>
                    <th class="wd-10p">Status</th>
                    <th class="wd-5p">Aksi</th>
                </tr>
            </thead>
        </table>
        </div><!-- df-example -->
      </div><!-- row -->
     
      </div><!-- container -->
    </div><!-- content -->

@endsection
@section('scripts')
@parent
<script>
function editData(data){
  window.location.href = '{{ url("driver/manifest") }}'+'/'+data+'/detail';
}

$(function(){
  'use strict'

  $('#table_data').DataTable({
    language: {
      searchPlaceholder: 'Search...',
      sSearch: '',
      lengthMenu: '_MENU_ items/page',
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: '{{ url("driver/manifest/datatable") }}',
      type: 'GET',
    },
    columns: [
      { data: 'manifest_number', name: 'manifest_number' },
      { data: 'manifest_date', name: 'manifest_date' },
      { data: 'total_colly', name: 'total_colly' },
      {
        data: 'details',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var orders = "";
            data.forEach(function (item, index) {
              //orders += item.orders.awb_no + ',';
              orders += '<span class="badge badge-pill badge-primary"><b>'+item.orders.awb_no+'</b></span>&nbsp;';
            });
            return orders; //orders.slice(0, -1);
            //return '<a class="btn btn-sm btn-brand-02" href="#" onClick="detailData('+ data +');">Detail</a>';
          } else {
            return '';
          }
        }
      },
      { data: 'destinations.city_name', name: 'destinations.city_name' },
      { data: 'last_status', name: 'last_status' },
      {
        data: 'manifest_number',
        orderable: false,
        mRender: function (data, type, obj) {
          if (data !== "") {
            var button = '<div class="dropdown d-inline">';
            button += '<button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">PILIH</button>';
            button += '<div class="dropdown-menu">';
            button += '<a class="dropdown-item has-icon" href="#" onClick="editData(\''+ data +'\');"><i class="fa fa-edit"></i> Update Tracking</a>';
            button += '</div></div>';
            return button;
          } else {
            return '';
          }
        }
      },
      ]
     });

  // Select2
  $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
});
</script>
@endsection