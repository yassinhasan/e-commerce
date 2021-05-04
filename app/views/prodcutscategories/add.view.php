

<div class ="container">
            <h1 class="text-center bg-info"> <?= $add_new_category ?> </h1>
            <div class="form">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-category">
                        <label for="category_title " class="form-label">
                            <?= $text_category_title ?>
                        </label>
                        <input type="text" id="category_title " name="category_name" class="form-control"  maxlength="50" value="">
                     </div>
                    <div class="form-category">
                        <label for="category_image " class="form-label">
                            <?= $text_category_iamge ?>
                        </label>
                        <input type="file" id="category_image " name="category_image" class="form-control"  value="">
                     </div>

                     <div class="form-category submit" >
                            <input type="submit" value="<?=  $text_category_save ?>"  name="save" class=" btn btn-primary mt-10">
                     </div>

                </form>
            </div>
     </div>   

</div>
