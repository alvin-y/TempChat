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
	var x = 0;
	for (var i = 0; i < table.rows.length; i++){
		for(var j = 0; j < table.rows[0].cells.length;j++){
			if(j%2 == 0){//name
				var length = table.rows[i].cells.item(j).innerHTML.length * 12;
				console.log(length);
				cells[x].style.verticalAlign = "top";
				cells[x].style.width = length + "px";
			}
			x++;
		}
	}

	chatBox.scrollTop = chatBox.scrollHeight;

	messageBox.value = "";
}

