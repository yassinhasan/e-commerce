

<div class ="container">
<?php 

foreach ($this->messenger->get_messgaes() as $messages)
    {
    if(!empty($messages)){
         ?> 
<div class="all_messages">
       <p class="message t<?= $messages[1] ?>"> <?= $messages[0]; ?>
       </p>
    <i class="fas fa-times"></i>
    </div>
   <?php }}
?>          
            <h1 class="text-center bg-info"> <?= $add_new_privileges ?> </h1>
            <div class="form">
                <form method="post">
                    <div class="form-group">
                        <label for="privileges_title " class="form-label">
                            <?= $text_privileges_title ?>
                        </label>
                        <input type="text" id="privileges_title " name="privileges_title" class="form-control"  maxlength="50" value="">
                     </div>
                     <div class="form-group">
                        <label for="privileges_url" class="form-label">
                            <?= $text_privileges_url ?>
                        </label>
                        <input type="text" id="privileges_url" name="privileges_url" class="form-control"  maxlength="30">
                     </div>

                     <div class="form-group submit" >
                            <input type="submit" value="<?=  $text_privileges_save ?>"  name="save" class=" btn btn-primary mt-10">
                     </div>
                    
                </form>
            </div>
     </div>   

</div>
