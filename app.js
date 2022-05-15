if(localStorage.when != null
    && parseInt(localStorage.when) + 10000 > Date.now()) {
    let freshness = Math.round((Date.now() - localStorage.when)/1000) + " second(s)";
    document.getElementById("myWeather").innerHTML = localStorage.myWeather;
    document.getElementById("myTemperature").innerHTML = localStorage.myTemperature;
    document.getElementById("myLastUpdated").innerHTML = freshness;
    // No local cache, access network
    } else {
    // Fetch weather data from API for given city
    fetch('http://api.openweathermap.org/data/2.5/weather?lat=52.4862&lon=-1.8904&appid=1bfcb9d1b1beb70f9960eeb0caf20cce')
    // Convert response string to json object
    .then(response => response.json())
    .then(response => {
        console.log(response);
    // Copy one element of response to our HTML paragraph
    document.getElementById("myWeather").innerHTML = response.weather[0].main;
    document.getElementById("myTemperature").innerHTML = response.main.temp;
    document.getElementById("myLastUpdated").innerHTML = response.weather_when;
    // Save new data to browser, with new timestamp
    localStorage.myWeather = response.weather[0].main;
    localStorage.myTemperature = response.main.temp + '°';
    localStorage.when = Date.now(); // milliseconds since now
    })
    .catch(err => {
    // Display errors in console
    console.log(err);
    
    });
    }