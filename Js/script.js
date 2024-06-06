document.addEventListener('DOMContentLoaded', function() {
    const formulaire = document.getElementById('formulaire');
    const btnConn = document.getElementById('btnConnexion');
    const erreurs = document.getElementById('message-erreur');

    btnConn.onclick = function (event){
        event.preventDefault();
        let desErreurs = false;

        erreurs.textContent = '';
        document.querySelectorAll('input').forEach(input => {
            input.classList.remove('erreur')
        });

        document.querySelectorAll('input[required]').forEach(input => {
            if (!input.value){
                desErreurs = true;
                input.classList.add('erreur');
                erreurs.textContent = "Des Informations sont manquantes!"
            }
        });

        if(desErreurs){
            return;
        }

        const courriel = document.getElementById('email').value;
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (!emailPattern.test(courriel)) {
            document.getElementById('email').classList.add('erreur');
            erreurs.textContent = 'Veuillez entrer un email valide!.';
            return;
        }

        const password = document.getElementById('password').value;
        const passwordPattern = /^(?=.*[A-Z])(?=.*\d.*\d)/;

        if (!passwordPattern.test(password)) {
            erreurs.textContent = 'Le mot de passe doit contenir au moins une lettre majuscule et au moins deux chiffres.';
            document.getElementById('password').classList.add('erreur');
            return;
        }


        const formdata = new FormData(formulaire);
        fetch('/api/formulaire-connexion.php', {
            method: 'POST',
            body: formdata
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                window.location.href = '../dashboard.php';
            } else {
                erreurs.textContent = data;
                if (data.includes('No user found')) {
                    document.getElementById('email').classList.add('erreur');
                    erreurs.textContent += 'Email non trouvé. ';
                } else if (data.includes('Incorrect password')) {
                    document.getElementById('password').classList.add('erreur');
                    erreurs.textContent += 'Mot de passe incorrect. ';
                } else {
                    erreurs.textContent = data;
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            erreurs.textContent = 'Une erreur est survenue';
        });
    };
});