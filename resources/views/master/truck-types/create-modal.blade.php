
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
                    <label for="type_name" class="col-sm-4 col-form-label">Nama Tipe *</label>
                      <div class="col-sm-8">
                        <input type="text" id="type_name" name="type_name" class="form-control form-control-sm" autocomplete="off" >
                      </div>
                </div>
                <div class="row mt-2">
                    <label for="description" class="col-sm-4 col-form-label">Deskripsi</label>
                      <div class="col-sm-8">
                        <textarea lines="3" id="description" name="description" class="form-control form-control-sm" autocomplete="off" ></textarea>
                      </div>
                </div>
                <div class="row mt-2">
                    <label for="truck_length" class="col-sm-4 col-form-label">Panjang</label>
                      <div class="col-sm-8">
                        <input type="number" id="truck_length" name="truck_length" class="form-control form-control-sm" autocomplete="off" >
                      </div>
                </div>
                <div class="row mt-2">
                    <label for="truck_width" class="col-sm-4 col-form-label">Lebar</label>
                      <div class="col-sm-8">
                        <input type="number" id="truck_width" name="truck_width" class="form-control form-control-sm" autocomplete="off" >
                      </div>
                </div>
                <div class="row mt-2">
                    <label for="truck_height" class="col-sm-4 col-form-label">Tinggi</label>
                      <div class="col-sm-8">
                        <input type="number" id="truck_height" name="truck_height" class="form-control form-control-sm" autocomplete="off" >
                      </div>
                </div>
                <div class="row mt-2">
                    <label for="truck_volume" class="col-sm-4 col-form-label">Kubikasi</label>
                      <div class="col-sm-8">
                        <input type="number" id="truck_volume" name="truck_volume" class="form-control form-control-sm" autocomplete="off" >
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
