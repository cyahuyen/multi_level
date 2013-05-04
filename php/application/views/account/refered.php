<div class="content">
    <div class="content-header">
        <div class="content-title">
            <h1>Refered Members</h1>
        </div>
        <div style="padding:5px 25px;float: left;">
            <h4>Total members : <?php echo count($refereds);?> (30$)</h4>
        </div>
    </div>
    <div class="content-body">
        <div class="datalist">
            <div id="datalist-renderarea">
                <table>
                    <tbody>
                        <tr class="heading">
                            <td style="width:35px"><div>Id</div></td>
                            <td style="width:120px"><div>Full Name</div></td>
                            <td style="width:120px"><div>UserName</div></td>
                            <td style="width:60px"><div>Birthday</div></td>
                            <td style="width:80px"><div>Email</div></td>
                            <td style="width:50px"><div>Phone</div></td>
                            <td style="width:80px"><div>Created Date</div></td>
                        </tr>
                        <?php if ($refereds) { ?>
                            <?php foreach ($refereds as $refered) { ?>
                                <tr class="row">
                                    <td><div><?php echo $refered->user_id; ?></div></td>
                                    <td><div><?php echo $refered->fullname; ?></div></td>
                                    <td><div><?php echo $refered->username; ?></div></td>
                                    <td><div><?php echo $refered->birthday; ?></div></td>
                                    <td><div><?php echo $refered->email; ?></div></td>
                                    <td><div><?php echo $refered->phone; ?></div></td>
                                    <td><div><?php echo $refered->created_on; ?></div></td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>