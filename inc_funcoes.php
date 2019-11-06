<?php

    function ola(){
        echo "Olar!";
    }

    function card($texto, $cor){

        ?>

        <div class="card <?php echo $cor;?>">    
        <div class="card-content white-text">
            <span class="card-title"></span>
            <p><?php
                echo $texto;     // obs!!  php com html
            ?></p>
        </div>
        <div class="card-action">
            <a href="#">This is a link</a>
            <a href="#">This is a link</a>
        </div>
        </div>

        <?php
        
          
    }

?>