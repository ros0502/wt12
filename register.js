//Aufruf bzw. Kommunikation mit Server
window.chatServer = "https://online-lectures-cs.thi.de/chat/37dd5362-a56e-4f4e-baec-7b776086cece";
window.token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyMzY1OTkwfQ.-_ey06_uAXNfWkAoo4tqyBQYgFrEdP8b7-X6llzglT8"; // TOM Token

//Code fragt den Server nach den definierten Benutzern
/*
const xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function () {
  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    let data = JSON.parse(xmlhttp.responseText);
    console.log(data);
  }
};
// Chat Server URL und Collection ID als Teil der URL
xmlhttp.open("GET", backendUrl + "/user", true);
// Das Token zur Authentifizierung, wenn notwendig
xmlhttp.setRequestHeader('Authorization', 'Bearer ' + token);
xmlhttp.send();
*/

//Vergleiche, ob der Username bereits existiert und lang genug ist und kennzeichne farblich
function checkInputs() {
  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;
  var confirmPassword = document.getElementById('confirmPassword').value;
  var status = true;

  //Farben für die Border
  var redBorder = "2px solid #D40808";
  var greenBorder = "2px solid #04AA6D";

  var xmlhttp = new XMLHttpRequest();

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4) {
      //Username unavailable(204) or less than 3 long
      if (xmlhttp.status == 204 || username.length <= 3) {
        console.log("Username unavailable or to short");
        document.getElementById('username').style.border = redBorder; //Red border mit CSS 
        status = false;
      } else {
        console.log("Username available");
        document.getElementById('username').style.border = greenBorder; //Green border mit CSS
        
      }
      //Das Passwort muss min. 8 Zeichen haben
      if (password.length < 8) {
        console.log("Password to short");
        document.getElementById('password').style.border = redBorder; //Red border mit CSS
        status = false;
      } else {
        console.log("Valid password length");
        document.getElementById('password').style.border = greenBorder; //Green border mit CSS   
      }

      if (confirmPassword == password) {
        console.log("Gleich");
        document.getElementById('confirmPassword').style.border = greenBorder; //Green border mit CSS
      } else {
        console.log("Ungleich");
        document.getElementById('confirmPassword').style.border = redBorder; //Red border mit CSS
        status = false;
      }
      if(status == true) {
        document.getElementById('registerForm').submit();
      }
    }
  };

  xmlhttp.open("GET", window.chatServer + "/user/" + username, true);
  xmlhttp.send();
}