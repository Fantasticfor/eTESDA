<pagefooter name="myFooter" content-left="Date Created: {DATE j-m-Y}" content-right="Page {PAGENO}" line="1"
footer-style="color:black; font-size:8pt" />


<setpagefooter name="myFooter" page="O" value="on" />
<sethtmlpageheader name="myHTMLHeader1" page="O" value="on" show-this-page="1" />

<htmlpageheader name="myHTMLHeader1" >
<table style="width:100%; border-bottom: 0.010cm solid #000000; ">
    <tr >
        <td width="10%">
 <?php echo Asset::img('TESDA_logo.png', 'alt text',array('width'=>'60px','height'=>'60px') )?>
</td>
<td>
      <h1 style="border:none">
        eTESDA Learn
        <br>
        <small style="font-weight:normal">Technical Education and Skills Development Agency</small>
        </h1>
</td>

    </tr>
   
    </table>
     </htmlpageheader>
    <!-- end header-->
<!--body-->
    <table width="100%" style="margin-top:-10px" >
        <tr>
            <td width="25%"></td>
            <td width="50%" style="text-align:center"><h2 style="border:none">Learner Statistics </h2></td>
            <td width="25%"></td>
        </tr>
        
        
    </table>

<table width="100%">
     <tr>
            <td width="25%"></td>
            <td width="50%" style="text-align:center"><h3 style="border:none; font-size:16pt;font-weight: normal"><?php echo $courseDet[0]['title']; ?>  </h3></td>
            <td width="25%"></td>
        </tr>
    
    
</table>

<table width="100%" style="border-collapse:collapse;">
  
        <th style="width:80%;"></th>
        <th style="width:10%;"></th>
        <th style="width:20%"></th>

    <tr>
        <td >
            <table  style="width:100%; border-collapse:collapse;"  >
    
 
      <tr>
         <td style=" border-bottom: 0.035cm solid #D3D3D3;" >Name:</td>
          <td  style=" border-bottom: 0.035cm solid #D3D3D3;" ><h5><?php echo $learnName ?></h5></td>
          <td></td>
      </tr>
        
      
         
         <?php foreach ($enCourseDets as $lCo):?>
          <tr>
          <td style=" border-bottom: 0.035cm solid #D3D3D3;">Date Enrolled:</td>
          <td style=" border-bottom: 0.035cm solid #D3D3D3;"><?php echo format_date($lCo['dateStarted']) ?></td>
        
          </tr>
           <tr>
           <td style=" border-bottom: 0.035cm solid #D3D3D3;">Date Finished:</td>     
          <td style=" border-bottom: 0.035cm solid #D3D3D3;"><?php if($lCo['dateFinished'] != NULL): ?><?php echo format_date($lCo['dateStarted']) ?><?php else: ?><?php echo 'Not done with course' ?><?php endif ?></td>
        <td> 
           
        </td>
           </tr>
           <tr>
             <td style=" border-bottom: 0.035cm solid #D3D3D3;">Course Duration:</td>     
          <td style=" border-bottom: 0.035cm solid #D3D3D3;">
               <?php if($lCo['dateFinished'] != '' ) :?>
                <?php $start = new DateTime($lCo['dateStarted']); ?>
                <?php $end = new DateTime($lCo['dateFinished']); ?>
                    
               <?php if($end->diff($start)->format("%m") > 0):?>     
                    <?php if($end->diff($start)->format("%m") == 1 || $end->diff($start)->format("%m") == 0): ?> 
                        <?php echo $end->diff($start)->format("%m").' month' ?>
                    <?php else: ?>
                        <?php echo $end->diff($start)->format("%m").' months' ?>
                    <?php endif; ?> 
               <?php elseif($end->diff($start)->format("%d") == 0 && $end->diff($start)->format("%H") == 0):?>     
                    <?php if($end->diff($start)->format("%i") == 1 || $end->diff($start)->format("%i") == 0): ?> 
                        <?php echo $end->diff($start)->format("%i").' minute' ?>
                    <?php else: ?>
                        <?php echo $end->diff($start)->format("%i").' minutes' ?>
                    <?php endif; ?>
               <?php elseif($end->diff($start)->format("%H") >= 1 && $end->diff($start)->format("%i") >= 0 && $end->diff($start)->format("%d") == 0):?>
                    <?php if($end->diff($start)->format("%H") == 1): ?>  
                        <?php echo $end->diff($start)->format("%H").' hour' ?>
                    <?php else: ?>
                        <?php echo $end->diff($start)->format("%H").' hours' ?>
                    <?php endif ?>
               <?php elseif($end->diff($start)->format("%d") >= 0): ?>
                    <?php if($end->diff($start)->format("%d") == 1): ?>  
                        <?php echo $end->diff($start)->format("%d").' day' ?>
                    <?php else: ?>
                        <?php echo $end->diff($start)->format("%d").' days' ?>
                    <?php endif; ?>
               <?php endif;?>
                        <?php else: ?>
                        <?php echo 'Course not done yet' ?>
                <?php endif ?>
              
              
          </td>
      <td>  </td>
           </tr>
           
            
          <?php endforeach; ?>
    
</table> 
        </td>
        
        <td >
         <table>
                <tr>
                    <td>
                        <?php foreach($userPics as $up):?>
                 <?php if($up['picture'] == NULL && $up['smallpicture'] == NULL): ?>
                         <?php echo Asset::img('default_display.png', 'alt text', array('width'=>'80px','height'=>'80px'));?>
                 <?php elseif($up['picture'] == NULL && $up['smallpicture'] != NULL): ?>
                        <img src='<?php echo $up['smallpicture']; ?>' width='80px' height='80px' >
                 <?php elseif($up['picture'] != NULL && $up['smallpicture'] != NULL): ?>
                        <img src='<?php echo $up['picture']; ?>' width='80px' height='80px' >
                <?php endif; ?>
              <?php endforeach; ?>
                        
                   
                    </td>
                </tr>
            </table>
   
        </td>
        
    </tr>
    
</table>
   
 



<table  style="width:100%;border-collapse:collapse; margin-top:50px"  >
     <tr>
         <td style=" border-bottom: 0.055cm solid #4C6169;" ><h4> Competencies</h4></td>
         
        </tr>
       
</table>

<table width='100%'>
    <thead>
        <tr>
            <th width='60%' style=" border-bottom: 0.035cm solid #D3D3D3;"></th>
            <th width='10%' style=" border-bottom: 0.035cm solid #D3D3D3;">Rating</th>
            <th width='10%' style=" border-bottom: 0.035cm solid #D3D3D3;">Duration</th>
        </tr>
    </thead>
    <tbody>
         <?php foreach($mods as $mTitle): ?>
        <tr>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"> <?php echo $mTitle['title'] ?></td>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"> <?php if(!empty($ratings[$mTitle['id']])): ?><?php foreach($ratings[$mTitle['id']] as $a): ?>
                 <?php echo $a['remarks'] ?>  <?php endforeach ?> <?php endif;?></td>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"> <?php foreach($dur[$mTitle['id']] as $duration):?> 
                <?php $start = new DateTime($duration['dateStarted']); ?>
                <?php $end = new DateTime($duration['dateFinished']); ?>
                <?php if($duration['dateFinished'] != ''): ?>
                <?php if($end->diff($start)->format("%d") == 0 && $end->diff($start)->format("%H") == 0):?>     
                    <?php if($end->diff($start)->format("%i") == 1 || $end->diff($start)->format("%i") == 0): ?> 
                        <?php echo $end->diff($start)->format("%i").' minute' ?>
                    <?php else: ?>
                        <?php echo $end->diff($start)->format("%i").' minutes' ?>
                    <?php endif; ?>
               <?php elseif($end->diff($start)->format("%H") >= 1 && $end->diff($start)->format("%i") >= 0 && $end->diff($start)->format("%d") == 0):?>
                    <?php if($end->diff($start)->format("%H") == 1): ?>  
                        <?php echo $end->diff($start)->format("%H").' hour' ?>
                    <?php else: ?>
                        <?php echo $end->diff($start)->format("%H").' hours' ?>
                    <?php endif ?>
               <?php elseif($end->diff($start)->format("%d") >= 0): ?>
                    <?php if($end->diff($start)->format("%d") == 1): ?>  
                        <?php echo $end->diff($start)->format("%d").' day' ?>
                    <?php else: ?>
                        <?php echo $end->diff($start)->format("%d").' days' ?>
                    <?php endif; ?>
               <?php endif;?>
                <?php endif; ?>
                <?php endforeach; ?></td>
        </tr>
        <?php endforeach; ?>
        
        
    </tbody>
</table>

<table  style="width:100%;border-collapse:collapse; margin-top:50px"  >
     <tr>
         <td style=" border-bottom: 0.055cm solid #4C6169;" ><h4> Online Assessment Results</h4></td>
         
        </tr>
       
</table>

<table width='100%'>
    <thead>
        <tr>
            <th width='60%' style=" border-bottom: 0.035cm solid #D3D3D3;"></th>
              <th width='20%' style=" border-bottom: 0.035cm solid #D3D3D3;">Rating</th>
            <th width='20%' style=" border-bottom: 0.035cm solid #D3D3D3;">Remarks</th>
        </tr>
    </thead>
    <tbody>
        <?php $sCount = 1 ?>
        <?php foreach($oaSect as $os1):?>
        <?php foreach($os1 as $os):?>
        <tr>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"> Section <?php echo $sCount ?></td>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"><?php echo $os['result']?>/<?php echo $os['noOfItems'] ?></td>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"><?php if(($os['result']/$os['noOfItems'])*100 >= 60):?><?php echo 'Pass' ?> <?php else: ?> <?php echo 'Fail' ?><?php endif; ?> </td>
            
        </tr>
        <?php $sCount += 1; ?>
        <?php endforeach; ?>
        <?php endforeach; ?>
         <?php foreach($oaRes as $oar): ?>

                  <?php foreach($oar as $resOA):?>
         <tr>
            
             <td></td>
             <td style="text-align:right"><b>Final Score:</b> </td>
             <td ><b>
                     
                     
                     <?php echo $resOA['result']; ?>/<?php echo $resOA['noOfItems']; ?>
                 </b> </td>
         </tr>
         <tr>
             <td></td>
             <td style="text-align:right"><b>Final Rating:</b></td>
             <td> <b><?php if(($resOA['result']/$resOA['noOfItems'])*100 >= 60):?><?php echo 'Pass' ?> <?php else: ?> <?php echo 'Fail' ?><?php endif; ?></b> </td>
         </tr>
        
                 <?php endforeach; ?>
                 <?php endforeach; ?>
         
        
    </tbody>
</table>

<table  style="width:100%;border-collapse:collapse; margin-top:50px"  >
     <tr>
         <td style=" border-bottom: 0.055cm solid #4C6169;" ><h4> Badges Earned</h4></td>
         
        </tr>
       
</table>

<table width='100%'>
    <thead>
        <tr>
            <th width='30%' style=" border-bottom: 0.035cm solid #D3D3D3;"></th>
              <th width='30%' style=" border-bottom: 0.035cm solid #D3D3D3;"></th>
            <th width='40%' style=" border-bottom: 0.035cm solid #D3D3D3;">Activity</th>
        </tr>
    </thead>
    <tbody>
       <?php foreach($allBadges as $ab):?>
        <tr>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"> 
                <?php echo format_date($ab['dateEarned']) ?></td>
            
            
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;">
                
               <?php echo $ab['name'] ?></td>
            
            
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;">
         <?php echo $ab['activity']?> for 
         <?php foreach($cmName[$ab['course']] as $cmn):?>
            <?php echo $cmn ?>
         <?php endforeach; ?>
            </td>
            
        </tr>
        <?php endforeach; ?>
        
    </tbody>
</table>



<table width="100%" style="margin-top:100px">
    <tr>
        <td width="25%"></td>
            <td width="50%" style="text-align:center">
        <?php if($stat == 1):?>
                 <h2 style="border:none; color:#3a87ad;"> [Following Course]</h2></td>
        <?php elseif ($stat == 2):?>
                <h2 style="border:none; color:#c09853;"> [Ready for Assessment]</h2>
        <?php elseif($stat == 3):?>
                <h2 style="border:none; color:#468847;"> [Candidate for Certification]</h2>
        <?php endif; ?>
    
            
            
           
        <td width="25%"></td>
    </tr>
</table>
















