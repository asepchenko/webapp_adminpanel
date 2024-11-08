<div class="row">
            <div class="col-lg-12">
                <form method="post" action="#" enctype="multipart/form-data" id="frm-edit">
                    @csrf
                    <input type="hidden" id="trip_id" value="{{ $trip->id }}">
                    <input type="hidden" id="trip_number" value="{{ $trip->trip_number }}">
                    <div class="row">
                        <label for="driver" class="col-sm-2 col-form-label">Driver</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm" value="{{ $driver_name }}" disabled>
                        </div>
                        <label for="operational_cost" class="col-sm-2 col-form-label">Biaya Operasional</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" id="operational_cost" value="{{ $trip->operational_cost }}">
                            </div>
                    </div>
                    <div class="row mt-2">
                        <label for="truck" class="col-sm-2 col-form-label">Armada</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm" value="{{ $truck }} - ({{ $police_number }})" disabled>
                        </div>
                        <label for="main_multiplier_number" class="col-sm-2 col-form-label">Angka Pengali</label>
                        <div class="col-sm-2">
                            <input type="text" id="main_multiplier_number" class="form-control form-control-sm" value="{{ $trip->multiplier_number }}">
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="float-md-right">
                            <a href="{{ url('warehouse/trip') }}" class="btn btn-sm btn-danger" type="button"><i class="fas fa-arrow-left"></i> List</a>
                            @if($trip->last_status != "Open")
                                <!--<button type="button" id="btn_print" class="btn btn-sm btn-success" ><i class="fas fa-print"></i> Cetak Trip</button>-->
                            @endif 

                            @if($trip->last_status == "Open")
                                <!--<button type="button" id="btn_add" class="btn btn-sm btn-brand-02" ><i class="fas fa-plus"></i> Tambah Manifest</button>-->
                                <button type="button" id="btn_save" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Perbarui</button>
                                <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_wait" disabled
                                style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Memperbarui Data...</i>
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
        <hr>
        <div class="row">
            <div class="col-lg-12">
            <div data-label="Example" class="df-example demo-table">
            <table id="table_data" class="table mg-b-0" width="100%">
                <thead>
                    <tr>
                        <th class="wd-15p">No Manifest</th>
                        <th class="wd-40p">No STT</th>
                        <th class="wd-10p">Total Colly</th>
                        <th class="wd-10p">Total Kg</th>
                        <th class="wd-20p">Tujuan</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $sum_colly = 0;
                    $sum_kg = 0;
                @endphp
                @foreach($trip->details as $value)
                    @php 
                        $sum_colly = $sum_colly + $value->manifests->total_colly;
                        $sum_kg = $sum_kg + str_replace(',','.',str_replace('.','',$value->manifests->total_kg));
                    @endphp
                    <tr>
                        <td>{{ $value->manifests->manifest_number }}</td>
                        <td>
                            @foreach($value->manifests->details as $mft)
                                <span class="badge badge-pill badge-primary"><b>{{ $mft->orders->awb_no }}</b></span> 
                            @endforeach
                        </td>
                        <td>{{ $value->manifests->total_colly }}</td>
                        <td>{{ $value->manifests->total_kg }}</td>
                        <td>{{ $value->manifests->destinations->city_name }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><b>TOTAL</b></td>
                        <td>@php echo $sum_colly; @endphp</td>
                        <td>@php echo number_format($sum_kg,2,",","."); @endphp</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            </div><!-- df-example -->
        </div><!-- col -->
      </div><!-- row -->