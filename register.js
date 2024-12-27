// URL und Token für den Server
window.chatServer = "https://online-lectures-cs.thi.de/chat/37dd5362-a56e-4f4e-baec-7b776086cece";
window.token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyMzY1OTkwfQ.-_ey06_uAXNfWkAoo4tqyBQYgFrEdP8b7-X6llzglT8"; // TOM Token

console.log("register.js loaded");


// Sobald das DOM vollständig geladen ist
document.addEventListener('DOMContentLoaded', () => {
    // Formular-Element referenzieren
    const form = document.getElementById('registerForm');
    
    // Event-Listener für das Formular-Submit-Event hinzufügen
    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Verhindert, dass das Formular direkt gesendet wird
        checkInputs(); // Führt die Validierung durch
    });
});

// Funktion zur Validierung der Eingaben
function checkInputs() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('passwordRepeat').value;

    let status = true;

    // Farben für die Border
    const redBorder = "2px solid #D40808";
    const greenBorder = "2px solid #04AA6D";

    // Überprüfung des Benutzernamens
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4) {
            // Validierung des Benutzernamens
            if (xmlhttp.status === 204 || username.length < 3) {
                console.log("Username unavailable or too short");
                document.getElementById('username').style.border = redBorder;
                status = false;
            } else {
                console.log("Username available");
                document.getElementById('username').style.border = greenBorder;
            }

            // Validierung des Passworts
            if (password.length < 8) {
                console.log("Password too short");
                document.getElementById('password').style.border = redBorder;
                status = false;
            } else {
                console.log("Valid password length");
                document.getElementById('password').style.border = greenBorder;
            }

            // Validierung der Passwortbestätigung
            if (confirmPassword === password) {
                console.log("Passwords match");
                document.getElementById('passwordRepeat').style.border = greenBorder;
            } else {
                console.log("Passwords do not match");
                document.getElementById('passwordRepeat').style.border = redBorder;
                status = false;
            }

            // Formular absenden, wenn alles korrekt ist
            if (status) {
                console.log("All inputs valid, submitting form");
                document.getElementById('registerForm').submit();
            }
        }
    };

    // Überprüfung des Benutzernamens über den Server
    xmlhttp.open("GET", `${window.chatServer}/user/${username}`, true);
    xmlhttp.send();
}
