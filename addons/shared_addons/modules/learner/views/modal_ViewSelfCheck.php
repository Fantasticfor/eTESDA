<h4><?php echo $scHis[0]['title']; ?> Self-Check</h4>
<hr>
<table class="table">
    
    <tbody>
    <th>Date</th>
    <th> Score</th>
    <?php foreach($scHis as $sch):?>
    <tr>
        <td><?php echo format_date($sch['dateTaken']); ?></td>
        <td><?php echo $sch['result']; ?>/<?php echo $sch['noOfItems']; ?></td>
    </tr>
   <?php endforeach; ?>
</tbody>
</table>