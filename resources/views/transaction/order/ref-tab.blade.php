<div class="row">
    <div class="col-md-6">
        <form method="post" enctype="multipart/form-data" id="frm-ref">
            @csrf
            <input type="hidden" name="id_ref" id="id_ref"/>
            <input type="hidden" name="action-ref" id="action-ref"/>
            <div class="row">
                <label for="reference_number" class="col-sm-4 col-form-label">No Referensi *</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm" id="reference_number" name="reference_number" autocomplete="off" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="colly_ref" class="col-sm-4 col-form-label">Colly</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control form-control-sm" id="colly_ref" name="colly_ref" autocomplete="off">
                </div>
            </div>
            <div class="row mt-2">
                <label for="description_ref" class="col-sm-4 col-form-label">Deskripsi</label>
                <div class="col-sm-8">
                    <textarea id="description_ref" name="description_ref" class="form-control form-control-sm" line="3" ></textarea>
                </div>
            </div>
            <div class="mt-2">
                <span class="float-md-right">
                    @if($order->last_status != "Delivered")
                    <button type="button" id="btn_save_ref" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_ref_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data..</i>
                    </button>
                    @endif
                </span>  
            </div>
        </form>
    </div> <!-- col -->

    <div class="col-md-6">
        <form method="post" enctype="multipart/form-data" id="frm-import-ref">
            @csrf
            <div class="row">
                <label for="file" class="col-sm-4 col-form-label">File Import *</label>
                <div class="col-sm-8">
                    <input type="file" id="file" name="file" accept=".xls,.xlsx,.csv">
                </div>
            </div>
            <div class="mt-2">
                <span class="float-md-right">
                    @if($order->last_status != "Delivered")
                    <a class="btn btn-sm btn-primary" href="{{ url('import/Import_Order_Reference.xls') }}">Download Sample File</a>
                    <button type="button" id="btn_import_ref" class="btn btn-sm btn-success btn-uppercase" ><i class="fas fa-save"></i> Upload</button>
                    <button type="button" class="btn btn-sm btn-success" id="btn_import_ref_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Mengupload Data..</i>
                    </button>
                    @endif
                </span>  
            </div>
        </form>
    </div> <!-- col -->

    <div class="col-md-12">
        <p><h5>List</h5></p>
        <div class="demo-table">
            <table id="table_ref" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-35p">No Referensi</th>
                        <th class="wd-10p">Colly</th>
                        <th class="wd-30p">Deskripsi</th>
                        <th class="wd-15p">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div><!-- df-example -->
    </div> <!-- col -->
</div> <!-- row -->