<div class="simplebox grid740">
    <div class="titleh">
        <h3><?php echo $headding_title; ?></h3>
    </div>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" name="form">
        <table id="myTable" class="tablesorter">
            <thead>
                <tr>
                    <th style="text-align: center;"><?php echo $colum_module; ?></th>
                    <th><?php echo $colum_action; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($modules as $module) { ?>
                    <tr>
                        <td>
                            <?php echo $module['modules']; ?>	
                        </td>
                        <td>                       
                            <?php foreach ($module['actions'] as $key => $actions) { ?> 
                                <input type="checkbox" name="actions[<?php echo $module['modules']; ?>][<?php echo $actions; ?>]" id="actions" class="uniform" style="opacity: 0; " value="1" <?php echo ((isset($permission[$module['modules']][$actions]) && $permission[$module['modules']][$actions] == 1) ? 'checked="checked"' : ''); ?>><?php echo $actions; ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="button-box">
            <input type="submit" name="button" id="submit" value="<?php echo $button_save; ?>" class="st-button"/>
            <a href="<?php echo $cancel; ?>" class="st-clear"><?php echo $button_cancel; ?></a>
        </div>
    </form>
</div>
<!-- END SIMPLE FORM -->