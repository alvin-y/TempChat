var sendButton = document.getElementById("send");
var messageBox = document.getElementById("message");
sendButton.addEventListener("click", function(event){
  event.preventDefault()
});

sendButton.addEventListener("click", sendMessage);

var countMessages = 0;

function sendMessage(){
	var user = document.getElementById("username").value;
	
	var nameNode = document.createTextNode(user + " : ");
	var table = document.getElementById("chat");
	var row = table.insertRow(table.length);
	var name = row.insertCell(0);
	var msg = row.insertCell(1);
	name.innerHTML = user + " :";
	msg.innerHTML = messageBox.value;
	var cells = document.getElementsByTagName("td");
	for (var i = 0; i < cells.length; i++){
		if(i%2 == 0){
			cells[i].style.verticalAlign = "top";
			cells[i].style.width = "100px";
		}
	}

	chatBox.scrollTop = chatBox.scrollHeight;

	messageBox.value = "";
}

