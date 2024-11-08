<div class="row">
    <div class="col-lg-12">
        <form method="post" action="#" enctype="multipart/form-data" id="frm-edit">
            @csrf
            <input type="hidden" id="order_id" value="{{ $order->id }}">
            <input type="hidden" id="order_number" value="{{ $no }}">
            <input type="hidden" id="cogs_price" value="{{ $order->customer_master_prices->cogs_price ?? $order->trucking_price->cogs_price }}">
            <input type="hidden" id="customer_master_price_id" value="{{ $order->customer_master_price_id }}">
            <input type="hidden" id="trucking_price_id" value="{{ $order->trucking_price_id }}">
            <input type="hidden" id="administrative_cost" name="administrative_cost" value="0">
            <input type="hidden" id="other_cost" name="other_cost" value="0" >
            <input type="hidden" id="price_code" name="price_code" value="{{ $order->customer_master_prices->price_code ?? '-' }}">
            <input type="hidden" id="real_price" name="real_price" value="{{ $order->customer_master_prices->price ?? $order->trucking_price->price }}">
            <input type="hidden" id="price" name="price" value="{{ $order->costs->price ?? 0 }}" >
            <div class="row">
                <label for="awb_no" class="col-sm-2 col-form-label">No STT Manual *</label>
                <div class="col-sm-4">
                    <input type="text" maxlength="11" class="form-control form-control-sm" name="awb_no" id="awb_no" value="{{ $order->awb_no }}" required>
                </div>
                <label for="order_date" class="col-sm-1 col-form-label">Tgl STT</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control form-control-sm datetimepicker-input" id="order_date" value="{{ $order->created_at }}" readonly>
                </div>
                <label for="pickup_date" class="col-sm-1 col-form-label">Tgl Pickup</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control form-control-sm datetimepicker-input" id="pickup_date" value="{{ $order->pickup_date }}">
                </div>
            </div>
            <div class="row mt-2">
                <label for="customer" class="col-sm-2 col-form-label">Customer *</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="customer" value="{{ $order->customers->customer_name }}" readonly>
                </div>
                <label for="customer_branch" class="col-sm-1 col-form-label">Cabang *</label>
                <div class="col-sm-5">
                    <input type="text" id="tujuan" asal="tujuan" class="form-control form-control-sm" value="{{ $order->customer_branchs->branch_code }} - {{ $order->customer_branchs->branch_name }}" readonly>
                    <!--<select name="customer_branch" id="customer_branch" class="form-control form-control-sm select2bs4" style="width: 100%;" " required>
                        <option value="">- Pilih -</option>
                    </select>-->
                </div>
            </div>
            <div class="row mt-2">
                <label for="asal" class="col-sm-2 col-form-label">Asal *</label>
                <div class="col-sm-4">
                    <select name="asal" id="asal" class="form-control form-control-sm select2bs4" style="width: 100%;" required readonly>
                        <option value="">- Pilih -</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}" {{ ( $city->id == $order->origins->id) ? 'selected' : '' }}>{{$city->city_code}} - {{$city->city_name}}</option>
                        @endforeach
                    </select>
                </div>
                <label for="tujuan" class="col-sm-1 col-form-label">Tujuan *</label>
                <div class="col-sm-4">
                    <input type="text" id="tujuan" asal="tujuan" class="form-control form-control-sm" value="{{ $order->destinations->city_code }} - {{ $order->destinations->city_name }}" readonly>
                    <!--<select name="tujuan" id="tujuan" class="form-control form-control-sm select2bs4" style="width: 100%;" readonly >
                        <option value="">-</option>
                    </select>-->
                </div>
            </div>
            <hr>
            <div class="row mt-2">
                <label for="service_groups" class="col-sm-2 col-form-label">Jenis Layanan *</label>
                <div class="col-sm-4">
                    <select name="service_groups" id="service_groups" class="form-control form-control-sm" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        @foreach($service_groups as $service_group)
                        <option value="{{$service_group->id}}" {{ ( $service_group->id == $order->servicegroups->id) ? 'selected' : '' }}>{{$service_group->group_name}}</option>
                        @endforeach
                    </select>
                </div>
                <label for="truck_types" class="col-sm-1 col-form-label">Truck</label>
                <div class="col-sm-2">
                    <select name="truck_types" id="truck_types" class="form-control form-control-sm select2bs4" style="width: 100%;" ">
                        <option value="">- Pilih -</option>
                        @foreach($trucks as $truck)
                        <option value="{{$truck->id}}" {{ ( $truck->id == $order->truck_type_id) ? 'selected' : '' }}>{{$truck->type_name}}</option>
                        @endforeach
                    </select>
                </div>
                <label for="via" class="col-sm-1 col-form-label">Via</label>
                <div class="col-sm-2">
                    <select name="via" id="via" class="form-control form-control-sm select2bs4" style="width: 100%;">
                        <option value="">- Pilih -</option>
                        @foreach($services as $service)
                        <option value="{{$service->id}}" {{ ( $service->id == $order->service_id) ? 'selected' : '' }}>{{$service->service_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <label for="contains" class="col-sm-2 col-form-label">Isi Paket</label>
                <div class="col-sm-4">
                    <textarea lines="3" id="contains" name="contains" class="form-control form-control-sm" autocomplete="off" >{{ $order->contains ?? "" }}</textarea>
                </div>
                <label for="description" class="col-sm-1 col-form-label">Keterangan</label>
                <div class="col-sm-5">
                    <textarea lines="3" id="description" name="description" class="form-control form-control-sm" autocomplete="off" >{{ $order->description ?? "" }}</textarea>
                </div>
            </div>
            <div class="row mt-2">
                <label for="payment_type" class="col-sm-2 col-form-label">Metode Pembayaran *</label>
                <div class="col-sm-4">
                    <select name="payment_type" id="payment_type" class="form-control form-control-sm select2bs4" style="width: 100%;">
                        <option value="">- Pilih -</option>
                        @foreach($payment_types as $payment_type)
                        <option value="{{$payment_type->payment_name}}" {{ ( $payment_type->payment_name == $order->payment_type) ? 'selected' : '' }}>{{$payment_type->payment_name}}</option>
                        @endforeach
                    </select>
                </div>
                <label for="total_kg" class="col-sm-1 col-form-label">Berat (kg) *</label>
                <div class="col-sm-2">
                    <input type="text" id="total_kg" name="total_kg" class="form-control form-control-sm" autocomplete="off" value="{{ $order->total_kg ?? 0 }}" >
                </div>
                <label for="total_colly" class="col-sm-1 col-form-label">Colly *</label>
                <div class="col-sm-1">
                    <input type="number" id="total_colly" name="total_colly" class="form-control form-control-sm" autocomplete="off" value="{{ $order->total_colly ?? 0 }}" >
                </div>
            </div>

            <hr>

            <!--<div class="row mt-2">
                <label for="discount" class="col-sm-2 col-form-label">Diskon %</label>
                <div class="col-sm-1">
                    <input type="number" min="0" max="99" id="discount" name="discount" class="form-control form-control-sm" autocomplete="off" value="{{ $order->costs->discount ?? 0 }}" >
                </div>
                <label for="tax" class="col-sm-2 col-form-label">PPN %</label>
                <div class="col-sm-1">
                    <input type="number" min="0" max="99" id="tax" name="tax" class="form-control form-control-sm" autocomplete="off" value="{{ $order->costs->tax_percent ?? 0 }}" readonly>
                </div>
            </div>-->

            <div class="row mt-2">
                <label for="packing_cost" class="col-sm-2 col-form-label">Biaya Packing/Bongkar</label>
                <div class="col-sm-4">
                    <input type="text" id="packing_cost" name="packing_cost" class="form-control form-control-sm" autocomplete="off" value="{{ $order->costs->packing_cost ?? 0 }}">
                </div>
                <label for="insurance_fee" class="col-sm-1 col-form-label">Asuransi</label>
                <div class="col-sm-4">
                    <input type="text" id="insurance_fee" name="insurance_fee" class="form-control form-control-sm" autocomplete="off" value="{{ $order->costs->insurance_fee ?? 0 }}">
                </div>
            </div>
            <div class="mt-4">
                <span class="float-md-right">
                    <a href="{{ url('transaction/orders') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> Kembali</a>
                    @if($order->last_status != "Open")
                        <button type="button" id="btn_print" class="btn btn-sm btn-success" ><i class="fas fa-print"></i> Cetak STT</button>
                        <button type="button" id="btn_print_colly" class="btn btn-sm btn-warning" ><i class="fas fa-print"></i> Cetak Label Colly</button>
                    @endif 

                    @if($order->last_status != "Delivered" && $order->last_status_acc != "Sales")
                    @can('order_update')
                    
                    @endcan
                    @endif
                    
                    @if($order->last_status == "Open")
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
    </div><!-- col -->
</div><!-- row -->