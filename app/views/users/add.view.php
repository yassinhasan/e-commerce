<div class ="container">
                <div class="form">
                <form method="post" enctype="multipart/form-data">
                <!-- USERNAME -->
                    <div class="form-group">
                        <label for="user_name " class="form-label">
                            <?= $text_username ?>
                        </label>
                        <input type="text" id="user_name " name="username" class="form-control"  maxlength="50" value="<?= $this->showvalue('username')?>">
                     </div>
                     <!-- first name -->
                    <div class="form-group">
                        <label for="firstname " class="form-label">
                            <?= $text_firstname ?>
                        </label>
                        <input type="text" id="firstname " name="firstname" class="form-control"  maxlength="50" value="<?= $this->showvalue('firstname')?>">
                     </div>
                      <!-- last name -->
                    <div class="form-group">
                        <label for="lastname " class="form-label">
                            <?= $text_lastname ?>
                        </label>
                        <input type="text" id="lastname " name="lastname" class="form-control"  maxlength="50" value="<?= $this->showvalue('lastname')?>">
                     </div>
                  
                       <!-- address -->
                    <div class="form-group">
                        <label for="address " class="form-label">
                            <?= $text_address ?>
                        </label>
                        <input type="text" id="address " name="address" class="form-control"  maxlength="50" value="<?= $this->showvalue('address')?>">
                     </div>
                       <!-- date of birth -->
                    <div class="form-group">
                        <label for="date_of_birth " class="form-label">
                            <?= $text_dob ?>
                        </label>
                        <input type="date" id="date_of_birth " name="DOB" class="form-control"  maxlength="50" value="<?= $this->showvalue('DOB')?>">
                     </div>
                       <!-- image -->
                    <div class="form-group">
                        <label for="image " class="form-label">
                            <?= $text_image ?>
                        </label>
                        <input type="file" id="image " name="image" class="form-control"  maxlength="50" value="<?= $this->showvalue('image')?>" accept="audio/*,video/*,image/*">
                     </div>
                     <div class="form-group">
                        <label for="password" class="form-label">
                            <?= $text_password ?>
                        </label>
                        <input type="password" id="password" name="password" class="form-control" value="<?= $this->showvalue('password')?>">
                     </div>
                    
                     <div class="form-group">
                        <label for="confirm_password" class="form-label">
                            <?= $text_confirm_password ?>
                        </label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" value="<?= $this->showvalue('confirm_password')?>">
                     </div>
                    
                     <div class="form-group">
                        <label for="email" class="form-label">
                            <?= $text_email ?>
                        </label>
                        <input type="text" id="email" name="email" class="form-control"  maxlength="100"  value="<?= $this->showvalue('email')?>">
                     </div>
                     <div class="form-group">
                        <label for="confirm_email" class="form-label">
                            <?= $text_confirm_email ?>
                        </label>
                        <input type="text" id="confirm_email" name="confirm_email" class="form-control"  maxlength="100" value="<?= $this->showvalue('confirm_email')?>">
                     </div>
                     <div class="form-group">
                        <label for="phonenumber" class="form-label">
                            <?= $text_phonenumber ?>
                        </label>
                        <input type="number" id="phonenumber" name="phonenumber" class="form-control" value="<?= $this->showvalue('phonenumber')?>">
                     </div>
                     <div class="form-group">
                        <label  class="form-label">
                            <?= $text_group_id ?>
                        </label>
                        <select class="select" name="group_id">
                        <option value="">
                        <?= $text__choose_Group_id ?>
                        </option>
                        <?php
                            if($groups != false)
                            {
                                if(!empty($groups) && is_array($groups))
                                    {
                                        foreach($groups as $group)
                                        { ?>                        
                                <option value=" <?= $group->group_id ?>">
                                <?= $group->group_name?> 
                                </option>
                                <?php }
                                    }
                            } ?>
                         </select>
                     </div> 

                     <div class="form-group submit" >
                            <input type="submit" value="<?=  $add_new_user ?>"  name="save" class=" btn btn-primary mt-10">
                     </div>

                </form>
            </div>
     </div>   

</div>
