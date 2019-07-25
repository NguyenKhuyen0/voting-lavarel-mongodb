<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/keycloak-js@6.0.1/dist/keycloak.js"></script>
<script>
    window.keycloak = Keycloak({
        url: 'https://id.360life.vn/auth/',
        realm: 'master',
        clientId: 'voting-dev',
        
    });
    window.token = '';
    window.userID = '';

    window.addEventListener('DOMContentLoaded', (event) => {


        window.keycloak.init({onLoad: 'check-sso'}).success(function(authenticated) {
            if(authenticated)
            {
                // Đã login rồi.
            }
            console.log(authenticated);
        }).error(function() {
            alert('failed to initialize');
        });  
        
        
    });

    window.keycloak.onAuthSuccess = function() {
        window.token = keycloak.token;
        window.userID = keycloak.subject;
        window.addEventListener('load', (event) => {
            window.iframeWin = document.getElementById("iframe-voting").contentWindow;
            iframeWin.postMessage({"token" : token, 'userID' : userID}, "*");
        })
    }

    function login()
    {
        keycloak.login();
      

            
   
    }
    


    window.addEventListener('message', function(e) {
        // console.log(e.data.msg);
        // console.log(e.origin);
        if (e.origin == 'http://idesign.local') {
            console.log('Login di ban');
            login();
        } 
    }, false);
</script>
</head>
<body>
<script>
/* If the keycloak.json file is in a different location you can specify it: 

Try adding file to application first, if you fail try the another method mentioned below. Both works perfectly.

            var keycloak = Keycloak('http://localhost:8080/myapp/keycloak.json'); */    

/* Else you can declare constructor manually  */


     
                // keycloak.login();
                //

                // function logout() {
                //     //
                //     keycloak.logout('http://auth-server/auth/realms/master/protocol/openid-connect/logout?redirect_uri=encodedRedirectUri')
                //     //alert("Logged Out");
                // }
             </script>
<iframe id="iframe-voting" src="http://idesign.local/voting/5d25b5db8f04e73f24005144"  width="100%" height="700px"></iframe>
</body>
</html>


