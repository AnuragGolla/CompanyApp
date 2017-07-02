src="https://apis.google.com/js/platform.js" async defer>
src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
src="https://apis.google.com/js/client.js?onload=handleClientLoad">

var clientId = '569701942444-up9i9i2vetl77rd8sqhc9e7ggtdlturj.apps.googleusercontent.com';
var apiKey = 'AIzaSyAZFXRFZMDqlyEz3sk6SgH2pfFv-Jcjx3M';
var scopes = "https://www.googleapis.com/auth/calendar";


function onSignIn(googleUser) {
  // Useful data for your client-side scripts:
  var profile = googleUser.getBasicProfile();
  console.log("ID: " + profile.getId()); // Don't send this directly to your server!
  console.log('Full Name: ' + profile.getName());
  console.log('Given Name: ' + profile.getGivenName());
  console.log('Family Name: ' + profile.getFamilyName());
  console.log("Image URL: " + profile.getImageUrl());
  console.log("Email: " + profile.getEmail());

  // The ID token you need to pass to your backend:
  var id_token = googleUser.getAuthResponse().id_token;
  console.log("ID Token: " + id_token);
};


function signOut() {
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    console.log('User signed out.');
  });
}

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

function insertEvent () {
  console.log(clientId);
  console.log(apiKey);
  console.log(scopes);
  var myevent = {
    'summary': 'Test Event',
    'start': {
      'date': '2017-06-27',
    },
    'end': {
      'date': '2017-06-27',
    },
  }
  console.log(gapi.client.calendar.events());
  var myrequest = gapi.client.calendar.events.insert({
    'calendarId': 'primary',
    'resource': myevent
  });
  myrequest.execute(function(myevent) {
    console.log('Event created: ' + myevent.htmlink);
  });
}





/*
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
*/


/*
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
*/


/*
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

*/

/*
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
*/
