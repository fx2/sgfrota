$('#darkModeSwitch').click(function (e) {
        changeDarkMode(e.target.value)
    });
    // style="background-color: #343A40;"
    function changeDarkMode(darkMode = null){
        var dkModeLocal = localStorage.getItem("darkMode");

        if (dkModeLocal === 'true'){
            $('#darkModeSwitch').prop('checked', true);
            $('body').addClass('dark-mode');
            $('.main-header').addClass('dark-mode');
             $('.fa-bars').addClass('text-white');
             $('.darkModeSwitchLabelClass').addClass('text-white');
             $('.fa-expand-arrows-alt').addClass('text-white');

             $('.help-block').removeClass('text-danger');
             $('.help-block').addClass('text-warning');

             $('.select2-selection').addClass('dark-mode');
             $('.select2-selection__rendered').addClass('text-white')

        }

        if (dkModeLocal == 'false') {
            $('#darkModeSwitch').prop('checked', false);
            $('body').removeClass('dark-mode');
            $('.main-header').removeClass('dark-mode');
            $('.fa-bars').removeClass('text-white');
            $('.darkModeSwitchLabelClass').removeClass('text-white');
            $('.fa-expand-arrows-alt').removeClass('text-white');

            $('.help-block').removeClass('text-warning');
            $('.help-block').addClass('text-danger');

            $('.select2-selection').removeClass('dark-mode');
            $('.select2-selection__rendered').removeClass('text-white')
        }

        if (darkMode == 'on') {
            $('body').addClass('dark-mode');
            localStorage.setItem("darkMode", true);

            $('#darkModeSwitch').val('off');
            $('#darkModeSwitch').prop('checked', true);
            $('.main-header').addClass('dark-mode');
            $('.fa-bars').addClass('text-white');
            $('.darkModeSwitchLabelClass').addClass('text-white');
            $('.fa-expand-arrows-alt').addClass('text-white');

            $('.help-block').removeClass('text-danger');
            $('.help-block').addClass('text-warning');

            $('.select2-selection').addClass('dark-mode');
            $('.select2-selection__rendered').addClass('text-white')
        }

        if (darkMode == 'off') {
            $('body').removeClass('dark-mode');
            localStorage.setItem("darkMode", false);
            $('#darkModeSwitch').val('on');
            $('#darkModeSwitch').prop('checked', false);
            $('.main-header').removeClass('dark-mode');
            $('.fa-bars').removeClass('text-white');
            $('.fa-expand-arrows-alt').removeClass('text-white');
            $('.darkModeSwitchLabelClass').removeClass('text-white');
            
            $('.help-block').removeClass('text-warning');
            $('.help-block').addClass('text-danger');

            $('.select2-selection').removeClass('dark-mode');
            $('.select2-selection__rendered').removeClass('text-white')
        }
    }
