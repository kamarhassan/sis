// Cart items Control
class MobileDesktopToggleControl extends Control {
    groupId() {
        return 'block_options';
    }

    getControl() {
        return $(this.selector);
    }

    renderHtml() {
        var thisControl = this;
        var html = `
            <div id="ProductListControl">
                <div class="control-[ID]">
                    <div class="widget-section hide-mobile toggle-desktop-mobile">
                        <div class="des-hide-on"><p>{language.wpanel.controls.description.title}</p></div>
                        <div class="row group-button">
                            <div class="col-sm-4 hide-on">
                                <div class="widget-lable">{language.wpanel.controls.hide_on.title}</div>
                            </div>
                            <div class="col-sm-8 desk-mobi">
                                <i class="{builder-icon-times-circle} clear-icon" style="display:none"></i>
                                <div class="btn-group">
                                    <button class="btn btn-select-type" data-type="desktop">{language.wpanel.controls.hide_on.desktop}</button>
                                    <button class="btn btn-select-type" data-type="mobile">{language.wpanel.controls.hide_on.mobile}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        thisControl.selector = ".control-" + thisControl.id;

        html = html.replace("[ID]", thisControl.id);
        html = html.replace("[TITLE]", thisControl.title);

        var div = $('<DIV>').html(html);
        
        return div.html();
    }

    selectType(type) {
        this.getControl().find('.btn-select-type').removeClass('active');
        this.getControl().find('.btn-select-type[data-type="' + type + '"]').addClass('active');
        this.getControl().find('.clear-icon').show();

        this.callback(type);
    }

    clearAll() {
        this.getControl().find('.btn-select-type').removeClass('active');
        this.getControl().find('.clear-icon').hide();

        this.callback('');
    }

    afterRender() {
        var _this = this;

        // set value
        if (_this.value.type == 'desktop' || _this.value.type == 'mobile') {
            _this.selectType(_this.value.type);
        }

        this.getControl().find('.btn-select-type').on('click', function() {
            var type = $(this).attr('data-type');

            _this.selectType(type);
        });

        this.getControl().find('.clear-icon').on('click', function() {
            var type = $(this).attr('data-type');

            _this.clearAll();
        });
    }
}

window.MobileDesktopToggleControl = MobileDesktopToggleControl;