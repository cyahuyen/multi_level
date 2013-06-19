<div id="msg" class="msg">
    <div id="msg_renderarea">
        <div id="msgContainer" style="display:<?php echo isset($usermessage) ? 'block' : 'none' ?>">
            <table>
                <tr>
                    <td class="msgicon">
                        <img id="msgicon" src="<?php echo base_url(); ?>img/sev/<?php if (isset($usermessage)) echo $usermessage[0]; ?>.jpg" alt="" />
                    </td>
                    <td>
                        <div id="msgtitle" style="color:<?php if (isset($usermessage)) echo $usermessage[1]; ?>"><?php if (isset($usermessage)) echo $usermessage[2]; ?></div>
                        <div id="msgdesc"><?php if (isset($usermessage)) echo $usermessage[3]; ?></div>
                    </td>
                </tr>
            </table>
            <?php
            if (!empty($fielderrors)) {
                foreach (array_keys($fielderrors) as $fieldid) {
                    echo '<input type="hidden" id="cmsg' . $fieldid . '" value="' . $fielderrors[$fieldid] . '"/>';
                }
            }
            ?>
        </div>
        <script type="text/javascript">
            function showmessage(type, title, desc) {
                $("#msgicon").attr("src", "<?php echo base_url(); ?>img/sev/" + type + ".jpg");
                $("#msgtitle").html(title);
                if (type == 'success')
                    $("#msgtitle").css("color", "green");
                else if (type == 'warn')
                    $("#msgtitle").css("color", "darkorange");
                else if (type == 'error' || type == 'fatal')
                    $("#msgtitle").css("color", "darkred");
                else
                    $("#msgtitle").css("color", "#0000a0");
                $("#msgdesc").html(desc);
                $("#msgContainer").css("display", "block");
            }
            function hidemessage() {
                $("#msgContainer").css("display", "none");
            }
        </script>
    </div>
    <div id="msg_popup" title="<?php if (isset($popupmessage)) echo $popupmessage; ?>" style="display:block">
        <?php
        if (isset($popupmessages)) {
            foreach ($popupmessages as $message) {
                echo '<div>' . $message . '</div>';
            }
        }
        ?>
    </div>
    <script>$("#msg_popup").dialog({height: 240, width: 400, autoOpen:<?php
        if (isset($popupmessage)) {
            echo 'true';
        } else {
            echo 'false';
        }
        ?>, modal: false, resizable: false});</script>
</div>