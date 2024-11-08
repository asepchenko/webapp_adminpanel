<div class="row">
      <div class="col-md-12">
        <!--<p><h5>List Cakupan Kota</h5></p>-->
        <form method="post" enctype="multipart/form-data" id="frm-city">
            @csrf
            <div class="row">
                <label for="city_id" class="col-sm-2 col-form-label">Kota *</label>
                <div class="col-sm-4">
                    <select name="agent_city_id" id="agent_city_id" class="form-control form-control-sm select2bs4" style="width: 100%;" required>
                        <option value="">- Pilih -</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->city_code}} - {{$city->city_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                <span class="float-md-right">
                    <button type="button" id="btn_save_city" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_city_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data..</i>
                    </button>
                </span>  
                </div>
            </div>
        </form>
        <hr>
        <div class="demo-table">
            <table id="table_city" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-30p">Kode Kota</th>
                        <th class="wd-65p">Nama Kota</th>
                        <th class="wd-5p">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div><!-- df-example -->
    </div> <!-- col -->
    </div><!-- row -->