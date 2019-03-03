var sendButton = document.getElementById("send");
var messageBox = document.getElementById("message");

sendButton.addEventListener("click", sendMessage);

var countMessages = 0;

function sendMessage(){
	var node = document.createTextNode(messageBox.value);
	var newPara = document.createElement("p");
	newPara.appendChild(node);
	
	var chatBox = document.getElementById("chatBox");
	chatBox.appendChild(newPara);
	countMessages++;
	if(countMessages >= 15){
		chatBox.removeChild(chatBox.childNodes[0]);
	}
	messageBox.value = "";
}