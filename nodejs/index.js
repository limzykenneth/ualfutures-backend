require('dotenv').config();
const _ = require("underscore");
const request = require('request');
const argv = require('minimist')(process.argv.slice(2));

const eventbriteKey = process.env.eventbrite_key;
const inputURL = argv.url;

const ebIDRegex = /tickets-(\d*?)(?:\?|$)/;
const ebID = ebIDRegex.exec(inputURL)[1];

let venueURL = ``;
let dataURL = `https://www.eventbriteapi.com/v3/events/${ebID}/?token=${eventbriteKey}`;

request(dataURL, function (error, response, body) {
  	if (!error && response.statusCode == 200) {
  		let data = JSON.parse(body);
  		var ebData = {};
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

		  		console.log(JSON.stringify(ebData));
			}
		});
  	}
});

// const venueURL = `https://www.eventbriteapi.com/v3/venues/${ebVenueID}/?token=${eventbriteKey}`;