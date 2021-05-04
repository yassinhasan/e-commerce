<div class="content">        
        <div class ="container">
            <h1 class="text-center bg-info"> employees info</h1>
            <?php  
                if(isset( $_SESSION['message']))
                {?>
                <p class="<?= (isset($error)  && isset($_SESSION['message'])) ? 'alert alert-danger' : 'alert alert-success' ?>"> <?php echo $_SESSION['message'] ?> </p>
                <?php $_SESSION['message'] = "" ;
                 session_unset();
                ;}
            ?>
        <table class="table table-borderd">
            <thead>
                <tr>
                    <th>
                        name
                    </th>
                    <th>
                        age
                    </th>
                    <th>
                        address
                    </th>
                    <th>
                        tax
                    </th>
                    <th>
                        salary
                    </th>
                    <th>
                        edit
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                   if (isset($result) ) {
                       foreach($result as $single_row)
                       { ?>
                           
                <tr>
                    <td>
                        <?= $single_row->name ?>
                    </td>
                    <td>
                    <?= $single_row->age ?>
                    </td>
                    <td>
                    <?= $single_row->address ?>
                    </td>
                    <td>
                    <?= $single_row->tax ?>
                    </td>
                    <td>
                    <?= $single_row->salary ?>
                    </td>
                    <td>
                    <a href="/employee/edit/<?= $single_row->id ?>" onclick="if(!confirm('هل انت متاكد من تعديل هذا الموظف')) {return false} "><i class="fas fa-edit" style="color: #00f;cursor:pointer;margin-right:10px">  </i> </a>
                     
                    <a href="/employee/delete/<?= $single_row->id ?>" onclick="if(!confirm('هل انت متاكد من  حذف هذا الموظف')) {return false} "><i class="fas fa-times" style="color: #f00;cursor:pointer"></i></a>
                    </td>
                </tr>
                <?php }
                   }
                ?>
            </tbody>
        </table>
              <button class="btn btn-primary"><a href="/employee/add" style="color: #fff;">  add another employee</a></button>             
        </div>
</div>