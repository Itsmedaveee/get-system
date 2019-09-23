<style>
.error{
    color:red;
}
.btn-delete{
    background: #ff4949;
    border-radius: 3px 3px 3px 3px;
    padding: 15 6 0 6;
}
.btn-delete:hover {
    background: #ff4949b7;
    
}
.btn-update {
    background: #2e68aa;
    border-radius: 3px 3px 3px 3px;
    padding: 6 6 4 6;
    
}
.btn-update:hover {
   opacity:0.7;
    
}
</style>

<Script type="application/javascript">
function isNumberKey(evt){

    var charCode = (evt.which) ? evt.which : event.keycode

    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    
        return true;
    }
    
}

</Script>

<?php

$db_id = $_GET['ID'];

$get_record = mysqli_query($conn, "SELECT * FROM userstb WHERE ID = '$db_id'");

while ($get = mysqli_fetch_assoc($get_record)) {

        $db_id = $get['ID'];
        $db_name = ucfirst($get['Name']);
        $db_contact = $get["Contact"];
        $db_email = $get["Email"];
        $db_password = $get["Password"];
    
}

$same_id = $new_fullname = $new_contact = $same_password = $new_email = "";
$new_fullnameerr = $new_contacterr = $same_passworderr = $new_emailerr = "";

if (isset($_POST['btnupdate'])) {
    if (empty($_POST['new_fullname'])) {
        $new_fullnameerr = "Invalid Input";
    } else {
        $new_fullname = $_POST['new_fullname'];
        $db_name = $new_fullname;
    }

    if (empty($_POST['new_contact'])) {
        $new_contacterr = "Invalid Input";
    } else {
        $new_contact = $_POST['new_contact'];
        $db_contact = $new_contact;
    }

    if (empty($_POST['new_email'])) {
        $new_emailerr = "Invalid Input";
    } else {
        $new_email = $_POST['new_email'];
        $db_email = $new_email;
    }

    if ($new_fullname && $new_email && $new_contact) {

        if (!preg_match("/^[a-zA-Z ]*$/",$new_fullname)) {
            $fullnameerr = "letters and space only!";
        } else {
         $count_fullname_string = strlen($new_fullname);
 
         if ($count_fullname_string < 2) {
             $new_fullnameerr = "Too Short";
         } else {
 
             if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
                 $new_emailerr = "valid email only!";
             } else {
 
                
 
                 
                 mysqli_query($conn, "UPDATE userstb SET 
                 
                    Name = '$db_name',
                    Email = '$db_email',
                    Contact = '$db_contact' WHERE ID = '$db_id'
                    ");
                 $encrypted = md5(rand(1,9));
                 echo "<script>window.location.href='manageusers?$encrypted&&notify=Record ID $db_id Successfully Updated!';</script>";
 
             }
 
         }
 
        }
        
     }




}

?>

<form method="POST">

        <table border="0" width="750" align="center"class="table-stripped">
        <tbody>
            <tr>

                <td width='30px'><input disabled type="text" name="id" value="<?php echo $db_id; ?>" size="1">
                </td>

                <td width='160px'><input type="text" name="new_fullname" value="<?php echo $db_name; ?>" size="11em">
                </td>

                <td width='100px'><input style="margin-left:65px;"  type="text" name="new_contact" maxlength="11" value="<?php echo $db_contact; ?>" size="8em" onkeypress='return isNumberKey(event)'>
                </td>

                <td width='200px' ><input style="margin-left:30px;"  type="text" name="new_email" value="<?php echo $db_email; ?>" size="18em">
                </td>
                <td width='100px' ><input style="margin-left:75px;" disabled type="text" name="new_password" value="<?php echo $db_password; ?>" size="8em">
                </td>
                <td Width="80px" ><button style="cursor:pointer;" name="btnupdate" class="bt-update"><i class="fa fa-check-circle"></i></button>
                <a style="margin-right:20px;" href="manageusers" class="bt-delete"><i class="fa fa-times-circle"></i></a>
                </td>
            </tr>
            <tr>
                <td width="1%"></td>

                <td width="15%"><span class="error"><?php echo $new_fullnameerr; ?></span></td>
                <td width="10%"><span class="error"><?php echo $new_contacterr; ?></span></td>
                <td width="20%"><span class="error"><?php echo $new_emailerr; ?></span></td>

                <td></td>
                <td Width="10%"></td>
            </tr>
</tbody>
        </table>
</form>