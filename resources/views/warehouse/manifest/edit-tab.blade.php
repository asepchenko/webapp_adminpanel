<div class="row">
            <div class="col-lg-12">
                <form method="post" action="#" enctype="multipart/form-data" id="frm-edit">
                    @csrf
                    <input type="hidden" id="manifest_id" value="{{ $manifest->id }}">
                    <input type="hidden" id="manifest_number" value="{{ $manifest->manifest_number }}">
                    <div class="row">
                        <label for="manifest_date" class="col-sm-2 col-form-label">Tgl Manifest</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control form-control-sm datetimepicker-input" id="manifest_date" name="manifest_date" value="{{ $manifest->manifest_date }}" required>
                        </div>
                        <label for="destination" class="col-sm-2 col-form-label">Tujuan</label>
                        <div class="col-sm-4">
                            <select name="destination" id="destination" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                            <option value="">- Pilih -</option>
                                @foreach($cities as $city)
                                <option value="{{$city->id}}" {{ ( $city->id == $manifest->destinations->id) ? 'selected' : '' }}>{{$city->city_code}} - {{$city->city_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="total_colly" class="col-sm-2 col-form-label">Total Colly</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" id="total_colly" value="{{ $manifest->total_colly }}" readonly>
                        </div>
                        <label for="total_order" class="col-sm-2 col-form-label">Total STT</label>
                        <div class="col-sm-2">
                            <input type="text" id="total_order" asal="total_order" class="form-control form-control-sm" value="{{ $manifest->total_order }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="driver_id" class="col-sm-2 col-form-label">Driver *</label>
                        <div class="col-sm-2">
                            <select name="driver_id" id="driver_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                            <option value="">- Pilih -</option>
                                @foreach($drivers as $driver)
                                <option value="{{$driver->id}}" {{ ( $driver->id == $manifest->drivers->id) ? 'selected' : '' }}>{{ $driver->driver_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="truck_id" class="col-sm-2 col-form-label">Truk *</label>
                        <div class="col-sm-4">
                            <select name="truck_id" id="truck_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                            
                                <option value="">- Pilih -</option>
                                @foreach($trucks as $truck)
                                    <option value="{{$truck->id}}" {{ ( $truck->id == $manifest->trucks->id) ? 'selected' : '' }}>{{ $truck->trucktypes->type_name }} - {{ $truck->police_number }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="float-md-right">
                            <a href="{{ url('warehouse/manifest') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Batal</a>
                            @if($manifest->last_status != "Open")
                                <button type="button" id="btn_print_stt" class="btn btn-sm btn-warning" ><i class="fas fa-print"></i> Cetak STT</button>
                                <button type="button" id="btn_print" class="btn btn-sm btn-success" ><i class="fas fa-print"></i> Cetak Manifest</button>
                            @endif 

                            @if($manifest->last_status == "Open")
                                <button type="button" id="btn_delete" class="btn btn-sm btn-danger btn-uppercase" ><i class="fas fa-save"></i> Hapus</button>
                                <button type="button" class="btn btn-sm btn-danger" id="btn_delete_wait" disabled
                                style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menghapus Data...</i>
                                </button>

                                <button type="submit" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                                <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                                style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data...</i>
                                </button>
                                
                                <button type="button" id="btn_closing" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-close"></i> Closing</button>
                                <button type="button" class="btn btn-sm btn-brand-02" id="btn_closing_wait" disabled
                                style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Memproses Data...</i>
                                </button>
                            @endif
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
            
                @if($manifest->details[0]->orders->servicegroups->group_name == "Regular")
                    <button type="button" id="btn_add" class="btn btn-sm btn-brand-02" ><i class="fas fa-plus"></i> Tambah STT</button>
                @endif
            
            <hr>
            <div data-label="Example" class="df-example demo-table">
            <table id="table_data" class="table mg-b-0" width="100%">
                <thead>
                    <tr>
                        <th class="wd-10p">No STT</th>
                        <th class="wd-20p">Customer</th>
                        <th class="wd-20p">Alamat</th>
                        <th class="wd-10p">Layanan</th>
                        <th class="wd-10p">Colly</th>
                        <th class="wd-8p">Kg</th>
                        <th class="wd-15p">Keterangan</th>
                        <th class="wd-7p">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $sum_colly = 0;
                    $sum_kg = 0;
                @endphp
                @foreach($manifest->details as $value)
                    @php 
                        $sum_colly = $sum_colly + $value->orders->total_colly;
                        $sum_kg = $sum_kg + $value->orders->total_kg;
                    @endphp
                    <tr>
                        <td>{{ $value->orders->awb_no }}</td>
                        <td>{{ $value->orders->customers->customer_name }}</td>
                        <td>{{ $value->orders->customer_branchs->address }}</td>
                        <td>{{ $value->orders->servicegroups->group_name }} ({{ $value->orders->services->service_name }}}</td>
                        <td>{{ $value->orders->total_colly }}</td>
                        <td>{{ $value->orders->total_kg }}</td>
                        <td>{{ $value->orders->customer_branchs->branch_name }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn btn-sm btn-danger delete-detail" data-id="{{ $value->id }}"><i class="fas fa-trash"></i> Hapus</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><b>TOTAL</b></td>
                        <td>@php echo $sum_colly; @endphp</td>
                        <td>@php echo $sum_kg; @endphp</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            </div><!-- df-example -->
        </div><!-- col -->
      </div><!-- row -->