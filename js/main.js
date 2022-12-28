$(document).ready(function () {
    $("#btn_add_rating").click(function(e) {
        e.preventDefault();
        
        var rating = $("#rating").val();
        if (rating < 1 | rating > 5) {
            $("#rating_message").text('Please enter a rating between 1 and 5');
        } else {
            setRating();
            getAvgRating();
            getTotalRatings();
        }
    });

    function setRating() {
        // get rating input
        var rating = $("#rating").val();
        var product_id = getUrlParameter('id');

        // save rating in db
        $.ajax({
            url: "/4_PHP_AJAX/index.php?action=ajaxcall&func=set_rating&product_id=" + product_id,
            type: "POST",
            data: {
                rating: rating
            },
            success: function() {
                $("#rating_message").text('Thank you for for your review.');
                $("#btn_add_rating").hide();
                $("#rating").hide();
            },
            error: function(){
                console.log("error: $.ajax set rating error");
            }
        });
    }

    function getAvgRating() {
        // get product id
        var product_id = getUrlParameter('id');
        
        // get avg rating from db
        $.ajax({
            type: "GET",
            cache: false,
            url: "/4_PHP_AJAX/index.php?action=ajaxcall&func=get_avg_rating&product_id=" + product_id,
            dataType: "json",
            success: function(data) {
                $("#avg_rating").text(data[0]['rating']);
            },
            error: function() {
                console.log("error $.ajax get avg rating call")
            }
        });
    }

    function getTotalRatings() {
        // get product id
        var product_id = getUrlParameter('id');

        $.ajax({
            type: "GET",
            cache: false,
            url: "/4_PHP_AJAX/index.php?action=ajaxcall&func=get_total_ratings&product_id=" + product_id,
            dataType: "json",
            success: function(data) {
                $("#total_ratings").text(data);
            },
            error: function() {
                console.log("error $.ajax get total rating call")
            }
        });
    }

    var getUrlParameter = function getUrlParameter(parameter) {
        var pageURL = window.location.search.substring(1),
            URLVariables = pageURL.split('&'),
            parameterName,
            i;
    
        for (i = 0; i < URLVariables.length; i++) {
            parameterName = URLVariables[i].split('=');
    
            if (parameterName[0] === parameter) {
                return parameterName[1] === undefined ? true : decodeURIComponent(parameterName[1]);
            }
        }
        return false;
    };
});