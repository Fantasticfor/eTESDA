<div class="one_full">
<section class="title blue">
	<h4> <i class="  icon-file" style="margin-top: 4px"  ></i>Generate Reports</h4>
</section>

  <section class="item">
 <div style="margin:10px 10px 10px 10px; ">  
      <fieldset >
	<legend>Choose a Report</legend>
        
    <?php
    $att2 = 'id="select_report"';
    echo form_dropdown('select_report',array('0'=>'--Choose a Report--','1'=>'Course Enrollees Summary Report','2'=>'Sector Summary Report','3'=>'Endorsement Report'),'', $att2)?> 
        <br>
    <?php
    $att4= 'id="select_month"';
    echo form_dropdown('select_month',array('Choose month'=>'--Choose a Month--','1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'Ocotber','11'=>'November','12'=>'December'),'', $att4)?> 
        <br>
     <?php
    $att3 = 'id="select_year"';
    echo form_dropdown('select_year',array('Choose year'=>'--Choose a Year--','2011'=>'2011','2012'=>'2012','2013'=>'2013','2014'=>'2014','2015'=>'2015'),'', $att3)?> 
    
      </fieldset>  
          <a class="btn blue" id="generate"> Generate </a>
     <div >
         <div class="item" id="report" style="width:60%; margin-left:20%" > 
             
         </div>
     </div>

	

     </div>       
        </section>
</div>
    