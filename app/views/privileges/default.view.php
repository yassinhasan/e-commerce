<section class="all-users">


    <a href="privileges/add" class="add-new-user"><?= $add_new_privileges?> <span class="plus"></span> </a>
    <section class="users-table">
        <table>
               <thead>
                    <tr>
                        <th>
                        <?= $text_privileges_name ?>                                              
                        </th>
                        <th>
                        <?= $text_CONTROL ?> 
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($privileges != false)
                    {
                        if(!empty($privileges) && is_array($privileges))
                            {
                                foreach($privileges as $privilege)
                                { ?>
                        <tr>
                            <td>
                            <?= $privilege->privilege_title; ?>
                            </td>
                            <td class="edit">
                                <a href="/privileges/edit/<?= $privilege->privilege_id;?> ">
                                <i class="fas fa-edit editme"></i>
                                </a>
                                <a href="/privileges/delete/<?= $privilege->privilege_id; ?>"
                                onclick="if(!confirm('$confirm_delte_privileges ?>')) return false; ">  
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



