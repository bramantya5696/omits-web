const hamburger = document.querySelector(
    ".navbar .div-hamburger button"
  );
const mobile_menu = document.querySelector(".navbar .div-menu");
const menu_item = document.querySelectorAll(
  ".navbar .div-menu .menu ul li"
);

hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    mobile_menu.classList.toggle("active");
  });
  
  menu_item.forEach((item) => {
    item.addEventListener("click", () => {
      hamburger.classList.toggle("active");
      mobile_menu.classList.toggle("active");
    });
  });

// countdown
var day, hour, minute, second;
var x = setInterval(function(){
  var countDownDate = new Date("July 10, 2022 00:00:00").getTime();
    var now = new Date().getTime();
    var distance = countDownDate - now;
    day = Math.floor(distance / (1000*60*60*24));
    hour = Math.floor((distance % (1000*60*60*24)) / (1000*60*60));
    minute = Math.floor((distance % (1000*60*60)) / (1000*60));
    second = Math.floor((distance % (1000*60)) / (1000));
    
    document.getElementById('day').innerHTML = day;
    document.getElementById('hour').innerHTML = hour;
    document.getElementById('minute').innerHTML = minute;
    document.getElementById('second').innerHTML = second;
    
    if(distance < 0){
        clearInterval(x);
        document.getElementById('day').innerHTML = "0";
        document.getElementById('hour').innerHTML = "0";
        document.getElementById('minute').innerHTML = "0";
        document.getElementById('second').innerHTML = "0";
    }
},1000);
  // end countdown
  document.getElementById("year").innerHTML = new Date().getFullYear();

  // Counter-up
  $(document).ready(function () {
    $(".counter-up").counterUp({
      delay: 10,
      time: 500
    });
  });
  // end Counter-up

  // reveal address and social media
  // var boxtitle = document.querySelector(".contact .div-contact-link-map .div-address-link .box .box-title");
  // $(document).ready(function(){
  //   $(boxtitle).style.maxWidth = "200px";
  //   $(boxtitle).style.maxHeight = "40px";
  //   $(boxtitle).style.top = "0%";
  // });
    // end reveal address and social media