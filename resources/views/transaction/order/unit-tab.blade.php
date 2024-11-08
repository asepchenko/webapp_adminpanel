<div class="row">
    <div class="col-md-12">
        <form method="post" enctype="multipart/form-data" id="frm-unit">
            @csrf
            <input type="hidden" name="id_unit" id="id_unit"/>
            <input type="hidden" name="action-unit" id="action-unit"/>
            <div class="row mt-2">
                <label for="colly_unit" class="col-sm-1 col-form-label">Colly</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control form-control-sm" id="colly_unit" name="colly_unit" autocomplete="off">
                </div>
                <label for="length_unit" class="col-sm-1 col-form-label">P (cm)</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" id="length_unit" name="length_unit" autocomplete="off">
                </div>
                <label for="width_unit" class="col-sm-1 col-form-label">L (cm)</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" id="width_unit" name="width_unit" autocomplete="off">
                </div>
                <label for="height_unit" class="col-sm-1 col-form-label">T (cm)</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" id="height_unit" name="height_unit" autocomplete="off">
                </div>
            </div>
            <div class="row mt-2">
                <label for="kg_unit" class="col-sm-1 col-form-label">Kg</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" id="kg_unit" name="kg_unit" autocomplete="off">
                </div>
                <label for="volume_unit" class="col-sm-1 col-form-label">Volume</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" id="volume_unit" name="volume_unit" autocomplete="off">
                </div>
                <label for="divider_unit" class="col-sm-1 col-form-label">Pembilang</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control form-control-sm" id="divider_unit" name="divider_unit" autocomplete="off">
                </div>
            </div>
            
            <div class="mt-2">
                <span class="float-md-right">
                    @if($order->last_status == "Open" && $order->last_status_acc != "Sales")
                    <button type="button" id="btn_save_unit" class="btn btn-sm btn-brand-02 btn-uppercase" ><i class="fas fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-brand-02" id="btn_save_unit_wait" disabled
                            style="display: none;"><i class="fa fa-spin fa-spinner"></i> <i>Menyimpan Data..</i>
                    </button>
                    @endif

                    @if($order->last_status != "Open")
                        <button type="button" id="btn_print_list_colly" class="btn btn-sm btn-warning" ><i class="fas fa-print"></i> Cetak List Colly</button>
                    @endif 
                </span>  
            </div>
        </form>
    </div> <!-- col -->

    <div class="col-md-12">
        <p><h5>List</h5></p>
        <div class="demo-table">
            <table id="table_unit" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-10p">Colly</th>
                        <th class="wd-10p">Kg</th>
                        <th class="wd-15p">Volume</th>
                        <th class="wd-30p">Pembilang</th>
                        <th class="wd-10p">P</th>
                        <th class="wd-10p">L</th>
                        <th class="wd-10p">T</th>
                        <th class="wd-5p">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div><!-- df-example -->
    </div> <!-- col -->
</div> <!-- row -->