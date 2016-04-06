// the countries.json file uses a special indentation
// this node module stringifies a Javascript object representation of the
// countries.json array in a way that reproduces this indentation
//
// Usage: fs.writeFile( 'countries.json', require('./stringifyCountry')( countries ) )

var assert = require('assert');

function _doEscape(m) {
	return "\\u" + ("0000" + m.charCodeAt(0).toString(16)).slice(-4);
}

function escapeChars( s ) {
	return s.replace( /[\u0080-\uFFFF]/g, _doEscape );
}

function addIndent( n, str ) {
	var indent = "	".repeat( n );
	var lines = str.split(/\r?\n/);
	for( var i = 0; i<lines.length;i++ ) {
		lines[i] = indent + lines[i];
	}
	return lines.join('\n');
}

function stringifyArray( arr ) {
	assert( Array.isArray( arr ) );
	var cStr = '[';
	for( var i=0; i<arr.length; i++ ) {
		cStr += ( i ? ', ' : '' ) + JSON.stringify( arr[ i ] );
	}
	cStr += ']';
	return cStr;
}

function stringifyTranslations( translations ) {
	var cStr = '{';
	var first = true, firstProp;
	var lang, prop;
	for( lang in translations ) {
		val = '{';
		firstProp = true;
		for( prop in translations[ lang ] ) {
			val += (firstProp ? '' : ', ' ) + '"' + prop + '": ' +
				JSON.stringify( translations[ lang ][ prop ] );
			firstProp = false;
		}
		val += '}';
		cStr += (first ? '\n' : ',\n' ) + '	"' + lang + '": ' +
			val;
		first = false;
	}

	cStr += '\n}';
	return cStr;
}

function stringifyCountry( c ) {
	var cStr = '{';
	var line;
	var first = true;
	var key;
	for( key in c ) {
		switch( key ) {
			case 'altSpellings':
			case 'borders':
			case 'callingCode':
			case 'currency':
			case 'latlng':
			case 'tld':
				line = '"' + key + '": ' + stringifyArray( c[key] );
				break;

				// line = '"' + key + '": ' + JSON.stringify( c[key] );
				// break;
			case 'translations':
				line = '"' + key + '": ' + stringifyTranslations( c[key] );
				break;
			default:
				line = '"' + key + '": ' + JSON.stringify( c[key], null, '	' );
		}
		cStr += (first ? '\n' : ',\n' ) + addIndent( 1, line );
		first = false;
	}
	cStr += '\n}';
	return addIndent( 1, cStr );
	return addIndent( 1, JSON.stringify( c,null, '	' ) );
}

function stringifyCountries( countries ) {
	var outputStr = "[";
	for( var i = 0 ; i < countries.length ; i++ ) {
		outputStr += ( i ? ',\n' : '\n' ) + stringifyCountry( countries[i] );
	}
	outputStr += "\n]\n";
	return escapeChars( outputStr );
}

module.exports = stringifyCountries;
