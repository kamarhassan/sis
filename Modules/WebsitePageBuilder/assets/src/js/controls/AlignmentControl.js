class AlignmentControl extends Control {
    groupId() {
        return 'general';
    }

    renderHtml() {
        return `
            <div class="widget-section align pr-3 control-`+this.id+`">
                <div class="label">{language.wpanel.controls.align.title}</div>
                <div class="thongso background">
                    <div class="item_1-2 right" >
                        <div mailup-common-alignment-selector="" ng-model="style['text-align']" class="ng-pristine ng-untouched ng-valid ng-isolate-scope ng-not-empty">
                            <div class="alignment-container">
                                <button type="button" class="align btn btn-default align-left ng-pristine ng-valid ng-not-empty ng-touched" float="left" ng-model="value" data-value="left" style="">
                                </button>
                                <button type="button" class="align btn btn-default align-center ng-pristine ng-untouched ng-valid ng-not-empty active" float="center" ng-model="value" data-value="center">
                                </button>
                                <button type="button" class="align btn btn-default align-right ng-pristine ng-untouched ng-valid ng-not-empty" float="right" ng-model="value" data-value="right">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    getControl() {
        return $('.control-' + this.id);
    }

    afterRender() {
        var _this = this;

        _this.getControl().find('button.align-' + _this.value.align).addClass('current');

        _this.getControl().find('button.align').on('click', function() {
            var pos = $(this).attr('data-value');

            _this.getControl().find('button.align').removeClass('current');
            $(this).addClass('current');

            _this.callback.setAlign(pos);
        });
    }
}

window.AlignmentControl = AlignmentControl;