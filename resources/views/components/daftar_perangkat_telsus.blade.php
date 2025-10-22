@php
	$is_editable = $needcorrection ?? false; // add || jika ada kondisi lain untuk edit input dibawah
@endphp
<style>
	.hidden {
		display: none !important;
	}
</style>
<div id="daftar_perangkat_telsus mt-4">
	<div id="daftar_perangkat_telsus_lists">
		{{-- <div class="px-3 py-3 daftar-perangkat-item" style="border: 1px solid #ddd"> --}}
		@if ($datajson !== 'kosong')
			<?php
			$datajson = json_decode($datajson, true);
			// dd($datajson);
			?>
			@foreach ($datajson as $key => $d)
				@if (isset($d['isdeleted_perangkat']))
					@if ($d['isdeleted_perangkat'] == '1')
						<div class="px-3 py-3 daftar-perangkat-item">
							{{-- @if ($is_editable)
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="isdeleted_perangkat">Hapus perangkat? </label>
                        </div>
                        <div class="form-group custom-control custom-switch custom-switch-square custom-control-danger">
                            <input type="checkbox" name="daftar_perangkat_telsus[{{ $key }}][isdeleted_perangkat]"
                                class="form-control isdeleted_perangkat custom-control-input"
                                id="daftar_perangkat_telsus[{{ $key }}][isdeleted_perangkat]">
                            <label class="custom-control-label" for="isdeleted_perangkat"></label>
                        </div>
                    </div>

                </div>
                <hr class="w-100" />
                @endif --}}
							@if ($is_editable)
								<div class="col-md-2">
									<label for="isdeleted_perangkat">{{ $key }} Hapus perangkat? </label>
								</div>
								<div>
									<select name="daftar_perangkat_telsus[{{ $key }}][isdeleted_perangkat]" id=""
										class="form-control isdeleted_perangkat" required>
										<option name="daftar_perangkat_telsus[{{ $key }}][isdeleted_perangkat]" value="1" selected>Tidak
										</option>
										<option name="daftar_perangkat_telsus[{{ $key }}][isdeleted_perangkat]" value="2">Hapus</option>

									</select>
								</div>
								<hr class="w-100" />
							@endif
							@if (isset($d['sertifikat_perangkat']))
								@if ($is_editable)
									<div class="col-md-12">
										<label for="switchPerangkat">Apakah anda memiliki sertifikat perangkat?</label>
										<input type="checkbox" class="switchPerangkat" id="switchPerangkat"
											{{ $d['sertifikat_perangkat'] ? 'checked' : '' }}>
									</div>

									<div class="col-md-12">
										<div class="form-group {{ $d['sertifikat_perangkat'] ?? 'hidden' }}">
											<label for="">Nomor Sertifikat Perangkat</label>
											<input class="form-control sertifikat_perangkat"
												name="daftar_perangkat_telsus[{{ $key }}][sertifikat_perangkat]"
												value="{{ $d['sertifikat_perangkat'] }}" {{ $is_editable ? '' : 'disabled' }} />
										</div>
									</div>
								@endif
							@endif
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Lokasi Perangkat</label>
										<textarea class="form-control lokasi_perangkat" name="daftar_perangkat_telsus[{{ $key }}][lokasi_perangkat]"
										 {{ $is_editable ? '' : 'disabled' }} required>{{ $d['lokasi_perangkat'] }}</textarea>
									</div>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Jenis Perangkat</label>
										<input class="form-control jenis_perangkat"
											name="daftar_perangkat_telsus[{{ $key }}][jenis_perangkat]" value="{{ $d['jenis_perangkat'] }}"
											required {{ $is_editable ? '' : 'disabled' }} />
									</div>
									<div class="form-group">
										<label for="">Merk Perangkat</label>
										<input class="form-control merk_perangkat"
											name="daftar_perangkat_telsus[{{ $key }}][merk_perangkat]" value="{{ $d['merk_perangkat'] }}"
											required {{ $is_editable ? '' : 'disabled' }} />
									</div>
									{{-- <div class="form-group">
                            <label for="">Nomor <i>Serial Number</i> Perangkat</label>
                            <input class="form-control sn_perangkat"
                                name="daftar_perangkat_telsus[{{ $key }}][sn_perangkat]"
                                value="{{ $d['sn_perangkat'] }}" required {{ $is_editable ? '' : 'disabled' }} />
                        </div> --}}
									<div class="form-group">
										<div class="col-12">
											<p class="font-weight-semibold">Bukti Kepemilikan Perangkat</p>
											<div class="input-group">
												<?php
												$name = explode('/', $d['foto_perangkat']);
												?>
												<?php 
                                                if ($is_editable) {
                                                ?><input type="file" accept="application/pdf" class="form-control h-auto"
													name="daftar_perangkat_telsus[{{ $key }}][foto_perangkat]"
													value="{{ str_replace('storage/file_syarat/', '', $d['foto_perangkat']) }}"
													placeholder="{{ str_replace('storage/file_syarat/', '', $d['foto_perangkat']) }}" />
												<input type="hidden" name="prv_foto_perangkat[{{ $key }}]" value="{{ $d['foto_perangkat'] }}">
												<?php
                                                }else{
                                                ?>
												<input {{ $is_editable ? '' : 'disabled' }}
													name="daftar_perangkat_telsus[{{ $key }}][foto_perangkat]"
													value="{{ str_replace('storage/file_syarat/', '', $d['foto_perangkat']) }}" type="text"
													class="form-control border-right-0" placeholder="{{ isset($mi->nama_asli) ? $mi->nama_asli : '' }}">
												<?php
                                                }
                                                ?>
												<span class="input-group-append">
													<?php 
                                                if (isset($d['foto_perangkat']) && $d['foto_perangkat'] != '') {
                                                    ?><a target="_blank" href="{{ url($d['foto_perangkat']) }}" class="btn btn-teal"
														type="button">Lihat Dokumen</a>
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
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Tipe Perangkat</label>
										<input class="form-control tipe_perangkat"
											name="daftar_perangkat_telsus[{{ $key }}][tipe_perangkat]" value="{{ $d['tipe_perangkat'] }}"
											required {{ $is_editable ? '' : 'disabled' }} />
									</div>
									<div class="form-group">
										<label for="">Negara Asal Pembuat Perangkat</label>
										<input class="form-control buatan_perangkat"
											name="daftar_perangkat_telsus[{{ $key }}][buatan_perangkat]" value="{{ $d['buatan_perangkat'] }}"
											required {{ $is_editable ? '' : 'disabled' }} />
									</div>

									<div class="form-group">
										<label for="">Daftar <i>Serial Number</i> Perangkat</label>
										<div class="input-group">
											<?php $name = explode('/', $d['foto_sn_perangkat']); ?>
											<?php 
                                                if ($is_editable) {
                                                    ?><input type="file" accept="application/pdf" class="form-control h-auto"
												name="daftar_perangkat_telsus[{{ $key }}][foto_sn_perangkat]" />
											<input type="hidden" name="prv_foto_sn_perangkat[{{ $key }}]"
												value="{{ $d['foto_sn_perangkat'] }}">
											<?php
                                                }else{
                                                    ?>
											<input {{ $is_editable ? '' : 'disabled' }}
												name="daftar_perangkat_telsus[{{ $key }}][foto_sn_perangkat]"
												value="{{ str_replace('storage/file_syarat/', '', $d['foto_sn_perangkat']) }}" type="text"
												class="form-control border-right-0" placeholder="{{ isset($mi->nama_asli) ? $mi->nama_asli : '' }}">
											<?php
                                                }
                                                ?>
											<span class="input-group-append">
												<?php 
                                                if (isset($d['foto_sn_perangkat']) && $d['foto_sn_perangkat'] != '') {
                                                    ?><a target="_blank" href="{{ url($d['foto_sn_perangkat']) }}" class="btn btn-teal"
													type="button">Lihat Dokumen</a>
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
							<div class="row mt-3">
								@if (isset($d['sertifikasi_alat']) && $d['sertifikasi_alat'])
									<div class="col-12">
										<div class="form-group">
											<p class="font-weight-semibold">Lampiran Sertifikasi Perangkat</p>
											<div class="input-group">
												<?php $name = explode('/', $d['sertifikasi_alat']); ?>
												<?php 
                                                if ($is_editable) {
                                                    ?><input type="file" accept="application/pdf" class="form-control h-auto"
													name="daftar_perangkat_telsus[{{ $key }}][sertifikasi_alat]" />
												<input type="hidden" name="prv_sertifikasi_alat[{{ $key }}]"
													value="{{ $d['sertifikasi_alat'] }}">
												<?php
                                                }else{
                                                    ?>
												<input {{ $is_editable ? '' : 'disabled' }}
													name="daftar_perangkat_telsus[{{ $key }}][sertifikasi_alat]"
													value="{{ str_replace('storage/file_syarat/', '', $d['sertifikasi_alat']) }}" type="text"
													class="form-control border-right-0" placeholder="{{ isset($mi->nama_asli) ? $mi->nama_asli : '' }}">
												<?php
                                                }
                                                ?>

												<span class="input-group-append">
													<?php 
                                                    if (isset($d['sertifikasi_alat']) && $d['sertifikasi_alat'] != '') {
                                                        ?><a target="_blank" href="{{ url($d['sertifikasi_alat']) }}" class="btn btn-teal"
														type="button">Lihat Dokumen</a>
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
								@else
									<div class="col-12">
										<div class="form-group hidden">
											<label for="">Lampiran Sertifikasi Perangkat</label>
											<input type="file" accept="application/pdf" class="form-control sertifikasi_alat h-auto"
												name="daftar_perangkat_telsus[{{ $key }}][sertifikasi_alat]" />
										</div>
									</div>
								@endif
							</div>
						</div>
					@endif
				@else
					<div class="px-3 py-3 daftar-perangkat-item">
						{{-- @if ($is_editable)
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="isdeleted_perangkat">Hapus perangkat? </label>
                        </div>
                        <div class="form-group custom-control custom-switch custom-switch-square custom-control-danger">
                            <input type="checkbox" name="daftar_perangkat_telsus[{{ $key }}][isdeleted_perangkat]"
                                class="form-control isdeleted_perangkat custom-control-input" id="isdeleted_perangkat">
                            <label class="custom-control-label" for="isdeleted_perangkat"></label>
                        </div>
                    </div>

                </div>
                <hr class="w-100" />
                @endif --}}
						@if ($is_editable)
							<div class="col-md-2">
								<label for="isdeleted_perangkat">Hapus perangkat? </label>
							</div>
							<div>
								<select name="daftar_perangkat_telsus[{{ $key }}][isdeleted_perangkat]" id=""
									class="form-control isdeleted_perangkat" required>
									<option name="daftar_perangkat_telsus[{{ $key }}][isdeleted_perangkat]" value="1" selected>
										Tidak
									</option>
									<option name="daftar_perangkat_telsus[{{ $key }}][isdeleted_perangkat]" value="2">Hapus
									</option>

								</select>
							</div>
							<hr class="w-100" />
						@endif
						@if (isset($d['sertifikat_perangkat']))
							@if ($is_editable)
								<div class="col-md-12">
									<label for="switchPerangkat">Apakah anda memiliki sertifikat perangkat?</label>
									<input type="checkbox" class="switchPerangkat" id="switchPerangkat"
										{{ $d['sertifikat_perangkat'] ? 'checked' : '' }}>
								</div>

								<div class="col-md-12">
									<div class="form-group {{ $d['sertifikat_perangkat'] ?? 'hidden' }}">
										<label for="">Nomor Sertifikat Perangkat</label>
										<input class="form-control sertifikat_perangkat"
											name="daftar_perangkat_telsus[{{ $key }}][sertifikat_perangkat]"
											value="{{ $d['sertifikat_perangkat'] }}" {{ $is_editable ? '' : 'disabled' }} />
									</div>
								</div>
							@endif
						@endif
						@if (isset($d['lokasi_perangkat']))
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Lokasi Perangkat</label>
										<textarea class="form-control lokasi_perangkat" name="daftar_perangkat_telsus[{{ $key }}][lokasi_perangkat]"
										 {{ $is_editable ? '' : 'disabled' }} required>{{ $d['lokasi_perangkat'] }}</textarea>
									</div>
								</div>
							</div>
						@endif

						<div class="row mt-3">
							<div class="col-md-6">
								@if (isset($d['jenis_perangkat']))
									<div class="form-group">
										<label for="">Jenis Perangkat</label>
										<input class="form-control jenis_perangkat"
											name="daftar_perangkat_telsus[{{ $key }}][jenis_perangkat]" value="{{ $d['jenis_perangkat'] }}"
											required {{ $is_editable ? '' : 'disabled' }} />
									</div>
								@endif

								@if (isset($d['merk_perangkat']))
									<div class="form-group">
										<label for="">Merk Perangkat</label>
										<input class="form-control merk_perangkat"
											name="daftar_perangkat_telsus[{{ $key }}][merk_perangkat]" value="{{ $d['merk_perangkat'] }}"
											required {{ $is_editable ? '' : 'disabled' }} />
									</div>
								@endif

								@if (isset($d['sn_perangkat']))
									<div class="form-group">
										<label for="">Nomor <i>Serial Number</i> Perangkat</label>
										<input class="form-control sn_perangkat" name="daftar_perangkat_telsus[{{ $key }}][sn_perangkat]"
											value="{{ $d['sn_perangkat'] }}" required {{ $is_editable ? '' : 'disabled' }} />
									</div>
								@endif

								<div class="form-group">
									<div class="col-12">
										<p class="font-weight-semibold">Bukti Kepemilikan Perangkat</p>
										<div class="input-group">
											<?php
											$name = explode('/', $d['foto_perangkat']);
											?>
											<?php 
                                                if ($is_editable) {
                                                ?><input type="file" accept="application/pdf" class="form-control h-auto"
												name="daftar_perangkat_telsus[{{ $key }}][foto_perangkat]"
												value="{{ str_replace('storage/file_syarat/', '', $d['foto_perangkat']) }}"
												placeholder="{{ str_replace('storage/file_syarat/', '', $d['foto_perangkat']) }}" />
											<input type="hidden" name="prv_foto_perangkat[{{ $key }}]" value="{{ $d['foto_perangkat'] }}">
											<?php
                                                }else{
                                                ?>
											<input {{ $is_editable ? '' : 'disabled' }}
												name="daftar_perangkat_telsus[{{ $key }}][foto_perangkat]"
												value="{{ str_replace('storage/file_syarat/', '', $d['foto_perangkat']) }}" type="text"
												class="form-control border-right-0" placeholder="{{ isset($mi->nama_asli) ? $mi->nama_asli : '' }}">
											<?php
                                                }
                                                ?>
											<span class="input-group-append">
												<?php 
                                                if (isset($d['foto_perangkat']) && $d['foto_perangkat'] != '') {
                                                    ?><a target="_blank" href="{{ url($d['foto_perangkat']) }}" class="btn btn-teal"
													type="button">Lihat Dokumen</a>
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
							<div class="col-md-6">
								@if (isset($d['tipe_perangkat']))
									<div class="form-group">
										<label for="">Tipe Perangkat</label>
										<input class="form-control tipe_perangkat"
											name="daftar_perangkat_telsus[{{ $key }}][tipe_perangkat]" value="{{ $d['tipe_perangkat'] }}"
											required {{ $is_editable ? '' : 'disabled' }} />
									</div>
								@endif
								@if (isset($d['buatan_perangkat']))
									<div class="form-group">
										<label for="">Negara Asal Pembuat Perangkat</label>
										<input class="form-control buatan_perangkat"
											name="daftar_perangkat_telsus[{{ $key }}][buatan_perangkat]"
											value="{{ $d['buatan_perangkat'] }}" required {{ $is_editable ? '' : 'disabled' }} />
									</div>
								@endif

								<div class="form-group">
									<div class="col-md-12">
										<label for="">Daftar <i>Serial Number</i> Perangkat</label>
										<div class="input-group">
											<?php $name = explode('/', $d['foto_sn_perangkat']); ?>
											<?php 
                                                if ($is_editable) {
                                                    ?><input type="file" accept="application/pdf" class="form-control h-auto"
												name="daftar_perangkat_telsus[{{ $key }}][foto_sn_perangkat]" />
											<input type="hidden" name="prv_foto_sn_perangkat[{{ $key }}]"
												value="{{ $d['foto_sn_perangkat'] }}">
											<?php
                                                }else{
                                                    ?>
											<input {{ $is_editable ? '' : 'disabled' }}
												name="daftar_perangkat_telsus[{{ $key }}][foto_sn_perangkat]"
												value="{{ str_replace('storage/file_syarat/', '', $d['foto_sn_perangkat']) }}" type="text"
												class="form-control border-right-0" placeholder="{{ isset($mi->nama_asli) ? $mi->nama_asli : '' }}">
											<?php
                                                }
                                                ?>
											<span class="input-group-append">
												<?php 
                                                if (isset($d['foto_sn_perangkat']) && $d['foto_sn_perangkat'] != '') {
                                                    ?><a target="_blank" href="{{ url($d['foto_sn_perangkat']) }}" class="btn btn-teal"
													type="button">Lihat Dokumen</a>
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
						<div class="row mt-3">
							@if (isset($d['sertifikasi_alat']) && $d['sertifikasi_alat'])
								<div class="col-12">
									<div class="form-group">
										<p class="font-weight-semibold">Lampiran Sertifikasi Perangkat</p>
										<div class="input-group">
											<?php $name = explode('/', $d['sertifikasi_alat']); ?>
											<?php 
                                                if ($is_editable) {
                                                    ?><input type="file" accept="application/pdf" class="form-control h-auto"
												name="daftar_perangkat_telsus[{{ $key }}][sertifikasi_alat]" />
											<input type="hidden" name="prv_sertifikasi_alat[{{ $key }}]"
												value="{{ $d['sertifikasi_alat'] }}">
											<?php
                                                }else{
                                                    ?>
											<input {{ $is_editable ? '' : 'disabled' }}
												name="daftar_perangkat_telsus[{{ $key }}][sertifikasi_alat]"
												value="{{ str_replace('storage/file_syarat/', '', $d['sertifikasi_alat']) }}" type="text"
												class="form-control border-right-0" placeholder="{{ isset($mi->nama_asli) ? $mi->nama_asli : '' }}">
											<?php
                                                }
                                                ?>

											<span class="input-group-append">
												<?php 
                                                    if (isset($d['sertifikasi_alat']) && $d['sertifikasi_alat'] != '') {
                                                        ?><a target="_blank" href="{{ url($d['sertifikasi_alat']) }}" class="btn btn-teal"
													type="button">Lihat Dokumen</a>
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
							@else
								<div class="col-12">
									<div class="form-group hidden">
										<label for="">Lampiran Sertifikasi Perangkat</label>
										<input type="file" accept="application/pdf" class="form-control sertifikasi_alat h-auto"
											name="daftar_perangkat_telsus[{{ $key }}][sertifikasi_alat]" />
									</div>
								</div>
							@endif
						</div>
					</div>
				@endif
			@endforeach
		@else
			<div class="device-form-row px-3 py-3 daftar-perangkat-item" data-index="0">
				<div>
					<div class="">
						<label for="switchPerangkat">Apakah anda memiliki sertifikat
							perangkat?</label>
						<input type="checkbox" class="switchPerangkat" id="switchPerangkat">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group hidden">
							<label for="">No Sertifikat Perangkat</label>
							<input class="form-control sertifikat_perangkat" name="daftar_perangkat_telsus[0][sertifikat_perangkat]" />
						</div>
					</div>
					<div class="col-6">
						<div class="form-group hidden">
							<label for="">Lampiran Sertifikasi Perangkat</label>
							<input type="file" accept="application/pdf" class="form-control sertifikasi_alat h-auto"
								name="daftar_perangkat_telsus[0][sertifikasi_alat]" />

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<a class="btn btn-success verifyPerangkat hidden">Verifikasi Sertifikat</a>
						</div>
					</div>
				</div>
				<hr class="w-100" />
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Lokasi Perangkat</label>
							<textarea class="form-control lokasi_perangkat" name="daftar_perangkat_telsus[0][lokasi_perangkat]" required></textarea>
						</div>
					</div>
				</div>
				<hr class="w-100" />
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Jenis Perangkat</label>
							<input class="form-control jenis_perangkat" name="daftar_perangkat_telsus[0][jenis_perangkat]" required />
						</div>
						<div class="form-group">
							<label for="">Merk Perangkat</label>
							<input class="form-control merk_perangkat" name="daftar_perangkat_telsus[0][merk_perangkat]" required />
						</div>
						{{-- <div class="form-group">
                            <label for="">Nomor <i>Serial Number</i> Perangkat</label>
                            <input class="form-control sn_perangkat" name="daftar_perangkat_telsus[0][sn_perangkat]"
                                required />
                        </div> --}}
						<div class="form-group">
							<label for="">Bukti Kepemilikan Perangkat</label>
							<input type="file" accept="application/pdf" class="form-control foto_perangkat h-auto"
								name="daftar_perangkat_telsus[0][foto_perangkat]" required />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Tipe Perangkat</label>
							<input class="form-control tipe_perangkat" name="daftar_perangkat_telsus[0][tipe_perangkat]" required />
						</div>
						<div class="form-group">
							<label for="">Negara Asal Pembuat Perangkat</label>
							<input class="form-control buatan_perangkat" name="daftar_perangkat_telsus[0][buatan_perangkat]" required />
						</div>
						{{-- <div class="form-group hidden">
                            <label for="">Nomor Sertifikat Perangkat</label>
                            <input class="form-control sertifikat_perangkat"
                                name="daftar_perangkat_telsus[0][sertifikat_perangkat]" />
                        </div> --}}
						<div class="form-group">
							<div class="col-md-12">
								<label for="">Daftar <i>Serial Number</i> Perangkat</label>
								<input type="file" accept="application/pdf" class="form-control h-auto"
									name="daftar_perangkat_telsus[0][foto_sn_perangkat]" required />
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
		{{--
        </div> --}}
	</div>
</div>
@if ($datajson == 'kosong' || $is_editable)
	<div class="mt-2 text-right">
		<button id="add-daftar-perangkat" type="button" class="btn-secondary btn-sm">Tambah Data
			Alat/Perangkat</button>
	</div>
@endif

<script nonce="unique-nonce-value">
	let deviceIndex = 0;
	document.addEventListener('DOMContentLoaded', function() {
		let deviceIndex = 0;
		// const addDaftarPerangkatItem = function() {

		// 	// start = 0;
		// 	// totalDaftarPerangkat = 0;
		// 	// options = ``;

		// 	// function countTotalDaftarPerangkat() {
		// 	// 	return document.querySelectorAll('.daftar-perangkat-item').length - 1;
		// 	// 	// return document.querySelectorAll('.daftar-perangkat-item').length;
		// 	// }
		// document.addEventListener('DOMContentLoaded', function () {
		// Main container for device forms
		const checkboxes = document.querySelectorAll('.switchPerangkat');
		// checkboxes.forEach(checkbox => {
		//     checkbox.addEventListener('change', function () {
		//         // Find the closest form group that contains the sertifikat_perangkat input
		//         const formGroup = this.closest('.row').nextElementSibling.querySelector('.form-group');

		//         // Show or hide the form group based on the checkbox state
		// 		console.log('working');
		//         if (formGroup) {
		//             if (this.checked) {
		//                 formGroup.classList.remove('hidden');
		//             } else {
		//                 formGroup.classList.add('hidden');
		//             }
		//         }
		//     });
		// });
		const container = document.getElementById('daftar_perangkat_telsus_lists');
		if (!container) {
			console.error('Device form container not found');
			return;
		}

		// Event delegation for remove button clicks
		container.addEventListener('click', function(event) {
			if (event.target && event.target.classList.contains('btn-delete-daftarperangkat')) {
				removeDeviceRow(event.target);
			}
		});
		container.addEventListener('click', function(event) {
			if (event.target && event.target.classList.contains('add-daftar-perangkat')) {
				addDeviceRow_(event.target);
			}
		});
		$('#add-daftar-perangkat').on('click', function() {
			// console.log('daftar_perangkat_lists_dalam');
			addDeviceRow_()
		});

		$('#remove_perangkat').on('click', function() {
			// console.log('daftar_perangkat_lists_dalam');
			removeDeviceRow()
		});

		function removeDeviceRow(button) {
			const row = button.closest('.device-form-row');
			console.log(row);
			if (row) {
				row.remove();
			}
		};


		function addDeviceRow_() {
			var deviceIndex = $('.daftar-perangkat-item').length;
			// console.log("Number of elements with class 'daftar-perangkat-item': " + count);	
			const container = document.getElementById('daftar_perangkat_telsus_lists');
			const newRow = document.createElement('div');
			newRow.classList.add('px-3', 'py-3', 'daftar-perangkat-item', 'device-form-row');
			newRow.style.border = '1px solid #ddd';
			newRow.style.position = 'relative';
			newRow.setAttribute('data-index', deviceIndex);

			// Create delete button
			const deleteButton = document.createElement('button');
			deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'btn-delete-daftarperangkat');
			deleteButton.type = 'button';
			deleteButton.style.positisertifikat_perangkaton = 'absolute';
			deleteButton.style.bottom = '20px';
			deleteButton.style.right = '20px';
			deleteButton.style.zIndex = '999';
			deleteButton.textContent = 'Hapus Data Tambahan';
			// deleteButton.onclick = () => removeDeviceRow(deleteButton);
			deleteButton.id = 'remove_perangkat';

			// Create device certificate checkbox
			const certCheckboxDiv = document.createElement('div');
			const certCheckboxLabel = document.createElement('label');
			certCheckboxLabel.htmlFor = `switchPerangkat_${deviceIndex}`;
			certCheckboxLabel.textContent = `	Apakah anda memiliki sertifikat perangkat?`;
			const certCheckbox = document.createElement('input');
			certCheckbox.type = 'checkbox';
			certCheckbox.classList.add('switchPerangkat');
			certCheckbox.id = `switchPerangkat_${deviceIndex}`;
			certCheckboxDiv.appendChild(certCheckboxLabel);
			certCheckboxDiv.appendChild(certCheckbox);

			// Create form rows and fields
			const row1 = document.createElement('div');
			row1.classList.add('row');
			const isChecked = false;
			const col1 = createColumn([
				createFormGroup('No Sertifikat Perangkat', 'daftar_perangkat_telsus', deviceIndex,
					'sertifikat_perangkat', 'text', null, false, 'hidden'),
				createFormGroup('Lampiran Sertifikasi Perangkat', 'daftar_perangkat_telsus', deviceIndex,
					'sertifikasi_alat', 'file', 'application/pdf', false, 'hidden'),
			], 'col-md-12');

			const col2 = createColumn([
				createFormGroup('Lokasi Perangkat', 'daftar_perangkat_telsus', deviceIndex,
					'lokasi_perangkat',
					'textarea', null, true),
				createFormGroup('Jenis Perangkat', 'daftar_perangkat_telsus', deviceIndex,
					'jenis_perangkat'),
				createFormGroup('Merk Perangkat', 'daftar_perangkat_telsus', deviceIndex,
					'merk_perangkat'),
				createFormGroup('Bukti Kepemilikan Perangkat', 'daftar_perangkat_telsus', deviceIndex,
					'foto_perangkat',
					'file', 'application/pdf'),
			], 'col-md-6');

			const col3 = createColumn([
				createFormGroup('Tipe Perangkat', 'daftar_perangkat_telsus', deviceIndex,
					'tipe_perangkat'),
				createFormGroup('Negara Asal Pembuat Perangkat', 'daftar_perangkat_telsus', deviceIndex,
					'buatan_perangkat'),
				createFormGroup('Nomor Serial Number Perangkat', 'daftar_perangkat_telsus', deviceIndex,
					'sn_perangkat'),
				createFormGroup('Foto Serial Number Perangkat', 'daftar_perangkat_telsus', deviceIndex,
					'foto_sn_perangkat', 'file', 'application/pdf'),
			], 'col-md-6');

			row1.appendChild(col1);
			row1.appendChild(col2);
			row1.appendChild(col3);

			newRow.appendChild(deleteButton);
			newRow.appendChild(certCheckboxDiv);
			newRow.appendChild(row1);

			container.appendChild(newRow);
			deviceIndex++;
		}

		function createColumn(formGroups, colClass) {
			const col = document.createElement('div');
			col.classList.add(colClass);
			formGroups.forEach(group => col.appendChild(group));
			return col;
		}

		function createFormGroup(labelText, namePrefix, index, nameSuffix, type = 'text', accept = null,
			isRequired = false, HideState = null) {
			const formGroup = document.createElement('div');
			formGroup.classList.add('form-group');
			if (HideState) {
				formGroup.classList.add(HideState);
			}

			const label = document.createElement('label');
			label.textContent = labelText;

			let input;
			if (type === 'textarea') {
				input = document.createElement('textarea');
				input.classList.add('form-control');
			} else {
				input = document.createElement('input');
				input.type = type;
				input.classList.add('form-control');
				if (accept) {
					input.accept = accept;
				}
			}

			input.name = `${namePrefix}[${index}][${nameSuffix}]`;
			if (isRequired) {
				input.required = true;
			}

			formGroup.appendChild(label);
			formGroup.appendChild(input);

			return formGroup;
		}
	});
	// $('document').ready(function() {

	//     const addDaftarPerangkatItem = function() {

	//         start = 0;
	//         totalDaftarPerangkat = 0;
	//         options = ``;

	//         function countTotalDaftarPerangkat() {
	//             // return document.querySelectorAll('.daftar-perangkat-item').length - 1;
	//             return document.querySelectorAll('.daftar-perangkat-item').length;
	//         }

	//         $('#add-daftar-perangkat').on('click', function() {
	//             this.totalDaftarPerangkat = countTotalDaftarPerangkat();
	//             console.log(this.totalDaftarPerangkat);
	//             const inputRow = `
	//             <div class="px-3 py-3 daftar-perangkat-item" style="border: 1px solid #ddd;position: relative;">

	//                     <div>
	//                         <div class="">
	//                             <label for="switchPerangkat"> ` + this.totalDaftarPerangkat + ` Apakah anda memiliki sertifikat perangkat?</label>
	//                             <input type="checkbox" class="switchPerangkat" id="switchPerangkat">
	//                         </div>
	//                     </div>
	//                     <div class="row">
	//                         <div class="col-md-6">
	//                             <div class="form-group hidden">
	//                                 <label for="">No Sertifikat Perangkat</label>
	//                                 <input class="form-control sertifikat_perangkat"
	//                                     name="daftar_perangkat_telsus[` + this.totalDaftarPerangkat + `][sertifikat_perangkat]" />
	//                             </div>
	//                         </div>
	//                         <div class="col-6">
	//                             <div class="form-group hidden">
	//                                 <label for="">Lampiran Sertifikasi Perangkat</label>
	//                                 <input type="file" accept="application/pdf" class="form-control sertifikasi_alat h-auto"
	//                                     name="daftar_perangkat_telsus[` + this.totalDaftarPerangkat + `][sertifikasi_alat]" />

	//                             </div>
	//                         </div>
	//                     </div>
	//                     <div class="row">
	//                         <div class="col-md-12">
	//                             <div class="form-group">
	//                                 <a class="btn btn-success verifyPerangkat hidden">Verifikasi Sertifikat</a>
	//                             </div>
	//                         </div>
	//                     </div>
	//                     <hr class="w-100" />
	//                     <div class="row">
	//                         <div class="col-md-12">
	//                             <div class="form-group">
	//                                 <label for="">Lokasi Perangkat</label>
	//                                 <textarea class="form-control lokasi_perangkat" name="daftar_perangkat_telsus[` +
	//                 this
	//                 .totalDaftarPerangkat + `][lokasi_perangkat]" required></textarea>
	//                             </div>
	//                         </div>
	//                     </div>
	//                     <hr class="w-100"/>
	//                     <div class="row">                            
	//                         <div class="col-md-6">
	//                             <div class="form-group">
	//                                 <label for="">Jenis Perangkat</label>
	//                                 <input class="form-control jenis_perangkat" name="daftar_perangkat_telsus[` + this
	//                 .totalDaftarPerangkat + `][jenis_perangkat]" required />
	//                             </div>
	//                             <div class="form-group">
	//                                 <label for="">Merk Perangkat</label>
	//                                 <input class="form-control merk_perangkat" name="daftar_perangkat_telsus[` + this
	//                 .totalDaftarPerangkat +
	//                 `][merk_perangkat]" required />
	//                             </div>
	//                             <div class = "form-group" >
	//                                 <label for = "" > Bukti Kepemilikan Perangkat </label>
	//                                 <input type = "file" accept = "application/pdf" class = "form-control foto_perangkat h-auto" name = "daftar_perangkat_telsus[` +
	//                 this.totalDaftarPerangkat + `][foto_perangkat]" required /> 
	//                             </div>
	//                         </div> 
	//                         <div class = "col-md-6" >
	//                             <div class = "form-group" >
	//                                 <label for = "" > Tipe Perangkat </label> 
	//                                 <input class = "form-control tipe_perangkat" name = "daftar_perangkat_telsus[` +
	//                 this
	//                 .totalDaftarPerangkat + `][tipe_perangkat]" required />
	//                             </div>
	//                             <div class="form-group">
	//                                 <label for="">Negara Asal Pembuat Perangkat</label>
	//                                 <input class="form-control buatan_perangkat" name="daftar_perangkat_telsus[` + this
	//                 .totalDaftarPerangkat +
	//                 `][buatan_perangkat]" required />
	//                             </div>
	//                             <div class="form-group">
	//                                 <div class="col-md-12">
	//                                     <label for="">Daftar <i>Serial Number</i> Perangkat</label>
	//                                     <input type="file" accept="application/pdf" class="form-control foto_sn_perangkat h-auto" name="daftar_perangkat_telsus[` +
	//                 this.totalDaftarPerangkat + `][foto_sn_perangkat]" required />
	//                                 </div>
	//                             </div>
	//                         </div>
	//                     </div>
	//                     <hr class="w-100"/>
	//                     <div>
	//                     <button
	//                         class="btn btn-danger btn-sm btn-delete-daftarperangkat"
	//                         type="button"
	//                         onclick="javascript:onDeleteRencanaDaftarPerangkat(this);return false;"
	//                     >Hapus Data Tambahan</button>
	//                     </div>

	//                 </div>     
	//             `;
	//             $('#daftar_perangkat_telsus_lists').append(inputRow);
	//         });
	//     }
	//     addDaftarPerangkatItem();

	//     $('.btn-delete-daftarperangkat').click(function(e) {
	//         console.log(e);
	//     });

	//     $(document).on('click', '.switchPerangkat', function() {
	//         let perangkat = $(this).parents('.daftar-perangkat-item')
	//         if ($(this).is(':checked')) {
	//             perangkat.find('.verifyPerangkat').removeClass('hidden')
	//             perangkat.find('.sertifikat_perangkat').parent('div').removeClass('hidden')
	//             perangkat.find('.sertifikat_perangkat').attr('required', true)

	//             perangkat.find('.sertifikasi_alat').parent('div').removeClass('hidden')
	//             perangkat.find('.sertifikasi_alat').attr('required', true)
	//         } else {
	//             perangkat.find('.verifyPerangkat').addClass('hidden')
	//             perangkat.find('.sertifikat_perangkat').parent('div').addClass('hidden')
	//             perangkat.find('.sertifikat_perangkat').removeAttr('required')

	//             perangkat.find('.sertifikasi_alat').parent('div').addClass('hidden')
	//             perangkat.find('.sertifikasi_alat').removeAttr('required')
	//         }
	//     });
	//     $(document).on('click', 'a.verifyPerangkat', function(e) {
	//         console.log('asd')
	//         let integration = $(this).parents('.daftar-perangkat-item')
	//         let val = integration.find('input.sertifikat_perangkat').val()
	//         let token
	//         e.preventDefault();
	//         $.ajax({
	//             type: "GET",
	//             url: "https://dev-middleware.ditfrek.postel.go.id/middleware_sdppi/get_token",
	//             data: {
	//                 username: "telecomunication", // < note use of 'this' here
	//                 password: "tele324", // < note use of 'this' here
	//             },
	//             async: false,
	//             success: function(result) {
	//                 token = result.tokens
	//             },
	//             error: function(error) {
	//                 alert("Tidak dapat terhubung ke server!")
	//             }
	//         });

	//         $.ajax({
	//             type: "GET",
	//             url: "https://dev-middleware.ditfrek.postel.go.id/middleware_sdppi/certification/index",
	//             headers: {
	//                 "Authorization": "Bearer " + token
	//             },
	//             data: {
	//                 search: val, // < note use of 'this' here
	//             },
	//             success: function(result) {
	//                 if (result.data) {
	//                     alert("Perangkat Ditemukan")
	//                     if (result.data[0].device_brand) {
	//                         integration.find('.merk_perangkat').val(result.data[0]
	//                             .device_brand)
	//                         integration.find('.merk_perangkat').attr('readonly')
	//                     }
	//                     if (result.data[0].device_model) {
	//                         integration.find('.jenis_perangkat').val(result.data[0]
	//                             .device_model)
	//                         integration.find('.jenis_perangkat').attr('readonly')
	//                     }
	//                 } else {
	//                     alert("Perangkat tidak Ditemukan")
	//                 }
	//             },
	//             error: function(error) {
	//                 // alert(error)
	//                 alert("Tidak dapat terhubung ke server!")
	//             }
	//         });
	//     });
	// });

	// function onDeleteRencanaDaftarPerangkat(e) {
	//     // remove selected item
	//     e.parentNode.remove();

	//     // recons index
	//     $('.daftar-perangkat-item').each(function(index, element) {
	//         $(this).find('.lokasi_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
	//             '][lokasi_perangkat]');
	//         $(this).find('.jenis_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
	//             '][jenis_perangkat]');
	//         $(this).find('.merk_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
	//             '][merk_perangkat]');
	//         $(this).find('.tipe_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
	//             '][tipe_perangkat]');
	//         $(this).find('.buatan_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
	//             '][buatan_perangkat]');
	//         // $(this).find('.sn_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][sn_perangkat]');
	//         $(this).find('.sertifikat_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
	//             '][sertifikat_perangkat]');
	//         $(this).find('.foto_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
	//             '][foto_perangkat]');
	//         $(this).find('.foto_sn_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
	//             '][foto_sn_perangkat]');
	//     });

	// }

	// function removeperangkat(index) {
	//     $(this).find('.lokasi_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][lokasi_perangkat]')
	//         .remove();
	//     $(this).find('.jenis_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][jenis_perangkat]')
	//         .remove();
	//     $(this).find('.merk_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][merk_perangkat]').remove();
	//     $(this).find('.tipe_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][tipe_perangkat]').remove();
	//     $(this).find('.buatan_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][buatan_perangkat]')
	//         .remove();
	//     // $(this).find('.sn_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][sn_perangkat]').remove();
	//     $(this).find('.sertifikat_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
	//         '][sertifikat_perangkat]').remove();
	//     $(this).find('.foto_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][foto_perangkat]').remove();
	//     $(this).find('.foto_sn_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
	//         '][foto_sn_perangkat]').remove();

	// }

	$(document).on('click', '.switchPerangkat', function() {
		let perangkat = $(this).closest('.daftar-perangkat-item');
		// let index = $(this).data('data-index'); // Assuming you have a data attribute to track index
		let index = perangkat.attr('data-index');
		console.log(index);

		if ($(this).is(':checked')) {
			perangkat.find('.verifyPerangkat').removeClass('hidden');
			perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
				'][sertifikat_perangkat]"]').parent('div').removeClass('hidden');
			perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
				'][sertifikat_perangkat]"]').attr('required', true);
			perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
				'][sertifikasi_alat]"]').parent('div').removeClass('hidden');
			perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
				'][sertifikasi_alat]"]').attr('required', true);
		} else {
			perangkat.find('.verifyPerangkat').addClass('hidden');
			perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
				'][sertifikat_perangkat]"]').parent('div').addClass('hidden');
			perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
				'][sertifikat_perangkat]"]').removeAttr('required');
			perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
				'][sertifikasi_alat]"]').parent('div').addClass('hidden');
			perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
				'][sertifikasi_alat]"]').removeAttr('required');
		}
	});
	$(document).on('click', 'a.verifyPerangkat', function(e) {
		console.log('asd')
		let integration = $(this).parents('.daftar-perangkat-item')
		let val = integration.find('input.sertifikat_perangkat').val()
		let token
		e.preventDefault();
		$.ajax({
			type: "GET",
			url: "https://middleware.ditfrek.postel.go.id/middleware_sdppi/get_token",
			data: {
				username: "xxxx", // < note use of 'this' here
				password: "xxx", // < note use of 'this' here
			},
			async: false,
			success: function(result) {
				token = result.tokens
			},
			error: function(error) {
				alert("Tidak dapat terhubung ke server!")
			}
		});

		$.ajax({
			type: "GET",
			url: "https://middleware.ditfrek.postel.go.id/middleware_sdppi/certification/index",
			headers: {
				"Authorization": "Bearer " + token
			},
			data: {
				search: val, // < note use of 'this' here
			},
			success: function(result) {
				if (result.data) {
					alert("Perangkat Ditemukan")
					if (result.data[0].device_brand) {
						integration.find('.merk_perangkat').val(result.data[0]
							.device_brand)
						integration.find('.merk_perangkat').attr('readonly')
					}
					if (result.data[0].device_model) {
						integration.find('.jenis_perangkat').val(result.data[0]
							.device_model)
						integration.find('.jenis_perangkat').attr('readonly')
					}
				} else {
					alert("Perangkat tidak Ditemukan")
				}
			},
			error: function(error) {
				// alert(error)
				alert("Tidak dapat terhubung ke server!")
			}
		});
		// });
	});

	function onDeleteRencanaDaftarPerangkat(e) {
		// remove selected item
		e.parentNode.remove();

		// recons index
		$('.daftar-perangkat-item').each(function(index, element) {
			$(this).find('.lokasi_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
				'][lokasi_perangkat]');
			$(this).find('.jenis_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
				'][jenis_perangkat]');
			$(this).find('.merk_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][merk_perangkat]');
			$(this).find('.tipe_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][tipe_perangkat]');
			$(this).find('.buatan_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
				'][buatan_perangkat]');
			$(this).find('.sn_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][sn_perangkat]');
			$(this).find('.sertifikat_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
				'][sertifikat_perangkat]');
			$(this).find('.foto_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][foto_perangkat]');
			$(this).find('.foto_sn_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
				'][foto_sn_perangkat]');
		});

	}

	function removeperangkat(index) {
		$(this).find('.lokasi_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][lokasi_perangkat]')
			.remove();
		$(this).find('.jenis_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][jenis_perangkat]').remove();
		$(this).find('.merk_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][merk_perangkat]').remove();
		$(this).find('.tipe_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][tipe_perangkat]').remove();
		$(this).find('.buatan_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][buatan_perangkat]')
			.remove();
		$(this).find('.sn_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][sn_perangkat]').remove();
		$(this).find('.sertifikat_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
			'][sertifikat_perangkat]').remove();
		$(this).find('.foto_perangkat').attr('name', 'daftar_perangkat_telsus[' + index + '][foto_perangkat]').remove();
		$(this).find('.foto_sn_perangkat').attr('name', 'daftar_perangkat_telsus[' + index +
			'][foto_sn_perangkat]').remove();

	}
	$(document).ready(function() {
		// $(document).on('click', '.switchPerangkat', function() {
		// 	let perangkat = $(this).parents('.daftar-perangkat-item')
		// 	console.log("Number of elements with class 'daftar-perangkat-item': " + perangkat);
		// 	if ($(this).is(':checked')) {
		// 		perangkat.find('.sertifikat_perangkat').parent('div').find('input[type="text"]').val(
		// 			'Checked');
		// 		perangkat.find('.verifyPerangkat').removeClass('hidden')
		// 		perangkat.find('.sertifikat_perangkat').parent('div').removeClass('hidden')
		// 		perangkat.find('.sertifikat_perangkat').attr('required', true)

		// 		perangkat.find('.sertifikasi_alat').parent('div').removeClass('hidden')
		// 		perangkat.find('.sertifikasi_alat').attr('required', true)
		// 	} else {
		// 		perangkat.find('.sertifikat_perangkat').parent('div').find('input[type="text"]').val(
		// 			'UnChecked');
		// 		perangkat.find('.verifyPerangkat').addClass('hidden')
		// 		perangkat.find('.sertifikat_perangkat').parent('div').addClass('hidden')
		// 		perangkat.find('.sertifikat_perangkat').removeAttr('required')

		// 		perangkat.find('.sertifikasi_alat').parent('div').addClass('hidden')
		// 		perangkat.find('.sertifikasi_alat').removeAttr('required')
		// 	}
		// });
		$(document).on('click', '.switchPerangkat', function() {
			let perangkat = $(this).closest('.daftar-perangkat-item');
			// let index = $(this).data('data-index'); // Assuming you have a data attribute to track index
			let index = perangkat.attr('data-index');
			// console.log(index);

			if ($(this).is(':checked')) {
				perangkat.find('.verifyPerangkat').removeClass('hidden');
				perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
					'][sertifikat_perangkat]"]').parent('div').removeClass('hidden');
				perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
					'][sertifikat_perangkat]"]').attr('required', true);
				perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
					'][sertifikasi_alat]"]').parent('div').removeClass('hidden');
				perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
					'][sertifikasi_alat]"]').attr('required', true);
			} else {
				perangkat.find('.verifyPerangkat').addClass('hidden');
				perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
					'][sertifikat_perangkat]"]').parent('div').addClass('hidden');
				perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
					'][sertifikat_perangkat]"]').removeAttr('required');
				perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
					'][sertifikasi_alat]"]').parent('div').addClass('hidden');
				perangkat.find('input.form-control[name="daftar_perangkat_telsus[' + index +
					'][sertifikasi_alat]"]').removeAttr('required');
			}
		});
	})
</script>
