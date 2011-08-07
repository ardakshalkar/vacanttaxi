<?php
$beaconpush->add_channel('taxi'); 
echo $beaconpush->embed();
?>     
<?php 
   $nameArea = array(
    'name'  => 'nameArea',
    'id'    => 'nameArea',
    'placeholder' => 'Name..',
    'width' => '50',
    'value' => ''
   );
   $comment = array(
    'name' => 'commentArea',
    'id'   => 'commentArea',
    'cols' => '25',
    'rows' => '2',
    'placeholder' => 'Leave Comment...',
    'value'=> ''
   );
?>
<div id="msgs">
 <div id="taxist_msg">
 <h3>Подвезу</h3>
     <ul id="show_msgT">    
   <?php for ($i=0;$i<count($taxist_msg);$i++){?>
     <li>
      <span class="twit_name"><?php echo $taxist_msg[$i]['name'];?></span><br/>
      <span class="twit_message"><?php echo $taxist_msg[$i]['message'];?></span><br/>
      <span class="twit_from">(A) <?php echo $taxist_msg[$i]['from'];?></span> 
      <span class="twit_to">(B) <?php echo $taxist_msg[$i]['to'];?></span>
      <span class="twit_contacts">(T) <?php echo $taxist_msg[$i]['contacts'];?></span><br/>
      <span class="twit_date" title="<?php echo $taxist_msg[$i]['date'];?>"><?php echo $taxist_msg[$i]['date'];?></span>
						
                        <span class="twit_comment">
							<? 
								$comments_amount = count($taxist_msg[$i]['comments']);
								if ($comments_amount>0)
									echo $comments_amount." Comments";
								else
									echo "leave comment";
							?>
						</span><br/>
                        <div class="commentsDiv" style="display:none">
							<ul id="<?php echo $taxist_msg[$i]['id'];?>">
							<?php if (count($taxist_msg[$i]['comments'])>0) : ?>
									<?php foreach ($taxist_msg[$i]['comments'] as $comm){?>
									<li>
									  <span class="commentator_name"><?php echo $comm->name.":";?></span>
									  <span class="comment"><?php echo $comm->text;?></span><br/>
									  <span class="twit_date" title="<?php echo $comm->date;?>"><?php echo $comm->date;?></span><br/>
									</li>
									<?php } ?> 
								
							<?php endif;?>
							</ul>
						   <?php $attributes = array('class' => 'leave_comment');
							echo form_open_multipart("front/leaveComments",$attributes);
							if (!$this->session->userdata('user_id'))
								echo form_input($nameArea).br();
							echo form_textarea($comment).br();
							echo form_hidden('id',$taxist_msg[$i]['id']);
							
							?>
							<?php echo form_submit(array('name'=>'send_comment'),'Send');   
							echo form_close();?>
                        </div>
                     
     </li>
   <?php } ?>   
        </ul>
        
    </div>
    <div id="client_msg">
 <h3>Подвезите</h3>
     <ul id="show_msgС">    
   <?php for ($i=0;$i<count($client_msg);$i++){?>
     <li>
      <span class="twit_name"><?php echo $client_msg[$i]['name'];?></span><br/>
      <span class="twit_message"><?php echo $client_msg[$i]['message'];?></span><br/>
      <span class="twit_from">(A) <?php echo $client_msg[$i]['from'];?></span> 
      <span class="twit_to">(B) <?php echo $client_msg[$i]['to'];?></span>
      <span class="twit_contacts">(T) <?php echo $client_msg[$i]['contacts'];?></span><br/>
      <span class="twit_date" title="<?php echo $client_msg[$i]['date'];?>"><?php echo $client_msg[$i]['date'];?></span>
						
                        <span class="twit_comment">
							<? 
								$comments_amount = count($client_msg[$i]['comments']);
								if ($comments_amount>0)
									echo $comments_amount." Comments";
								else
									echo "leave comment";
							?>
						</span><br/>
                        <div class="commentsDiv" style="display:none">
							<ul id="<?php echo $client_msg[$i]['id'];?>">
							<?php if (count($client_msg[$i]['comments'])>0) : ?>
									<?php foreach ($client_msg[$i]['comments'] as $comm){?>
									<li>
									  <span class="commentator_name"><?php echo $comm->name.":";?></span>
									  <span class="comment"><?php echo $comm->text;?></span><br/>
									  <span class="twit_date" title="<?php echo $comm->date;?>"><?php echo $comm->date;?></span><br/>
									</li>
									<?php } ?> 
							
							<?php endif;?>
						   </ul>
						   <?php $attributes = array('class' => 'leave_comment');
							echo form_open_multipart("front/leaveComments",$attributes);
							if (!$this->session->userdata('user_id'))
								echo form_input($nameArea).br();
							echo form_textarea($comment).br();
							echo form_hidden('id',$client_msg[$i]['id']);
							
							?>
							<?php echo form_submit(array('name'=>'send_comment'),'Send');   
							echo form_close();?>
                        </div>
                     
     </li>
   <?php } ?>   
        </ul>
        
    </div>
    <div id="dialog-form" title="Leave message">
       	<?php 
			$id = $this->session->userdata('user_id');
//			echo $id;
			if($id){
				$contact = $user->contacts;
//				print_r($user);
				echo $contact;
			}
			else{
				$name = '';$contact = '';
				$name = array(
					'name'  => 'name',
					'id'    => 'name',
					'class' => 'text ui-widget-content ui-corner-all', 
					'value' => $name
				);
			}
			echo form_open("unofficialOrder",array('name' => 'unoffOrder', 'id' => 'unoffOrder'));
			
			
			$contacts = array(
				'name'  => 'contacts',
				'id'    => 'contacts',
				'class' => 'text ui-widget-content ui-corner-all',
				'value' => $contact
			);
			$from = array(
				'name' => 'from',
				'id'   => 'from',
				'class' => 'text ui-widget-content ui-corner-all',
				'value'=> ''
			);
			$to = array(
				'name' => 'to',
				'id'   => 'to',
				'class' => 'text ui-widget-content ui-corner-all',
				'value'=> ''
			);
			$messages = array(
				'name'  => 'messages',
				'id'    => 'destination',
				'rows'  => '3',
				'class' => 'text ui-widget-content ui-corner-all',
				'value' => ''		
			);
			$radiobox1 = array(
				'name' => 'type',
				'id'   => 'taxistbox',
				'value'=> '1',
				'checked'=>false
			);
			$radiobox2 = array(
				'name' => 'type',
				'id'   => 'clientbox',
				'value'=> '0',
				'checked'=>false
			);

		?>
        <p class="validateTips"></p>
        <fieldset>
        	<legend>Who you are:</legend>
            
            <?php echo form_label('Taxist','taxistbox');?><?php echo form_radio($radiobox1);?>
            
            <?php echo form_label('Client','clientbox');?><?php echo form_radio($radiobox2);?>
            <? if (!$id) : ?>
				<label for="name" id="nlabel">Name:</label>
				<?php echo form_input($name);?>
				
            <? endif; ?>
            <label for="contacts" id="clabel">Contact:</label>
			<?php echo form_input($contacts);?>
            <label for="from" id="flabel">From:</label>
            <?php echo form_input($from);?>
            <label for="to" id="tlabel">To:</label>
            <?php echo form_input($to);?>
           	<label for="destination">Leave message:</label>
            <?php echo form_textarea($messages);?>
        </fieldset>
        <?php echo form_hidden('user_id',($id)?$id:'0');?>
        <?php echo form_close();?>        
    </div>
    <div id="leaveMsg">
    	<input type="submit" value="Leave message" id="msgButton"/>
    </div>
</div>
