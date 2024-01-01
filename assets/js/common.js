const slideToggle = (className) => {
	if (!className) return;
  const container = document.querySelector(className);

	if (!container.classList.contains('active')) {
		container.classList.add('active');
		container.style.height = 'auto';

		let height = container.clientHeight + 'px';

		container.style.height = '0px';

		setTimeout(function () {
			container.style.height = height;
		}, 0);
	} else {
		container.style.height = '0px';

		container.addEventListener(
			'transitionend',
			function () {
				container.classList.remove('active');
			},
			{
				once: true,
			}
		);
	}
};

document.addEventListener('DOMContentLoaded', function () {
    // Initialize the date picker in the modal
    var datePicker = new Date();
    datePicker.setMinutes(datePicker.getMinutes() - datePicker.getTimezoneOffset());
    document.getElementById('endDate').valueAsDate = datePicker;

    // Handle form submission in the modal
    document.getElementById('editForm').addEventListener('submit', function (event) {
        event.preventDefault();
        var endDate = new Date(document.getElementById('endDate').value);
        updateChronometer(endDate);
        $('#editModal').modal('hide');
    });

    // Initialize the chronometer
    updateChronometer(new Date());
});

function updateChronometer(endDate) {
    var chronometer = document.getElementById('chronometer');

    function update() {
        var now = new Date();
        var difference = endDate - now;

        var days = Math.floor(difference / (1000 * 60 * 60 * 24));
        var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));

        document.getElementById('days').innerText = days;
        document.getElementById('hours').innerText = hours;
        document.getElementById('minutes').innerText = minutes;

        if (difference <= 0) {
            clearInterval(interval);
            chronometer.innerHTML = 'Tempo esgotado!';
        }
    }

    update(); // Call once to avoid delay
    var interval = setInterval(update, 1000);
}
