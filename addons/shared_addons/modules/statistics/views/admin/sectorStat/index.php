<div class="one_full">
<section class="title blue">
    <h4> <strong> Sector Summary</strong></h4>
</section>

  <section class="item" style="padding:10px">
      <div class="one_full"> 
          <div class="one_full">
          <a class="btn blue type_btn" id="type_btn1" rel="1"> Enrollees</a>
          <a class="btn blue type_btn" id="type_btn2"  rel="2"> Graduates</a>
          <a class="btn blue type_btn" id="type_btn3"  rel="3"> Inactives </a>
          <a class="btn gray type_btn" id="type_btn4"  rel="4"> Summary </a>
          <span style="float:right">
              <?php  date_default_timezone_set('Hongkong');
            //$dateNow = date("Y-m-d H:i:s");?>
           <?php echo form_dropdown('ddl_month', array('0'=>'Choose a Month','1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December'),date("m"),'class="ddl_month" id="ddl_month" ');?>
           <?php echo form_dropdown('ddl_year', array('0'=>'Choose a year','2013'=>'2013','2014'=>'2014','2015'=>'2015','2016'=>'2016','2017'=>'2017','2018'=>'2018','2019'=>'2019','2020'=>'2020'),date("Y"),'class="ddl_year" id="ddl_year" ');?>
          </span>
          </div>
           
           <div id="sectorRepbody"></div>
          
         
      </div> 
          
        </section>
</div>
    