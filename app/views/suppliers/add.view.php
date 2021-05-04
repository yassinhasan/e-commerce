<div class ="container">
                <div class="form">
                <form method="post" enctype="multipart/form-data">
                <!-- supplierNAME -->
                    <div class="form-group">
                        <label for="supplier_name " class="form-label">
                            <?= $text_suppliername ?>
                        </label>
                        <input type="text" id="supplier_name " name="suppliers_name" class="form-control"  maxlength="50" value="<?= $this->showvalue('suppliername')?>">
                     </div>
                  
                       <!-- address -->
                    <div class="form-group">
                        <label for="address " class="form-label">
                            <?= $text_address ?>
                        </label>
                        <input type="text" id="address " name="address" class="form-control"  maxlength="50" value="<?= $this->showvalue('address')?>">
                     </div>

                    
                    
                     <div class="form-group">
                        <label for="email" class="form-label">
                            <?= $text_email ?>
                        </label>
                        <input type="text" id="email" name="email" class="form-control"  maxlength="100"  value="<?= $this->showvalue('email')?>">
                     </div>

                     <div class="form-group">
                        <label for="phonenumber" class="form-label">
                            <?= $text_phonenumber ?>
                        </label>
                        <input type="number" id="phonenumber" name="suppliers_number" class="form-control" value="<?= $this->showvalue('phonenumber')?>">
                     </div>

                     <div class="form-group submit" >
                            <input type="submit" value="<?=  $add_new_supplier ?>"  name="save" class=" btn btn-primary mt-10">
                     </div>

                </form>
            </div>
     </div>   

</div>
