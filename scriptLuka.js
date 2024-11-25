//B1
// Chat Server URL and Collection ID as part of the URL
window.backendUrl = "https://online-lectures-cs.thi.de/chat/9700a66a-2f5e-4c4e-8ddc-c2780c56d779";
//Hardcoded token for Tom
window.token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyMjc3MTg2fQ.yOAcFQE9Ip3hOr68xCo4ZYQSO2N3B6Yq46EwDteMQw8";

//Calls on the backend to get the list of users
var listUsers = new XMLHttpRequest();
listUsers.onreadystatechange = function () {
    if (listUsers.readyState == 4 && listUsers.status == 200) {
        let data = JSON.parse(listUsers.responseText);
        console.log(data);
        logOptions(data);
    }
};
listUsers.open("GET", "https://online-lectures-cs.thi.de/chat/bb02912d-5e0a-4b46-b14a-dcec939ae3c4/user", true);
// Add token, e. g., from Tom
listUsers.setRequestHeader('Authorization', 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNzMyMjgzMjY0fQ.L0lxgiZ-Huavxk-n1iPG9vIk99b1Pu6YPXAjCZ1CyWw');
listUsers.send();

//Adds names to the dropdown list
async function logOptions(data) {
    const datalist = document.getElementById("friend-selector");
    let currentUser = await loggedInUser(); //Waits for the current user to be loaded
    let friends = await loadFriends(); //Waits for the friends to be loaded
    console.log(currentUser.username);
    console.log(friends);

    let addedFriends = []; //Array to store the friends of the current user
    for (let i = 0; i < friends.length; i++) {
        addedFriends.push(friends[i].username);
    }

    for (let users = 0; users < data.length; users++) { //Iterates through the list of users
        if (data[users] === currentUser.username || addedFriends.includes(data[users])) { //Checks if the user is the current user or already a friend, if so, the user is not added to the list
            continue;
        }
        let option = document.createElement("option");
        option.value = data[users]; 
        datalist.appendChild(option);
    }
        
}

async function loggedInUser() {
    let response = await fetch(backendUrl + "/user/Tom", {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        }
    });
    let data = await response.json();
    return data;
}

async function loadFriends() {
    let response = await fetch(backendUrl + "/friend", {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        }
    });
    let data = await response.json();
    filledList(data);
    return data;
}

function filledList(data) {
    let list = document.getElementById("friend-list");
    let requestedList = document.getElementById("friend-requests");
    requestedList.replaceChildren(); //Clears the friend requests list
    list.replaceChildren(); //Clears the friend list


    for (let users = 0; users < data.length; users++) { //Iterates through the list of friends 
        if (data[users].status === "requested") { //if the status is requested, the user is added to the friend requests list
            let listElement = document.createElement("li");
            let bold = document.createElement("b");
            bold.innerHTML = data[users].username;
            listElement.innerHTML = "Friend request from ";
            listElement.appendChild(bold);
            let acceptButton = document.createElement("button");
            acceptButton.innerHTML = "Accept";
            acceptButton.className = "grey";
            acceptButton.setAttribute("type", "submit");

            let rejectButton = document.createElement("button");
            rejectButton.innerHTML = "Reject";
            rejectButton.className = "grey";
            rejectButton.setAttribute("type", "submit");
            listElement.appendChild(acceptButton);
            listElement.appendChild(rejectButton);
            requestedList.appendChild(listElement);          
        } else{ //if the status is not requested, the user is added to the friend list
            let listElement = document.createElement("li");
            let textNode = document.createElement("a");
            textNode.innerHTML = data[users].username;
            textNode.setAttribute("href", "chat.html?friend=" + data[users].username);
            textNode.setAttribute("class", "friends");

            listElement.appendChild(textNode);
            if (data[users].unread){ //If the user has unread messages, a notification is added

                let notification = document.createElement("span");
                notification.className = "notification";
                notification.innerHTML = data[users].unread;
                listElement.appendChild(notification);
            }

            list.appendChild(listElement);
        }
    }
    
}

//B2
window.setInterval(function() {
    loadFriends();
    }, 1000);
    loadFriends(); // erstmaliger Aufruf*/
