function verifierBoutonRadio() {
    var boutonRadio = document.getElementsByName('sexe');

    // Vérifie si au moins un des boutons radio est coché
    var estCoche = false;
    for (var i = 0; i < boutonRadio.length; i++) {
        if (boutonRadio[i].checked) {
            estCoche = true;
            break;
        }
    }

    // Affiche un message si aucun bouton radio n'est coché
    if (!estCoche) {
        alert("Veuillez spécifier votre sexe !");
    }
}

function displayImage(event) {
    var image = document.getElementById('preview');
    image.src = URL.createObjectURL(event.target.files[0]);
}