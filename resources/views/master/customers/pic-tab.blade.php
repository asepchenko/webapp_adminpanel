<div class="row">
    <div class="col-md-12">
        <form method="post" enctype="multipart/form-data" id="frm-pic">
            @csrf
            <input type="hidden" name="id_pic" id="id_pic"/>
            <input type="hidden" name="action-pic" id="action-pic"/>
            <div class="row">
                <label for="pic_name" class="col-sm-2 col-form-label">Nama *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="pic_name" name="pic_name" autocomplete="off">
                </div>
                <label for="pic_email" class="col-sm-2 col-form-label">Email *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="pic_email" name="pic_email" autocomplete="off">
                </div>
            </div>
            <div class="row mt-2">
                <label for="pic_phone" class="col-sm-2 col-form-label">No Telp *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="pic_phone" name="pic_phone" autocomplete="off">
                </div>
                <label for="pic_birthdate" class="col-sm-2 col-form-label">Tgl Lahir *</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control datetimepicker-input" autocomplete="off" id="pic_birthdate">
                </div>
            </div>
            <div class="row mt-2">
                <label for="address_pic" class="col-sm-2 col-form-label">Alamat *</label>
                <div class="col-sm-4">
                    <textarea id="address_pic" name="address_pic" class="form-control form-control-sm" line="3" ></textarea>
                </div>
                <label for="is_active_pic" class="col-sm-2 col-form-label">Aktif ? *</label>
                <div class="col-sm-2">
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="form-control custom-control-input" id="is_active_pic">
                    <label class="custom-control-label" for="is_active_pic"></label>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <span class="float-md-right">
                    <button type="button" id="btn_save_pic" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_pic_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data..</i>
                    </button>
                </span>  
            </div>
        </form>
    </div> <!-- col -->

    <div class="col-md-12">
        <p><h5>List</h5></p>
        <div class="demo-table">
            <table id="table_pic" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-25p">Nama</th>
                        <th class="wd-10p">Email</th>
                        <th class="wd-10p">Telp</th>
                        <th class="wd-20p">Tgl lahir</th>
                        <th class="wd-25p">Alamat</th>
                        <th class="wd-5p">Aktif</th>
                        <th class="wd-5p">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div><!-- df-example -->
    </div> <!-- col -->
</div> <!-- row -->