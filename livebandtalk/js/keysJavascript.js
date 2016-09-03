(function(){
	var myFirebaseRef = new Firebase("https://vivid-torch-9771.firebaseio.com/");
	var currentKey = "";
	var firstlaunch = true;

	if(firstlaunch === true){
	    currentKey = getDataFromFirebase();
	    firstlaunch = false;
	}

	// Get value from clicked button (of keys)
	$('.btn').on('click',function(e){
		currentKey = $(e.target).text();
		savingDataToFireBase(currentKey);
    });	

	$('#clearKey').click(function (){
		currentKey = "";
		savingDataToFireBase(currentKey);
		resetButtonBackgrounds();
	});
    

    function resetButtonBackgrounds(){
    	$('.btn').each(function(i, btn){
			$(btn).css("background-color","white");
	    });
    }

    function getKeyChords(key){
    	var chords;
    	if(key == 'C'){
    		chords = "C • Dm • Em • F • G • Am • Bdim";
    	}
    	else if(key == 'G'){
    		chords = "G • Am • Bm • C • D • Em • F#dim";
    	}
    	else if(key == 'D'){
    		chords = "D • Em • F#m • G • A • Bm • C#dim";
    	}
    	else if(key == 'A'){
    		chords = "A • Bm • C#m • D • E • F#m • G#dim";
    	}
    	else if(key == 'E'){
    		chords = "E • F#m • G#m • A • B • C#m • D#dim";
    	}
    	else if(key == 'B'){
    		chords = "B • C#m • D#m • E • F# • G#m • A#dim";
    	}
    	else if(key == 'F#'){
    		chords = "F# • G#m • A#m • B • C# • D#m • E#dim";
    	}
    	else if(key == 'Db'){
    		chords = "Db • Ebm • Fm • Gb • Ab • Bbm • Cdim";
    	}
    	else if(key == 'Ab'){
    		chords = "Ab • Bbm • Cm • Db • Eb • Fm • Gdim";
    	} 
    	else if(key == 'Eb'){
    		chords = "Eb • Fm • Gm • Ab • Bb • Cm • Ddim";
    	}
    	else if(key == 'Bb'){
    		chords = "Bb • Cm • Dm • Eb • F • Gm • Adim";
    	} 
    	else if(key == 'F'){
    		chords = "F • Gm • Am • Bb • C • Dm • Edim";
    	} 
    	else {
    		chords = "";
    	}
    	return chords;  	    	
    }

	function bindDataToHTML(key){
		$('.btn').each(function(i, btn){
			if($(btn).text() == key){
				$(btn).css("background-color","#8BFF8B");
			}
	    });

    	chords = getKeyChords(key);
    	$("#keyChords").text(chords);
	}

	//saving data as JSON to firebase    
	function savingDataToFireBase(theSongKey){
		myFirebaseRef.child('songKey').set(theSongKey);
	}

	function getDataFromFirebase(){
    	var key;
	    myFirebaseRef.child("songKey").on("value", function(snapshot) {
	    	key = snapshot.val();
	    	resetButtonBackgrounds();
	    	bindDataToHTML(key); 

		}, function(errorObject){
			console.log("The read failed: " + errorObject.code);
		});
		return key;
	}

    // ...
})();