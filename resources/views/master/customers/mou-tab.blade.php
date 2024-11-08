<div class="row">
    <div class="col-md-12">
        <form method="post" enctype="multipart/form-data" id="frm-mou">
            @csrf
            <input type="hidden" name="id_mou" id="id_mou"/>
            <input type="hidden" name="action-mou" id="action-mou"/>
            <div class="row">
                <label for="filename" class="col-sm-2 col-form-label">File</label>
                <div class="col-sm-10">
                    <input type="text" id="filename" name="filename" class="form-control form-control-sm" readonly disabled>
                </div>
            </div>
            <div class="row mt-2">
                <label for="mou_file" class="col-sm-2 col-form-label">Upload File *</label>
                <div class="col-sm-4">
                    <input type="file" id="mou_file" name="mou_file" accept=".doc,.docx,.pdf">
                </div>
                <label for="is_generate_mou" class="col-sm-2 col-form-label">Generate By Sistem *</label>
                <div class="col-sm-2">
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="form-control custom-control-input" id="is_generate_mou">
                    <label class="custom-control-label" for="is_generate_mou"></label>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <label for="mou_start_date" class="col-sm-2 col-form-label">Tgl Efektif MoU</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control datetimepicker-input" autocomplete="off" id="mou_start_date" name="mou_start_date" >
                </div>
                <label for="mou_end_date" class="col-sm-2 col-form-label">Tgl Berakhir MoU</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control datetimepicker-input" autocomplete="off" id="mou_end_date" name="mou_end_date">
                </div>
            </div>
            <div class="mt-2">
                <span class="float-md-right">
                    <button type="button" id="btn_save_mou" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_mou_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data..</i>
                    </button>
                </span>  
            </div>
        </form>
    </div> <!-- col -->

    <div class="col-md-12">
        <p><h5>List</h5></p>
        <div class="demo-table">
            <table id="table_mou" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-35p">Nama File</th>
                        <th class="wd-10p">File</th>
                        <th class="wd-10p">Nomor</th>
                        <th class="wd-20p">Tgl Efektif</th>
                        <th class="wd-20p">Tgl Berakhir</th>
                        <th class="wd-5p">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div><!-- df-example -->
    </div> <!-- col -->
</div> <!-- row -->