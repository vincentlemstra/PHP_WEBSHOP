$(document).ready(function () {
    $("#btn_add_rating").click(function(e) {
        e.preventDefault();
        
        var rating = $("#rating").val();
        if (rating < 1 | rating > 5) {
            $("#rating_message").text('Please enter a rating between 1 and 5');
        } else {
            setRating();
            getRatingInfo();
        }
    });

    function setRating() {
        // get rating input
        var rating = $("#rating").val();
        var product_id = getUrlParameter('id');

        // save rating in db
        $.ajax({
            type: "POST",
            url: "index.php?action=ajaxcall&func=set_rating&product_id=" + product_id,
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

    function getRatingInfo() {
        // get product id
        var product_id = getUrlParameter('id');
        
        // get rating info from db
        $.ajax({
            type: "GET",
            cache: false,
            url: "index.php?action=ajaxcall&func=get_rating_info&product_id=" + product_id,
            dataType: "json",
            success: function(data) {
                $("#avg_rating").text(data['avg_rating'][0]['rating']);
                $("#total_ratings").text(data['total_ratings']);
            },
            error: function() {
                console.log("error $.ajax get ratinginfo rating call")
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