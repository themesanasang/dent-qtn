<option value="" disabled selected>กรุณาเลือก</option>
<?php
    if( isset($amppart) )
    {   
        foreach ($amppart as $key => $value) 
        { 
            echo '<option value="'.$value->AMPHUR_ID.'" >'.$value->AMPHUR_NAME.'</option>';
        }
    }
?>