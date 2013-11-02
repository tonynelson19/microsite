$(function() {

    APP = {

        Carousels: {

            init: function() {

                var self = this;

                $(document).on('page:reloaded', function() {
                    self.init();
                });

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

                    console.log(hash);

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

        },

        Thumbnails: {

            init: function() {

                var self = this;

                $(document).on('page:reloaded', function() {
                    self.init();
                });

                var thumbnails = $('.thumbnails');

                if (thumbnails.length) {

                    thumbnails.find('a:first').addClass('active');

                    var links = thumbnails.find('a');
                    var iframe = $('.modal iframe');

                    links.on('click', function(e) {
                        e.preventDefault();
                        var link = $(this);
                        console.log(link.data('url'));
                        iframe.attr('src', link.data('url'));
                        links.removeClass('active');
                        link.addClass('active');
                    });

                }

            }

        }

    }

    APP.Carousels.init();
    APP.Links.init();
    APP.Menu.init();
    APP.Modals.init();
    APP.Thumbnails.init();

});