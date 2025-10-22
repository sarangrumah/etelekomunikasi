// Setup module
// ------------------------------

const FullCalendarBasic = function() {
    // Setup module components
    // Basic calendar
    const _componentFullCalendarBasic = function() {
        if (typeof FullCalendar == 'undefined') {
            console.warn('Warning - Fullcalendar files are not loaded.');
            return;
        }

        // Initialization
        // ------------------------------

        // Define element
        const calendarBasicViewElement = document.querySelector('.fullcalendar-basic');
        
        const initialLocaleCode = 'id';
        // Initialize
        let currentMonth = ''; // Define currentMonth at a higher scope

        if(calendarBasicViewElement) {
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0]; // Format to YYYY-MM-DD

            const calendarBasicViewInit = new FullCalendar.Calendar(calendarBasicViewElement, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                initialDate: formattedDate,
                navLinks: true, // can click day/week names to navigate views
                nowIndicator: true,
                weekNumberCalculation: 'ISO',
                editable: false,
                selectable: true,
                direction: document.dir == 'rtl' ? 'rtl' : 'ltr',
                dayMaxEvents: false,

                datesSet: function (dateInfo) {
                    // console.log(dateInfo.view.title);
                    currentMonth = dateInfo.view.title; // Store current month title for later
                    calendarBasicViewInit.refetchEvents(); // Call to refresh the events
                },

                events: function(fetchInfo, successCallback, failureCallback) {
                    // Now currentMonth should have been set in the datesSet callback
                    // console.log(currentMonth);
                    // if (!currentMonth) {
                    //     console.error('currentMonth is not defined.');
                    //     return; // Exit the function if currentMonth is not set
                    // }

                    // Extract month and year from currentMonth
                    const [monthName, year] = currentMonth.split(' ');
                    const monthIndex = new Date(Date.parse(monthName + " 1, 2021")).getMonth() + 1; // Get month as a number (1-12)
                    
                    console.log(monthIndex);
                    // Construct the URL with query parameters
                    const url = `/api/ulo-calendar-all?month=${monthIndex}&year=${year}`;
                    
                    fetch(url)
                        .then(response => response.json())
                        // .then(data => successCallback(data))
                        .then(data => {
                            const events = data.map(event => {
                                return {
                                    title: event.title,
                                    start: event.start,
                                    // Dynamic color assignment based on event type
                                    backgroundColor: event.izin === "JASA" ? "#fff" : 
                                                     event.izin === "JARINGAN" ? "orange" : 
                                                     "grey", // Default color
                                    borderColor: event.izin === "JASA" ? "#fff" : 
                                                 event.izin === "JARINGAN" ? "darkorange" : 
                                                 "darkgrey" // Default border color
                                };
                            });
                            successCallback(events);
                        })
                        .catch(error => failureCallback(error));
                },

                eventMouseEnter: function (info) {
                    let tooltip = document.createElement('div');
                    tooltip.id = 'calendar-tooltip';
                    tooltip.classList.add('calendar-tooltip');
                    tooltip.style.position = 'absolute';
                    tooltip.style.backgroundColor = '#333';
                    tooltip.style.color = '#fff';
                    tooltip.style.padding = '5px';
                    tooltip.style.borderRadius = '4px';
                    tooltip.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
                    tooltip.style.zIndex = '1000';
                    tooltip.innerHTML = info.event.title;

                    document.body.appendChild(tooltip);
                    tooltip.style.left = info.jsEvent.pageX + 10 + 'px';
                    tooltip.style.top = info.jsEvent.pageY + 10 + 'px';
                    info.el.tooltip = tooltip;
                },
                eventMouseLeave: function(info) {
                    const tooltip = info.el.tooltip;
                    if (tooltip) {
                        setTimeout(() => {
                            tooltip.remove();
                        }, 50); 
                    }
                }
            });

            // Init and render the calendar
            calendarBasicViewInit.render();

            // Resize calendar when sidebar toggler is clicked
            $('.sidebar-control').on('click', function() {
                calendarBasicViewInit.updateSize();
            });
        }
    };

    // Return objects assigned to module
    return {
        init: function() {
            _componentFullCalendarBasic();
        }
    }
}();

// Initialize module
document.addEventListener('DOMContentLoaded', function() {
    FullCalendarBasic.init();
});