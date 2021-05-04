

<div class ="container">
            <h1 class="text-center bg-info"> <?= $edit_new_group ?> </h1>
            <div class="form">
                <form method="post">
                    <div class="form-group">
                        <label for="group_title " class="form-label">
                            <?= $text_group_title ?>
                        </label>
                        <input type="text" id="group_title " name="group_name" class="form-control"  maxlength="50" value="<?=$groups->group_name ?>">
                     </div>
                     <div class="form-group">
                        <label  class="form-label">
                            <?= $text_group_privileges ?>
                        </label>
                        <?php
                    if($privileges != false)
                    {
                        if(!empty($privileges) && is_array($privileges))
                            {
                                foreach($privileges as $privilege)
                                { ?>                        
                        <label  class="check-label">
                        <input type="checkbox"  id="privileges" name="privileges[]" class="check-control"  maxlength="30" value=" <?= $privilege->privilege_id ?>"
                            <?= (in_array($privilege->privilege_id , $selectd_id))?'checked' : '' ?>
                        >
                        <span><?=$privilege->privilege_title ?> </span>
                        </label>
                        <?php }
                            }
                    } ?>
                     </div> 

                     <div class="form-group submit" >
                            <input type="submit" value="<?=  $text_group_save ?>"  name="save" class=" btn btn-primary mt-10">
                     </div>

                </form>
            </div>
     </div>   

</div>


