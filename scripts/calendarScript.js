/**
 * Calendar Javascript to generate an accurate and traversable
 * calendar and implement functionality to reservation check out
 * system
 *
 * This code was greatly influenced and abstracted from the advice
 * of PortEXE youtube channel and their video at
 * https://www.youtube.com/watch?v=m9OSBJaQTlM
 */

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
 * querying the database to check for existing reservations.
 * Creates timeSlot button only if reservation at that
 * time does not exist by calling and validating PHP script
 * using Ajax
 * @param date date clicked on calendar
 */
function getAvailability(date)
{
    /*
    AJAX call to run ValidateAvailability and
    populate TimeSlots for calendar date clicked
    */
    $("#availableTimes").load ( "model/availability.php", { date:date } );

    // // if the time slots div is hidden
    // if(getByID("availableTimes").classList.contains("d-none")) {
    //     // display it
    //     getByID("availableTimes").classList.remove("d-none");
    //
    //     // hide the other two forms
    //     getByID("customizeMassage").classList.add("d-none");
    //     getByID("massageCheckout").classList.add("d-none");
    // }

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

        // display the selected date and time on check out form
        populateCheckOutForm(date, $(this).val());

        // Update .availabilityHeaders to display "Customize"
        console.log(document.getElementById("resFormHeader").innerHTML);
        document.getElementById("resFormHeader").innerHTML = "Customize";

        /**
         * Please explain how to encapsulate a form using php Question for Future
         * Forms inside forms, forms displayed using php
         */

        // display customizeOrder Form

        // generate onclick for customizeOrder Form

        // ajax call to validate customizeOrder Form




        // display the checkout form
        document.getElementById("customizeMassage").classList.remove("d-none");
        // console.log(document.getElementById("resFormHeader").innerHTML);
        // document.getElementById("resFormHeader").textHTML = "Customize";
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

// on page load
window.addEventListener("load", function() {
    // display calender
    calendarButtons();
    getMonth();

    // setup customize form submission button
    setupButtonOnClick("customizeMassage-btn", processMassageOptions);
});

/**
 * Gets all values from the Massage Options form,
 * and places them in hidden fields in the Massage Checkout form
 */
function processMassageOptions()
{
    // grab all values from the checkout options form,
    // and store them in hidden fields in the next checkout form
    getByID("massage-type-post").value = getByID("massage-type").value;
    getByID("massage-intensity-post").value = getByID("massage-intensity").value;

    // get whether user selected hot stones
    if(getByID("hot-stones-yes").checked) {
        getByID("hot-stones-post").value = getByID("hot-stones-yes").value;
    }

    else if(getByID("hot-stones-no").checked) {
        getByID("hot-stones-post").value = getByID("hot-stones-no").value;
    }

    // display the next form
    getByID("massageCheckout").classList.remove("d-none");

    // update the header
    getByID("resFormHeader").innerText = "Your Info";

    // hide the options form
    getByID("customizeMassage").classList.add("d-none");
}

/**
 * Sets up an onclick event for the given button using the given function
 * @param {string} buttonID The button's id
 * @param useFunction The function to be called when button is clicked
 */
function setupButtonOnClick(buttonID, useFunction) {
    // get the button
    const button = getByID(buttonID);

    // set it's onclick event
    button.addEventListener("click", useFunction);
}

/**
 * Shortened form of the document.getElementById method
 * @param {string} elementID The element's id
 * @returns {HTMLElement} The corresponding HTML Element
 */
function getByID(elementID) {
    return document.getElementById(elementID);
}