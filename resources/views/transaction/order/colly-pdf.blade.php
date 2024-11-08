<!DOCTYPE html>
<html>
<head>
    <title>Label STT Colly</title>
	<style>
		@page { 
			size: 10cm 10cm portrait; 
			margin-top: 5px;
			margin-bottom: 5px;
			margin-left: 5px;
			margin-right: 5px;
		}

		.page-break {
		  page-break-before: always;
		}

		/*body { margin: 5px; }*/
		.text-center {
		  text-align: center;
		}
		
		.text-25{
			font-size: 25px;
		}

		.text-40{
			font-size: 40px;
		}

		table, td, th {
		  border: 1px solid black;
		}

		table {
		  width: 100%;
		  border-collapse: collapse;
		  table-layout:fixed;
		}

		td { 
			text-align: center;
		  	vertical-align: center;
			overflow: hidden; 
			text-overflow: ellipsis; 
			word-wrap: break-word;
		}

		.barcode-container {
			text-align: center;
			margin:  0 auto;
		}

		.barcode{
			overflow: hidden; 
			margin-top: 0 auto;
			/*margin-left: 60px auto;*/
			margin-right: 0 auto;
			margin-bottom: 0 auto;
		}
	</style>
</head>
<body>
	@for ($i = 1; $i <= $order->total_colly; $i++)
	<table>
	<thead>
	  <tr>
		<th colspan="3" class="text-center text-25"><b>LAKI EKSPRESS</b></th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
		<td colspan="3" class="text-center text-25"><b>021 2292 0385</b></td>
	  </tr>
	  <tr>
		<td colspan="2" rowspan="2" width="70%" class="text-center text-40"><b>{{ $awb_no }}</b></td>
		<td class="text-center" width="30%">ASAL</td>
	  </tr>
	  <tr>
		<td class="text-center text-25"><b>{{ $order->origins->city_code }}</b></td>
	  </tr>
	  <tr>
		<td colspan="2" rowspan="2" width="70%">
			<div class="barcode-container">
				@if(strlen($awb_no) == 6)
					<div class="barcode" style="margin-left:65px;">
					@php 
						echo DNS1D::getBarcodeHTML($awb_no, 'C128',2,28);
					@endphp
					</div>
				@elseif(strlen($awb_no) == 7 || strlen($awb_no) == 8)
					<div class="barcode" style="margin-left:40px;">
					@php 
						echo DNS1D::getBarcodeHTML($awb_no, 'C128',2,28);
					@endphp
					</div>
				@elseif(strlen($awb_no) == 9 || strlen($awb_no) == 10)
					<div class="barcode" style="margin-left:35px;">
					@php 
						echo DNS1D::getBarcodeHTML($awb_no, 'C128',2,28);
					@endphp
					</div>
				@elseif(strlen($awb_no) == 11)
					<div class="barcode" style="margin-left:15px;">
					@php 
						echo DNS1D::getBarcodeHTML($awb_no, 'C128',2,28);
					@endphp
					</div>
				@else
					<div class="barcode" style="margin-left:45px;">
					@php 
						echo DNS1D::getBarcodeHTML($awb_no, 'C128',2,28);
					@endphp
					</div>
				@endif
			</div>
		</td>
		<td class="text-center">TOTAL KOLI</td>
	  </tr>
	  <tr>
		<td class="text-center text-25"><b>{{ $order->total_colly }}</b></td>
	  </tr>
	  <tr>
		<td class="text-center" width="70%">TUJUAN</td>
		<td colspan="2" class="text-center">KOLI</td>
	  </tr>
	  <tr>
		<td class="text-center text-25"><b>{{ $order->destinations->city_code }}</b></td>
		<td colspan="2" rowspan="2" class="text-center text-25"><b>@php echo $i; @endphp/{{ $order->total_colly }}</b></td>
	  </tr>
	  <tr>
		<!-- style="height:160px" -->
		<td style="height:113px">{{ $order->customer_branchs->address }}</td>
	  </tr>
	</tbody>
	</table>
	@if($i != $order->total_colly)
	<div class="page-break"></div> <!-- Page break -->
	@endif
	@endfor
</body>
</html>