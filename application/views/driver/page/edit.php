<div id="editDiv">

<?php echo $this->form_validation->error_string();
      if(isset($success_message)) echo $success_message;
      $attributes = array('class' => 'email', 'id' => 'regform');
	  echo form_open("front/driver_edit",$attributes); ?>
<table>
<tbody>

<tr >
<td>Логин</td>
<td width="150px"><?php echo form_input(array('name'=>'login','value'=>$user['login'])); ?></td>
</tr>

<tr >
<td>Фамилия</td>
<td><?php echo form_input(array('name'=>'lname','value'=>$driver['lastname'])); ?></td>
</tr>

<tr>
<td>Имя</td>
<td><?php echo form_input(array('name'=>'name','value'=>$driver['firstname'])); ?></td>
</tr>
	
<tr>
<td>Очество</td>
<td><?php echo form_input(array('name'=>'mname','value'=>$driver['middlename'])); ?></td>
</tr>

<tr>
<td>Адресс</td>
<td><?php echo form_input(array('name'=>'address','value'=>$driver['address'])); ?></td>
</tr>

<tr>
<td>Дата рождения</td>
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
<td>Телефон:</td>
<td><?php
$data = array(
              'name'        => 'tel',
              'id'          => 'tel',
              'value'       =>$driver['h_phone'],
              'maxlength'   => '11'
            );

echo form_input($data);?>
</td>
</tr>
<tr>
    <td>Сотовый:</td>
    <td><?php
$data = array(
              'name'        => 'cell',
              'id'          => 'cell',
              'value'       => $driver['m_phone'],
              'maxlength'   => '12'
            );

echo form_input($data);?>
</td>
</tr>

<tr>
    <td>Номер прав:</td>
    <td><?php
$data = array(
              'name'        => 'no_li',
              'id'          => 'no_li',
              'value'       => $driver['no_license'],
              'maxlength'   => '11'
            );

echo form_input($data);?>
</td>
</tr>
<tr>
    <td>Категория прав:</td>
    <td><?php 
    $options = array(
                  '0001'  => 'A',
                  '0011'    => 'B',
                  '0111'   => 'C',
                  '1111' => 'D'
                );

echo form_dropdown('category', $options, $driver['category']); ?>
    <?php 
    $years = array(
                  '0'  => 'нет опыта',
                  '1'    => '1-3',
                  '2'   => '3-10',
                  '3' => '>10'
                );

echo form_dropdown('exp', $years, $driver['experience']); ?>
    </td>
</tr>
<tr>
<td>Пароль</td>
<td><?php echo form_password(array('name'=>'pass','value'=>$user['password'])); ?></td>
</tr>

<tr>
<td>Подтвердите</td>
<td><?php echo form_password(array('name'=>'passconf','value'=>$user['password'])); ?></td>
</tr>


<tr>
<td align="center" colspan="2">
<?php echo form_submit("send","Cохранить"); ?>
<?php echo form_submit("cancel","Отменить");?></td>
</tr>
</tbody></table> 
</form>



</div>
