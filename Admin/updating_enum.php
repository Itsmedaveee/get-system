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

$get_record = mysqli_query($conn, "SELECT * FROM enumeratortbl WHERE EID = '$db_id'");

while ($get = mysqli_fetch_assoc($get_record)) {

        $db_id = $get['EID'];
        $db_name = ucfirst($get['Name']);
        $db_contact = $get["Contact"];
        $db_email = $get["Email"];
        
    
}

 $Newname = $Newcontact = $new_email = "";
$new_nameerr = $new_contacterr = $new_emailerr = "";

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
 
                
 
                 
                 mysqli_query($conn, "UPDATE enumeratortbl SET 
                 
                    Name = '$db_name',
                    Contact = '$db_contact',
                    Email = '$db_email' WHERE EID = '$db_id'
                    ");
                 $encrypted = md5(rand(1,9));
                 echo "<script>window.location.href='Manage_enumerator?$encrypted&&notify=Record ID $db_id Successfully Updated!';</script>";
 
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

                <td width='100px' ><input style="margin-left:100px;" type="text" name="new_contact" maxlength="11" value="<?php echo $db_contact; ?>" size="8em" onkeypress='return isNumberKey(event)'>
                </td>

                <td width='200px' ><input style="margin-left:55px;" type="text" name="new_email" value="<?php echo $db_email; ?>" size="18em">
                </td>

                <td width='80px' ><button style="margin-left:120px; cursor:pointer;" name="btnupdate" class="btn-update"><img src='../img/okay.png'></button>
                <a  href="Manage_enumerator" class="btn-delete"><img src='../img/cancel.png'></a>
                </td>
            </tr>
            <tr>
                <td width="1%"></td>

                <td width="15%"><span class="error"><?php echo $new_nameerr; ?></span></td>
                <td width="10%"><span class="error"><?php echo $new_contacterr; ?></span></td>
                <td width="20%"><span class="error"><?php echo $new_emailerr; ?></span></td>

                <td></td>
                <td Width="10%"></td>
            </tr>
</tbody>
        </table>
</form>