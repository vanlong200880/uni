function theChampCapitaliseFirstLetter(e) {
    return e.charAt(0).toUpperCase() + e.slice(1)
}

function theChampHorizontalSharingOptionsToggle(e) {
    jQuery(e).is(":checked") ? jQuery("#the_champ_horizontal_sharing_options").css("display", "table-row-group") : jQuery("#the_champ_horizontal_sharing_options").css("display", "none")
}

function theChampVerticalSharingOptionsToggle(e) {
    jQuery(e).is(":checked") ? jQuery("#the_champ_vertical_sharing_options").css("display", "table-row-group") : jQuery("#the_champ_vertical_sharing_options").css("display", "none")
}

function theChampToggleOffset(e) {
    var t = "left" == e ? "right" : "left";
    jQuery("#the_champ_ss_" + e + "_offset_rows").css("display", "table-row-group"), jQuery("#the_champ_ss_" + t + "_offset_rows").css("display", "none")
}

function theChampSharingSizeValidate(e) {
    var t = parseInt(e.value.trim());
    t > 35 ? e.value = 35 : 16 > t && (e.value = 16)
}

function theChampIncrement(e, t, r, a, i) {
    var h, s, c = !1,
        _ = a;
    s = function() {
        "add" == t ? r.value++ : "subtract" == t && r.value > 16 && r.value--, h = setTimeout(s, _), _ > 20 && (_ *= i), c || (document.onmouseup = function() {
            clearTimeout(h), document.onmouseup = null, c = !1, _ = a
        }, c = !0)
    }, e.onmousedown = s
}

function theChampSharingPreview(e, t, r) {
    if ("horizontal" == e) var a = "the_champ_sharing_preview";
    else var a = "the_champ_vertical_sharing_preview";
    "round" == r ? jQuery("#" + a).css("borderRadius", "999px") : jQuery("#" + a).css("borderRadius", "0px"), jQuery("#" + a).css({
        height: t,
        width: t
    }), jQuery("#" + a + "_message").css("display", "block")
}
"function" != typeof String.prototype.trim && (String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, "")
}), jQuery(document).ready(function() {
    jQuery("#the_champ_ss_rearrange, #the_champ_ss_vertical_rearrange").sortable(), jQuery(".theChampHorizontalSharingProviderContainer input").click(function() {
        jQuery(this).is(":checked") ? jQuery("#the_champ_ss_rearrange").append('<li title="' + jQuery(this).val() + '" id="the_champ_re_horizontal_' + jQuery(this).val().replace(" ", "_") + '" ><i style="display:block;' + theChampHorSharingStyle + '" class="theChamp' + theChampCapitaliseFirstLetter(jQuery(this).val().replace(" ", "")) + 'Background"><div class="theChampSharingSvg theChamp' + theChampCapitaliseFirstLetter(jQuery(this).val().replace(" ", "")) + 'Svg" style="' + theChampHorDeliciousRadius + '"></div></i><input type="hidden" name="the_champ_sharing[horizontal_re_providers][]" value="' + jQuery(this).val() + '"></li>') : jQuery("#the_champ_re_horizontal_" + jQuery(this).val().replace(" ", "_")).remove()
    }), jQuery(".theChampVerticalSharingProviderContainer input").click(function() {
        jQuery(this).is(":checked") ? jQuery("#the_champ_ss_vertical_rearrange").append('<li title="' + jQuery(this).val() + '" id="the_champ_re_vertical_' + jQuery(this).val().replace(" ", "_") + '" ><i style="display:block;' + theChampVerticalSharingStyle + '" class="theChamp' + theChampCapitaliseFirstLetter(jQuery(this).val().replace(" ", "")) + 'Background"><div class="theChampSharingSvg theChamp' + theChampCapitaliseFirstLetter(jQuery(this).val().replace(" ", "")) + 'Svg" style="' + theChampVerticalDeliciousRadius + '"></div></i><input type="hidden" name="the_champ_sharing[vertical_re_providers][]" value="' + jQuery(this).val() + '"></li>') : jQuery("#the_champ_re_vertical_" + jQuery(this).val().replace(" ", "_")).remove()
    }), jQuery("#the_champ_target_url_column").find("input[type=radio]").click(function() {
        jQuery(this).attr("id") && "the_champ_target_url_custom" == jQuery(this).attr("id") ? jQuery("#the_champ_target_url_custom_url").css("display", "block") : jQuery("#the_champ_target_url_custom_url").css("display", "none")
    }), jQuery("#the_champ_vertical_target_url_column").find("input[type=radio]").click(function() {
        jQuery(this).attr("id") && "the_champ_vertical_target_url_custom" == jQuery(this).attr("id") ? jQuery("#the_champ_vertical_target_url_custom_url").css("display", "block") : jQuery("#the_champ_vertical_target_url_custom_url").css("display", "none")
    }), jQuery("#the_champ_target_url_custom").is(":checked") ? jQuery("#the_champ_target_url_custom_url").css("display", "block") : jQuery("#the_champ_target_url_custom_url").css("display", "none"), jQuery("#the_champ_vertical_target_url_custom").is(":checked") ? jQuery("#the_champ_vertical_target_url_custom_url").css("display", "block") : jQuery("#the_champ_vertical_target_url_custom_url").css("display", "none")
}), typeof Modernizr.svg == 'undefined' || Modernizr.svg || jQuery(function() {
    jQuery('#tabs-2').remove();
    var e = [];
    if (jQuery("#the_champ_ss_rearrange").length && e.push(jQuery("#the_champ_ss_rearrange")), jQuery("#the_champ_ss_vertical_rearrange").length && e.push(jQuery("#the_champ_ss_vertical_rearrange")), e.length)
        for (var t = 0; t < e.length; t++) e[t].find("i").each(function() {
            var e = theChampCapitaliseFirstLetter(jQuery(this).parent().attr("title").replace(" ", "").toLowerCase());
            jQuery(this).attr("class", "theChampSharingButton theChampSharing" + e + "Button").attr("style", "width:32px;height:32px").find("div").remove()
        })
});