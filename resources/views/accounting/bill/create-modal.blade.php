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
                <div class="row mt-2">
                    <label for="bill_number_manual" class="col-sm-4 col-form-label">No Invoice Agent *</label>
                      <div class="col-sm-8">
                        <input type="text" id="bill_number_manual" name="bill_number_manual" class="form-control form-control-sm" autocomplete="off" required>
                      </div>
                </div>
                <div class="row mt-2">
                    <label for="bill_date" class="col-sm-4 col-form-label">Tgl Invoice *</label>
                      <div class="col-sm-8">
                        <input type="date" id="bill_date" name="bill_date" class="form-control form-control-sm" autocomplete="off" required>
                      </div>
                </div>
                <div class="row mt-2">
                    <label for="bill_receipt_date" class="col-sm-4 col-form-label">Tgl Terima Invoice *</label>
                      <div class="col-sm-8">
                        <input type="date" id="bill_receipt_date" name="bill_receipt_date" class="form-control form-control-sm" autocomplete="off" required>
                      </div>
                </div>
                <div class="row mt-2">
                  <label for="agent_id" class="col-sm-4 col-form-label">Agent *</label>
                  <div class="col-sm-8">
                      <select name="agent_id" id="agent_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                          <option value="">- Pilih -</option>
                          @foreach($agents as $agent)
                          <option value="{{$agent->id}}">{{$agent->agent_name}}</option>
                          @endforeach
                      </select>
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