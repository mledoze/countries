<?php

declare(strict_types=1);

namespace MLD\Enum;

/**
 * List of all fields in the dataset
 */
enum Fields: string
{
    use EnumValues;

    case ALT_SPELLINGS = 'altSpellings';
    case AREA = 'area';
    case BORDERS = 'borders';
    case CALLING_CODES = 'callingCodes';
    case CAPITAL = 'capital';
    case CCA2 = 'cca2';
    case CCA3 = 'cca3';
    case CCN3 = 'ccn3';
    case CIOC = 'cioc';
    case CURRENCIES = 'currencies';
    case DEMONYMS = 'demonyms';
    case FLAG = 'flag';
    case IDD = 'idd';
    case INDEPENDENT = 'independent';
    case LANDLOCKED = 'landlocked';
    case LANGUAGES = 'languages';
    case LAT_LNG = 'latlng';
    case NAME = 'name';
    case REGION = 'region';
    case STATUS = 'status';
    case SUBREGION = 'subregion';
    case TLD = 'tld';
    case TRANSLATIONS = 'translations';
    case UN_MEMBER = 'unMember';

    // Subfields
    case NAME_NATIVE = 'native';
    case IDD_ROOT = 'root';
    case IDD_SUFFIXES = 'suffixes';

}