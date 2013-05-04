<div id="content-header">


    <div class="content-header">
        <div class="content-title">
            <h1>Configs</h1>
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
                            <td style="width:20px"><span></span></td>
                            <td style=""><span>Config name</span></td>
                            <td style="width:210px"><span>Action</span></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($configs as $config) { ?>
                            <tr class="row" id=""> 
                                <td></td>
                                <td><?php echo $config['name'] ?></td>
                                <td><span>
                                        <a href="<?php echo site_url('adminconfig/' . $config['key'] ) ?>" class="deactivate" >Edit</a>
                                    </span>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>			