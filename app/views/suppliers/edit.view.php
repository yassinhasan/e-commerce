<div class ="container">

                    <div class="form">
                <form method="post">
                    <div class="form-group">
                        <label for="supplier_name " class="form-label">
                            <?= $text_suppliername ?>
                        </label>
                        <input type="text" id="supplier_name " name="suppliers_name" class="form-control"  maxlength="50" value="<?= $this->showvalue('suppliers_name',$suppliers)?>">
                     </div>
                     <div class="form-group">
                        <label for="phonenumber" class="form-label">
                            <?= $text_phonenumber ?>
                        </label>
                        <input type="text" id="phonenumber" name="suppliers_number" class="form-control" value="<?= $this->showvalue('suppliers_number',$suppliers)?>">
                     </div>


                     <div class="form-group submit" >
                            <input type="submit" value="<?=  $add_new_supplier?>"  name="save" class=" btn btn-primary mt-10">
                     </div>

                </form>
            </div>
     </div>   

</div>
