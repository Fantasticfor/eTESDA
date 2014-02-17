

<div class=" container offsetdown">
     <div class="span6 offset2">
    

      <div class="span7 well">
    
	<h3 >Give us a Feedback!</h3>

<?php echo form_open('learner/getFeedback') ?>
        
        <div class="control-group">
                           <div class="controls">   
  <?php            echo form_input(array('type'=>'text', 'placeholder'=>'Title', 'name'=>'title'));?>
                               </div>
       </div>    
        {{if example:logged_in}}
        
        {{else}}
        <div class="control-group">
                           <div class="controls">   
  <?php            echo form_input(array('type'=>'text', 'placeholder'=>'E-mail Address', 'name'=>'email'));?>
                               </div>
       </div>
        {{endif}}
        <div class="control-group">
                           <div class="controls">   
  <?php  echo form_textarea(array('placeholder'=>'Message', 'name'=>'feedback'));?>
                               </div>
       </div>                
                    
        <button class="btn btn-success" type="submit">Send</button>            
     	<?php echo form_close(); ?>   
       
                  
     </div>
</div>
</div>