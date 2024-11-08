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
                <div class="row">
                    <label for="branch_code" class="col-sm-4 col-form-label">Kode Cabang *</label>
                      <div class="col-sm-8">
                        <input type="text" id="branch_code" name="branch_code" class="form-control form-control-sm" autocomplete="off" required>
                      </div>
                </div>
                <div class="row mt-2">
                    <label for="branch_name" class="col-sm-4 col-form-label">Nama Cabang *</label>
                      <div class="col-sm-8">
                        <input type="text" id="branch_name" name="branch_name" class="form-control form-control-sm" autocomplete="off" required>
                      </div>
                </div>
                <div class="row mt-2">
                  <label for="city_id" class="col-sm-4 col-form-label">Kota *</label>
                  <div class="col-sm-8">
                      <select name="city_id" id="city_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                          <option value="">- Pilih -</option>
                          @foreach($cities as $city)
                          <option value="{{$city->id}}">{{$city->city_code}} - {{$city->city_name}}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
                <div class="row mt-2">
                    <label for="address" class="col-sm-4 col-form-label">Alamat *</label>
                      <div class="col-sm-8">
                        <textarea lines="3" id="address" name="address" class="form-control form-control-sm" autocomplete="off" required></textarea>
                      </div>
                </div>
                <div class="row mt-2">
                    <label for="phone" class="col-sm-4 col-form-label">Telp *</label>
                      <div class="col-sm-8">
                        <input type="text" id="phone" name="phone" class="form-control form-control-sm" autocomplete="off" required>
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
