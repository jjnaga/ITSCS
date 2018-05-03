$('#docgrp').hover(
    function () { 
        $('#vector1').addClass('hover-light');
        $('#vector2').addClass('hover-dark');
    },
    function () { 
        $('#vector1').removeClass('hover-light');
        $('#vector2').removeClass('hover-dark');
    }
);
