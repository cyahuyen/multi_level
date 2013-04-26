if ($) {
    $.ajaxSetup({
        async: false,
        cache: false
    });
    $(document).ajaxError(function (event, response, settings) {
        if (response.status == 400) window.location = '/error/http400';
        else if (response.status == 403) window.location = '/error/http403';
        else if (response.status == 404) window.location = '/error/http404';
        else if (response.status == 500) window.location = '/error/http500';
    });
}

String.prototype.format = function () {
    var pattern = /\{\d+\}/g;
    var args = arguments;
    return this.replace(pattern, function (capture) { return args[capture.match(/\d+/)]; });
}

var ajaxRefreshAction = null;
function handleAjaxResponse(result, textStatus, response, placeHolder) {
    if (!placeHolder) {
        placeHolder = "#placeholder";
    }
    if (response.status == 207)
        window.location = response.getResponseHeader('Location');
    else {
        $(placeHolder).html(result);
        if (ajaxRefreshAction) {
            if (placeHolder == "#placeholder") ajaxRefreshAction();
        }

        // restart timer
        minutes = logoutTime;
        seconds = 0;
    }

    if ($('span.info-message').length + $('span.warning-message').length + $('span.error-message').length) {
        //    $('html, body').animate({ scrollTop: 0 }, 'normal');
        return false;
    }
}

function ajaxPostOnSubmit(placeholder) {
    if (!placeholder) placeholder = "#placeholder";
    var selector = placeholder + " input[type='submit'][class!='noajax']";
    $(selector).live("click", function (event) {
        this.disabled = true;
        var form = $(placeholder + " form");
        var url = form.attr("action");
        var data = null;
        if (this.name) {
            data = form.serializeArray();
            data.push({ name: this.name, value: this.value });
            data = jQuery.param(data);
        }
        else
            data = form.serialize();
        if (form.attr("method").toLowerCase() == "post") {
            $.post(url, data, function (result, textStatus, response) {
                handleAjaxResponse(result, textStatus, response, placeholder);
            });
        }
        else {
            $.get(url, data, function (result, textStatus, response) {
                handleAjaxResponse(result, textStatus, response, placeholder);
            });
        }

        if (window.location.href.indexOf("paymentform") < 0)
            $('html, body').animate({ scrollTop: 0 }, 'normal');
        else
            $("html, body").animate({ scrollTop: $(document).height() }, 'normal');

        event.preventDefault();
    });
}

function ajaxPagerClick(placeHolder) {
    if (!placeHolder) placeHolder = "#placeholder";
    $(placeHolder + " div.pg li a").live("click", function (event) {
        var url = this.href;
        $.get(url, null, function (result, textStatus, response) {
            handleAjaxResponse(result, textStatus, response, placeHolder);
        });
        event.preventDefault();
    });
}

function ajaxLinkClick(selector) {
    $(selector).live("click", function (event) {
        var url = this.href;
        $.get(url, null, handleAjaxResponse);
        event.preventDefault();
    });
}

var logoutTime = 15;
var minutes = logoutTime;
var seconds = 00;

function StartLogoutTimer(m) {
    logoutTime = m;
    minutes = m;
    seconds = 00;

    $(document).ready(scheduleAutoLogout);
}

function scheduleAutoLogout() {
    var span = $("#lcm");
    if (span.length == 1) {
        setTimeout(updateAutoLogout, 0);
    }
}

var logoutAction = null;
function updateAutoLogout() {
    $("#lcm").text(minutes);
    $("#lcs").text(seconds >= 10 ? seconds : "0" + seconds);
    if (seconds == 0) {
        if (minutes == 0) {
            if (!logoutAction || !logoutAction()) {
                window.location = $("a#logout").attr("href");
            }
            return;
        }
        minutes = minutes - 1;
        seconds = 59;
    }
    else
        seconds = seconds - 1;
    setTimeout(updateAutoLogout, 1000);
}

function additionalFieldsSwitch(showLinkText, hideLinkText) {
    $("#showAdditional").live("click", function (event) {
        if ($("#advancedSearch").is(":visible")) {
            $(this).text(showLinkText);
            $("#advancedSearch").hide();
            $("#Advanced").val("False");
            $("#advancedSearch input, #advancedSearch select").attr("disabled", true);
        } else {
            $(this).text(hideLinkText);
            $("#advancedSearch").show();
            $("#Advanced").val("True");
            $("#advancedSearch input, #advancedSearch select").attr("disabled", false);
        }
        event.preventDefault();
    });
}

function transactionDetailsSwitch(showLinkText, hideLinkText) {
    $("td a").live("click", function (event) {
        var details = $(this).parents("tr").next();
        if (details.is(":visible")) {
            $(this).text(showLinkText);
            details.hide();
        } else {
            $(this).text(hideLinkText);
            details.show();
        }
        event.preventDefault();
    });
}

function selectAddress() {
    $('input[name=SetNewAddress]').live('click', function (e) {
        if (this.value == "False") {
            $("#newAddress").hide();
        }
        else {
            $("#newAddress").show();
        }
    });
}

function switchQuickPayment() {
    $('input[name=Enabled]').live('click', function (e) {
        $('input[name=TransferLimitId]')[0].checked = true; // Daily Limit
    });
}

function privatePaymentExtraFeeSelector() {
    $("#CurrencyId").live("click", function (event) {
        $("#extraFee").text($("#extraFee" + this.value).val());
    });
}

function highlightPublicInfo() {
    $("#publicSettings label input[type='checkbox']").live("click", function (event) {
        var span = $(this).parents("tr").find("span");
        if (this.checked) {
            span.addClass("enabled").removeClass("disabled");
        } else {
            span.addClass("disabled").removeClass("enabled");
        }
    });
}

function selectAccountChange() {
    $("#accountSelect").live($.browser.msie ? "click" : "change", function (event) {
        if (this.selectedIndex > 0) {
            $("#AccountNumber").val(this.value);
        }
    });
}

function customQuestion() {
    $("#SecurityQuestionId").live($.browser.msie ? "click" : "change", function (event) {
        if (this.selectedIndex == this.options.length - 1) {
            $("#custom").show();
            $("#custom input").attr("disabled", false);

        }
        else {
            $("#custom").hide();
            $("#custom input").attr("disabled", true);
        }
    });
}

function customField(select, input) {
    $(select).live($.browser.msie ? "click" : "change", function (event) {
        if (this.selectedIndex == this.options.length - 1) {
            $(input).parent().show();
            $(input).attr("disabled", false);
        }
        else {
            $(input).parent().hide();
            $(input).attr("disabled", true);
        }
    });
}

function returnToMerchant() {
    logoutAction = function () {
        var returnButton = $("#returnToMerchant");
        if (returnButton.length == 0) return false;
        returnButton.click();
        return true;
    }

    $("#logout").live("click", function (event) {
        if (logoutAction()) {
            event.preventDefault();
        }
    });
}

function reloadCaptcha() {
    $("#captcha").live("click", function (event) {
        var r = "r=" + Math.round(Math.random() * 1000);
        var parts = this.src.split("?");
        if (parts.length > 1) {
            var q = parts[1].replace(/^r=\d+/, "").replace(/&r=\d+/, "");
            if (q.length > 0) {
                r = q + "&" + r;
            }
        }

        this.src = parts[0] + "?" + r;
        $("#turingnumber").focus().val("");
    });
    $("#turingnumber").live("keypress", function (e) {
        return filterKeys(e, allowDigits);
    });
}

function filterKeys(e, filter) {
    if (e.ctrlKey || e.altKey || e.keyCode == 8 || e.keyCode == 13 || e.keyCode == 9) {
        return true;
    }
    return e.which == 0 || filter && filter(e);
}

function allowDigits(e) {
    return e.which >= 48 && e.which <= 57;
}

function allowPin(e) {
    return allowDigits(e) || e.which == 45;
}

function filterResponseCode() {
    $("#ResponseCode").live("keypress", function (e) {
        return filterKeys(e, allowDigits);
    });
}

function filterLongPinCode() {
    $("#Code").live("keypress", function (e) {
        return filterKeys(e, allowPin);
    });
}

function showRegions(countryId, regionId) {
    if (!countryId) countryId = "#CountryId";
    if (!regionId) regionId = "#Region";
    var value = $(countryId).val();
    var regionsId = "regions-{0}".format(value);
    var current = $("select[id|=regions]:not(:hidden)").attr("id");
    if (current != regionsId) {
        $("select[id|=regions]").hide().attr("disabled", "disabled");
        var select = $("#" + regionsId);
        select.show().removeAttr("disabled");
        if (select.length > 0) {
            $("input" + regionId).hide().attr("disabled", "disabled");
        } else {
            $("input" + regionId).show().removeAttr("disabled");
        }
    }
}

function countryRegions(countryId, regionId) {
    if (!countryId) countryId = "#CountryId";
    if (!regionId) regionId = "#Region";
    $(countryId).live($.browser.msie ? "click" : "change", function () {
        showRegions(countryId, regionId)
    });
    $(countryId).live("keyup", function () {
        showRegions(countryId, regionId)
    });
}

function disableContinueButton() {
    $("#verifyMessage input[name='Continue']").attr("disabled", "disabled");
}

function enableContinueButton() {
    $("#verifyMessage input[name='Confirm']").live("click", function (event) {
        var button = $("#verifyMessage input[name='Continue']");
        if (this.checked) {
            button.removeAttr("disabled");
        }
        else {
            button.attr("disabled", "disabled");
        }
    });
}

function showKeyboard() {
    $("span.keyboard").show();
    $("span.fullkeyboard").show();
    $("span.fullkeyboard b:not([id])").each(function () {
        if (this.lowerCaseChar) return;
        var text = $(this).text();
        this.lowerCaseChar = text.charAt(0);
        this.upperCaseChar = text.charAt(1);
        $(this).text(this.lowerCaseChar);
    });

    $("span.keyboard, span.fullkeyboard").each(function () {
        this.onselectstart = function () { return false; };
        this.unselectable = "on";
    });
}

var keyboardOwner = null;
var focusKeyboard = null;
function activateKeyboard(container, field) {
    var keyboard = container + " span.keyboard";
    $(keyboard).live("mousedown", function (event) {
        keyboardOwner = field;
        if (focusKeyboard == field) event.preventDefault();
    });
    $(keyboard).live("click", function (event) {
        keyboardOwner = null;
    });
    $(keyboard + " b:not(#clear)").live("click", function (event) {
        var value = $(field).val();
        if (value.length < $(field).attr("maxlength")) {
            $(field).val(value + $(this).text());
        }
    });
    $(keyboard + " b#clear").live("click", function (event) {
        $(field).val("");
    });

    function blockKey(event) { event.preventDefault(); }
    $(field)
        .live("keydown", blockKey)
        .live("keyup", blockKey)
        .live("keypress", blockKey)
        .attr("tabindex", -1);

    ajaxRefreshAction = showKeyboard;
}

function dynamicKeyboard(container, field) {
    $(field).live("focusin", function (event) {
        focusKeyboard = field;
        $(container).show();
    });
    $(field).live("focusout", function (event) {
        if (keyboardOwner && keyboardOwner == field) {
            $(field).focus();
        } else {
            $(container).hide();
        }
        keyboardOwner = null;
    });
}

function masterKeyKeyboard() { activateKeyboard("#masterKey", "#MasterKeyCode"); showKeyboard(); }
function loginPinKeyboard() { activateKeyboard("#loginPin", "#LoginPinCode"); showKeyboard(); }

function setKeyboardStyle(keyboard) {
    if ($(keyboard + " b.keyCapsLock").hasClass("down") ^ $(keyboard + " b#shift").hasClass("down")) {
        $(keyboard + " b:not([id])").each(function () {
            $(this).text(this.upperCaseChar);
        });
    } else {
        $(keyboard + " b:not([id])").each(function () {
            $(this).text(this.lowerCaseChar);
        });
    }
}

var keyboardKeyField = null;
function fullKeyboard(container, field) {
    var keyboard = container + " span.fullkeyboard";
    $(keyboard).live("mousedown", function (event) {
        keyboardOwner = field;
        if (focusKeyboard == field) event.preventDefault();
    });
    $(keyboard).live("click", function (event) {
        keyboardOwner = null;
    });
    $(keyboard + " b:not([id])").live("click", function (event) {
        var fieldobject = $(field)[0];
        $(field).val($(field).val() + $(this).text());
        $(keyboard + " b#shift").removeClass("down");
        setKeyboardStyle(keyboard);
    });
    $(keyboard + " b#clear").live("click", function (event) {
        $(field).val("");
    });
    $(keyboard + " b#back").live("click", function (event) {
        var val = $(field).val();
        $(field).val(val.length > 0 ? val.substr(0, val.length - 1) : val);
    });
    $(keyboard + " b#capslock," + keyboard + " b#shift").live("click", function (event) {
        $(this).toggleClass("down");
        setKeyboardStyle(keyboard);
    });

    ajaxRefreshAction = showKeyboard;
    showKeyboard();
}

var validateDangerousString = true;
$(document).ready(function () { checkDangerousString(); });

function checkDangerousString() {
    if (validateDangerousString)
        $('form :text,:password,textarea').live('keyup', function (event) {
            var errorSpan = 'span#forbidden'; var inputErrorClass = 'input-forbidden-error'; var captchaId = 'TuringNumber';
            if (isDangerousString($(this).val())) {
                if ($(this)[0].id == captchaId) {
                    if ($(this).parent().parent().find(errorSpan).length) {
                        $(this).parent().parent().find(errorSpan).text(dangerousStringMessage)
                    } else { $(this).parent().parent().append($('<span id="forbidden" class="field-validation-error">' + dangerousStringMessage + '</span>')); $(this).addClass(inputErrorClass); }
                } else {
                    if ($(this).parent().find(errorSpan).length) {
                        $(this).parent().find(errorSpan).text(dangerousStringMessage)
                    } else { $(this).parent().append($('<span id="forbidden" class="field-validation-error">' + dangerousStringMessage + '</span>')); $(this).addClass(inputErrorClass); }
                }
            } else {
                if ($(this)[0].id == captchaId) {
                    if ($(this).parent().parent().find(errorSpan).length) { $(this).parent().parent().find(errorSpan).remove(); $(this).removeClass(inputErrorClass); }
                } else { if ($(this).parent().find(errorSpan).length) { $(this).parent().find(errorSpan).remove(); $(this).removeClass(inputErrorClass); } }
            }
        });
}

function isDangerousString(string) {
    if ((!string) || string.length == 0) return false;
    var startIndex = 0;
    while (true) {
        var num2 = string.indexOf('<', startIndex);
        if (num2 < 0) num2 = string.indexOf('&', startIndex);
        if (num2 < 0) return false;
        if (num2 == (string.length - 1)) return false;
        var ch = string[num2];
        if (ch != '&') {
            if ((ch == '<') && ((!(/\W/.test(string[num2 + 1])) || (string[num2 + 1] == '!')) || ((string[num2 + 1] == '/') || (string[num2 + 1] == '?')))) {
                return true;
            }
        }
        else if (string[num2 + 1] == '#') return true;
        startIndex = num2 + 1;
    }
}

function checkTextAreaCounter(textAreaId, maxcount, bottonHolder, counter) {
    if (!bottonHolder) bottonHolder = '#placeholder';
    if (!counter) counter = '.count';

    updateCounter = function () {
        if ($(textAreaId).size() == 0)
            return;
        var txt = $(textAreaId).val();
        var cleft = maxcount - txt.length;
        if (cleft < 0) {
            $(counter).addClass('negative');
            $(bottonHolder + ' input[type=submit]').attr("disabled", "disabled");
        }
        else {
            $(counter).removeClass('negative');
            $(bottonHolder + ' input[type=submit]').removeAttr("disabled");
        }
        $(counter).html(cleft);
    }

    $(textAreaId).live('keyup', updateCounter);
    ajaxRefreshAction = updateCounter;
    updateCounter();
}

//oncontextmenu = "alert('Copying Prohibited by Law - McAfee Secure is a Trademark of McAfee, Inc.'); return false;"
//$("#mcafee img").bind("contextmenu", function () { alert('Copying Prohibited by Law - McAfee Secure is a Trademark of McAfee, Inc.'); return false; });
