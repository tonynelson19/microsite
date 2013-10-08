$(function() {

    APP = {

        links: {

            init: function() {

                var target = '.wrapper';
                var wrapper = $(target);

                /*
                 wrapper.on('click', 'a', function(event) {
                 $.pjax.click(event, wrapper);
                 });
                 */

                wrapper.on('click', 'a', function(event) {
                    var link = $(this);

                    if (link.hasClass('external')) {
                        return;
                    }

                    var url = link.attr('href');
                    var hash = parseURL(url).hash;

                    if (hash !== '') {
                        return;
                    }

                    event.preventDefault();

                    wrapper.load(url + ' ' + target, function() {
                        $(window).scrollTop(0, 0);
                    });
                });

                function parseURL(url) {
                    var a = document.createElement('a');
                    a.href = url;
                    return a;
                }

            }

        }

    }

    // APP.links.init();

});