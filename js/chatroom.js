var sendButton = document.getElementById("send");
var messageBox = document.getElementById("message");
sendButton.addEventListener("click", function(event){
  event.preventDefault()
});

sendButton.addEventListener("click", sendMessage);

var countMessages = 0;

function sendMessage(){
	var user = document.getElementById("username").value;
	var bold = document.createElement('strong');
	var node = document.createTextNode(user + " : " +messageBox.value);
	var newPara = document.createElement("p");
	newPara.appendChild(node);
	var chatBox = document.getElementById("chatBox");
	
	chatBox.appendChild(newPara);
	chatBox.scrollTop = chatBox.scrollHeight;

	messageBox.value = "";
}

