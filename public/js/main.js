$(function() {

    APP = {

        Carousels: {

            init: function() {

                var carousels = $('.carousel');

                carousels.hammer().on('swipeleft', function() {
                    $(this).carousel('next');
                });

                carousels.hammer().on('swiperight', function() {
                    $(this).carousel('prev');
                });

            }

        },

        Categories: {

            init: function() {

                var self = this;
                var categories = $('.category ul');

                if (categories.length) {

                    var maxHeight = 0;
                    categories.each(function() {
                        var height = $(this).innerHeight();

                        if (height > maxHeight) {
                            maxHeight = height;
                        }
                    });

                    categories.css('height', maxHeight);

                }

                $(document).on('page:reloaded', function() {
                    self.init();
                });

            }

        },

        Links: {

            init: function() {

                var self = this;
                var target = '.wrapper';
                var wrapper = $(target);

                wrapper.on('click', 'a', function(e) {
                    var link = $(this);

                    if (link.hasClass('external')) {
                        return;
                    }

                    var url = link.attr('href');
                    var hash = self.parseUrl(url).hash;

                    if (hash !== '') {
                        return;
                    }

                    e.preventDefault();

                    wrapper.load(url + ' ' + target, function() {
                        $(window).scrollTop(0, 0);
                        $(document).trigger('page:reloaded');
                    });
                });

            },

            parseUrl: function(url) {
                var a = document.createElement('a');
                a.href = url;
                return a;
            }

        },

        Menu: {

            init: function() {

                $(document).on('click', function(e) {

                    var target = $(e.target);
                    if (!target.is('.menu-options') && !target.closest('.menu-options').length) {
                        $('.menu-options ul').hide();
                    }

                });

                $(document).on('click', '.menu', function(e) {
                    e.preventDefault();
                    var options = $('.menu-options ul');
                    options.toggle();
                    return false;
                });

            }

        },

        Modals: {

            init: function() {

                var self = this;

                $(document).on('show.bs.modal', '.modal', function() {
                    self.reloadIframe();
                });

                $(document).on('hide.bs.modal', '.modal', function() {
                    self.reloadIframe();
                });

            },

            reloadIframe: function() {
                var iframe = $('.modal iframe');
                iframe.attr('src', iframe.attr('src'));
            }

        }

    }

    // APP.Categories.init();
    APP.Carousels.init();
    APP.Links.init();
    APP.Menu.init();
    APP.Modals.init();

});