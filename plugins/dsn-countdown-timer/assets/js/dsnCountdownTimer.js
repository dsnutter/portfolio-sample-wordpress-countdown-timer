function displayCountdownTimer() {
    const date = new Date();
    const countdown = date.toLocaleTimeString();
    document.getElementById('dsn-countdown-timer').textContent = countdown;
}

const countdown_timer = setInterval(displayCountdownTimer, 1000);
