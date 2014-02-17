<h4><?php echo $secResults[0]['cTitle']; ?> Online Assessment</h4>
<hr>
<h5> Test Sections</h5>
<table class="table">
    
    <tbody>
    <th>Competency</th>
    <th> Score</th>
    <th> </th>
    <?php foreach($secResults as $sr): ?>
        <?php if($sr['remarks'] == 'Competent'): ?>
    <tr>
        <td><?php echo $sr['title']; ?></td>
        <td><?php echo $sr['result']; ?>/<?php echo $sr['noOfItems']; ?></td>
        <td><label class="text-success"> Competent</label></td>
    </tr>
    <?php else: ?>
    <tr>
        <td><?php echo $sr['title']; ?></td>
        <td><?php echo $sr['result']; ?>/<?php echo $sr['noOfItems']; ?></td>
        <td><label class="text-error"> Needs Review</label></td>
    </tr>
        <?php endif; ?>
   <?php endforeach; ?>
</tbody>
</table>