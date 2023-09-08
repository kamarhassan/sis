class TwoColumnsWidget extends Widget {
    getHtmlId() {
        return "TwoColumnsWidget";
    }

    init() {
        // default button html
        this.setButtonHtml(`
            <div class="_1content widget-text">
                <div class="panel__body woo-panel__body">
                    <div class="image-drag">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 78 53"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect x="1" y="1" width="27" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/><rect x="32" y="1" width="45" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/></g></g></svg>
                        </div>
                    </div>
                    <div class="body__title">{language.widget.two_columns}</div>
                </div>
            </div>
        `);

        // default content html
        this.setContentHtml(`
            <div id="`+this.id+`" builder-element="CellContainerElement" style="
                display: flex;
                flex-wrap: wrap;
            " data-layout="3-7">
                <div style="
                    width: 33.333333%;
                " builder-element="CellElement"></div>
                <div style="
                    width: 66.666667%;
                " builder-element="CellElement"></div>
            </div>
        `);

        // default dragging html
        this.setDraggingHtml(this.getButtonHtml());
    }

    getCellContainerElement() {
        return currentEditor.getIframeContent().find('#' + this.id);
    }

    drop() {
        // after drop
    }
}

window.TwoColumnsWidget = TwoColumnsWidget;