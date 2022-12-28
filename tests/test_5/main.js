// Author   : M@nKind - Geert Weggemans 
// Date     : 12-11-2015
// Project  : Multi
// Goal     : Populate multiple elements with html with AJAX/JSON Call
//=============================================================================
$(document).ready(function(){
    $(document).on("click", "button#populate", function(e) {
        $.ajax({ 
            type    : 'GET',     
            cache   : false,
            url     : 'index.php?action=ajaxcall&func=populate',
            dataType:'json',
            success : function(data) 
            { 
                if (data) 
                { 
                    $.each(data, function(i)
                    { 
                            var item = data[i];
                            console.log(item.target);
                            $(item.target).html(item.content);
                    });
                }
            }
            });
        });    
});
//=============================================================================
