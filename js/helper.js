var GoogleAuth, // Google Auth object.
isAuthorized = false,
currentApiRequest;
debugger;
function handleClientLoad() {
          // Load the API's client and auth2 modules.
          // Call the initClient function after the modules load.
          gapi.load('client:auth2', initClient);
        }
function initClient() {
          console.log('api client loaded');
          gapi.client.init({
            'apiKey': 'AIzaSyBwlBw6JVWDVQ4alw2sUVSt7QMHrRMGU1g',
            'clientId': '171299260954-64u8p2hela9hb4s9pa9r00stq9ou0mbs.apps.googleusercontent.com',
            'scope': 'https://www.googleapis.com/auth/tagmanager.edit.containers',
            'discoveryDocs': ['https://www.googleapis.com/discovery/v1/apis/drive/v3/rest']
          }).then(function() {
            console.log('gapi.client Loaded');
            window.button = window.document.createElement('button');
            button.innerHTML = "Sign in";
            button.addEventListener('click',function(){
              if (GoogleAuth.isSignedIn.get()) {
                      // User is authorized and has clicked 'Sign out' button.
                      GoogleAuth.signOut();
                      window.document.body.insertBefore(button,null);
                    }
                    else {
                      // User is not signed in. Start Google auth flow.
                      GoogleAuth.signIn();
                    }
                  });
            window.document.body.insertBefore(button,null);
            GoogleAuth = gapi.auth2.getAuthInstance();
              // Listen for sign-in state changes.
              GoogleAuth.isSignedIn.listen(updateSigninStatus);
            });
        }
function updateSigninStatus(){
          if (GoogleAuth.isSignedIn.get()) {
            button.innerHTML="Sign Out";
            isAuthorized = true;
            console.log('Loaded');
              gapi.load(gapi.client.load('tagmanager', 'v2', gtmLoaded)); //select api you want to load
              if (currentApiRequest) {
                sendAuthorizedApiRequest(currentApiRequest);
              }
            }
            else {
              button.innerHTML="Sign In";
              isAuthorized = false;
            }
          }
          
          function gtmLoaded(){
           console.log("gtm loaded");
         }