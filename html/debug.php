<?php

        function debug_to_console( $data ) {
                $output = $data;
                if ( is_array( $output ) )
                $output = implode( ',', $output);

                echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
        }

?>


#Taken from https://stackoverflow.com/questions/4323411/how-can-i-write-to-console-in-php#answer-20147885
