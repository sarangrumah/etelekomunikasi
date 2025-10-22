@extends('layouts.backend.main')
@section('js')
	<script src="{{ url('global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script src="{{ url('global_assets/js/demo_pages/form_layouts.js') }}"></script>
@endsection
@section('content')
	<div id="loadingSpinner" class="loading-spinner loading-spinner-init" nonce="unique-nonce-value">
		<img id="spinnerImage" src="/assets/kominfo/spinner-kominfo-trp.svg" alt="Loading Spinner">
	</div>
	<style nonce="unique-nonce-value">
		.loading-select {
			position: absolute;
			right: -75px;
			bottom: -60%;
			transform: translateY(-50%);
		}

		.loading-spinner {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(255, 255, 255, 0.8);
			/* Semi-transparent white background */
			z-index: 9999;
			/* Ensures the spinner is on top of other content */
			justify-content: center;
			align-items: center;
			display: flex;
		}

		.loading-spinner-init {
			display: none;
		}
	</style>
	<form method="post" id="formEvaluasi"
		action="{{ route('admin.evaluator.evaluasi-penomoran-post', [$id, $penomoran['id_kode_akses']]) }}"
		enctype="multipart/form-data">
		@csrf

		<input type="hidden" id="id_izin" name="id_izin" value="{{ $penomoran['id_izin'] }}" />
		<input type="hidden" id="id_kodeakses" name="id_kodeakses" value="{{ $penomoran['id_kode_akses'] }}" />
		<div class="form-group">
			<!-- Section Detail Permohonan -->

			<!-- Section Detail Perusahaan -->
			<div>
				<div class="card">
					<div class="card-header bg-indigo text-white header-elements-inline">
						<div class="row">
							<div class="col-lg">
								<h6 class="card-title font-weight-semibold py-3">Informasi Pemohon </h6>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="form-group row">
							<div class="col">
								<legend class="text-uppercase font-size-sm font-weight-bold">Data Perusahaan/Instansi
								</legend>
								@if ($detailnib['status_badan_hukum'] != '03')
									<div class="form-group">
										<div class="col-lg-12">
											<div class="row">
												<label class="col-lg-4 col-form-label">NIB </label>
												<div class="input-group col-lg-8">
													<input type="text" class="col-lg form-control" value="{{ $detailnib['nib'] }}" disabled>
													<span class="input-group-append">
														{{-- <button class="btn btn-light" type="button">Button</button>
                                                     --}}
														<a target="_blank" href="{{ asset($detailnib->path_berkas_nib) }}" class="btn btn-teal"
															type="button">Lihat Dokumen</a>
													</span>
												</div>
											</div>
											{{-- <div class="row">
                                            <label class="col-lg-4 col-form-label">NIB </label>
                                            <div class="col-lg">
                                                <label class="col-lg col-form-label">: {{ $detailnib['nib'] }}</label>
                                                <input type="text" class="form-control" value="{{ $detailnib['nib'] }}"
                                                    disabled>
                                            </div>
                                            <div class="col-lg">
                                                <input type="text" class="form-control border-right-0"
                                            value="{{ $detailnib->path_berkas_nib }}" placeholder="Dokumen NIB" disabled>
                                                <span>
                                                    <a target="_blank" href="{{ asset($detailnib->path_berkas_nib) }}"
                                                        class="btn btn-teal" type="button">Lihat Dokumen</a>
                                                </span>
                                            </div>
                                        </div> --}}
										</div>
									</div>
								@endif
								<div class="form-group">
									<div class="col-lg-12">
										<div class="row">
											<label class="col-lg-4 col-form-label">Nama </label>
											<div class="col-lg">
												{{-- <label class="col-lg col-form-label">:
                                                {{ $detailnib['nama_perseroan'] }}</label> --}}
												<input type="text" class="form-control" value="{{ $detailnib['nama_perseroan'] }}" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
										<div class="row">
											<label class="col-lg-4 col-form-label">NPWP </label>
											<div class="col-lg">
												{{-- <label class="col-lg col-form-label">:
                                                {{ $detailnib['npwp_perseroan'] }}</label> --}}
												<input type="text" class="form-control" value="{{ $detailnib['npwp_perseroan'] }}" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
										<div class="row">
											<label class="col-lg-4 col-form-label">No Telp/Mobile </label>
											<div class="col-lg">
												{{-- <label class="col-lg col-form-label">:
                                                {{ isset($penanggungjawab['hp_user_proses']) ? $penanggungjawab['hp_user_proses'] : '-' }}</label> --}}

												<input type="text" class="form-control"
													value="{{ isset($detailnib['nomor_telpon_perseroan']) ? $detailnib['nomor_telpon_perseroan'] : '-' }}"
													disabled>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col">
								<legend class="text-uppercase font-size-sm font-weight-bold">Data Penanggung Jawab</legend>
								<div class="form-group">
									<div class="col-lg-12">
										<div class="row">
											<label class="col-lg-4 col-form-label">NIK </label>

											<div class="col-lg">
												{{-- <label class="col-lg col-form-label">:
                                                    {{ isset($penanggungjawab['no_ktp']) ? $penanggungjawab['no_ktp'] : '-' }}
                                                </label> --}}
												<input type="text" class="form-control"
													value="{{ isset($penanggungjawab['no_ktp']) ? $penanggungjawab['no_ktp'] : '-' }}" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
										<div class="row">
											<label class="col-lg-4 col-form-label">Email </label>
											<div class="col-lg">
												{{-- <label class="col-lg col-form-label">:
                                                    {{ isset($penanggungjawab['email_user_proses']) ? $penanggungjawab['email_user_proses'] : '-' }}</label> --}}

												<input type="text" class="form-control"
													value="{{ isset($penanggungjawab['email_user_proses']) ? $penanggungjawab['email_user_proses'] : '-' }}"
													disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
										<div class="row">
											<label class="col-lg-4 col-form-label">Nama </label>
											<div class="col-lg">
												{{-- <label class="col-lg col-form-label">:
                                                    {{ isset($penanggungjawab['nama_user_proses']) ? $penanggungjawab['nama_user_proses'] : '-' }}
                                                </label> --}}
												<input type="text" class="form-control"
													value="{{ isset($penanggungjawab['nama_user_proses']) ? $penanggungjawab['nama_user_proses'] : '-' }}"
													disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
										<div class="row">
											<label class="col-lg-4 col-form-label">No Telp </label>
											<div class="col-lg">
												{{-- <label class="col-lg col-form-label">:
                                                    {{ $detailnib['nomor_telpon_perseroan'] }}</label> --}}

												<input type="text" class="form-control"
													value="{{ isset($penanggungjawab['hp_user_proses']) ? $penanggungjawab['hp_user_proses'] : '-' }}"
													disabled>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Section Detail Perusahaan -->

			<input type="hidden" id="id_izin" name="id_izin" value="{{ $penomoran['id_izin'] }}">
			<div>
				<div class="card">
					<div class="card-header bg-indigo text-white header-elements-inline">
						<div class="row">
							<div class="col-lg">
								<h6 class="card-title font-weight-semibold py-3">Informasi Permohonan </h6>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="form-group row">
							<div class="col-lg-6">

								<legend class="text-uppercase font-size-sm font-weight-bold">Data Permohonan
								</legend>
								<div class="form-group">
									<div class="col-lg-12">
										<div class="row">
											<label class="col-lg-4 col-form-label">No Permohonan </label>
											<div class="col-lg">
												{{-- <label class="col-lg col-form-label">: {{ $penomoran['id_izin'] }}</label> --}}
												<input type="text" class="form-control" value="{{ $penomoran['id_izin'] }}" disabled>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
										<div class="row">
											<label class="col-lg-4 col-form-label">Tanggal Permohonan </label>
											<div class="col-lg">
												@if ($penomoran['updated_date'] == null)
													<input type="text" class="form-control" value="-" disabled>
												@else
													{{-- <label class="col-lg col-form-label">:
                                                    {{ $date_reformat->date_lang_reformat_long($penomoran['updated_date']) }}
                                                </label> --}}
													<input type="text" class="form-control"
														value="{{ $date_reformat->date_lang_reformat_long($penomoran['updated_date']) }}" disabled>
												@endif
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
										<div class="row">
											<label class="col-lg-4 col-form-label">Jenis Permohonan </label>
											<div class="col-lg">

												@if ($penomoran['jenis_permohonan'] == 'Perubahan Penetapan')
													<input type="text" class="form-control" value="{{ isset($note) ? $note : '' }}" disabled>
												@else
													<input type="text" class="form-control"
														value="{{ isset($penomoran['jenis_permohonan']) ? $penomoran['jenis_permohonan'] : '' }}" disabled>
												@endif
											</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-lg-12">
										<div class="row">
											<label class="col-lg-4 col-form-label">Status Permohonan </label>
											<div class="col-lg">
												{{-- <label class="col-lg col-form-label">:
                                                {{ isset($penomoran['kode_izin']['name_status_bo']) ? $penomoran['kode_izin']['name_status_bo'] : '' }}</label> --}}
												<input type="text" class="form-control"
													value="{{ isset($penomoran['kode_izin']['name_status_bo']) ? $penomoran['kode_izin']['name_status_bo'] : '' }}"
													disabled>
											</div>
										</div>
									</div>
								</div>
							</div>
							@if ($penomoran['status_badan_hukum'] != '03')
								<div class="col-lg-6">

									<legend class="text-uppercase font-size-sm font-weight-bold">Data Perizinan</legend>

									<div class="form-group">
										<div class="col-lg-12">
											<div class="row">
												<label class="col-lg-4 col-form-label">Perizinan </label>
												<div class="col-lg">
													{{-- <label class="col-lg col-form-label">:
                                                {{ isset($penomoran['jenis_izin']) ? $penomoran['jenis_izin'] : '' }}</label> --}}
													<input type="text" class="form-control"
														value="{{ isset($penomoran['jenis_izin']) ? $penomoran['jenis_izin'] : '' }}" disabled>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-12">
											<div class="row">
												<label class="col-lg-4 col-form-label">KBLI</label>
												<div class="col-lg">
													{{-- <label class="col-lg col-form-label">:
                                                {{ isset($penomoran['full_kbli']) ? $penomoran['full_kbli'] : '' }}
                                            </label> --}}
													<input type="text" class="form-control"
														value="{{ isset($penomoran['full_kbli']) ? $penomoran['full_kbli'] : '' }}" disabled>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-lg-12">
											<div class="row">
												<label class="col-lg-4 col-form-label">Jenis Layanan </label>
												<div class="col-lg">
													{{-- <label class="col-lg col-form-label">:
                                                {{ isset($penomoran['jenis_layanan']) ? $penomoran['jenis_layanan'] : '' }}</label> --}}
													<input type="text" class="form-control" value="{!! $penomoran['jenis_layanan_html_nomor'] !!}" disabled>
												</div>
											</div>
										</div>
									</div>
								</div>
							@endif
						</div>
					</div>
				</div>

			</div>
			<!-- End Section Detail Permohonan -->

		</div>
		<div class="form-group">

			<div class="card">
				<div class="card-header bg-indigo text-white header-elements-inline">
					<div class="row">
						<div class="col-lg">
							<h6 class="card-title font-weight-semibold py-3">Evaluasi Permohonan </h6>
						</div>
					</div>
				</div>
				<div class="card-body">
					<input type="hidden" name="id_izin" value="{{ $penomoran['id_izin'] }}">
					<legend class="text-uppercase font-size-sm font-weight-bold">Data Penomoran</legend>
					<div class="form-group row">
						<div class="col-lg-6">
							<div class="form-group row">
								<label class="col-lg-4 col-form-label">Jenis Penomoran </label>
								<div class="col-lg-8">
									<input type="text" class="form-control"
										value="{{ isset($penomoran['kode_akses']['jenis_penomoran']) ? $penomoran['kode_akses']['jenis_penomoran'] : '' }}"
										disabled>
								</div>
							</div>
							@if ($penomoran['kode_akses']['jenis_penomoran'] != 'Blok Nomor')
								@if ($penomoran['jenis_permohonan'] == 'Perubahan Penetapan')
									<div class="form-group row">
										<label class="col-lg-4 col-form-label">Kode Akses</label>
										<div class="col-lg-8">
											<input type="text" class="form-control"
												value="{{ isset($penomoran['kode_akses']['kode_akses']) ? $penomoran['kode_akses']['kode_akses'] : '' }}"
												disabled>
										</div>
									</div>
								@endif
							@endif

						</div>
						@if ($penomoran['kode_akses']['jenis_penomoran'] != 'Blok Nomor')
							@if ($penomoran['jenis_permohonan'] != 'Perubahan Penetapan')
								<div class="col-lg-6">

									<div class="form-group row">
										<label class="col-lg-4 col-form-label">Kode Akses</label>
										<div class="col-lg-8">
											<input type="text" class="form-control"
												value="{{ isset($penomoran['kode_akses']['kode_akses']) ? $penomoran['kode_akses']['kode_akses'] : '' }}"
												disabled>
										</div>
									</div>
								</div>
							@endif
						@endif
						@if ($penomoran['kode_akses']['jenis_penomoran'] != 'Blok Nomor')
							@if ($penomoran['jenis_permohonan'] == 'Perubahan Penetapan')
								<div class="col-lg-6">
									<div class="col-lg-12 row">
										<div class="col-lg-4 form-group">
											<label class="col-form-label">No SK Penetapan</label>
										</div>
										<div class="col-lg-8 form-group">
											<input type="text" class="form-control" name="no_sk" id="no_sk"
												value="{{ $penomoran['pe_no_sk'] }}">
										</div>
									</div>
									<div class="col-lg-12 row">
										<div class="col-lg-4 form-group">
											<label class="col-form-label">Tanggal Penetapan </label>
										</div>
										<div class="col-lg-8 form-group">
											<input type="date" class="form-control" name="tgl_sk" id="tgl_sk"
												value="{{ $penomoran['pe_date_sk'] }}">
										</div>
									</div>
								</div>
							@endif
						@endif
					</div>

					@if ($penomoran['kode_akses']['jenis_penomoran'] == 'Blok Nomor')
						<div class="form-group row">
							<div class="col-lg-12">
								<div class="form-group row">
									<label class="col-lg-2 col-form-label">Daftar Blok Nomor </label>
									<div class="col-lg-8" id="PilihKodeWilayah">
										<table class="text-center table table-custom table-sm">
											<thead>
												<tr>
													<th class="col-3">
														Wilayah</th>
													<th class="col-3">
														Kode
														Wilayah</th>
													<th class="col-3">
														Blok Nomor
													</th>
													<th class="col-3">
														Status Evaluasi
													</th>
												</tr>

											</thead>
											<tbody id="bloknomor-lists">
												@foreach ($penomoran_bloknomor as $item => $d)
													<input type="hidden" name="bloknomor[{{ $item }}][bn_kode_wilayah]"
														value={{ $d['kode_wilayah'] }}>
													<input type="hidden" name="bloknomor[{{ $item }}][bn_prefix_awal]"
														value={{ $d['prefix_awal'] }}>
													<tr class="bloknomor-item">
														<td class="col-4">
															<div class="font-size-sm">
																{{-- {{ $d['nama_wilayah'] }} --}}
																<input type="text" id="nama_wilayah[{{ $item }}]" class="form-control"
																	value="{{ $d['nama_wilayah'] }}">
															</div>
														</td>
														<td class="col-3">
															<div class="font-size-sm">
																{{-- {{ $d['kode_wilayah'] }} --}}
																<input type="text" id="kode_wilayah[{{ $item }}]" class="form-control"
																	value="{{ $d['kode_wilayah'] }}">
															</div>
														</td>
														<td class="col-3">
															<div class="font-size-sm">
																{{-- {{ $d['prefix_awal'] }} --}}
																<input type="text" id="prefix_awal[{{ $item }}]" class="form-control"
																	value="{{ $d['prefix_awal'] }}">
															</div>
														</td>
														<td class="col-1">
															<div>
																<select name="bloknomor[{{ $item }}][is_deleted]"
																	id="bloknomor[{{ $item }}][is_deleted]" onchange="updateDatabase({{ $item }})"
																	class="form-control bloknomor-isdeleted required" placeholder="Silakan Pilih" required>
																	<option value="" selected disabled>-- Pilih Evaluasi --</option>
																	<option value="1">Setuju</option>
																	<option value="2">Ditolak</option>
																</select>
															</div>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>

						</div>
					@else
						{{-- <div class="col-6">
                            <div class="col-lg-12 row">
                                <label class="col-lg-4 col-form-label">Kode Akses </label>
                                <div class="col-lg-8 form-group">
                                    <input type="text" class="form-control"
                                        value="{{ isset($penomoran['kode_akses']['kode_akses']) ? $penomoran['kode_akses']['kode_akses'] : '' }}"
                                        disabled>
                                </div>
                            </div>
                        </div> --}}
					@endif

					{{-- <hr /> --}}

					@if ($penomoran['jenis_permohonan'] == 'Penetapan Nomor Tambahan')
						<legend class="text-uppercase font-size-sm font-weight-bold">Data Kelengkapan</legend>
						<div class="form-group row">
							<?php
							// $file = explode('/', $penomoran['dok_pengguna_penomoran']);
							if (isset($penomoran['dok_pengguna_penomoran']) && $penomoran['dok_pengguna_penomoran'] != '') {
							    $file = explode('/', $penomoran['dok_pengguna_penomoran']);
							    $file = $file[3];
							} else {
							    $file = '';
							}
							if (isset($penomoran['dok_izin_penyelenggaraan']) && $penomoran['dok_izin_penyelenggaraan'] != '') {
							    $_file4 = explode('/', $penomoran['dok_izin_penyelenggaraan']);
							    $file4 = $_file4[3];
							} else {
							    $file4 = '';
							}
							if (isset($penomoran['dok_kode_akses_konten']) && $penomoran['dok_kode_akses_konten'] != '') {
							    $_file5 = explode('/', $penomoran['dok_kode_akses_konten']);
							    $file5 = $_file5[3];
							} else {
							    $file5 = '';
							}
							
							// $file4 = $file4;
							
							?>
							@if (isset($penomoran['dok_izin_penyelenggaraan']) && $penomoran['dok_izin_penyelenggaraan'] != '')
								<div class="col-lg-6">
									<div class="row">
										<div class="col-12">
											<p class="font-weight-semibold">Dokumen Perizinan Berusaha</p>
											<div class="input-group">
												<input disabled="disabled" type="text" class="form-control border-right-0"
													placeholder="{{ $file4 }}">
												<span class="input-group-append">
													<a target="_blank" href="{{ asset($penomoran['dok_izin_penyelenggaraan']) }}" class="btn btn-teal"
														type="button">Lihat Dokumen</a>
												</span>
											</div>
										</div>
									</div>
								</div>
							@endif
							@if (isset($penomoran['dok_kode_akses_konten']) && $penomoran['dok_kode_akses_konten'] != '')
								<div class="col-lg-6">
									<div class="row">
										<div class="col-12">
											<p class="font-weight-semibold">Penjelasan Singkat (<i>Product Brief</i>) untuk
												Layanan Baru </p>
											<div class="input-group">
												<input disabled="disabled" type="text" class="form-control border-right-0"
													placeholder="{{ $file5 }}">
												<span class="input-group-append">
													<a target="_blank" href="{{ asset($penomoran['dok_kode_akses_konten']) }}" class="btn btn-teal"
														type="button">Lihat Dokumen</a>
												</span>
											</div>
										</div>
									</div>
								</div>
							@endif
							<div class="col-lg-6">
								<div class="row">
									<div class="col-12">
										<p class="font-weight-semibold">Laporan Penggunaan Penomoran Yang Pernah Ditetapkan
										</p>
										<div class="input-group">
											<input disabled="disabled" type="text" class="form-control border-right-0"
												placeholder="{{ $file }}">
											<span class="input-group-append">
												<a target="_blank" href="{{ asset($penomoran['dok_pengguna_penomoran']) }}" class="btn btn-teal"
													type="button">Lihat Dokumen</a>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>

						{{-- @if (strtolower($penomoran['kd_izin']) == '059000000033')
							<div
								class="form-group row <?= strtolower($penomoran['jenis_layanan']) == 'sertifikat penyelenggaraan jasa konten sms premium' ? 'd-blok' : 'd-none' ?>">
								<?php
								if (isset($penomoran['dok_kode_akses_konten']) && $penomoran['dok_kode_akses_konten'] != '') {
								    $_file2 = explode('/', $penomoran['dok_kode_akses_konten']);
								    $file2 = $_file2[3];
								} else {
								    $file2 = '';
								}
								
								// $file2 = $file2;
								
								//
								
								?>
								<div class="col-lg-6">
									<div class="row">
										<div class="col-12">
											<p class="font-weight-semibold">Penjelasan Singkat (Produk brief) Layanan
												Baru
											</p>
											<div class="input-group">
												<input disabled="disabled" type="text" class="form-control border-right-0"
													placeholder="{{ $file2 }}">
												<span class="input-group-append">
													<a target="_blank" href="{{ asset($penomoran['dok_kode_akses_konten']) }}" class="btn btn-teal"
														type="button">Lihat Dokumen</a>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endif --}}

						@if (strtolower($penomoran['kd_izin']) == '059000000052')
							<div class="form-group row">
								<?php
								if (isset($penomoran['dok_call_center']) && $penomoran['dok_call_center'] != '') {
								    $_file3 = explode('/', $penomoran['dok_call_center']);
								    $file3 = $_file3[3];
								} else {
								    $file3 = '';
								}
								
								// $file3 = $file3;
								
								?>
								<div class="col-lg-12">
									<div class="row">
										<div class="col-6">
											<p class="font-weight-semibold">Surat dukungan dari calon pengguna untuk
												pengajuan kode
												akses call center</p>
											<div class="input-group">
												<input disabled="disabled" type="text" class="form-control border-right-0"
													placeholder="{{ $file3 }}">
												<span class="input-group-append">
													<a target="_blank" href="{{ asset($penomoran['dok_call_center']) }}" class="btn btn-teal"
														type="button">Lihat Dokumen</a>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endif
					@elseif($penomoran['jenis_permohonan'] == 'Perubahan Penetapan')
						<?php
						if (isset($penomoran['pe_dok_sk']) && $penomoran['pe_dok_sk'] != '') {
						    $file_sk = explode('/', $penomoran['pe_dok_sk']);
						    $file_sk = $file_sk[3];
						} else {
						    $file_sk = '';
						}
						if (isset($penomoran['pe_dok_perizinan_terakhir']) && $penomoran['pe_dok_perizinan_terakhir'] != '') {
						    $file_skizin = explode('/', $penomoran['pe_dok_perizinan_terakhir']);
						    $file_skizin = $file_skizin[3];
						} else {
						    $file_skizin = '';
						}
						if (isset($penomoran['pe_dok_pendukung']) && $penomoran['pe_dok_pendukung'] != '') {
						    $file_dokduk = explode('/', $penomoran['pe_dok_pendukung']);
						    $file_dokduk = $file_dokduk[3];
						} else {
						    $file_dokduk = '';
						}
						?>
						<legend class="text-uppercase font-size-sm font-weight-bold">Data Kelengkapan</legend>
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="form-group row">
									<label class="col-lg-4 col-form-label">SK Penetapan Penomoran </label>
									<div class="col-lg-8">
										<div class="input-group">
											<input disabled="disabled" type="text" class="form-control border-right-0"
												placeholder="{{ $file_sk }}">
											<span class="input-group-append">
												<a target="_blank" href="{{ asset($penomoran['pe_dok_sk']) }}" class="btn btn-teal" type="button">Lihat
													Dokumen</a>
											</span>
										</div>
									</div>
								</div>
								@if ($penomoran['status_badan_hukum'] != '03')
									<div class="form-group row">
										<label class="col-lg-4 col-form-label">SK Perizinan Berusaha </label>
										<div class="col-lg-8">
											<div class="input-group">
												<input disabled="disabled" type="text" class="form-control border-right-0"
													placeholder="{{ $file_skizin }}">
												<span class="input-group-append">
													<a target="_blank" href="{{ asset($penomoran['pe_dok_perizinan_terakhir']) }}" class="btn btn-teal"
														type="button">Lihat Dokumen</a>
												</span>
											</div>
										</div>
									</div>
								@endif

								<div class="form-group row">
									<label class="col-lg-4 col-form-label">Dokumen Pendukung Perubahan Penetapan Penomoran
									</label>
									<div class="col-lg-8">
										<div class="input-group">
											<input disabled="disabled" type="text" class="form-control border-right-0"
												placeholder="{{ $file_dokduk }}">
											<span class="input-group-append">
												<a target="_blank" href="{{ asset($penomoran['pe_dok_pendukung']) }}" class="btn btn-teal"
													type="button">Lihat Dokumen</a>
											</span>
										</div>
									</div>
								</div>

							</div>
						</div>

						{{-- <hr class="" /> --}}
					@elseif($penomoran['jenis_permohonan'] == 'Pengembalian Penomoran')
						<legend class="text-uppercase font-size-sm font-weight-bold">Data Kelengkapan</legend>
						<div class="form-group row">
							<?php
							if (isset($penomoran['pe_dok_sk']) && $penomoran['pe_dok_sk'] != '') {
							    $file_sk = explode('/', $penomoran['pe_dok_sk']);
							    $file_sk = $file_sk[3];
							} else {
							    $file_sk = '';
							}
							?>
							<div class="col-lg-6">
								<div class="form-group row">
									<label class="col-lg-4 col-form-label">No SK Penetapan </label>
									<div class="col-lg-8">
										<input name="no_sk" id="no_sk" type="text" class="form-control"
											value="{{ $penomoran['pe_no_sk'] }}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-4 col-form-label">Tanggal Penetapan </label>
									<div class="col-lg-8">
										<input type="date" class="form-control" name="tgl_sk" id="tgl_sk"
											value="{{ $penomoran['pe_date_sk'] }}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-4 col-form-label">Lampiran Penetapan </label>
									<div class="col-lg-8">
										<div class="input-group">
											<input disabled="disabled" type="text" class="form-control border-right-0"
												placeholder="{{ $file_sk }}">
											<span class="input-group-append">
												<a target="_blank" href="{{ asset($penomoran['pe_dok_sk']) }}" class="btn btn-teal" type="button">Lihat
													Dokumen</a>
											</span>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-8 col-form-label" id="lbl_kdakses">Kode Akses dalam
										Data Penetapan</label>
									<div class="col-lg-12" id="PilihKodeWilayah">
										<table class="table table-custom table-sm">

											<tbody id="bloknomor-lists">
												@for ($i = 0; $i < 1; $i++)
													<tr class="kodeakses_hapus-item">
														<td class="col-3">
															<input type="hidden" name="kodeakses_hapus[{{ $i }}][kode_akses]"
																value={{ isset($penomoran['kode_akses']['kode_akses']) ? $penomoran['kode_akses']['kode_akses'] : '' }}>
															<input type="hidden" name="kodeakses_hapus[{{ $i }}][status_pe_sk]" value="2">
															<input disabled type="text" class="form-control pilih-bloknomor" {{-- name="kodeakses_hapus[{{ $i }}][kode_akses]" --}}
																placeholder="{{ isset($penomoran['kode_akses']['kode_akses']) ? $penomoran['kode_akses']['kode_akses'] : '' }}"
																value={{ isset($penomoran['kode_akses']['kode_akses']) ? $penomoran['kode_akses']['kode_akses'] : '' }} />
														</td>
														<td class="col-6">
															<select {{-- name="kodeakses_hapus[{{ $i }}][status_pe_sk]" --}} class="form-control pilih-status_pe_sk" disabled>
																<option value="1">Penetapan Ulang</option>
																<option value="2" selected>Pencabutan</option>
															</select>
														</td>
														<td class="col-1">
															<button type="button" class="btn btn-success add-kodeakses" id="add-kodeakses"><i
																	class="icon-plus3"></i></button>
														</td>
													</tr>
												@endfor
												@if (isset($vw_kodeakses_additional))
													@foreach ($vw_kodeakses_additional_nonarray as $item => $d)
														{{-- @for ($i = 0; $i < $vw_kodeakses_additional_count; $i++) --}}
														<tr class="kodeakses_hapus-item">
															<td class="col-3">
																<input type="text" class="form-control pilih-bloknomor"
																	name="kodeakses_re[{{ $d }}][kode_akses]"
																	placeholder="{{ isset($d['kode_akses']) ? $d['kode_akses'] : '' }}"
																	value={{ isset($d['kode_akses']) ? $d['kode_akses'] : '' }}
																	@if ($penomoran['kode_akses']['kode_akses'] == $d['kode_akses']) disabled @endif />
															</td>
															<td class="col-6">
																<select name="kodeakses_re[{{ $d }}][status_pe_sk]" class="form-control pilih-status_pe_sk"
																	@if ($penomoran['kode_akses']['kode_akses'] == $d['kode_akses']) disabled @endif>
																	<option value="1" @if ($d['status_permohonan'] == '302') selected @endif>
																		Penetapan Ulang</option>
																	<option value="2" @if ($d['status_permohonan'] == '301') selected @endif>
																		Pencabutan</option>
																</select>
															</td>
															@if ($penomoran['kode_akses']['kode_akses'] == $d['kode_akses'])
																<td class="col-1">
																	<button type="button" class="btn btn-success btn-small add-kodeakses" id="add-kodeakses"><i
																			class="icon-plus3"></i></button>
																</td>
															@else
																<td>
																	<button class="btn btn-danger btn-small btn-delete-kodeakses" id="btn-delete-kodeakses"
																		type="button"><i class="icon-minus3"></i></button>
																</td>
															@endif
														</tr>
														{{-- @endfor --}}
													@endforeach
												@endif
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group row">
									<label class="col-lg-6 col-form-label">Alasan Pengembalian </label>
									{{-- </div>
                                <div class="form-group row"> --}}
									<textarea disabled="disabled" rows="6" cols="3" class="form-control" id="ReasonRemoval_SK"
									 placeholder="{{ $penomoran['note'] }}" name="ReasonRemoval_SK" required></textarea>
								</div>
							</div>
						</div>
					@endif

					<legend class="text-uppercase font-size-sm font-weight-bold">Proses Evaluasi</legend>
					<div class="form-group row">
						<div class="col-lg-6">
							<div class="form-group row">
								<label class="col-lg-4 col-form-label">Evaluator</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" value="{!! isset($penomoran['evaluator_name']) ? $penomoran['evaluator_name'] : '' !!}" disabled>
								</div>
							</div>
							@if ($penomoran['jenis_permohonan'] == 'Penetapan Nomor Tambahan')
								<div class="form-group row">
									{{-- <div class="row"> --}}
									<label class="col-lg-4 col-form-label" for="berkas_tambahan">Berita Acara
										Pemeriksaan Nomor Yang Pernah Ditetapkan</label>
									<div class="col-lg-8">
										<input type="file" class="form-control h-auto" name="berkas_tambahan" id="berkas_tambahan"
											accept="application/pdf">
									</div>
									{{-- </div> --}}
								</div>
							@endif
							<div class="form-group row">
								<label class="col-lg-4 col-form-label">Hasil Evaluasi</label>
								<div class="col-lg-8">
									<select name="status_sk" id="status_sk" data-placeholder="Silakan Pilih" class="form-control" required>
										<option value="null" selected disabled>-- Silakan Pilih --</option>
										<option value='1'>Disetujui</option>
										<option value='0'>Ditolak</option>
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group row">

						{{-- <div class="col-lg-12">
                            <div class="row">
                                <label class="col-lg-2 col-form-label">Hasil Evaluasi</label>
                                <div class="col-lg-8">
                                    <select name="status_sk" id="status_sk" data-placeholder="Silakan Pilih"
                                        class="form-control" required>
                                        <option value="" selected disabled>-- Silakan Pilih --</option>
                                        <option value='1'>Disetujui</option>
                                        <option value='0'>Ditolak</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}

						<div class="col-lg-12">
							<label class="col-lg-4 col-form-label">Catatan Hasil Evaluasi </label>
							<fieldset>
								<textarea rows="3" cols="3" class="form-control" id="catatan_hasil_evaluasi"
								 placeholder="Catatan Hasil Evaluasi" name="catatan_hasil_evaluasi"></textarea>
							</fieldset>
						</div>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header bg-indigo text-white header-elements-inline">
					<div class="row">
						<div class="col-lg">
							<h6 class="card-title font-weight-semibold py-3">Riwayat Permohonan</h6>
						</div>
					</div>
				</div>
				<div class="card-body">
					@include('layouts/backend/historyperizinan/historypenomoran', [
						'history_penomoran' => $penomoranlog,
					])
				</div>
			</div>

			<div class="form-group text-right">
				<a href="{{ route('admin.evaluator') }}" class="btn btn-secondary border-transparent"><i
						class="icon-backward2 ml-2"></i> Kembali </a>
				<a href="{{ route('admin.sk.draftpenomoran', [$penomoran['id_izin'], $penomoran['id_kode_akses']]) }}"
					target="_blank" class="btn btn-success">Draf Penetapan <i class="icon-file-pdf ml-2"></i></a>
				<!-- <a target="_blank" href="{{ route('admin.historyperizinan', $penomoran['id_izin']) }}" class="btn btn-info">Riwayat Permohonan </a> -->
				{{-- <a href="{{ route('admin.evaluator.evaluasi-penomoran-save', [$id, $penomoran['id_kode_akses']]) }}" --}}
				{{-- <button type="button" id="" data-target="#submitModal" data-toggle="modal"
                    class="btn btn-indigo">Simpan
                    Evaluasi <i class="icon-paperplane ml-2"></i></button> --}}
				{{-- <button type="button" id="" data-target="#saveModal" data-toggle="modal"
                    class="btn btn-indigo">Simpan
                    Evaluasi <i class="icon-floppy-disk ml-2"></i></button> --}}
				<button type="button" id="btn_kirim" class="btn btn-indigo">Kirim
					Evaluasi <i class="icon-paperplane ml-2"></i></button>
			</div>
		</div>

		<div class="modal" id="submitModal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Kirim Evaluasi</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Apakah anda yakin akan mengirim evaluasi ini ?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary notif-button" data-dismiss="modal">Batal</button>
						<button type="button" id="btnSubmit" class="btn btn-primary notif-button">Kirim</button>
						<div class="spinner-border loading text-primary" role="status" hidden>
							<span class="sr-only">Loading...</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		{{-- <div class="modal" id="saveModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Simpan Evaluasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin akan menyimpan evaluasi ini ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary notif-button" data-dismiss="modal">Batal</button>
                        <button type="button" id="btnSubmit" onclick="savedisposisi();return false;"
                            class="btn btn-primary notif-button">Kirim</button>
                        <div class="spinner-border loading text-primary" role="status" hidden>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
	</form>

	<script nonce="unique-nonce-value">
		var loadingSpinner = document.getElementById('loadingSpinner');

		function showLoadingSpinner() {
			// loadingSpinner.style.display = 'block';
			var spinner = document.getElementById('loadingSpinner');
			spinner.style.display = 'flex';
		}

		$(document).ready(function() {
			$("#btn_kirim").click(function(e) {
				// alert('working');
				validateForm();
			});
			$("#btnSubmit").click(function(e) {
				// alert('working');
				submitdisposisi();
			});
		});

		function validateForm() {
			var selectedValue = document.getElementById("status_sk").value;
			var berkastambahan = document.getElementById("berkas_tambahan");
			var penomoranBloknomor = @json($penomoran_bloknomor ?? null);
			if (Array.isArray(penomoranBloknomor) && penomoranBloknomor !== null) {
				Object.keys(penomoranBloknomor).forEach(function(element) {
					var selectbloknomor_value = document.getElementById("bloknomor[" + element + "][is_deleted]");
					if (selectbloknomor_value) {
						if (selectbloknomor_value.value === "") {
							alert("Pilih Status evaluasi untuk Blok Nomor Terlebih Dahulu");
							return false;
						}
						// or do something with the value
					}
				});
			}
			if (berkastambahan) {
				berkastambahanValue = berkastambahan.value;
			} else {
				berkastambahanValue = "NULL";
			}

			if (selectedValue === "null") {
				alert("Pilih Hasil Evaluasi terlebih dahulu.");
				return false; // Prevent form submission
			} else {
				// You can perform additional validation or actions here
				if (selectedValue === "0") {
					var catatanValue = document.getElementById("catatan_hasil_evaluasi").value;
					if (catatanValue === "" || catatanValue === "NULL") {
						alert("Masukkan Catatan Hasil Evaluasi terlebih dahulu.");
					} else {
						$('#submitModal').modal('show');
						return false; // Allow form submission
					}
				} else {
					// alert(isset(berkastambahanValue));
					if (berkastambahanValue === "NULL" || berkastambahanValue !== "") {
						$('#submitModal').modal('show');
					} else {

						alert("Unggah Berita Acara Pemeriksaan Nomor Yang Pernah Ditetapkan terlebih dahulu.");
					}
					return false; // Allow form submission  
				}
			}
		}

		function updateDatabase(selectElement) {
			var selectedvalue = document.getElementById('bloknomor[' + selectElement + '][is_deleted]').value;
			var nama_wilayah = document.getElementById('nama_wilayah[' + selectElement + ']').value;
			var kode_wilayah = document.getElementById('kode_wilayah[' + selectElement + ']').value;
			var prefix_awal = document.getElementById('prefix_awal[' + selectElement + ']').value;
			var id_izin = document.getElementById('id_izin').value;
			// console.log('Selected Element:', selectedElement.value, selectedElement2.value);
			// var selectedValue = selectElement.value;
			// console.log(selectedValue);
			// document.getElementById('otherInput').value;

			// Make an AJAX request to Laravel backend
			$.ajax({
				type: "POST",
				url: "/admin/update-bloknomor",
				// dataType: "json",
				data: {
					value: selectedvalue,
					kode_wilayah: kode_wilayah,
					prefix_awal: prefix_awal,
					id_izin: id_izin,
					_token: "{{ csrf_token() }}",
				},
				success: function(data) {
					// Handle success response
					console.log(data);
				},
				error: function(data) {
					var errors = data.responseJSON;
					// Handle error response
					console.log(errors);
				}
			});
		}

		function insertKodeakses(selectElement) {
			var selectedvalue = document.getElementById('kodeakses_hapus[' + selectElement + '][status_pe_sk]').value;
			var kode_akses = document.getElementById('kodeakses_hapus[' + selectElement + '][kode_akses]').value;
			// var kode_wilayah = document.getElementById('kode_wilayah[' + selectElement + ']').value;
			// var prefix_awal = document.getElementById('prefix_awal[' + selectElement + ']').value;
			var id_izin = document.getElementById('id_izin').value;
			// console.log('Selected Element:', selectedElement.value, selectedElement2.value);
			// var selectedValue = selectElement.value;
			// console.log(selectedValue);
			// document.getElementById('otherInput').value;

			// Make an AJAX request to Laravel backend
			$.ajax({
				type: "POST",
				url: "/admin/update-kodeakses",
				// dataType: "json",
				data: {
					value: selectedvalue,
					kode_akses: kode_akses,
					// prefix_awal: prefix_awal,
					id_izin: id_izin,
					_token: "{{ csrf_token() }}",
				},
				success: function(data) {
					// Handle success response
					console.log(data);
				},
				error: function(data) {
					var errors = data.responseJSON;
					// Handle error response
					console.log(errors);
				}
			});
		}


		function disactivatedKodeakses(kode_akses) {
			// var selectedvalue = document.getElementById('kodeakses_hapus[' + selectElement + '][status_pe_sk]').value;
			// var kode_akses = document.getElementById('kodeakses_hapus[' + selectElement + '][kode_akses]').value;
			// var kode_wilayah = document.getElementById('kode_wilayah[' + selectElement + ']').value;
			// var prefix_awal = document.getElementById('prefix_awal[' + selectElement + ']').value;
			var id_izin = document.getElementById('id_izin').value;
			// console.log('Selected Element:', selectedElement.value, selectedElement2.value);
			// var selectedValue = selectElement.value;
			// console.log(selectedValue);
			// document.getElementById('otherInput').value;

			// Make an AJAX request to Laravel backend
			$.ajax({
				type: "POST",
				url: "/admin/disactivated-kodeakses",
				// dataType: "json",
				data: {
					// value: selectedvalue,
					kode_akses: kode_akses,
					// prefix_awal: prefix_awal,
					id_izin: id_izin,
					_token: "{{ csrf_token() }}",
				},
				success: function(data) {
					// Handle success response
					console.log(data);
				},
				error: function(data) {
					var errors = data.responseJSON;
					// Handle error response
					console.log(errors);
				}
			});
		}

		function updateskinfo() {
			var id_izin = document.getElementById('id_izin').value;
			var id_kodeakses = document.getElementById('id_kodeakses').value;
			var no_sk = document.getElementById('no_sk').value;
			var tgl_sk = document.getElementById('tgl_sk').value;
			// alert(id_kodeakses);
			// Make an AJAX request to Laravel backend
			$.ajax({
				type: "POST",
				url: "/admin/updateskinfo-kodeakses",
				// dataType: "json",
				data: {
					id_izin: id_izin,
					id_kodeakses: id_kodeakses,
					tgl_sk: tgl_sk,
					no_sk: no_sk,
					_token: "{{ csrf_token() }}",
				},
				success: function(data) {
					// Handle success response
					console.log(data);
				},
				error: function(data) {
					var errors = data.responseJSON;
					// Handle error response
					console.log(errors);
				}
			});
		}

		function submitdisposisi() {
			if ($('#status_sk').val() == 0 && $('#catatan_hasil_evaluasi').val() == '') {
				$('#formEvaluasi').modal('toggle');
				alert('Silakan mengisi catatan hasil evaluasi');
			} else {
				showLoadingSpinner();
				$('#formEvaluasi').submit();
				$('.notif-button').attr("hidden", true);
				$('.loading').attr("hidden", false);
				$('#formEvaluasi').submit();
				$("#btnSubmit").attr("disabled", true);
				$("#btnSubmitKoreksi").attr("disabled", true);
			}
		}

		// function savedisposisi() {
		//     if ($('#status_sk').val() == 0 && $('#catatan_hasil_evaluasi').val() == '') {
		//         $('#submitModal').modal('toggle');
		//         alert('Silakan mengisi catatan hasil evaluasi');
		//     } else {
		//         $('#formEvaluasi').submit();
		//         $('.notif-button').attr("hidden", true);
		//         $('.loading').attr("hidden", false);
		//         $('#formEvaluasi').submit();
		//         $("#btnSubmit").attr("disabled", true);
		//         $("#btnSubmitKoreksi").attr("disabled", true);
		//     }
		// }

		function submitdisposisiTolak() {
			$('#formEvaluasiTolak').submit();
		}
	</script>
	<script nonce="unique-nonce-value" type="text/javascript">
		$(document).ready(function() {

			$("#btnSubmitModalKoreksi").hide();
			$("#btnSubmitModal").show();

			$('#postLink').click(function(e) {
				e.preventDefault(); // Prevent the default behavior of the link
				$.get("{{ route('admin.evaluator.evaluasi-penomoran-save', [$id, $penomoran['id_kode_akses']]) }}", {
						_token: "{{ csrf_token() }}"
					})
					.done(function(data) {
						// Handle the success response if needed
						console.log(data);
					})
					.fail(function(error) {
						// Handle the error response if needed
						console.error(error);
					});
			});

			$(document).on('click', '.btn-delete-kodeakses', function(e) {
				e.preventDefault();
				let row_item = $(this).parent().parent();

				let inputValue = row_item.find('.pilih-bloknomor').val();
				// alert(inputValue);
				disactivatedKodeakses(inputValue);
				$(row_item).remove();
			})
			$('#no_sk').blur(function(e) {
				// Get value from the input box
				e.preventDefault();
				// let row_item = $(this).parent().parent();

				// let inputValue = row_item.find('.pilih-bloknomor').val();
				// alert(inputValue);
				updateskinfo();
			});

			$('#tgl_sk').blur(function(e) {
				// Get value from the input box
				e.preventDefault();
				// let row_item = $(this).parent().parent();


				var tgl_sk = document.getElementById('tgl_sk').value;
				// alert(tgl_sk);
				updateskinfo();
			});


			$(".add-kodeakses").click(function(e) {
				e.preventDefault();
				// alert("Tambah");

				start = 0;
				totalBlokNomor = 0;
				options = ``;
				options += `<option value="">Pilih Penetapan</option>`;
				options += `<option value="1">Penetapan Ulang</option>`;
				options += `<option value="2">Pencabutan</option>`;


				// initSelect2();

				// function initSelect2() {
				//     $('.pilih-kodewilayah').each(function(index, element) {
				//         $(this).select2({
				//             placeholder: "Pilih Kode Wilayah"
				//         })
				//     })
				// }

				function countTotalKodeAkses() {
					return document.querySelectorAll('.kodeakses_hapus-item').length;
				}

				this.totalKodeAkses = countTotalKodeAkses();
				const inputRow =
					`
					<tr class="kodeakses_hapus-item">
						<td>
							<input type="text" class="form-control pilih-bloknomor" name="kodeakses_hapus[` + this
					.totalKodeAkses + `][kode_akses]" id="kodeakses_hapus[` + this
					.totalKodeAkses + `][kode_akses]"/>
						</td>
                        <td>
							<select
                                id="kodeakses_hapus[` + this.totalKodeAkses + `][status_pe_sk]"
								name="kodeakses_hapus[` + this.totalKodeAkses + `][status_pe_sk]"
                                onchange="insertKodeakses(` + this.totalKodeAkses + `)"
								class="form-control pilih-status_pe_sk" required
							>` + options + ` </select>
						</td>
						
						<td>
							<button
								class="btn btn-danger btn-small btn-delete-kodeakses" id="btn-delete-kodeakses"
								type="button"
							><i class="icon-minus3"></i></button>
						</td>
					<tr>
				`;
				$('#bloknomor-lists').append(inputRow);
				initSelect2();
			})

			function CekChek() {
				let yourArray = []
				$("input:checkbox[class=custom-control-input]:checked").each(function() {
					yourArray.push($(this).val());
				});
				// console.log(yourArray)
				if (yourArray.length > 1) {
					$("#btnSubmitModalKoreksi").show();
					$("#btnSubmitModal").hide();

					// $("#submitModalKoreksi").modal("show");
				} else {

					$("#btnSubmitModal").show();
					$("#btnSubmitModalKoreksi").hide();

					// $("#submitModal").modal("show");
				}
			}

			$('#formEvaluasi').on('change', ':checkbox', function() {

				// CekChek();
				var id = $(this).attr('data');

				if ($(this).is(':checked')) {
					$("#label" + id).html("Tidak Sesuai")
					$("#catatan_dokumen_" + id).attr("readonly", false);
					$("#catatan_dokumen_" + id).focus();
				} else {
					$("#label" + id).html("Sesuai")
					$("#catatan_dokumen_" + id).attr("readonly", true);
					$("#catatan_dokumen_" + id).val("");
					setValue();
				}
			});

			$('#status_sk').change(function() {
				let status_sk = $('#status_sk').val();
				if (status_sk == 0) {

				} else {

				}
			})
		});
	</script>
@endsection
