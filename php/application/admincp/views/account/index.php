<div class="simplebox grid740">
    <?php if ($success) { ?>
        <div class="simple-tips">
            <ul>
                <li><?php echo $success; ?></li>
            </ul>
            <a href="#" class="close tips" title="Close">close</a>
        </div>
    <?php } ?>
    <div class="titleh"><h3><?php echo $account_title; ?></h3>
        <div class="shortcuts-icons">
            <a onclick="$('form').submit();" class="button-green">Delete</a>
            <a href="<?php echo $add_new; ?>" class="button-green">Insert</a>
        </div>
    </div>
    <table id="myTable" class="tablesorter"> 
        <thead> 
            <tr> 
                <th>#</th> 
                <th><?php echo $colum_username; ?></th> 
                <th><?php echo $colum_contact_name; ?></th> 
                <th><?php echo $colum_email; ?></th>
                <th><?php echo $colum_action; ?></th> 
            </tr> 
        </thead> 
        <?php if ($admins) { ?>
            <tbody> 
            <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
                <?php foreach ($admins as $admin) { ?>
                    <tr> 
                        <td style="text-align: center;">
                            <?php if ($id_logged != $admin['id']) { ?>
                                <?php if ($admin['selected']) { ?>
                                    <input type="checkbox" name="selected[]" value="<?php echo $admin['id']; ?>" checked="checked" />
                                <?php } else { ?>
                                    <input type="checkbox" name="selected[]" value="<?php echo $admin['id']; ?>" />
                                <?php } ?>
                            <?php } ?>
                        </td>
                        <td><?php echo $admin['username']; ?></td> 
                        <td><?php echo $admin['contactname']; ?></td> 
                        <td><?php echo $admin['email']; ?></td> 
                        <td><a href="<?php echo $admin['edit']; ?>">Edit</a></td> 
                    </tr> 
                <?php } ?>
            </form>
            </tbody> 
        <?php } ?>
    </table>


</div>
<!-- END TABLE -->
