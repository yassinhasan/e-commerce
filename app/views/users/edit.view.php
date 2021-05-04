<div class ="container">

                    <div class="form">
                <form method="post">
                     <div class="form-group">
                        <label for="phonenumber" class="form-label">
                            <?= $text_phonenumber ?>
                        </label>
                        <input type="text" id="phonenumber" name="phonenumber" class="form-control" value="<?= $this->showvalue('phonenumber',$users)?>">
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
                                <option value=" <?= $group->group_id ?>"  <?= $this->selected('group_id',$group->group_id,$users)?>>
                                <?=$group->group_name?> 
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
