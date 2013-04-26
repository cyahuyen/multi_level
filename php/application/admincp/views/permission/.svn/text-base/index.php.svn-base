<div class="simplebox grid740">
    <?php if ($success) { ?>
        <div class="simple-tips">
            <ul>
                <li><?php echo $success; ?></li>
            </ul>
            <a href="#" class="close tips" title="Close">close</a>
        </div>
    <?php } ?>
    <div class="titleh"><h3><?php echo $headding_title; ?></h3></div>
    <table id="myTable" class="tablesorter"> 
        <thead> 
            <tr> 
                <th><?php echo $colum_name; ?></th>
                <th><?php echo $colum_action; ?></th>
            </tr> 
        </thead> 
        <?php if ($groups) { ?>
            <tbody> 
                <?php foreach ($groups as $group) { ?>
                    <tr> 
                        <td><?php echo $group['name']; ?></td> 
                        <td><a href="<?php echo $group['edit']; ?>">[ Edit ]</a></td> 
                    </tr> 
                <?php } ?>
            </tbody> 
        <?php } ?>
    </table>
</div>
