$(document).ready(function () {
  /* TODO
    replace all instance where inside-boxes width and height are variables that are related to box-container
    https://www.youtube.com/watch?v=P_JOdsm_8tY add this effect to lower boxes
    */

  function randomNumber(num) {
    return Math.floor(Math.random() * num);
  }

  //will add cookie check to see if it is users first time
  //if users first time play spotlight animation and delay all other start-up animations by 1s
  const firstTime = true;
  const insideBoxDelay = 1;
  //used to control bobbles delay timing
  const boxGrowTime = 0.25;

  var windowWidth = $(window).width();
  console.log("Window Width: " + windowWidth);

  if (firstTime) {
    //adds extra delay for spotlight animation
    insideBoxDelay += 4.5;
    boxGrowTime += 4.5;
    //moves spotlight around
    //two different animation depending on screen width
    if (windowWidth >= 500) {
      $(".spotlight")
        .animate(
          { "background-position-x": "-20em", "background-position-y": "5em" },
          800
        )
        .promise()
        .done(
          $(".spotlight").delay(200).animate(
            {
              "background-position-x": "10em",
              "background-position-y": "5em",
            },
            500
          )
        )
        .promise()
        .done(
          $(".spotlight").delay(200).animate(
            {
              "background-position-x": "-20em",
              "background-position-y": "-5em",
            },
            300
          )
        )
        .promise()
        .done(
          $(".spotlight").delay(200).animate(
            {
              "background-position-x": "30em",
              "background-position-y": "-9em",
            },
            800
          )
        )
        .promise()
        .done(
          $(".spotlight").delay(200).animate(
            {
              "background-position-x": "-10em",
              "background-position-y": "-9em",
            },
            800
          )
        )
        .promise()
        .done(
          $(".spotlight").animate(
            {
              "background-position-x": "0em",
              "background-position-y": "-10em",
            },
            200
          )
        )
        .promise()
        .done($(".spotlight").delay(200).animate({ opacity: "0" }, 500));
    } else {
      $(".spotlight")
        .animate(
          { "background-position-x": "3em", "background-position-y": "10em" },
          800
        )
        .promise()
        .done(
          $(".spotlight").delay(200).animate(
            {
              "background-position-x": "-3em",
              "background-position-y": "-12em",
            },
            500
          )
        )
        .promise()
        .done(
          $(".spotlight").delay(200).animate(
            {
              "background-position-x": "3em",
              "background-position-y": "1em",
            },
            300
          )
        )
        .promise()
        .done(
          $(".spotlight").delay(200).animate(
            {
              "background-position-x": "7em",
              "background-position-y": "-7em",
            },
            800
          )
        )
        .promise()
        .done(
          $(".spotlight").delay(200).animate(
            {
              "background-position-x": "-8em",
              "background-position-y": "-10em",
            },
            800
          )
        )
        .promise()
        .done(
          $(".spotlight").animate(
            {
              "background-position-x": "0em",
              "background-position-y": "-10em",
            },
            200
          )
        )
        .promise()
        .done($(".spotlight").delay(200).animate({ opacity: "0" }, 500));
    }
  } else {
    //if it isn't the users first time on the page do not play spotlight animation
    $(".spotlight").css({ display: "none" });
  }

  $(".inside-box")
    .css({
      animation:
        "removeInsideBox 1s " + insideBoxDelay + "s ease-in-out forwards",
    })
    .promise()
    .done(
      //since spotlight has a z index greater than ever other element this shrinks it so the future hover functions work
      $(".spotlight").delay(200).animate({ height: "0" }, 10)
    );
  $("#bobbleOne").css({
    animation: "growBox 1s " + boxGrowTime + "s ease-in-out forwards",
  });
  $("#bobbleTwo").css({
    animation: "growBox 1s " + (boxGrowTime + 0.35) + "s ease-in-out forwards",
  });
  $("#bobbleThree").css({
    animation: "growBox 1s " + (boxGrowTime + 0.15) + "s ease-in-out forwards",
  });
  $("#bobbleOne .inside-bobble").css({
    animation: "text-slide 1s " + (boxGrowTime + 1) + "s ease-in-out forwards",
  });
  $("#bobbleTwo .inside-bobble").css({
    animation:
      "text-slide 1s " + (boxGrowTime + 1.35) + "s ease-in-out forwards",
  });
  $("#bobbleThree .inside-bobble").css({
    animation:
      "text-slide 1s " + (boxGrowTime + 1.15) + "s ease-in-out forwards",
  });

  //sets boxPadding equal to box-container for inside-box animation
  const boxPadding = $(".box-container").css("padding");
  const boxPaddingNegative = "-" + $(".box-container").css("padding");
  //removes the 'px' from boxPadding for calculation of inside-box animation
  const boxPaddingNum = boxPadding.slice(0, -2);

  $(".box-container").each(function () {
    //loads inside-box to random corner
    // var ranLocation = randomNumber(4);
    var ranLocation = 1;
    console.log("randomLocation: " + ranLocation);
    //grabs width & height of box-container and subtracts inside-box & border so hover animate sets inside-box to correct location
    var width =
      $(this).width() -
      $(this).find(".inside-box").width() +
      parseInt(boxPaddingNum);
    var height =
      $(this).height() -
      $(this).find(".inside-box").height() +
      parseInt(boxPaddingNum);
    console.log("width: " + width + "\nheight: " + height);

    // 0 = box will be on top-left
    // 1 = box will be on top-right
    // 2 = bottom-right
    // 3 = bottom-left
    if (ranLocation == 1) {
      $(this).find(".inside-box").css("margin-left", width);
      console.log("top-right");
    } else if (ranLocation == 2) {
      $(this).find(".inside-box").css("margin-top", height);
      $(this).find(".inside-box").css("margin-left", width);
      console.log("bottom-left");
    } else if (ranLocation == 3) {
      $(this).find(".inside-box").css("margin-top", height);
      console.log("bottom-right");
    } else {
      console.log("top-left");
    }

    $(".box-container").hover(
      function () {
        console.log("ranLocation: " + ranLocation);
        switch (ranLocation) {
          case 0: //moves inside-box left to right along the top of box-container
            //stretches inside-box to double is width and shrinks is height to the height of the border for animation
            $(this)
              .find(".inside-box")
              .css({ width: "100px", height: boxPadding });
            var tempWidth = width - 50;
            $(this)
              .find(".inside-box")
              .animate({ marginLeft: tempWidth }, 800)
              //returns inside-box to normal size
              .promise()
              .done(
                $(this)
                  .find(".inside-box")
                  .animate({ width: "50px", marginLeft: width }, 100)
              )
              .promise()
              .done(
                $(this).find(".inside-box").animate({ height: "50px" }, 100)
              );
            ranLocation = 1;
            break;

          case 1: //moves inside-box top to bottom along the right side of box-container
            //stretches height and moves inside-box over so the only width showing is the same as the border width
            $(this)
              .find(".inside-box")
              .css({
                "margin-left": $(this).width(),
                height: "100px",
                width: boxPadding,
              });

            $(this)
              .find(".inside-box")
              .animate({ marginTop: height }, 800)
              //returns inside-box to normal size
              .promise()
              .done(
                $(this).find(".inside-box").animate({ width: "100px" }, 100)
              )
              .promise()
              .done(
                $(this)
                  .find(".inside-box")
                  .animate({ "margin-left": width }, 100)
              );
            $(this).find(".inside-box").css({ height: "50px" });
            ranLocation = 2;
            break;

          case 2: //moves inside-box right to left along the bottom of box-container
            //stretches inside-box to double is width and shrinks is height to the height of the border for animation
            $(this)
              .find(".inside-box")
              .css({
                width: "100px",
                height: boxPadding,
                marginTop: $(this).height(),
              });

            $(this)
              .find(".inside-box")
              .animate({ marginLeft: boxPaddingNegative }, 800)
              //returns inside-box to normal size
              .promise()
              .done($(this).find(".inside-box").animate({ height: "50px" }, 75))
              .promise()
              .done($(this).find(".inside-box").animate({ width: "50px" }, 75))
              .promise()
              .done(
                $(this)
                  .find(".inside-box")
                  .animate({ "margin-top": height }, 75)
              );

            ranLocation = 3;
            break;

          case 3: //moves inside-box bottom to top along the right side of box-container
            //stretches height and moves inside-box over so the only width showing is the same as the border width
            $(this).find(".inside-box").css({ height: "100px" });

            $(this)
              .find(".inside-box")
              .animate({ marginTop: boxPaddingNegative }, 800)
              //returns inside-box to normal size
              .promise()
              .done(
                $(this).find(".inside-box").animate({ width: "50px" }, 200)
              );
            $(this).find(".inside-box").css({ height: "50px" });

            ranLocation = 0;
            break;
        }
      },
      function () {}
    );
  });
});
