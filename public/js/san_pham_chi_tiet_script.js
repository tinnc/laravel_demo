(function($) {
    $.fn.magnify = function(oOptions) {

        var oSettings = $.extend({
                debug: false,
                speed: 100
            }, oOptions),
            $anchor,
            $container,
            $image,
            $lens,
            nMagnifiedWidth = 0,
            nMagnifiedHeight = 0,
            init = function(el) {
                $image = $(el);
                $anchor = $image.parents('a');
                zoom($image.attr('data-magnify-src') || oSettings.src || $anchor.attr('href') || '');
            },
            zoom = function(sImgSrc, bAnchor) {
                if (!sImgSrc) return;
                var elImage = new Image();
                $(elImage).on({
                    load: function() {
                        $image.css('display', 'block');

                        if (!$image.parent('.magnify').length) {
                            $image.wrap('<div class="magnify"></div>');
                        }
                        $container = $image.parent('.magnify');
                        if ($image.prev('.magnify-lens').length) {
                            $container.children('.magnify-lens').css('background-image', 'url(' + sImgSrc + ')');
                        } else {
                            $image.before('<div class="magnify-lens loading" style="background:url(' + sImgSrc + ') no-repeat 0 0"></div>');
                        }
                        $lens = $container.children('.magnify-lens');

                        $lens.removeClass('loading');
                        nMagnifiedWidth = elImage.width;
                        nMagnifiedHeight = elImage.height;
                        if (oSettings.debug) console.log('[MAGNIFY] Got zoom image dimensions OK (width x height): ' + nMagnifiedWidth + ' x ' + nMagnifiedHeight);
                        elImage = null;

                        $container.mousemove(function(e) {
                            var oMagnifyOffset = $container.offset(),
                                nX = e.pageX - oMagnifyOffset.left;
                            nY = e.pageY - oMagnifyOffset.top;
                            if (nX < $container.width() && nY < $container.height() && nX > 0 && nY > 0) {
                                $lens.fadeIn(oSettings.speed);
                            } else {
                                $lens.fadeOut(oSettings.speed);
                            }
                            if ($lens.is(':visible')) {
                                var nPosX = nX - $lens.width() / 2,
                                    nPosY = nY - $lens.height() / 2;
                                if (nMagnifiedWidth && nMagnifiedHeight) {
                                    var nRatioX = Math.round(nX / $image.width() * nMagnifiedWidth - $lens.width() / 2) * -1,
                                        nRatioY = Math.round(nY / $image.height() * nMagnifiedHeight - $lens.height() / 2) * -1,
                                        sBgPos = nRatioX + 'px ' + nRatioY + 'px';
                                }

                                $lens.css({
                                    top: Math.round(nPosY) + 'px',
                                    left: Math.round(nPosX) + 'px',
                                    backgroundPosition: sBgPos || ''
                                });
                            }
                        });

                        if ($anchor.length) {
                            $anchor.css('display', 'inline-block');
                            if (bAnchor || ($anchor.attr('href') && !($image.attr('data-magnify-src') || oSettings.src))) {
                                $anchor.click(function(e) {
                                    e.preventDefault();
                                });
                            }
                        }

                    },
                    error: function() {
                        // Clean up
                        elImage = null;
                        if (bAnchor) {
                            if (oSettings.debug) console.log('[MAGNIFY] Parent anchor zoom source is invalid also. Disabling zoom...');
                        } else {
                            if (oSettings.debug) console.log('[MAGNIFY] Invalid data-magnify-src. Looking in parent anchor instead -> ' + $anchor.attr('href'));
                            zoom($anchor.attr('href'), true);
                        }
                    }
                });

                elImage.src = sImgSrc;
            };

        return this.each(function() {
            init(this);
        });

    };
}(jQuery));

$(document).ready(function() {
    $('.image_chi_tiet_san_pham img').magnify();
});