<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Chat Application</title>
</head>
<body>
<a class="button" href="https://puff.mnstate.edu/~gf4688rm/private/index.html">Home</a><br><br>
    <h1>Chat Application</h1>
    <div class="chat-box" id="chat-box"></div>
    <table>
    <form id="chat-form" onsubmit="sendMessage(); return false;">
        <tr><td><label for="name">Name:</label></td>
        <td><input class="text" type="text" id="name" name="name" required></td></tr>
        <tr><td><label for="message">Message:</label></td>
        <td><input class="text" type="text" id="message" name="message" required></td></tr>
        <tr><td><button type="submit">Submit</button></td>
        <td><button type="button" id="clear-all" onclick="clearAll()">Clear All</button></td>
    </form>
    </tr>
    </table>
<script>
    // Function to load messages
    function loadChat() {
        // Create a new XMLHttpRequest object
        var req = new XMLHttpRequest();
        // Set up a callback function to handle the response
        req.onreadystatechange = function() {
            // Check if the request is successful
            if (req.readyState == 4 && req.status == 200) {
                // Update the content of the "chat-box" element with the response
                document.getElementById("chat-box").innerHTML = req.responseText;
            }
        };
        // Open a GET request to "backend.php"
        req.open("GET", "backend.php", true);
        // Send the GET request
        req.send();
    }
    // Function to send a message
    function sendMessage() {
        // Get values of the name and message input fields
        var name = document.getElementById("name").value;
        var message = document.getElementById("message").value;
        // Create a new XMLHttpRequest object
        var req = new XMLHttpRequest();
        // Set up a callback function to handle the response
        req.onreadystatechange = function() {
            // Check if the request is successful
            if (req.readyState == 4 && req.status == 200) {
                // Reload chat messages after sending a new message
                loadChat(); 
                // Reset the name and message input fields
                document.getElementById("name").value = ""; 
                document.getElementById("message").value = "";
            }
        };
        // Open a POST request to "backend.php"
        req.open("POST", "backend.php", true);
        // Set the request header for form data
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Send the POST request with name and message as data
        req.send("name=" + name + "&message=" + message);
    }
    // Function to clear all messages
    function clearAll() {
        // Create a new XMLHttpRequest object
        var req = new XMLHttpRequest();
        // Set up a callback function to handle the response
        req.onreadystatechange = function() {
            // Check if the request is successful
            if (req.readyState == 4 && req.status == 200) {
                // Reload chat messages after clearing
                loadChat(); 
            }
        };
        // Open a GET request to "backend.php" with the query parameter "clear=true"
        req.open("GET", "backend.php?clear=true", true);
        // Send the request
        req.send();
    }

    // Load initial chat messages
    loadChat();
</script>
</body>
</html>

