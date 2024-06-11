<?php


//api request information
$url = 'https://kohlerpubliclibrary.events.mylibrary.digital/api/1.0/authorization';
$headers = [
    'Content-Type: application/json',
    'Cookie: PHPSESSID=67he5r63o0k1u6ctf9sc5mh13a',
];
$data = [
    'secretKey' => 'e51b3d6c007bde940fdd3d33b554b6ed',
];

//api request to get bearer token, this will be used in future calls as authorization
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//grabs response from api
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

//trims reponse to only grab bearer token
$positionStart = (strpos($response, 'token') + 8);
$token = substr($response, $positionStart, ((strpos($response, 'expires') - 3) - $positionStart));


curl_close($ch);

// Handle the response
if ($httpCode == 200) {
    // if Bearer token successfully retreieved make api request to grab the four upcoming events
    $eventUrl = 'https://kohlerpubliclibrary.events.mylibrary.digital/api/1.0/event/query?limit=4';
    $headers2 = [
        'Authorization: ' . $token,
        'Cookie: PHPSESSID=67he5r63o0k1u6ctf9sc5mh13a',
    ];


    $ch = curl_init($eventUrl);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers2);

    $response2 = curl_exec($ch);
    $httpCode2 = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    // Handle the response
    if ($httpCode2 == 200) {
        //trims response to only contain the usable data
        $trimmedResponse = substr($response2, ((strpos($response2, '"event_list":[') + 14)));
        //puts data into an array
        //converts string to array
        $eventArray = explode('{"event_id"', $trimmedResponse);
        //removes first and last index due to them being empty
        array_shift($eventArray);

        //takes array of events and seperate each on into it's own array and stores it inside $formatedResponse
        $condensedResponse = array_map(function ($event) {
            $temp = explode(',', $event);
            return ($temp);
        }, $eventArray);





        //takes each of the individual arrays and splits it into key and value
        //[0] => data title
        //[1] => data value
        foreach (array_values($condensedResponse) as $e) { //cycles through each condesed event array

            //adds uid as a key name for each of the events id
            $e[0] = "uid" . $e[0];
            // print_r($e);
            // echo "<br><br>";

            //if you see this look away for the shame I bear should be mine along
            if (substr($e[11], 0, 8) == '{"name":') {
                $e[11] = "series_name:" . substr($e[11], 8);
            }

            $indEvent = array_map(function ($x) { //cycles through each element in the condensed event array name, url, image...

                // print_r($x);
                // echo "<br><br>";

                //removes special characeters excpet ":" for it will be used to seperate each entity of data
                $removeQuotation = str_replace(array('"', "}", "{", "[", "]"), "", $x);
                $temp = stripslashes($removeQuotation);
                $output = explode(":", $temp);
                //since the string is exploded on : this causes url to become an array with a length of three - 
                //this if removes the middle index so only url and the actual url remains the removed https is added later
                if (count($output) == 3) {
                    array_splice($output, 1, 1);
                }

                // print_r($output[0]);
                // echo "<br><br>";

                //displays name, time, and urls inside eventContainer for rendering
                if ($output[0] == "uid") {
                    //creates elements container
                    echo "<div class='eventContainer'>";
                    //creates glass container for everything besides the img
                    echo "<div class='infoContainer' id='$output[1]' onClick='redirect($output[1])'>";
                } else if ($output[0] == "name") {

                    echo "<h1>$output[1]</h1>";
                } else if ($output[0] == "start_time") {
                    //formats time from unix to standard time zone
                    $start = date("F j, Y, g:i a", $output[1]);
                    echo "<p class='eventTime'>" . $start . " - ";
                } else if ($output[0] == "end_time") {
                    //formats time
                    $end = date("F j, Y, g:i a", $output[1]);
                    //removes day and month so it only shows the actual time. This is done to make events go dd/mm/start_time - end_time
                    echo substr($end, (strlen($end) - 8)) . "</p>";
                } else if ($output[0] == "url") {
                    //displays url as button so users can learn more
                    echo "<p>Click Here to Learn More</p>";
                    echo "<input type='hidden' id='{$output[1]}'>";
                    echo "</div>";
                } else if ($output[0] == "image_url_banner") {
                    //background img
                    echo "<img src='{$output[1]}' />";
                    echo "</div>";
                }
            }, array_values($e));
        }
        // echo "<br>Response: <p>" . $response2 . "</p>";
    } else {
        // Handle the error for grabbing events
        echo "Error: HTTP Code - " . $httpCode2 . ", Response: " . $response;
    }
} else {
    // Handle the error for grabbing the bearer token
    echo "Error: HTTP Code - " . $httpCode . ", Response: " . $response;
}
?>
<style>
    .eventContainer {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        align-items: center;
        font-family: 'Lato', sans-serif;
        transition-duration: .75s;
        margin-bottom: 1em;
        margin-left: -2em;
        margin-right: -2em;
    }

    .eventContainer>h1 {
        display: none;
    }

    .infoContainer {
        color: black;
        padding-left: 1em;
        padding-right: 1em;
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
        flex-wrap: wrap;
        flex-direction: column;
        box-shadow: 2px 1px 5px 0px rgba(0, 0, 0, 0.75);
        -webkit-box-shadow: 2px 1px 5px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 2px 1px 5px 0px rgba(0, 0, 0, );
        background: rgba(255, 255, 255, 0.38);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(50px);
        -webkit-backdrop-filter: blur(5.5px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition-duration: .75s;
    }

    .infoContainer h1 {
        margin-top: 0.25em;
        margin-bottom: 0.25em;
        font-size: 1em
    }

    .infoContainer p {
        margin-top: 0;
        margin-bottom: .5em;
        font-size: 1.2rem;
    }

    .eventTime {
        font-weight: 600;
    }

    .eventContainer img {
        border-radius: 1em;
        box-shadow: 2px 1px 5px 0px rgba(0, 0, 0, 0.75);
        -webkit-box-shadow: 2px 1px 5px 0px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 2px 1px 5px 0px rgba(0, 0, 0, 0.75);
    }

    .eventContainer:hover .infoContainer {
        transform: scale(1.05);
    }

    .infoContainer:hover {
        cursor: pointer;
    }

    .eventContainer:hover .eventContainer img {
        box-shadow: 2px 1px 5px 2px rgba(0, 0, 0, 0.75);
        -webkit-box-shadow: 2px 1px 5px 2px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 2px 1px 5px 2px rgba(0, 0, 0, 0.75);
    }

    @media only screen and (max-width: 600px) {
        .eventContainer {
            margin-left: unset;
            margin-right: unset;
        }

        .infoContainer h1 {
            font-size: .75em;
        }

        .infoContainer p {
            font-size: .7rem;
        }
    }

    @media only screen and (max-width: 321px) {
        .infoContainer h1 {
            font-size: .5em;
        }

        .infoContainer p {
            font-size: .5rem;
        }
    }
</style>
<script>
    function redirect(name) {
        parent = document.getElementById(name);
        children = parent.children[3];
        console.log(children.id);
        window.location.href = "http:" + children.id + ".com";
    }
</script>