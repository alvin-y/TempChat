/*
o0BuF2zglZQPmlqRCR6RB2vGqGY5t3Dw

*/

var sendButton = document.getElementById("send");
var messageBox = document.getElementById("message");
var gifButton = document.getElementById("gifs");
sendButton.addEventListener("click", function(event){
  event.preventDefault()
});
gifButton.addEventListener("click", function(event){
  event.preventDefault()
});


sendButton.addEventListener("click", sendMessage);
gifButton.addEventListener("click", gifs);

var countMessages = 0;

function sendMessage(){
	var user = document.getElementById("username").value;
	var nameNode = document.createTextNode(user + " : ");
	var table = document.getElementById("chat");
	var row = table.insertRow(table.length);
	var name = row.insertCell(0);
	var chatmsg = row.insertCell(1);
	name.innerHTML = user + " :";
	chatmsg.innerHTML = messageBox.value;
	var cells = document.getElementsByTagName("td");
	var x = 0;
	
	for (var i = 0; i < table.rows.length; i++){
		for(var j = 0; j < table.rows[0].cells.length;j++){
			if(j%2 == 0){//name
				var length = table.rows[i].cells.item(j).innerHTML.length * 12;
				cells[x].style.verticalAlign = "top";
				cells[x].style.width = length + "px";
			}
			x++;
		}
	}
	chatBox.scrollTop = chatBox.scrollHeight;
	var msg= messageBox.value;
	messageBox.value = "";
	$.ajax({
	   url:"send_chat.php",
	   method:"POST",
	   data:{msg:msg},
	   success:function(data)
	   {
		   alert("guip");
	   }
	  });
}
function gifs(){
	var table = document.getElementById("chat");
	var user = document.getElementById("username").value;
	var row = table.insertRow(table.length);
	var name = row.insertCell(0);
	var msg = row.insertCell(1);
	var gifsearch = document.getElementById("gifsearch").value;
	
	var random = Math.floor(Math.random() * 30);
	var x = 0;
	
	if(gifsearch.trim().length != 0){
		name.innerHTML = user + " :";
		var giphy = $.get("http://api.giphy.com/v1/gifs/search?q='"+ gifsearch +"'&api_key=o0BuF2zglZQPmlqRCR6RB2vGqGY5t3Dw&limit=30");
		giphy.done(function(response){console.log("DATA BOYS", response);
			var gifs = response.data;
			for( i in gifs){
				if(x == random)
					msg.innerHTML = "<img src='"+gifs[i].images.original.url+"'style='height:100px; width 100px;'/>";
				x++;
				chatBox.scrollTop = chatBox.scrollHeight;
			}
		});
	}else{
		alert("Search can not be blank or white spaces only!");
	}
}
