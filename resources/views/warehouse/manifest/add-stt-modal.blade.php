<!-- START MODAL FORM -->
<div id="frm-stt-modal" class="modal" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 id="modal_title" class="modal-title">Tambah STT</h5>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
      		</div>
      		<div class="modal-body">
      			<form method="post" enctype="multipart/form-data" id="frm-add-stt">
                @csrf
                <input type="hidden" name="manifest_number_add" id="manifest_number_add"/>
                <div class="row mt-2">
                  <label for="order_number" class="col-sm-4 col-form-label">No STT *</label>
                  <div class="col-sm-8">
                      <select name="order_number" id="order_number" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                          <option value="">- Pilih -</option>
                      </select>
                  </div>
                </div>
              	<br />
              	<div class="modal-footer" align="center">
                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-arrow-left"></i> Batal</a>
              		<button type="button" id="btn_add_stt" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                  <button type="button" class="btn btn-sm btn-brand-02" id="btn_add_stt_wait" disabled
                    style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data...</i></button>
              	</div>
      			</form>
      		</div>
    	</div>
    </div>
</div>
<!-- END MODAL FORM -->
