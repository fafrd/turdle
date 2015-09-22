var counteroutput = document.getElementById('countup'),
	startstop = document.getElementById('startstop'),
	clear = document.getElementById('clear'),
	seconds = 0, minutes = 0, hours = 0,
	t,
	isTimerRunning = false, hasBeenStarted = false
	starttime = new Date(), stoptime = new Date();
function add() {
	seconds++;
	if (seconds >= 60)
	{
		seconds = 0;
		minutes++;
		if (minutes >= 60)
		{
			minutes = 0;
			hours++;
		}
	}
	
	counteroutput.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);

	timer();
}

function timer() {
	t = setTimeout(add, 1000);
}

/* Start/Stop button */
startstop.onclick = function() {
	if(isTimerRunning)
	{
		isTimerRunning = false;
		clearTimeout(t);
		stoptime = new Date();
	}
	else
	{
		isTimerRunning = true;
		timer();
		if(!hasBeenStarted)
		{
			hasBeenStarted = true;
			starttime = new Date();
		}
	}
}

/* Clear button */
clear.onclick = function() {
	isTimerRunning = false;
	hasBeenStarted = false;
	clearTimeout(t);
	counteroutput.textContent = "00:00:00";
	seconds = 0; minutes = 0; hours = 0;
}