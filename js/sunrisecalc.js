/*
 * Copyright (c) 2020 Wilma Plus. All rights reserved.
 * @author developerfromjokela
 */

function getSunTime() {
    var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    if (timeZone in timezones) {
        var zoneDetails = timezones[timeZone];
        return SunCalc.getTimes(new Date(), zoneDetails['lat'], zoneDetails['long']);
    }
    return null;
}


function hasSunsetStarted() {
    var sunTime = getSunTime();
    if (sunTime == null)
        return false;
    return (new Date() > sunTime['sunsetStart']);
}