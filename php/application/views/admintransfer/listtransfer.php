<table>
    <tbody>
        <tr class="heading">
            <td style="width:140px"><div>Acount number</div></td>
            <td style="width:80px"><div>Fee</div></td>
            <td style="width:80px"><div>Total</div></td>
            <td style="width:80px"><div>Type</div></td>
            <td style="width:80px"><div>Source</div></td>
            <td style="width:80px"><div>Status</div></td>
            <td style="width:120px"><div>Date</div></td>
        </tr>
        <?php if ($transfers) { ?>
            <?php foreach ($transfers as $history) { ?>
                <tr class="row">
                    <td><div><?php echo $history['username']; ?></div></td>
                    <td style="text-align: right"><div><?php echo number_format($history['fees'], 2, '.', ','); ?></div></td>
                    <td style="text-align: right"><div><?php echo number_format($history['total'], 2, '.', ','); ?></div></td>
                    <td><div><?php echo $history['transaction_type']; ?></div></td>
                    <td><div><?php echo $history['transaction_source']; ?></div></td>
                    <td><div><?php echo $history['payment_status']; ?></div></td>
                    <td><div><?php echo $history['created']; ?></div></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>