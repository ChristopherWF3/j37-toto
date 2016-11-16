<?php

print_r($_GET["id"]);

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

$.ajax({
        url:  'views/studentbody.php',
        type: 'GET',
        success: function(data){
       		$('#studentContent').html(data);
   		}
        }); 

    }); // Fermeture JQuery
</script>