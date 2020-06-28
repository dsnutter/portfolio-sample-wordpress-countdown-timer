function parseDateToTimer(target) {
    const now = moment(); //moment.tz(timezone);
    const future = moment(target);
    let modDate;

    const days = future.diff(now, 'days');
    modDate = future.subtract(days, 'days');

    const hours = modDate.diff(now, 'hours');
    modDate = modDate.subtract(hours, 'hours');

    const minutes = modDate.diff(now, 'minutes');
    modDate = modDate.subtract(minutes, 'minutes');

    const seconds = modDate.diff(now, 'seconds');

    return {
        days: days,
        hours: hours,
        minutes: minutes,
        seconds: seconds,
    };
}

function displayCountdownTimer() {
    const targetDateTime = '2020-06-30 07:00';
    const targetMillis = moment(targetDateTime); //moment.tz(targetDateTime, timezone);
    const result = parseDateToTimer(targetMillis);

    const countdown = result.days + ' days ' + 
                      result.hours + ' hours ' +
                      result.minutes + ' minutes ' +
                      result.seconds + ' seconds ';
    document.getElementById('dsn-countdown-timer').textContent = countdown;
}

const countdown_timer = setInterval(displayCountdownTimer, 1000);
//const timezone = "America/New_York";