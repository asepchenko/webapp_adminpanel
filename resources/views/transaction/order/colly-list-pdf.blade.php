<!DOCTYPE html>
<html>
<head>
    <title>List STT Colly</title>
	<style>
		@page { 
			margin-top: 15px;
			margin-bottom: 15px;
			margin-left: 15px;
			margin-right: 15px;
		}

		/*body { margin: 5px; }*/
		.text-center {
		  text-align: center;
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
        }
	</style>
</head>
<body>
    <h2>List Colly</h2>
    <h4>AWB No : {{ $order->awb_no }}</h4>
    <p>Tgl Cetak : {{ $printdate }}</p>
    <br>
	
	<table>
        <thead>
            <tr>
                <th>No Colly</th>
                <th>Panjang (cm)</th>
                <th>Lebar (cm)</th>
                <th>Tinggi (cm)</th>
                <th>Volume</th>
            </tr>
        </thead>
	    <tbody>
        @foreach($colly as $col)
            <tr>
                <td>{{ $col->colly }}</td>
                <td>{{ $col->length }}</td>
                <td>{{ $col->width }}</td>
                <td>{{ $col->height }}</td>
                <td>{{ $col->volume }}</td>
            </tr>
        @endforeach
	    </tbody>
	</table>
	
</body>
</html>