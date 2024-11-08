
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
                    <label for="police_number" class="col-sm-4 col-form-label">No Polisi *</label>
                      <div class="col-sm-8">
                        <input type="text" id="police_number" name="police_number" class="form-control form-control-sm" autocomplete="off" >
                      </div>
                </div>
                <div class="row mt-2">
                  <label for="truck_type_id" class="col-sm-4 col-form-label">Jenis Armada *</label>
                  <div class="col-sm-8">
                      <select name="truck_type_id" id="truck_type_id" class="form-control form-control-sm select2bs4" style="width: 100%;" " required>
                          <option value="">- Pilih -</option>
                          @foreach($trucktypes as $trucktype)
                          <option value="{{$trucktype->id}}">{{$trucktype->type_name}}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
                <div class="row mt-2">
                    <label for="production_year" class="col-sm-4 col-form-label">Tahun Produksi *</label>
                      <div class="col-sm-8">
                        <input type="text" maxlength="4" id="production_year" name="production_year" class="form-control form-control-sm" autocomplete="off" >
                      </div>
                </div>
                <div class="row mt-2">
                  <label for="reg_exp_date" class="col-sm-4 col-form-label">Masa Berlaku STNK *</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control datetimepicker-input" autocomplete="off" id="reg_exp_date" name="reg_exp_date" required>
                  </div>
                </div>
                <div class="row mt-2">
                  <label for="reg_tax_exp_date" class="col-sm-4 col-form-label">Masa Berlaku Pajak *</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control datetimepicker-input" autocomplete="off" id="reg_tax_exp_date" name="reg_tax_exp_date" required>
                  </div>
                </div>
                <div class="row mt-2">
                  <label for="examination_exp_date" class="col-sm-4 col-form-label">Masa Berlaku KIR *</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control datetimepicker-input" autocomplete="off" id="examination_exp_date" name="examination_exp_date" required>
                  </div>
                </div>
              	<br />
              	<div class="modal-footer" align="center">
                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-arrow-left"></i> Batal</a>
              		<button type="submit" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                  <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                    style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data...</i></button>
              	</div>
      			</form>
      		</div>
    	</div>
    </div>
</div>
<!-- END MODAL FORM -->
