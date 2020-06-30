function parseDateToTimer(target) {
    const now = moment(); //moment.tz(timezone);
    const future = moment(target);
    let modDate;

    if (future.diff(now, 'seconds') <= 0) {
        return {};
    }
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
    const targetDateTime = document.getElementById('dsn-armageddon-target-date').value;

    const targetMillis = moment(targetDateTime); //moment.tz(targetDateTime, timezone);
    const result = parseDateToTimer(targetMillis);

    if (result.days == undefined) {
        document.getElementById('dsn-countdown-timer').textContent = 'has already passed';
        return;
    }
    const countdown = result.days + ' days ' + 
                      result.hours + ' hours ' +
                      result.minutes + ' minutes ' +
                      result.seconds + ' seconds ';
    document.getElementById('dsn-countdown-timer').textContent = countdown;
}

const countdown_timer = setInterval(displayCountdownTimer, 1000);
//const timezone = "America/New_York";