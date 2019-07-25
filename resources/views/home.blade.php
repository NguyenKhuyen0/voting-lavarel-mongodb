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
    var customKeyCloak = {};
    window.addEventListener('DOMContentLoaded', (event) => {

        window.keycloak.init({onLoad: 'check-sso'}).success(function(authenticated) {
            if(authenticated)
            {
                customKeyCloak = createCustomKeyCloak(keycloak);
                document.getElementById("iframe-voting").onload = function(){
                    sendMessage(customKeyCloak);
                };
            }
            console.log('Bước 1');
        }).error(function() {
            alert('failed to initialize');
        });  
    });

    window.addEventListener('message', function(e) {
        if (e.origin == 'http://idesign.local' && e.data.msg =='login') {
            
            logIn();
        } 
        if (e.origin == 'http://idesign.local' && e.data.msg =='logout') {
            
            logOut();
        } 
    }, false);

    function logIn()
    {
        keycloak.login();
    }
    function logOut()
    {
        keycloak.logout();
    }
    

    function sendMessage(data)
    {
        console.log('parent send message', data );
        var iframeWin = document.getElementById("iframe-voting").contentWindow;
        console.log(iframeWin);
        iframeWin.postMessage(data, "*");
    }
    function createCustomKeyCloak(keycloak)
    {
        var customKeyCloak = {};
        customKeyCloak.flow = keycloak.flow;
        customKeyCloak.subject = keycloak.subject;
        customKeyCloak.token = keycloak.token;
        customKeyCloak.tokenParsed = keycloak.tokenParsed;
        customKeyCloak.refreshToken = keycloak.refreshToken ;
        customKeyCloak.timeSkew = keycloak.timeSkew;
        customKeyCloak.authenticated = keycloak.authenticated;
        return customKeyCloak;
    }





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


