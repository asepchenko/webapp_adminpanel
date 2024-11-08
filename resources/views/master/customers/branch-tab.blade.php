<div class="row">
    <div class="col-md-12">
        <form method="post" enctype="multipart/form-data" id="frm-branch">
            @csrf
            <input type="hidden" name="id_branch" id="id_branch"/>
            <input type="hidden" name="action-branch" id="action-branch"/>
            <div class="row">
                <label for="customer_brand_id" class="col-sm-2 col-form-label">Brand *</label>
                <div class="col-sm-4">
                    <select name="customer_brand_id" id="customer_brand_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                        <option value="0">- Pilih -</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <label for="branch_code" class="col-sm-2 col-form-label">Kode Cabang *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="branch_code" name="branch_code" autocomplete="off">
                </div>
                <label for="branch_name" class="col-sm-2 col-form-label">Nama Cabang *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="branch_name" name="branch_code" autocomplete="off">
                </div>
            </div>
            <div class="row mt-2">
                <label for="city_branch_id" class="col-sm-2 col-form-label">Kota *</label>
                <div class="col-sm-4">
                    <select name="city_branch_id" id="city_branch_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->city_code}} - {{$city->city_name}}</option>
                        @endforeach
                    </select>
                </div>
                <label for="is_active_branch" class="col-sm-2 col-form-label">Aktif ? *</label>
                <div class="col-sm-2">
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="form-control custom-control-input" id="is_active_branch">
                    <label class="custom-control-label" for="is_active_branch"></label>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <label for="address_branch" class="col-sm-2 col-form-label">Alamat *</label>
                <div class="col-sm-4">
                    <textarea id="address_branch" name="address_branch" class="form-control form-control-sm" line="3" ></textarea>
                </div>
                <label for="description_branch" class="col-sm-2 col-form-label">Keterangan *</label>
                <div class="col-sm-4">
                    <textarea lines="3"name="description_branch" id="description_branch" class="form-control form-control-sm"></textarea>
                </div>
            </div>
            <div class="mt-2">
                <span class="float-md-right">
                    <button type="button" id="btn_save_branch" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_branch_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data..</i>
                    </button>
                </span>  
            </div>
        </form>
    </div> <!-- col -->

    <div class="col-md-12">
        <p><h5>List</h5></p>
        <div class="demo-table">
            <table id="table_branch" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-10p">Brand</th>
                        <th class="wd-10p">Kode</th>
                        <th class="wd-10p">Nama</th>
                        <th class="wd-10p">Kota</th>
                        <th class="wd-20p">Alamat</th>
                        <th class="wd-20p">Keterangan</th>
                        <th class="wd-10p">Aktif</th>
                        <!--<th class="wd-10p">Tgl Ubah</th>
                        <th class="wd-10p">Diubah Oleh</th>-->
                        <th class="wd-10p">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div><!-- df-example -->
    </div> <!-- col -->
</div> <!-- row -->