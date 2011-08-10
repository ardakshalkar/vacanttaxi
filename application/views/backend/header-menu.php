<h1><a href=""><span>Вакант админ</span></a></h1>

<ul id="mainNav">
    <li><?php echo anchor('backend/index','Главная'); ?></li>
    
	<?php if($this->session->userdata['admin_type'] >= SUPERADMIN): ?>
    	<li><?php echo anchor('backend/manage_admin_users/0','Администраторы'); ?></li>
    <?php endif; ?>
    
    <?php if($this->session->userdata['admin_type'] >= ADMIN): ?>
    	<li><?php echo anchor('backend/manage_users/0','Пользователи'); ?></li>  
    <?php endif; ?>  
    
    <?php if($this->session->userdata['admin_type'] == COMPANY): ?>
    	<li><?php echo anchor('backend/manage_dispatchers','Диспетчеры'); ?></li>
        <li><?php echo anchor('backend/manage_company_drivers','Водители'); ?></li>
        <li><?php echo anchor('backend/company_profile','Параметры компании'); ?></li>
        <li><?php echo anchor('backend/statistics','Статистика заказов'); ?></li> 
    <?php endif; ?>
    
    <?php if($this->session->userdata['admin_type'] == DISPATCHER): ?>
    	<li><?php echo anchor('backend/edit_dispatcher','Профиль'); ?></li>
        <li><?php echo anchor('backend/manage_orders','Заказы'); ?></li>
        <li><?php echo anchor('backend/map','Карта'); ?></li>
    <?php endif; ?>
       
    <li class="logout"><?php echo anchor('backend/login/logout','Выйти'); ?></li>
</ul>
