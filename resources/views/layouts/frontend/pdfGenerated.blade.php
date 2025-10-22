<!DOCTYPE html>
<html>

<head>
	<title>Surat Penetapan Penomoran</title>

	<style type="text/css">
		/* @page {
			size: legal;
			margin-top: 1.5cm;
			/* Adjust the top margin as needed */
		margin-right: 2cm;
		/* Adjust the right margin as needed */
		margin-bottom: 2cm;
		/* Adjust the bottom margin as needed */
		margin-left: 2.5cm;
		/* Adjust the left margin as needed */
		}

		*/ .page-break {
			page-break-after: always;
		}

		/* .table-inner tr td {
			border: 1px solid black;
			border-collapse: collapse;
			padding: 5px;
		} */
		.watermark {
			position: fixed;
			bottom: 10cm;
			left: 3cm;
			width: 8cm;
			height: 8cm;
			z-index: -1000;
			color: lightgrey;
			font-size: 200px;
			opacity: 0.8;
			transform: rotate(-45deg);
		}

		* {
			font-size: 11.7pt;
			font-family: "Bookman", "Bookman Old Style", "Garamond", "Times New Roman", serif;
		}

		h2 {
			font-weight: normal;
		}
	</style>
</head>

<body>
	<div style="text-align:center !important;">
		<img style="width:120px;" src="{{ public_path('global_assets/images/logo_kominfo.png') }}">
	</div>
	<div style="text-align:center !important;">
		{{-- <h2 class="judul">PEMERINTAH REPUBLIK INDONESIA</h2> --}}
		{{-- <h2 class="judul">PERIZINAN BERUSAHA UNTUK MENUNJANG KEGIATAN BERUSAHA</h2> --}}
		{{-- <h4 class="isi">PENOMORAN TELEKOMUNIKASI</h4> --}}
		<h2 class="judul">DAFTAR ALAT DAN PERANGKAT
			<br />
			{{ $data['full_kbli'] }}
			<br />
			{!! $data['jenis_layanan_html'] !!}
			<br />
			{{ strtoupper($data['nama_perseroan']) }}
			<br />Nomor Permohonan:
			{{ $data['id_trx_izin'] }}
			{{-- {{ isset($d->no_sk) ? $d->no_sk : '' }} --}}
		</h2>
	</div>

	<div>
		<div class="card">
			<div class="card-header bg-indigo text-white header-elements-inline">
				<div class="row">
					<div class="col-lg">
						<h6 class="card-title font-weight-semibold py-3">Informasi Perangkat </h6>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group row">
					<div class="col-lg-12">
						<label class="font-weight-semibold col-lg-4 col-form-label">Lokasi Perangkat :</label>
						<br /><br />
						<label class="col-lg col-form-label"> {{ $data['lokasi_perangkat'] }}</label>
						<br /><br />
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group row">
					<div class="col-lg-12">
						<label class="font-weight-semibold col-lg-4 col-form-label">Jenis Perangkat :</label>
						<br /><br />
						<label class="col-lg col-form-label"> {{ $data['jenis_perangkat'] }}</label>
						<br /><br />
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group row">
					<div class="col-lg-12">
						<label class="font-weight-semibold col-lg-4 col-form-label">Merk Perangkat :</label>
						<br /><br />
						<label class="col-lg col-form-label"> {{ $data['merk_perangkat'] }}</label>
						<br /><br />
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group row">
					<div class="col-lg-12">
						<label class="font-weight-semibold col-lg-4 col-form-label">SN Perangkat :</label>
						<br /><br />
						<label class="col-lg col-form-label"> {{ $data['sn_perangkat'] }}</label>
						<br /><br />
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group row">
					<div class="col-lg-12">
						<label class="font-weight-semibold col-lg-4 col-form-label">Tipe Perangkat :</label>
						<br /><br />
						<label class="col-lg col-form-label"> {{ $data['tipe_perangkat'] }}</label>
						<br /><br />
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="form-group row">
					<div class="col-lg-12">
						<label class="font-weight-semibold col-lg-4 col-form-label">Buatan Perangkat :</label>
						<br /><br />
						<label class="col-lg col-form-label"> {{ $data['buatan_perangkat'] }}</label>
						<br /><br />
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="col-lg-12">
		{{-- <div class="form-group row">
			<div class="row">
				<div class="col-lg-4">
					Lokasi Perangkat
				</div>
				<div class="col-lg-2">
					:
				</div>
				<div class="col-lg-6">
					{{ $data['lokasi_perangkat'] }}
				</div>

			</div>
		</div> --}}
		{{-- <table style="text-align: justify !important;width:100%;">
			<tr style="vertical-align:top !important;">
				<td class="col-lg-4">
					Lokasi Perangkat
				</td>
				<td class="col-lg-1">
					:
				</td>
				<td class="col-lg-6">
					{{ $data['lokasi_perangkat'] }}
				</td>
			</tr>
			<tr style="vertical-align:top !important;">
				<td class="col-lg-4">
					Jenis Perangkat
				</td>
				<td class="col-lg-1">
					:
				</td>
				<td class="col-lg-6">
					{{ $data['jenis_perangkat'] }}
				</td>
			</tr>
			<tr style="vertical-align:top !important;">
				<td class="col-lg-4">
					Merk Perangkat
				</td>
				<td class="col-lg-1">
					:
				</td>
				<td class="col-lg-6">
					{{ $data['merk_perangkat'] }}
				</td>
			</tr>
			<tr style="vertical-align:top !important;">
				<td class="col-lg-4">
					SN Perangkat
				</td>
				<td class="col-lg-1">
					:
				</td>
				<td class="col-lg-6">
					{{ $data['sn_perangkat'] }}
				</td>
			</tr>
			<tr style="vertical-align:top !important;">
				<td class="col-lg-4">
					Tipe Perangkat
				</td>
				<td class="col-lg-1">
					:
				</td>
				<td class="col-lg-6">
					{{ $data['tipe_perangkat'] }}
				</td>
			</tr>
			<tr style="vertical-align:top !important;">
				<td class="col-lg-4">
					Buatan Perangkat
				</td>
				<td class="col-lg-1">
					:
				</td>
				<td class="col-lg-6">
					{{ $data['buatan_perangkat'] }}
				</td>
			</tr>
		</table> --}}
	</div>
</body>

</html>
