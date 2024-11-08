<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
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
          text-align: left;
        }

		.table-border {
		  width: 100%;
		  border-collapse: collapse;
		}
	</style>
</head>
<body>
	<table style="width:100%">
		<thead>
		<tr>
			<th colspan="8" rowspan="3">PT. LAJU KILAU EKSPRESS</th>
			<th colspan="2" rowspan="3">TO : {{ $invoice->customers->customer_name }}</th>
		</tr>
		<tr>
		</tr>
		<tr>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td colspan="8" rowspan="4"><b>INVOICES</b></td>
			<td>ATTN</td>
			<td>FINANCE</td>
		</tr>
		<tr>
			<td>NO INV</td>
			<td>{{ $invoice->invoice_number }}</td>
		</tr>
		<tr>
			<td>TGL</td>
			<td>{{ $invoice->invoice_date }}</td>
		</tr>
		<tr>
			<td>JTH TEMPO</td>
			<td>{{ $invoice->due_date }}</td>
		</tr>
		</tbody>
	</table>

	<br>
	<table class="table-border">
        <thead>
			<tr>
				<th rowspan="2">&nbsp;No</th>
				<th rowspan="2">&nbsp;Tgl</th>
				<th rowspan="2">&nbsp;No STT</th>
				<th rowspan="2">&nbsp;Tujuan</th>
				<th rowspan="2">&nbsp;Penerima</th>
				<th rowspan="2">&nbsp;Colly</th>
				<th>&nbsp;Volume</th>
				<th>&nbsp;Harga</th>
				<th>&nbsp;By Kirim</th>
			</tr>
			<tr>
				<td>&nbsp;A</td>
				<td>&nbsp;B</td>
				<td>&nbsp;A x B</td>
			</tr>
        </thead>
		@php
		$no = 1;
		@endphp
        <tbody>
        @foreach($invoice->details as $value)
            <tr>
				<td>&nbsp;{{ $no }}</td>
				<td>&nbsp;{{ $value->orders->pickup_date }}</td>
                <td>&nbsp;{{ $value->orders->awb_no }}</td>
                <td>&nbsp;{{ $value->orders->destinations->city_name }}</td>
				<td>&nbsp;{{ $value->orders->customer_branchs->branch_name }}</td>
                <td>&nbsp;{{ $value->orders->total_colly }}</td>
                <td>&nbsp;{{ $value->orders->total_kg }}</td>
                <td>&nbsp;{{ $value->orders->costs->cogs_price }}</td>
				<td>&nbsp;{{ $value->orders->costs->grand_total }}</td>
            </tr>
			@php
				$no++;
			@endphp
        @endforeach

			<tr>
				<th colspan="5">&nbsp;GRAND TOTAL</th>
				<th>&nbsp;{{ $invoice->total_colly }}</th>
				<th>&nbsp;{{ $invoice->total_volume }}</th>
				<th>&nbsp;0</th>
				<th>&nbsp;0</th>
			</tr>
			<tr>
				<td colspan="7"></td>
				<td>&nbsp;SUBTOTAL</td>
				<td>&nbsp;{{ $invoice->subtotal }}</td>
			</tr>
			<tr>
				<td colspan="7"></td>
				<td>&nbsp;POTONGAN</td>
				<td>&nbsp;{{ $invoice->discount }}</td>
			</tr>
			<tr>
				<td colspan="7"></td>
				<td>&nbsp;PPN 1%</td>
				<td>&nbsp;{{ $invoice->tax }}</td>
			</tr>
			<tr>
				<td colspan="7"></td>
				<td>&nbsp;ASURANSI</td>
				<td>&nbsp;{{ $invoice->other_cost }}</td>
			</tr>
			<tr>
				<td colspan="7"></td>
				<td>&nbsp;GRANDTOTAL</td>
				<td>&nbsp;{{ $invoice->grand_total }}</td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;TERBILANG</td>
				<td colspan="7">&nbsp;</td>
			</tr>
        </tbody>
	</table>

	<br><br><br>

	<div class="row">
	  <div class="column">
		
	  </div>
	  <div class="column">
		Jakarta, {{ $printdate }}
	  </div>
	</div>
	<div class="row">
	  <div class="column">
		PT. LAJU KILAU EKSPRESS
	  </div>
	  <div class="column">
		Accounting
	  </div>
	</div>
	
	<br><br><br><br><br><br>
	
	<div class="row">
	  <div class="column">
		(TB. DADAN PERDANA P)
	  </div>
	  <div class="column">
        (TRIADI FEBRIANDANI)
	  </div>
	</div>
</body>
</html>