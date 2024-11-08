<div class="row">
    <div class="col-md-12">
        <div class="alert alert-primary mg-b-0" role="alert">
            <b>Rute</b>
            <p>{{ $order->origins->city_name }} ke {{ $order->destinations->city_name }}</p>
        </div>
        <br>
        <!--<div class="alert alert-primary mg-b-0" role="alert">
            <b>Tips</b>
            <ul>
                <li>Centang pilihan <i>retur</i> untuk mendapatkan list agent berdasarkan kota asal</li>
                <li>Pilih kota untuk mendapatkan list agent berdasarkan kota alamat agent</li>
                <li>Pilih by area untuk mendapatkan list agent berdasarkan kota tujuan</li>
            </ul>
        </div>
        <br>
        <divx>
            <div id="divAgentInfo" class="alert alert-warning mg-b-0" role="alert">
            <p id="agentInfo"></p>
            </div>
        </divx>
        <br>-->
        <form method="post" enctype="multipart/form-data" id="frm-ref">
            @csrf
            <input type="hidden" name="id_agent" id="id_agent"/>
            <input type="hidden" name="action-agent" id="action-agent"/>
            <!--<div class="row">
                <label for="retur" class="col-sm-4 col-form-label">Retur ?</label>
                <div class="col-sm-8">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-control custom-control-input" id="retur" name="retur">
                        <label class="custom-control-label" for="retur"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <label for="by_area" class="col-sm-4 col-form-label">By Area</label>
                <div class="col-sm-8">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-control custom-control-input" id="by_area" name="by_area">
                        <label class="custom-control-label" for="by_area"></label>
                    </div>
                </div>
            </div>-->
            <div class="row mt-2">
                <label for="city_agent" class="col-sm-4 col-form-label">Kota</label>
                <div class="col-sm-8">
                    <select name="city_agent" id="city_agent" class="form-control form-control-sm select2bs4" style="width: 100%;">
                        <option value="">- Pilih -</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->city_code}} - {{$city->city_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <label for="order_agent" class="col-sm-4 col-form-label">Nama Agent/Cabang LKE *</label>
                <div class="col-sm-8">
                    <select name="order_agent" id="order_agent" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <label for="sequence" class="col-sm-4 col-form-label">Urutan *</label>
                <div class="col-sm-8">
                    <input type="number" min="1" max-length="4" class="form-control form-control-sm" id="sequence" name="sequence" autocomplete="off" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="origin_agent" class="col-sm-4 col-form-label">Rute</label>
                <div class="col-sm-3">
                    <select name="origin_agent" id="origin_agent" class="form-control form-control-sm select2bs4" style="width: 100%;" readonly>
                        <option value="">- Pilih -</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->city_code}} - {{$city->city_name}}</option>
                        @endforeach
                    </select>
                </div>
                <label for="destination_agent" class="col-sm-2 col-form-label">Ke</label>
                <div class="col-sm-3">
                    <select name="destination_agent" id="destination_agent" class="form-control form-control-sm select2bs4" style="width: 100%;">
                        <option value="">- Pilih -</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->city_code}} - {{$city->city_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--<div class="row mt-2">
                <label for="description_agent" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-4">
                    <textarea id="description_agent" name="description_agent" class="form-control form-control-sm" line="3" ></textarea>
                </div>
            </div>-->
            <div class="mt-2">
                <span class="float-md-right">
                    @if($order->last_status == "Open")
                    <button type="button" id="btn_save_agent" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_agent_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data..</i>
                    </button>
                    @endif
                </span>  
            </div>
        </form>
    </div> <!-- col -->

    <div class="col-md-12">
        <p><h5>List</h5></p>
        <div class="demo-table">
            <table id="table_agent" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-20p">Kode Agent</th>
                        <th class="wd-20p">Nama Agent</th>
                        <th class="wd-40p">Rute</th>
                        <th class="wd-10p">Urutan</th>
                        <th class="wd-10p">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div><!-- df-example -->
    </div> <!-- col -->
</div> <!-- row -->