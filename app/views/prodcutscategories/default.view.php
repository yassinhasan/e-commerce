<section class="all-categorys">


    <a href="/prodcutscategories/add" class="add-new-category"><?= $add_new_category?> <span class="plus"></span> </a>
    <section class="users-table">
        <table>
               <thead>
                    <tr>
                        <th>
                        <?= $text_category_name ?>                                              
                        </th>
                        <th>
                        <?= $text_category_iamge ?>                                              
                        </th>
                        <th>
                        <?= $text_CONTROL ?> 
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($categories != false)
                    {
                        if(!empty($categories) && is_array($categories))
                            {
                                foreach($categories as $category)
                                { ?>
                        <tr>
                            <td>
                            <?= $category->category_name; ?>
                            </td>
                            <td>
                        <img  style="width:150px; height:150px;border-radius:50%"  src="/images/<?= $category->category_iamge ?>">
                            </td>
                            <td class="edit">
                                <a href="/prodcutscategories/edit/<?= $category->category_id;?> ">
                                <i class="fas fa-edit editme"></i>
                                </a>
                                <a href="/prodcutscategories/delete/<?= $category->category_id; ?>"
                                onclick="if(!confirm('<?=$text_confirm_edit ?>')) return false; ">  
                                <i class="fas fa-trash trashme"></i></a> 
                               
                            </td>        
                        </tr>
                            <?php }
                            }
                    } ?>
                </tbody>    
             </table>
         </div>
  </section>
</section>




