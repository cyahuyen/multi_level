<div class="simplebox grid740">
    <?php if ($success) { ?>
        <div class="simple-tips">
            <ul>
                <li><?php echo $success; ?></li>
            </ul>
            <a href="#" class="close tips" title="Close">close</a>
        </div>
    <?php } ?>
    <div class="titleh"><h3>User Manager</h3>
        <div class="shortcuts-icons">
            <a onclick="$('form').submit();" class="button-green">Delete</a>
            <a href="<?php echo $add_new; ?>" class="button-green">Insert</a>
        </div>
    </div>
    <table id="myTable" class="tablesorter"> 
        <thead> 
            <tr> 
                <th>#</th> 
                <th>Username</th> 
                <th>Address</th> 
                <th>Email</th>
                <th>Phone</th>
                <th>User Type</th> 
                <th>Create on</th> 
                <th>Action</th>
            </tr> 
        </thead> 
        <?php if ($users) { ?>
            <tbody> 
            <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
                <?php foreach ($users as $user) { ?>
                    <tr> 
                        <td><?php if ($user['selected']) { ?>
                                <input type="checkbox" name="selected[]" value="<?php echo $user['id']; ?>" checked="checked" />
                            <?php } else { ?>
                                <input type="checkbox" name="selected[]" value="<?php echo $user['id']; ?>" />
                            <?php } ?>
                        </td> 
                        <td><?php echo $user['username']; ?></td> 
                        <td><?php echo $user['address']; ?></td> 
                        <td><?php echo $user['email']; ?></td> 
                        <td><?php echo $user['phone']; ?></td> 
                        <td><?php echo $user['usertype']; ?></td> 
                        <td><?php echo $user['created_on']; ?></td> 
                        <td><a href="<?php echo $user['edit']; ?>">[ Edit ]</a></td> 
                    </tr> 
                <?php } ?>
            </form>
            </tbody> 
        <?php } ?>
    </table>
    <div class="pagination"><?php echo $pagination; ?></div>

</div>
<!-- END TABLE -->
<script type="text/javascript">
                $(document).ready(function() {
                    $('#button-close').live('click', function() {
                        $('#view').hide();
                    })
                    $('#button-view').live('click', function() {
                        $('#view').show();
                    })
                });
</script>