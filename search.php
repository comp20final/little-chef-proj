<!doctype html>
<!-- The top of file index.html -->
<html itemscope itemtype="http://schema.org/Article">
<head>
  <!-- BEGIN Pre-requisites -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js">
  </script>
  <script src="https://apis.google.com/js/client:platform.js?onload=init" async defer>
  </script>
  <!-- END Pre-requisites -->

        <title>Little Chef</title>
        <link rel="stylesheet" type = "text/css" a href="style.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-signin-client_id" content="439158562310-ckb145tjd6iqh6491sptnlvc0ir4481g.apps.googleusercontent.com">

    </head>

    <body>
        
    <!--BEGINNING OF GOOGLE LOGIN HANDLING-->
    <script>
    function init() {
     
    /**
    * The Sign-In client object.
    */
    var auth2;
    /**
     * Initializes the Sign-In client.
     */
    var initClient = function() {
        gapi.load('auth2', initSigninV2
        );
        // Attach the click handler to the sign-in button
        auth2.attachClickHandler('signin-button', {}, onSuccess, onFailure);
    };
    
    

    /**
     * Handle successful sign-ins.
     */
    var onSuccess = function(user) {
        console.log('Signed in as ' + user.getBasicProfile().getName());
     };

    /**
     * Handle sign-in failures.
     */
    var onFailure = function(error) {
        console.log(error);
    };
    
    
}
    /**
    * Initializes Signin v2 and sets up listeners.
    */
    var initSigninV2 = function() {
    auth2 = gapi.auth2.init({
      client_id: '439158562310-ckb145tjd6iqh6491sptnlvc0ir4481g.apps.googleusercontent.com',
    });
    };
    
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        document.getElementById("pfp").src = profile.getImageUrl();
    }
    
    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
        console.log('User signed out.');
        window.location.replace("https://blanket-pain.000webhostapp.com/login.html");
        });
    }
    
    function get_email() {
        var auth2 = gapi.auth2.getAuthInstance();
            if (auth2.isSignedIn.get()) {
                var profile = auth2.currentUser.get().getBasicProfile();
                return profile.getEmail();
            } 
    }
    
    </script>
    <!--END OF GOOGLE LOGIN HANDLING-->
    
    <?php
        extract ($_POST);
    ?>
    
    <script>
    
    window.onload = function() {
        

        if (!("<?php echo $search2 ?>" == "")){
    
            if ("<?php echo $rad ?>" == "recipe") {
                recipes("<?php echo $search2?>");
            } else if ("<?php echo $rad ?>" == "ingredients") {
                ingredients("<?php echo $search2?>");
            } else {
                cuisine("<?php echo $search2?>");
            }
            
        } else {
            generate_table("");
        }
        
        
    }
        
        function recipes(input) {
         
			/* Step 1: Make instance of request object...
			...to make HTTP request after page is loaded*/
			request = new XMLHttpRequest();
			console.log("1 - request object created");
 
			// Step 2: Set the URL for the AJAX request to be the JSON file
            
            var str = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/search?query=" + input;
 
		    request.open("GET", str);
            request.setRequestHeader("x-rapidapi-key", "38da8f5d71mshf0d055abd49828fp12390djsn6c52c14644fd");
            request.setRequestHeader("x-rapidapi-host", "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com");

			console.log("2 - opened request file");
 
			// Step 3: set up event handler/callback

			request.onreadystatechange = function() {
				console.log("3 - readystatechange event fired.");
 
				if (request.readyState == 4 && request.status == 200) {

					// Step 5: wait for done + success
					console.log("5 - response received");
					result = request.responseText;
					//alert(result);
					fact = JSON.parse(result);
                    
					generate_table(fact);
				}
				else if (request.readyState == 4 && request.status != 200) {

					console.log("Something is wrong!  Check the logs to see where this went off the rails");

				}

				else if (request.readyState == 3) {

					console.log("Too soon!  Try again");

				}

			}
		// Step 4: fire off the HTTP request
			request.send();
			console.log("4 - Request sent");
		}
		
		function ingredients(input) {
         
			/* Step 1: Make instance of request object...
			...to make HTTP request after page is loaded*/
			request = new XMLHttpRequest();
			console.log("1 - request object created");
 
			// Step 2: Set the URL for the AJAX request to be the JSON file
            
            
            var modified_input = input.replace(/ /g, "%2C");
           
            var str = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/findByIngredients?ingredients=" + modified_input;
 
		    request.open("GET", str);
            request.setRequestHeader("x-rapidapi-key", "38da8f5d71mshf0d055abd49828fp12390djsn6c52c14644fd");
            request.setRequestHeader("x-rapidapi-host", "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com");

			console.log("2 - opened request file");
 
			// Step 3: set up event handler/callback

			request.onreadystatechange = function() {
				console.log("3 - readystatechange event fired.");
 
				if (request.readyState == 4 && request.status == 200) {

					// Step 5: wait for done + success
					console.log("5 - response received");
					result = request.responseText;
					//alert(result);
					fact = JSON.parse(result);
                    
					generate_ing_table(fact);
				}
				else if (request.readyState == 4 && request.status != 200) {

					console.log("Something is wrong!  Check the logs to see where this went off the rails");

				}

				else if (request.readyState == 3) {

					console.log("Too soon!  Try again");

				}

			}
		// Step 4: fire off the HTTP request
			request.send();
			console.log("4 - Request sent");
		}
		
		function cuisine(input) {
         
			/* Step 1: Make instance of request object...
			...to make HTTP request after page is loaded*/
			request = new XMLHttpRequest();
			console.log("1 - request object created");
 
			// Step 2: Set the URL for the AJAX request to be the JSON file
            
            var str = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/search?query=%22%22&cuisine=" + input;
 
		    request.open("GET", str);
            request.setRequestHeader("x-rapidapi-key", "38da8f5d71mshf0d055abd49828fp12390djsn6c52c14644fd");
            request.setRequestHeader("x-rapidapi-host", "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com");

			console.log("2 - opened request file");
 
			// Step 3: set up event handler/callback

			request.onreadystatechange = function() {
				console.log("3 - readystatechange event fired.");
 
				if (request.readyState == 4 && request.status == 200) {

					// Step 5: wait for done + success
					console.log("5 - response received");
					result = request.responseText;
					//alert(result);
					fact = JSON.parse(result);
					
					generate_table(fact);
                    
				}
				else if (request.readyState == 4 && request.status != 200) {

					console.log("Something is wrong!  Check the logs to see where this went off the rails");

				}

				else if (request.readyState == 3) {

					console.log("Too soon!  Try again");

				}

			}
		// Step 4: fire off the HTTP request
			request.send();
			console.log("4 - Request sent");
		}
		
		function generate_table(fact) {
		    
		    var auth2 = gapi.auth2.getAuthInstance();
            if (!auth2.isSignedIn.get()) {
                signOut();
            }
		    
		    var table = document.getElementById("display_recipes");
		    
		    if (fact == "") {
		        var row = table.insertRow(0);
                var cell1 = row.insertCell(0);
                cell1.innerHTML = "No recipes found";
		    } else {
		        
		        var row = table.insertRow(0);
		        var cell1 = row.insertCell(0);
		        var btn = document.createElement("BUTTON");
		        btn.type = "submit";
		        btn.innerHTML = "Update Favorites";
		        btn.onclick = function() {
		            var auth2 = gapi.auth2.getAuthInstance();
                    if (!auth2.isSignedIn.get()) {
                        signOut();
                    }
		        }
		        cell1.appendChild(btn);
		        
		        for (j = 0; j < fact.results.length; j++) {
		            var row = table.insertRow(0);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    
                    cell1.innerHTML = fact.results[j].title;
                    
                    var box = document.createElement("INPUT");
                    box.setAttribute("type", "checkbox");
                    box.value = fact.results[j].title;
                    box.name = ("box[]");
                    cell2.appendChild(box);
                    
		        }
		        
		    }
		    
		}
        
        function generate_ing_table(fact) {
            
            var auth2 = gapi.auth2.getAuthInstance();
            if (!auth2.isSignedIn.get()) {
                signOut();
            }
            
            
		    var table = document.getElementById("display_recipes");
		    
		    if (fact == "") {
		        var row = table.insertRow(0);
                var cell1 = row.insertCell(0);
                cell1.innerHTML = "No recipes found";
		    } else {
		        
		        var row = table.insertRow(0);
		        var cell1 = row.insertCell(0);
		        var btn = document.createElement("BUTTON");
		        btn.type = "submit";
		        btn.innerHTML = "Update Favorites";
		        btn.onclick = function() {
		            var auth2 = gapi.auth2.getAuthInstance();
                    if (!auth2.isSignedIn.get()) {
                        signOut();
                    }
		        }
		        cell1.appendChild(btn);
		        
		        for (j = 0; j < fact.length; j++) {
		            var row = table.insertRow(0);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    
                    cell1.innerHTML = fact[j].title;
                    
                    var box = document.createElement("INPUT");
                    box.setAttribute("type", "checkbox");
                    box.value = fact[j].title;
                    box.name = ("box[]");
                    cell2.appendChild(box);
                    
		        }
		        
		    }
		    
		}
		
    </script>
    
    <!-- Header goes here -->
    <div class="header">
        <img src="logo.png" style="float:left; padding-left:20px; padding-top:10px;">
        
        <table style="float:right; margin-right:5px; margin-top:5px; border-radius:30px;">
            <tr>
                <td>
                    <img id="pfp" src="invisible_image.png" style="border-radius:30px; width:75px; height: 75px">
                </td>
            </tr>
            <tr>
                <td>
                    <button onclick="signOut()" style="background-color:rgba(149, 245, 165, 0.842);">Logout</button>
                </td>
            </tr>
        </table>
        
        <div class="g-signin2" data-onsuccess="onSignIn" style="display:none"></div>
    </div><br>


    <!-- Side naviation bar that pops up -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.html">Home</a>
        <a href="totry.html">To Try List</a>
        <a href="previous.html">Previous recipes</a>
        <a href="favorites.html">Favorites</a>
        <a href="recommended.html">Recommended</a>
      </div>

      <!-- Change the word based on the page we're currently on -->
      <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Search</span>
      

      <!-- Functions for the opening and closing of the navbar -->
      <script>
      function openNav() { document.getElementById("mySidenav").style.width = "250px"; }
      function closeNav() { document.getElementById("mySidenav").style.width = "0"; }
      </script>

    <div id="main">
        <div class="blockquote">
            <form action="search2.php" method="get">
                <table style="text-align:right; display: inline-block; margin-left: auto; margin-right: auto" id="display_recipes"></table>
            </form>
        </div>
        <div class="photowrapper">
            <div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div>


            <div id="searchbox">
                <form class="search" action="search.php" method="post" style="margin:auto;max-width:500px; padding:20px;">

                <!-- SEARCH BUTTON + SUBMIT BUTTON -->
                <input type="text" placeholder="Search.." name="search2">
                <button type="submit"><i class="fa fa-search"></i></button>

                <br><br>
                <div style=" color:white; padding:15px;">
                    <label class="searchtype">Recipe&nbsp;&nbsp;
                        <input type="radio" checked="checked" name="rad" value="recipe">
                        <span class="checkmark"></span>
                    </label>
                    <label class="searchtype">Ingredients&nbsp;&nbsp;
                        <input type="radio" name="rad" value="ingredients">
                        <span class="checkmark"></span>
                    </label>
                    <label class="searchtype">Cuisine&nbsp;&nbsp;
                        <input type="radio" name="rad" value="cuisine">
                        <span class="checkmark"></span>
                    </label>
                  </div> <!-- END OF SEARCH TYPE BUTTONS -->

            </form>
            
            <br>                
            <div>&nbsp;</div><div>&nbsp;</div>


        </div> <!-- end of searchbox -->

     </div> <!-- end of photowrapper -->

    </div> <!-- end of main -->

    </body>
</html>