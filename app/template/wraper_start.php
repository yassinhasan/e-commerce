

<body id="allbody">

    <nav class="mainnavbar"> 
        <div class="nav-content">
            <div class="dash-text">
                <h4><a href="/"><?= $dashboard ?></a></h4>
                <a href="/auth/login"> log_in</a>
                <div class="dash-icon">
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div>
                <ul class="notifcation-area">
                    <li class="notification-dropdown user">
                        <a href="#" class="user-name">
                        <?php

                            use PHPPROJECT\models\usersmodel;
                            if (isset($this->session->u)) {

                                echo $this->session->u->profile->firstname ;
                            }

                            ?>  
                        <i class="fa fa-chevron-down user-down-icon" aria-hidden="true"></i>
                         </a>
                         <div class="notification-dropdown-menu user">
                            <ul>
                                <li><a href="#"><?= $user_detials ?></a>
                                    <i class="fas fa-user"></i>
                                </li>
                                <li><a href="#"><?= $user_change_password ?></a>
                                <i class="fas fa-key"></i>
                                </li>
                                <li><a href="#"><?= $user_settings ?></a>
                                <i class="fas fa-cog" aria-hidden="true"></i>
                                </li>
                                <li><a href="/auth/logout"><?= $user_out ?></a>
                                <i class="fas fa-sign-out-alt"></i>
                                </li>
                            </ul>
                       </div>                         
                    </li>
                   
                    <li>
                        <a href="#"><i class="fas fa-envelope-open"></i>
                        </a>
                    </li>
                    <li class="notification-dropdown bell"><a href="#"><i class="far fa-bell"></i>

                       </a>
                       <span class="notification-count">20</span>
                       <div class="notification-dropdown-menu">
                            <div>
                                <div class="gift"> <i class="fas fa-gift"> </i></div>  
                                <div class="notif-pargraph"><p>notification dropdownnotification dropdown dropdownnotification dropdown</p></div>
                            </div>
                            <div>
                                <div class="gift"> <i class="fas fa-gift"> </i></div>  
                                <div class="notif-pargraph"><p>notification dropdownnotification dropdown dropdownnotification dropdown</p></div>
                            </div>
                            <div>
                                <div class="gift"> <i class="fas fa-gift"> </i></div>  
                                <div class="notif-pargraph"><p>notification dropdownnotification dropdown dropdownnotification dropdown</p></div>
                            </div>
                            <div>
                                <div class="gift"> <i class="fas fa-gift"> </i></div>  
                                <div class="notif-pargraph"><p>notification dropdownnotification dropdown dropdownnotification dropdown</p></div>
                            </div>

                       </div>                          
                    </li>
                    <li>
                        <a href="/lang">
                            <i class="fas fa-globe-americas">
                            <span><?= $changelang ?>
                            </span></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main">
        <div class="sidebar">
                <div class="sidebar-content">
                    <div class="user-info">
                        <img src="/images/<?= $this->session->u->profile->image?>" alt="image_user">
                        <h5>  
                        <?php

                            if (isset($this->session->u)) {

                                echo $this->session->u->profile->firstname . " " . $this->session->u->profile->lastname;
                            }

                            ?>
                             </h5>
                        <h5 class='user-title'>
                            
                        <?php

                            if(isset($this->session->u))
                            {
                    
                            echo $this->session->u->group->group_name;                          
                            }

                        ?>
                    </h5>
                    </div>
                    <ul class="sidebar-nav">
                        <li class="sidebar-nav-item">
                            <a href="/" class="sidebar-nav-link <?= ($controller_name == 'homepage') ? 'active' : ''?>">
                                <div>
                                <i class="fas fa-chart-line"></i>  
                               </div>                                
                               <span>
                                 <?= $staticts ?> 
                               </span>

                            </a>
                        </li>
                        <li class="sidebar-nav-item  dropdown">
                            <a href="#" class="sidebar-nav-link">  
                                <div> 
                                    <i class="fas fa-money-check"></i>
                                </div>                                
                                <span>
                                        <?= $transaction ?> <i class="fas fa-angle-down"></i>
                                </span>
                                    
                            </a>  
                            <ul class="dropdown-menu">
                                    <li class="sidebar-nav-menu-item">
                                        <a href="#" class="sidebar-nav-menu-item-link">
                                            <div>
                                               <i class="fas fa-gift"></i>
                                            </div>
                                           <span> <?= $transaction_purchase?>
                                            </span>
                                        </a> 
                                    </li>
                                    <li class="sidebar-nav-menu-item">
                                        <a href="#" class="sidebar-nav-menu-item-link">
                                            <div>
                                              <i class="fas fa-credit-card"></i>
                                            </div>
                                            <span><?= $transaction_sales?>
                                            </span>                                             
                                        </a>
                                        
                                    </li>
                            </ul>
                        </li>
                        <li class="sidebar-nav-item">
                            <a href="#" class="sidebar-nav-link">
                                 <div>
                                    <i class="fas fa-money-check"></i>
                                </div>                                
                                <span>
                                    <?= $expenses ?><i class="fas fa-angle-down"></i>
                                </span>
                            </a>    
                            <ul class="dropdown-menu">
                                    <li class="sidebar-nav-menu-item">
                                        <a href="" class="sidebar-nav-menu-item-link">
                                            <div>
                                               <i class="fas fa-gift"></i>
                                            </div>
                                           <span> <?= $expenses_categories?>
                                            </span>
                                        </a> 
                                    </li>
                                    <li class="sidebar-nav-menu-item">
                                        <a href="#" class="sidebar-nav-menu-item-link">
                                            <div>
                                              <i class="fas fa-credit-card"></i>
                                            </div>
                                            <span><?= $daily_expenses?>
                                            </span>                                             
                                        </a>
                                        
                                    </li>
                            </ul>

                        </li>
                        <li class="sidebar-nav-itemn">
                            <a href="#" class="sidebar-nav-link <?= ($controller_name == 'prodcutscategories' || $this->match_url('/prodcutscategories/add')) ? 'active' : ''?>">
                                 <div>
                                    <i class="fas fa-money-check"></i>
                                </div>                                
                                <span>
                                    <?= $store ?><i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                                <ul class="dropdown-menu <?= ($controller_name == 'prodcutscategories' || $controller_name == 'prodcutscategories' || $controller_name == 'prodcutscategories' || $this->match_url('/prodcutscategories/add')) ? 'expand' : ''?>">
                                    <li class="sidebar-nav-menu-item">
                                        <a href="/prodcutscategories" class="sidebar-nav-menu-item-link <?= ($this->match_url('/prodcutscategories')) ? 'active' : ''?>">
                                            <div>
                                               <i class="fas fa-gift"></i>
                                            </div>
                                           <span> <?= $products_categories?>
                                            </span>
                                        </a> 
                                    </li>
                                    <li class="sidebar-nav-menu-item">
                                        <a href="/products" class="sidebar-nav-menu-item-link">
                                            <div>
                                              <i class="fas fa-credit-card"></i>
                                            </div>
                                            <span><?= $products?>
                                            </span>                                             
                                        </a>
                                        
                                    </li>
                                </ul>

                        </li>
                        <li class="sidebar-nav-item">
                            <a href="/suppliers" class="sidebar-nav-link">
                                <div>
                                <i class="fas fa-chart-line"></i>  
                               </div>                                
                               <span>
                                 <?= $thesuppliers ?> 
                               </span>

                            </a>
                        </li>                        
                        <li class="sidebar-nav-item">
                            <a href="#" class="sidebar-nav-link">
                                <div>
                                <i class="fas fa-chart-line"></i>  
                               </div>                                
                               <span>
                                 <?= $clients ?> 
                               </span>

                            </a>
                        </li>
                        <li class="sidebar-nav-item">
                            <a href="#" class="sidebar-nav-link <?= ($controller_name == 'users' || $controller_name == 'usersgroup' || $this->match_url('/privileges/add') || $this->match_url('/privileges')) ? 'active' : ''?>">
                                 <div>
                                    <i class="fas fa-money-check"></i>
                                </div>                                
                                <span>
                                    <?= $allusers ?><i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                                <ul class="dropdown-menu <?= ($controller_name == 'users' || $controller_name == 'usersgroup' || $controller_name == 'privileges' || $this->match_url('/privileges/add')) ? 'expand' : ''?>">
                                    <li class="sidebar-nav-menu-item">
                                        <a href="/usersgroup" class="sidebar-nav-menu-item-link <?= ($this->match_url('/usersgroup')) ? 'active' : ''?>">
                                            <div>
                                               <i class="fas fa-gift"></i>
                                            </div>
                                           <span> <?= $users_group?>
                                            </span>
                                        </a> 
                                    </li>
                                    <li class="sidebar-nav-menu-item">
                                        <a href="/users" class="sidebar-nav-menu-item-link <?= ($this->match_url('/users')) ? 'active' : ''?>">
                                            <div>
                                              <i class="fas fa-credit-card"></i>
                                            </div>
                                            <span><?= $users_list?>
                                            </span>                                             
                                        </a>
                                        
                                    </li>
                                    <li class="sidebar-nav-menu-item">
                                        <a href="/privileges" class="sidebar-nav-menu-item-link <?= ($this->match_url('/privileges') || $this->match_url('/privileges/add')) ? 'active' : ''?>">
                                            <div>
                                              <i class="fas fa-credit-card"></i>
                                            </div>
                                            <span><?= $users_privileges?>
                                            </span>                                             
                                        </a>
                                        
                                    </li>
                                </ul>

                        </li> 
                        <li class="sidebar-nav-item">
                            <a href="#" class="sidebar-nav-link">
                                <div>
                                <i class="fas fa-chart-line"></i>  
                               </div>                                
                               <span>
                                 <?= $reports ?> 
                               </span>

                            </a>
                        </li>
                        <li class="sidebar-nav-item">
                            <a href="#" class="sidebar-nav-link">
                                <div>
                                <i class="fas fa-chart-line"></i>  
                               </div>                                
                               <span>
                                 <?= $notification ?> 
                               </span>

                            </a>
                        </li>                                                                                       
                        <li class="sidebar-nav-item">
                            <a href="#" class="sidebar-nav-link">
                                <div>
                                <i class="fas fa-chart-line"></i>  
                               </div>                                
                               <span>
                                 <?= $user_out ?> 
                               </span>

                            </a>
                        </li>                                                                                       
                    </ul>
        </div>
    </div>
    </div>
    <div class="content">
        <!-- <div class ="container">  -->
        <section class="breadcrumb">
            <ul class="breadcrumb-nav">
                <li class="breadcrumb-list"><a href="<?= '/'.$controller_name?> "class="breadcrumb-link first  ?> "> <?= $controller_name  ?>   
                </a></li>
                <li class="breadcrumb-list"><a href="<?= '/'.$controller_name.'/'.$action_name ?>" class="breadcrumb-link <?= ($action_name == 'default' || $action_name == 'notfoundaction' || $yes == true)?'hide': 'active'  

                ?> " > <?= ($action_name == 'default')? '': $breadcrumb_action  ?></a></li>
            </ul>
        </section>


        <?php 

          
$messages = $this->messenger->get_messgaes();

if(!empty($messages ))
{
     foreach ($messages as $messages)
        {
        if(!empty($messages[0])){
     ?> 
 <div class="all_messages">
<p class="message t<?= $messages[1] ?>"> <?= $messages[0]; ?>
</p>
<i class="fas fa-times"></i>
</div>               


<?php }} }
?>
    