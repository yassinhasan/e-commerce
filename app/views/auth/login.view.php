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
    

<div class="login-form">
  <form method="POST">
    <div class="box">
      <h3> 
        wellcome
      </h3>
      <input type="text" placeholder="name" name="uname">
       <input type="password" placeholder="password" name="upassword">
       <button type="submit" name="login">
         submit
       </button>
    </div>
  </form>
</div> 