/**
 * JQuery accesskey plugin
 *
 * shortaccesskey provides a simpler way to use the access keys assigned to HTML links.
 * You will be able to use access keys by just pressing the letter you have assigned to
 * the link instead of ALT+accesskey/ALT+SHIFT+accesskey making navigation easier for your users.
 *
 * Just call $.shortaccesskey.init() in $(document).ready
 *
 * @name shortaccesskey
 * @type jquery
 * @cat Plugin/Navigation
 * @return JQuery
 *
 * Copyright (c) 2009 Aditya Mooley <adityamooley@sanisoft.com>
 * Dual licensed under the MIT (MIT-LICENSE.txt) and GPL (GPL-LICENSE.txt) licenses
 */

(function ($) {
    $.shortaccesskey = function()
    {
        var i = 0;
        var accesskeyArr = new Array();

        $("a[accesskey]").each (function() {
            accesskeyArr[i] = $(this).attr('accesskey');
            i++;
        });

        $(document).bind('keypress', handleKeyPress);

        $("input,textarea,select").focus(function() {
            $(document).unbind('keypress');
        });

        $("input,textarea,select").blur(function() {
            $(document).bind('keypress', handleKeyPress);
        });

        function handleKeyPress (e) {
            var e = e || window.event;

            //keyCode - IE , charCode - NS6+
            var k = e.charCode || e.keyCode || 0;
            var keyPressed = String.fromCharCode(k);

            if ($.inArray(keyPressed, accesskeyArr) >= 0) {
                var ret = $("a[accesskey="+keyPressed+"]").triggerHandler('click');

                if (undefined == ret || true == ret) {
                    window.location = $("a[accesskey="+keyPressed+"]").attr("href");
                }
            }
        };
    };
})(jQuery);