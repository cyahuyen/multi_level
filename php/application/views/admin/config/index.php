<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<div id="content-header">
    <div class="content-header">
        <div class="content-title">
            <h1>Configuration</h1>
        </div>
    </div>
</div>
<div id="content-body-wrapper">
    <div id="content-body">
        <div class="datalist">
            <div id="datalist-renderarea">
                <table id="userdata">
                    <thead>
                        <tr class="heading">
                            <td style="width:20px"><div></div></td>
                            <td style=""><div>Configuration name</div></td>
                            <td style="width:210px"><div>Action</div></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($configs as $config) { ?>
                            <tr class="row" id=""> 
                                <td></td>
                                <td><div><?php echo $config['name'] ?></div></td>
                                <td><div>
                                        <a href="<?php echo admin_url('config/' . $config['key'] ) ?>" class="deactivate" >Edit</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>			