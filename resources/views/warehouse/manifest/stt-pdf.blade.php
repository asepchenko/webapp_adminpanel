<!DOCTYPE html>
<html>
<head>
    <title>Manifest STT</title>
	<style>
		@page { 
			margin-top: 10px;
			margin-bottom: 10px;
			margin-left: 10px;
			margin-right: 10px;
		}

		.text-center {
		  text-align: center;
		}
		
		body {
			font-size : 12px;
			padding: 0;
		}
		
		/* Create three equal columns that floats next to each other */
		.column {
			float: left;
			width: 33.33%;
			padding: 5px;
		}

		/* Clear floats after the columns */
		.row:after {
			content: "";
			display: table;
			clear: both;
		}
		
		.table-border{
		  border: 1px solid black;
		}

        table.table-border td {
          border: 1px solid black;
        }

        table.table-border th {
          border: 1px solid black;
        }

		.table-border {
		  width: 100%;
		  border-collapse: collapse;
		}

        .page-break {
		  page-break-before: always;
		}

	</style>
</head>
<body>
    @foreach($stt as $data)
        <div class="text-center">
        <b>PT. LAJU KILAU EKSPRESS</b><br>
        <b>TRUCKING LAND TRANSPORTATION, CARGO SEA & AIR FREIGHT SERVICE, MOVING</b>
        <div class="row">
            <div class="column">
                <img src="img/logo.jpeg" width="140" height="60">
            </div>
            <div class="column">
                <b><i>Head Office & Warehouse</i></b>
                Jl Kebayunan Tapos No 88 Kel. Tapos Kec Cimanggis Depok 16457<br>
                Telp : 021 2292 0385 Email : marketing@lakiekspress.com
            </div>
            <div class="column"">
                <p>
                    @php 
                    echo DNS1D::getBarcodeHTML($data->orders->awb_no, 'C128');
                    @endphp
                </p>
            </div>
        </div>
        <!--<table>
        <tr>
	        <td style="width:20%">
                <img src="img/logo.jpeg" width="160" height="60">
            </td>
            <td style="width:60%">
                
            </td>
	        <td style="width:20%">
                
            </td>
        </tr>
	</table>-->
        </div>
        <table style="width:100%">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="width:60%"></td>
                <td>Tanggal</td>
                <td>{{ (new \App\Helpers\DateHelper)->getMonthName($data->orders->pickup_date) }}</td>
            </tr>
        </table>
        <br>
        <table class="table-border">
            <thead>
            <tr>
                <th>Pengirim</th>
                <th>{{ $data->orders->customers->customer_name }}</th>
                <th colspan="2"><b>ISI BARANG TIDAK DIPERIKSA</b></th>
                <th colspan="2"><b>No AWB</b></th>
                <th colspan="2">{{ $data->orders->awb_no }}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="2" rowspan="4">&nbsp;Alamat : {{ $data->orders->customers->address }}</td>
                <td colspan="4">&nbsp;Klaim diterima saat serah terima barang</td>
                <td colspan="2">&nbsp;No Cont</td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;Isi menurut pengakuan</td>
                <td>&nbsp;ASAL</td>
                <td>&nbsp;TUJUAN</td>
            </tr>
            <tr>
                <td colspan="4" rowspan="2">&nbsp;{{ $data->orders->contains }} </td>
                <td rowspan="2">&nbsp;{{ $data->orders->origins->city_code }}</td>
                <td rowspan="2">&nbsp;{{ $data->orders->destinations->city_code }}</td>
            </tr>
            <tr>
            </tr>
            <tr>
                <td colspan="2">&nbsp;Telp : {{ $data->orders->customers->phone_number }}</td>
                <td colspan="4">&nbsp;Jenis Kiriman</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td rowspan="2">&nbsp;Penerima</td>
                <td rowspan="2">&nbsp;{{ $data->orders->customers->customer_name }} - {{ $data->orders->customer_branchs->branch_name }}</td>
                <td rowspan="2">&nbsp;Dimensi</td>
                <td>&nbsp;Panjang</td>
                <td>&nbsp;Lebar</td>
                <td>&nbsp;Tinggi</td>
                <td></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <td></td>
                <th></th>
            </tr>
            <tr>
                <td colspan="2" rowspan="3">&nbsp;Alamat : {{ $data->orders->customer_branchs->address }}</td>
                <td text-align="center">&nbsp;Colly</td>
                <td>&nbsp;Berat</td>
                <td>&nbsp;Volume</td>
                <td>&nbsp;Cash</td>
                <td>&nbsp;</td>
                <th></th>
            </tr>
            <tr>
                <th rowspan="3">{{ $data->orders->total_colly }}</th>
                <th rowspan="3">{{ $data->orders->total_kg }}</th>
                <th rowspan="3"></th>
                <td>&nbsp;Inv</td>
                <td>&nbsp;</td>
                <th></th>
            </tr>
            <tr>
                <td>&nbsp;BT. Inv</td>
                <td>&nbsp;</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;Telp -</td>
                <td>&nbsp;BT. Cash</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="8" rowspan="2" height="30px">&nbsp;Keterangan : {{ $data->orders->description }}</td>
            </tr>
            <tr></tr>
            <!-- start ttd -->
                <tr>
                    <th>Pengirim</th>
                    <th></th>
                    <th>Kurir</th>
                    <th></th>
                    <th>Cabang</th>
                    <th></th>
                    <th>Penerima</th>
                    <th></th>
                </tr>
                <tr>
                    <td>&nbsp;Tgl. </td>
                    <td></td>
                    <td>&nbsp;Tgl. </td>
                    <td></td>
                    <td>&nbsp;Tgl. </td>
                    <td></td>
                    <td>&nbsp;Tgl. </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="2" height="50px"></td>
                    <td colspan="2" rowspan="2">&nbsp;</td>
                    <td colspan="2" rowspan="2">&nbsp;</td>
                    <td colspan="2" rowspan="2">&nbsp;</td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <th colspan="2">(.................................................)</th>
                    <th colspan="2">(.................................................)</th>
                    <th colspan="2">(.................................................)</th>
                    <th colspan="2">(.................................................)</th>
                </tr>
                <!--<tr>
                    <th colspan="2">Nama Jelas</th>
                    <th colspan="2">Nama Jelas</th>
                    <th colspan="2">Nama Jelas</th>
                    <th colspan="2">Nama Jelas</th>
                </tr>
                <tr>
                    <td>&nbsp;Putih</td>
                    <td>&nbsp;Invoice</td>
                    <td>&nbsp;Merah</td>
                    <td>&nbsp;Penerima</td>
                    <td>&nbsp;Hijau</td>
                    <td>&nbsp;Cabang</td>
                    <td>&nbsp;Kuning</td>
                    <td>&nbsp;File</td>
                </tr>-->
                <tr>
				<td colspan="8">&nbsp;<b>PENTING</b> : Mohon Nomor Surat Tanda Terima (STT) PT. Laju Kilau ekspress
					semua lampiran yang kembali ke jakarta  wajib ditandatangani, diberi nama penerima, tgl serta 
					cap/stempel dari penerima
				</td>
			</tr>
			<!-- end ttd -->
		</tbody>
		</table>
        
    @endforeach
	
</body>
</html>