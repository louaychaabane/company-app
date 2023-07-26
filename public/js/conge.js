document.getElementById('demandeConge').addEventListener('click', function (event) {
  event.preventDefault();
  document.getElementById('popupOverlay').style.display = 'flex';
});

document.getElementById('popupOverlay').addEventListener('click', function (event) {
  if (event.target.id === 'popupOverlay') {
    document.getElementById('popupOverlay').style.display = 'none';
  }
});



function printRow(id) {
  const table = document.getElementById('congesTable');
  const row = table.rows[id];
  const startDate = row.cells[1].innerText;
  const endDate = row.cells[2].innerText;
  const description = row.cells[3].innerText;

  const popupWin = window.open('', '_blank', 'width=600,height=600');
  popupWin.document.open();
  popupWin.document.write('<html><head><style>h1{font-size:50px;} tr{font-size:30px;}</style><title>Print</title></head><body>');
  popupWin.document.write('<h1>Demande de congé</h1>');
  popupWin.document.write('<table>');
  popupWin.document.write('<tr><td><b>Date debut: </b></td><td>' + startDate + '</td></tr>');
  popupWin.document.write('<tr><td><b>Date fin: </b></td><td>' + endDate + '</td></tr>');
  popupWin.document.write('<tr><td><b>Description: </b></td><td>' + description + '</td></tr>');
  popupWin.document.write('</table>');
  popupWin.document.write('</body></html>');
  popupWin.document.close();
  popupWin.print();
  popupWin.close();
}



// Error Msg
document.addEventListener('DOMContentLoaded', function() {
  var startDateInput = document.getElementById('startDate');
  var startDateError = document.getElementById('startDateError');

  startDateInput.addEventListener('input', function() {
      var startDate = new Date(startDateInput.value);
      var currentDate = new Date();

      if (startDate < currentDate) {
          startDateError.textContent = 'Start date cannot be before the current date.';
      } else {
          startDateError.textContent = '';
      }
  });
});



// 
document.addEventListener('click', function (event) {
  if (
    !event.target.closest('#popupContent') &&
    !event.target.closest('#demandeConge') &&
    !event.target.closest('#historiquePopupContent') &&
    !event.target.closest('#historiqueConge')
  ) {
    // Clicked outside the popup and the "Demande de congé" and "Historique des congés" links, close the popup
    document.getElementById('popupOverlay').style.display = 'none';
    document.getElementById('historiquePopupOverlay').style.display = 'none';
  }
});


document.getElementById('historiqueConge').addEventListener('click', function (event) {
  event.preventDefault();
  document.getElementById('historiquePopupOverlay').style.display = 'flex';
});

document.getElementById('historiquePopupOverlay').addEventListener('click', function (event) {
  if (event.target.id === 'historiquePopupOverlay') {
    document.getElementById('historiquePopupOverlay').style.display = 'none';
  }
});





