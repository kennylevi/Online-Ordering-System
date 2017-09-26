<?php 
    if ($status == 1) {
        echo '<input type="button" class="checked btn btn-success disabled m-b-10" data-id="'.$value->res_id.'" value="Checked in" >';
    }
    elseif ($value->date > $today) {
        echo '<input type="button" title="change" class="pending btn btn-warning" data-id="'.$value->res_id.'" value="Pending">';
    }elseif ($value->date < $today) {
        echo '<input type="button" class="btn btn-danger disabled m-b-10"  value="Date Error"></button>';
    }elseif ($value->date == $today && $status == 0) {
        echo '<input type="button" title="change" class="around btn btn-primary" data-id="'.$value->res_id.'" value="Active">';
    }else{
        echo '<input type="button" class="btn btn-danger disabled m-b-10"  value="Unavialable"></button>';
    }

?>