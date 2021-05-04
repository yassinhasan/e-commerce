<section class="all-suppliers">   
    <a href="/suppliers/add" class="add-new-user"><?= $add_new_supplier?> <span class="plus"></span> </a>
    <section class="suppliers-table">
        <table>
               <thead>
                    <tr>
                        <th>
                        <?= $text_supplier_Name ?>
                        </th>
                        <th>
                        <?= $text_Email ?>
                        </th>
                        <th>
                        <?= $text_Phonenumber ?>
                        </th>
                        <th>
                        <?= $text_address ?>
                        </th>
                        <th>
                        <?= $text_CONTROL ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                  //  var_dump($suppliers);
                    if($suppliers != false)
                    {
                        if(!empty($suppliers) && is_array($suppliers))
                            {
                                foreach($suppliers as $supplier)
                                { 

                                ?>                                
                        <tr>
                            <td>
                                <?= $supplier->suppliers_name; ?>
                            </td>
                            <td>
                                <?= $supplier->email; ?>
                            </td>
                            <td>
                                <?= $supplier->suppliers_number; ?>
                            </td>
                            <td>
                                <?= $supplier->address; ?>
                            </td>

                            <td class="edit">
                                <a href="/suppliers/edit/<?= $supplier->suppliers_id;?> ">
                                <i class="fas fa-edit editme"></i>
                                </a>
                                <a href="/suppliers/delete/<?= $supplier->suppliers_id; ?>"
                                onclick="if(!confirm('$confirm_delte_supplier ?>')) return false; ">  
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


