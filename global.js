$(document).ready(function () {
  /* TODO
    replace all instances of 2px with a css border variable
    replace all instance where inside-boxes width and height are variables that are related to box-container
    https://www.youtube.com/watch?v=P_JOdsm_8tY add this effect to lower boxes
    */

  function randomNumber(num) {
    return Math.floor(Math.random() * num);
  }

  $(".box-container").each(function () {
    //loads inside-box to random corner
    // var ranLocation = randomNumber(4);
    var ranLocation = 0;
    console.log("randomLocation: " + ranLocation);
    //grabs width & height of box-container and subtracts inside-box & border so hover animate sets inside-box to correct location
    var width = $(this).width() - $(this).find(".inside-box").width() + 2;
    var height = $(this).height() - $(this).find(".inside-box").height() + 2;
    //grabs width & height but does not subtract the width of inside-box and the border. Used to ensure inside-box moves to the far end of the box-container
    var totalWidth = $(this).width();
    var totalHeight = $(this).height();

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
            $(this).find(".inside-box").css({ width: "100px", height: "2px" });
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
            $(this).find(".inside-box").css({
              "margin-left": totalWidth,
              height: "100px",
              width: "2px",
            });

            $(this)
              .find(".inside-box")
              .animate({ marginTop: height }, 800)
              //returns inside-box to normal size
              .promise()
              .done($(this).find(".inside-box").animate({ width: "50px" }, 100))
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
              .css({ width: "100px", height: "2px", marginTop: totalHeight });

            $(this)
              .find(".inside-box")
              .animate({ marginLeft: "-2px" }, 800)
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
              .animate({ marginTop: "-2px" }, 800)
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
