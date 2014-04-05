@layout('layout.layout')

<h2>Rubrik <?php echo $this->headline;?></h2>
this is the content <?php echo "string"; echo 1+1;?> of index view file

<?php

    foreach($this->menu as $item) {
        echo $item . "<br>";
    }

?>
