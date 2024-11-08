<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <label for="opt_cost" class="col-sm-4 col-form-label">Biaya Operasional</label>
            <div class="col-sm-2">
                <input type="text" class="form-control form-control-sm" id="opt_cost" value="{{ $trip->operational_cost }}" readonly>
            </div>
            <label for="mn" class="col-sm-4 col-form-label">Angka Pengali</label>
            <div class="col-sm-2">
                <input type="text" class="form-control form-control-sm" id="mn" value="{{ $trip->multiplier_number }}" readonly>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
            <div data-label="Example" class="df-example demo-table">
            <table id="table_cogs" class="table mg-b-0" width="100%">
                <thead>
                    <tr>
                        <th class="wd-10p">Tujuan</th>
                        <th class="wd-5p">Pengali</th>
                        <th class="wd-10p">Angka Pengali</th>
                        <th class="wd-10p">HPP / Kg</th>
                        <th class="wd-10p">HPP Avg</th>
                        <th class="wd-10p">Avg Biaya Ops</th>
                        <th class="wd-10p">HPP Real / Kg</th>
                        <th class="wd-20p">HPP Real / Kota</th>
                        <th class="wd-10p">Kg/Qty</th>
                        <th class="wd-5p">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $sum_multiplier_number = 0;
                        $sum_cogs_kg = 0;
                        $sum_cogs_avg = 0;
                        $sum_avg_ops_cost = 0;
                        $sum_cogs_real_kg = 0;
                        $sum_cogs_real_city = 0;
                        $sum_kg = 0;
                    @endphp
                    @foreach($cogs as $cog)
                    @php 
                        $sum_multiplier_number = $sum_multiplier_number + $cog->multiplier_number;
                        $sum_cogs_kg = $sum_cogs_kg + str_replace(',','.',str_replace('.','',$cog->cogs_kg));
                        $sum_cogs_avg = $sum_cogs_avg + str_replace(',','.',str_replace('.','',$cog->cogs_avg));
                        $sum_avg_ops_cost = $sum_avg_ops_cost + str_replace(',','.',str_replace('.','',$cog->avg_ops_cost));
                        $sum_cogs_real_kg = $sum_cogs_real_kg + str_replace(',','.',str_replace('.','',$cog->cogs_real_kg));
                        $sum_cogs_real_city = $sum_cogs_real_city + str_replace(',','.',str_replace('.','',$cog->cogs_real_city));
                        $sum_kg = $sum_kg + str_replace(',','.',str_replace('.','',$cog->kg));
                    @endphp
                    <tr>
                        <td>{{ $cog->cities->city_name }}</td>
                        <td>{{ $cog->multiplier }}</td>
                        <td>{{ $cog->multiplier_number }}</td>
                        <td>{{ $cog->cogs_kg }}</td>
                        <td>{{ $cog->cogs_avg }}</td>
                        <td>{{ $cog->avg_ops_cost }}</td>
                        <td>{{ $cog->cogs_real_kg }}</td>
                        <td>{{ $cog->cogs_real_city }}</td>
                        <td>{{ $cog->kg }}</td>
                        <td>
                            <div class="dropdown d-inline">
                                <button class="btn btn-sm btn-brand-02 btn-uppercase mg-l-5 dropdown-toggle" type="button" id="btnAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item has-icon" href="#" onClick="editDataCogs('{{ $cog->id }}');"><i class="fa fa-edit"></i> Ubah</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><b>TOTAL</b></td>
                        <td>@php echo number_format($sum_multiplier_number,1,".",","); @endphp</td>
                        <td>@php echo number_format($sum_cogs_kg,2,",","."); @endphp</td>
                        <td>@php echo number_format($sum_cogs_avg,2,",","."); @endphp</td>
                        <td>@php echo number_format($sum_avg_ops_cost,2,",","."); @endphp</td>
                        <td>@php echo number_format($sum_cogs_real_kg,2,",","."); @endphp</td>
                        <td>@php echo number_format($sum_cogs_real_city,2,",","."); @endphp</td>
                        <td>@php echo number_format($sum_kg,2,",","."); @endphp</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            </div><!-- df-example -->
        </div><!-- col -->
      </div><!-- row -->