@extends('layouts.backend.main')

@section('js')
	<script nonce="unique-nonce-value" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script nonce="unique-nonce-value" src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
	<script nonce="unique-nonce-value" src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'>
	</script>
	<script nonce="unique-nonce-value" src="{{ url('global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script nonce="unique-nonce-value" src="{{ url('global_assets/js/demo_pages/form_layouts.js') }}"></script>
@endsection

@section('content')
	<div id="loadingSpinner" class="loading-spinner loading-spinner-init" nonce="unique-nonce-value">
		<img id="spinnerImage" src="/assets/kominfo/spinner-kominfo-trp.svg" alt="Loading Spinner">
	</div>

	<style nonce="unique-nonce-value">
		.loading-spinner {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(255, 255, 255, 0.8);
			z-index: 9999;
			justify-content: center;
			align-items: center;
		}

		.event-jasa {
			background-color: rgb(127, 255, 212) !important;
			color: rgb(0, 0, 0);
		}

		.event-jaringan {
			background-color: rgb(144, 243, 250) !important;
			color: rgb(0, 0, 0);
		}

		.event-telsus {
			background-color: pink !important;
			color: rgb(0, 0, 0);
		}

		.event-other {
			background-color: rgb(255, 102, 102) !important;
			color: rgb(255, 255, 255);
		}

		.tooltip {
			position: absolute;
			background-color: white;
			border: 1px solid #ccc;
			padding: 5px;
			z-index: 10000;
			font-size: 12px;
			color: black;
			display: none;
			/* Start as hidden */
			white-space: nowrap;
			/* Prevent text from wrapping */
		}
	</style>

	<div class="page-content">
		<div class="content-wrapper">
			<div class="content-inner">
				<div class="page-header page-header-light shadow">
					<div class="page-header-content d-lg-flex">
						<div class="d-flex">
							<h4 class="page-title mb-0">Jadwal Uji Laik Operasi - <span class="fw-normal">Direktorat Telekomunikasi</span>
							</h4>
						</div>
					</div>
				</div>

				<div class="content">
					<div class="card">
						<div class="card-body">
							<p class="mb-3">Jadwal berikut merupakan hasil verifikasi oleh tim Direktorat Telekomunikasi berdasarkan
								pangajuan tanggal Uji Laik Operasi yang diajukan oleh pemohon.</p>
							<div id="calendar"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script nonce="unique-nonce-value">
		var loadingSpinner = document.getElementById('loadingSpinner');

		function showLoadingSpinner() {
			loadingSpinner.style.display = 'flex';
		}

		$(document).ready(function() {
			var eventCache = {};

			function fetchEvents(month, year, callback) {
				var cacheKey = month + '-' + year;

				if (eventCache[cacheKey]) {
					callback(eventCache[cacheKey]);
				} else {
					showLoadingSpinner();
					$.ajax({
						url: `/api/ulo-calendar-all?month=${month}&year=${year}`,
						type: 'GET',
						success: function(data) {
							var events = [];
							data.forEach(function(item) {
								var className = '';
								switch (item.izin) {
									case 'JASA':
										className = 'event-jasa';
										break;
									case 'JARINGAN':
										className = 'event-jaringan';
										break;
									case 'TELSUS':
										className = 'event-telsus';
										break;
									case 'TELSUS_INSTANSI':
										className = 'event-telsus';
										break;
									case 'LIBUR':
										className = 'event-other';
										break;
								}

								// Assuming item.title and item.location are provided in your API response
								var mainTitle = item.title.trim(); // Main title
								var location = item.locate ? item.locate.trim() : ''; // Location

								// Construct event with title, location, and tooltip
								events.push({
									title: mainTitle, // Title for default tooltip
									start: item.start,
									end: item.end,
									className: className,
									tooltipContent: `<strong>${mainTitle}</strong><br />${location}` // HTML for tooltip
								});
							});
							eventCache[cacheKey] = events;
							callback(events);
						},
						error: function() {
							console.error('Failed to load events');
						},
						complete: function() {
							loadingSpinner.style.display = 'none'; // Hide the loading spinner
						}
					});
				}
			}

			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: ''
				},
				events: function(start, end, timezone, callback) {
					var monthIndex = $('#calendar').fullCalendar('getDate').month() + 1;
					var year = $('#calendar').fullCalendar('getDate').year();

					fetchEvents(monthIndex, year, callback);
				},
				editable: true,
				eventMouseover: function(event, jsEvent) {
					// Create custom tooltip with formatted HTML
					var tooltip = $('<div class="tooltip"></div>').appendTo('body');

					// Use the tooltipContent property for HTML
					tooltip.html(event.tooltipContent || event.title); // Fallback to title if needed
					tooltip.css({
						top: jsEvent.pageY + 10 + 'px',
						left: jsEvent.pageX + 20 + 'px'
					}).fadeIn(200);

					$(this).data('tooltip', tooltip);
				},
				eventMouseout: function() {
					// Cleanup tooltip on mouse out
					var tooltip = $(this).data('tooltip');
					if (tooltip) {
						tooltip.remove();
						$(this).removeData('tooltip'); // Cleanup
					}
				},
				eventRender: function(event, element) {
					// Set browser tooltip with the title (without HTML)
					element.attr('title',
						`${event.title}\n${event.tooltipContent.split('<br />')[1] || ''}`
					); // Title and location as plain text
				}
			});
		});
	</script>
@endsection
