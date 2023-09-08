class Widget {
    constructor() {
        this.id = makeid();

        // init
        this.init();

        // load events
        this.events();
    }

    // START - DRAG & DROP INTERFACE ============

    // get drop HTML
    dropHtml() {
        return this.getContentHtml();
    }

    dragHtml() {
        return this.getDraggingHtml();
    }
    
    hasBlockContainer() {
        return false;
    }
    // END - DRAG & DROP INTERFACE ============

    getHtmlId() {
        return "None";
    }

    init() {
        // default button html
        if ($('#' + this.getHtmlId()).length) {
            this.setButtonHtml($('#' + this.getHtmlId()).html());
        }

        // default content html
        if ($('#' + this.getHtmlId()).length + getI18n('content')) {
            this.setContentHtml($('#' + this.getHtmlId() + 'Content').html());
        }

        // default dragging html
        if ($('#' + this.getHtmlId()).length) {
            this.setDraggingHtml($('#' + this.getHtmlId()).html());
        }
    }

    events() {

    }

    icon() {
        return 'fa fa-history';
    }

    // set button html control
    setButtonHtml(html) {
        this.buttonHtml = html;
    }

    // set HTML to insert into content
    setContentHtml(html) {
        this.contentHtml = html;
    }

    // set Html when dragging effect
    setDraggingHtml(html) {
        this.draggingHtml = html;
    }

    // get Html when dragging effect
    getDraggingHtml() {
        return this.draggingHtml;
    }

    // get button html control
    getButtonHtml() {
        return this.buttonHtml;
    }

    // get HTML to insert into content
    getContentHtml() {
        return this.contentHtml;
    }
}

window.Widget = Widget;

class FieldWidget extends Widget {
    replaceTag (html) {
        var thisWidget = this;

        var name = thisWidget.field.name ? thisWidget.field.name : '';
        html = html.replace(/\[FIELD_ID\]/g, thisWidget.id);

        var name = thisWidget.field.name ? thisWidget.field.name : '';
        html = html.replace(/\[FIELD_NAME\]/g, name);

        var label = thisWidget.field.label ? thisWidget.field.label : '';
        html = html.replace(/\[FIELD_LABEL\]/g, label);

        var placeholder = thisWidget.field.placeholder ? thisWidget.field.placeholder : '';
        html = html.replace(/\[FIELD_PLACEHOLDER\]/g, placeholder);

        if(thisWidget.field.required == 1) {
            html = html.replace(/\[FIELD_REQUIRED\]/ig, 'required');
        } else {
            html = html.replace(/\[FIELD_REQUIRED\]/ig, '');
        }

        return html;
    }

    constructor(field) {
        super();

        var thisWidget = this;
        thisWidget.field = field;

        // update button html
        var html = thisWidget.getButtonHtml();
        html = thisWidget.replaceTag(html);
        thisWidget.setButtonHtml(html);

        // update content html
        var html = thisWidget.getContentHtml();
        html = thisWidget.replaceTag(html);
        thisWidget.setContentHtml(html);

        // update dragging html
        var html = thisWidget.getDraggingHtml();
        html = thisWidget.replaceTag(html);
        thisWidget.setDraggingHtml(html);
    }
}

window.FieldWidget = FieldWidget;

// get all widgets
function requireAll(r) { r.keys().forEach(r); }
requireAll(require.context('./widgets/', true, /\.js$/)); // all widgets