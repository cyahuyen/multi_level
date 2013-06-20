<div id="content-body-wrapper">
    <div id="content-body">
        <div class="datalist">
            <table >
                <thead>
                    <tr class="heading">
                        <td style="width:20px"><span></span></td>
                        <td style="width:110px"><span>Date</span></td>
                        <td style="width:80px"><span>Status(+/-)</span></td>
                        <td style="width:80px"><span>Amount</span></td>
                        <td style="width:300px"><span>Description</span></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($activities as $activity) { ?>
                        <tr class="row"> 
                            <td ><span></span></td>
                            <td ><span><?php echo $activity->created; ?></span></td>
                            <td ><span><?php echo $activity->status; ?></span></td>
                            <td ><span><?php echo $activity->amount; ?></span></td>
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
