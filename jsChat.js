
// Funktion zum Abrufen des Chatpartners aus der URL
function getChatpartner() {
    const url = new URL(window.location.href);
    return url.searchParams.get("friend");
}

// Funktion zum Formatieren der Uhrzeit (Stunde:Minute:Sekunde)
function formatTime(timestamp) {
    const date = new Date(timestamp * 1000);
    let hours = date.getUTCHours();
    let minutes = date.getUTCMinutes();
    let seconds = date.getUTCSeconds();

    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    return `${hours}:${minutes}:${seconds}`;
}

// Funktion zum Abrufen der Nachrichten
function fetchMessages(friend) {
    if (!friend) {
        console.error("Kein Chatpartner angegeben.");
        return;
    }

    const url = `ajax_load_messages.php?to=${encodeURIComponent(friend)}`;
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            try {
                const messages = JSON.parse(xmlhttp.responseText);
                displayMessages(messages);
            } catch (error) {
                console.error("Fehler beim Parsen der Nachrichten:", error);
            }
        }
    };

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

// Funktion zum Senden von Nachrichten
function sendMessage(to, message) {
    if (!to || !message) {
        alert("Empfänger und Nachricht dürfen nicht leer sein.");
        return;
    }

    const url = "ajax_send_message.php";
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
            console.log("Nachricht erfolgreich gesendet.");
            fetchMessages(to); // Aktualisiere Nachrichten nach dem Senden
        }
    };

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader('Content-type', 'application/json');
    xmlhttp.send(JSON.stringify({ msg: message, to: to }));

}

// Funktion zum Anzeigen der Nachrichten
function displayMessages(messages) {
    const chatWindow = document.getElementById("chat-window");
    chatWindow.innerHTML = ""; // Vorherige Nachrichten entfernen

    messages.forEach(msg => {
        const messageElement = document.createElement("div");
        messageElement.className = "message";
        messageElement.innerHTML = `
            <span class="sender">${msg.from}:</span> 
            <span class="text">${msg.msg}</span> 
            <span class="timestamp">${formatTime(msg.time)}</span>
        `;
        chatWindow.appendChild(messageElement);
    });
}

// Event-Listener beim Laden der Seite
document.addEventListener("DOMContentLoaded", function () {
    const friend = getChatpartner();

    if (!friend) {
        alert("Kein Chatpartner ausgewählt. Zurück zur Freundesliste.");
        window.location.href = "friends.php";
        return;
    }

    const header = document.querySelector("h1");
    if (header) {
        header.textContent = `Chat mit ${friend}`;
    }

    // Nachrichten laden
    fetchMessages(friend);

    // Nachricht senden
    const messageForm = document.getElementById("message-form");
    messageForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Verhindere die Standardformularübertragung
        const messageInput = document.getElementById("messageInput");
        const message = messageInput.value.trim();

        if (message) {
            sendMessage(friend, message); // Nachricht senden
            messageInput.value = ""; // Eingabefeld leeren
        } else {
            alert("Bitte eine Nachricht eingeben.");
        }
    });

    // Nachrichten alle 5 Sekunden aktualisieren
    setInterval(function () {
        fetchMessages(friend);
    }, 5000);
});