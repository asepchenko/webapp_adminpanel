
<!-- START MODAL FORM -->
<div id="frm-modal" class="modal" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 id="modal_title" class="modal-title">Buat Trip Baru</h5>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
      		</div>
      		<div class="modal-body">
      			<form method="post" enctype="multipart/form-data" id="frm-add">
                @csrf
                <div class="row mt-2">
                  <label for="operational_cost" class="col-sm-4 col-form-label">Biaya Operasional *</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm" id="operational_cost" required>
                  </div>
                </div>
                <div class="row mt-2">
                  <label for="multiplier_number" class="col-sm-4 col-form-label">Angka Pengali *</label>
                  <div class="col-sm-8">
                      <input type="text" id="multiplier_number" class="form-control form-control-sm" required>
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
