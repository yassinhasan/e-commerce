<section class="all-users">   
    <a href="/users/add" class="add-new-user"><?= $add_new_user?> <span class="plus"></span> </a>
    <section class="users-table">
        <table>
               <thead>
                    <tr>
                        <th>
                        <?= $text_User_Name ?>
                        </th>
                        <th>
                        <?= $text_Email ?>
                        </th>
                        <th>
                        <?= $text_Phonenumber ?>
                        </th>
                        <th>
                        <?= $text_Group_id ?>
                        </th>
                        <th>
                        <?= $text_Subscription_date ?>
                        </th>
                        <th>
                        <?= $text_lastlogin ?>
                        </th>
                        <th>
                        <?= $text_CONTROL ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($allusers != false)
                    {
                        if(!empty($users) && is_array($users))
                            {
                                foreach($users as $user)
                                { 

                                ?>                                
                        <tr>
                            <td>
                                <?= $user->username; ?>
                            </td>
                            <td>
                                <?= $user->email; ?>
                            </td>
                            <td>
                                <?= $user->phonenumber; ?>
                            </td>
                            <td>
                            <?= $user->group_name; ?>
                            </td>
                            <td>
                                <?= $user->subscriptiondate; ?>
                            </td>
                            <td>
                                <?= $user->lastlogin; ?>
                            </td>
                            <td class="edit">
                                <a href="/users/edit/<?= $user->users_id;?> ">
                                <i class="fas fa-edit editme"></i>
                                </a>
                                <a href="/users/delete/<?= $user->users_id; ?>"
                                onclick="if(!confirm('$confirm_delte_user ?>')) return false; ">  
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


