var request = require('request');

var port = 31400;

setInterval(function() {
    db.query("SELECT id FROM users LIMIT 1", function(err, rows) {});
    console.log("keeping database connection alive!");
}, 20 * 60 * 1000);

exports.insertTextClip = function(userid, type, data, callback) {
    db.query("INSERT INTO data (userid, type, data) VALUES (? , ? , ?)", [userid, type, data], callback);
};

exports.validateCredentials = function(email, password, callback) {
    request.post(
        'http://localhost:' + port + '/checkcredentials',
        { form: {email : email, password : password}},
        callback );
};

