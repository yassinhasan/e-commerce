<?php
return array(
    "template" => [
        "wraper_start"            => TEMP_PATH."wraper_start.php",
        ":view"                  => ":action_view",
        "wraper_end"              => TEMP_PATH."wraper_end.php",

    ],
    "header_links" =>[
        "css_links" => [ 
                // "bootstrap" =>"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" ,
                  "fontawesome"   => "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css",
                 "datatable"    =>  "https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css",
                 "style3"       =>  CSS."//style.css"
                
                 
                 
        ]

    ],
    "footer_links" => [
        "js_links" => [
            "jquery"  => "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js",
            "datatabl" => "https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js",
            "main"  => JS."main.js"
        ]

    ]


        );