// require Express and Socket.io
var express = require('express');
var app = express();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var path = require('path');
var config = require('./config.js');
var cookieParser = require('cookie-parser');
var session = require('express-session');
var bodyParser = require('body-parser');


app.use(bodyParser.urlencoded({extended:false}))
app.use(bodyParser.json())
app.use(cookieParser());
app.use(session({secret: "Shh, its a secret!"}));

// the object that will hold information about the active users currently
// on the site
var visitorsData = {};

app.set('port', (process.env.PORT || 5000));

app.use(express.static(path.join(__dirname, 'public/')));

app.get('/auth',function(req,res){
    req.session.auth = "cool";
    if(req.session.auth){
    res.sendFile(path.join(__dirname, 'views/dashboard.html'));
  }
});

app.get('/login', function(req,res){
    res.sendFile(path.join(__dirname, 'views/login.html'));
});


 var route = "/";
app.get(route, function(req, res) {
  res.sendFile(path.join(__dirname, 'views/index.html'));
});

// serve up the dashboard when someone visits /dashboard
app.get('/dashboard', function(req, res) {
  res.sendFile(path.join(__dirname, 'views/dashboard.html'));
});

io.on('connection', function(socket) {
  if (socket.handshake.headers.host === config.host
  && socket.handshake.headers.referer.indexOf(config.host + config.dashboardEndpoint) > -1) {

    // if someone visits '/dashboard' send them the computed visitor data
    io.emit('updated-stats', computeStats());

  }

  // a user has visited our page - add them to the visitorsData object
  socket.on('visitor-data', function(data) {
    visitorsData[socket.id] = data;

    // compute and send visitor data to the dashboard when a new user visits our page
    io.emit('updated-stats', computeStats());
  });

  socket.on('disconnect', function() {
    // a user has left our page - remove them from the visitorsData object
    delete visitorsData[socket.id];

    // compute and send visitor data to the dashboard when a user leaves our page
    io.emit('updated-stats', computeStats());
  });
});

// wrapper function to compute the stats and return a object with the updated stats
function computeStats(){
  return {
    pages: computePageCounts(),
    referrers: computeRefererCounts(),
    activeUsers: getActiveUsers()
  };
}

// get the total number of users on each page of our site
function computePageCounts() {
  // sample data in pageCounts object:
  // { "/": 13, "/about": 5 }
  var pageCounts = {};
  for (var key in visitorsData) {
    var page = visitorsData[key].page;
    if (page in pageCounts) {
      pageCounts[page]++;
    } else {
      pageCounts[page] = 1;
    }
  }
  return pageCounts;
}

// get the total number of users per referring site
function computeRefererCounts() {
  // sample data in referrerCounts object:
  // { "http://twitter.com/": 3, "http://stackoverflow.com/": 6 }
  var referrerCounts = {};
  for (var key in visitorsData) {
    var referringSite = visitorsData[key].referringSite || '(direct)';
    if (referringSite in referrerCounts) {
      referrerCounts[referringSite]++;
    } else {
      referrerCounts[referringSite] = 1;
    }
  }
  return referrerCounts;
}

// get the total active users on our site
function getActiveUsers() {
  return Object.keys(visitorsData).length;
}

http.listen(app.get('port'), function() {
  console.log('listening on *:' + app.get('port'));
});
