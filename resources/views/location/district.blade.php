<option value="" disabled selected>กรุณาเลือก</option>
<?php
    if( isset($tmppart) )
    {   
        foreach ($tmppart as $key => $value) 
        { 
            echo '<option value="'.$value->DISTRICT_ID.'" >'.$value->DISTRICT_NAME.'</option>';
        }
    }
?>