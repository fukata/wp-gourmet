(function($){
    $(function(){
        var base_url = $('#base_url').val();
        console.log(base_url);

        $.ajax({
            url: base_url,
            data: {
                api: 'rest_search',
                name: 'ワイン'
            },
            dataType: 'json',
            success: function(data, dataType) {
                console.log(data);
            },
            error: function(request, textStatus, errorThrown) {
                console.log(textStatus);
            }
        });
    });
})(jQuery)
