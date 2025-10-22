<!DOCTYPE html>
<html>

<head>
	<title>Surat Penetapan Penomoran</title>

	<style type="text/css">
		@page {
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

		.page-break {
			page-break-after: always;
		}

		.table-inner tr td {
			border: 1px solid black;
			border-collapse: collapse;
			padding: 5px;
		}

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
	<div class="watermark">
		DRAF
	</div>
	<?php
	if (isset($data['jenis_layanan_html'])) {
	    $jenis_layanan = str_replace('Izin ', '', $data['jenis_layanan_html']);
	} else {
	    $jenis_layanan = '';
	}
	?>

	@foreach ($penomoran_kodeakses as $item => $d)
		@if ($d->group_permohonan == 'Penetapan')
			{{-- <div class="page-break"></div> --}}

			<div style="text-align:center !important;">
				<img style="width:120px;" src="{{ public_path('global_assets/images/logo_kominfo.png') }}">
			</div>
			<div style="text-align:center !important;">
				{{-- <h2 class="judul">PEMERINTAH REPUBLIK INDONESIA</h2> --}}
				{{-- <h2 class="judul">PERIZINAN BERUSAHA UNTUK MENUNJANG KEGIATAN BERUSAHA</h2> --}}
				{{-- <h4 class="isi">PENOMORAN TELEKOMUNIKASI</h4> --}}
				{{-- <h2 class="judul">PENETAPAN {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
				    ? strtoupper($data['kode_akses']['jenis_kode_akses']['full_name_html'])
				    : '' !!}</h2>
				<h2 class="judul">
					{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}
				</h2>
				<h2 class="judul">Nomor : {{ isset($d->no_sk) ? $d->no_sk : '' }}</h2> --}}
				<h2 class="judul">PENETAPAN {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
				    ? strtoupper($data['kode_akses']['jenis_kode_akses']['full_name_html'])
				    : '' !!}
					<br />
					{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}
					<br />
					Nomor : {{ isset($d->no_sk) ? $d->no_sk : '' }}
				</h2>
			</div>
			<div>
				<table style="text-align: justify !important;width:100%;padding-right:10px;">
					<tr style="vertical-align:top !important;">
						<td width="5%">
							Dasar
						</td>
						<td width="2%">
							:
						</td>
						<td width="2%">
							a.
						</td>
						<td width="91%">
							Peraturan Menteri Komunikasi dan Informatika Nomor 14 Tahun 2018 tentang Rencana
							Dasar
							Teknis
							(<i>Fundamental Technical Plan</i>)
							Telekomunikasi Nasional;
						</td>
					<tr style="vertical-align:top !important;">
						<td width="5%">&nbsp;</td>
						<td width="2%">&nbsp;</td>
						<td width="2%">
							b.
						</td>
						<td width="91%">
							Peraturan Menteri Komunikasi dan Informatika Nomor 5 Tahun 2021 tentang
							Penyelenggaraan
							Telekomunikasi;
						</td>
					</tr>
					<tr style="vertical-align:top !important;">
						<td width="5%">&nbsp;</td>
						<td width="2%">&nbsp;</td>
						<td width="2%">
							c.
						</td>
						<td width="91%">
							Keputusan Menteri Komunikasi dan Informatika Nomor 793 Tahun 2018 tentang Pemberian
							Kewenangan
							Penandatanganan Dokumen Bidang Penyelenggaraan Pos dan Informatika Dalam Rangka
							Pelayanan Prima di
							Lingkungan Direktorat Jenderal Penyelenggaraan Pos dan Informatika;
						</td>
					</tr>
					<tr style="vertical-align:top !important;">
						<td width="5%">&nbsp;</td>
						<td width="2%">&nbsp;</td>
						<td width="2%">
							d.
						</td>
						<td width="91%">
							Keputusan Direktur Jenderal Penyelenggaraan Pos dan Informatika Nomor 167 Tahun 2018
							tentang
							Pemberian Kewenangan Penandatanganan Dokumen Bidang Penyelenggaraan Pos dan
							Informatika
							Dalam Rangka
							Pelayanan Prima di Lingkungan Direktorat Jenderal Penyelenggaraan Pos dan
							Informatika
							sebagaimana
							telah diubah dengan Keputusan Direktur Jenderal Penyelenggaraan Pos dan Informatika
							Nomor 130 Tahun
							2020 tentang Perubahan Keputusan Direktur Jenderal Penyelenggaraan Pos dan
							Informatika
							Nomor 167
							Tahun 2018 tentang Pemberian Kewenangan Penandatanganan Dokumen Bidang
							Penyelenggaraan
							Pos dan
							Informatika Dalam Rangka Pelayanan Prima di Lingkungan Direktorat Jenderal
							Penyelenggaraan Pos dan
							Informatika;
						</td>
					</tr>
					<tr style="vertical-align:top !important;">
						<td width="5%">&nbsp;</td>
						<td width="2%">&nbsp;</td>
						<td width="2%">
							e.
						</td>
						<td width="91%">
							Permohonan Penetapan Penomoran
							{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}
							Nomor
							{{ isset($data['id_permohonan']) ? $data['id_permohonan'] : '' }} tanggal
							{{ isset($data['created_date']) ? $date_reformat->date_lang_reformat_long($data['created_date']) : '' }}.
						</td>
					</tr>
				</table>
			</div>

			<table style="text-align: justify !important;width:100%;padding-right:10px;">
				<tr style="vertical-align:top !important;">
					<td style="padding-left:10px;" colspan="3">
						Menetapkan {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
						    ? $data['kode_akses']['jenis_kode_akses']['full_name_html']
						    : '' !!}
						{{ isset($d->kode_akses) ? $d->kode_akses : '' }}
						untuk Penyelenggaraan {!! isset($data['jenis_layanan_html_nomor']) ? $data['jenis_layanan_html_nomor'] : '' !!}
						kepada:
					</td>
				</tr>
				<tr style="vertical-align:top !important;">
					<td style="padding-left:10px;width:25%;">Nama
						@if ($data['oss_kode'] == 99)
							Instansi
						@elseif ($data['oss_kode'] == 01)
							Perusahaan
						@else
							Perusahaan
						@endif
					</td>
					<td style="width:2%;">:</td>
					<td>{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}</td>
				</tr>
				<tr style="vertical-align:top !important;">
					<td style="padding-left:10px;width:25%;">NIB</td>
					<td style="width:2%;">:</td>
					<td>{{ isset($datanib['nib']) ? $datanib['nib'] : '' }}</td>
				</tr>
				<tr style="vertical-align:top !important;">
					<td style="padding-left:10px;width:25%;">Alamat</td>
					<td style="width:2%;">:</td>
					<td>{{ isset($datanib['alamat_perseroan']) ? $datanib['alamat_perseroan'] : '' }}</td>
				</tr>
				<tr style="vertical-align:top !important;">
					<td style="padding-left:10px;" colspan="3">
						<p>Dalam menggunakan {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
						    ? $data['kode_akses']['jenis_kode_akses']['full_name_html']
						    : '' !!} tersebut di atas,
							{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}
							wajib
							melaporkan
							penggunaannya setiap 1 (satu) tahun sejak
							ditetapkan.
							<br />
							Direktorat Jenderal Penyelenggaraan Pos dan Informatika akan melakukan monitoring
							dan
							evaluasi
							terhadap penggunaan {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
							    ? $data['kode_akses']['jenis_kode_akses']['full_name_html']
							    : '' !!} tersebut.
						</p>
					</td>
				</tr>

			</table>
			<table>
				{{-- <tr>
					<td width="200px;">&nbsp;</td>
					<td>
						Jakarta,
						{{ isset($data['effective_date']) ? $date_reformat->date_lang_reformat_long($data['effective_date']) : '' }}
					</td>
				</tr> --}}
				<tr>
					<td width="200px;">&nbsp;</td>
					<td style="text-align:center;">
						Jakarta,
						{{ isset($data['effective_date']) ? $date_reformat->date_lang_reformat_long($data['effective_date']) : '' }}
						a.n MENTERI KOMUNIKASI DAN INFORMATIKA
						<br />REPUBLIK INDONESIA
						<br />DIREKTUR JENDERAL PENYELENGGARAAN
						<br />POS DAN INFORMATIKA
						<br /> u.b
						<br /> DIREKTUR TELEKOMUNIKASI<br /> <br />
						<img style="width:70px;" src="data:image/png;base64, {!! base64_encode(
						    QrCode::format('svg')->size(100)->generate('https://e-telekomunikasi.komdigi.go.id/validasi-sk/' . $data['id_izin']),
						) !!} ">
						<img style="width:210px;" src="{{ public_path('global_assets/images/TTE Direktur.png') }}">
					</td>
					<td>
						<div class="visible-print text-center">
						</div>
					</td>
				</tr>

			</table>
		@elseif ($d->group_permohonan == 'Perubahan Penetapan')
			{{-- <div class="page-break"></div> --}}

			<div style="text-align:center !important;">
				<img style="width:120px;" src="{{ public_path('global_assets/images/logo_kominfo.png') }}">
			</div>
			<div style="text-align:center !important;">
				{{-- <h2 class="judul">PEMERINTAH REPUBLIK INDONESIA</h2> --}}
				{{-- <h2 class="judul">PERIZINAN BERUSAHA UNTUK MENUNJANG KEGIATAN BERUSAHA</h2> --}}
				{{-- <h4 class="isi">PENOMORAN TELEKOMUNIKASI</h4> --}}
				{{-- <h2 class="judul">PENETAPAN {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
				    ? strtoupper($data['kode_akses']['jenis_kode_akses']['full_name_html'])
				    : '' !!}</h2>
				<h2 class="judul">
					{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}
				</h2>
				<h2 class="judul">Nomor : {{ isset($d->no_sk) ? $d->no_sk : '' }}</h2> --}}
				<h2 class="judul">PENETAPAN {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
				    ? strtoupper($data['kode_akses']['jenis_kode_akses']['full_name_html'])
				    : '' !!}
					<br />
					{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}
					<br />
					Nomor : {{ isset($d->no_sk) ? $d->no_sk : '' }}
				</h2>
			</div>
			<div>
				<table style="text-align: justify !important;width:100%;padding-right:10px;">
					<tr style="vertical-align:top !important;">
						<td width="5%">
							Dasar
						</td>
						<td width="2%">
							:
						</td>
						<td width="2%">
							a.
						</td>
						<td width="91%">
							Peraturan Menteri Komunikasi dan Informatika Nomor 14 Tahun 2018 tentang Rencana
							Dasar
							Teknis
							(<i>Fundamental Technical Plan</i>)
							Telekomunikasi Nasional;
						</td>
					<tr style="vertical-align:top !important;">
						<td width="5%">&nbsp;</td>
						<td width="2%">&nbsp;</td>
						<td width="2%">
							b.
						</td>
						<td width="91%">
							Peraturan Menteri Komunikasi dan Informatika Nomor 5 Tahun 2021 tentang
							Penyelenggaraan
							Telekomunikasi;
						</td>
					</tr>
					<tr style="vertical-align:top !important;">
						<td width="5%">&nbsp;</td>
						<td width="2%">&nbsp;</td>
						<td width="2%">
							c.
						</td>
						<td width="91%">
							Keputusan Menteri Komunikasi dan Informatika Nomor 793 Tahun 2018 tentang Pemberian
							Kewenangan
							Penandatanganan Dokumen Bidang Penyelenggaraan Pos dan Informatika Dalam Rangka
							Pelayanan Prima di
							Lingkungan Direktorat Jenderal Penyelenggaraan Pos dan Informatika;
						</td>
					</tr>
					<tr style="vertical-align:top !important;">
						<td width="5%">&nbsp;</td>
						<td width="2%">&nbsp;</td>
						<td width="2%">
							d.
						</td>
						<td width="91%">
							Keputusan Direktur Jenderal Penyelenggaraan Pos dan Informatika Nomor 167 Tahun 2018
							tentang
							Pemberian Kewenangan Penandatanganan Dokumen Bidang Penyelenggaraan Pos dan
							Informatika
							Dalam Rangka
							Pelayanan Prima di Lingkungan Direktorat Jenderal Penyelenggaraan Pos dan
							Informatika
							sebagaimana
							telah diubah dengan Keputusan Direktur Jenderal Penyelenggaraan Pos dan Informatika
							Nomor 130 Tahun
							2020 tentang Perubahan Keputusan Direktur Jenderal Penyelenggaraan Pos dan
							Informatika
							Nomor 167
							Tahun 2018 tentang Pemberian Kewenangan Penandatanganan Dokumen Bidang
							Penyelenggaraan
							Pos dan
							Informatika Dalam Rangka Pelayanan Prima di Lingkungan Direktorat Jenderal
							Penyelenggaraan Pos dan
							Informatika;
						</td>
					</tr>
					<tr style="vertical-align:top !important;">
						<td width="5%">&nbsp;</td>
						<td width="2%">&nbsp;</td>
						<td width="2%">
							e.
						</td>
						<td width="91%">
							Permohonan Penetapan Penomoran
							{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}
							Nomor
							{{ isset($data['id_permohonan']) ? $data['id_permohonan'] : '' }} tanggal
							{{ isset($data['created_date']) ? $date_reformat->date_lang_reformat_long($data['created_date']) : '' }}.
						</td>
					</tr>
				</table>
			</div>

			<table style="text-align: justify !important;width:100%;padding-right:10px;">
				<tr style="vertical-align:top !important;">
					<td style="padding-left:10px;" colspan="3">
						Menetapkan {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
						    ? $data['kode_akses']['jenis_kode_akses']['full_name_html']
						    : '' !!}
						{{ isset($d->kode_akses) ? $d->kode_akses : '' }}
						untuk Penyelenggaraan {!! isset($data['jenis_layanan_html_nomor']) ? $data['jenis_layanan_html_nomor'] : '' !!}
						kepada:
					</td>
				</tr>
				<tr style="vertical-align:top !important;">
					<td style="padding-left:10px;width:25%;">Nama @if ($data['oss_kode'] == 99)
							Instansi
						@elseif ($data['oss_kode'] == 01)
							Perusahaan
						@else
							Perusahaan
						@endif
					</td>
					<td style="width:1%;">:</td>
					<td>{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}</td>
				</tr>
				<tr style="vertical-align:top !important;">
					<td style="padding-left:10px;width:25%;">NIB</td>
					<td style="width:1%;">:</td>
					<td>{{ isset($datanib['nib']) ? $datanib['nib'] : '' }}</td>
				</tr>
				<tr style="vertical-align:top !important;">
					<td style="padding-left:10px;width:25%;">Alamat</td>
					<td style="width:1%;">:</td>
					<td>{{ isset($datanib['alamat_perseroan']) ? $datanib['alamat_perseroan'] : '' }}</td>
				</tr>
				<tr style="vertical-align:top !important;">
					<td style="padding-left:10px;" colspan="3">
						<p>Dalam menggunakan {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
						    ? $data['kode_akses']['jenis_kode_akses']['full_name_html']
						    : '' !!} tersebut di atas,
							{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}
							wajib
							melaporkan
							penggunaannya setiap 1 (satu) tahun sejak
							ditetapkan.
							<br />
							<br />
							Direktorat Jenderal Penyelenggaraan Pos dan Informatika akan melakukan monitoring
							dan
							evaluasi
							terhadap penggunaan {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
							    ? $data['kode_akses']['jenis_kode_akses']['full_name_html']
							    : '' !!} tersebut.
							<br />
							<br />
							Dengan ditetapkannya Penetapan Penomoran ini, maka penetapan Nomor
							{{ isset($data['pe_no_sk']) ? $data['pe_no_sk'] : '' }} tanggal
							{{ isset($data['pe_date_sk']) ? $date_reformat->date_lang_reformat_long($data['pe_date_sk']) : '' }},
							dicabut dan dinyatakan tidak
							berlaku.
						</p>
					</td>
				</tr>
				{{-- <tr style="vertical-align:top !important;">
					<td style="padding-left:10px;" colspan="3">
						<p>Dalam menggunakan {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
						    ? $data['kode_akses']['jenis_kode_akses']['full_name_html']
						    : '' !!} tersebut di atas,
							{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}
							wajib
							melaporkan
							penggunaannya setiap 1 (satu) tahun sejak
							ditetapkan.
							<br />
							<br />
						Direktorat Jenderal Penyelenggaraan Pos dan Informatika akan melakukan monitoring
							dan
							evaluasi
							terhadap penggunaan {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
							    ? $data['kode_akses']['jenis_kode_akses']['full_name_html']
							    : '' !!} tersebut dan
							{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}
							wajib
							melaporkan
							penggunaannya setiap 1 (satu) tahun sejak
							ditetapkan.
							<br />
							<br />
							Dengan ditetapkannya Penetapan Penomoran ini, maka penetapan Nomor
							{{ isset($data['pe_no_sk']) ? $data['pe_no_sk'] : '' }} tanggal
							{{ isset($data['pe_date_sk']) ? $date_reformat->date_lang_reformat_long($data['pe_date_sk']) : '' }},
							dicabut dan dinyatakan tidak
							berlaku.
						</p>
					</td>
				</tr> --}}
				{{-- <tr style="vertical-align:top !important;">
					<td style="padding-left:10px;" colspan="3">
						Dengan ditetapkannya Penetapan Penomoran ini, maka penetapan Nomor
						{{ isset($data['pe_no_sk']) ? $data['pe_no_sk'] : '' }} tanggal
						{{ isset($data['pe_date_sk']) ? $date_reformat->date_lang_reformat_long($data['pe_date_sk']) : '' }},
						dicabut dan dinyatakan tidak
						berlaku.
					</td>
				</tr> --}}
			</table>
			<table>
				{{-- <tr>
					<td width="200px;">&nbsp;</td>
					<td>
						Jakarta,
						{{ isset($data['effective_date']) ? $date_reformat->date_lang_reformat_long($data['effective_date']) : '' }}
					</td>
				</tr> --}}
				<tr>
					<td width="200px;">&nbsp;</td>
					<td style="text-align:center;">
						Jakarta,
						{{ isset($data['effective_date']) ? $date_reformat->date_lang_reformat_long($data['effective_date']) : '' }}
						a.n MENTERI KOMUNIKASI DAN INFORMATIKA
						<br />REPUBLIK INDONESIA
						<br />DIREKTUR JENDERAL PENYELENGGARAAN
						<br />POS DAN INFORMATIKA
						<br /> u.b
						<br /> DIREKTUR TELEKOMUNIKASI<br /> <br />
						<img style="width:70px;" src="data:image/png;base64, {!! base64_encode(
						    QrCode::format('svg')->size(100)->generate('https://e-telekomunikasi.kominfo.go.id/validasi-sk/' . $data['id_izin']),
						) !!} ">
						<img style="width:210px;" src="{{ public_path('global_assets/images/TTE Direktur.png') }}">
					</td>
					<td>
						<div class="visible-print text-center">
						</div>
					</td>
				</tr>

			</table>
		@else
			{{-- <div class="page-break"></div> --}}

			<div style="text-align:center !important;">
				<img style="width:120px;" src="{{ public_path('global_assets/images/logo_kominfo.png') }}">
			</div>
			<div style="text-align:center !important;">
				{{-- <h2 class="judul">PEMERINTAH REPUBLIK INDONESIA</h2> --}}
				{{-- <h2 class="judul">PERIZINAN BERUSAHA UNTUK MENUNJANG KEGIATAN BERUSAHA</h2> --}}
				{{-- <h4 class="isi">PENOMORAN TELEKOMUNIKASI</h4> --}}
				{{-- <h2 class="judul">PENCABUTAN PENETAPAN {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
				    ? strtoupper($data['kode_akses']['jenis_kode_akses']['full_name_html'])
				    : '' !!}</h2>
				<h2 class="judul">
					{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}
				</h2>
				<h2 class="judul">Nomor : {{ isset($d->no_sk) ? $d->no_sk : '' }}</h2> --}}
				<h2 class="judul">PENETAPAN {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
				    ? strtoupper($data['kode_akses']['jenis_kode_akses']['full_name_html'])
				    : '' !!}
					<br />
					{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}
					<br />
					Nomor : {{ isset($d->no_sk) ? $d->no_sk : '' }}
				</h2>
			</div>
			<div>
				<table style="text-align: justify !important;width:100%;padding-top:20px;padding-right:10px;padding-bottom:20px;">
					<tr style="vertical-align:top !important;">
						<td width="5%">
							Dasar
						</td>
						<td width="2%">
							:
						</td>
						<td width="2%">
							a.
						</td>
						<td width="91%">
							Peraturan Menteri Komunikasi dan Informatika Nomor 14 Tahun 2018 tentang Rencana
							Dasar
							Teknis
							(<i>Fundamental Technical Plan</i>)
							Telekomunikasi Nasional;
						</td>
					<tr style="vertical-align:top !important;">
						<td width="5%">&nbsp;</td>
						<td width="2%">&nbsp;</td>
						<td width="2%">
							b.
						</td>
						<td width="91%">
							Peraturan Menteri Komunikasi dan Informatika Nomor 5 Tahun 2021 tentang
							Penyelenggaraan
							Telekomunikasi;
						</td>
					</tr>
					<tr style="vertical-align:top !important;">
						<td width="5%">&nbsp;</td>
						<td width="2%">&nbsp;</td>
						<td width="2%">
							c.
						</td>
						<td width="91%">
							Keputusan Menteri Komunikasi dan Informatika Nomor 793 Tahun 2018 tentang Pemberian
							Kewenangan
							Penandatanganan Dokumen Bidang Penyelenggaraan Pos dan Informatika Dalam Rangka
							Pelayanan Prima di
							Lingkungan Direktorat Jenderal Penyelenggaraan Pos dan Informatika;
						</td>
					</tr>
					<tr style="vertical-align:top !important;">
						<td width="5%">&nbsp;</td>
						<td width="2%">&nbsp;</td>
						<td width="2%">
							d.
						</td>
						<td width="91%">
							Keputusan Direktur Jenderal Penyelenggaraan Pos dan Informatika Nomor 167 Tahun 2018
							tentang
							Pemberian Kewenangan Penandatanganan Dokumen Bidang Penyelenggaraan Pos dan
							Informatika
							Dalam Rangka
							Pelayanan Prima di Lingkungan Direktorat Jenderal Penyelenggaraan Pos dan
							Informatika
							sebagaimana
							telah diubah dengan Keputusan Direktur Jenderal Penyelenggaraan Pos dan Informatika
							Nomor 130 Tahun
							2020 tentang Perubahan Keputusan Direktur Jenderal Penyelenggaraan Pos dan
							Informatika
							Nomor 167
							Tahun 2018 tentang Pemberian Kewenangan Penandatanganan Dokumen Bidang
							Penyelenggaraan
							Pos dan
							Informatika Dalam Rangka Pelayanan Prima di Lingkungan Direktorat Jenderal
							Penyelenggaraan Pos dan
							Informatika;
						</td>
					</tr>
					<tr style="vertical-align:top !important;">
						<td width="5%">&nbsp;</td>
						<td width="2%">&nbsp;</td>
						<td width="2%">
							e.
						</td>
						<td width="91%">
							Permohonan Pengembalian Penetapan Penomoran
							{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}
							Nomor
							{{ isset($data['id_permohonan']) ? $data['id_permohonan'] : '' }} tanggal
							{{ isset($data['created_date']) ? $date_reformat->date_lang_reformat_long($data['created_date']) : '' }}.
						</td>
					</tr>
				</table>
			</div>

			<table style="text-align: justify !important;width:100%;padding-right:10px;">
				<tr style="vertical-align:top !important;">
					<td style="padding-left:10px;" colspan="3">

						Bahwa
						{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }}
						telah mengembalikan {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
						    ? $data['kode_akses']['jenis_kode_akses']['full_name_html']
						    : '' !!}
						{{-- {{ isset($data['kode_akses']['kode_akses']) ? $data['kode_akses']['kode_akses'] : '' }} --}}

						{{ isset($d->kode_akses) ? $d->kode_akses : '' }}
						berdasarkan permohonan pengembalian penetapan penomoran nomor
						{{ isset($data['id_permohonan']) ? $data['id_permohonan'] : '' }}
						tanggal
						{{ isset($data['created_date']) ? $date_reformat->date_lang_reformat_long($data['created_date']) : '' }}.

					</td>
				</tr>
				<tr style="vertical-align:top !important;">
					<td style="padding-left:10px;" colspan="3">

						Berdasarkan hal tersebut, maka penetapan penggunaan {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
						    ? $data['kode_akses']['jenis_kode_akses']['full_name_html']
						    : '' !!}
						{{ isset($d->kode_akses) ? $d->kode_akses : '' }}
						sebagaimana ditetapkan pada penetapan {!! isset($data['kode_akses']['jenis_kode_akses']['full_name_html'])
						    ? $data['kode_akses']['jenis_kode_akses']['full_name_html']
						    : '' !!} Nomor
						{{ isset($data['pe_no_sk']) ? $data['pe_no_sk'] : '' }} tanggal
						{{ isset($data['pe_date_sk']) ? $date_reformat->date_lang_reformat_long($data['pe_date_sk']) : '' }},
						dicabut dan
						dinyatakan tidak
						berlaku.

					</td>
				</tr>
				@if ($data['kd_izin'] == '059000000052')
					<tr style="vertical-align:top !important;">
						<td style="padding-left:10px;" colspan="3">

							{{ isset($data['nama_perseroan']) ? strtoupper($data['nama_perseroan']) : '' }} wajib menginformasikan kepada
							pihak-pihak terkait untuk menonaktifkan kode akses
							{{ isset($d->kode_akses) ? $d->kode_akses : '' }}
							dan menghapus kode akses tersebut pada semua media informasi yang tersedia.

						</td>
					</tr>
				@endif

			</table>
			<table style="text-align: justify !important;width:100%;padding-right:10px;">
				{{-- <tr>
					<td width="200px;">&nbsp;</td>
					<td>
						Jakarta,
						{{ isset($data['effective_date']) ? $date_reformat->date_lang_reformat_long($data['effective_date']) : '' }}
					</td>
				</tr> --}}
				<tr>
					<td width="200px;">&nbsp;</td>
					<td style="text-align:center;">
						Jakarta,
						{{ isset($data['effective_date']) ? $date_reformat->date_lang_reformat_long($data['effective_date']) : '' }}
						a.n MENTERI KOMUNIKASI DAN INFORMATIKA
						<br />REPUBLIK INDONESIA
						<br />DIREKTUR JENDERAL PENYELENGGARAAN
						<br />POS DAN INFORMATIKA
						<br /> u.b
						<br /> DIREKTUR TELEKOMUNIKASI<br /> <br />
						<img style="width:70px;" src="data:image/png;base64, {!! base64_encode(
						    QrCode::format('svg')->size(100)->generate('https://e-telekomunikasi.kominfo.go.id/validasi-sk/' . $data['id_izin']),
						) !!} ">
						<img style="width:210px;" src="{{ public_path('global_assets/images/TTE Direktur.png') }}">
					</td>
					<td>
						<div class="visible-print text-center">
						</div>
					</td>
				</tr>

			</table>
		@endif

		@if (!$loop->last)
			<div class="page-break"></div>
		@endif
	@endforeach

</body>

</html>
