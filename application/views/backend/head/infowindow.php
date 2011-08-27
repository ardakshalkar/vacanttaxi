<div class = "infowindow" style="height:90px;width:185px;">
<?php foreach($a['company'] as $company){?>
<img src="<?php echo $company->logo;?>" style="float:left; width:75px; height:70px; padding-right:5px; overflaw:hidden;" alt="company photo">
<h3><?php echo $company->company_name; ?></h3>
<?}?>
<h4>Driver: <?php echo $a['c_name']; ?></h4>
<p>Status: <?php $status='';
if($a['status']==4111){$status= 'free'; echo $status;}
else if($a['status']==4112){$status= 'busy'; echo $status;}
else if($a['status']==4113){$status= 'lunch'; echo $status;}?>
</p>
</div>
