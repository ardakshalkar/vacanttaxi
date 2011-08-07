<?php 
	echo validation_errors();
      if(isset($image_error_message)) echo $image_error_message;
      $attributes = array('class' => 'email', 'id' => 'regform');
	  echo form_open_multipart("front/register",$attributes); ?>
<table>
<tbody>

<tr >
<td class="regtd">Login</td>
<td><?php echo form_input(array('name'=>'login')); ?></td>
</tr>
<tr >
<td class="regtd">Email</td>
<td><?php echo form_input(array('name'=>'email')); ?></td>
</tr>
<tr >
<td class="regtd">Surname</td>
<td><?php echo form_input(array('name'=>'surname')); ?></td>
</tr>

<tr>
<td class="regtd">Name</td>
<td><?php echo form_input(array('name'=>'name')); ?></td>
</tr>
	
<tr>
<td class="regtd">Middlename</td>
<td><?php echo form_input(array('name'=>'middlename')); ?></td>
</tr>

<tr>
<td class="regtd">Address</td>
<td><?php echo form_input(array('name'=>'address')); ?></td>
</tr>

<tr>
<td class="regtd">Date of birth</td>
<td><select name="birthDate_d">
          <option value=""></option>
<?php
          for($i=1; $i<=31; $i++) {
?>                
          <option value="<?php echo $i; ?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></option>
<?php
          }
?>                
              </select>
              <select name="birthDate_m">
          <option value=""></option>
<?php
          for($i=1; $i<=12; $i++) {
?>                
          <option value="<?php echo $i; ?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></option>
<?php
          }
?>                
              </select>
              <select name="birthDate_y">
          <option value=""></option>
<?php
          for($i=date("Y"), $n=date("Y")-70; $i>=$n; $i--) {
?>                
          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
          }
?>                
              </select>
      </td>
    </tr>

<tr>
<td class="regtd">Phone:</td>
<td><?php
$data = array(
              'name'        => 'h_phone',
              'id'          => 'tel',
              'value'       => '8727',
              'maxlength'   => '11'
            );

echo form_input($data);?>
</td>
</tr>
<tr>
    <td class="regtd">Mobile:</td>
    <td><?php
$data = array(
              'name'        => 'm_phone',
              'id'          => 'cell',
              'value'       => '+7',
              'maxlength'   => '12'
            );

echo form_input($data);?>
</td>
</tr>

<tr>
    <td class="regtd">License:</td>
    <td><?php
$data = array(
              'name'        => 'no_li',
              'id'          => 'no_li',
              'value'       => '',
              'maxlength'   => '11'
            );

echo form_input($data);?>
</td>
</tr>
<tr>
    <td class="regtd">Category:</td>
    <td><?php 
    $options = array(
                  '0001'  => 'A',
                  '0011'    => 'B',
                  '0111'   => 'C',
                  '1111' => 'D'
                );

echo form_dropdown('category', $options, '0001'); ?>
    <?php 
    $years = array(
                  '0'  => 'нет опыта',
                  '1'    => '1-3',
                  '2'   => '3-10',
                  '3' => '>10'
                );

echo form_dropdown('experience', $years, '0'); ?>
    </td>
</tr>
<?php echo form_open_multipart('upload/do_upload');?>
<tr>
    <td class="regtd">Photo: </td>
	<td><input type="file" name="userfile" size="10" /></td>
</tr>
</form>
<tr>
<td class="regtd">Password:</td>
<td><?php echo form_password(array('name'=>'password')); ?></td>
</tr>

<tr>
<td class="regtd">Confirm:</td>
<td><?php echo form_password(array('name'=>'passconf')); ?></td>
</tr>


<tr>
<td align="center" colspan="2">
<?php echo form_submit("send","Send"); ?>
<?php echo form_submit("cancel","Cancel");?></td>
</tr>
</tbody></table> 
</form>

