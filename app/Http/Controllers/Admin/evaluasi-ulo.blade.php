@extends('layouts.backend.main')
@section('js')
	<script src="{{ url('global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script src="{{ url('global_assets/js/demo_pages/form_layouts.js') }}"></script>
	{{-- <script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script> --}}
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
	@if (Session::get('message') != '')
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{{ Session::get('message') }}</strong>
		</div>
	@endif

	<form method="post" id="formEvaluasi" action="{{ route('admin.evaluator.evaluasiulopost', [$id, $ulo['id']]) }}"
		enctype="multipart/form-data">
		<div class="form-group">
			<!-- Section Detail Permohonan -->
			<!-- <h3>Evaluasi Uji Laik Operasi</h3>
																																																																																																										<hr/> -->

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
								<div class="row">
									<label class="col-lg-4 col-form-label">No Permohonan </label>
									<div class="col-lg">
										<label class="col-lg col-form-label">: {{ $ulo['id_izin'] }}</label>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<label class="col-lg-4 col-form-label">Jenis Permohonan </label>
									<div class="col-lg">
										<label class="col-lg col-form-label">: {!! $ulo['jenis_layanan_html'] !!}</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="row">
									<label class="col-lg-4 col-form-label">Tanggal Permohonan </label>
									<div class="col-lg">
										@if ($ulo['updated_date'] == null)
											<label class="col-lg col-form-label">: - </label>
										@else
											<label class="col-lg col-form-label">:
												{{ $date_reformat->dateday_lang_reformat_long($ulo['updated_date']) }}</label>
										@endif
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<label class="col-lg-4 col-form-label">Status Permohonan </label>
									<div class="col-lg">
										<label class="col-lg col-form-label">:
											{{ $ulo['kode_izin']['name_status_bo'] }}</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<!-- End Section Detail Permohonan -->

			<!-- Section Detail Perusahaan -->
			<div>
				<div class="card">
					<div class="card-header bg-indigo text-white header-elements-inline">
						<div class="row">
							<div class="col-lg">
								<h6 class="card-title font-weight-semibold py-3">Informasi @if ($detailnib['jenis_pu'] != 'TKI')
										Perusahaan
									@else
										Instansi
									@endif
								</h6>
							</div>
						</div>
					</div>
					<div class="card-body">
						<legend class="text-uppercase font-size-sm font-weight-bold">Data @if ($detailnib['jenis_pu'] != 'TKI')
								Perusahaan
							@else
								Instansi
							@endif
						</legend>
						<div class="form-group row">
							@if ($detailnib['jenis_pu'] != 'TKI')
								<div class="col-lg-6">
									<div class="row">
										<label class="col-lg-4 col-form-label">NIB </label>
										<div class="col-lg">
											<label class="col-lg col-form-label">: {{ $detailnib['nib'] }}</label>
										</div>
									</div>
								</div>
							@endif
							<div class="col-lg-6">
								<div class="row">
									<label class="col-lg-4 col-form-label">Nama </label>
									<div class="col-lg">
										<label class="col-lg col-form-label">: {{ $detailnib['nama_perseroan'] }}</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="row">
									<label class="col-lg-4 col-form-label">NPWP </label>
									<div class="col-lg">
										<label class="col-lg col-form-label">: {{ $detailnib['npwp_perseroan'] }}</label>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<label class="col-lg-4 col-form-label">No Telp </label>
									<div class="col-lg">
										<label class="col-lg col-form-label">:
											{{ $detailnib['nomor_telpon_perseroan'] }}</label>
									</div>
								</div>
							</div>
						</div>
						<legend class="text-uppercase font-size-sm font-weight-bold">Data Penanggung Jawab</legend>
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="row">
									<label class="col-lg-4 col-form-label">NIK </label>
									<div class="col-lg">
										<label class="col-lg col-form-label">:
											{{ isset($penanggungjawab['no_ktp']) ? $penanggungjawab['no_ktp'] : '-' }}
										</label>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<label class="col-lg-4 col-form-label">Nama </label>
									<div class="col-lg">
										<label class="col-lg col-form-label">:
											{{ isset($penanggungjawab['nama_user_proses']) ? $penanggungjawab['nama_user_proses'] : '-' }}
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-6">
								<div class="row">
									<label class="col-lg-4 col-form-label">Email </label>
									<div class="col-lg">
										<label class="col-lg col-form-label">:
											{{ isset($penanggungjawab['email_user_proses']) ? $penanggungjawab['email_user_proses'] : '-' }}</label>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<label class="col-lg-4 col-form-label">No Telp/Mobile </label>
									<div class="col-lg">
										<label class="col-lg col-form-label">:
											{{ isset($penanggungjawab['hp_user_proses']) ? $penanggungjawab['hp_user_proses'] : '-' }}</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Section Detail Perusahaan -->

			<div class="card">
				<div class="card-header bg-indigo text-white header-elements-inline">
					<div class="row">
						<div class="col-lg">
							<h6 class="card-title font-weight-semibold py-3">Evaluasi Persyaratan</h6>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div>
						@csrf
						<input type="hidden" name="id_izin" value="{{ $izin['id_izin'] }}">
						@if (isset($izin['name_sk_izinprinsip']))
							<div class="form-group">
								<div class="col-lg-12">
									<div class="row">
										<div class="col-12">
											<p class="font-weight-semibold">Salinan Izin Prinsip</p>
											<div class="input-group">
												<input disabled="disabled" type="text" class="form-control border-right-0"
													placeholder="SK_IzinPrinsip_{{ isset($izin['name_sk_izinprinsip']) ? $izin['name_sk_izinprinsip'] : '' }}">
												<span class="input-group-append">
													<?php 
                                                    if (isset($izin['path_sk_izinprinsip_final'])) {
                                                        ?><a target="_blank" href="{{ asset($izin['path_sk_izinprinsip_final']) }}"
														class="btn btn-teal" type="button">Lihat Dokumen</a>
													<?php
                                                    }else{
                                                        ?><a href="#" class="btn btn-teal" type="button">Lihat
														Dokumen</a>
													<?php
                                                    }
                                                    ?>
												</span>

											</div>
										</div>

									</div>
								</div>

							</div>
						@endif

						@if (count($map_izin) > 0)
							@foreach ($map_izin as $mi)
								@if ($mi->file_type == 'pdf' || $mi->file_type == 'integration')
									<div class="form-group">
										<div class="col-lg-12">
											<div class="row">
												<div class="col-12">
													<p class="font-weight-semibold">{!! $mi->persyaratan_html !!}</p>
													<div class="input-group">
														<?php 
										if(isset($mi->id_mst_listpersyaratan) && $mi->id_mst_listpersyaratan == 2){
											?>
														<input type="hidden" name="id_konfigurasi_sistem" value="{{ $mi->id }}">
														<input type="hidden" name="path_konfigurasi_sistem" value="{{ $mi->form_isian }}">
														<input type="file" class="form-control h-auto" name="konfigurasi_sistem">
														<?php
										}
										if(isset($mi->id_mst_listpersyaratan) && $mi->id_mst_listpersyaratan == 23){
											?>
														<input type="hidden" name="id_konfigurasi_sistem" value="{{ $mi->id }}">
														<input type="hidden" name="path_konfigurasi_sistem" value="{{ $mi->form_isian }}">
														<input type="file" class="form-control h-auto" name="konfigurasi_sistem">
														<?php
										}
										if(isset($mi->id_mst_listpersyaratan) && $mi->id_mst_listpersyaratan == 45){
											?>
														<input type="hidden" name="id_konfigurasi_sistem" value="{{ $mi->id }}">
														<input type="hidden" name="path_konfigurasi_sistem" value="{{ $mi->form_isian }}">
														<input type="file" class="form-control  h-auto" name="konfigurasi_sistem">
														<?php
										}
										if(isset($mi->id_mst_listpersyaratan) && $mi->id_mst_listpersyaratan == 16){
											?>
														<input type="hidden" name="id_bukti_perangkat" value="{{ $mi->id }}">
														<input type="hidden" name="path_bukti_perangkat" value="{{ $mi->form_isian }}">
														<input type="file" class="form-control" name="bukti_perangkat">
														<?php
										}
										
										if(isset($mi->id_mst_listpersyaratan) && $mi->id_mst_listpersyaratan == 5){
											?>
														<input type="hidden" name="id_bukti_perangkat" value="{{ $mi->id }}">
														<input type="hidden" name="path_bukti_perangkat" value="{{ $mi->form_isian }}">
														<input type="file" class="form-control" name="bukti_perangkat">
														<?php
										}
										if(isset($mi->id_mst_listpersyaratan) && $mi->id_mst_listpersyaratan == 27){
											?>
														<input type="hidden" name="id_bukti_perangkat" value="{{ $mi->id }}">
														<input type="hidden" name="path_bukti_perangkat" value="{{ $mi->form_isian }}">
														<input type="file" class="form-control h-auto" name="bukti_perangkat">
														<?php
										}
                                        if(isset($mi->id_mst_listpersyaratan) && $mi->id_mst_listpersyaratan == 7){
											?>
														<input type="hidden" name="id_dok_layanan_prapurna_jual" value="{{ $mi->id }}">
														<input type="hidden" name="path_dok_layanan_prapurna_jual" value="{{ $mi->form_isian }}">
														<input type="file" class="form-control h-auto" name="dok_layanan_prapurna_jual">
														<?php
										}
                                        if(isset($mi->id_mst_listpersyaratan) && $mi->id_mst_listpersyaratan == 30){
											?>
														<input type="hidden" name="id_dok_layanan_prapurna_jual" value="{{ $mi->id }}">
														<input type="hidden" name="path_dok_layanan_prapurna_jual" value="{{ $mi->form_isian }}">
														<input type="file" class="form-control h-auto" name="dok_layanan_prapurna_jual">
														<?php
										}
                                        if(isset($mi->id_mst_listpersyaratan) && $mi->id_mst_listpersyaratan == 24){
											?>
														<input type="hidden" name="id_dok_peta_jaringan" value="{{ $mi->id }}">
														<input type="hidden" name="path_dok_peta_jaringan" value="{{ $mi->form_isian }}">
														<input type="file" class="form-control h-auto" name="dok_peta_jaringan">
														<?php
										}

										?>
														<input disabled="disabled" type="text" class="form-control border-right-0"
															placeholder="{{ isset($mi->nama_asli) ? $mi->nama_asli : '' }}" disabled>
														<span class="input-group-append">
															<?php  if (isset($mi->form_isian) && $mi->form_isian != '') { ?>
															<a target="_blank" href="{{ asset($mi->form_isian) }}" class="btn btn-teal" type="button">Lihat
																Dokumen</a>
															<?php }else{ ?>
															<a href="#" class="btn btn-teal" type="button">Lihat
																Dokumen</a>
															<?php } ?>
														</span>
													</div>
												</div>

												{{-- <div class="col-lg-1 text-center">
									<p class="font-weight-semibold text-center" id="label{{$mi->id}}">Sesuai</p>
									<div
										class="text-center custom-control custom-switch custom-switch-square custom-control-danger justify-content-center mb-3">
										<input type="checkbox" data="{{$mi->id}}" name="is_koreksi_dokumen_{{$mi->id}}"
											class="custom-control-input" id="c_upload_{{$mi->id}}">
										<label class="custom-control-label" for="c_upload_{{$mi->id}}"></label>
									</div>
								</div>
								<div class="col-lg-5">
									<p class="font-weight-semibold">Catatan</p>
									<!-- <t type="text" name="catatan_dokumen_{{$mi->id}}" class="form-control"> -->
									<textarea class="form-control disabled" id="catatan_dokumen_{{$mi->id}}"
										name="catatan_dokumen_{{$mi->id}}" rows="2" readonly></textarea>
								</div> --}}
											</div>
										</div>
									</div>
								@elseif($mi->file_type == 'table' && $mi->component_name != null)
									@if (Illuminate\Support\Str::is('rencanausaha*', $mi->component_name))
										<input type="hidden" name="id_maplist_rencanausaha" value="{{ $mi->id }}">
									@endif
									<?php 
					if($mi->component_name == 'daftar_perangkat'){
						?><input type="hidden" name="id_daftar_perangkat" value="{{ $mi->id }}">
									<?php
					}
					if($mi->component_name == 'daftar_perangkat_telsus'){
						?><input type="hidden" name="id_daftar_perangkat" value="{{ $mi->id }}">
									<?php
					}
					if($mi->component_name == 'daftar_ket_konfigurasiteknis'){
						?><input type="hidden" name="id_daftar_ket_konfigurasiteknis"
										value="{{ $mi->id }}">
									<?php
					}
					if($mi->component_name == 'rencanausaha'){
						?><input type="hidden" name="id_maplist_rencanausaha" value="{{ $mi->id }}">
									<?php
					}
					?>
									@if (isset($mi->form_isian))
										<div class="form-group">
											<div class="col-lg-12">
												<div class="row">
													<div class="col-12">
														<p class="font-weight-semibold">{!! $mi->persyaratan_html !!}</p>
														{{--
									<x-dynamic-component :component="$mi->component_name"
										:datajson="$mi->form_isian ?? ''" /> --}}
														<x-dynamic-component :triger="$triger ?? 'null'" :component="$mi->component_name" :datajson="$mi->form_isian ?? 'kosong'" :needcorrection="$mi->need_correction ?? ''"
															:correctionnote="$mi->correction_note ?? ''" />
													</div>

													{{-- <div class="col-lg-1 text-center">
									<p class="font-weight-semibold text-center" id="label{{$mi->id}}">Sesuai</p>
									<div
										class="text-center custom-control custom-switch custom-switch-square custom-control-danger justify-content-center mb-3">
										<input type="checkbox" data="{{$mi->id}}" name="is_koreksi_dokumen_{{$mi->id}}"
											class="custom-control-input" id="c_upload_{{$mi->id}}">
										<label class="custom-control-label" for="c_upload_{{$mi->id}}"></label>
									</div>
								</div>
								<div class="col-lg-5">
									<p class="font-weight-semibold">Catatan</p>
									<textarea class="form-control disabled" id="catatan_dokumen_{{$mi->id}}"
										name="catatan_dokumen_{{$mi->id}}" rows="2" readonly></textarea>
								</div> --}}
												</div>
											</div>
										</div>
									@endif
								@endif
							@endforeach
						@endif
					</div>
					{{-- <div class="form-group text-right">
                        @if ($ulo['status_hasil_evaluasi'] == 1)
                            <button type="submit" class="btn btn-warning">Sunting <i
                                    class="icon-paperplane ml-2"></i></button>
                        @else
                            <button type="submit" class="btn btn-indigo">Simpan <i
                                    class="icon-paperplane ml-2"></i></button>
                        @endif
                    </div> --}}

				</div>
			</div>

			<div class="card">
				<div class="card-header bg-indigo text-white header-elements-inline">
					<div class="row">
						<div class="col-lg">
							<h6 class="card-title font-weight-semibold py-3">Dokumen Uji Laik Operasi
							</h6>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div>

						@csrf
						<input type="hidden" name="id_izin" value="{{ $ulo['id_izin'] }}">

						<div class="form-group">
							<div class="col-lg-12">

								@if ($ulo['tipe_ulo'] == '1')
									<div class="row">
										<div class="col-12">
											<p class="font-weight-semibold">Dokumen Surat Permohonan Uji Laik Operasi</p>
											<div class="input-group">

												<input type="file" class="form-control h-auto" name="dok_surat_permohonan_ulo_asli">
												<input disabled="disabled" type="text" class="form-control border-right-0" placeholder="Dokumen"
													value="{{ isset($ulo['surat_permohonan_ulo_asli']) ? $ulo['surat_permohonan_ulo_asli'] : '' }}">
												<span class="input-group-append">
													<?php 
                                        if (isset($ulo['surat_permohonan_ulo']) && $ulo['surat_permohonan_ulo'] != '') {
                                            ?><a target="_blank" href="{{ url($ulo['surat_permohonan_ulo']) }}"
														class="btn btn-teal" type="button">Lihat Dokumen</a>
													<input type="hidden" name="path_dok_surat_permohonan_ulo_asli"
														value="{{ $ulo['surat_permohonan_ulo'] }}">
													<?php
                                        }else{
                                            ?><a href="#" class="btn btn-teal" type="button">Lihat Dokumen</a>
													<?php
                                        }
                                        ?>
												</span>
											</div>
										</div>
									</div>
								@else
									<div class="row">
										<div class="col-12">
											<p class="font-weight-semibold">Dokumen Surat Permohonan Uji Laik Operasi</p>
											<div class="input-group">

												<input type="file" class="form-control h-auto" name="dok_surat_permohonan_ulo_asli">
												<input disabled="disabled" type="text" class="form-control border-right-0" placeholder="Dokumen"
													value="{{ isset($ulo['surat_permohonan_ulo_asli']) ? $ulo['surat_permohonan_ulo_asli'] : '' }}">
												<span class="input-group-append">
													<?php 
                                    if (isset($ulo['surat_permohonan_ulo']) && $ulo['surat_permohonan_ulo'] != '') {
                                        ?><a target="_blank" href="{{ url($ulo['surat_permohonan_ulo']) }}"
														class="btn btn-teal" type="button">Lihat Dokumen</a>
													<input type="hidden" name="path_dok_surat_permohonan_ulo_asli"
														value="{{ $ulo['surat_permohonan_ulo'] }}">
													<?php
                                    }else{
                                        ?><a href="#" class="btn btn-teal" type="button">Lihat Dokumen</a>
													<?php
                                    }
                                    ?>
												</span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12">
											<p class="font-weight-semibold">Dokumen Surat Tugas </p>
											<div class="input-group">
												<input disabled="disabled" type="text" class="form-control border-right-0" placeholder="Dokumen"
													value="{{ isset($ulo['surat_tugas_pelaksanaan_ulo_mandiri_asli']) ? $ulo['surat_tugas_pelaksanaan_ulo_mandiri_asli'] : '' }}">
												<span class="input-group-append">
													<?php 
                                        if (isset($ulo['surat_tugas_pelaksanaan_ulo_mandiri']) && $ulo['surat_tugas_pelaksanaan_ulo_mandiri'] != '') {
                                            ?><a target="_blank" href="{{ url($ulo['surat_tugas_pelaksanaan_ulo_mandiri']) }}"
														class="btn btn-teal" type="button">Lihat Dokumen</a>
													<?php
                                        }else{
                                            ?><a href="#" class="btn btn-teal" type="button">Lihat Dokumen</a>
													<?php
                                        }
                                        ?>
												</span>
											</div>
										</div>

									</div>

									<div class="row">
										<div class="col-12">
											<p class="font-weight-semibold">Dokumen Hasil Pengujian </p>
											<div class="input-group">
												<input disabled="disabled" type="text" class="form-control border-right-0" placeholder="Dokumen"
													value="{{ isset($ulo['hasil_pengujian_ulo_mandiri_asli']) ? $ulo['hasil_pengujian_ulo_mandiri_asli'] : '' }}">
												<span class="input-group-append">
													<?php 
                                        if (isset($ulo['hasil_pengujian_ulo_mandiri']) && $ulo['hasil_pengujian_ulo_mandiri'] != '') {
                                            ?><a target="_blank" href="{{ url($ulo['hasil_pengujian_ulo_mandiri']) }}"
														class="btn btn-teal" type="button">Lihat Dokumen</a>
													<?php
                                        }else{
                                            ?><a href="#" class="btn btn-teal" type="button">Lihat Dokumen</a>
													<?php
                                        }
                                        ?>
												</span>
											</div>
										</div>
									</div>
								@endif
							</div>
						</div>

					</div>

				</div>
			</div>
	</form>
	<div class="card">
		<div class="card-header bg-indigo text-white header-elements-inline">

			<div class="row">
				<div class="col-lg">
					<h6 class="card-title font-weight-semibold py-3">Catatan Hasil Evaluasi</h6>
				</div>
			</div>
		</div>
		<form method="post" id="hasil_evaluasi"
			action="{{ route('admin.evaluator.hasilevaluasiulopost', [$id, $ulo['id']]) }}" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="id_izin" value="{{ $izin['id_izin'] }}">
			<input type="hidden" name="status_hasil_evaluasi" value="{{ isset($ulo['status_hasil_evaluasi']) ? null : 1 }}">
			<div class="card-body">
				@if ($ulo['nama_master_izin'] == 'TELSUS' || $ulo['nama_master_izin'] == 'TELSUS_INSTANSI')
					{{-- <div class="form-group">
				<label for="MediaTransmisiYangDigunakan">Media Transmisi yang Digunakan </label>
				<textarea class="form-control" name="MediaTransmisiYangDigunakan" id="MediaTransmisiYangDigunakan"
					rows="3" {{ $ulo['status_hasil_evaluasi']==1 ? 'disabled' : '' ; }}
					required>{{ isset($ulo['media_transmisi_yang_digunakan']) ? $ulo['media_transmisi_yang_digunakan'] : ''; }}</textarea>
			</div> --}}
				@else
					<div class="form-group">
						<label for="alamatPusatLayananPelangan">Alamat Pusat Layanan Pelanggan </label>
						<div name="alamatPusatLayananPelangan_quill" id="alamatPusatLayananPelangan_quill"
							{{ $ulo['status_hasil_evaluasi'] == 1 ? 'disabled' : '' }} required>
							{!! isset($ulo['alamat_pusat_layanan_pelangan']) ? $ulo['alamat_pusat_layanan_pelangan'] : '' !!}
						</div>
						<input type="hidden" name="alamatPusatLayananPelangan" id="alamatPusatLayananPelangan">
						{{-- <textarea class="form-control" name="alamatPusatLayananPelangan" id="alamatPusatLayananPelangan" rows="3"
						 {{ $ulo['status_hasil_evaluasi'] == 1 ? 'disabled' : '' }} required>{{ isset($ulo['alamat_pusat_layanan_pelangan']) ? $ulo['alamat_pusat_layanan_pelangan'] : '' }}</textarea> --}}
					</div>
				@endif
				<div class="form-group">
					<label for="AlamatPelaksanaanUlo">Alamat Pelaksanaan ULO</label>
					<div name="AlamatPelaksanaanUlo_quill" id="AlamatPelaksanaanUlo_quill"
						{{ $ulo['status_hasil_evaluasi'] == 1 ? 'disabled' : '' }} required>
						{!! isset($ulo['alamat_pelaksanaan_ulo']) ? $ulo['alamat_pelaksanaan_ulo'] : '' !!}
					</div>
					<input type="hidden" name="AlamatPelaksanaanUlo" id="AlamatPelaksanaanUlo">
					{{-- <textarea class="form-control" name="AlamatPelaksanaanUlo" id="AlamatPelaksanaanUlo" rows="3"
					 {{ $ulo['status_hasil_evaluasi'] == 1 ? 'disabled' : '' }} required>{{ isset($ulo['alamat_pelaksanaan_ulo']) ? $ulo['alamat_pelaksanaan_ulo'] : '' }}</textarea> --}}
				</div>
				<div class="form-group">
					<label for="TanggalEvaluasiPelaksanaanUlo">Tanggal Evaluasi Pelaksanaan ULO </label>
					<input type="date" class="form-control" name="TanggalEvaluasiPelaksanaanUlo"
						id="TanggalEvaluasiPelaksanaanUlo"
						value="{{ isset($ulo['tanggal_evaluasi_pelaksanaan_ulo']) ? $ulo['tanggal_evaluasi_pelaksanaan_ulo'] : '' }}"
						{{ $ulo['status_hasil_evaluasi'] == 1 ? 'disabled' : '' }} required>
				</div>
				<div class="form-group">
					<label for="NoSuratPerintahTugas">No Surat Perintah Tugas (SPT) ULO </label>
					<input type="text" class="form-control" name="NoSuratPerintahTugas" id="NoSuratPerintahTugas"
						value="{{ isset($ulo['no_surat_perintah_tugas']) ? $ulo['no_surat_perintah_tugas'] : '' }}"
						{{ $ulo['status_hasil_evaluasi'] == 1 ? 'disabled' : '' }} required>
				</div>
				<div class="form-group">
					<label for="TanggalSuratPerintahTugas">Tanggal Surat Perintah Tugas (SPT) ULO </label>
					<input type="date" class="form-control" name="TanggalSuratPerintahTugas" id="TanggalSuratPerintahTugas"
						value="{{ isset($ulo['tanggal_surat_perintah_tugas']) ? $ulo['tanggal_surat_perintah_tugas'] : '' }}"
						{{ $ulo['status_hasil_evaluasi'] == 1 ? 'disabled' : '' }} required>
				</div>
				@if ($ulo['status_hasil_evaluasi'] == 1)
					<div class="form-group">
						<label for="uploadSuratPerintahTugas">Surat Perintah Tugas (SPT) ULO </label>
						<div class="input-group">
							<input disabled="disabled" type="text" class="form-control border-right-0"
								placeholder="{{ isset($ulo['upload_surat_perintah_tugas_asli']) ? $ulo['upload_surat_perintah_tugas_asli'] : '' }}">
							<span class="input-group-append">
								<a target="_blank" href="{{ asset($ulo['upload_surat_perintah_tugas']) }}" class="btn btn-teal"
									type="button">Lihat Dokumen</a>
							</span>
						</div>
					</div>
				@else
					<div class="form-group">
						<label for="uploadSuratPerintahTugas">Surat Perintah Tugas (SPT) ULO </label>
						<input type="file" class="form-control h-auto" name="uploadSuratPerintahTugas" id="uploadSuratPerintahTugas"
							accept="application/pdf" {{ $ulo['status_hasil_evaluasi'] == 1 ? 'required' : '' }}>
						@if (isset($ulo['upload_surat_perintah_tugas']))
							File Sebelumnya <a target="_blank" href="{{ asset($ulo['upload_surat_perintah_tugas']) }}"
								class="text-danger">{{ $ulo['upload_surat_perintah_tugas_asli'] }}</a>
						@endif
					</div>
				@endif
				<div class="form-group">
					<label for="DasarSuratPermohonanUlo">Dasar surat permohonan ULO dari perusahaan Pemohon ULO </label>
					<textarea class="form-control" name="DasarSuratPermohonanUlo" id="DasarSuratPermohonanUlo" rows="3"
					 {{ $ulo['status_hasil_evaluasi'] == 1 ? 'disabled' : '' }} required>{{ isset($ulo['dasar_surat_permohonan_ulo']) ? $ulo['dasar_surat_permohonan_ulo'] : '' }}</textarea>
				</div>
				@if ($ulo['status_hasil_evaluasi'] == 1)
					<div class="form-group">
						<label for="UploadDokumenHasilEvaluasiPelaksanaanUlo">Upload dokumen hasil evaluasi pelaksanaan ULO
						</label>
						<div class="input-group">
							<input disabled="disabled" type="text" class="form-control border-right-0"
								placeholder="{{ isset($ulo['upload_dokumen_hasil_evaluasi_pelaksanaan_ulo_asli']) ? $ulo['upload_dokumen_hasil_evaluasi_pelaksanaan_ulo_asli'] : '' }}">
							<span class="input-group-append">
								<a target="_blank" href="{{ asset($ulo['upload_dokumen_hasil_evaluasi_pelaksanaan_ulo']) }}"
									class="btn btn-teal" type="button">Lihat Dokumen</a>
							</span>
						</div>
					</div>
				@else
					<div class="form-group">
						<label for="UploadDokumenHasilEvaluasiPelaksanaanUlo">Upload dokumen hasil evaluasi pelaksanaan ULO
						</label>
						<input type="file" class="form-control h-auto" name="UploadDokumenHasilEvaluasiPelaksanaanUlo"
							id="UploadDokumenHasilEvaluasiPelaksanaanUlo" accept="application/pdf"
							{{ $ulo['status_hasil_evaluasi'] == 1 ? 'required' : '' }}>
						@if (isset($ulo['upload_dokumen_hasil_evaluasi_pelaksanaan_ulo_asli']))
							File Sebelumnya <a target="_blank" href="{{ asset($ulo['upload_dokumen_hasil_evaluasi_pelaksanaan_ulo']) }}"
								class="text-danger">{{ $ulo['upload_dokumen_hasil_evaluasi_pelaksanaan_ulo_asli'] }}</a>
						@endif
					</div>
				@endif
				<div class="form-group">
					<label for="status_laik">Hasil Evaluasi Status Laik</label>
					@if (!isset($ulo['status_laik']))
						<select name="status_laik" id="status_laik" data-placeholder="Silakan Pilih" class="form-control" required
							{{ $ulo['status_hasil_evaluasi'] == 1 ? 'disabled' : '' }}>
							<option selected disabled> --Silakan Pilih -- </option>
							<option value="1">Laik Operasi</option>
							<option value="0">Tidak Laik Operasi
							</option>
						</select>
					@else
						<select name="status_laik" id="status_laik" data-placeholder="Silakan Pilih" class="form-control" required
							{{ $ulo['status_hasil_evaluasi'] == 1 ? 'disabled' : '' }}>
							<option disabled> --Silakan Pilih -- </option>
							<option @if ($ulo['status_laik'] == 1) selected @endif value="1">Laik Operasi</option>
							<option @if ($ulo['status_laik'] == 0) selected @endif value="0">Tidak Laik Operasi
							</option>
						</select>
					@endif
				</div>

				{{-- <div class="form-group row">
                    <div class="col-lg-12">
                        <fieldset>
                            <label for="catatan_hasil_evaluasi">Catatan Hasil Evaluasi</label>
                            <textarea rows="3" cols="3" class="form-control" placeholder="Hasil Evaluasi"
                                name="catatan_hasil_evaluasi" id="catatan_hasil_evaluasi" required>{{ isset($ulo['catatan_evaluasi']) ? $ulo['catatan_evaluasi'] : '' }}</textarea>
                        </fieldset>
                    </div>
                </div> --}}
				<div class="form-group text-right">
					@if ($ulo['status_hasil_evaluasi'] == 1)
						<button type="button" id ="btn_submit_simpan_evaluasi" class="btn btn-warning">Sunting <i
								class="icon-paperplane ml-2"></i></button>
					@else
						<button type="button" id ="btn_submit_simpan_evaluasi" class="btn btn-indigo">Simpan <i
								class="icon-paperplane ml-2"></i></button>
					@endif
				</div>

			</div>
		</form>
	</div>

	<div class="card">
		<div class="card-header bg-indigo text-white header-elements-inline">

			<div class="row">
				<div class="col-lg">
					<h6 class="card-title font-weight-semibold py-3">Hasil Evaluasi Akhir</h6>
				</div>
			</div>
		</div>
		<form method="post" id="hasil_evaluasi_akhir"
			action="{{ route('admin.evaluator.kirimemail', [$id, $ulo['id']]) }}" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="id_izin" value="{{ $izin['id_izin'] }}">
			<input type="hidden" name="status_hasil_evaluasi" value="{{ isset($ulo['status_hasil_evaluasi']) ? null : 1 }}">
			<div class="card-body">
				{{-- <div class="form-group">
					<label for="status_laik">Hasil Evaluasi Status Laik</label>
					@if (!isset($ulo['status_laik']))
						<select name="status_laik" id="status_laik" data-placeholder="Silakan Pilih" class="form-control" required>
							<option selected disabled> --Silakan Pilih -- </option>
							<option value="1">Laik Operasi</option>
							<option value="0">Tidak Laik Operasi
							</option>
						</select>
					@else
						<select name="status_laik" id="status_laik" data-placeholder="Silakan Pilih" class="form-control" required>
							<option disabled> --Silakan Pilih -- </option>
							<option @if ($ulo['status_laik'] == 1) selected @endif value="1">Laik Operasi</option>
							<option @if ($ulo['status_laik'] == 0) selected @endif value="0">Tidak Laik Operasi
							</option>
						</select>
					@endif
				</div> --}}
				<div class="form-group row">
					<div class="col-lg-12">
						<fieldset>
							<label for="catatan_hasil_evaluasi">Catatan Hasil Evaluasi</label>
							<textarea rows="3" cols="3" class="form-control" placeholder="Hasil Evaluasi"
							 name="catatan_hasil_evaluasi" id="catatan_hasil_evaluasi" required>{{ isset($ulo['catatan_evaluasi']) ? $ulo['catatan_evaluasi'] : '' }}</textarea>
						</fieldset>
					</div>
				</div>

			</div>
		</form>
	</div>

	<div class="form-group text-right">
		<a href="{{ route('admin.evaluator') }}" class="btn btn-secondary border-transparent"><i
				class="icon-backward2 ml-2"></i> Kembali </a>
		<a target="_blank" href="{{ route('admin.historyperizinan', $ulo['id_izin']) }}" class="btn btn-info">Riwayat
			Permohonan <i class="icon-history ml-2"></i></a>
		@if (isset($ulo['status_hasil_evaluasi']))
			<a href="{{ route('admin.sk.draft', [$ulo['id_izin'], $ulo['id']]) }}" target="_blank"
				class="btn btn-success">Draf SKLO
				<i class="icon-file-pdf ml-2"></i></a>
		@endif
		@if (isset($ulo['status_hasil_evaluasi']) && $ulo['kd_izin'] == '059000020066')
			<a href="{{ route('admin.sk.draftIzinPenyelenggaraan', [$ulo['id_izin']]) }}" target="_blank"
				class="btn btn-success">Preview Izin Penyelenggaraan
				<i class="icon-file-pdf ml-2"></i></a>
		@endif
		@if ($izin['nama_master_izin'] !== 'TELSUS')
			@if (isset($ulo['status_hasil_evaluasi']) && $ulo['kd_izin'] !== '059000020066')
				<a href="{{ route('admin.sk.draftkomitmen', $ulo['id_izin']) }}" target="_blank" class="btn btn-success">Draf
					Komitmen
					<i class="icon-file-pdf ml-2"></i></a>
			@endif
		@endif
		{{-- <button type="button" id="" data-target="#submitModalKoreksi" data-toggle="modal" class="btn btn-warning">Tolak
		<i class="icon-blocked ml-2"></i></button> --}}
		<button type="button" id="" data-target="#submitModal_syarat" data-toggle="modal"
			class="btn btn-indigo">Perbaharui Persyaratan <i class="icon-paperplane ml-2"></i></button>
		<button type="button" id="" data-target="#submitModal" data-toggle="modal" class="btn btn-indigo">Kirim
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
					<button type="button" id ="btn_submit_disposisi" class="btn btn-primary notif-button">Kirim</button>
					<div class="spinner-border loading text-primary" role="status" hidden>
						<span class="sr-only">Loading...</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="submitModal_syarat" tabindex="-1" role="dialog">
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
					<button type="button" id ="btn_submit_disposisi_syarat" class="btn btn-primary notif-button">Kirim</button>
					<div class="spinner-border loading text-primary" role="status" hidden>
						<span class="sr-only">Loading...</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="submitModalKoreksi" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Kirim Perbaikan Evaluasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p class="text-warning">Apakah anda yakin akan mengirim perbaikan evaluasi ini ?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="button" id ="btn_submit_disposisi_tolak" class="btn btn-primary">Kirim</button>
					<div class="spinner-border loading text-primary" role="status" hidden>
						<span class="sr-only">Loading...</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script nonce="unique-nonce-value">
		function submitdisposisi() {
			showLoadingSpinner();
			$('.notif-button').attr("hidden", true);
			$('.loading').attr("hidden", false);
			$('#hasil_evaluasi_akhir').submit();
			$("#btnSubmit").attr("disabled", true);
		}

		function submitdisposisi_syarat() {
			showLoadingSpinner();
			$('.notif-button').attr("hidden", true);
			$('.loading').attr("hidden", false);
			$('#formEvaluasi').submit();
			$("#btnSubmit").attr("disabled", true);
		}

		function submitsimpan_evaluasi() {
			const quillalamatPusatLayananPelangan = new Quill('#alamatPusatLayananPelangan_quill', {
				theme: 'snow'
			});
			const quillAlamatPelaksanaanUlo = new Quill('#AlamatPelaksanaanUlo_quill', {
				theme: 'snow'
			});
			document.querySelector('#alamatPusatLayananPelangan').value = quillalamatPusatLayananPelangan.root.innerHTML;
			document.querySelector('#AlamatPelaksanaanUlo').value = quillAlamatPelaksanaanUlo.root.innerHTML;
			console.log(quillalamatPusatLayananPelangan.root.innerHTML);
			console.log(quillAlamatPelaksanaanUlo.root.innerHTML);
			showLoadingSpinner();


			$('.notif-button').attr("hidden", true);
			$('.loading').attr("hidden", false);
			$('#hasil_evaluasi').submit();
			$("#btnSubmit").attr("disabled", true);
		}

		function submitdisposisiTolak() {
			showLoadingSpinner();
			$('.notif-button').attr("hidden", true);
			$('.loading').attr("hidden", false);
			$('#formEvaluasiTolak').submit();
			$("#btnSubmitKoreksi").attr("disabled", true);
		}
	</script>
	<script nonce="unique-nonce-value" type="text/javascript">
		// document.addEventListener("DOMContentLoaded", function() {
		// 	tinymce.init({
		// 		selector: '#alamatPusatLayananPelangan',
		// 		menubar: false,
		// 		plugins: 'link code',
		// 		toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code'
		// 	});
		// });
		var loadingSpinner = document.getElementById('loadingSpinner');

		function showLoadingSpinner() {
			// loadingSpinner.style.display = 'block';
			var spinner = document.getElementById('loadingSpinner');
			spinner.style.display = 'flex';
		}
		$(document).ready(function() {

			// CKEDITOR.replace('alamatPusatLayananPelangan');
			// CKEDITOR.replace('AlamatPelaksanaanUlo');
			const quillalamatPusatLayananPelangan = new Quill('#alamatPusatLayananPelangan_quill', {
				theme: 'snow'
			});
			const quillAlamatPelaksanaanUlo = new Quill('#AlamatPelaksanaanUlo_quill', {
				theme: 'snow'
			});
			// document.querySelector('#hasil_evaluasi').addEventListener('btn_submit_simpan_evaluasi', function() {
			// 	document.querySelector('#alamatPusatLayananPelangan').value =
			// 		quillalamatPusatLayananPelangan.root
			// 		.innerHTML;
			// 	document.querySelector('#AlamatPelaksanaanUlo').value = quillAlamatPelaksanaanUlo.root
			// 		.innerHTML;
			// });
			// quillAlamatPelaksanaanUlo.on('text-change', function(delta, oldDelta, source) {
			// 	// Get the current content of the editor as HTML
			// 	const currentContent = quillAlamatPelaksanaanUlo.root.innerHTML;

			// 	// Log the content to the console
			// 	console.log('Editor content changed:', currentContent);

			// 	// Optionally, you can log the delta (the change object) and the source of the change
			// 	// console.log('Delta:', delta);
			// 	// console.log('Old Delta:', oldDelta);
			// 	// console.log('Source:', source); // 'user' or 'api'
			// });
			$("#btn_submit_disposisi").click(function(e) {
				// alert('working');
				submitdisposisi();
			});
			$("#btn_submit_disposisi_syarat").click(function(e) {
				// alert('working');
				submitdisposisi_syarat();
			});
			$("#btn_submit_simpan_evaluasi").click(function(e) {
				// alert('working');
				submitsimpan_evaluasi();
			});
			$("#btn_submit_disposisi_tolak").click(function(e) {
				// alert('working');
				submitdisposisiTolak();
			});

			// $('#TanggalEvaluasiPelaksanaanUlo').datepicker({
			// 	uiLibrary: 'bootstrap4',
			// 	format: 'dd-mm-yyyy'
			// });
			// $('#TanggalSuratPerintahTugas').datepicker({
			// 	uiLibrary: 'bootstrap4',
			// 	format: 'dd-mm-yyyy'
			// });

			$("#btnSubmitModalKoreksi").hide();
			$("#btnSubmitModal").show();



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


			$('#c_upload_surat_permohonan').on('change', function() {
				CekChek();
				// var id=$(this).attr('data');
				if ($(this).is(':checked')) {
					// console.log(id + ' is now checked');
					$("#label1").html("Tidak Sesuai")
					$("#catatan_surat_permohonan").attr("readonly", false);
					$("#catatan_surat_permohonan").focus();

				} else {
					$("#label1").html("Sesuai")
					$("#catatan_surat_permohonan").attr("readonly", true);
				}
			});
			$('#c_upload_surat_tugas').on('change', function() {
				CekChek();
				// var id=$(this).attr('data');
				if ($(this).is(':checked')) {
					// console.log(id + ' is now checked');
					$("#label2").html("Tidak Sesuai")
					$("#catatan_surat_tugas").attr("readonly", false);
					$("#catatan_surat_tugas").focus();

				} else {
					$("#label1").html("Sesuai")
					$("#catatan_surat_tugas").attr("readonly", true);
				}
			});
			$('#c_upload_hasil_pengujian').on('change', function() {
				CekChek();
				// var id=$(this).attr('data');
				if ($(this).is(':checked')) {
					// console.log(id + ' is now checked');
					$("#label3").html("Tidak Sesuai")
					$("#catatan_hasil_pengujian").attr("readonly", false);
					$("#catatan_hasil_pengujian").focus();

				} else {
					$("#label1").html("Sesuai")
					$("#catatan_hasil_pengujian").attr("readonly", true);
				}
			});
		});
	</script>
@endsection
