<?php
if(isset ($_POST[ 'upload' ])) {
$file_name = $_FILES['myfile']['name'];
$file_tmp_name = $_FILES['myfile']['tmp_name'];
if (move_uploaded_file($file_tmp_name,"uploads/resume/" . $file_name)){
echo "File uploaded successfully.";
}
else{
echo "Error....Please try again.";
}
}
?><br>
<a download="<?php echo $file_name;?>" href="uploads/resume/<?php echo $file_name;?>">Click here to download</a>


echo "<a download=" echo $file_name;" href='uploads/resume/'.$file_name'>Click here to download</a>";


$file_dl = "SELECT `resume_name`, `resume_path` FROM `reviewer_registration` WHERE `registration_no`='202261'";
$result3 = mysqli_query($this->conn,$file_dl);
$val2 = $result3->fetch_array();
echo "<a download=".$val2[0]." href='uploads/resume/'.$val2[1].'>Click here to download</a>";