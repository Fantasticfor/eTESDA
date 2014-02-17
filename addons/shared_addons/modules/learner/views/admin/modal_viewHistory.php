<h4> <?php echo $scHis[0]['title']; ?></h4>
<label> No.Of Attempts: <span class="label label-success"> <?php echo $att[0]['count']; ?></span></label>
<hr>
<table>
    <tbody>
    <th>Date</th>
    <th>Score</th>
    <?php foreach($scHis as $histo): ?>
    <tr> 
        <td> <?php echo format_date($histo['dateTaken']); ?></td>
        <td> <?php echo $histo['result']; ?>/<?php echo $histo['noOfItems']; ?></td>
    </tr>
    <?php endforeach; ?>
        
    </tbody>
</table>
   
    
   
