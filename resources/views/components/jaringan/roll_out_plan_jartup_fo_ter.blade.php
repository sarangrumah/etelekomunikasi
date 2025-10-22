{{-- <link href="/global_assets/css/extras/select2.min.css" rel="stylesheet" /> --}}
<script src="/global_assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="/global_assets/js/demo_pages/form_select2.js"></script>
{{-- <style>
    .table-custom th,
    .table-custom tr,
    .table-custom td {
        border: 1px solid #ddd;
        vertical-align: top;
    }

    .table-custom tr td .form-control {
        padding: 2px 10px;
    }

    .select2-selection {
        width: 100%;
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

    .select2-container {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        width: 100% !important;
    }

    .select2-container--default .select2-selection--multiple,
    .select2-container--default .select2-selection--multiple:focus {
        border: none !important;
        height: auto !important;
    }
</style> --}}
@php
	$is_editable = $needcorrection ?? false; // add || OR jika terdapat kondisi lainya untuk editable input dibawah
	$is_penyesuaian = $penyesuaian ?? false; // add || OR jika terdapat kondisi lainya untuk editable input dibawah
	$tgl_penetapan = $ulo->created_at ?? ''; // add || OR jika terdapat kondisi lainya untuk editable input dibawah
@endphp
{{-- {{ \App\Helpers\DateHelper::getWorkingDays(date('Y-m-d'), date('Y')."-12-31", []) }} --}}
<div class="table-responsive">
	<table class="table table-custom table-sm">
		<thead>
			<tr>
				<th class="text-center">Periode</th>
				<th class="text-center">Jumlah Node</th>
				<th class="text-center">Lokasi Node (Kab/Kota)</th>
				<th class="text-center">Cakupan Wilayah Layanan (Kab/Kota)</th>
				<th class="text-center">Jumlah Kabel Fiber Optik (core)</th>
				<th class="text-center">Kapasitas <i>Bandwidth</i> (Gbps)</th>
				<th class="text-center">Panjang Rute Kabel Fiber Optik (km)</th>
			</tr>
		</thead>
		<tbody id="rolloutplan-lists">
			@if ($datajson !== 'kosong')
				<?php
				$datajson = json_decode($datajson, true);
				?>

				@foreach ($datajson as $key => $d)
					@if (isset($d['isdeleted']))
						@if ($d['isdeleted'] == '1')
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
							<tr class="rolloutplan-item">
								<td class="col-1">

									<input type="number" min="1" value="{{ $d['periode'] }}" {{ $is_editable ? '' : 'readonly' }}
										class="form-control periode" name="rolloutplan[{{ $key }}][periode]" required />
								</td>
								<td class="col-1">
									<input type="number" min="1" value="{{ $d['jumlah_node'] }}" {{ $is_editable ? '' : 'readonly' }}
										class="form-control jumlah_node" name="rolloutplan[{{ $key }}][jumlah_node]" required />

								</td>
								<td class="col-3">
									<select {{ $is_editable ? '' : 'readonly' }} class="form-control lokasi_cable_landing_station select w-100"
										name="rolloutplan[{{ $key }}][lokasi_node][]" multiple="multiple" required />
									@foreach ($cities as $city)
										<option value="{{ $city->id }}" {{ in_array($city->id, $d['lokasi_node']) ? 'selected' : '' }}>
											{{ $city->name }}
										</option>
									@endforeach
									</select>
								</td>
								<td class="col-3">
									<select {{ $is_editable ? '' : 'readonly' }} class="form-control lokasi_cable_landing_station select w-100"
										name="rolloutplan[{{ $key }}][cakupan_wilayah_layanan][]" multiple="multiple" required>
										@foreach ($cities as $city)
											<option value="{{ $city->id }}"
												{{ in_array($city->id, $d['cakupan_wilayah_layanan']) ? 'selected' : '' }}>
												{{ $city->name }}</option>
										@endforeach
									</select>
								</td>
								<td class="col-3">

									<input type="number" min="1" value="{{ $d['jumlah_kabel_fiber_optik'] }}"
										{{ $is_editable ? '' : 'readonly' }} class="form-control jumlah_kabel_fiber_optik"
										name="rolloutplan[{{ $key }}][jumlah_kabel_fiber_optik]" multiple="multiple" required />

								</td>
								<td class="col-3">
									<input type="text" value="{{ $d['kapasitas_bandwidth'] }}" {{ $is_editable ? '' : 'readonly' }}
										class="form-control kapasitas_bandwidth" name="rolloutplan[{{ $key }}][kapasitas_bandwidth]"
										required />
								</td>
								<td class="col-3">

									<input type="number" min="1" value="{{ $d['panjang_rute_kabel_fiber_optik'] }}"
										{{ $is_editable ? '' : 'readonly' }} class="form-control panjang_rute_kabel_fiber_optik"
										name="rolloutplan[{{ $key }}][panjang_rute_kabel_fiber_optik]" required />

								</td>
								@if ($needcorrection == 1)
									<td class="col-3">
										<div>
											<select name="rolloutplan[{{ $key }}][isdeleted]" id=""
												class="form-control isdeleted_cakupanwilayahtelsus_mtk" required>
												<option name="rolloutplan[{{ $key }}][isdeleted]" value="1" selected>Tidak</option>
												<option name="rolloutplan[{{ $key }}][isdeleted]" value="2">Hapus</option>

											</select>
										</div>
									</td>
								@endif
							</tr>
						@endif
					@else
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
						<tr class="rolloutplan-item">
							<td class="col-1">

								<input type="number" min="1" value="{{ $d['periode'] }}" {{ $is_editable ? '' : 'readonly' }}
									class="form-control periode" name="rolloutplan[{{ $key }}][periode]" required />
							</td>
							<td class="col-1">
								<input type="number" min="1" value="{{ $d['jumlah_node'] }}" {{ $is_editable ? '' : 'readonly' }}
									class="form-control jumlah_node" name="rolloutplan[{{ $key }}][jumlah_node]" required />

							</td>
							<td class="col-3">
								<select {{ $is_editable ? '' : 'readonly' }} class="form-control lokasi_cable_landing_station select w-100"
									name="rolloutplan[{{ $key }}][lokasi_node][]" multiple="multiple" required />
								@foreach ($cities as $city)
									<option value="{{ $city->id }}" {{ in_array($city->id, $d['lokasi_node']) ? 'selected' : '' }}>
										{{ $city->name }}
									</option>
								@endforeach
								</select>
							</td>
							<td class="col-3">
								<select {{ $is_editable ? '' : 'readonly' }} class="form-control lokasi_cable_landing_station select w-100"
									name="rolloutplan[{{ $key }}][cakupan_wilayah_layanan][]" multiple="multiple" required>
									@foreach ($cities as $city)
										<option value="{{ $city->id }}"
											{{ in_array($city->id, $d['cakupan_wilayah_layanan']) ? 'selected' : '' }}>
											{{ $city->name }}</option>
									@endforeach
								</select>
							</td>
							<td class="col-3">

								<input type="number" min="1" value="{{ $d['jumlah_kabel_fiber_optik'] }}"
									{{ $is_editable ? '' : 'readonly' }} class="form-control jumlah_kabel_fiber_optik"
									name="rolloutplan[{{ $key }}][jumlah_kabel_fiber_optik]" multiple="multiple" required />

							</td>
							<td class="col-3">
								<input type="text" value="{{ $d['kapasitas_bandwidth'] }}" {{ $is_editable ? '' : 'readonly' }}
									class="form-control kapasitas_bandwidth" name="rolloutplan[{{ $key }}][kapasitas_bandwidth]"
									required />
							</td>
							<td class="col-3">

								<input type="number" min="1" value="{{ $d['panjang_rute_kabel_fiber_optik'] }}"
									{{ $is_editable ? '' : 'readonly' }} class="form-control panjang_rute_kabel_fiber_optik"
									name="rolloutplan[{{ $key }}][panjang_rute_kabel_fiber_optik]" required />

							</td>
							@if ($needcorrection == 1)
								<td class="col-3">
									<div>
										<select name="rolloutplan[{{ $key }}][isdeleted]" id=""
											class="form-control isdeleted_cakupanwilayahtelsus_mtk" required>
											<option name="rolloutplan[{{ $key }}][isdeleted]" value="1" selected>Tidak</option>
											<option name="rolloutplan[{{ $key }}][isdeleted]" value="2">Hapus</option>

										</select>
									</div>
								</td>
							@endif
						</tr>
					@endif
				@endforeach
			@else
				@for ($i = 0; $i < 5; $i++)
					<tr class="rolloutplan-item">
						<td class="col-1">

							<input type="number" min="1" class="form-control periode"
								name="rolloutplan[{{ $i }}][periode]" required />
						</td>
						<td class="col-1">
							<input type="number" min="1" class="form-control jumlah_node"
								name="rolloutplan[{{ $i }}][jumlah_node]" required />

						</td>
						<td class="col-3">
							<select class="form-control select w-100" name="rolloutplan[{{ $i }}][lokasi_node][]"
								multiple="multiple" required>
								@foreach ($cities as $city)
									<option value="{{ $city->id }}">{{ $city->name }}</option>
								@endforeach
							</select>
						</td>
						<td class="col-3">
							<select class="form-control select w-100" name="rolloutplan[{{ $i }}][cakupan_wilayah_layanan][]"
								multiple="multiple" placeholder="Pilih Kota" required>
								@foreach ($cities as $city)
									<option value="{{ $city->id }}">{{ $city->name }}</option>
								@endforeach
							</select>
						</td>
						<td class="col-3">

							<input type="number" min="1" class="form-control jumlah_kabel_fiber_optik"
								name="rolloutplan[{{ $i }}][jumlah_kabel_fiber_optik]" required />

						</td>
						<td class="col-3">
							<input type="text" class="form-control kapasitas_bandwidth"
								name="rolloutplan[{{ $i }}][kapasitas_bandwidth]" required />
						</td>
						<td class="col-3">

							<input type="number" min="1" class="form-control panjang_rute_kabel_fiber_optik"
								name="rolloutplan[{{ $i }}][panjang_rute_kabel_fiber_optik]" required />

						</td>
					</tr>
				@endfor
			@endif
		</tbody>
		<tfoot>
			<tr>
				<small for="" class="text-danger mr-2">* Komitmen bersifat tahunan (tidak bersifat
					akumulasi)</small>
			</tr>
		</tfoot>
	</table>

	@if ($datajson == 'kosong' || $is_editable)
		<div class="text-right">
			<button class="btn btn-secondary my-2 btn-sm" type="button" id="add-RolloutPlan">Tambah Data</button>
		</div>
	@endif
</div>

<script nonce="unique-nonce-value" type="text/javascript">
	// $('.select-multiple').each(function(index, element) {
	//     $(this).select2({
	//         placeholder: "Pilih Kota"
	//     })
	// });

	$('document').ready(function() {

		const addRolloutPlanItem = function() {

			var cities = {!! json_encode($cities) !!};
			start = 0;
			totalRolloutPlan = 0;
			// console.log(options);

			initSelect2();

			function initSelect2() {
				$('.pilih-kota-rolloutplan').each(function(index, element) {
					$(this).select2({
						// placeholder: "Pilih Kota"
					})
				})
			}

			function countTotalRolloutPlan() {
				return document.querySelectorAll('.rolloutplan-item').length;
			}

			$('#add-RolloutPlan').on('click', function() {
				this.totalRolloutPlan = countTotalRolloutPlan() + 1;
				options = ``;

				for (let item of cities) {
					options += `<option value="` + item.id + `">` + item.name + `</option>`;
				}
				const inputRow =
					`
					<tr class="rolloutplan-item">
						<td class="col-1">
							<input min="1" oninput="validity.valid||(value='');" type="number" class="form-control periode" name="rolloutplan[` +
					this.totalRolloutPlan +
					`][periode]" required />
						</td>
						<td class="col-1">
							<input min="1" oninput="validity.valid||(value='');" type="number" class="form-control jumlah_node" name="rolloutplan[` +
					this.totalRolloutPlan + `][jumlah_node]" required />
						</td>
						<td class="col-3">
							<select class="form-control pilih-kota-rolloutplan select w-100"
								name="rolloutplan[` + this.totalRolloutPlan + `][lokasi_node][]"
								multiple="multiple"
								required>` + options + ` </select>
						</td>
						<td class="col-3">
							<select
								name="rolloutplan[` + this.totalRolloutPlan + `][cakupan_wilayah_layanan][]"
								class="form-control pilih-kota-rolloutplan select w-100"
                                multiple="multiple"
								required>` + options + ` </select>
						</td>
						<td>
							<input min="1" oninput="validity.valid||(value='');" type="number" class="form-control jumlah_kabel_fiber_optik" name="rolloutplan[` +
					this.totalRolloutPlan + `][jumlah_kabel_fiber_optik]" required />
						</td>
						<td>
							<input class="form-control kapasitas_bandwidth" name="rolloutplan[` + this.totalRolloutPlan +
					`][kapasitas_bandwidth]" required />
						</td>
						<td>
							<input min="1" oninput="validity.valid||(value='');" type="number" class="form-control panjang_rute_kabel_fiber_optik" name="rolloutplan[` +
					this.totalRolloutPlan + `][panjang_rute_kabel_fiber_optik]" required />
						</td>
						<td class="col-1">
							<button
								class="btn btn-danger btn-samll btn-delete-rolloutplan"
								type="button"
								onclick="javascript:onDeleteRolloutPlanItem(this);return false;"
							>&times;</button>
						</td>
					<tr>
				`;
				$('#rolloutplan-lists').append(inputRow);
				initSelect2();
			});
		}

		addRolloutPlanItem();

		$('.btn-delete-rolloutplan').click(function(e) {
			console.log(e);
		})

	});

	function onDeleteRolloutPlanItem(e) {
		// remove selected item
		e.parentNode.parentNode.remove();
		// recons index
		$('.rolloutplan-item').each(function(index, element) {
			let periode = $(this).find('.periode');
			let jumlah_node = $(this).find('.jumlah_node');
			let lokasi_node = $(this).find('.lokasi_node');
			let cakupan_wilayah_layanan = $(this).find('.cakupan_wilayah_layanan');
			let jumlah_kabel_fiber_optik = $(this).find('.jumlah_kabel_fiber_optik');
			let kapasitas_bandwidth = $(this).find('.kapasitas_bandwidth');
			let panjang_rute_kabel_fiber_optik = $(this).find('.panjang_rute_kabel_fiber_optik');
			periode.attr('name', 'rolloutplan[' + index + '][periode]');
			jumlah_node.attr('name', 'rolloutplan[' + index + '][jumlah_node]');
			lokasi_node.attr('name', 'rolloutplan[' + index + '][lokasi_node]');
			cakupan_wilayah_layanan.attr('name', 'rolloutplan[' + index + '][cakupan_wilayah_layanan]');
			jumlah_kabel_fiber_optik.attr('name', 'rolloutplan[' + index + '][jumlah_kabel_fiber_optik]');
			kapasitas_bandwidth.attr('name', 'rolloutplan[' + index + '][kapasitas_bandwidth]');
			panjang_rute_kabel_fiber_optik.attr('name', 'rolloutplan[' + index +
				'][panjang_rute_kabel_fiber_optik]');
		});
	}
</script>
