<section class="title">
	<h4><?php echo lang('sylla:syllabus'); ?></h4>
</section>

<section class="item">
<div class="content">

	<?php if ($syllabi['total'] > 0): ?>
	
		<table class="table" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th><?php echo lang('sylla:title'); ?></th>
					<th><?php echo lang('sylla:question'); ?></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($syllabi['entries'] as $faq): ?>
				<tr>
					<td><?php echo $faq['title']; ?></td>
					<td><?php echo $faq['description']; ?></td>
					<td class="actions"><?php echo anchor('admin/Syllabus/edit/' . $faq['id'], lang('global:edit'), 'class="button edit"'); ?>
                                            <?php echo anchor('admin/Syllabus/delete/' . $faq['id'], lang('global:delete'), array('class' => 'confirm button delete')); ?>
                                        </td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		<?php echo $syllabi['pagination']; ?>
		
	<?php else: ?>
		<div class="no_data"><?php echo lang('faq:no_faqs'); ?></div>
	<?php endif;?>
	
</div>
</section>