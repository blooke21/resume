<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" , minimum-scale="1" />
    <title>Blake Warnock</title>
    <meta name="description" content="description" />
    <meta name="author" content="author" />
    <meta name="keywords" content="keywords" />
    <link rel="stylesheet" href="./style.css" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="./global.js"></script>
</head>

<body>
    <div class="spotlight"></div>
    <div class="space"></div>
    <div class="wave-container">
        <div class="ocean">
            <div class="wave"></div>
            <div class="wave"></div>
        </div>
    </div>
    <div class="replay-btn"><button id="replay">Replay Animations</button></div>
    <input hidden="hidden" id="firstTime" />

    <div class="title-container">
        <div class="box-container">
            <div class="inside-box"></div>
            <div class="box">
                <div class="box-content">
                    <div class="box-img"><img id="me" src="images/res-me4.jpg" alt="portrait of Blake Warnock"></div>
                    <div class="box-text">
                        <h2 class="box-text-title2">WELCOME TO MY PORTFOLIO!</h2>
                        <h1 class="box-text-title">My name is Blake Warnock</h1>
                        <span class="blue-line" id="box-text-span"></span>
                        <p class="box-text-one">This is some filler text that I am typing in
                            because I am too lazy to
                            actually come up with
                            meaningful information to put here</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="learn-container">
        <h2>Learn more about me as..</h2>
        <span class="white-line"></span>
    </div>
    <div class="bobble-container">

        <a href="personal.php" class="bobble" id="bobbleTwo">
            <div class="inside-bobble">
                <h1>A Person</h1>
                <p>This is where I brag about how cool I am</p>
            </div>
        </a>
        <a href="developer.php" class="bobble" id="bobbleOne">
            <div class="inside-bobble">
                <h1>A Developer</h1>
                <p>This is where I showcase some of my more recent projects</p>
            </div>
        </a>
    </div>
    <a href="RC.php" class="bobble" id="bobbleThree">
        <div class="inside-bobble">
            <h1>Resume and Contact information</h1>
        </div>
    </a>
</body>

</html>