<?php
/**
* sources:
* http://en.wikipedia.org/wiki/Tz_database
* ftp://ftp.iana.org/tz/releases
* @semsono
*/

(new TZUpdater());

class TZUpdater {

    protected $tzData;
    protected $zoneTabPublicPath   = 'ftp://ftp.iana.org/tz/tzdata-latest.tar.gz';
    protected $zoneTabFolder       = 'tz-temp';
    protected $zoneTabPath         = 'tz-temp/zone.tab';
    protected $countriesFile       = 'countries.json';
    protected $countriesFileResult = 'countries.json';

    function __construct()
    {
        $this->updateCountries();
    }
    function updateCountries()
    {
        $this->downloadTzData();
        $this->parseTzFile();
        $this->updateCountriesFile();
        $this->clearTzData();
    }
    function updateCountriesFile()
    {
        if (empty($this->tzData)) {
            throw new Exception('TZ Data not found.');
        }
        $ttlTzRec = $ttlNew = $ttlOld = 0;
        $data = json_decode(file_get_contents($this->countriesFile), 1);
        foreach ($data as $k => $country) {
            if (!empty($this->tzData[$country['cca2']])) {

                $oldData = empty($data[$k]['tz']) ? [] : $data[$k]['tz'];
                $newData = $this->tzData[$country['cca2']];
                $removes = array_diff($oldData, $newData);
                $inserts = array_diff($newData, $oldData);
                $ttlTzRec += count($this->tzData[$country['cca2']]);

                if (count($inserts) || count($removes)) {
                    $ttlNew += count($inserts);
                    $ttlOld += count($removes);
                    echo $country['name']['common'];
                    if (count($inserts))
                        echo ' +' . count($inserts);
                    if (count($removes))
                        echo ' -' . count($removes);
                    echo "\n";
                    $data[$k]['tz'] = $this->tzData[$country['cca2']];
                }
            }
        }
        echo "\nParsed $ttlTzRec tz records; +added:$ttlNew -removed:$ttlOld \n";
        file_put_contents($this->countriesFileResult, json_encode($data, JSON_PRETTY_PRINT));
    }
    function parseTzFile()
    {
        $this->tzData = [];
        $data = file_get_contents($this->zoneTabPath);
        preg_match_all("/(.*)\n/", $data, $match);
        foreach ($match[0] as $key => $strData) {
            preg_match('/[A-Z]{2}/', $strData, $tzCountry);
            if (!empty($tzCountry)) {
                preg_match('/[-_a-zA-Z]+\/[-_a-zA-Z]+(\/[-_a-zA-Z]+)?/', $strData, $tzString);
                if (empty($tzCountry[0]) || empty($tzString[0])
                    || !date_default_timezone_set($tzString[0])
                ) {
                    continue;
                }
                if (empty($this->tzData[$tzCountry[0]])) {
                    $this->tzData[$tzCountry[0]] = [];
                }
                $this->tzData[$tzCountry[0]][] = $tzString[0];
            }
        }
    }
    function clearTzData()
    {
        shell_exec("rm -rf {$this->zoneTabFolder}");
    }
    function downloadTzData()
    {
        shell_exec(
            "mkdir {$this->zoneTabFolder}"
            . "&& cd {$this->zoneTabFolder}"
            . "&& wget --retr-symlinks '{$this->zoneTabPublicPath}'"
            . "&& gzip -dc tzdata-latest.tar.gz | tar -xf -"
        );
    }
}
