﻿(function ($) {
    $.fn.imageTooltip = function (options) {

        var defaults = {
            imgWidth: 'initial',
            backgroundColor: '#fff'
        };

        if (typeof (options) === 'object') {
            options = $.extend(defaults, options);
        } else {
            var tempOptions = {};
            tempOptions.imgWidth = arguments[0] || defaults.imgWidth;
            tempOptions.backgroundColor = arguments[1] || defaults.backgroundColor;
            options = tempOptions;
        }

        function calLeft(x, imgWidth) {
            return window.innerWidth - x > imgWidth ? (x + 20) : x - (imgWidth + 20);
        }

        function calTop(y, imgHeight) {
            return window.innerHeight - y > imgHeight ? (y + 20) : y - (imgHeight + 50) - 25;
        }

        return this.each(function () {

            var imgContainer = $('<p>', {
                css: {
                    display: 'none',
                    backgroundColor: options.backgroundColor,
                    padding: '5px',
                    position: 'fixed'
                }
            });

            var img = $('<img>', {
                src: $(this).data('image-tooltip') || $(this).attr('src'),
                alt: 'Image Not Available',
//                width: options.imgWidth
                width: 300
            });

            imgContainer.append(img);

            $(this).hover(
                function (e) {
                    imgContainer.css({
                        left: calLeft(e.clientX, imgContainer.outerWidth()) + 'px',
                        top: calTop(e.clientY, imgContainer.outerHeight()) + 'px'
                    });
                    $('body').append(imgContainer);
                    imgContainer.fadeIn('fast');
                },
                function () {
                    imgContainer.remove();
                }
            ).mousemove(function (e) {
                imgContainer.css({
                    left: calLeft(e.clientX, imgContainer.outerWidth()) + 'px',
                    top: calTop(e.clientY, imgContainer.outerHeight()) + 'px'
                });
            });
        });
    };
}(jQuery));