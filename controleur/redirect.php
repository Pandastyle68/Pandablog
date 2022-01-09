<?php
if (str_replace('/','\\',$_SERVER["SCRIPT_FILENAME"]) == __FILE__) {

    $racine="..";
}
?>


<script>
    var data = <?php echo json_encode($_SERVER['HTTP_HOST'], JSON_HEX_TAG); ?>; // Don't forget the extra semicolon!
    if(data == "::1"){
        window.location.replace("http://127.0.0.1/?page=posts");
    }else{
       window.location.replace("http://"+data+"/?page=posts");
    }

</script>