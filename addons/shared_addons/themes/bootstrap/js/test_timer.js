var Example1 = new (function() {
    var $stopwatch, // Stopwatch element on the page
        incrementTime = 70, // Timer speed in milliseconds
        currentTime = 0, // Current time in hundredths of a second
        updateTimer = function() {
              
            $stopwatch.val(formatTime(currentTime));
            currentTime += incrementTime / 10;
         if ($('#stopwatch').val() > '00:05:00'){
             $('#doneAns').removeClass('disabled');
         }
        },
        init = function() {
            $stopwatch = $('#stopwatch');
            Example1.Timer = $.timer(updateTimer, incrementTime, true);
           
        };
    this.resetStopwatch = function() {
        currentTime = 0;
        this.Timer.stop().once();
    };
   
    $(init);
});


// Common functions
function pad(number, length) {
    var str = '' + number;
    while (str.length < length) {str = '0' + str;}
    return str;
}
function formatTime(time) {
    var min = parseInt(time / 6000),
        sec = parseInt(time / 100) - (min * 60),
        hundredths = pad(time - (sec * 100) - (min * 6000), 2);
    return (min > 0 ? pad(min, 2) : "00") + ":" + pad(sec, 2) + ":" + hundredths;
}

function stopTime(){
     
    Example1.Timer.stop();
  //alert($('#stopwatch').val());
  var testDur=$('#stopwatch').val();
  var baseurl
    $.ajax({
     type: "POST",
     url: baseurl+'syllabus/viewedTopic',
     data:'duration='+testDur //assign the var here 
     
 });
  // Example1.Timer.play();
  

}





/**
 * Example 2 is similar to example 1.  The biggest difference
 * besides counting up is the ability to reset the timer to a
 * specific time.  To do this, there is an input text field
 * in a form.
 */

var Example2 = new (function() {
    var $countdown,
        $form, // Form used to change the countdown time
        incrementTime = 70,
        currentTime = 36000,//36000,
        updateTimer = function() {
            $countdown.html(formatTime(currentTime));
            if (currentTime == 0) {
                Example2.Timer.stop();
                timerComplete();
                Example2.resetCountdown();
                return;
            }
            currentTime -= incrementTime / 10;
            if (currentTime < 0) currentTime = 0;
        },
        timerComplete = function() {
         
//                  $no = $('.next').attr('rel');
//            window.location.assign("http://www.w3schools.com"+$no);
            $('#profilingSec').submit();
            },
        init = function() {
            $countdown = $('#countdown');
            Example2.Timer = $.timer(updateTimer, incrementTime, true);
            $form = $('#example2form');
           // $no = $('.startTest').attr('rel');
            $('#testItems').show();
            $form.bind('submit', function() {
                Example2.resetCountdown();
                return false;
            });
        };
    this.resetCountdown = function() {
        var newTime = parseInt($form.find('input[type=text]').val()) * 100;
        if (newTime > 0) {currentTime = newTime;}
        this.Timer.stop().once();
    };
    $('.startTest').click((init));
   
});

 
    $('.next').click(function(){
        $no = $('.next').attr('rel');
            window.location.assign("http://www.w3schools.com"+$no);
        
    });
     