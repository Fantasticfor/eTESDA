
<div class="one_full">
   <section class="title blue "> <h4> Lesson Creator </h4></section>    
    <section class="item">
        
      <div class="content">
	
          <div class="one_full">
              
			
                <ul>
                    <li class="<?php echo alternator('', 'even'); ?>">
				<label for="title">Lesson Title <span>*</span></label>
				<div class="input"><?php echo form_input('lessontitle',$item->title, 'style="width:350px" id="lessonTitle"'); ?></div>
                    </li>
                    
                    <li class="<?php echo alternator('', 'even'); ?>">
				<label for="title">Topic Title <span>*</span></label>
				<div class="input"><?php echo form_input('title',$item->title, 'style="width:350px" id="topicTitle"'); ?></div>
			</li>

                  <div class="one_half">
                  
                  <div class="form_inputs">
                     
			
			<li class="<?php echo alternator('', 'even'); ?>">
                           
                           
				<label for="description">Text <span>*</span></label>
				<div class="input"><?php echo form_textarea('description', $item->description,'class="wysiwyg-advanced" id="text"', 'style="width: 400px; height: 100px" cols="50"'); ?></div>
                                <?php echo  form_hidden('id', $item->id) ?>
                                
			</li>
                        
                    
                       
                               
		
                      
                        
                   
                    
		
		
		</div>
              </div>    
              <div class="one_half">
                     <li class="<?php echo alternator('','even');?>"> 
                            <label for="userfile">Youtube Embedded Video link</label> 
                           <div class="input"><?php echo form_input('video_link[]', NULL, 'id="input_cl" class = "links input_cl" style="width:300px"'); ?>
                                <div id="othLink"></div>
                                  
                               <a  class="" id="addClone" style="margin-top:-8px"> Add more links</a>
                           </div>
               
                     </li>   
                        <br>
            
	  <div style="">
              <hr>
           <a class="btn blue addtoTable" >Add to Queue</a> 
          </div>  
              </div>    
              
              </ul>
              
             	
		
	</div>	
          <div class="one_full">
              <table id="topicTable">
                      <thead>
                      <th>Topic Title</th>
                      <th></th>
                  
                    </thead>
                      <tbody>

               <?php
                if(isset($_SESSION['xml']) && is_array($_SESSION['xml'])){
                  foreach($_SESSION['xml'] as $key=>$input){
              ?> 
        <tr>
            <td><?php echo $input['topic'][0]; ?></td>
            
           <td><a class="btn btn-lesson red" id="removeaw"> Remove</a> <input type='hidden' id='indexid' value="<?php echo $key ?>"/></td>
            
        </tr>
        
        <?php
    }
  }else{
?> 
        <tr></tr> 
        
       <?php
  }?> 
                      </tbody>
                  </table>
                <div class="buttons">
                    <a class="btn blue" target="_blank" id="btnxml" href ="<?php echo site_url('admin/xmlGenerator/redirDL'); ?>"> Export XML</a>
<!--                    <button class="btn blue" id="btnxml" >Export XML</button>-->
              
                    <a class="btn gray"> Reset</a>
		</div>
          </div>
          
          
	<?php echo form_close(); ?>
         <input type="hidden" id="baseurl" value="<?php echo site_url('admin/xmlGenerator/addXMLTopic')?>"/>   
        <input type="hidden" id="removeurl" value="<?php echo site_url('admin/xmlGenerator/remove')?>"/>
        <input type="hidden" id="lesTitleSes" value="<?php echo $_SESSION['lessonTitle']?>"/>
</div>


	<br>

        
    </section>
  
    
    
    </div>
    
    
