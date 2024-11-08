<!-- START MODAL FORM -->
<div id="frm-modal" class="modal" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
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
                <div class="row">
                    <label for="description" class="col-sm-4 col-form-label">Deskripsi *</label>
                      <div class="col-sm-8">
                        <textarea lines="3" id="description" name="description" class="form-control form-control-sm" autocomplete="off" ></textarea>
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