
<div class="one_full">
 <ul id="breadcrumbs-one">
		<li><a href="" > Choose a Sector</a></li>
		<li><a href="" > Information Technology</a></li>
		<li><a href="" >Create Course </a></li>
		 <li><a href="" >Add Modules to (course name)</a></li>
                 <li><a href="" class="current">Add Lessons to (Module Name) </a></li>
	</ul>
  
</div>

<div class="one_full">
<section class="title blue">
       <h4> Add Lessons to (Module Name)</h4>
</section>

<section class="item">
    <div class="content">
<div class="form_inputs">
            
    <fieldset>
        <ul>
            
            <div class="one_half" style="float:left">                            
            <li>
                <label class="lbl_modTitle" > Lesson Title  <span>*</span></label>
					 <div class="input"><?php echo form_input(
                                                 array('class'=> 'input_modTitle',
                                                            'name'=>'input_modTitle[1]')) ?></div>
                </li>
                
                    <li>
                        <label> Upload Topics (.XML) </label> 
                        <div class="input"><?php echo form_upload('image', $item->image['image'], 'class="width-15" id="upload"'); ?></div>
                         <a class="btn green addtoTableL"> Add Topic</a>
                       
                         
                        </li>
                      <input type="hidden" id="currentmodule" value="<?php echo $modulename?> >"/>
        <input type="hidden" id="baseurl" value="<?php echo site_url('admin/syllabus/add_to_lessons')?>"/>
                 </div>     
               <div class="one_half" style="float: left">
                   
                  
                   
                                           <table id="table_id">
    <thead>
        <tr>
            <th>Lesson Title</th>
            <th>Topics</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
       
        <tr>
            
        </tr>
    </tbody>
</table>
                                        </div>
</ul>
        
        
    </fieldset>	
</div>
    <div class="buttons"> 
        

    <a class="btn gray" href="<?php echo site_url('admin/syllabus/moduleForm/')?>"> Back </a>
  </div>
        </div>
</section>

</div>
