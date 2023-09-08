class CaptchaToggleControl extends Control {
    renderHtml() {
        var thisControl = this;
        var html = $('#CaptchaToggleControl').html();
        thisControl.selector = ".control-" + thisControl.id;

        html = html.replace("[ID]", thisControl.id);

        var div = $('<DIV>').html(html);
        
        return div.html();
    }

    getCaptchaSwitch() {
        var thisControl = this;
        
        return $(thisControl.selector).find('.captcha-switch');
    }

    captchaShowed() {
        var thisControl = this;

        return thisControl.getCaptchaSwitch().attr('data-checked') == 'true';
    }

    hideCaptcha() {
        var thisControl = this;

        thisControl.getCaptchaSwitch().attr('data-checked', 'false');
        thisControl.getCaptchaSwitch().find('.material-icons').html('toggle_off');
        thisControl.getCaptchaSwitch().find('.material-icons').addClass('text-secondary');
        thisControl.getCaptchaSwitch().find('.material-icons').removeClass('text-primary');

        thisControl.update();
    }

    showCaptcha() {
        var thisControl = this;

        thisControl.getCaptchaSwitch().attr('data-checked', 'true');
        thisControl.getCaptchaSwitch().find('.material-icons').html('toggle_on');
        thisControl.getCaptchaSwitch().find('.material-icons').removeClass('text-secondary');
        thisControl.getCaptchaSwitch().find('.material-icons').addClass('text-primary');

        thisControl.update();
    }

    toggleCaptcha() {
        var thisControl = this;

        if (thisControl.captchaShowed()) {
            thisControl.hideCaptcha();
        } else {
            thisControl.showCaptcha();
        }
    }

    update() {
        var thisControl = this;

        thisControl.callback(thisControl.captchaShowed());
    }

    afterRender() {
        var thisControl = this

        // captcha on/off
        $(thisControl.selector).find('.captcha-switch').click(function() {
            thisControl.toggleCaptcha();            
        });
        
        // check if captcha is showed
        if (!thisControl.value) {
            thisControl.hideCaptcha();
        }
    }
}

window.CaptchaToggleControl = CaptchaToggleControl;