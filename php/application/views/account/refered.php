<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    <div style="clear:both;"></div>
</div>
<div class="content">
    <div class="content-header" style="max-height: none;height: 48px;">
        <div class="content-title" >
            <h1>Referred Members </h1>
            <h4 >Total members : <?php echo count($refereds); ?></h4>
        </div>
        <div style="">
            <div class="flr">
                <form action="">
                    <div style="float:left;padding-right:6px" class="ui-widget">
                        <input type="text" class="searchresults" id="tags" name="search" placeholder="Search..." style="width:200px" value="<?php echo $this->input->get('search') ?>">
                    </div>
                    <input type="submit" value="Search" class="button" id="Search">
                </form>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="datalist">
            <div id="datalist-renderarea">
                <table>
                    <tbody>
                        <tr class="heading">
                            <td style="width:35px"><div>Acount Number</div></td>
                            <td style="width:120px"><div>Full Name</div></td>
                            <td style="width:120px"><div>Created</div></td>
                            <td style="width:80px"><div>Email</div></td>
                            <td style="width:50px"><div>Phone</div></td>
                        </tr>
                        <?php if ($refereds) { ?>
                            <?php foreach ($refereds as $refered) { ?>
                                <tr class="row">
                                    <td><div><?php echo $refered->username; ?></div></td>
                                    <td><div><?php echo $refered->firstname . ' ' . $refered->lastname; ?></div></td>
                                    <td><div><?php echo $refered->created_on; ?></div></td>
                                    <td><div><?php echo $refered->email; ?></div></td>
                                    <td><div><?php echo $refered->phone; ?></div></td>
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