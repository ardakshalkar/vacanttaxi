<fieldset>
	<legend>Информация о вас в каталоге</legend>
<?= form_open('auth/save_driver') ?>
<table>
	<tr>
		<td>Категория</td>
		<td>
			<?= form_checkbox('category[]','incity',(int)(($profile->category-5000)/100)==1,'id="incity"')?><label for='incity'>По городу</label>
			<?= form_checkbox('category[]','cities',(int)(($profile->category-5000)/10%10)==1,'id="cities"')?><label for='cities'>Междугородние</label>
			<?= form_checkbox('category[]','suburb',(int)(($profile->category-5000)%10)==1,'id="suburb"')?><label for='suburb'>За город</label>
		</td>
	</tr>
	<tr>
		<td>Город</td>
		<td><?= form_dropdown('city',$cities)?></td>
	</tr>
	<tr>
		<td>Опыт</td>
		<td><?= form_input('experience',$profile->experience)?></td>
	</tr>
	<tr>
		<td>Как часто?</td>
		<td>
			<?= form_radio('schedule','1',$profile->schedule=='1','id="once"')?><label for='once'>Единично</label>
			<?= form_radio('schedule','2',$profile->schedule=='2','id="rare"')?><label for='rare'>Часто</label>
			<?= form_radio('schedule','3',$profile->schedule=='3','id="always"')?><label for='always'>Постоянно</label>
		</td>
	</tr>
	<tr>
		<td>Домашний телефон</td>
		<td><?= form_input('h_phone',$profile->h_phone)?></td>
	</tr>
	<tr>
		<td>Сотовый телефон</td>
		<td><?= form_input('m_phone',$profile->m_phone)?></td>
	</tr>
	<tr>
		<td>Адрес</td>
		<td><?= form_textarea('address',$profile->address)?></td>
	</tr>
	<tr>
		<td>Краткое описание ваших услуг, цены и.т.п (например: хорошая машина, в конце недели)</td>
		<td><?= form_textarea('about',$profile->about)?></td>
	</tr>
</table>
<input type="submit" value="Добавить в каталог"/>
</form>
</fieldset>
