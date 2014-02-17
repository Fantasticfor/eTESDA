
<div class="one_full" style="height:400px">
    <div style="padding:20px">
        
        
        <p><h3><?php foreach ($feedbacks as $fb):?> <?php echo $fb['title'] ?> </h3>
        <br>
        <span><em>by 
            <?php if($fb['learnerID'] == NULL):?>
                            <?php echo $fb['email']; ?>
                       <?php else:?>
                            <?php foreach($feedLearner as $fl): ?>
                                    <?php echo $fl['firstname'].' '.$fl['lastname'] ?>
                                
                            <?php endforeach; ?>
                       <?php endif; ?> </em> </span> 
        
        </p>
              
        <hr>
        <label> Feedback</label><br>
        <p style="width: 693px;
height: 177px;
margin: 5px 0px;"><?php echo $fb['feedback'] ?></p>
        <?php endforeach; ?>
    </div>
    
    
    </div>