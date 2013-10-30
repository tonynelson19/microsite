$(function() {

    APP = {

        Carousels: {

            init: function() {

                var self = this;
                var carousels = $('.carousel');

                carousels.carousel({
                    interval: 4000
                });

                carousels.hammer().on('swipeleft', function() {
                    $(this).carousel('next');
                });

                carousels.hammer().on('swiperight', function() {
                    $(this).carousel('prev');
                });

                $(document).on('page:reloaded', function() {
                    self.init();
                });

            }

        },

        Links: {

            init: function() {

                var self = this;

                $('.wrapper').on('click', 'a', function(e) {
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

                    $.ajax({
                        url: url,
                        success: function(response) {
                            var content = $('<div>' + response + '</div>').find('.wrapper').html();
                            console.log(content);
                            $('.wrapper').html(content);
                            $(window).scrollTop(0, 0);
                            $(document).trigger('page:reloaded');
                            console.log('here');
                        }
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

    APP.Carousels.init();
    APP.Links.init();
    APP.Menu.init();
    APP.Modals.init();

});