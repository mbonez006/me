
//nav bar management
function collapseNavbar() {
    $(".navbar").offset().top>50?$(".navbar-fixed-top").addClass("top-nav-collapse"): $(".navbar-fixed-top").removeClass("top-nav-collapse")
}
$(window).scroll(collapseNavbar),
$(document).ready(collapseNavbar),
$(function() {
    $("a.page-scroll").bind("click", function(e) {
        var t=$(this);
        $("html, body").stop().animate( {
            scrollTop: $(t.attr("href")).offset().top
        }
        , 1500, "easeInOutExpo"), e.preventDefault()
    }
    )
}),
$(".navbar-collapse ul li a").click(function() {
    $(this).closest(".collapse").collapse("toggle")
});

// media query event handler
if (matchMedia) {
  var mq = window.matchMedia("(min-width: 768px)");
  mq.addListener(WidthChange);
  WidthChange(mq);
}

// media query change
function WidthChange(mq) {
  if (mq.matches) {
    $("#menu-toggle").hide();
    $("#sidebar-wrapper").hide();
    $("#main-nav").show();
  } else {
    $("#menu-toggle").show();
    $("#sidebar-wrapper").show();
    $("#main-nav").hide();
  }

}


// Price Quote bit
$("#calculateEstimateBtn").click(function(e){
    calculateAndDisplayEstimate();
});

$( document ).ready(function() {
    $(".otherWorks").hide();
});

$("#viewOtherWorks").click(function(e){
    $(".otherWorks").show();
    $("#viewOtherWorks").hide();
});

// Closes the sidebar menu
$("#menu-close").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
});
// Opens the sidebar menu
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
});
// Scrolls to the selected menu item on the page
$(function() {
    $('a[href*=#]:not([href=#],[data-toggle],[data-target],[data-slide])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
});
//#to-top button appears after scrolling
var fixed = false;
$(document).scroll(function() {
    if ($(this).scrollTop() > 250) {
        if (!fixed) {
            fixed = true;
            // $('#to-top').css({position:'fixed', display:'block'});
            $('#to-top').show("slow", function() {
                $('#to-top').css({
                    position: 'fixed',
                    display: 'block'
                });
            });
        }
    } else {
        if (fixed) {
            fixed = false;
            $('#to-top').hide("slow", function() {
                $('#to-top').css({
                    display: 'none'
                });
            });
        }
    }
});
// Disable Google Maps scrolling
// See http://stackoverflow.com/a/25904582/1607849
// Disable scroll zooming and bind back the click event
var onMapMouseleaveHandler = function(event) {
    var that = $(this);
    that.on('click', onMapClickHandler);
    that.off('mouseleave', onMapMouseleaveHandler);
    that.find('iframe').css("pointer-events", "none");
}
var onMapClickHandler = function(event) {
        var that = $(this);
        // Disable the click handler until the user leaves the map area
        that.off('click', onMapClickHandler);
        // Enable scrolling zoom
        that.find('iframe').css("pointer-events", "auto");
        // Handle the mouse leave event
        that.on('mouseleave', onMapMouseleaveHandler);
    }
    // Enable map zooming with mouse scroll when the user clicks the map
$('.map').on('click', onMapClickHandler);

function calculateAndDisplayEstimate(){
    var numOfPages = $("#noOfPages").val();
    var customOrTemplate = $("#customOrTemplate :selected").text();
    var responsiveOrNot = $("#responsiveOrNot :selected").text();
    var ecommerceOrNot = $("#ecommerceOrNot :selected").text();
    var dashboardOrNot = $("#dashboardOrNot :selected").text();
    var estimatedCost = 500;

    //verify values
    if (numOfPages < 1){
        numOfPages = 1;
    }

    estimatedCost = estimatedCost + (numOfPages * 100)

    if(customOrTemplate == "Custom Design"){
        estimatedCost = estimatedCost + 400;
    }

    if(responsiveOrNot == "Yes"){
        if(customOrTemplate == "Custom Design"){
            estimatedCost = estimatedCost + 300;
        }
        else{
            estimatedCost = estimatedCost + 200;
        }            
    }

    if(dashboardOrNot == "Yes"){
        if(customOrTemplate == "Custom Design"){
            estimatedCost = estimatedCost + 600;
        }
        else{
            estimatedCost = estimatedCost + 400;
        }
    }

    if(ecommerceOrNot == "Yes"){
        if(customOrTemplate == "Custom Design"){
            estimatedCost = estimatedCost + 1000;
        }
        else{
            estimatedCost = estimatedCost + 700;
        }
    }

    $("#estimate").text("£" + estimatedCost);

}