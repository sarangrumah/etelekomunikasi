<link href="/global_assets/css/extras/select2.min.css" rel="stylesheet" />
<script src="/global_assets/js/plugins/forms/selects/select2.min.js"></script>

<style nonce="unique-nonce-value">
	.table-custom th,
	.table-custom tr,
	.table-custom td {
		border: 1px solid #ddd;
	}

	.table-custom tr td .form-control {
		padding: 2px 10px;
	}

	.select2-selection--single {
		padding: 0;
	}

	.form-control {
		height: auto;
	}

	.select2-container--default .select2-selection--single {
		border-color: #ddd;
	}
</style>

@php
	// $is_editable = (Session::get('id_mst_jobposition') === 12) || $needcorrection;
	$is_editable = $needcorrection ?? false;
	$is_penyesuaian = $penyesuaian ?? false; // add || OR jika terdapat kondisi lainya untuk editable input dibawah
	$tgl_penetapan = $ulo->created_at ?? ''; // add || OR jika terdapat kondisi lainya untuk editable input dibawah
@endphp

<div class="table-responsive">
	<table class="table table-custom table-sm">
		<thead>
			<tr>
				<th rowspan="2" class="text-center">Tahun</th>
				<th colspan="2" class="text-center">Pusat Pelayanan Pelanggan</th>
				<th rowspan="2" class="text-center">Jumlah Perjanjian Kerjasama (PKS) dengan Penyedia Konten
					Independen</th>
				<th rowspan="2">
					@if ($is_editable)
						Hapus?
					@endif
				</th>
			</tr>
			<tr>
				<th class="text-center">(Kota/Kab)</th>
				<th class="text-center">Jumlah</th>
			</tr>
		</thead>
		<tbody id="rencanausaha-lists">
			@if ($datajson !== 'kosong')
				<?php
				$datajson = json_decode($datajson, true);
				?>
				@foreach ($datajson as $key => $d)
					@if (\App\Helpers\DateHelper::getWorkingDays(date('Y-m-d'), date('Y') . '-02-28', []) < 20 && $is_penyesuaian)
						@if (date('Y', strtotime('+1 year')) >= date('Y', strtotime('+' . $loop->index . ' year', strtotime($tgl_penetapan))))
							@php $is_editable = false @endphp
						@else
							@php $is_editable = true @endphp
						@endif
					@elseif ($loop->first && $is_penyesuaian)
						@php $is_editable = false @endphp
					@elseif($is_penyesuaian)
						@php $is_editable = true @endphp
					@endif
					@if (isset($d['isdeleted_rencanausaha']))
						@if ($d['isdeleted_rencanausaha'] == '1')
							<tr class="rencanausaha-item">
								<td class="col-1">
									<input {{ $is_editable ? '' : 'readonly' }} value="{{ $d['tahun'] }}" min="1" type="number"
										oninput="validity.valid||(value='');" class="form-control tahun-rencanausaha"
										name="rencanausaha[{{ $key }}][tahun]" />
								</td>
								<td class="col-3">
									<select {{ $is_editable ? '' : 'readonly' }} name="rencanausaha[{{ $key }}][kota]" id=""
										class="form-control pilih-kota-rencanausaha">
										<option value="">Pilih kota</option>
										@foreach ($cities as $city)
											<option value="{{ $city->id }}" {{ $d['kota'] == $city->id ? 'selected' : '' }}>
												{{ $city->name }}
											</option>
										@endforeach
									</select>
								</td>
								<td class="col-3">
									<input {{ $is_editable ? '' : 'readonly' }} value="{{ $d['jumlah'] }}" type="text"
										class="form-control jumlah-rencanausaha" name="rencanausaha[{{ $key }}][jumlah]" />
								</td>
								<td>
									<input {{ $is_editable ? '' : 'readonly' }} value="{{ $d['pks'] }}" type="text"
										class="form-control pks-rencanausaha" name="rencanausaha[{{ $key }}][pks]" />
								</td>
								<td class="col-3">
									<div>
										<select name="rencanausaha[{{ $key }}][isdeleted_rencanausaha]" id=""
											class="form-control wilayah-isdeleted_rencanausaha" required>
											<option name="rencanausaha[{{ $key }}][isdeleted_rencanausaha]" value="1" selected>Tidak
											</option>
											<option name="rencanausaha[{{ $key }}][isdeleted_rencanausaha]" value="2">Hapus</option>

										</select>
									</div>
								</td>
							</tr>
						@endif
					@else
						<tr class="rencanausaha-item">
							<td class="col-1">
								<input {{ $is_editable ? '' : 'readonly' }} value="{{ $d['tahun'] }}" min="1" type="number"
									oninput="validity.valid||(value='');" class="form-control tahun-rencanausaha"
									name="rencanausaha[{{ $key }}][tahun]" />
							</td>
							<td class="col-3">
								<select {{ $is_editable ? '' : 'readonly' }} name="rencanausaha[{{ $key }}][kota]" id=""
									class="form-control pilih-kota-rencanausaha">
									<option value="">Pilih kota</option>
									@foreach ($cities as $city)
										<option value="{{ $city->id }}" {{ $d['kota'] == $city->id ? 'selected' : '' }}>
											{{ $city->name }}
										</option>
									@endforeach
								</select>
							</td>
							<td class="col-3">
								<input {{ $is_editable ? '' : 'readonly' }} value="{{ $d['jumlah'] }}" type="text"
									class="form-control jumlah-rencanausaha" name="rencanausaha[{{ $key }}][jumlah]" />
							</td>
							<td>
								<input {{ $is_editable ? '' : 'readonly' }} value="{{ $d['pks'] }}" type="text"
									class="form-control pks-rencanausaha" name="rencanausaha[{{ $key }}][pks]" />
							</td>
							<td class="col-1">
								<div>
									<select name="rencanausaha[{{ $key }}][isdeleted_rencanausaha]" id=""
										class="form-control wilayah-isdeleted_rencanausaha" required>
										<option name="rencanausaha[{{ $key }}][isdeleted_rencanausaha]" value="1" selected>Tidak
										</option>
										<option name="rencanausaha[{{ $key }}][isdeleted_rencanausaha]" value="2">Hapus</option>

									</select>
								</div>
							</td>
						</tr>
					@endif
				@endforeach
			@else
				@for ($i = 0; $i < 5; $i++)
					<tr class="rencanausaha-item">
						<td class="col-1">
							<input min="1" type="number" oninput="validity.valid||(value='');"
								class="form-control tahun-rencanausaha" name="rencanausaha[{{ $i }}][tahun]" />
						</td>
						<td class="col-3">
							<select name="rencanausaha[{{ $i }}][kota]" id=""
								class="form-control pilih-kota-rencanausaha">
								<option value="">Pilih kota</option>
								@foreach ($cities as $city)
									<option value="{{ $city->id }}">{{ $city->name }}</option>
								@endforeach
							</select>
						</td>
						<td class="col-3">
							<input type="text" class="form-control jumlah-rencanausaha"
								name="rencanausaha[{{ $i }}][jumlah]" />
						</td>
						<td class="col-3">
							<input type="text" class="form-control pks-rencanausaha" name="rencanausaha[{{ $i }}][pks]" />
						</td>
						<td></td>
					</tr>
				@endfor
			@endif
		</tbody>
		<tfoot>
			<tr>
				<small for="" class="text-danger mr-2">* Komitmen bersifat tahunan (jumlah total pada akhir
					tahun
					ke lima sama dengan penjumlahan tahun pertama hingga tahun ke lima)</small>
			</tr>
		</tfoot>
	</table>
	@if ($datajson == 'kosong' || $is_editable)
		<div class="text-right">
			<button class="btn btn-secondary my-2 btn-sm" type="button" id="add-rencanausaha">Tambah Data</button>
		</div>
	@endif
</div>

<script type="text/javascript" nonce="unique-nonce-value">
	$('document').ready(function() {

		const addRencanaUsahaItem = function() {

			var cities = {!! json_encode($cities) !!};
			start = 0;
			totalRencanaUsaha = 0;


			initSelect2();

			function initSelect2() {
				$('.pilih-kota-rencanausaha').each(function(index, element) {
					$(this).select2({
						placeholder: "Pilih Kota"
					})
				})
			}

			function countTotalRencanaUsaha() {
				return document.querySelectorAll('.rencanausaha-item').length;
			}

			$('#add-rencanausaha').on('click', function() {
				this.totalRencanaUsaha = countTotalRencanaUsaha() + 1;
				options = ``;

				for (let item of cities) {
					options += `<option value="` + item.id + `">` + item.name + `</option>`;
				}
				const inputRow =
					`
					<tr class="rencanausaha-item">
						<td class="col-1">
							<input min="1" oninput="validity.valid||(value='');" type="number" class="form-control tahun-rencanausaha" name="rencanausaha[` +
					this.totalRencanaUsaha + `][tahun]" />
						</td>
						<td class="col-3">
							<select
								name="rencanausaha[` + this.totalRencanaUsaha + `][kota]"
								class="form-control pilih-kota-rencanausaha"
							><option value="">Pilih Kota</option>` + options + ` </select>
						</td>
						<td class="col-3">
							<input class="form-control jumlah-rencanausaha" name="rencanausaha[` + this.totalRencanaUsaha + `][jumlah]" />
						</td>
						<td>
							<input class="form-control pks-rencanausaha" name="rencanausaha[` + this.totalRencanaUsaha + `][pks]" />
						</td class="col-3">
						<td class="col-1">
							<button
								class="btn btn-danger btn-samll btn-delete-rencanausaha"
								type="button"
								onclick="javascript:onDeleteRencanaUsahaItem(this);return false;"
							>&times;</button>
						</td>
					<tr>
				`;
				$('#rencanausaha-lists').append(inputRow);
				initSelect2();
			});
		}

		addRencanaUsahaItem();

		$('.btn-delete-rencanausaha').click(function(e) {
			console.log(e);
		})

	});

	function onDeleteRencanaUsahaItem(e) {
		// remove selected item
		e.parentNode.parentNode.remove();
		// recons index
		$('.rencanausaha-item').each(function(index, element) {
			let tahun = $(this).find('.tahun-rencanausaha');
			let kota = $(this).find('.pilih-kota-rencanausaha');
			let jumlah = $(this).find('.jumlah-rencanausaha');
			let pks = $(this).find('.pks-rencanausaha');
			tahun.attr('name', 'rencanausaha[' + index + '][tahun]');
			kota.attr('name', 'rencanausaha[' + index + '][kota]');
			jumlah.attr('name', 'rencanausaha[' + index + '][jumlah]');
			pks.attr('name', 'rencanausaha[' + index + '][pks]');
		});
	}
</script>
