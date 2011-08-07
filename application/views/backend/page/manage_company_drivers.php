<!-- h2 stays for breadcrumbs -->
<h2>
	<?php echo anchor('/backend/index','Бакенд'); ?>  &raquo; 
    <?php echo anchor('/backend/manage_company_drivers','Водители',array('class'=>'active')); ?>
</h2>

<div id="main">
<br/>
	<table>
	<?php for ($i=0;$i<count($manage_company_drivers);$i++){ ?>
	<tr>
    	<?php foreach ($manage_company_drivers[$i]['driver_profile'] as $taxist){?>
		<td><?php echo $taxist->c_name; ?></td>
        <td class="action">
               <?php echo anchor('backend/view_company_driver/'.$taxist->id,
			   							'Просмотр',array('class'=>'view')); ?>
               
               <?php echo anchor('backend/edit_company_driver/'.$taxist->id,
			   							'Редактировать',array('class'=>'edit')); ?>
                                        
               <?php echo anchor('backend/delete_company_driver/'.$taxist->id,
			   							'Удалить',array('class'=>'delete')); ?>
        </td>
    </tr>
	<?php } 
		}
	?>
    </table>
<br/>
</div>

<div class="clear"></div>
