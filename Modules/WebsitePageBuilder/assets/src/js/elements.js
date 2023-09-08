// base element object with methods including initialization
class Element {
    constructor(obj) {
        this.obj = obj;
    }

    getContainer() {
        var container = this.obj.closest('[builder-element=BlockElement]');

        // throws exception if can not find container
        if (!container.length) {
            console.warn('Selected element dose not have container (BlockElement)!');
            return null;
        }

        // if can find container and
        if (this.obj.attr('builder-element') != 'BlockElement') {
            return new BlockElement(container);
        } else {
            return null;
        }
    }

    getCellContainer() {
        var container = this.obj.closest('[builder-element=CellContainerElement]');

        // not found cell container
        if (!container.length) {
            return null;
        }

        // if can find container and
        if (this.obj.attr('builder-element') != 'CellContainerElement') {
            return new CellContainerElement(container);
        } else {
            return null;
        }
    }

    canSelect() {
        return true;
    }

    name() {
        return this.obj.prop("tagName");
    }

    icon() {
        return 'fa fa-code';
    }

    isContainer() {
        return false;
    }

    isWrapper() {
        return false;
    }

    canDelete() {
        return true;
    }

    canDuplicate() {
        return true;
    }

    isInlineEdit() {
        return this.obj.is('[builder-inline-edit]');
    }

    isFullRow() {
        return this.obj.offset().left < 20;
    }

    showControls() {
        return !this.isWrapper();
    }

    isDraggable() {
        return !currentEditor.strict;
    }

    // START - DRAG & DROP INTERFACE ============

    // get drop HTML
    dropHtml() {
        return $('<div>').append(this.obj.clone()).html();
    }

    dragHtml() {
        return `
            <div class="widget-moving-shadow">
                <div class="_1content widget-text" title="[NAME]">
                    <div class="panel__body" title="{language.wpanel.widgets.title.title}">
                        <span class="widget-custom-tag"><i class="{builder-icon-user}"></i></span>
                        <span class="remove-widget-button"><i class="{builder-icon-trash-alt}"></i></span>
                        <div class="image-drag">
                            <div ng-bind-html="::getModuleIcon(module)" class="ng-binding">
                                <i class="{builder-icon-code}" style="font-size: 36px;display: inline-block;"></i>
                            </div>
                        </div>
                        <div class="body__title">[NAME]</div>
                    </div>
                </div>
            </div>
        `;
    }

    hasBlockContainer() {
        return true;
    }
    // END - DRAG & DROP INTERFACE ============

    // Hover outline
    hoverOutline() {
        return $("#builder_iframe").contents().find("body").find('.builder-hover-outline');
    }

    // Load Hover outline
    loadHoverOutline() {
        // check if outline is already exist
        if (this.hoverOutline().length == 0) {
            // outline controls html
            var outline = $(`
                <div class="builder-tool builder-hover-outline"></div>
            `);

            $("#builder_iframe").contents().find("body").append(outline);
        }
    }

    // remove hover outline
    removeHoverOutline() {
        // remove outline
        this.hoverOutline().remove();
    }

    // adjust hover outline position
    adjustHoverOutlinePosition() {
        // top
        //var width = 3;
        this.hoverOutline().css({
            top: this.obj.offset().top - 5,
            height: this.obj.outerHeight() + 10,
            width: this.obj.outerWidth() + 10,
            left: this.obj.offset().left - 5,
        });
    }

    hoverLabel() {
        return $("#builder_iframe").contents().find("body").find('.builder-outline-content-hover');
    }

    loadHoverLabel() {
        // check if outline is already exist
        if (this.hoverLabel().length == 0) {
            // outline controls html
            var outline = $(`
                <div class="builder-tool builder-outline-content-hover">`+this.name()+`</div>
            `);

            $("#builder_iframe").contents().find("body").append(outline);
        }
    }

    removeHoverLabel() {
        // remove outline
        this.hoverLabel().remove();
    }

    adjustHoverLabelPosition() {
        this.hoverLabel().css('top', this.obj.offset().top - (this.hoverLabel().outerHeight()) - 0.5);
        this.hoverLabel().css('left', this.obj.offset().left + this.obj.outerWidth() - (this.hoverLabel().outerWidth()) - 2 + 5);

        if (this.hoverLabel().offset().top < 0) {
            this.hoverLabel().css('top', this.obj.offset().top + this.obj.outerHeight() + 4 + 5);
            this.hoverLabel().css('left', this.obj.offset().left + this.obj.outerWidth() - (this.hoverLabel().outerWidth()) - 2 + 5);

            if (this.hoverLabel().offset().top > $("#builder_iframe").outerHeight() - this.obj.outerHeight()) {
                this.hoverLabel().css('top', this.obj.offset().top + this.obj.outerHeight() - this.hoverLabel().outerHeight() + 5);
                this.hoverLabel().css('left', this.obj.offset().left + this.obj.outerWidth() - (this.hoverLabel().outerWidth()));
            }
        }
    }

    // hightlight element
    highlight() {
        // add highlight css to obj
        this.obj.addClass('builder-class-element-highlighted');

        // add hover label
        this.loadHoverLabel();

        // adjust outline label position
        this.adjustHoverLabelPosition();

        // add hover outline
        this.loadHoverOutline();
        this.adjustHoverOutlinePosition();
    }

    // hightlight element
    unhighlight() {
        // remove outline
        this.removeHoverLabel();

        // remove hover outline
        this.removeHoverOutline();

        // remove hover highlight class
        this.obj.removeClass('builder-class-element-highlighted');
    }

    // Select outline
    selectOutline() {
        return $("#builder_iframe").contents().find("body").find('.builder-select-outline');
    }

    // Load Select outline
    loadSelectOutline() {
        // check if outline is already exist
        if (this.selectOutline().length == 0) {
            // outline controls html
            var outline = $(`
                <div class="builder-tool builder-select-outline" style="display: none;"></div>
            `);

            $("#builder_iframe").contents().find("body").append(outline);
            outline.fadeIn(200);
        }
    }

    // remove select outline
    removeSelectOutline() {
        // remove outline
        this.selectOutline().remove();
    }

    // adjust select outline position
    adjustSelectOutlinePosition() {
        // top
        //var width = 3;
        this.selectOutline().css({
            top: this.obj.offset().top - 5,
            height: this.obj.outerHeight() + 10,
            width: this.obj.outerWidth() + 10,
            left: this.obj.offset().left - 5,
        });

        if (this.isFullRow()) {
            this.selectOutline().css({
                top: this.obj.offset().top,
                height: this.obj.outerHeight(),
                width: this.obj.outerWidth(),
                left: this.obj.offset().left,
            });
        }
    }

    selectControls() {
        return $("#builder_iframe").contents().find("body").find('.builder-outline-selected-controls');
    }

    loadSelectControls() {
        // check if outline is already exist
        if (this.selectControls().length == 0) {
            var html = $('<div>').append($('.builder-outline-selected-controls').clone()).html();

            // outline controls html
            var controls = $(html);

            $("#builder_iframe").contents().find("body").append(controls);
        }

        if (!this.canDelete()) {
            this.selectControls().find('.builder-remove-selected-button').hide();
        } else {
            this.selectControls().find('.builder-remove-selected-button').show();
        }

        if (!this.canDuplicate()) {
            this.selectControls().find('.builder-duplicate-selected-button').hide();
        } else {
            this.selectControls().find('.builder-duplicate-selected-button').show();
        }
    }

    adjustSelectControlsPosition() {
        this.selectControls().css('top', this.obj.offset().top + this.obj.outerHeight() + 5);
        this.selectControls().css('left', this.obj.offset().left + this.obj.outerWidth() - this.selectControls().outerWidth() + 5);

        if (this.isFullRow()) {
            this.selectControls().css('left', this.obj.offset().left + this.obj.outerWidth() - this.selectControls().outerWidth());
        }

        if (this.selectControls().offset().top + this.selectControls().outerHeight() > $("#builder_iframe").outerHeight()) {
            this.selectControls().css('top', this.obj.offset().top  + this.obj.outerHeight() - this.selectControls().outerHeight() - 8);
            this.selectControls().css('left', this.obj.offset().left + this.obj.outerWidth() - this.selectControls().outerWidth() - 3);
        }
    }

    removeSelectControls() {
        this.selectControls().remove();
    }

    selectMoveButton() {
        return $("#builder_iframe").contents().find("body").find('.builder-outline-move-hook');
    }

    loadSelectMoveButton() {
        // check if outline is already exist
        if (this.selectMoveButton().length == 0 && this.isDraggable()) {
            var html = $('<div>').append($('.builder-outline-move-hook').clone()).html();

            // outline controls html
            var controls = $(html);

            $("#builder_iframe").contents().find("body").append(controls);
        }
    }

    adjustSelectMoveButtonPosition() {
        if (this.isDraggable()) {
            this.selectMoveButton().css('top', this.obj.offset().top + (this.obj.outerHeight()/2) - (this.selectMoveButton().outerHeight()/2));
            this.selectMoveButton().css('left', this.obj.offset().left + this.obj.outerWidth() - (this.selectMoveButton().outerWidth()/2) + 4);
            this.selectMoveButton().css('border-radius', '50%');

            // // out of right side
            // if (this.selectMoveButton().offset().left + this.selectMoveButton().outerWidth() > $("#builder_iframe").outerWidth()) {
            //     this.selectMoveButton().css('left', $("#builder_iframe").outerWidth() - this.selectMoveButton().outerWidth());
            //     this.selectMoveButton().css('border-radius', '50% 0 0 50%');
            // }

            if (this.isFullRow()) {
                this.selectMoveButton().css('top', this.obj.offset().top + (this.obj.outerHeight()/2) - (this.selectMoveButton().outerHeight()/2));
                this.selectMoveButton().css('left', this.obj.offset().left + this.obj.outerWidth() - (this.selectMoveButton().outerWidth()/2));
                this.selectMoveButton().css('border-radius', '50%');
            }
        }
    }

    removeSelectMoveButton() {
        this.selectMoveButton().remove();
    }

    // select element
    select() {
        // add select highlight class
        this.obj.addClass('builder-class-element-selected');

        // load select outline
        this.loadSelectOutline();

        // adjust select outline position
        this.adjustSelectOutlinePosition();

        // if wrapper --> not show controls
        if (this.showControls()) {
            // load select controls
            this.loadSelectControls();

            // adjust select controls position
            this.adjustSelectControlsPosition();
        }

        if (this.isDraggable()) {
            // load select move button
            this.loadSelectMoveButton();

            // adjust select move button
            this.adjustSelectMoveButtonPosition();
        }

        // unhightlight
        this.unhighlight();
    }

    // unselect element
    unselect() {
        this.obj.removeClass('builder-class-element-selected');

        // if wrapper --> not show controls
        if (this.showControls()) {
            // remove select controls
            this.removeSelectControls();
        }

        // remove lobal
        this.removeSelectMoveButton();

        // remove uotline
        this.removeSelectOutline();
    }

    getControls() {
        return [
        ];
    }

    equals(element) {
        if (element == null) {
            return false;
        }

        return this.obj.is(element.obj);
    }

    // drop outline
    dropOutline() {
        return $("#builder_iframe").contents().find("body").find('.builder-drop-outline');
    }

    // Load drop outline
    loadDropOutline() {
        // check if outline is already exist
        if (this.dropOutline().length == 0) {
            // outline controls html
            var outline = $(`
                <div class="builder-tool builder-drop-outline"></div>
            `);

            $("#builder_iframe").contents().find("body").append(outline);
        }
    }

    // remove drop outline
    removeDropOutline() {
        // remove outline
        this.dropOutline().remove();
    }

    // adjust hover outline position
    adjustDropOutlinePosition() {
        // top
        //var width = 3;
        this.dropOutline().css({
            top: this.obj.offset().top,
            height: this.obj.outerHeight(),
            width: this.obj.outerWidth(),
            left: this.obj.offset().left,
        });
    }

    dropAfterOutline() {
        return $("#builder_iframe").contents().find("body").find('.drop-element-after-hover');
    }

    loadDropAfterOutline() {
        // check if outline is already exist
        if (this.dropAfterOutline().length == 0) {
            // outline controls html
            var outline = $('<div class="builder-tool drop-element-after-hover">'+
                                '<span>'+getI18n('drag_here')+'</span>'+
                            '</div>');

            $("#builder_iframe").contents().find("body").append(outline);
        }

        this.obj.addClass('builder-drop-after-element');
    }

    adjustDropAfterOutlinePosition() {
        this.dropAfterOutline().css('top', this.obj.offset().top + this.obj.outerHeight()-2 + parseInt(this.obj.css('margin-bottom')));
        this.dropAfterOutline().css('left', this.obj.offset().left);

        this.dropAfterOutline().css('width', this.obj.outerWidth());
    }

    removeDropAfterOutline() {
        this.dropAfterOutline().remove();
        this.obj.removeClass('builder-drop-after-element');
    }

    // hightlight element
    afterHighlight() {
        // remove before if exist
        this.removeDropBeforeOutline();

        // add after class
        this.obj.addClass('builder-class-drop-element-highlight');

        // load drop outline
        this.loadDropOutline();

        // adjust drop outline position
        this.adjustDropOutlinePosition();

        // add after outline
        this.loadDropAfterOutline();

        // adjust outline position
        this.adjustDropAfterOutlinePosition();
    }

    // unhighlight
    afterUnHighlight() {
        // remove after highlight class
        this.obj.removeClass('builder-class-drop-element-highlight');

        // remove drop outline
        this.removeDropOutline();

        // remove highlight
        this.removeDropAfterOutline();
    }

    dropBeforeOutline() {
        return $("#builder_iframe").contents().find("body").find('.drop-element-before-hover');
    }

    // load drop before outline
    loadDropBeforeOutline() {
        // check if outline is already exist
        if (this.dropBeforeOutline().length == 0) {
            // outline controls html
            var outline = $('<div class="builder-tool drop-element-before-hover">'+
                                '<span>'+getI18n('drag_here')+'</span>'+
                            '</div>');

            $("#builder_iframe").contents().find("body").append(outline);
        }

        this.obj.addClass('builder-drop-before-element');
    }

    adjustDropBeforeOutlinePosition() {
        this.dropBeforeOutline().css('top', this.obj.offset().top);
        this.dropBeforeOutline().css('left', this.obj.offset().left);

        this.dropBeforeOutline().css('width', this.obj.outerWidth());
    }

    removeDropBeforeOutline() {
        this.dropBeforeOutline().remove();
        this.obj.removeClass('builder-drop-before-element');
    }

    // hightlight element
    beforeHighlight() {
        // remove after if exist
        this.removeDropAfterOutline();

        // add after class
        this.obj.addClass('builder-class-drop-element-highlight');

        // load drop outline
        this.loadDropOutline();

        // adjust drop outline position
        this.adjustDropOutlinePosition();

        // add after outline
        this.loadDropBeforeOutline();

        // adjust outline position
        this.adjustDropBeforeOutlinePosition();
    }

    // unhighlight
    beforeUnHighlight() {
        // remove after highlight class
        this.obj.removeClass('builder-class-drop-element-highlight');

        // load drop outline
        this.removeDropOutline();

        // remove highlight
        this.removeDropBeforeOutline();
    }

    // check target position
    checkTargetPosition(e) {
        var obj_height = this.obj.height();
        var obj_top = this.obj.offset().top;
        var mouse_top = e.pageY;

        var pos = mouse_top - obj_top;

        if (pos < obj_height/2) {
            return 'before';
        } else {
            return 'after';
        }
    }

    // Drop inside label
    dropInsideOutline() {
        return $("#builder_iframe").contents().find("body").find('.builder-drop-inside-outline');
    }

    // Load drop inside outline
    loadDropInsideOutline() {
        // check if outline is already exist
        if (this.dropInsideOutline().length == 0) {
            // outline controls html
            var outline = $(`
                <div class="builder-tool builder-drop-inside-outline"></div>
            `);

            $("#builder_iframe").contents().find("body").append(outline);
        }
    }

    // remove drop inside outline
    removeDropInsideOutline() {
        // remove outline
        this.dropInsideOutline().remove();
    }

    // adjust hover outline position
    adjustDropInsideOutlinePosition() {
        // top
        //var width = 3;
        this.dropInsideOutline().css({
            top: this.obj.offset().top,
            height: this.obj.outerHeight(),
            width: this.obj.outerWidth(),
            left: this.obj.offset().left,
        });
    }

    dropInsideLabel() {
        return $("#builder_iframe").contents().find("body").find('.drop-inside-label-hover');
    }

    // load drop before outline
    loadDropInsideLabel() {
        // check if outline is already exist
        if (this.dropInsideLabel().length == 0) {
            // outline controls html
            var outline = $('<div class="builder-tool drop-inside-label-hover">'+
                                '<span>'+getI18n('drag_here')+'</span>'+
                            '</div>');

            $("#builder_iframe").contents().find("body").append(outline);
        }
    }

    adjustDropInsideLabelPosition() {
        this.dropInsideLabel().css('top', this.obj.offset().top+this.dropInsideLabel().outerHeight());
        this.dropInsideLabel().css('left', this.obj.offset().left);

        this.dropInsideLabel().css('width', this.obj.outerWidth());
    }

    removeDropInsideLabel() {
        this.dropInsideLabel().remove();
    }

    //
    dropInsideHighlight() {
        // load drop outline
        this.loadDropInsideOutline();

        // adjust drop outline position
        this.adjustDropInsideOutlinePosition();

        // load drop label
        this.loadDropInsideLabel();

        // adjust drop label position
        this.adjustDropInsideLabelPosition();
    }
}

window.SuperElement = Element;

// get all elements
function requireAll(r) { r.keys().forEach(r); }
requireAll(require.context('./elements/', true, /\.js$/));