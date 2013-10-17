$(function() {

    APP = {

        Confirm: {

            init: function() {

                $('[data-confirm]').on('click', function(e) {
                    e.preventDefault();

                    var element = $(this);

                    if (confirm(element.data('confirm'))) {
                        window.location = element.attr('href');
                    }
                });

            }

        },

        Delete: {

            init: function() {

                $('.btn-danger').each(function() {
                    var button = $(this);
                    button.css('margin-left', '6px');

                    button.prev().find('.btn-primary').after(button);
                });

            }

        },

        Editor: {

            init: function() {

                $('.js-editor').ckeditor({
                });

            }

        }

    };

    APP.Confirm.init();
    APP.Delete.init();
    APP.Editor.init();

});