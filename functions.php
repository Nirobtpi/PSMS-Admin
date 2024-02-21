<?php 
function get_values($value){
    if(isset($_POST[$value])){
        echo $_POST[$value];
    }
}

?>