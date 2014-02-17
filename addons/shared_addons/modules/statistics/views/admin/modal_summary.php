        
<div style='height:400px; overflow-y:auto'>
    <div class="title blue" style="padding:1px"><h4 style="margin-left: 10px;"> <strong><?php echo $sectName ?> Sector </strong> <small style="color:white">for <?php if($mon != 0) :?><?php echo date("F", mktime(0, 0, 0, $mon, 10)); ?><?php endif; ?> <?php echo $year ?></small><small><a class="btn blue small" style="float:right;margin-top: -10px;
margin-right: 5px;" href="<?php echo site_url('admin/statistics/sectorStat/printRep?sectID='.$sectID.'&mon='.$mon.'&year='.$year.'&type='.$type);?>"> Download</a></small>
                  </h4></div>

                  
              <table>
                  <thead>
                      <tr>
                          <th>Courses</th>
                          <th style="width:100px">Enrollees</th>
                          <th style="width:100px">Graduates</th>
                          <th style="width:100px">Inactives</th>
                          
                          
                      </tr>
                  </thead>
                  <tbody>
   
                     <?php foreach($coNames as $cn):?>
                        <tr>    
                            <td> 
                                <?php echo $cn['title'] ?><?php if($cn['status']== 'draft'):?><?php echo ' (Draft)' ?><?php endif?>
                            </td>
                            <?php foreach($totEn[$cn['id']] as $te):?>
                            <td> 
                                <?php echo $te ?> Enrollees
                            </td>
                            <?php endforeach; ?>
                            
                            <?php foreach($totGr[$cn['id']] as $tg):?>
                            <td> 
                                <?php echo $tg ?> Graduates
                            </td>
                            <?php endforeach; ?>
                            
                            <?php foreach($totIn[$cn['id']] as $ti):?>
                            <td> 
                                <?php echo $ti ?> Inactives
                            </td>
                            <?php endforeach; ?>
                            
                        </tr>
                   <?php endforeach; ?>
                         
                    </tbody>
                  
              </table>
</div>