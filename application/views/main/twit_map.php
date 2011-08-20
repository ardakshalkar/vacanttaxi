<?php 
   $nameArea = array(
    'name'  => 'nameArea',
    'id'    => 'nameArea',
    'placeholder' => 'Имя..',
    'width' => '50',
    'value' => ''
   );
   $comment = array(
    'name' => 'commentArea',
    'id'   => 'commentArea',
    'cols' => '25',
    'rows' => '2',
    'placeholder' => 'Текст комментария...',
    'value'=> ''
   );
?>


<ul id="<?php echo $ulid;?>">    
	<?php 
	if (count($messages)==0) :?>
		<li><span class="twit_info">нет сообщений, добавьте сообщение нажав на кнопку расположенную ниже</span></li>
	<? endif;?>
   <?php for ($i=0;$i<count($messages);$i++){?>
     <li>
      <span class="twit_name"><?php echo $messages[$i]['name'];?></span><br/>
      <span class="twit_message"><?php echo $messages[$i]['message'];?></span><br/>
      <span class="twit_from">(A) <?php echo $messages[$i]['from'];?></span> 
      <span class="twit_to">(B) <?php echo $messages[$i]['to'];?></span>
      <span class="twit_contacts">(T) <?php echo $messages[$i]['contacts'];?></span><br/>
      <span class="twit_date" title="<?php echo $messages[$i]['date'];?>"><?php echo $messages[$i]['date'];?></span>
                        <span class="twit_comment">
							<? 
								$comments_amount = count($messages[$i]['comments']);
								if ($comments_amount==0)
									echo "оставить комментарий";
								else if ($comments_amount>9&&$comments_amount<20)
									echo $comments_amount." комментариев";
								else if ($comments_amount%10==1&&$comments_amount!=11)
									echo $comments_amount." комментарий";
								else if ($comments_amount%10>0&&$comments_amount%10<5)
									echo $comments_amount." комментария";
								else
									echo $comments_amount." комментариев";
									
							?>
						</span><br/>
                        <div class="commentsDiv" style="display:none">
							<ul id="<?php echo $messages[$i]['id'];?>">
							<?php if (count($messages[$i]['comments'])>0) : ?>
									<?php foreach ($messages[$i]['comments'] as $comm){?>
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
							echo form_hidden('id',$messages[$i]['id']);
							
							?>
							<?php echo form_submit(array('name'=>'send_comment'),'Отправить');   
							echo form_close();?>
                        </div>
                     
     </li>
   <?php } ?>   
</ul> 
