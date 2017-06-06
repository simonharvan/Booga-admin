export default class MainView {

    constructor() {
        $('[data-href]').each(function () {
            if ($(this).is('tr')) {
                $(this).css('cursor', 'pointer').hover(
                    function () {
                        $(this).addClass('active');
                    },
                    function () {
                        $(this).removeClass('active');
                    }
                );
            }

            $(this).click(function () {
                document.location = $(this).attr('data-href');
            });
        });

        // Confirm action
        $('.confirm').on('submit click', function () {
            let $this = $(this);

            if (!confirm($this.data('confirm'))) {
                return false;
            }
        });

        $('[data-toggle="tooltip"]').tooltip();
    }
};

window.MainView = MainView;