// show/hide devices menu
window.showDevicesDropdown = function(type) {
    $('.devices-list').hide();
    $('.devices-list.' + type).show();

    $('.header-dropdown.devices-menu').removeClass('hide');
};
window.hideDevicesDropdown = function() {
    $('.header-dropdown.devices-menu').addClass('hide');
};

// show/hide main menu
window.showMainMenuDropdown = function() {
    // change icon
    var closeHtml = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36"><path class="clr-i-outline clr-i-outline-path-1" d="M19.41 18l8.29-8.29a1 1 0 0 0-1.41-1.41L18 16.59l-8.29-8.3a1 1 0 0 0-1.42 1.42l8.3 8.29l-8.3 8.29A1 1 0 1 0 9.7 27.7l8.3-8.29l8.29 8.29a1 1 0 0 0 1.41-1.41z" fill="#626262"/></svg>`;
    $('.menu-button.right-menu i').html(closeHtml);

    $('.header-dropdown.header-menu').removeClass('hide');
};
window.hideMainMenuDropdown = function() {
    // change icon
    var menuHtml = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g fill="none"><path d="M4 4h4v4H4V4z" fill="#626262"/><path d="M4 10h4v4H4v-4z" fill="#626262"/><path d="M8 16H4v4h4v-4z" fill="#626262"/><path d="M10 4h4v4h-4V4z" fill="#626262"/><path d="M14 10h-4v4h4v-4z" fill="#626262"/><path d="M10 16h4v4h-4v-4z" fill="#626262"/><path d="M20 4h-4v4h4V4z" fill="#626262"/><path d="M16 10h4v4h-4v-4z" fill="#626262"/><path d="M20 16h-4v4h4v-4z" fill="#626262"/></g></svg>`;
    $('.menu-button.right-menu i').html(menuHtml);

    $('.header-dropdown.header-menu').addClass('hide');
    $('.header-dropdown.devices-menu').addClass('hide');
};

// show alert
window.beeAlertTimeout = null;
window.beeAlert = function(title, msg) {
    $('.footer-dropup.bee-alert').find('.message label').html(title);
    $('.footer-dropup.bee-alert').find('.message p').html(msg);

    // show panel
    $('.footer-dropup.bee-alert').removeClass('hide');

    // setimeout
    if (beeAlertTimeout) {
        clearTimeout(beeAlertTimeout);
    }
    beeAlertTimeout = setTimeout(() => {
        $('.footer-dropup.bee-alert').addClass('hide');
    }, 2000);
};

window.goToSecondPage = function () {
    // change icon
    var icon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="#626262" d="M80 96h352v32H80z"/><path fill="#626262" d="M80 240h352v32H80z"/><path fill="#626262" d="M80 384h352v32H80z"/></svg>';
    $('.menu-button.left-menu i').html(icon);

    $('.beepro-sidebar').removeClass('is-main-page');
    $('.beepro-sidebar').removeClass('is-third-page');
    $('.beepro-sidebar').addClass('is-second-page');
    currentEditor.unselect();
}
window.goToThirdPage = function () {
    // change icon
    var icon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path fill="#626262" d="M80 96h352v32H80z"/><path fill="#626262" d="M80 240h352v32H80z"/><path fill="#626262" d="M80 384h352v32H80z"/></svg>';
    $('.menu-button.left-menu i').html(icon);

    $('.beepro-sidebar').removeClass('is-main-page');
    $('.beepro-sidebar').removeClass('is-second-page');
    $('.beepro-sidebar').addClass('is-third-page');
}
window.goToMainPage = function() {
    // change icon
    var icon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path d="M30 23v-2h-2.09a5.96 5.96 0 0 0-1.024-2.47l1.478-1.48l-1.414-1.414l-1.479 1.479A5.958 5.958 0 0 0 23 16.09V14h-2v2.09a5.958 5.958 0 0 0-2.47 1.024l-1.48-1.478l-1.414 1.414l1.479 1.479A5.962 5.962 0 0 0 16.09 21H14v2h2.09a5.962 5.962 0 0 0 1.024 2.47l-1.478 1.48l1.414 1.414l1.479-1.479A5.958 5.958 0 0 0 21 27.91V30h2v-2.09a5.958 5.958 0 0 0 2.47-1.024l1.48 1.478l1.414-1.414l-1.479-1.479A5.96 5.96 0 0 0 27.91 23zm-8 3a4 4 0 1 1 4-4a4.005 4.005 0 0 1-4 4z" fill="#626262"/><path d="M28 6a2 2 0 0 0-2-2h-4V2h-2v2h-8V2h-2v2H6a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h4v-2H6V6h4v2h2V6h8v2h2V6h4v6h2z" fill="#626262"/></svg>';
    $('.menu-button.left-menu i').html(icon);

    $('.beepro-sidebar').removeClass('is-second-page');
    $('.beepro-sidebar').removeClass('is-third-page');
    $('.beepro-sidebar').addClass('is-main-page');
    currentEditor.unselect();
}
window.goToListFieldsPage = function() {
    $('.second-page').hide();
    $('.second-page.list-fields').show();

    // slide to second page
    goToSecondPage();
}
window.goToGlobalTagsPage = function() {
    $('.second-page').hide();
    $('.second-page.global-tags').show();

    // slide to second page
    goToSecondPage();
}
window.showHtmlWidgetsPage = function() {
    $('.second-page').hide();
    $('.second-page.html-widgets').show();
}
window.goToHtmlWidgetsPage = function() {
    showHtmlWidgetsPage();

    // slide to second page
    goToSecondPage();
}
window.goToSwitchTemplatePage = function() {
    $('.second-page').hide();
    $('.second-page.switch-template').show();

    // slide to second page
    goToSecondPage();
}
window.hideDropup = function() {
    $('.footer-dropup').addClass('hide');

    // unhightlight history button
    $('.show-history').removeClass('active');

    // hide main menu dropdown
    hideMainMenuDropdown();
}

window.clickIframe = function() {
    // hide all dropup
    hideDropup();
}

$(document).ready(function() {
    // show history panel
    $(document).on('click', '.show-history', function() {
        var but = $(this);

        if ($('.footer-dropup.history').hasClass('hide')) {
            but.addClass('active');

            // show panel
            $('.footer-dropup.history').removeClass('hide');
        } else {
            but.removeClass('active');

            // show panel
            $('.footer-dropup.history').addClass('hide');
        }            
    });
    
    // search
    $(document).on('change keyup', 'input.main-search', function() {
        $(this).closest('.main-search-group').find('.not-item-search').removeClass('hide');
    });
    
    // menu button
    $(document).on('click', '.menu-button.right-menu', function() {
        if ($('.header-dropdown.header-menu').hasClass('hide')) {
            showMainMenuDropdown();
        } else {
            hideMainMenuDropdown();
        }
    });

    // menu button
    $(document).on('click', '.beepro-sidebar.is-second-page .menu-button.left-menu, .beepro-sidebar.is-third-page .menu-button.left-menu', function() {
        hideMainMenuDropdown();
        goToMainPage();
    });

    // menu button
    $(document).on('click', '.beepro-sidebar.is-main-page .menu-button.left-menu', function() {
        hideMainMenuDropdown();
        currentEditor.goToHomeTab();
    });
    
    // menu button
    $(document).on('click', '.source-code-header .close-button', function() {
        // bee pro
        $('body').removeClass('bp-source-mode');
        $('.view-source').hide();
    });

    // click clear design
    $(document).on('click', '.bp-template-clear', function() {
        currentEditor.clearDesign();
        hideMainMenuDropdown();
    });

    // change device
    $(document).on('click', '.device-button', function() {
        var tagClass = $(this).attr('data-value');
        
        // active button
        $('.device-button').removeClass('active');
        $(this).addClass('active');

        // active device
        $('.menu-device').removeClass('active');
        $('.menu-device-' + $(this).attr('data-device')).addClass('active');

        $(".beepro-content").removeClass (function (index, className) {
            return (className.match (/(^|\s)device-mode-\S+/g) || []).join(' ');
        });
        $('.beepro-content').addClass('device-mode-' + tagClass);

        // 
        if (tagClass == 'default-size') {
            hideDevicesDropdown();
        }
    });
    
    // change device
    $(document).on('keyup change', '.widget-search', function() {
        var value = $(this).val();
        var empty = true;
        
        $('.widgets-container .widget-item').each(function() {
            if ($(this).find('.body__title').html().toLowerCase().includes(value.toLowerCase().trim())) {
                $(this).show();
                empty = false;
            } else {
                $(this).hide();
            }
        });

        $('.widgets-container .not-item-search').remove();
        if (empty) {
            $('.widgets-container').append('<p class="my-1 mx-2 not-item-search">No items found!</p>')
        }
    });
    
    // attribute group toggle
    $(document).on('click', '.ag-toogle-button', function() {
        var button = $(this);
        var group = button.closest('.attributes-group, .atts-group');
        var content = group.find('.attributes, .atts-group-container');

        if (content.is(':visible')) {
            content.slideUp(100);
            button.removeClass('open');
        } else {
            content.slideDown(100);
            button.addClass('open');
        }
    });

    // click outside dropdown
    $(document).mouseup(function(e) 
    {
        var container = $(".footer-dropup, .dropup-button, .menu-button, .header-dropdown");
        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) 
        {
            hideDropup();
        }
    });

    // color picker
    $(document).on('change', '.color-picker [type=color]', function() {
        var pa = $(this).closest('.color-picker');

        pa.find('[type=text]').val($(this).val());
    });
    $(document).on('change', '.color-picker [type=text]', function() {
        var pa = $(this).closest('.color-picker');

        pa.find('[type=color]').val($(this).val());
    });
});