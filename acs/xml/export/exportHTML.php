<?php
/* include the ACS class page */
require_once("../../classes/ACS.php");

/******* Code For reading the html format and generate xml format file in specific location******************/

/* Step 1: create object of the ACS class */
$ACS=new ACS();

if(isset($_POST['import']))
{
/* Step 2: set values of required parameters */

	$ACS->htmlTable=$_POST['html'];	
	// set whether first row is header or not (true or false)
	$ACS->isFirstRowHeader=$_POST['firstRowHeader'] == 'true' ? true : false;
	// set whether first row is Tag or not (true or false)
	$ACS->useFirstRowAsTag=$_POST['firstRow'] == 'true' ? true : false;
	//set the row tag name of the converted file
	$ACS->rowTagName=$_POST['rowTag'];
	//set the converting format file or not
	$ACS->isFile=true;
	// save the file on Specific location or display in browser (browser or save)
	$ACS->fileOutputMode=$_POST['browserMode'];
	// set the output path where file want to save converted file format
	$outputFile=$_POST['outputPath'];	
	// using the ACS script to upload file and get the upload file path, you can use your own file upload code  also
	$ACS->replaceOlderFile=true;//replace old file if already exists there

	if($ACS->fileUpload($_FILES['upload'],$ACS->fileUploadPath,$ACS->maxSize,array("html")))
	{  
		//get the path of the uploaded file	
		$path=$ACS->uploadedFileName;
		
		/* Step 3: call the convert method to reading the html Format and generate file in xml format*/			
		$ACS->convert("html","xml",$path,$outputFile);
		
		if(!isset($ACS->error))
		{
			$message="<div class='success'>Operation done successfully</div>";
		}
		else
		{
			$message="<div class='error'>There is error in operation. Please check error message: ".$ACS->error."</div>";	
		}
		
		/*Debug Operations - Uncomment below code lines to debug values */
		/*echo $ACS->error; //To display any error occured
		echo $ACS->messages; //It displays various messages at various points to check where code breaks
		print_r($ACS->inputDataArray);// To print the array of data generated after reading the csv file
		print_r($ACS->formattedDataArray);// To print the formatted array of data generated by code before final operation*/
	}
	else
	{
		$message=$ACS->error;
	}	


}
require_once("../../header.php");
?>
<h4>XML Generate From HTML</h4><hr />
<div class="from">
  <?php if(isset($message)) echo $message; ?>
  <form method="post" enctype="multipart/form-data">
    <div class="formRow">
      <div class="formLabel">Upload HTML Table</div>
      <div class="formField">
        <input type="file" id="File1" name="upload"  required="required"/>
      </div>
    </div>
    <div class="formRow">
      <div class="formLabel">Row Tag Name</div>
      <div class="formField">
        <input type="text" name="rowTag" />
      </div>
    </div>
    <div class="formRow">
      <div class="formLabel">Use First Row As Tag</div>
      <div class="formField">
        <input type="radio" name="firstRow" value="true" checked="checked"/>
        &nbsp;&nbsp;True&nbsp;&nbsp;&nbsp;
        <input type="radio" name="firstRow" value="false"/>
        &nbsp;&nbsp;False</div>
    </div>
    <div class="formRow">
      <div class="formLabel">Is First Row Header</div>
      <div class="formField">
        <input type="radio" name="firstRowHeader" value="true" checked="checked"/>
        &nbsp;&nbsp;True&nbsp;&nbsp;&nbsp;
        <input type="radio" name="firstRowHeader" value="false"/>
        &nbsp;&nbsp;False</div>
    </div>
    <div class="formRow">
      <div class="formLabel">File Output Mode</div>
      <div class="formField">
        <input type="radio" name="browserMode" value="save"/>
        &nbsp;&nbsp;Save file on the server&nbsp;&nbsp;&nbsp;
        <input type="radio" name="browserMode" value="browser" checked="checked"/>
        &nbsp;&nbsp;Output in Browser</div>
    </div>
    <div class="formRow">
      <div class="formLabel">Output File Name</div>
      <div class="formField">
        <input type="text" name="outputPath" value="file.xml" />
      </div>
    </div>
    <div class="formRow">
      <div class="formLabel"></div>
      <div class="formField submit">
        <input type="submit" id="save" name="import" value="Save"/>
        <input type="reset" name="reset" />
      </div>
    </div>
  </form>
</div>
<div class="xmloutput">
<?php 
if(isset($_POST['import']))
{
	if($_POST['browserMode']=="browser")
		echo  $ACS->outputXML;
}
?>
</div>
<div class="code">
<h5 class="head5">Code For XML</h5>
<pre>
<code data-language="php">&lt;?php
/* include the ACS class page */
   require_once("../../classes/ACS.php");

/* Step 1: create object of the ACS class */
   $ACS=new ACS();

/* Step 2: call the convert method for reading the csv Format and inserting data in database  */
/* $htmlFileLocation   = location of the html file (i.e. complete path of the uploaded html file)  */
/* $outputFileLocation = location of the output file (i.e. complete path of the output file)  */	
   $ACS->convert("html","xml",$htmlFileLocation,$outputFileLocation);
?&gt;    
</code>
</pre>
</div>