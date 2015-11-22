var port = 31415;

var net = require('net');

var phpc = require('../laravelConnection');
var stringTest = require('../stringTest');

var cs = require('./connectionState');

var sockets = {};
var nConnections = 0;

var server = net.createServer(function(socket){
    socket.setEncoding("utf8");

    var StringBuffer = "";
    var UserData = {};
    var SESSIONID = -1;
    var CSTATE = cs.ENUM.STARTED;

    socket.on('data', function(data)
    {
        StringBuffer += data;

        JSONBuffer = stringTest.isValidJSON(StringBuffer);

        if(JSONBuffer)
        {
            switch(CSTATE)
            {
                case cs.ENUM.STARTED:

                    if(!JSONBuffer.email || !JSONBuffer.password)
                    {
                        break;
                    }

                    /**
                     * Validate the user credentials provided through the Laravel JSON api
                     */
                    phpc.validateCredentials(JSONBuffer.email, JSONBuffer.password,
                        function (error, response, body)
                        {
                            if(error) return console.error(error);

                            var response = stringTest.isValidJSON(body);

                            if(response && response.valid == true)
                            {
                                UserData = response;

                                if(!(UserData.id in sockets)) {
                                    sockets[UserData.id] = {};
                                }

                                SESSIONID = 0;
                                while(SESSIONID in sockets[UserData.id]) {
                                    SESSIONID++;
                                }

                                sockets[UserData.id][SESSIONID] = socket;

                                console.log(UserData.email + "\t session " + SESSIONID + "\tlogged in!");
                                CSTATE = cs.ENUM.AUTHED;
                            }
                            else
                            {
                                console.warn(JSONBuffer);
                                console.warn("Intruder alert!");
                            }
                        });
                    break;

                case cs.ENUM.AUTHED:

                    /**
                     * Send the message to the other sessions who are logged in
                     */
                    for(var key in sockets[UserData.id]) {
                        otherSocket = sockets[UserData.id][key];

                        if(otherSocket != socket) {
                            otherSocket.write(JSON.stringify(JSONBuffer));
                        }
                    }

                    /**
                     * Store the message in the database
                     */
                    if(('text/plain' in JSONBuffer)||('text/html in JSONBuffer'))
                    {
                        /*
                        dbc.insertTextClip(UserData.id, "text", JSON.stringify(JSONBuffer), function(err, data) {
                            if(err) return console.error(err);
                        });
                        */
                    }
                    else
                    {
                        console.log("no text in json buffer");
                    }

                    var fullMsg = JSON.stringify(JSONBuffer, undefined, 2);
                    console.log(fullMsg);

                    break;

                default:
                    console.log(CSTATE);
                    break;
            }

            StringBuffer = "";
        }
    });

    socket.on('error', function(err) {
        console.log(err);
    });

    socket.on('close', function() {
        if(CSTATE == cs.ENUM.AUTHED) {
            console.log(UserData.username + "\t session " + SESSIONID + "\tlogged out!");
            delete sockets[UserData.id][SESSIONID];
        }
        console.log("Ended connection: " + nConnections);
        nConnections--;

        /**
         Currently disabled, causes errors can be implemented in C++ lookup
         Remove the socket again

         if(Object.getOwnPropertyNames(sockets[UserData.id]).length === 0){
      delete sockets[UserData.id];
    }

         */
    });

});

server.on('connection', function(socket) {
    nConnections++;
    console.log("Started connection: " + nConnections);
});
server.on('error', function(error) {
    console.warn(error);
})

server.listen(port);
