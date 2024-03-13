let monthSelected = 0;    // Keep track of Current Month (Month plus nav = month displayed)
let clicked  = null;

// Initializes Events
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : [];

const calendar= document.getElementById('calendar');
const weekdays= ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', ]

/**
 * generates a month worth of dates for the calendar
  */
function getMonth()
{
    //Date is an Array and Current Month is index 0
    const dateObject = new Date();

    if (monthSelected !== 0) {
        dateObject.setMonth(new Date().getMonth() + monthSelected);
    }

    const day = dateObject.getDate();
    const month = dateObject.getMonth();
    const year = dateObject.getFullYear();

    /*  Finds the first day of the month */
    const firstDayOfMonth = new Date(year, month, 1);

    /*  Finds the last day in current month, by passing in Month + 1 (next month)
        and setting day to zero (Date object first day of month is always 1, so
        0 is last day of prior month)*/
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    /* Formats the String for Date Object*/
    const dateString = firstDayOfMonth.toLocaleDateString(
    'en-us',
    {
        weekday: 'long', // Prints 'monday', 'tuesday', etc.
        year: 'numeric',
        month: 'numeric',
        day: 'numeric'
    });

    /*
    * Padding days = days of last month before this month
    * Splits dateString and returns array['friday', '1/1/2023']
    * array[0] is then tested against weekdays and a number is
    * returned
    * */
    const paddingDays = weekdays.indexOf(dateString.split(', ') [0]);

    // Displays current month and year at the top of Calendar
    document.getElementById('monthDisplay').innerText =
        `${dateObject.toLocaleDateString('en-us', {month: 'long'} )} ${year}`;

    // Resets the calendar
    calendar.innerHTML = '';

    // Creates daySquare divs at top of calendar ie Sun, Mon, Tue...
    for (let j = 0; j < weekdays.length; j++) {
        const daysOfWeek = document.createElement('div');
        daysOfWeek.classList.add('daysOfWeek');
        daysOfWeek.innerText = weekdays[j].substring(0, 3);
        calendar.appendChild(daysOfWeek);
    }

    // Total number of days so that calendar is evenly divisible by 7
    let totalDays = paddingDays + daysInMonth;
    while ( !((totalDays % 7) === 0) ) {
        totalDays++;
    }

    // Creates all the necessary day boxes for the calendar
    for (let i = 1; i <= totalDays; i++) {

        // Div's are created for each day and class="day" is added
        const daySquare = document.createElement('div');
        daySquare.innerText = "\n";

        if (i > paddingDays && i <= (paddingDays + daysInMonth)) {
            daySquare.classList.add('day');
            daySquare.innerText = i - paddingDays;

            // Set Unique ID for every individual daySquare
            let currentDateString = new Date(dateObject.getFullYear(), dateObject.getMonth(), (i - paddingDays)).toLocaleDateString(
                'en-us',
                {
                    weekday: 'long', // Prints 'monday', 'tuesday', etc.
                    year: 'numeric',
                    month: 'numeric',
                    day: 'numeric'
                });
            daySquare.setAttribute('id', currentDateString);

            // const eventForDay = events.find(e => e.date === dayString);

            // get the current square's full date
            let currDate = new Date(dateObject.getFullYear(), dateObject.getMonth(), i - paddingDays);

            // format it to work with DB
            let formattedDate = currDate.toISOString().split('T')[0];

            // This is where we want to call a function to display current availability
            // setup day square's onclick
            daySquare.addEventListener(
                'click',
                // invoke the getAvailability method for the current date
                () => getAvailability(formattedDate)
            );

            daySquare.addEventListener(
                'click',
                () => console.log(currentDateString));

        } else {
            // All daySquares before first day of month now have class="padding"
            daySquare.classList.add('padding');
        }

        // Draw boxes for each daySquare
        calendar.appendChild(daySquare);
    }
}


/**
 * Increments and decrements the month at the top of the calendar
  */
function calendarButtons()
{
    // Click Listener for Next Calendar Month
    document.getElementById('nextButton').addEventListener('click', () => {
        monthSelected++;
        getMonth();
    });
    // Click Listener for Previous Calendar Month
    document.getElementById('backButton').addEventListener('click', () => {
        monthSelected--;
        getMonth();
    });
}

/**
 * Creates timeSlot Buttons for available times after
 * querying the database to check for existing times
 * Creates timeSlot button only if reservation at that
 * time does not exist
 * @param date date clicked on calendar
 */
function getAvailability(date)
{
    /*
    AJAX call to run ValidateAvailability and
    populate TimeSlots for calendar date clicked
    */
    $("#availableTimes").load ( "model/availability.php", { date:date } );

    /*
     Event delegation to create onclick for newly created
     timeSlot buttons and call to populateCheckOutForms
     to autofill checkOutForm
    */
    $("#availableTimes").on("click", "button", function(event) {
        event.preventDefault();
        console.log($(this).val());

        // hide the time slots
        document.getElementById("availableTimes").classList.add("d-none");

        // Update .availabilityHeaders to display "Customize"

        // display the selected date and time on check out form
        // pass this to the checkOutForm
        populateCheckOutForm(date, $(this).val());

        /**
         * Please explain how to encapsulate a form using php
         */

        // display customizeOrder Form

        // generate onclick for customizeOrder Form

        // ajax call to validate customizeOrder Form

        // display the checkout form
        document.getElementById("massageCheckout").classList.remove("d-none");
    });
}

/**
 * Autofills the #checkOut Form from user selection
 * @param date date of desired reservation
 * @param time time of desired reservation
 */
function populateCheckOutForm(date, time)
{
    document.getElementById("date").value = date;
    document.getElementById("time").value = time;

    document.getElementById("date-checkout-display").innerText = date;
    document.getElementById("time-checkout-display").innerText = time;
}

calendarButtons();
getMonth();