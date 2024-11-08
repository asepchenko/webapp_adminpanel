@extends('layouts.app')
@section('content')

<div class="content content-fixed bd-b">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Marketing</a></li>
                <li class="breadcrumb-item"><a href="#">Artikel</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
              </ol>
            </nav>
            <h4 class="mg-b-0">Tambah Artikel</h4>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- content -->

    <div class="content">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="row">
        <div class="col-lg-12">
        <form method="post" action="{{ route('compro-post.store') }}" enctype="multipart/form-data" id="frm-add">
            @csrf
            <div class="row">
                <label for="title" class="col-sm-4 col-form-label">Title *</label>
                <div class="col-sm-8">
                  <input type="text" id="title" name="title" class="form-control form-control-sm" autocomplete="off" >
                </div>
            </div>
            <div class="row mt-2">
                <label for="slug" class="col-sm-4 col-form-label">Slug *</label>
                <div class="col-sm-8">
                  <input type="text" id="slug" name="slug" class="form-control form-control-sm" autocomplete="off" readonly>
                </div>
            </div>
            <div class="row mt-2">
                <label for="content" class="col-sm-4 col-form-label">Konten *</label>
                <div class="col-sm-8">
                    <textarea id="content" name="content" class="form-control form-control-sm" line="3" ></textarea>
                </div>
            </div>
            <div class="row mt-2">
                <label for="status" class="col-sm-4 col-form-label">Status *</label>
                <div class="col-sm-8">
                    <select name="status" id="status" class="form-control form-control-sm" style="width: 100%;" required>
                        <option value="DRAFT" selected >Draft</option>
                        <option value="PUBLISH">Publish</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <label for="image" class="col-sm-4 col-form-label">Gambar *</label>
                <div class="col-sm-8">
                    <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png" />
                </div>
            </div>
            <div class="row mt-2">
                <label for="image" class="col-sm-4 col-form-label">Preview</label>
                <div class="col-sm-8">
                    <img src="{{ asset('img/placehold.jpg') }}" id="preview-image" width="250" height="150">
                </div>
            </div>
            <div class="mt-4">
                <span class="float-md-right">
                    <a href="{{ url('marketing/compro-post') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Batal</a>
                    <button type="submit" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                    style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data...</i>
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
  function strtoSlug (str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();
  
    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to   = "aaaaeeeeiiiioooouuuunc------";
    for (var i=0, l=from.length; i<l; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return str;
  }
$(function(){
  'use strict'
  $(document).on('keyup', 'input[name=title]', function() {
    var self = $(this).val();
    var slug = strtoSlug(self);
    $("#slug").val(slug);
  });

  $('#image').change(function(){
    var file = this.files[0];
    if(file.type != "image/png" && file.type != "image/jpeg" && file.type != "image/jpg")
    {
        alert("Please choose png, jpeg or jpg files");
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
        console.log(data);
        window.location.href = "{{ url('marketing/compro-post') }}";
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