<!DOCTYPE html>
<html>
<head>
    <title>Manifest</title>
	<style>
		.text-center {
		  text-align: center;
		}
		
		body {
		   padding: 0;
		}

		body {
		  margin-top: 5px;
		  margin-bottom: 5px;
		  margin-right: 5px;
		  margin-left: 5px;
		}
		
		/* Create three equal columns that floats next to each other */
		.column {
			float: left;
			width: 50%;
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
          text-align: center;
        }

		.table-border {
		  width: 100%;
		  border-collapse: collapse;
		}
	</style>
</head>
<body>
	<div class="row">
		<div class="column">
			<img src="img/logo.jpeg" width="140" height="60">
            <br>
            <b>PT. LAJU KILAU EKSPRESS</b><br>
            Jl Kebayunan Tapos No 88 Kel. Tapos Kec Cimanggis Depok 16457<br>
            Telp : 021 2292 0385 <br>
			Email : marketing@lakiekspress.com
		</div>
		<div class="column">
            <h2>PACKING LIST</h2>
			@php 
            	echo DNS2D::getBarcodeHTML($manifest->manifest_number, 'QRCODE',4,4);
            @endphp
		</div>
	</div>
	<hr>
	<table style="width:100%">
		<tr>
			<td>No Manifest</td>
			<td>&nbsp;:&nbsp;{{ $manifest->manifest_number }}</td>
			<td>No Polisi</td>
            <td>&nbsp;:&nbsp;{{ $manifest->trucks->police_number }}</td>
		</tr>
        <tr>
            <td>Tanggal</td>
			<td>&nbsp;:&nbsp;{{ (new \App\Helpers\DateHelper)->getMonthName($manifest->manifest_date) }}</td>
			<td>Driver</td>
			<td>&nbsp;:&nbsp;{{ $manifest->drivers->driver_name }}</td>
        </tr>
        <tr>
            <td>Tujuan</td>
			<td>&nbsp;:&nbsp;{{ $manifest->destinations->city_name }}</td>
			<td>Kode</td>
			<td>&nbsp;:&nbsp;{{ $manifest->destinations->city_code }}</td>
        </tr>
		<tr>
            <td>Layanan</td>
			<td>&nbsp;:&nbsp;{{ $manifest->details[0]->orders->servicegroups->group_name }}</td>
			<td>Via</td>
			<td>&nbsp;:&nbsp;{{ $manifest->details[0]->orders->services->service_name }}</td>
        </tr>
		<tr>
            <td>Agent</td>
			<td>&nbsp;:&nbsp;{{ $agent[0]->agent_name }}</td>
			<td>Armada</td>
			<td>&nbsp;:&nbsp;{{ $manifest->trucks->trucktypes->type_name }}</td>
        </tr>
	</table>
	<br>
	<table class="table-border">
        <thead>
            <tr>
                <th>&nbsp;No STT</th>
                <th>&nbsp;Customer</th>
                <th>&nbsp;Alamat</th>
                <th>&nbsp;Colly</th>
                <th>&nbsp;Kg</th>
                <th>&nbsp;Keterangan</th>
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
                <td>&nbsp;{{ $value->orders->awb_no }}</td>
                <td>&nbsp;{{ $value->orders->customers->customer_name }}</td>
                <td>&nbsp;{{ $value->orders->customer_branchs->address }}</td>
                <td>&nbsp;{{ $value->orders->total_colly }}</td>
                <td>&nbsp;{{ $value->orders->total_kg }}</td>
                <td>&nbsp;{{ $value->orders->customer_branchs->branch_name }}</td>
            </tr>
        @endforeach
        </tbody>
		<tfoot>
            <tr>
                <td colspan="3"><b>&nbsp;TOTAL</b></td>
                <td>&nbsp;@php echo $sum_colly; @endphp</td>
                <td>&nbsp;@php echo $sum_kg; @endphp</td>
                <td></td>
            </tr>
        </tfoot>
	</table>
	<p><i>Tanggal Cetak : {{ $printdate }}</i></p>
</body>
</html>