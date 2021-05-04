

<div class ="container">
            <h1 class="text-center bg-info"> <?= $edit_new_privileges ?> </h1>
            <div class="form">
                <form method="post">
                    <div class="form-group">
                        <label for="privileges_title " class="form-label">
                            <?= $text_privileges_title ?>
                        </label>
                        <input type="text" id="privileges_title " name="privileges_title" class="form-control" placeholder="enter your privileges_title "  maxlength="50" value="<?= isset($privilege)? $privilege->privilege_title: '' ?> ">
                     </div>
                     <div class="form-group">
                        <label for="privileges_url" class="form-label">
                            <?= $text_privileges_url ?>
                        </label>
                        <input type="text" id="privileges_url" name="privileges_url" class="form-control" placeholder="enter your privileges_url"  maxlength="30" value="<?= isset($privilege)? $privilege->privileges_url: '' ?> ">
                     </div>

                     <div class="form-group submit" >
                            <input type="submit" value="<?=  $text_privileges_save ?>"  name="save" class=" btn btn-primary mt-10">
                     </div>

                </form>
            </div>
     </div>   

</div>
