<div class="row">
    <div class="col-md-12">
        <form method="post" enctype="multipart/form-data" id="frm-brand">
            @csrf
            <input type="hidden" name="id_brand" id="id_brand"/>
            <input type="hidden" name="action-brand" id="action-brand"/>
            <div class="row">
                <label for="brand_code" class="col-sm-2 col-form-label">Kode Brand</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="brand_code" name="brand_code" autocomplete="off">
                </div>
                <label for="brand_name" class="col-sm-2 col-form-label">Nama Brand *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="brand_name" name="brand_name" autocomplete="off">
                </div>
            </div>
            <div class="mt-2">
                <span class="float-md-right">
                    <button type="button" id="btn_save_brand" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_brand_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data..</i>
                    </button>
                </span>  
            </div>
        </form>
    </div> <!-- col -->

    <div class="col-md-12">
        <p><h5>List</h5></p>
        <div class="demo-table">
            <table id="table_brand" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-30p">Kode</th>
                        <th class="wd-65p">Nama</th>
                        <th class="wd-5p">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div><!-- df-example -->
    </div> <!-- col -->
</div> <!-- row -->