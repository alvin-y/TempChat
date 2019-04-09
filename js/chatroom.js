/*
o0BuF2zglZQPmlqRCR6RB2vGqGY5t3Dw
*/

var sendButton = document.getElementById("send");
var messageBox = document.getElementById("message");
var gifButton = document.getElementById("gifs");
var dlButton = document.getElementById("download");
var clrButton = document.getElementById("clear");
var disbandButton = document.getElementById("disband");
sendButton.addEventListener("click", function(event){
  event.preventDefault()
});
gifButton.addEventListener("click", function(event){
  event.preventDefault()
});


sendButton.addEventListener("click", sendMessage);
gifButton.addEventListener("click", gifs);
dlButton.addEventListener("click", downloadChat);
clrButton.addEventListener("click", clearChat);
disbandButton.addEventListener("click", disbandChat);


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
	countMessages++;
	var isGif = 0;
	$.ajax({
	   url:"send_chat.php",
	   method:"POST",
	   data:{msg:msg, isGif:isGif},
	   success:function(data)
	   {
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
		var giphy = $.get("https://api.giphy.com/v1/gifs/search?q='"+ gifsearch +"'&api_key=o0BuF2zglZQPmlqRCR6RB2vGqGY5t3Dw&limit=30");
		giphy.done(function(response){console.log("DATA BOYS", response);
			var gifs = response.data;
			for( i in gifs){
				if(x == random){
					msg.innerHTML = "<img src='"+gifs[i].images.original.url+"'style='height:100px; width 100px;'/>";
					msg = gifs[i].images.original.url;
					var isGif = 1;
					$.ajax({
				   url:"send_chat.php",
				   method:"POST",
				   data:{msg:msg, isGif:isGif},
				   success:function(data)
				   {
				   }
				  });
				
				}
				x++;
				chatBox.scrollTop = chatBox.scrollHeight;
			}
		});
		countMessages++;
	}else{
		alert("Search can not be blank or white spaces only!");
	}
	  
}

function downloadChat(){
	var roomID = document.getElementById("roomID").value;
	var username = document.getElementById("username").value;
	$.get("getNewChat.php", function(data){
		console.log("Download");
		var chatLog = $.parseJSON(data);
		var numMsgs = chatLog.length;
		//console.log(numMsgs);
		textDL = ""; //make string to put in text file
		for(var i = 0; i < numMsgs; i++){
			textDL += (chatLog[i][1] + ": " + chatLog[i][0] + '\n');
		}
		 var element = document.createElement('a');
		element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(textDL));
		element.setAttribute('download', "ChatLog#"+roomID);

		element.style.display = 'none';
		document.body.appendChild(element);

		element.click();

		document.body.removeChild(element);
	})
		.done(function(){
			console.log("Lists done");
		})
		.fail(function(){
			die();
			console.log("fail");
		})
		.always(function(){
			console.log("done");
		});
	var isGif = 0;
	var msg=username+" has tried to download the chat logs";
	
	$.ajax({
	   url:"send_chat.php",
	   method:"POST",
	   data:{msg:msg, isGif:isGif},
	   success:function(data)
	   {
	   }
	});
}
function clearChat(){
			$.ajax({
	   url:"clearChat.php",
	   method:"POST",
	   success:function(data)
	   {
			
			location.reload();
	   }
	  });
}
function disbandChat(){
	$.ajax({
	   url:"resetChat.php",
	   method:"POST",
	   success:function(data)
	   {
			alert("Room has been DESTROYED");
			location.reload();
	   }
	  });
}

setInterval(function(){ 
	getRoomStatus();
	getNewChat();
}, 1500);

function getRoomStatus(){
	$.get("roomStatus.php", function(data){
		var roomLog = $.parseJSON(data);
		console.log(roomLog.length);
		if(roomLog.length == 0){
			$.ajax({
			   url:"deleteUser.php",
			   method:"POST",
			   success:function(data)
			   {
					alert("Room has been DESTROYED");
					location.reload();
			   }
			});
		}
	})
	.done(function(){
		console.log("Lists done");
	})
	.fail(function(){
		die();
		console.log("fail");
	})
	.always(function(){
		console.log("done");
	});

}

function getNewChat(){
	$.get("getNewChat.php", function(data){
		console.log("Get New Chat");
		var chatLog = $.parseJSON(data);
		var numMsgs = chatLog.length;
		if(numMsgs == 0){
		$("#chat tr").remove();
			countMessages = 0;
		}
		while (numMsgs > countMessages){
			var user = chatLog[countMessages][1];
			var nameNode = document.createTextNode(user + " : ");
			var table = document.getElementById("chat");
			var row = table.insertRow(table.length);
			var name = row.insertCell(0);
			var chatmsg = row.insertCell(1);
			name.innerHTML = user + " :";
			
			if(chatLog[countMessages][2] == 0){
				chatmsg.innerHTML = chatLog[countMessages][0];
			} else{
				chatmsg.innerHTML = "<img src='"+chatLog[countMessages][0]+"'style='height:100px; width 100px;'/>";
			}
			
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
			countMessages++;
		}	
	})
		.done(function(){
			console.log("Lists done");
		})
		.fail(function(){
			die();
			console.log("fail");
		})
		.always(function(){
			console.log("done");
		});

}
