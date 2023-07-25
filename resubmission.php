<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Resubmission</title>
    <link rel="stylesheet" href="css/resubmission.css">
  </head>
<body>
    <div class="box-wrapper">
       
  
        <div id="box3">
        	<div class="middle-column">
		<div id="box5" style="background-color: #EFF0F1;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;margin-block-start: 50px;margin-block-end: 0;margin-block-end: 9px;">
                <div>
		<label for="title" class="title">Notifications 
		<button type="submit" class="btn1">Reviewed </button>
		<button type="reset" class="btn1">Approvals</button></label>
		</div>
		<label for="title" class="title">Paper Details </label>
		<div id="paper" style="border-radius: 10px;margin-block-start: 10px;border-radius: 10px;margin-block-start: 10px;background: #fff;">
		<label>paper id </label><button type="submit">view</button></div>
		<div id="paper" style="border-radius: 10px;margin-block-start: 10px;border-radius: 10px;margin-block-start: 10px;background: #fff;">
			<label>paper id </label> <button type="submit">view</button></div>
		<div id="paper" style="border-radius: 10px;margin-block-start: 10px;border-radius: 10px;margin-block-start: 10px;background: #fff;">
			<label>paper id </label> <button type="submit">view</button></div>
		<div id="paper" style="border-radius: 10px;margin-block-start: 10px;border-radius: 10px;margin-block-start: 10px;background: #fff;margin-block-end: 10px;">
			<label>paper id </label><button type="submit">view</button></div>
		</div>
 
        <div id="box6" style="background-color: #EFF0F1;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;margin-block-end: 150px;margin: 25p">
        	<div id="paper" style=" border-radius: 10px;margin-block-start: 10px;border-radius: 10px;margin-block-start: 10px;background: #fff;height: 180px;margin-block-end: 10px;">
		 		<label for="title" class="title">Paper id </label>
				<button type="submit" style="">Download</button>
			</div>
        </div>
        </div>
            <div id="box8" style="background-color: #EFF0F1;border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;margin-block-end: 150px;margin-block-start: 50px;">
                <label for="title" class="title">Resubmit Paper </label>
		<div class="form-group">
		  <label for="title" class="label-title">Paper ID </label>
		  <select class="form-input" id="level" >
                  <option value="B">101112</option>
                  <option value="I">246352</option>
                  </select>
		</div>
		<div class="form-group">
			<label for="title" class="label-title">Resubmit Article </label>
		</div>
		<div class="wrapper">
			<form>
    			<header>Upload Article</header>
				<input type="file" id="real-file"/ hidden>
				<button type="button" id="custom-button">Choose a File</button>
				<span id="custom-text">No File choosen</span>
			</form>
			<button type="submit" class="btn">Submit</button>
			<button type="reset" class="btn">Cancel</button>
 		  </div>
		</div>
			
            </div>	
        </div>
<script type="text/javascript">
	/* upload */
	const realFileBtn = document.getElementById("real-file");
	const customBtn = document.getElementById("custom-button");
	const customTxt = document.getElementById("custom-text");

	customBtn.addEventListener("click", function() {
  		realFileBtn.click();
	});

	realFileBtn.addEventListener("change", function() {
  	if (realFileBtn.value) {
    		customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
  	} else {
    		customTxt.innerHTML = "No file chosen, yet.";
  	}
	});
</script>
</body>
  
</html>