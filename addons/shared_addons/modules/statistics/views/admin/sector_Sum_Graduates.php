<pagefooter name="myFooter" content-left="Date Created: {DATE j-m-Y}" content-right="Page {PAGENO}" line="1"
footer-style="color:black; font-size:8pt" />


<setpagefooter name="myFooter" page="O" value="on" />
<sethtmlpageheader name="myHTMLHeader1" page="O" value="on" show-this-page="1" >
<htmlpageheader name="myHTMLHeader1" style="">



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
<td></td>
    </tr>
   
    </table>
    <table width="100%">
        <tr>
            <td width="25%"></td>
            <td width="50%" style="text-align:center"><h2 style="border:none">Sector Detailed Report <br/>
                <small style="font-weight:normal; font-size:10pt;text-transform: none"> For the <?php if($mon !=0) :?> Month of <?php echo date("F", mktime(0, 0, 0, $mon, 10)); ?><?php else: ?><?php echo 'Year ' ?><?php endif; ?> <?php echo $year ?> </small>
                </h2></td>
            <td width="25%"></td>
        </tr>
        
        
    </table>

<table width="100%">
     <tr>
            <td width="25%"></td>
            <td width="50%" style="text-align:center"><h3 style="border:none; font-size:16pt;font-weight: normal"><?php echo $sectName ?> <b>Graduates</b></h3></td>
            <td width="25%"></td>
        </tr>
    
    
</table>
    </htmlpageheader>
    <!-- end header-->
<!--body-->
    

<?php foreach($cNames as $cn):?>
<table  style="width:100%;border-collapse:collapse;"  >
     <tr>
         <td style=" border-bottom: 0.055cm solid #4C6169;" ><h4> <?php echo $cn['title'] ?><?php if($cn['status']== 'draft'):?><?php echo ' (Draft)' ?><?php endif?></h4></td>
         
        </tr>
       
</table>
<table width='100%'>
    <thead>
        <tr>
            <th width='50%' style=" border-bottom: 0.035cm solid #D3D3D3;"></th>
            <th width='25%' style=" border-bottom: 0.035cm solid #D3D3D3;">Date Enrolled</th>
            <th width='25%' style=" border-bottom: 0.035cm solid #D3D3D3;">Date Finished</th>
            <th width='25%' style=" border-bottom: 0.035cm solid #D3D3D3;">Course Duration</th>
           
        </tr>
    </thead>
    <tbody>
        <?php foreach ($enrDets[$cn['id']] as $ed):?>
        <tr>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"><?php foreach($enrNames[$ed['learnerID']] as $en):?><?php echo $en['name'] ?><?php endforeach; ?></td>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"><?php echo format_date($ed['dateStarted']) ?></td>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"><?php echo format_date($ed['dateFinished']) ?></td>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"> <?php if($ed['dateFinished'] != '' ) :?>
                <?php $start = new DateTime($ed['dateStarted']); ?>
                <?php $end = new DateTime($ed['dateFinished']); ?>
          
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
                <?php else:?>
                <?php echo 'Following Course' ?>
                <?php endif ?></td>
          
        </tr>
         <?php endforeach; ?>
      
        
    </tbody>
</table>
<?php endforeach; ?>
<!--end-->




<!--<table  style="width:100%;border-collapse:collapse;"  >
     <tr>
         <td style=" border-bottom: 0.055cm solid #4C6169;" ><h4> Computer Hardware Servicing</h4></td>
         
        </tr>
       
</table>
<table width='100%'>
    <thead>
        <tr>
            <th width='50%' style=" border-bottom: 0.035cm solid #D3D3D3;"></th>
            <th width='25%' style=" border-bottom: 0.035cm solid #D3D3D3;">Date Enrolled</th>
            <th width='25%' style=" border-bottom: 0.035cm solid #D3D3D3;">Status</th>
           
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"> Jan Marvin Tee</td>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;">10/20/2012</td>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"> Following Course</td>
          
        </tr>
            <tr>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"> Jan Marvin Tee</td>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;">10/20/2012</td>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"> Following Course</td>
          
        </tr>
          <tr>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"> Jan Marvin Tee</td>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;">10/20/2012</td>
            <td style=" border-bottom: 0.035cm solid #D3D3D3;border-left: 0.035cm solid #D3D3D3;border-right: 0.035cm solid #D3D3D3;"> Following Course</td>
          
        </tr>
         <tr>
             <td></td>
            <td> No. of Following Course:</td>
            <td> 10 </td>
        </tr>
         <tr>
             <td></td>
            <td> No. of Ready for Assessment:</td>
            <td> 10 </td>
        </tr>
         <tr>
             <td></td>
            <td> No. of Candidate for Certification:</td>
            <td> 10 </td>
        </tr>
        
        
    </tbody>
</table>-->
