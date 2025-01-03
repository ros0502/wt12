//return list of all users then add items to dropdown list
async function loadUsers (){
    const response = await fetch("ajax_load_users.php");
    const data = await response.json();
    logOptions(data);
    return data;
}

//Adds names to the dropdown list
async function logOptions(data) {

    const datalist = document.getElementById("friend-selector");

    //Waits for the friends to be loaded and prints them out
    const friends = await loadFriends();
    console.log(friends);

    //Array to store the names of friends of the current user
    let addedFriends = []; 
    for (let i = 0; i < friends.length; i++) {
        addedFriends.push(friends[i].username);
    }


    //iterates through all users
    for (user of data) {

        //if the user is the current user or already a friend, skip him
        //currentUser is made available in the head of friends.php file
        if (user === currentUser || addedFriends.includes(user)) { 
            continue;
        }

        //add option for user
        const option = document.createElement("option");
        option.innerHTML = user;
        datalist.appendChild(option);
    }
        
}


//return all friends of current user
async function loadFriends() {
    const response = await fetch("ajax_load_friends.php");
    const data = await response.json();

    filledList(data);
    return data;
}



//fill friends list with data from loadFriends()
function filledList(data) {

    //get friends lists
    const list = document.getElementById("friend-list");
    const requestedList = document.getElementById("friend-requests");

    requestedList.replaceChildren(); //Clears the friend requests list
    list.replaceChildren(); //Clears the friend list


    //for each friend in friends
    for (friend of data) {

        //if the status is requested, the user is added to the friend requests list
        if (friend.status === "requested") { 

            //create a list element and the text for it
            const listElement = document.createElement("li");
            listElement.id = `requested-user-${friend.username}`;
            listElement.innerHTML = "Friend request from ";

            const bold = document.createElement("b");
            bold.innerHTML = friend.username;
            listElement.appendChild(bold);
            //create form through which requests are sent
            /*const form = document.createElement("form");
            //form.setAttribute("action", "ajax_friend_action.php");

            
            

            //add invisible input to be able to pass two paramaters in a form
            const invisibleInput = document.createElement("input");
            invisibleInput.setAttribute("hidden", "true");
            invisibleInput.setAttribute("name", "friend");
            invisibleInput.setAttribute("value", friend.username);

            //create accept button and implement functionality
            const acceptButton = document.createElement("button");
            acceptButton.innerHTML = "Accept";
            acceptButton.className = "grey accept-button";
            acceptButton.setAttribute("name", "action");
            acceptButton.setAttribute("value", "accept");
            acceptButton.setAttribute("type", "button");

            //create reject button and implement functionality
            const rejectButton = document.createElement("button");
            rejectButton.innerHTML = "Reject";
            rejectButton.className = "grey dismiss-button";
            rejectButton.setAttribute("name", "action");
            rejectButton.setAttribute("value", "dismiss");
            rejectButton.setAttribute("type", "button");

            //add inputs to form
            form.appendChild(invisibleInput);
            form.appendChild(acceptButton);
            form.appendChild(rejectButton);

            //add form to the list element
            listElement.appendChild(form);*/

            //add list element to list
            requestedList.appendChild(listElement);

        }
        //if the status is not requested, the user is added to the friend list
        else{ 

            //create list element with hyperlink to chat
            const listElement = document.createElement("li");
            listElement.id = `added-friend-${friend.username}`;
            listElement.className = "d-flex";

            //create a form
            const form = document.createElement("form");
            form.setAttribute("action", "ajax_friend_action.php");

            const textNode = document.createElement("a");
            textNode.innerHTML = friend.username;
            textNode.setAttribute("href", `chat.php?friend=${friend.username}`);
            textNode.setAttribute("class", "friends");

            

            //add invisible input to be able to pass two paramaters in a form
            const invisibleInput = document.createElement("input");
            invisibleInput.setAttribute("hidden", "true");
            invisibleInput.setAttribute("name", "friend");
            invisibleInput.setAttribute("value", friend.username);

            //create button for removing friends
            const removeButton = document.createElement("button");
            removeButton.innerHTML = "Remove";
            removeButton.className = "grey remove-button";
            removeButton.setAttribute("name", "action");
            removeButton.setAttribute("value", "remove");

            //add inputs to the form
            form.appendChild(textNode);
            form.appendChild(invisibleInput);
            form.appendChild(removeButton);

            //add text and buttons to list element
            
            listElement.appendChild(form);

            //If the user has unread messages, a notification is added
            if (!friend.unread){
                const notification = document.createElement("span");
                notification.className = "notification badge bg-primary text-white rounded-pill ms-auto";
                notification.innerHTML = friend.unread;
                listElement.appendChild(notification);
            }

            //add list element to friends list 
            list.appendChild(listElement);
        }
    }  
}

//add friend function handler
function addFriend(e){

    //stop the form from submitting twice
    e.preventDefault();

    //get value of the input field
    const input = document.getElementById("friend-request-name");
    const friendName = input.value;

    //check if target user exists and if it isn't the current user, then send a friend request
    $.ajax({url: "ajax_check_user.php", data: {"user": friendName}, success: function(){
        if (friendName !== currentUser){
            $.ajax({url: "ajax_friend_action.php", data: {"friend": friendName, "action": "add"}, success: function(){
                console.log(`Sent request to ${friendName}`);
            }});
        }
    }, error: function(){
        //if user doesn't exist print it out
        console.log(`User ${friendName} doesn't exist`);
    }});

    //reset the input to blank
    input.value = "";
}

loadUsers();

window.setInterval(function() {
    loadFriends();
    }, 1000);

