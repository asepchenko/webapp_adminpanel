<!-- Modal Delete -->
<div class="modal fade" id="modal_ref_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content tx-14">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel">Konfirmasi</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <form method="POST" id="frm_ref_del" action="{{ route('order-references.delete') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="hdn_del_ref_id">
                    <p>Anda yakin ingin menghapus data referensi ini?</p>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-brand-02 tx-13" id="frm_del_ref_submit">Hapus</button>
            <button type="button" class="btn btn-brand-02 tx-13" id="frm_del_ref_submit_wait" disabled
              style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menghapus Data...</i></button>
          </div>
          </form>
        </div>
      </div>
    </div>