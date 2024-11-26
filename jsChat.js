

// Constants for API interaction
const API_BASE_URL = "https://online-lectures-cs.thi.de/chat/044bdd28-d3bd-4478-a96e-1708963fda03/message";
const AUTH_TOKEN = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyNTIxMDY5fQ.Ig94_KGbgh5YV_r4DpnAMTMqmsuIe29MJmxF5uH18TU'; // Example token


// Funktion zum Abrufen des Chatpartners aus der URL
function getChatpartner() {
    const url = new URL(window.location.href);
    const queryParams = url.searchParams;
    const friendValue = queryParams.get("friend");
    console.log("Friend:", friendValue);
    return friendValue;
}

// Funktion zum Formatieren der Uhrzeit (Stunde:Minute:Sekunde)
function formatTime(timestamp) {
    const date = new Date(timestamp * 1000); // Umwandlung von Zeit in Millisekunden
    let hours = date.getUTCHours();
    let minutes = date.getUTCMinutes();
    let seconds = date.getUTCSeconds();
    

    // Formatieren der Uhrzeit, falls Minuten und Sekunden < 10
    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    return `${hours}:${minutes}:${seconds}`;
}

// Funktion zum Abrufen der Nachrichten
function fetchMessages(friend) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            let messages = JSON.parse(xmlhttp.responseText);
            console.log("Fetched messages:", messages);
            displayMessages(messages);
        }
    };
    xmlhttp.open("GET", `${API_BASE_URL}/${friend}`, true);
    xmlhttp.setRequestHeader('Authorization', AUTH_TOKEN);
    xmlhttp.send();

}

// Funktion zum Senden von Nachrichten
function sendMessage(to, message) {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 204) {
            console.log("Message sent successfully.");
            fetchMessages(to); // Nachrichten nach dem Senden neu laden
        }
    };
    xmlhttp.open("POST", API_BASE_URL, true);
    xmlhttp.setRequestHeader('Content-type', 'application/json');
    xmlhttp.setRequestHeader('Authorization', AUTH_TOKEN);

    let data = JSON.stringify({ message, to });
    xmlhttp.send(data);
}

// Funktion zum Anzeigen der Nachrichten
function displayMessages(messages) {
    const chatWindow = document.getElementById("chat-window");
    chatWindow.innerHTML = ""; // Vorherige Nachrichten entfernen
    messages.forEach(msg => {
        const messageElement = document.createElement("div");
        messageElement.className = "message";
        messageElement.innerText = `${msg.from}: ${msg.msg}`; // Sender und Nachricht anzeigen
        messageElement.innerHTML = `
            ${msg.from}: ${msg.msg}
            <span class="timestamp">${formatTime(msg.time)}</span>
        `;
        chatWindow.appendChild(messageElement);
    });
}

// Event-Listener beim Laden der Seite
document.addEventListener('DOMContentLoaded', function () {
    const friend = getChatpartner();
    if (friend) {
        const header = document.querySelector('h1');
        if (header) {
            header.textContent = `Chat mit ${friend}`;
        }
        fetchMessages(friend); // Nachrichten des Chatpartners laden
     // Sicherstellen, dass das Eingabefeld und der Button vorhanden sind
    if (!sendButton || !messageInput) {
        console.error("Das Eingabefeld oder der Button sind nicht im DOM vorhanden.");
        return;
    }

    // Formular absenden (Nachricht senden)
    const messageForm = document.getElementById("message-form");
    messageForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Verhindere die Standardformularübertragung
        const messageInput = document.getElementById("messageInput");
        const recipient = getChatpartner(); // Empfänger aus URL holen

        const message = messageInput.value;
        if (message && recipient) {
            sendMessage(recipient, message); // Nachricht senden
            messageInput.value = ""; // Eingabefeld leeren
        } else {
            alert("Bitte Nachricht eingeben und Chat-Partner auswählen.");
        }
    });

    // Nachrichten alle 5 Sekunden aktualisieren
    setInterval(function () {
        const friend = getChatpartner();
        if (friend) {
            fetchMessages(friend); // Nachrichten des Chatpartners regelmäßig neu laden
        }
    }, 5000);
    }

    console.log("Send-Button:", sendButton);
    console.log("Message-Input:", messageInput);
});


