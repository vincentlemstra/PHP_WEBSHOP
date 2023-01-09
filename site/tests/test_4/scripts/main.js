$(document).ready(function () {
    $("#btn_get_avg_rating").click(function() {
        getAvgRating();
    });

    $("#btn_add_rating").click(function(e) {
        e.preventDefault();
        setRating();
        getAvgRating();
    });

    function getAvgRating() {
        // get avg rating from db
        $.ajax({
            type: "GET",
            cache: false,
            url: "getavgrating.php",
            dataType: "json",
            success: function(data) {
                $("#avg_rating").text(data[0]['rating']);
            },
            error: function() {
                console.log("error $.ajax call")
            }
        });
    }

    function setRating() {
        // get rating input
        var rating = $("#rating").val();

        // save rating in db
        $.ajax({
            url: "setrating.php",
            type: "POST",
            data: {
                rating: rating
            },
            success: function() {
                $("#user_rating").text(rating);
            },
            error: function(){
                console.log("error: $.ajax error")
            }
        });
    }
});