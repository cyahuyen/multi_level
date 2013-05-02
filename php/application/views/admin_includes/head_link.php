

<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/template.css"/>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui-1.9.0.custom.min.css"/>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/superfish.css"/>
<link type="text/css" href="<?php echo base_url(); ?>css/autocomplete.css" rel="stylesheet" />

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.9.0.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/hoverIntent.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/superfish.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-jscontext-1.0.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/autocomplete.js"></script>


<script>
    $(document).ready(function() {

        /* Menu */

        $('ul.sf-menu').superfish();

        /* Collapsible panels */

        $(".collapsible div.header").click(function() {
            var collapsible = $(this).parent();
            if ($(this).hasClass("header-closed")) {
                $(this).removeClass("header-closed");
                $(this).find("img").attr("src",
                        $(this).find("img").attr("src").replace("col", "exp"));
                $(collapsible).find("div.body").removeClass("header-closed");
            } else {
                $(this).addClass("header-closed");
                $(this).find("img").attr("src",
                        $(this).find("img").attr("src").replace("exp", "col"));
                $(collapsible).find("div.body").addClass("header-closed");
            }
            $(collapsible).find("div.body").slideToggle();
        });

        showCompMsgs();

        initDirtyCheck();

    });

    function showCompMsgs() {
        $("[id^=cmsg]").each(function() {
            var target = $(this).attr("id").substring(4); /* everything after 'cmsg' */
            var msg = $(this).val();
            $("[id$=" + target + "]").not("[id^=cmsg]").addClass("error");
            var icon = document.createElement("img");
            $(icon).addClass("error");
            $(icon).attr("src", "<?php echo base_url(); ?>img/sev/error.jpg");
            $(icon).attr("title", msg);
            $("[id$=" + target + "]").not("[id^=cmsg]").after(icon);
        });
        if ($('img.mandatory').length == 0) {
            $(".mandatory").not("img.mandatory").each(function() {
                var nextEl = $(this).next();
                if (!$(nextEl).hasClass("error")) {
                    var icon = document.createElement("img");
                    $(icon).addClass("mandatory");
                    $(icon).attr("src", "<?php echo base_url(); ?>img/sev/required.jpg");
                    $(icon).attr("title", "This is a required value");
                    $(this).after(icon);
                }
            });
        }
    }

    var isdirty = false;
    function initDirtyCheck() {
        isdirty = false;
        $(":input").not(".allowdirty").change(function(objEvent) {
            isdirty = true;
        });
        /* set dirty check conf on menus, tabs and components with class '.checkdirty' */
        $(".mainmenu a").click(function() {
            return confirmAction();
        });
        $("td.tab").click(function() {
            return confirmAction();
        });
        $(".checkdirty").click(function() {
            return confirmAction();
        });
    }

    function confirmAction(entity) {
        if (!isdirty)
            return true;
        if (entity == null || entity == "")
            entity = "Data";
        var msg = entity + " has been modified and not saved. If you continue your changes will be lost.";
        msg += "\n\nDo you wish to continue?";
        return confirm(msg);
    }

    function confirmDelete() {
        return confirm("Delete is permanent, it cannot be undone.\n\nDo you wish to continue?");
    }

</script>