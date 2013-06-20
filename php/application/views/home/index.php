<div id="content-body-wrapper">
    <div class="content-header">
        <div class="content-title">
            <h1>Activities</h1>
        </div>
    </div>
    <div id="content-body">
        <div class="datalist">
            <table >
                <thead>
                    <tr class="heading">
                        <td style="width:20px"><span></span></td>
                        <td style="width:110px"><span>Date</span></td>
                        <td style="width:80px" align="center"><span>Status(+/-)</span></td>
                        <td style="width:80px" align="center"><span>Amount</span></td>
                        <td style="width:300px"><span>Description</span></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($activities as $activity) { ?>
                        <tr class="row"> 
                            <td ><span></span></td>
                            <td ><span><?php echo $activity->created; ?></span></td>
                            <td align="center" style="text-align: center"><span><?php echo $activity->status; ?></span></td>
                            <td align="center" style="text-align: center"><span><?php echo!empty($activity->amount) ? '$' . $activity->amount : ''; ?></span></td>
                            <td ><span><?php echo $activity->description; ?></span></td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="datalist-navigation" >
                <?php echo $links ?>
            </div>
        </div>
    </div>
</div>
