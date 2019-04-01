var x = document.getElementById("create");
x.addEventListener("click", function(event){
  event.preventDefault()
});
x.addEventListener("click", create);

var y = document.getElementById("join");
y.addEventListener("click", function(event){
  event.preventDefault()
});
y.addEventListener("click", join);

var savename;
var saveroom;
function error(bad){
	bad.style.backgroundColor = "pink";
	bad.style.borderColor = "red";
	bad.style.backgroundImage = "url(images/error.png)";
}
function clean(good){
	good.style.borderColor="";
	good.style.backgroundColor = "white";
	good.style.backgroundImage = "";
}
function create(){
	var nickname = document.getElementById("name");
	var room = document.getElementById("roomid");

	if(nickname.value == ""){
		error(nickname);
	}else{
		clean(nickname);
		savename = nickname.value;
	}
	if(room.value == ""){
		error(room);
	}else{
		clean(room);
		saveroom = room.value;
	}
}
function join(){
	var nickname = document.getElementById("name");

	if(nickname.value == ""){
		error(nickname);
	}else{
		clean(nickname);
		savename = nickname.value;
	}
}

function alertUser(message){
	alert(message);
}