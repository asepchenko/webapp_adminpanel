<div class="modal fade effect-scale" id="modalChangePass" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body pd-20 pd-sm-30">
            <button type="button" class="close pos-absolute t-15 r-20" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

            <h5 class="tx-18 tx-sm-20 mg-b-20">Ganti Password</h5>
            <!--<p class="tx-13 tx-color-03 mg-b-30">You can add more information than what you see here, such as address and birthday by clicking <span class="tx-color-02">Add More Fields</span> button below to bring up more options.</p>
                -->
            <div class="d-sm-flex">
              <!--<div class="mg-sm-r-30">
                <div class="pos-relative d-inline-block mg-b-20">
                  <div class="avatar avatar-xxl"><span class="avatar-initial rounded-circle bg-gray-700 tx-normal">A</span></div>
                  <a href="" class="contact-edit-photo"><i data-feather="edit-2"></i></a>
                </div>
              </div> -->
              <div class="flex-fill">
                <h6 class="mg-b-10">Isi dengan password yang tidak mudah ditebak</h6>
                <form method="POST" id="frm_cpass" action="{{ route('profile.changePassword') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id" value="{{ Session::get('user')->id }}">
                    <div class="form-group mg-b-10">
                        <label for="old_password" class="col-form-label">Password Lama *</label>
                        <input type="password" class="form-control" id="old_password" name="old_password">
                    </div><!-- form-group -->
                    <div class="form-group mg-b-10">
                        <label for="password" class="col-form-label">Password Baru *</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group mg-b-10">
                        <label for="password_confirmation" class="col-form-label">Konfirmasi Password Baru*</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div><!-- col -->
              </div>
            </div>
            <div class="modal-footer">
              <div class="wd-100p d-flex flex-column flex-sm-row justify-content-end">
                <button type="button" class="btn btn-secondary mg-sm-l-5" data-dismiss="modal">Batal</button>&nbsp;
                <button type="submit" class="btn btn-primary mg-b-5 mg-sm-b-0" id="frm_cpass_submit" >Simpan</button>
                <button type="button" class="btn btn-primary mg-b-5 mg-sm-b-0" id="frm_cpass_submit_wait" disabled
                style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Memproses Data...</i></button>
                
              </div>
            </div><!-- modal-footer -->
          </form>
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->