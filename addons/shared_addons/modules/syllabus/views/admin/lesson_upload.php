  <div class="one_full" > 
      <fieldset>
      <legend> Add Topics </legend>
               <?php echo form_open_multipart('admin/syllabus/uploadTopics/'.$lessonid) ?>
                    <li>
                        <label> Upload Topics (.XML) </label> 
                     <div class="input"><?php echo form_upload('image1'); ?></div>
                        <button class="btn blue "> Save</button>
                         <?php echo form_close(); ?>
                        </li>
                      
        </fieldset>
                 </div>     