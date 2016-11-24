require('dotenv').config();
const express = require('express');
let app = express();
const request = require('request');
const _ = require("underscore");

const eventbriteKey = process.env.eventbrite_key;
const ebIDRegex = /tickets-(\d*?)(?:\?|$)/;

app.get('/eb', function (req, res) {
	let url = req.get("url");
	const ebID = ebIDRegex.exec(url)[1];

	let venueURL = ``;
	let dataURL = `https://www.eventbriteapi.com/v3/events/${ebID}/?token=${eventbriteKey}`;

	let ebData = {};
	request(dataURL, function (error, response, body) {
	  	if (!error && response.statusCode == 200) {
	  		let data = JSON.parse(body);
			ebData.name = data.name.text;
			ebData.description = data.description.html;
			ebData.startTime = data.start.local;
			ebData.endTime = data.end.local;

			var ebVenueID = data.venue_id;

			venueURL = `https://www.eventbriteapi.com/v3/venues/${ebVenueID}/?token=${eventbriteKey}`;

			request(venueURL, function (error, response, body) {
				if (!error && response.statusCode == 200) {
					let data = JSON.parse(body);
					let multilineAddress = data.address.localized_multi_line_address_display;

			  		let address = "";
			  		_.each(multilineAddress, function(el, i){
			  			address += el;

			  			if(i !== multilineAddress.length - 1){
			  				address += "<br>";
			  			}
			  		});

			  		ebData.address = address;
				}
			});
	  	}

	  	res.send(ebData);
	});
});

app.listen(8081, "localhost", function () {
	console.log('Example app listening on port 3000!');
});