<div class="row">
    <div class="col-md-12">
        <form method="post" enctype="multipart/form-data" id="frm-trucking-price">
            @csrf
            <input type="hidden" name="id_trucking_price" id="id_trucking_price"/>
            <input type="hidden" name="action-trucking-price" id="action-trucking-price"/>
            <input type="hidden" name="trucking_price_code" id="trucking_price_code"/>
            <div class="row">
                <label for="trucking_origin" class="col-sm-2 col-form-label">Asal *</label>
                <div class="col-sm-4">
                    <select name="trucking_origin" id="trucking_origin" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->city_code}} - {{$city->city_name}}</option>
                        @endforeach
                    </select>
                </div>
                <label for="trucking_destination" class="col-sm-2 col-form-label">Tujuan *</label>
                <div class="col-sm-4">
                    <select name="trucking_destination" id="trucking_destination" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->city_code}} - {{$city->city_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <label for="trucking_price_value" class="col-sm-2 col-form-label">Harga Jual *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" name="trucking_price_value" id="trucking_price_value" required>
                </div>
                <label for="trucking_cogs_price" class="col-sm-2 col-form-label">Sales Botom</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" name="trucking_cogs_price" id="trucking_cogs_price" value="" readonly required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="truck_type" class="col-sm-2 col-form-label">Tipe Truck *</label>
                <div class="col-sm-4">
                <select name="truck_type" id="truck_type" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        @foreach($trucktypes as $type)
                        <option value="{{$type->id}}">{{$type->type_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-2">
                <span class="float-md-right">
                    <button type="button" id="btn_save_trucking_price" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_trucking_price_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data..</i>
                    </button>
                </span>  
            </div>
        </form>
    </div> <!-- col -->

    <div class="col-md-12">
        <p><h5>List</h5></p>
        <div class="demo-table">
            <table id="table_trucking_price" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-10p">Kode</th>
                        <th class="wd-10p">Asal</th>
                        <th class="wd-10p">Tujuan</th>
                        <th class="wd-10p">Tipe Truck</th>
                        <th class="wd-20p">Harga Jual</th>
                        <th class="wd-20p">Sales Bottom</th>
                        <th class="wd-10p">Status</th>
                        <th class="wd-10p">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div><!-- df-example -->
    </div> <!-- col -->
</div> <!-- row -->