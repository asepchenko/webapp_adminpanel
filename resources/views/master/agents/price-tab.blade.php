<div class="row">
    <div class="col-md-12">
        <form method="post" enctype="multipart/form-data" id="frm-price">
            @csrf
            <input type="hidden" name="id_price" id="id_price"/>
            <input type="hidden" name="action-price" id="action-price"/>
            <div class="row">
                <label for="price_code" class="col-sm-2 col-form-label">Kode *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="price_code" name="price_code" readonly>
                </div>
                <label for="location_price_id" class="col-sm-2 col-form-label">Lokasi *</label>
                <div class="col-sm-4">
                    <select name="location_price_id" id="location_price_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        @foreach($locations as $location)
                        <option value="{{$location->id}}">({{$location->origins->city_code}} {{$location->destinations->city_code}}) {{$location->origins->city_name}} - {{$location->destinations->city_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <label for="service_price_id" class="col-sm-2 col-form-label">Via *</label>
                <div class="col-sm-4">
                    <select name="service_price_id" id="service_price_id" class="form-control form-control-sm" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        @foreach($services as $service)
                        <option value="{{$service->id}}">{{$service->service_name}}</option>
                        @endforeach
                    </select>
                </div>
                <label for="price_value" class="col-sm-2 col-form-label">Harga *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" name="price_value" id="price_value">
                </div>
            </div>
            <!--<div class="row mt-2">
                <label for="administrative_cost" class="col-sm-2 col-form-label">Biaya Admin *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" name="administrative_cost" id="administrative_cost">
                </div>
                <label for="insurance_fee" class="col-sm-2 col-form-label">Asuransi *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" name="insurance_fee" id="insurance_fee">
                </div>
            </div>
            <div class="row mt-2">
                <label for="other_cost" class="col-sm-2 col-form-label">Biaya Lainnya *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" name="other_cost" id="other_cost">
                </div>
                <label for="margin" class="col-sm-2 col-form-label">Margin *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" name="margin" id="margin">
                </div>
            </div>-->
            <div class="mt-2">
                <span class="float-md-right">
                    <button type="button" id="btn_save_price" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_price_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data..</i>
                    </button>
                </span>  
            </div>
        </form>
    </div> <!-- col -->

    <div class="col-md-12">
        <p><h5>List</h5></p>
        <div class="demo-table">
            <table id="table_price" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-15p">Kode</th>
                        <th class="wd-40p">Lokasi</th>
                        <th class="wd-15p">Via</th>
                        <th class="wd-15p">Harga</th>
                        <!--<th class="wd-10p">Biaya Admin</th>
                        <th class="wd-10p">Asuransi</th>
                        <th class="wd-10p">Biaya Lainnya</th>
                        <th class="wd-5p">Margin</th>
                        <th class="wd-10p">Tgl Ubah</th>
                        <th class="wd-10p">Diubah Oleh</th>-->
                        <th class="wd-5p">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div><!-- df-example -->
    </div> <!-- col -->
</div> <!-- row -->