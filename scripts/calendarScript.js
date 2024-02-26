let monthSelected = 0;    // Keep track of Current Month (Month plus nav = month displayed)
let clicked  = null;

// Initializes Events
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : [];

const calendar = document.getElementById('calendar');
const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', ]



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

            // This is where we want to call a function to display current availability
            daySquare.addEventListener(
                'click',
                () => getAvailability(
                    new Date(dateObject.getFullYear(), dateObject.getMonth(), i - paddingDays)
                ));

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


// Increments and decrements the month at the top of the calendar
function calendarButtons()
{
    document.getElementById('nextButton').addEventListener('click', () => {
        monthSelected++;
        getMonth();
    });
    document.getElementById('backButton').addEventListener('click', () => {
        monthSelected--;
        getMonth();
    });
}

function getAvailability(date) {



    let dateReturned = document.createElement('div');
    let availabilityDiv = document.getElementById('dayTimeSelected');
    dateReturned.innerText = date;
    availabilityDiv.appendChild(dateReturned);

    let xhttp = new XMLHttpRequest();
    let url = 'https://tgoetzgr.greenriverdev.com/TeamMinion/availability';

    fetch(url, {method: 'GET'})
        .then(Result => Result.json())
        .then(date => {
            console.log(date);
        })
        .catch(errorMsg => {console.log(errorMsg);})





}

calendarButtons();
getMonth();
