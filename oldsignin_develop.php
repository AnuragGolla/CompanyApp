<html lang="en">
  <head>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-calendar-scope" content="https://www.googleapis.com/auth/calendar">
    <meta name="google-signin-client_id" content="569701942444-up9i9i2vetl77rd8sqhc9e7ggtdlturj.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
      #signin_control {
        background-color: aqua;
      }
    </style>
  </head>
  <body>

<button type="submit" onclick="loadProfile()">loadProfile</button> <!-- MUST WRITE THIS FUNCTION UNDER SIGNIN CHANGE NOT BUTTON -->

    <script>
      var userObject = "default";
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        profile = googleUser.getBasicProfile();
        window.userJsonData = JSON.stringify(profile);
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());
        var id_token = googleUser.getAuthResponse().id_token; // The ID token you need to pass to your backend:
        console.log("ID Token: " + id_token);

        loadProfile(); //full load of user info to DB
      };


      function loadProfile(googleUser) {
          var userObject = JSON.parse(window.userJsonData);
          console.log(userObject.Eea);
          console.log(userObject.ig);
          console.log(userObject.ofa);
          console.log(userObject.wea);
          console.log(userObject.U3);


          var eventArr = getUserEvents();
          var eventArrStr = JSON.stringify(eventArr);


      /*    var user_Id = userObject.Eea;
          var user_FullName = userObject.ig;
          var user_GivenName = userObject.ofa;
          var user_FamilyName = userObject.wea;
          var user_Email = userObject.U3;
          window.location.href="serverstuff.php?user_Id=" + userObject.Eea;
          window.location.href="serverstuff.php?user_FullName=" + userObject.ig;
          window.location.href="serverstuff.php?user_GivenName=" + userObject.ofa;
          window.location.href="serverstuff.php?user_FamilyName=" + userObject.wea;
          window.location.href="serverstuff.php?user_Email=" + userObject.U3; */
          $.post('serverstuff.php', {user_Id: userObject.Eea, user_FullName: userObject.ig, user_GivenName: userObject.ofa, user_FamilyName: userObject.wea, user_Email: userObject.U3, user_GoogleEvents: eventArrStr});
      /*    $.post('serverstuff.php', {user_FullName: userObject.ig});
          $.post('serverstuff.php', {user_GivenName: userObject.ofa});
          $.post('serverstuff.php', {user_FamilyName: userObject.wea});
          $.post('serverstuff.php', {user_Email: userObject.U3});    */
        //  $.post("serverstuff.php");
        //  return false;
        // getUserEvents() function here***************
      }

      //event object: has a start and end time.
       function eTime(start, end) {
         this.start = start;
         this.end = end;
         this.elap = (this.end.getHours()-this.start.getHours());
       }
       //sort an array of eTime objects and converts it to strings.
       function sortETime(array) {
         for(var i = 0; i<array.length;i++){
           array[i] = JSON.stringify(array[i]);
         }
         return (array.sort());
       }

       //creates a date in iso string format that is exactly one year from current time.
       function addDate(){
         var add = new Date();
         add.setFullYear((add.getFullYear()+1));
         return (add.toISOString());
       }


        //returns all the events of a user within the next year in an array of eTime objects. Returns null if no events within the next year.
        function getUserEvents() {
          gapi.client.calendar.events.list({
            'calendarId': 'primary',
            'timeMin': (new Date()).toISOString(),
            'timeMax': addDate(),
            'showDeleted': false,
            'singleEvents': true,
            'orderBy': 'startTime'
          }).then(function(response) {
            var startEventTimes = [];
            var endEventTimes = [];
            var events = response.result.items;
            //check to make sure that there are events in time frame
            if (events.length > 0) {
              var busy = [];
              for (i = 0; i < events.length; i++) {
                var event = events[i];
                startEventTimes.push(event.start.dateTime);
                endEventTimes.push(event.end.dateTime);
              }

              for (a=0;a<startEventTimes.length; a++){
                var b = new eTime(startEventTimes[a],endEventTimes[a]);
                busy.push(b);
              }

              busy = sortETime(busy);

              return busy;

            } else {
              startEventTimes = null;
              endEventTimes = null;
              return null;
            }
          });
        }




    </script>

    <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>

    <button href="#" onclick="signOut()">Sign out</button>

    <script>
      function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
          console.log('User signed out.');
        });
      }
    </script>

        <div id="signin_control"> <!--full signin block-->
          <div class="row">
        		<div class="col-md-2 col-sm-2 col-xs-12">
        		  <button id="authorize-button" style="visibility: hidden" class="btn btn-primary">Sign In!</button><br>
              <p id="aftersignin"></p>
        	  </div><!-- .col -->
        	  <div class="col-md-10 col-sm-10 col-xs-12">
        	  <script type="text/javascript">
        			var clientId = '569701942444-up9i9i2vetl77rd8sqhc9e7ggtdlturj.apps.googleusercontent.com';
        			var apiKey = 'AIzaSyAZFXRFZMDqlyEz3sk6SgH2pfFv-Jcjx3M';
        			var scopes = "https://www.googleapis.com/auth/calendar";
        			// Oauth2 functions
        			function handleClientLoad() {
        				gapi.client.setApiKey(apiKey);
        				window.setTimeout(checkAuth,1);
        			}
        			function checkAuth() {
        				gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true}, handleAuthResult);
        			}
        			// show/hide the 'authorize' button, depending on application state
        			function handleAuthResult(authResult) {
        				var authorizeButton = document.getElementById('authorize-button');
        				var resultPanel		= document.getElementById('result-panel');
        				var resultTitle		= document.getElementById('result-title');
        				if (authResult && !authResult.error) {
        					authorizeButton.style.visibility = 'hidden';			// if authorized, hide button
                  //document.getElementById("aftersignin").innerHTML = "Congrats, you are signed in!"
        					resultPanel.className = resultPanel.className.replace( /(?:^|\s)panel-danger(?!\S)/g , '' )	// remove red class
        					resultPanel.className += ' panel-success';				// add green class
        					//resultTitle.innerHTML = 'Application Authorized'		// display 'authorized' text
                  makeApiCall();											// call the api if authorization passed
        				} else {													// otherwise, show button
        					authorizeButton.style.visibility = 'hidden';
        					resultPanel.className += ' panel-danger';				// make panel red
        					authorizeButton.onclick = handleAuthClick;				// setup function to handle button click
        				}
        			}
        			// function triggered when user authorizes app
        			function handleAuthClick(event) {
        				gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthResult);
        				return false;
        			}
        			// function load the calendar api and make the api call
        			function makeApiCall() {
                gapi.client.load('calendar', 'v3')
        			}
        		</script>
        		<script src="https://apis.google.com/js/client.js?onload=handleClientLoad"></script>

        		<div class="panel panel-danger" id="result-panel">
        		<div class="panel-heading">
        					<!--<h3 class="panel-title" id="result-title">Application Not Authorized</h3>-->
        		</div><!-- .panel-heading -->
        		<div class="panel-body">
        			<div id="event-response"></div>
        		</div><!-- .panel-body -->
        	</div><!-- .panel -->
        </div><!-- .col -->
      </div><!-- .row -->
    </div><!--full signin block-->

</body>
</html>


    <!-- Insert Event code
        	<button onclick="insertEvent()">Insert Event<button>
        	  <script>
              var profile = googleUser.getBasicProfile();
              var userEmail = profile.getEmail()
        	    function insertEvent () {
        	      var myevent = {
        	        'summary': 'Test Event',
        	        'start': {
        	          'date': '2017-06-27',
        	        },
        	        'end': {
        	          'date': '2017-06-27',
        	        },
        	      }
        	      var myrequest = gapi.client.calendar.events.insert({
        	        'calendarId': userEmail,
        	        'resource': myevent
        	      });
        	      myrequest.execute(function(myevent) {
                  console.log('Event created: ' + myevent.htmlink);
        	      });
        	    }
        	  </script>
     -->






        <button onclick="checkResource()">Check Busy Old<button>

  <!--      <script>
          function checkResource() {
            var calendarId = "agolla07@gmail.com";
            var response = gapi.client.calendar.freebusy.query({
              "items": [
                {
                  "id": calendarId
                }
              ],
              "timeMin": new Date(2017,06,29,12,00,00,00),
              "timeMax": new Date(2017,07,01,12,00,00,00)
            });
            console.log(response);
            console.log(response.kind);
            console.log('Time MIN = '+response.timeMin);
            console.log('Time MAX = '+response.timeMax);
            console.log('busy start = '+response.calendars.busy[0].start);
            console.log('busy end = '+response.calendars.busy[0].end);
            console.log('Response: '+ response);
          }
        </script>  -->

<!--    <script>
        function checkResource() {
          var calendarId = "primary";
          var check = {
            items: [{id: calendarId, busy: 'Active'}],
            timeMax: "2017-07-01T12:00:00-00:00",
            timeMin: "2017-06-29T12:00:00-00:00"
          };
          var response = gapi.client.calendar.freebusy.query(check);
          console.log(response.kind)
          console.log('Time MIN = '+response.timeMin)
          console.log('Time MAX = '+response.timeMax)
          console.log('busy start = '+response.calendars[calendarId].busy[0].start)
          console.log('busy end = '+response.calendars[calendarId].busy[0].end)
          console.log('Response: '+ response);
        }
  </script> -->





<button id="checkBusy">Check Busy<button>

<!--  <script>
  $(document).ready(function(){
    console.log("enter jQ success");
    $("button").click(function(){
        console.log("enter JQ click sucess");
        var myUrl = "https://www.googleapis.com/calendar/v3/freeBusy?fields=calendars%2CtimeMax%2CtimeMin&key={AIzaSyAZFXRFZMDqlyEz3sk6SgH2pfFv-Jcjx3M}";
        var prepostData = {
          "timeMin": "2017-06-29T12:00:00-00:00",
          "timeMax": "2017-07-01T12:00:00-00:00",
          "items": [
            {
              "id": "agolla07@gmail.com"
            }
          ]
        };
        var postData = JSON.stringify(prepostData);
        $.post(myUrl, postData,function(){
            console.log("callback run success");
        });
    });
  });
  </script>
-->

<!--

<script>
  $(document).ready(function(){
    console.log("enter jQ success");
    $("button").click(function(){
        console.log("enter JQ click sucess");
        $.ajax({
          url: "https://www.googleapis.com/calendar/v3/freeBusy?fields=calendars%2CtimeMax%2CtimeMin&key=[AIzaSyAZFXRFZMDqlyEz3sk6SgH2pfFv-Jcjx3M]",
          method: "POST",
          data: {
                  "timeMin": "2017-06-29T12:00:00-00:00",
                  "timeMax": "2017-07-01T12:00:00-00:00",
                  "items": [
                    {
                      "id": "agolla07@gmail.com"
                    }
                  ]
          },
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          sucess: null
        });
    });
  });
</script>

-->




/*
$service = new Google_CalendarService($client); // successfully connected
$freebusy = new Google_FreeBusyRequest();
$freebusy->setTimeMin('2017-06-29T12:00:00.000-06:00');
$freebusy->setTimeMax('2017-07-01T12:00:00.000-06:00');
$freebusy->setTimeZone('America/Denver');
$freebusy->setGroupExpansionMax(10);
$freebusy->setCalendarExpansionMax(10);
$mycalendars= array("agolla07@gmail.com");
$freebusy->setItems = $mycalendars;
$createdReq = $service->freebusy->query($freebusy);
echo $createdReq->getKind(); // works
echo $createdReq->getTimeMin(); // works
echo $createdReq->getTimeMax(); // works
$s = $createdReq->getCalendars($diekalender);
Print_r($s, true); // doesn't show anything
*/
