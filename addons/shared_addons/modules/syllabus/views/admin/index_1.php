
<div class="one_full">
 
        
        
    <div class="one_full"> 
        <section class="title syllabus">
            <h4 class="syllabus">Choose a Sector </h4>
        </section>
        
        <section class="item">
<div class="container">
            <fieldset>
                <legend> </legend>
                <input type="hidden" id="siteurl" value='<?php echo site_url();?>'>
                
                <div id="sdropdown"><?php 
                
                $js = ' ';
                echo form_dropdown('sectors', $sectors,'',$js ) ?>
            </div>
                
                   
                <fieldset>
                    <legend id="sec-courses"> Information Technology </legend>

                    <ul>
                    <li>
                        <?php //echo Asset::img('sector_blue/sector_ICT.png', 'alt text',array('width'=>80, 'height'=>80) );?>
                    </li>
                    <br>
                    
                  
                    <li>
                        <label>Sector Description</label>
                        <p>
                            Information technology (IT) is the application of computers and telecommunications equipment to store, retrieve, transmit and manipulate data, often in the context of a business or other enterprise. The term is commonly used as a synonym for computers and computer networks, but it also encompasses other information distribution technologies such as television and telephones. Several industries are associated with information technology, such as computer hardware, software, electronics, semiconductors, internet,telecom equipment, e-commerce and computer services
                        </p>
                    </li>
                    <li>
                      <a class="btn blue" href='<?php echo site_url('admin/syllabus/courseForm')?>' > Create Course</a>
                        <input class="btn gray" value=" Edit Sector Details">
                        
                    </li>
                </ul>
                    
                </fieldset>
            
            
            </fieldset>	
    </div>
        </section>
            
    </div>	
                
            
      
    
    <div class="one_half " > 
             
		<section class="title syllabus">
			<h4 class="syllabus"> Information Technology Courses</h4>
                        
		</section>
		
		<section class="item">
			<div class="content">
				<div id="page-list">
				<ul class="sortable sector">
                                    
                                    
                                 <!-- sample nodes -->
                                    <li id =" sector_1">
                                      <div > <a  rel="1" href="#">
                                              
                                              Computer Hardware Servicing</a> 
                                             <span class="label label-success">live</span> 
                                          
                                          <span class="label label-lastupdate"><em> Last update 10/20/2012, 7:30pm </em> </span>
                                      </div>
                                        
                                           <ul class="sortable course" >
                                               <li >
                                                   <div> <a rel="2" href="#"> Installing Computers and Networks</a>
                                                       <span class="label label-lastupdate">draft</span>
                                                       <span class="label label-lastupdate"><em> Last update 10/20/2012, 7:30pm </em></span> </div>
                                                            <ul class="sortable module" >
                                                         <li>
                                                            <div  ><a  rel="3" href="#"> module</a> </div>
                                                          
                                                                <ul class="sortable lesson" >
                                                             <li>
                                                                <div  ><a rel="4" href="#"> Lesson </a> </div>
                                                                    
                                                                  <ul class="sortable topic"  >
                                                             <li>
                                                                <div  ><a rel="5" href="#"> topic</a> </div>


                                                             </li> 
                                                       </ul>      
                                                                
                                                                

                                                             </li> 
                                                       </ul>      

                                                         </li> 
                                                   </ul>          
                                           
                                               </li> 
                                         </ul>
                                    
                                    </li>
				</ul>
				</div>
                            
                            
			</div>
		</section>
	</div>
	
     
    
	<div class="one_half last" >
             
             
<section class="title syllabus">
			<h4>(course,module,lesson,topic label here) </h4> 
		</section>

<section class="item">
<div class="content">

<?php echo form_open_multipart() ?>





	
	<div class="form_inputs" id ="page-details">
	
	</div>

	

	
	



</div>
</section>
             
		
	
	</div>
</div>