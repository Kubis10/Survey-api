let init = (e) => {
    let form = document.getElementById("ankiety");
    form.addEventListener("submit", saveAnswer, true);
};
let pytanie = window.id_pytania;
let saveAnswer = (e) => {
    e.preventDefault();
    var ele = document.getElementsByName("que");
    let odp = 0;
    for (i = 0; i < ele.length; i++) {
        if (ele[i].checked){
            odp = i;
            break;
        }
    }
    switch (odp) {
        case 0:
            odp = "wyniki_a";
            break;
        case 1:
            odp = "wyniki_b";
            break;
        case 2:
            odp = "wyniki_c";
            break;
        case 3:
            odp = "wyniki_d";
            break;            
        default:
            odp = "wyniki_a";
            break;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState === 4) {
            if (xhttp.status === 200) {
                dodanie_odp();
            }
            else{
                blad_dodania();
            }
        }
      }
    xhttp.open("POST", "saveAnswer.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`id=${pytanie}&odp=${odp}`);
};

function dodanie_odp() {
    Swal.fire({
        icon: "success",
        title: "Sukcess!",
        text: "Pomyślnie dodano twoją odpowiedź",
    }).then((result) => {
       location.replace("wyniki.php?ankieta="+pytanie);
    });
}
function blad_dodania() {
    Swal.fire({
        icon: 'error',
        title: 'Błąd!',
        text: 'Nie udało się dodać twojej odpowiedzi',
    }).then((result) => {
        location.replace("../index.html");
     });
}
window.addEventListener("load", init, false);
