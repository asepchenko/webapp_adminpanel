@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Marketing</a></li>
                <li class="breadcrumb-item"><a href="#">Banner Utama</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Tambah Banner Utama</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">
        <form method="post" action="#" enctype="multipart/form-data" id="frm-add">
            @csrf
            <div class="row">
              <label for="sequence" class="col-sm-4 col-form-label">Urutan *</label>
					    <div class="col-sm-8">
						    <input type="number" min="1" max="99" class="form-control form-control-sm" id="sequence" name="sequence" required>
              </div>
            </div>
            <div class="row mt-2">
              <label for="title" class="col-sm-4 col-form-label">Judul *</label>
					    <div class="col-sm-8">
						    <input type="text" class="form-control form-control-sm" id="title" name="title" required>
              </div>
            </div>
            <div class="row mt-2">
              <label for="subtitle" class="col-sm-4 col-form-label">Sub-Judul *</label>
					    <div class="col-sm-8">
						    <textarea lines="4" class="form-control form-control-sm" id="subtitle" name="subtitle" required></textarea>
              </div>
            </div>
				    <div class="row mt-2">
              <label for="image" class="col-sm-4 col-form-label">Image *</label>
              <div class="col-sm-8">
                <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png" />
                <hr>
                <div id="preview">
                  <img src="{{ asset('img/placehold.jpg') }}" id="preview-image" width="300" height="200">
                </div>
              </div>
            </div>
            <div class="mt-4">
                <span class="float-md-right">
                    <a href="{{ url('marketing/compro-main-banner') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Cancel</a>
                    <button type="submit" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                    style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data...</i></button>
                </span>
            </div>
        </form>
    </div><!-- col -->
    </div><!-- row -->
      
      </div><!-- container -->
    </div><!-- content -->

@endsection
@section('scripts')
@parent
<script>
 
$(function(){
  'use strict'

  $('#image').change(function(){
    var file = this.files[0];
    if(file.type != "image/png" && file.type != "image/jpeg" && file.type != "image/gif")
    {
        alert("Please choose png, jpeg or gif files");
        return false;
    }
    var reader = new FileReader();
    reader.onload = function(e) {
        $('#preview-image').attr('src', e.target.result);
    }
    reader.readAsDataURL(file);
  });

  $("#frm-add").submit(function (e) {
    e.preventDefault();
    var action = "{{ route('compro-main-banner.store') }}";
    
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
        console.log(data);
        window.location.href = "{{ url('marketing/compro-main-banner') }}";
      },
      error: function (jqXHR, exception) {
        console.log(jqXHR);
        console.log(exception);
        alertError(jqXHR.status, exception, jqXHR.responseText);
      }
    });
  });

});
</script>
@endsection