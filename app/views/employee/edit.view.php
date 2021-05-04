<div class="content">
    <div class ="container">
            <h1 class="text-center bg-info"> Add employees info</h1>
            <div class="myform">
                <form method="POST">
                    <div class="form-group">
                        <label for="name form-label">
                            name
                        </label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="enter your name" required  value='<?= $user->name ?>'>
                     </div>
                    <div class="form-group">
                        <label for="age">
                        age
                        </label>
                        <input type="number" id="age" name="age" class="form-control" placeholder="enter your age" min="1" max="66" step="1" required  value='<?= $user->age ?>'>
                     </div>
                    <div class="form-group">
                        <label for="address">
                        address
                        </label>
                        <input type="address" id="address" name="address" class="form-control" placeholder="enter your address" required  value='<?= $user->address ?>' >
                     </div>
                    <div class="form-group">
                        <label for="tax">
                        tax
                        </label>
                        <input type="number" id="tax" name="tax" class="form-control" placeholder="enter your tax" min="0" max="2" step="0.1" required  value='<?=  $user->tax  ?>' >
                     </div>
                    <div class="form-group">
                        <label for="salary">
                        salary
                        </label>
                        <input type="number" id="salary" name="salary" class="form-control" placeholder="enter your salary" min="100" max="2000" step="100" required value='<?= $user->salary ?>' >
                     </div>
                     <div class="form-group" >
                            <input type="submit" value="ADD" name="submit" class=" btn btn-primary mt-10">
                     </div>

                </form>
            </div>
</div>
</div>