
<!-- START MODAL FORM -->
<div id="frm-modal" class="modal" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 id="modal_title" class="modal-title"></h5>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
      		</div>
      		<div class="modal-body">
      			<form method="post" enctype="multipart/form-data" id="frm-add">
                @csrf
                <input type="hidden" name="id" id="id"/>
                <input type="hidden" name="action" id="action"/>
                <div class="row mt-2">
                    <label for="driver_name" class="col-sm-4 col-form-label">Nama Driver *</label>
                      <div class="col-sm-8">
                        <input type="text" id="driver_name" name="driver_name" class="form-control form-control-sm" autocomplete="off" required>
                      </div>
                </div>
                <div class="row mt-2">
                    <label for="driver_license" class="col-sm-4 col-form-label">No SIM *</label>
                      <div class="col-sm-8">
                        <input type="text" id="driver_license" name="driver_license" class="form-control form-control-sm" autocomplete="off" required>
                      </div>
                </div>
                <div class="row mt-2">
                  <label for="driver_license_type" class="col-sm-4 col-form-label">Jenis SIM *</label>
                  <div class="col-sm-8">
                      <select name="driver_license_type" id="driver_license_type" class="form-control form-control-sm" style="width: 100%;" required>
                          <option value="">- Pilih -</option>
						  <option value="A">A</option>
                          <option value="A UMUM">A UMUM</option>
                          <option value="B1">B1</option>
                          <option value="B1 UMUM">B1 UMUM</option>
                          <option value="B2">B2</option>
                          <option value="B2 UMUM">B2 UMUM</option>
                      </select>
                  </div>
                </div>
                <div class="row mt-2">
                  <label for="driver_license_exp_date" class="col-sm-4 col-form-label">Masa Berlaku SIM *</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control datetimepicker-input" autocomplete="off" id="driver_license_exp_date" name="driver_license_exp_date" required>
                  </div>
                </div>
                <div class="row mt-2">
                    <label for="account_number" class="col-sm-4 col-form-label">No Rekening *</label>
                      <div class="col-sm-8">
                        <input type="text" id="account_number" name="account_number" class="form-control form-control-sm" autocomplete="off" >
                      </div>
                </div>
                <div class="row mt-2">
                  <label for="bank_id" class="col-sm-4 col-form-label">Bank *</label>
                  <div class="col-sm-8">
                      <select name="bank_id" id="bank_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                          <option value="">- Pilih -</option>
                          @foreach($banks as $bank)
                          <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
              	<br />
              	<div class="modal-footer" align="center">
                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-arrow-left"></i> Batal</a>
              		<button type="submit" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                  <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                    style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data..</i></button>
              	</div>
      			</form>
      		</div>
    	</div>
    </div>
</div>
<!-- END MODAL FORM -->
