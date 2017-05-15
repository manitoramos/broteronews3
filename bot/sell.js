var admin = ''; // STEAM ID 64 OF YOUR MAIN ACCOUNT WHERE YOU WANT TO RECIEVE YOUR COMMISSION : GET IT AT HTTP://WWW.STEAMID.IO/

// CSGO.NETWORK - New information required

var botsteamid =''; // STEAM ID 64 OF YOUR BOT ACCOUNT : GET IT AT HTTP://WWW.STEAMID.IO/
var shared_secret =''; // SHARED SECRET CODE YOU CAN GET IT THROUGH : 2FA / STEAM DESKTOP AUTHENTICATOR ( BOTH OPTIONS ARE INCLUDED ) 
var identity_secret=''; // IDENTITY SECRET CODE YOU CAN GET IT THROUGH : 2FA / STEAM DESKTOP AUTHENTICATOR ( BOTH OPTIONS ARE INCLUDED )

// CSGO.NETWORK - New Libraries
var SteamTotp = require('steam-totp'); // CSGO.NETWORK - This library generates the key
var SteamConfirm = require('steamcommunity-mobile-confirmations');  // CSGO.NETWORK - This library accepts all outgoing trades = sends the winnings to the user in time
var pooling_interval  = 10000; // CSGO.NETWORK - This is how often it will check for outgoing trade confirmations - Current time: 10 seconds


var logOnOptions = {
	accountName: '', // BOT ACCOUNT LOGIN USERNAME
	password: '', // BOT ACCOUNT LOGIN PASSWORD
	twoFactorCode: SteamTotp.generateAuthCode(shared_secret) // CSGO.NETWORK - The code is generated here like it would be shown on your phone every time you log in
};
var GameTime = 120;


////

var authCode = '';  // CSGO.NETWORK - LEAVE THIS EMPTY OR IT MIGHT NOT WORK AT ALL!

// CSGO.NETWORK - I added this part - This creates the device ID of your ,,mobile device" - Requires a new library: crypto
var hash = require('crypto').createHash('sha1');
hash.update(Math.random().toString());
hash = hash.digest('hex');
var device_id = 'android:' + hash; // CSGO.NETWORK - This is the only part I'm concerned about, just because it says ,,RtR"

var globalSessionID;
if (require('fs').existsSync('sentry_'+logOnOptions['accountName']+'.hash')) {
	logOnOptions['shaSentryfile'] = require('fs').readFileSync('sentry_'+logOnOptions['accountName']+'.hash');
} else if(require('fs').existsSync('ssfn_'+logOnOptions['accountName'])) {
	var sha = require('crypto').createHash('sha1');
	sha.update(require('fs').readFileSync('ssfn_'+logOnOptions['accountName']));
	var sentry = new Buffer(sha.digest(), 'binary');
	logOnOptions['shaSentryfile'] = sentry;
	require('fs').writeFileSync('sentry_'+logOnOptions['accountName']+'.hash', sentry);
	console.log('Converting ssfn to sentry file!');
	console.log('Now you can remove ssfn_'+logOnOptions['accountName']);
} else if (authCode != '') {
	logOnOptions['authCode'] = authCode;
}

var sitename;

sitename = ".com"; // PUT YOUR SITE NAME HERE , PUT IT LIKE THIS STRUCTURE : YOURSITE.COM
var Steam = require('steam');
var SteamTradeOffers = require('steam-tradeoffers');
var mysql      = require('mysql');
var request = require("request");


var apik = ""; // GO ON THE BOTS ACCOUNT AND CREATE AN API KEY ( IT HAS TO BE THROUGH THE BOTS ACCOUNT )

var mysqlInfo;
mysqlInfo = {
  host     : 'localhost', // MYSQL , LEAVE IT AS LOCALHOST IF YOU RUN IT ON THE SAME SERVER AS THE WEBSITE AND DATABASE
  user     : '', // MYSQL USERNAME
  password : '', // MYSQL PASSWORD
  database : '', // MYSQL DATABASENAME
  charset  : 'utf8_general_ci'
};

var mysqlConnection = mysql.createConnection(mysqlInfo);

var steam = new Steam.SteamClient();
var offers = new SteamTradeOffers();

var recheck = true;

steam.logOn(logOnOptions);

steam.on('debug', function(text){
	console.log(text);
	require('fs').appendFile('debug.log', text+'\n');
});

function getUserName(steamid) {
	getUserInfo(steamid, function(error, data){
		if(error) throw error;
		var datadec = JSON.parse(JSON.stringify(data.response));
		return (datadec.players[0].personaname);
	});
}

function is_float(mixed_var) {

  return +mixed_var === mixed_var && (!isFinite(mixed_var) || !! (mixed_var % 1));
}


function proceedWinners() {
	var url = 'http://'+sitename+'/getwinner34634f.php';
	request(url, function(error, response, body){});
}

function getUserInfo(steamids,callback) {
	var url = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='+apik+'&steamids='+ steamids + '&format=json';
	request({
		url: url,
		json: true
	}, function(error, response, body){
		if(!error && response.statusCode === 200){
			callback(null, body);
		} else if (error) {
			getUserInfo(steamids,callback);
		}
	});
}

function addslashes(str) {
    str=str.replace(/\\/g,'\\\\');
    str=str.replace(/\'/g,'\\\'');
    str=str.replace(/\"/g,'\\"');
    str=str.replace(/\0/g,'\\0');
	return str;
}

var locked=false,proceeded;
var itemscopy;
var detected=false;
var detected2=false;
var endtimer = -1;
function weblogon() { // CSGO.NETWORK - I have completely modified this part, added: API Key to the offers.setup, which is why I think they should use the api from the bot
	steam.webLogOn(function(newCookie) {
		offers.setup({
			sessionID: globalSessionID,
			webCookie: newCookie,
			APIKey: apik
		}, function(err)
		{
			if(err)
			{
				console.log(err);
			}
			var steamapi=apik; // CSGO.NETWORK - This part accepts the outgoing trades so you can send the winnings to users
			var SteamcommunityMobileConfirmations = require('steamcommunity-mobile-confirmations');
			var steamcommunityMobileConfirmations = new SteamcommunityMobileConfirmations(
			{
				steamid:         botsteamid,
				identity_secret: identity_secret,
				device_id:       device_id, // Generated on the top of the script
				webCookie:       newCookie,
			});
			setInterval(function(){
				checkConfirmations(steamcommunityMobileConfirmations)
			}, pooling_interval);
			if (err)
			{
				
			}
		});
	});	
}

// CSGO.NETWORK - This part accepts outgoing trades = winnings sent out by the bot.
function checkConfirmations(steamcommunityMobileConfirmations){
    steamcommunityMobileConfirmations.FetchConfirmations((function (err, confirmations)
        {
            if (err)
            {
                console.log(err);
                return;
            }
			if(confirmations.length>0)
			{
				console.log('[SERVER] Received ' + confirmations.length + ' confirmations');
			}
            if ( ! confirmations.length)
            {
                return;
            }
            steamcommunityMobileConfirmations.AcceptConfirmation(confirmations[0], (function (err, result)
            {
                if (err)
                {
                    console.log(err);
                    return;
                }
                console.log('steamcommunityMobileConfirmations.AcceptConfirmation result: ' + result);
            }).bind(this));
        }).bind(this));
}

function sendoffers(){
	detected2 = false;
	offers.loadMyInventory({
		appId: 730,
		contextId: 2
	}, function(err, itemx) {
		if(err) {
			weblogon();
			setTimeout(sendoffers,2000);
			return;
		}
		if(detected2 == true) {
			return;
		}
		detected2 = true;
		itemscopy = itemx;
		detected = false;
		mysqlConnection.query('SELECT * FROM `queue` WHERE `status`=\'active\'', function(err, row, fields) {
			if(err) {
				return;
			}
			if(detected == true) {
				return;
			}
			detected = true;
			for(var i=0; i < row.length; i++) {
				var gameid = row[i].id;
				var sendItems = (row[i].items).split('/');
				var item=[],num=0;
				for (var x = 0; x < itemscopy.length; x++) {
					for(var j=0; j < sendItems.length; j++) {
						if (itemscopy[x].tradable && (itemscopy[x].market_name).indexOf(sendItems[j]) == 0) {
							sendItems[j] = "hgjhgnhgjgnjghjjghjghjghjhgjghjghjghngnty";
							itemscopy[x].market_name = "fgdfgdfgdfgdfgfswfewefewrfewrewrewr";
							item[num] = {
								appid: 730,
								contextid: 2,
								amount: itemscopy[x].amount,
								assetid: itemscopy[x].id
							}
							num++;
						}
					}
				}
				if (num > 0) {
					var gamenum = row[i].id;
					offers.makeOffer ({
						partnerSteamId: row[i].userid,
						itemsFromMe: item,
						accessToken: row[i].token,
						itemsFromThem: [],
						message: 'Congratulations! You won jackpot #'+gamenum
					}, function(err, response){
						if (err) {
							return;
						}
						mysqlConnection.query('UPDATE `queue` SET `status`=\'sent '+response+'\' WHERE `id`=\''+gameid+'\'', function(err, row, fields) {});
						console.log('Trade offer for queue '+gamenum+' sent!');	
					});
				}
			}
		});
})}

(function() {
  /**
   * Decimal adjustment of a number.
   *
   * @param {String}  type  The type of adjustment.
   * @param {Number}  value The number.
   * @param {Integer} exp   The exponent (the 10 logarithm of the adjustment base).
   * @returns {Number} The adjusted value.
   */
  function decimalAdjust(type, value, exp) {
    // If the exp is undefined or zero...
    if (typeof exp === 'undefined' || +exp === 0) {
      return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // If the value is not a number or the exp is not an integer...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
      return NaN;
    }
    // Shift
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
  }

  // Decimal round
  if (!Math.round10) {
    Math.round10 = function(value, exp) {
      return decimalAdjust('round', value, exp);
    };
  }
  // Decimal floor
  if (!Math.floor10) {
    Math.floor10 = function(value, exp) {
      return decimalAdjust('floor', value, exp);
    };
  }
  // Decimal ceil
  if (!Math.ceil10) {
    Math.ceil10 = function(value, exp) {
      return decimalAdjust('ceil', value, exp);
    };
  }
})();
function EndGame() {
	endtimer = -1;
	proceedWinners();
	setTimeout(sendoffers,1000);
}

steam.on('loggedOn', function(result) {
	console.log('Logged in!');
	steam.setPersonaState(Steam.EPersonaState.LookingToTrade);
	steam.addFriend(admin);
	steam.sendMessage(admin,"Welcome, 1.3.1 Jackpot - CSGO.Network");
});

steam.on('webSessionID', function(sessionID) {
	globalSessionID = sessionID;
	weblogon();
	setTimeout(function(){
		mysqlConnection.query('SELECT `value` FROM `info` WHERE `name`=\'current_game\'', function(err, rows, fields) {
			if(err) return;
			mysqlConnection.query('SELECT `starttime` FROM `games` WHERE `id`=\''+rows[0].value+'\'', function(errs, rowss, fieldss) {
				if(errs) return;
				var timeleft;
				if(rowss[0].starttime == 2147483647) timeleft = GameTime;
				else {
					var unixtime = Math.round(new Date().getTime()/1000.0);
					timeleft = rowss[0].starttime+GameTime-unixtime;
					if(timeleft < 0) timeleft = 0;
				}
				if(timeleft != GameTime) {
					setTimeout(EndGame,timeleft*1000);
					console.log('Restoring game on '+timeleft+'second');
				}
			});	
		});
	},1500);
});

steam.on('friendMsg', function(steamID, message, type) {
	if(type != Steam.EChatEntryType.ChatMsg) return;
	if(steamID == admin) {
		if(message.indexOf("/sendallitems") == 0) {
			offers.loadMyInventory({
				appId: 730,
				contextId: 2
			}, function(err, items) {
				if(err) {
					steam.sendMessage(steamID, 'Trying to send items');
					weblogon();
					return;
				}
				var item=[],num=0;
				for (var i = 0; i < items.length; i++) {
					if (items[i].tradable) {
						item[num] = {
							appid: 730,
							contextid: 2,
							amount: items[i].amount,
							assetid: items[i].id
						}
						num++;
					}
				}
				if (num > 0) {
					offers.makeOffer ({
						partnerSteamId: steamID,
						itemsFromMe: item,
						itemsFromThem: [],
						message: ''
					}, function(err, response){
						if (err) {
							throw err;
						}
						steam.sendMessage(steamID, 'Offer has been send with all items!');
					});
				}
			});
		} else if(message.indexOf("/send") == 0) {
			var params = message.split(' ');
			if(params.length == 1) return steam.sendMessage(steamID, 'Use /send itemname]');
			offers.loadMyInventory({
				appId: 730,
				contextId: 2
			}, function(err, items) {
				if(err) {
					steam.sendMessage(steamID, 'Could not load your inventory, try again');
					weblogon();
					return;
				}
				var item=0;
				for (var i = 0; i < items.length; i++) {
						if((items[i].market_name).indexOf(params[1]) != -1) { 
							item = items[i].id; 
							break;
						}
					}
				if (item != 0) {
					offers.makeOffer ({
						partnerSteamId: steamID,
						itemsFromMe: [
						{
							appid: 730,
							contextid: 2,
							amount: 1,
							assetid: item
						}
						],
						itemsFromThem: [],
						message: ''
					}, function(err, response){
						if (err) {
							throw err;
						}
						steam.sendMessage(steamID, 'Offer has been send!');
					});
				}
			});
		} else if(message.indexOf("/show") == 0) {
			var params = message.split(' ');
			offers.loadMyInventory({
				appId: 730,
				contextId: 2
			}, function(err, items) {
				if(err) {
					steam.sendMessage(steamID, 'Nothing to show');
					weblogon();
					return;
				}
				steam.sendMessage(steamID,'look: ');	
				for (var i = 0; i < items.length; i++) {
					steam.sendMessage(steamID,'http://steamcommunity.com/id/csgocyrexbot1/inventory/#'+items[i].appid+'_'+items[i].contextid+'_'+items[i].id);	
				}
			});
		} else if(message.indexOf("/end") == 0) {
			steam.sendMessage(steamID,'Game has been ENDED offers will be send to winner!');
			if(endtimer != -1) clearTimeout(endtimer);
			EndGame();
		} else if(message.indexOf("/code") == 0) { // CSGO.NETWORK - New command
			var code = SteamTotp.generateAuthCode(shared_secret);
			steam.sendMessage(steamID,'Your login code: ' +code+'');	
		} else if(message.indexOf("/so") == 0) {
			steam.sendMessage(steamID,'Outstanding Offers will be send now!');	
			sendoffers();
		}
	}
	getUserInfo(steamID, function(error, data){
		if(error) throw error;
		var datadec = JSON.parse(JSON.stringify(data.response));
		var name = datadec.players[0].personaname;
		console.log(name + ': ' + message); // Log it
	});
    //steam.sendMessage(steamID, 'I\'m a bot that accepts all your unwanted items.  If you would like to grab a few crates from me, please request a trade.');
});

function in_array(needle, haystack, strict) {
	var found = false, key, strict = !!strict;

	for (key in haystack) {
		if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
			found = true;
			break;
		}
	}

	return found;
}



function checkoffers(number) {
	if (number > 0) {
		offers.getOffers({
			get_received_offers: 1,
			active_only: 1,
			get_sent_offers: 0,
			get_descriptions: 1,
 time_historical_cutoff: Math.round(Date.now() / 1000),
			language: "en_us"
		}, function(error, body) {
			if(error) return;
			if(body.response.trade_offers_received){
				console.log('[SERVER] Trade offer incoming');
				body.response.trade_offers_received.forEach(function(offer) {
					if (offer.trade_offer_state == 2){
						if(offer.items_to_give) {
							console.log('Declining offer for because already send 2 offer');
							offers.declineOffer({tradeOfferId: offer.tradeofferid});
							return;
						}	
						if(offer.items_to_receive == undefined) return;				
						mysqlConnection.query('SELECT `value` FROM `info` WHERE `name`=\'maxitems\'', function(err, row, fields) {
							if(offer.items_to_receive.length > row[0].value) {
								offers.declineOffer({tradeOfferId: offer.tradeofferid});
								offer.items_to_receive = [];
								var unixtime = Math.round(new Date().getTime()/1000.0);
								mysqlConnection.query('INSERT INTO `messages` (`userid`,`msg`,`from`, `win`, `system`, `time`) VALUES (\''+offer.steamid_other+'\',\'too much items\',\'System\', \'0\', \'1\', \''+unixtime+'\')', function(err, row, fields) {});
								console.log('[SERVER] Declined offer #'+offer.tradeofferid+' - Sent by: '+offer.steamid_other+' - Reason: Sent too many skins');
								return;
							}
						});
						var delock = false;
						offers.loadPartnerInventory({partnerSteamId: offer.steamid_other, appId: 730, contextId: 2, tradeOfferId: offer.tradeofferid, language: "en"}, function(err, hitems) {
							if(err) {
								weblogon();
								recheck = true;
								return;
							}
							if(delock == true) return;
							delock = true;
							var items = offer.items_to_receive;
							var wgg=[],num=0;
							for (var i = 0; i < items.length; i++) {
								for(var j=0; j < hitems.length; j++) {
									if(items[i].assetid == hitems[j].id) {
										wgg[num] = hitems[j];
										num++;
										break;
									}
								}
							}
							var price=[];
							for(var i=0; i < num; i++) {
								if(wgg[i].appid != 730) {
									offers.declineOffer({tradeOfferId: offer.tradeofferid});
									var unixtime = Math.round(new Date().getTime()/1000.0);
									mysqlConnection.query('INSERT INTO `messages` (`userid`,`msg`,`from`, `win`, `system`, `time`) VALUES (\''+offer.steamid_other+'\',\'only csgo items\',\'System\', \'0\', \'1\', \''+unixtime+'\')', function(err, row, fields) {});
									console.log('[SERVER] Declined offer #'+offer.tradeofferid+' - Sent by: '+offer.steamid_other+' - Reason: User sent a non-CSGO item');
									return;
								}
								if(wgg[i].market_name.indexOf("Souvenir") != -1) {
									var unixtime = Math.round(new Date().getTime()/1000.0);
									offers.declineOffer({tradeOfferId: offer.tradeofferid});
									mysqlConnection.query('INSERT INTO `messages` (`userid`,`msg`,`from`, `win`, `system`, `time`) VALUES (\''+offer.steamid_other+'\',\'You can\'\t bet souvenir weapons\',\'System\', \'0\', \'1\', \''+unixtime+'\')', function(err, row, fields) {});
									console.log('[SERVER] Declined offer #'+offer.tradeofferid+' - Sent by: '+offer.steamid_other+' - Reason: User sent a souvenir skin');
									return;
								}
								var itemname = wgg[i].market_name;
								var url = 'http://'+sitename+'/cost.php?item='+encodeURIComponent(itemname);
								(function(someshit) {
								request(url, function(error, response, body){
									if(!error && response.statusCode === 200){
										var unixtime = Math.round(new Date().getTime()/1000.0);
										if(body == "notfound")
										{
											offers.declineOffer({tradeOfferId: offer.tradeofferid}); mysqlConnection.query('INSERT INTO `messages` (`userid`,`msg`,`from`, `win`, `system`, `time`) VALUES (\''+offer.steamid_other+'\',\'Item not available \',\'System\', \'0\', \'1\', \''+unixtime+'\')', function(err, row, fields) {}); 
											console.log('[SERVER] Declined offer #'+offer.tradeofferid+' - Sent by: '+offer.steamid_other+' - Reason: Can\'t get item price');
										}
										else {
											wgg[someshit].cost = parseFloat(body);
										}
									}
									else
									{
										console.log('[SERVER] Declined offer #'+offer.tradeofferid+' - Sent by: '+offer.steamid_other+' - Reason: Can\'t get item price');
										offers.declineOffer({tradeOfferId: offer.tradeofferid});
									}
								});})(i)
							}
							setTimeout(function() {
								var sum=0;
								for(var i=0; i < num; i++) {
									sum += wgg[i].cost;
								}
								mysqlConnection.query('SELECT `value` FROM `info` WHERE `name`=\'minbet\'', function(err, row, fields) {
									if(sum < row[0].value) { 
										num = 0;
										var unixtime = Math.round(new Date().getTime()/1000.0);
										offers.declineOffer({tradeOfferId: offer.tradeofferid});
										mysqlConnection.query('INSERT INTO `messages` (`userid`,`msg`,`from`, `win`, `system`, `time`) VALUES (\''+offer.steamid_other+'\',\'Value is too small.\',\'System\', \'0\', \'1\', \''+unixtime+'\')', function(err, row, fields) {});
										console.log('[SERVER] Declined offer #'+offer.tradeofferid+' - Sent by: '+offer.steamid_other+' - Reason: Doesn\'t reach the minimum value');
										return;
									}
								});
								
								var maxbet=0;
									mysqlConnection.query('SELECT `value` FROM `info` WHERE `name`=\'maxbet\'', function(err, row, fields) {
									maxbet=row[0].value;
									
									if(sum > row[0].value) { 
										num = 0;
										offers.declineOffer({tradeOfferId: offer.tradeofferid});
										mysqlConnection.query('INSERT INTO `messages` (`userid`,`msg`,`from`, `win`, `system`, `time`) VALUES (\''+offer.steamid_other+'\',\'Value is too high.\',\'System\', \'0\', \'1\', \''+unixtime+'\')', function(err, row, fields) {});
										console.log('[SERVER] Declined offer #'+offer.tradeofferid+' - Sent by: '+offer.steamid_other+' - Reason: Exceeds the maximum skin value');
										
										return;
									}
								});
								var ban;
								mysqlConnection.query('SELECT ban FROM `users` WHERE `steamid`=\''+offer.steamid_other+'\'', function(err, row, fields)
								{
									ban= row[0].ban;
									if(ban==1)
									{
										offers.declineOffer({tradeOfferId: offer.tradeofferid});
										offer.items_to_receive = [];
										mysqlConnection.query('INSERT INTO `messages` (`userid`,`msg`,`from`, `win`, `system`, `time`) VALUES (\''+offer.steamid_other+'\',\'You are banned.\',\'System\', \'0\', \'1\', \''+unixtime+'\')', function(err, row, fields) {});
										console.log('[SERVER] Declined offer #'+offer.tradeofferid+' - Sent by: '+offer.steamid_other+' - Reason: User is banned');
										
										return;
									}
								
								var maxritem=50;
								mysqlConnection.query('SELECT `value` FROM `info` WHERE `name`=\'maxritem\'', function(err, row, fields)
								{
									maxritem=row[0].value;
								});
								
								// CSGO.NETWORK 1342 - This part grabs the trade url of the person and gets their token because it is needed to get their escrow duration.
								var tradelink;
								mysqlConnection.query('SELECT tlink FROM `users` WHERE `steamid`=\''+offer.steamid_other+'\'', function(err, row, fields)
								{
									tradelink= row[0].tlink;
									if(!tradelink)
									{
										var unixtime = Math.round(new Date().getTime()/1000.0);
										offers.declineOffer({tradeOfferId: offer.tradeofferid});
										mysqlConnection.query('INSERT INTO `messages` (`userid`,`msg`,`from`, `win`, `system`, `time`) VALUES (\''+offer.steamid_other+'\',\'No Tradelink.\',\'System\', \'0\', \'1\', \''+unixtime+'\')', function(err, row, fields) {});
										console.log('[SERVER] Declined offer #'+offer.tradeofferid+' - Sent by: '+offer.steamid_other+' - Reason: User doesn\'t have a Trade URL set')
										return;
									}
									var token = tradelink.slice(-8);
									
									offers.getHoldDuration({partnerSteamId: offer.steamid_other, accessToken: token}, function(err, response) // With the steam ID and token it will get the escrow duration
									{
										if (err)
										{
											console.log('[SERVER] Declined offer #'+offer.tradeofferid+' - Sent by: '+offer.steamid_other+' - Reason: Can\'t get hold duration, possible Steam server error')
											var unixtime = Math.round(new Date().getTime()/1000.0);
											console.log(err);
											offers.declineOffer({tradeOfferId: offer.tradeofferid});
											mysqlConnection.query('INSERT INTO `messages` (`userid`,`msg`,`from`, `win`, `system`, `time`) VALUES (\''+offer.steamid_other+'\',\'Steam Server error.\',\'System\', \'0\', \'1\', \''+unixtime+'\')', function(err, row, fields) {});
											return;
										}
										if(response.their==0)
										{
											mysqlConnection.query('SELECT `value` FROM `info` WHERE `name`=\'current_game\'', function(err, row, fields) 
											{
												var current_game = (row[0].value);
												
											mysqlConnection.query('SELECT COUNT(value) as citems FROM `game'+current_game+'` WHERE `userid`=\''+offer.steamid_other+'\'', function(err, row, fields)
											{
												
													citems = row[0].citems;
												
													citems=citems+offer.items_to_receive.length;
													
													
													
													
													mysqlConnection.query('SELECT `value` FROM `info` WHERE `name`=\'maxitems\'', function(err, row, fields)
													{
														var mi=row[0].value;
														if(citems > mi)
														{
															offers.declineOffer({tradeOfferId: offer.tradeofferid});
															offer.items_to_receive = [];
															mysqlConnection.query('INSERT INTO `messages` (`userid`,`msg`,`from`, `win`, `system`, `time`) VALUES (\''+offer.steamid_other+'\',\'You\'ve sent too many skins.\',\'System\', \'0\', \'1\', \''+unixtime+'\')', function(err, row, fields) {});
															console.log('[SERVER] Declined offer #'+offer.tradeofferid+' - Sent by: '+offer.steamid_other+' - Reason: Sent too many skins (Double Check)');
															return;
														}
														
													});
													mysqlConnection.query('SELECT SUM(value) as cmoney FROM `game'+current_game+'` WHERE `userid`=\''+offer.steamid_other+'\'', function(err, row, fields)
													{
													
														cmoney = row[0].cmoney;
														cmoney=cmoney+sum;
	
														if(cmoney > maxbet)
														{
															offers.declineOffer({tradeOfferId: offer.tradeofferid});
															offer.items_to_receive = [];
															mysqlConnection.query('INSERT INTO `messages` (`userid`,`msg`,`from`, `win`, `system`, `time`) VALUES (\''+offer.steamid_other+'\',\'Value is too high.\',\'System\', \'0\', \'1\', \''+unixtime+'\')', function(err, row, fields) {});
															console.log('[SERVER] Declined offer #'+offer.tradeofferid+' - Sent by: '+offer.steamid_other+' - Reason: Exceeds the maximum value (Double Check)');
															return;
														}
													for(var k=0; k < num; k++)
													{
														if(!is_float(wgg[k].cost))
														
														{
															offers.declineOffer({tradeOfferId: offer.tradeofferid});
															mysqlConnection.query('INSERT INTO `messages` (`userid`,`msg`,`from`, `win`, `system`, `time`) VALUES (\''+offer.steamid_other+'\',\'Can\'t get item price.\',\'System\', \'0\', \'1\', \''+unixtime+'\')', function(err, row, fields) {});
															console.log('[SERVER] Declined offer #'+offer.tradeofferid+' - Sent by: '+offer.steamid_other+' - Reason: Can\'t get item price (Double Check)');
															return;
														}
													}
											
											
												 getUserInfo(offer.steamid_other, function(error, data){
                                                                                                        if(error) throw error;
                                                                                                        var datadec = JSON.parse(JSON.stringify(data.response));
                                                                                                        var name = addslashes(datadec.players[0].personaname);
                                                                                                        var avatar = (datadec.players[0].avatarfull);
                                                                                                        if(num == 0) return;
                                                                                                        offers.acceptOffer({tradeOfferId: offer.tradeofferid}, function(err, response) {
                                                                                                                if(err != null) return;
                                                                                                                mysqlConnection.query('SELECT `value` FROM `info` WHERE `name`=\'current_game\'', function(err, row, fields) {
                                                                                                                        var current_game = (row[0].value);
                                                                                                                        mysqlConnection.query('SELECT `cost`,`itemsnum` FROM `games` WHERE `id`=\''+current_game+'\'', function(err, row, fields) {
                                                                                                                                var current_bank = parseFloat(row[0].cost);
                                                                                                                                var itemsnum = row[0].itemsnum;
                                                                                               
                                                                                                                                for(var j=0; j < num; j++) {
																																		var itemn = addslashes(wgg[j].market_name);
                                                                                                                                        mysqlConnection.query('INSERT INTO `game' + current_game + '` (`userid`,`username`,`item`,`color`,`value`,`avatar`,`image`,`from`,`to`) VALUES (\'' + offer.steamid_other + '\',\'' + name + '\',\'' + itemn + '\',\'' + wgg[j].name_color + '\',\'' + wgg[j].cost + '\',\'' + avatar + '\',\'' + wgg[j].icon_url + '\',\''+current_bank+'\'+\'0\',\''+current_bank+'\'+\''+wgg[j].cost+'\')', function(err, row, fields) {});
                                                                                                                                        mysqlConnection.query('UPDATE `games` SET `itemsnum`=`itemsnum`+1, `cost`=`cost`+\''+wgg[j].cost+'\' WHERE `id` = \'' + current_game + '\'', function(err, row, fields) {});
                                                                                                                                        current_bank = parseFloat(current_bank + wgg[j].cost);
                                                                                                                                        itemsnum++;
                                                                                                                                }
                                                                                                                               
                                                                                                                                mysqlConnection.query('SELECT COUNT(DISTINCT userid) AS playersCount FROM `game' + current_game, function(err, rows){  
                                                                                                                                someVar = rows[0].playersCount;
                                                                                                                                console.log('Current Players: ' +someVar);
                                                                                                                                if(someVar == 2 && items.length > 0 && endtimer==-1) {
                                                                                                                                        console.log('Found 2 Players');
                                                                                                                                        endtimer = setTimeout(EndGame,GameTime*1000);
                                                                                                                                        mysqlConnection.query('UPDATE `games` SET `starttime`=UNIX_TIMESTAMP() WHERE `id` = \'' + current_game + '\'', function(err, row, fields) {});
                                                                                                                                }
                                                                                                                                });
																																if(itemsnum > maxritem)
																																{
                                                                                                                                        clearTimeout(endtimer);
                                                                                                                                        endtimer = -1;
                                                                                                                                        EndGame();
                                                                                                                                }
                                                                                                                                console.log('Accepted trade offer #'+offer.tradeofferid+' by '+name+' ('+offer.steamid_other+')');
                                                                                                                        });
                                                                                                                });
                                                                                                        });
                                                                                                });
																							});
																						});
																					});
										}
										else
										{
											console.log('[SERVER] Declined offer #'+offer.tradeofferid+' - Reason: User is in escrow')
											var unixtime = Math.round(new Date().getTime()/1000.0);
											offers.declineOffer({tradeOfferId: offer.tradeofferid});
											mysqlConnection.query('INSERT INTO `messages` (`userid`,`msg`,`from`, `win`, `system`, `time`) VALUES (\''+offer.steamid_other+'\',\'You are in escrow!\',\'System\', \'0\', \'1\', \''+unixtime+'\')', function(err, row, fields) {});
											return;	
										}
									});
								});
								});
								},3000);
						});
					}
				});
			}
		});
	}
}

var pew;
steam.on('tradeOffers', checkoffers);

steam.on('sentry', function(data) {
	require('fs').writeFileSync('sentry_'+logOnOptions['accountName']+'.hash', data);
});

setInterval(function () {
	mysqlConnection.query('SELECT 1');
}, 5000);
//COPYRIGHT CSGO.NETWORK 2016