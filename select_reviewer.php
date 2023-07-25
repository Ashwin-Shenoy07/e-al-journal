<?php
$conn = mysqli_connect("localhost", "root", "", "e_al");
if($conn === false){
    die("ERROR: Could not connect. ". mysqli_connect_error());
}
$reviewer = "select name,intrest1,intrest2,intrest3 from reviewer_registration as rr, reviewers_area_of_intrest as ra where rr.registration_no = ra.registration_no AND (ra.intrest1='business' OR ra.intrest2='business' OR ra.intrest3='business');";
$res = mysqli_query($conn,$reviewer);
$row=$res->fetch_assoc();
//echo $row['name'];
$rid = "select reviewer_id from reviewer_registration as rr, approved_reviewers as ap where rr.registration_no = ap.registration_no and name='".$row['name']."';";
//echo $rid;
$res1 = mysqli_query($conn,$rid);
//$row1=$res1->fetch_assoc();
echo "<select name='category'>";
echo "<option value='#'>select...</option>";
    while($row1=$res1->fetch_assoc())
    {
        //echo $row1['reviewer_id'];
    ?>
    <option value="<?php echo $row1['reviewer_id']?>"><?php echo $row['name']?></option>
    <?php
    }
echo "</select>";
?>