class IconsContainerControl extends Control {
    renderHtml() {
        return `
            <div class="d-flex justify-content-center align-items-center px-2 py-3 control-`+this.id+`">
                <button class="btn btn-primary mr-2 add-icon d-flex align-items-center">
                    <i class="material-icons-outlined mr-1" style="font-size:18px;transform: translateY(2px);">add</i>
                    <span>{language.add_icon}</span>
                </button>
            </div>
        `;
    }

    getContainer() {
        return $('.control-' + this.id);
    }

    afterRender() {
        var _this = this;

        this.getContainer().find('.add-icon').on('click', function() {
            _this.callback.addIcon();
        });
    }
}

window.IconsContainerControl = IconsContainerControl;