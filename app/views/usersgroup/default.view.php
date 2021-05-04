<section class="all-users">


    <a href="/usersgroup/add" class="add-new-user"><?= $add_new_group?> <span class="plus"></span> </a>
    <section class="users-table">
        <table>
               <thead>
                    <tr>
                        <th>
                        <?= $text_group_name ?>                                              
                        </th>
                        <th>
                        <?= $text_CONTROL ?> 
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($groups != false)
                    {
                        if(!empty($groups) && is_array($groups))
                            {
                                foreach($groups as $group)
                                { ?>
                        <tr>
                            <td>
                            <?= $group->group_name; ?>
                            </td>
                            <td class="edit">
                                <a href="/usersgroup/edit/<?= $group->group_id;?> ">
                                <i class="fas fa-edit editme"></i>
                                </a>
                                <a href="/usersgroup/delete/<?= $group->group_id; ?>"
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




