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
            <td width="50%" style="text-align:center"><h3 style="border:none; font-size:16pt;font-weight: normal">Sector Summary</h3></td>
            <td width="25%"></td>
        </tr>
    
    
</table>
    </htmlpageheader><!--
     end header-->
<!--body-->
    
<table width="100%" border="1">
    <thead>
        <tr>
        <th width="55%">Sector</th>
        <th width="15%">Enrollees</th>
        <th width="15%">Graduates</th>
        <th width="15%">Inactives</th>
        
        </tr>
    </thead>
    
    <tbody>
         <?php foreach ($allSects as $al): ?>
                        <tr>    
                            <td> 
                           <?php echo $al['title']?>  
                        </td>
                            
                            
                               <td> <?php foreach($totEn[$al['id']] as $te):?><strong><?php echo $te ?></strong> Enrollees 
                               
                               <?php endforeach; ?></td>
                               
                               
                               <td><?php foreach($totGr[$al['id']] as $tg):?><strong><?php echo $tg ?></strong> Graduates
                               
                               <?php endforeach; ?></td>
                               
                               
                               <td> <?php foreach($totIn[$al['id']] as $ti):?><strong><?php echo $ti ?></strong> Inactives
                               
                               <?php endforeach; ?></td>
                        </tr>
                   
                            <?php endforeach; ?>
    </tbody>
</table>
    