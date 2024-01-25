let nav = 0;
let clicked  = null;
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : [];

const calendar = document.getElementById('calendar');
const newEventModal = document.getElementById('newEventModal');
const deleteEventModal = document.getElementById('deleteEventModal');
const backDrop = document.getElementById('modalBackDrop');
const eventTitleInput = document.getElementById('eventTitleInput')
const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', ]

function openModal(date) {
    clicked = date;
    const eventForDay = events.find(e => e.date === clicked);

    if (eventForDay) {
        document.getElementById('eventText').innerText = eventForDay.title;
        deleteEventModal.style.display = 'block';
    } else {
        newEventModal.style.display = 'block';
    }

    backDrop.style.display = 'block';
}

function load() {
    const dt = new Date();

    if (nav !== 0) {
        dt.setMonth(new Date().getMonth() + nav);
    }

    console.log(dt);

    const day = dt.getDate();
    //Date is an Array and Jan. is index 0
    const month = dt.getMonth();
    const year = dt.getFullYear();

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

    const paddingDays = weekdays.indexOf(dateString.split(', ') [0]);

    // Displays current month and year at the top of Calendar
    document.getElementById('monthDisplay').innerText =
        `${dt.toLocaleDateString('en-us', {month: 'long'} )} ${year}`;

    // Resets the calendar
    calendar.innerHTML = '';
    
    
    // Creates all the necessary day boxes for the calendar
    for (let i = 1; i <= paddingDays + daysInMonth; i++) {

        const daySquare = document.createElement('div');
        daySquare.classList.add('day');
        const dayString = `${month + 1}/${i - paddingDays}/${year}`;

        if (i > paddingDays) {

            daySquare.innerText = i - paddingDays;
            const eventForDay = events.find(e => e.date === dayString);

            if (eventForDay) {
                const eventDiv = document.createElement('div');
                eventDiv.classList.add('event');
                eventDiv.innerText = eventForDay.title;
                daySquare.appendChild(eventDiv);
            }

            daySquare.addEventListener(
                'click',                          
                () => openModal(dayString)
            );
            
        } else {
            daySquare.classList.add('padding');
        }
        calendar.appendChild(daySquare);

    }
}

function closeModal() {
    eventTitleInput.classList.remove('error');
    newEventModal.style.display = 'none';
    deleteEventModal.style.display = 'none';
    backDrop.style.display = 'none';
    eventTitleInput.value = '';
    clicked = null;
    load();
}

function saveEvent() {
    if (eventTitleInput.value) {
        eventTitleInput.classList.remove('error');
        events.push({
            date: clicked,
            title: eventTitleInput.value,
        });

        localStorage.setItem('events', JSON.stringify(events));
        closeModal();
    } else {
        eventTitleInput.classList.add('error');
    }
    
}

function deleteEvent() {
    events = events.filter(e => e.date !== clicked);
    localStorage.setItem('events', JSON.stringify(events));
    closeModal();
}

/*
Increments and decrements the month at the top of the calendar
 */
function initButtons() {
    document.getElementById('nextButton').addEventListener('click', () => {
        nav++;
        load();
    });
    document.getElementById('backButton').addEventListener('click', () => {
        nav--;
        load();
    });

    document.getElementById('saveButton').addEventListener('click', saveEvent);
    document.getElementById('cancelButton').addEventListener('click', closeModal);
    document.getElementById('deleteButton').addEventListener('click', deleteEvent);
    document.getElementById('closeButton').addEventListener('click', closeModal);

}

initButtons();
load();
