// Mission
document.getElementById('missionPopupOverlay').addEventListener('click', function (event) {
    if (event.target.id === 'missionPopupOverlay') {
        document.getElementById('missionPopupOverlay').style.display = 'none';
    }
});

document.getElementById('demandeMission').addEventListener('click', function (event) {
    event.preventDefault();
    document.getElementById('missionPopupOverlay').style.display = 'flex';
});


// Error Msg
document.addEventListener('DOMContentLoaded', function () {
    var startDateInput = document.getElementById('missionStartDate');
    var startDateError = document.getElementById('missionStartDateError');

    startDateInput.addEventListener('input', function () {
        var startDate = new Date(startDateInput.value);
        var currentDate = new Date();

        if (startDate < currentDate) {
            startDateError.textContent = 'Start date cannot be before the current date.';
        } else {
            startDateError.textContent = '';
        }
    });
});