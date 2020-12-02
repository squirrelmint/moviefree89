<?php
function openLoader(){
    ?>
    var tag = $("body").parent();;

    $(tag).block({
        message: '<i class="icon-spinner9 spinner"></i>',
        overlayCSS: {
            backgroundColor: "#fff",
            opacity: 0.8,
            cursor: "wait"
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: "none"
        }
    });
    <?php
}

function closeLoader(){
    ?>
    var tag = $("body").parent();
    $(tag).unlock();
    <?php
}