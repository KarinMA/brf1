            var responseBrf = null;
            function autoComplete(request, response, url) {
                $.ajax({
                    url: '<?php echo BASE_DIR; ?>searchbrf.php',
                    data : {term : request.term},
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        
                        if (data.length == 1) {
                            responseBrf = '<?php echo BASE_DIR; ?>' + data[0].url;
                        } else {
                            responseBrf = null;
                        }
                        
                        if (data.length > 0) {
                        response($.map(data, function(item) {
                            
                                return { 
                                    label: item.name,
                                    value: item.url
                                };
                        }));
                        }
                        $("ul#ui-id-1").
                            css('display', 'block').
                            //css('top', '129px').
                            //css('left', '926px').
                            css('top', (parseFloat($("#sok").offset().top) + 48 ) + 'px').
                            css('left', (parseFloat($("#sok").offset().left) + 16 ) + 'px').
                            css('font-family', "'Open sans', sans serif").css('font-size', '0.6em')
                            .width(297);
                    }
                });
            }
     
            
            $("#sok").autocomplete({
                source : autoComplete,
                select : function(event, ui) {
                    if (true || window.confirm('Gå till: ' + ui.item.label + "?")) {
                        document.location.href = '<?php echo BASE_DIR; ?>' + ui.item.value;
                    }
                    
                },
                close : function(event, ui) {
                    $("#sok").val('');
                }
            });