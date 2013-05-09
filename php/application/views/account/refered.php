<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<div class="content">
    <div class="content-header">
        <div class="content-title">
            <h1>Referred Members</h1>
        </div>
        <div style="padding:5px 25px;float: left;">
            <h4>Total members : <?php echo count($refereds); ?></h4>
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
                            <td style="width:60px"><div>Birthday</div></td>
                            <td style="width:80px"><div>Email</div></td>
                            <td style="width:50px"><div>Phone</div></td>
                            <td style="width:80px"><div>Referred Date</div></td>
                        </tr>
                        <?php if ($refereds) { ?>
                            <?php foreach ($refereds as $refered) { ?>
                                <tr class="row">
                                    <td><div><?php echo $refered->user_id; ?></div></td>
                                    <td><div><?php echo $refered->fullname; ?></div></td>
                                    <td><div><?php echo $refered->birthday; ?></div></td>
                                    <td><div><?php echo $refered->email; ?></div></td>
                                    <td><div><?php echo $refered->phone; ?></div></td>
                                    <td><div><?php echo $refered->created_on; ?></div></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <?php echo $links; ?>
            </div>
        </div>
    </div>
</div>