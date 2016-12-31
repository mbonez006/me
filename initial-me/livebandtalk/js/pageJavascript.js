(function(){	
	//Hide elements
	$("#arrowUp").hide();
	$("#arrowDown").hide();

    // Simple list
	var list = document.getElementById("handle-1");

	//bind each songs to the HTML
    var theSongsHTML = '<li draggable="false" class=""><span class="drag-handle">☰</span>##<i class="js-remove">✖</i></li>';
    var myFirebaseRef = new Firebase("https://vivid-torch-9771.firebaseio.com/");
    var firstlaunch = true;
   	var songs;    
	var localConfig;
	if(firstlaunch === true){
	    songs = getDataFromFirebase();
	    localConfig = getConfigFromFirebase();
	    firstlaunch = false;
	}

	//getting the list to drag and drop and sort
	Sortable.create(list, {
	  onEnd: function (evt) {
	  	var updatedSongs = retrieveSongsFromHTMLList();
	  	var item = evt.item.textContent;	  	
		var listIndex = '#handle-1 li:eq('+evt.newIndex+')';
		var direction;
	  	
	  	//show icon based on drag direction
	  	if(evt.newIndex > evt.oldIndex){ //downward drag
	  		direction = "down";
	  	} //being dragged upwards
	  	else{
	  		direction = "up";
	  	}

	  	//updateConfigInformation
	  	localConfig = {
	  		dragDirection: direction,
	  		newIndex: evt.newIndex
	  	}
	  	savingDataToFireBase(updatedSongs,localConfig);
	  	updateListColoursAndIcons(localConfig);
	  },
	  filter: '.js-remove',
	  onFilter: function (evt) {
	  	evt.item.parentNode.removeChild(evt.item);
	  	var updatedSongs = retrieveSongsFromHTMLList();
	  	localConfig = {
    		dragDirection : "",
		  	newIndex: ""
    	}
	  	savingDataToFireBase(updatedSongs,localConfig);
	  }
	});

	//Handling the Popup that add songs to the list
	//Using ply.min.js
	$('#addSong').click(function () {
		var theSongs = getDataFromFirebase_WithoutBinding();
		if(theSongs !== undefined){
			theSongs = theSongs.split(";");
			if(theSongs.length <= 8){
				Ply.dialog('prompt', {
					title: 'Add Song',
					form: { name: 'Add Song Title' }
				}).done(function (ui) {
					addNewSongToList(ui.data.name)
				});
			}
			else{
				Ply.dialog("alert", "Maximum Songs (8) Reached!");
			}
		}
	});


	$("#handle-1").click(function(event){
		var target = $( event.target );
		if (target.is( "li" ) ) {
			//Ask for the song's key
			Ply.dialog('prompt', {
				title: 'Song Key',
				form: { name: 'Add Song Key' }
			}).done(function (ui) {
				addNewSongKey(ui.data.name,target.context.innerText)
			});
	  	}
	});

	function addNewSongKey(key,theSong){		
		var allSongs = getDataFromFirebase_WithoutBinding();
		if(allSongs !== undefined){
			var isnum = /^\d+$/.test(key);

			//remove the icons around the text
			var theSong = theSong.substring(1,theSong.length-1);
			var songWithKey;
			if(theSong.indexOf("Key(") > -1){
				songWithKey= theSong.replace(theSong.match(/Key.*/g), "Key("+key+")");		
			}
			else{
				songWithKey = theSong + " - Key("+key+")";
			}

			if(isnum === true){
				//remove the "key" from the song
			}


			var regexString = theSong.substring(0,theSong.length-2)+".*?;";
			if(regexString.indexOf("(") > -1 || regexString.indexOf(")") > -1){
				regexString = regexString.replace("(","\\(");
				regexString = regexString.replace(")","\\)");		
			}
			var re = new RegExp(regexString, 'g');
			var songToBeReplaced = allSongs.match(re);
			songToBeReplaced = songToBeReplaced[0].substring(0,songToBeReplaced[0].length-1);

			if(songToBeReplaced.indexOf("Key") > -1){
				allSongs = allSongs.replace(songToBeReplaced,songWithKey);
			}
			else{
				allSongs = allSongs.replace(theSong,songWithKey);
			}	

			localConfig = getConfigFromFirebase();
			savingDataToFireBase(allSongs,localConfig);
		}
	}


    function addNewSongToList(aSong){
    	var currentSongs = getDataFromFirebase_WithoutBinding();
    	aSong = aSong.concat(";");
    	currentSongs = currentSongs.concat(aSong);
    	//bindToHTML
    	bindDataToHTML(currentSongs);
    	//resetting config and then finally saving data as JSON to firebase
    	localConfig = {
    		dragDirection : "",
		  	newIndex: ""
    	}
    	savingDataToFireBase(currentSongs,localConfig);
    }


    //Get data from firebase    
    function getDataFromFirebase(){
    	var songs;
	    myFirebaseRef.child("Songs").on("value", function(snapshot) {
	    	songs = snapshot.val();	
	    	bindDataToHTML(songs); 	    	
		}, function(errorObject){
			console.log("The read failed: " + errorObject.code);
		});
		return songs;
	}

	//Get configuration data from firebase    
    function getConfigFromFirebase(){
    	var config;
	    myFirebaseRef.child("ConfigData").on("value", function(snapshot) {
	    	config = snapshot.val();	
	    	updateListColoursAndIcons(config);
		}, function(errorObject){
			console.log("The read failed: " + errorObject.code);
		});
		return config;
	}

	//Get data from firebase    
    function getDataFromFirebase_WithoutBinding(){
    	var songs;
	    myFirebaseRef.child("Songs").on("value", function(snapshot) {
	    	songs = snapshot.val();	  	
		}, function(errorObject){
			console.log("The read failed: " + errorObject.code);
		});
		return songs;
	}

	function bindDataToHTML(theSongs){
		if(theSongs !== undefined){
			theSongs = theSongs.split(";");
			$("#handle-1").text("");
 			for(var i=0; i<theSongs.length; i++){
				if(theSongs[i] !== ""){
					$("#handle-1").append(theSongsHTML.replace("##",theSongs[i]));
				}
			}
		}			
	}


	function updateListColoursAndIcons(config){
		if(config != undefined){
			var listIndex = '#handle-1 li:eq('+config.newIndex+')';

		  	//show icon based on drag direction
		  	if(config.dragDirection === "down"){ //downward drag
		  		$("#arrowUp").hide();
		  		$("#arrowDown").show();

		  		//change bg color of moved item		  	
			  	$(listIndex).css("background-color","#FFCC99");
		  	}
		  	else if(config.dragDirection === "up"){
		  		$("#arrowUp").show();
		  		$("#arrowDown").hide();

		  		//change bg color of moved item		  	
			  	$(listIndex).css("background-color","#90EE90");
		  	}
		  	else{
		  		$("#arrowUp").hide();
		  		$("#arrowDown").hide();
		  	}
	  	}
	}

	
	function retrieveSongsFromHTMLList(){
		var theSongs = "";
		$("#handle-1 li").each(function(){
			theSongs = theSongs + ($(this).text().substring(1,$(this).text().length-1) + ";");
	    });

	    return theSongs;
	}

	//saving data as JSON to firebase    
	function savingDataToFireBase(allSongs, config){
	    myFirebaseRef.set({
		  Songs: allSongs,
		  ConfigData: {
		  	dragDirection: config.dragDirection,
		  	newIndex: config.newIndex
		  }
		});
	};
    // ...
})();