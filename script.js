let init = (e) => {
    let form = document.getElementById("pytania")
    form.addEventListener('submit', saveQuestion, true)
}
let pytanie = 0;
let saveQuestion = (e) => {
    e.preventDefault()
    let form = document.getElementById("pytania")
    var pyt = document.getElementById("pyt").value;
    var odp_a = document.getElementById("odp_a").value;
    var odp_b = document.getElementById("odp_b").value;
    var odp_c = document.getElementById("odp_c").value;
    var odp_d = document.getElementById("odp_d").value;
    form.reset();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState === 4) {
            if (xhttp.status === 200) {
                pytanie = this.responseText;
                dodanie_pytania();
            }
            else{
                blad_dodanie();
            }
        }
      }
    xhttp.open("POST", "php/saveQuestion.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`pytanie=${pyt}&odp_a=${odp_a}&odp_b=${odp_b}&odp_c=${odp_c}&odp_d=${odp_d}`);
}

function dodanie_pytania() {
    Swal.fire({
        icon: 'success',
        title: 'Ankieta dodana!',
        text: 'Pomyślnie dodano twoją ankietę',
    }).then((result) => {
        location.replace("php/ankieta.php?ankieta="+pytanie);
     });
}
function blad_dodanie() {
    Swal.fire({
        icon: 'error',
        title: 'Błąd!',
        text: 'Nie udało się dodać twojej ankiety',
    }).then((result) => {
        location.replace("../index.html");
     });
}
window.addEventListener('load', init, false);
