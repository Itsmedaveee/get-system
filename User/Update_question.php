<?php 
include_once '../includes/connection.php';

$QID = $_GET['QID'];
$count = $_GET['count'];

?>
<style>
.addedtext{
    margin-top: 5px;
    border-radius: 5px 5px 5px 5px;
    background: lightgrey;
    border:none;
    padding: 0;
    list-style: none;
    text-decoration: none;
    color: #0c1c22 ;
    font-weight: 400;
    width:250px;
    height:40;
    padding-left: 3;
    line-height: 2;
    
}
div .delete{
    color:#fff;
    border-radius:0px 5px 5px 0;
    border:none;

    margin-right:0px;
    background:red;
    padding: 12 10 12 10;
    cursor:pointer;
}
.delete:hover{
    background:red;
    opacity: 0.7
}
.choices{
    border-radius: 5px 5px 5px 5px;
    background: #fff;
    color: #0c1c22 ;
    font-weight: bold;
    width:250px;
    height:40;
    padding:0;
    margin:0;
}
.choice{
    margin-left: 4;
    margin-top: 15px;
}

</style>

 <?php              

                            $sql = "SELECT * FROM questiontbl WHERE QuestionID ='$QID'";
                            $result = $conn-> query($sql);
                            
                            if ($result-> num_rows > 0){
                                   
                                    while ($row = $result-> fetch_assoc()){
                                            
                                            $QType = $row['QuestionType'];
                                            $Question = $row['Question'];
                                           
                                       if ($QType == "ShortAnswer") {
                   
                             
                            ?> 


                        <!---================================== Question No. 1 Short Answer =============================--->
                            <div class="shadowbox">

                            <div class="question-row">
                                    
                            <input class="MainQuestion" type="text" name="Question[<?php echo $count; ?>]" value="<?php echo "Q".$count.".) ". $Question; ?>">
                                                                                                           
                            </div>

                            <div class="questionnaires">
                                                
                                <input type="text" class="Answer-text" name="Q1" placeholder="Short Text" ><br>
                            
                            <span class="actionbtn">
                                <span class="btnedit"><img  src="../img/update.png" alt=""></span> 
                            <span class="divider">|</span>    
                                <span class="btndelete" onClick="deleteme(<?php echo $QID;?>)"><img src="../img/delete.png" alt=""></span>  
                            </span><br>
                            
                            </div>

                            

                            </div>
                            <?php 
                            }
                            if ($QType == "LongAnswer") {
                            ?>

                        <!---================================== Question No. 2 Long Answer =============================--->
                            <div class="shadowbox">

                                    <div class="question-row">
                                            
                                    <input class="MainQuestion" type="text" name="Question" value="<?php echo "Q".$count.".) ". $Question; ?>">
                                                                                                                
                                    </div>

                                    <div class="questionnaires">
                                                    
                                        <label>
                                        <textarea type="text" class="LongAnswer-text" name="Q1" placeholder="Long Text" value=""></textarea>
                                        </label><br>
                                    <span class="actionbtn">
                                        <span class="btnedit"><img  src="../img/update.png" alt=""></span> 
                                    <span class="divider">|</span>    
                                        <span class="btndelete" onClick="deleteme(<?php echo $QID;?>)"><img src="../img/delete.png" alt=""></span>  
                                    </span><br>
                                    
                                    </div>

                            

                            </div>
                            <?php 
                            }
                            if ($QType == "Multiplechoice") {
                            ?>

                        <!---================================== Question No. 3 Multiplechoice =============================--->
                            <div class="shadowbox">

                            <div class="question-row">
                                    
                            <input class="MainQuestion" type="text" name="Question" placeholder="<?php echo "Q".$count.".) ". $Question; ?>">
                                                                                                           
                            </div>

                            <div class="questionnaires">
                            <div id="choices-containers" class="ccontainer">

                            <input type="text" class="choices" id="inputAdds" placeholder="Enter Choices here..">
                            <input type="button" class="addbtn" id="addbtn" value="+" onClick="addRadio()">
                            <span class="error"><?php echo $newpwerr; ?></span>
                            <?php 
                            $sql1 = "SELECT Answer FROM answertbl WHERE Question_ID='$QID'";
                            $result1 = $conn-> query($sql1);

                            if ($result1-> num_rows > 0){
                                    
                                    while ($row1 = $result1-> fetch_assoc()){
                                            $Answer = $row1['Answer'];
                                            
                            
                            ?>
                           
                            <input type="radio" class="radiobtn">
                            <input type="text" class="addedtext" name="options[]" value="<?php echo $Answer; ?>">

                            

                            
                            <?php } }?>

                            </div>
                            
                            <span <?php echo $hide; ?> class="actionbtn">
                                <span class="btnedit"><img  src="../img/update.png" alt=""></span> 
                            <span class="divider">|</span>    
                                <span class="btndelete" onClick="deleteme(<?php echo $QID;?>)"><img src="../img/delete.png" alt=""></span>  
                            </span><br>
                            
                            </div>

                            </div>
                            <?php 
                            }
                            if ($QType == "Checkbox") {
                            ?>
                            <!---================================== Question No. 4 Checkbox =============================--->
                            <div class="shadowbox">

                            <div class="question-row">
                                    
                            <input readonly class="MainQuestion" type="text" name="Question" value="<?php echo "Q".$count.".) ". $Question; ?>">
                                                                                                           
                            </div>

                            <div class="questionnaires">

                            <div id="choices-containers" class="ccontainer">

                            <input type="text" class="choices" id="inputAdds" placeholder="Enter Choices here..">
                            <input type="button" class="addbtn" id="addbtn" value="+" onClick="addRadio()">
                            <span class="error"><?php echo $newpwerr; ?></span>

                            <?php 
                            $sql1 = "SELECT Answer FROM answertbl WHERE Question_ID='$QID'";
                            $result1 = $conn-> query($sql1);

                            if ($result1-> num_rows > 0){
                                    
                                    while ($row1 = $result1-> fetch_assoc()){
                                            $Answer = $row1['Answer'];
                                            
                            
                            ?>


                            <label class="optionlbl"><input type="Checkbox" class="radiobtn" name="option<?php echo $count; ?>" > <?php echo $Answer; ?></label>


                            <?php } }?>
                            
                            </div>

                            <span <?php echo $hide; ?> class="actionbtn">
                                <span class="btnedit"><img  src="../img/update.png" alt=""></span> 
                            <span class="divider">|</span>    
                                <span class="btndelete" onClick="deleteme(<?php echo $QID;?>)"><img src="../img/delete.png" alt=""></span>  
                            </span><br>
                            
                            </div>

                            </div>
                        <?php 
                            }
                            if ($QType == "Date") {
                        ?>
                    <!---================================== Question No. 5 Date =============================--->
                        <div class="shadowbox">

                            <div class="question-row">
                                    
                            <input readonly class="MainQuestion" type="text" name="Question" value="<?php echo "Q".$count.".) ". $Question; ?>">
                                                                                                           
                            </div>

                            <div class="questionnaires">
                                                
                                <input type="date" class="Answer-text" name="Answer[<?php echo $count; ?>]"><br>
                            
                            <span <?php echo $hide; ?> class="actionbtn">
                                <span class="btnedit"><img  src="../img/update.png" alt=""></span> 
                            <span class="divider">|</span>    
                                <span class="btndelete" onClick="deleteme(<?php echo $QID;?>)"><img src="../img/delete.png" alt=""></span>  
                            </span><br>
                            
                            </div>

                            

                        </div>


                  <!--  end of loop =>      
                            <?php 
                            }

                    }
                }
            
                            ?>





