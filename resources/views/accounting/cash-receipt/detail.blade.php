@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Akunting</a></li>
                <li class="breadcrumb-item"><a href="#">Kasbon</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Update Kasbon</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">
                    <div class="row">
                        <label for="tujuan" class="col-sm-2 col-form-label">Nama *</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-plaintext" value="Yudha">
                        </div>
                        <label for="tujuan" class="col-sm-2 col-form-label">Keterangan *</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-plaintext" value="uang akomodasi">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="customer" class="col-sm-2 col-form-label">Jumlah *</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-plaintext" value="500.000">
                        </div>
                        <label for="customer" class="col-sm-2 col-form-label">Tgl *</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Pilih Tanggal" id="datepicker3">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="customer" class="col-sm-2 col-form-label">Sisa *</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control form-control-plaintext" value="100.000">
                        </div>
                        <label for="asal" class="col-sm-2 col-form-label">Realisasi *</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control">
                        </div>
                    </div>
                    <p><h5>List Realisasi</h5></p>
                    <div data-label="Example" class="df-example demo-table mt-2">
                        <table id="table_data" class="table">
                            <thead>
                                <tr>
                                    <th class="wd-25p">Tgl</th>
                                    <th class="wd-25p">Nominal</th>
                                    <th class="wd-25p">Diubah Oleh</th>
                                    <th class="wd-25p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>31 Okt 2021</td>
                                    <td>200.000</td>
                                    <td>Admin</td>
                                    <td>
                                        <div class="dropdown d-inline">
                                        <button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item has-icon" href="#"><i class="fa fa-trash-alt"></i> Hapus</a>
                                        </div></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>15 Okt 2021</td>
                                    <td>200.000</td>
                                    <td>Admin</td>
                                    <td>
                                        <div class="dropdown d-inline">
                                        <button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item has-icon" href="#"><i class="fa fa-trash-alt"></i> Hapus</a>
                                        </div></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- df-example -->

            <div class="mt-4">
                <span class="float-md-right">
                    <a href="{{ url('accounting/cash-receipt') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Cancel</a>
                    <button type="submit" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Save</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                    style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Saving</i>
                    </button>
                </span>
            </div>
        </form>
    </div><!-- col -->
    </div><!-- row -->
      
      </div><!-- container -->
    </div><!-- content -->

@endsection
@section('scripts')
<script src="{{ asset('dashforge/lib/jqueryui/jquery-ui.min.js') }}"></script>
@parent
<script>
  /*
function calculateRow(row) {
    var price = +row.find('input[name^="price"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}
  */
$(function(){
  'use strict'
  $('#datepicker1').datepicker();
  $('#datepicker2').datepicker();
  $('#datepicker3').datepicker();
  var counter = 0;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="form-control" name="name' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="mail' + counter + '"/></td>';
        cols += '<td><input type="text" class="form-control" name="phone' + counter + '"/></td>';

        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Hapus"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });



    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });

  /*$("#frm-add").submit(function (e) {
    e.preventDefault();
    var action = $(this).attr('action');
    var datas = new FormData($("#frm-add")[0]);
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: action,
        data: datas,
        dataType: 'json',
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('#btn_save').hide();
            $('#btn_save_wait').show();
            //showPreloader();
        },
        complete: function () {
            $('#btn_save').show();
            $('#btn_save_wait').hide();
            //hidePreloader();
        },
        success: function (data) {
            $("#frm-modal").modal("hide");
            window.location.href = "{{ url('category') }}";
        },
        error: function (jqXHR, exception) {
            //var obj = JSON.parse(jqXHR.responseText);
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].<br>'+jqXHR.responseText);
            } else if (exception === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                alert('Time out error.');
            } else if (exception === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }
        }
    });
  });*/

});
</script>
@endsection