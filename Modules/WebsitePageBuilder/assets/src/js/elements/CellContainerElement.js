class CellContainerElement extends SuperElement  {
    name() {
        return getI18n('cell_container');
    }

    canSelect() {
        return false;
    }

    layoutToWidths(layout) {
        var nums = layout.split('-');
        var sum = nums.reduce((partial_sum, a) => parseInt(partial_sum) + parseInt(a), 0);
        var widths = [];

        nums.forEach(function(num) {
            widths.push(parseFloat(num)/parseFloat(sum) * 100);
        });

        return widths;
    }

    setLayout(layout) {
        this.obj.attr('data-layout', layout);

        var widths = this.layoutToWidths(layout);

        for(var i = 0; i < widths.length; i++) {
            var col = this.obj.find('[builder-element="CellElement"]').eq(i);
            col.css('width', ''+widths[i]+'%');
        }
    }

    getControls() {
        var element = this;

        return [
            new CellOptionControl(getI18n('cell_options'),
                {
                    count: element.obj.children().length,
                    layout: element.obj.attr('data-layout')
                },
                {
                    setLayout: function(layout) {
                        element.setLayout(layout);
                        setTimeout(function() {
                            currentEditor.selected.select();
                        }, 300);
                    }
                }
            ),
            // new FontFamilyControl(getI18n('font_family'), element.obj.css('font-family'), function(font_family) {
            //     element.obj.css('font-family', font_family);
            //     element.select();
            // }),
            // new BackgroundImageControl(getI18n('background_image'), {
            //     image: element.obj.css('background-image'),
            //     color: element.obj.css('background-color'),
            //     repeat: element.obj.css('background-repeat'),
            //     position: element.obj.css('background-position'),
            //     size: element.obj.css('background-size'),
            // }, {
            //     setBackgroundImage: function (image) {
            //         // if is wrapper
            //         if (element.isWrapper()) {
            //             element.obj.closest('body').css('background-image', image);
            //         } else {
            //             element.obj.css('background-image', image);
            //         }
            //     },
            //     setBackgroundColor: function (color) {
            //         // if is wrapper
            //         if (element.isWrapper()) {
            //             element.obj.closest('body').css('background-color', color);
            //         } else {
            //             element.obj.css('background-color', color);
            //         }
            //     },
            //     setBackgroundRepeat: function (repeat) {
            //         // if is wrapper
            //         if (element.isWrapper()) {
            //             element.obj.closest('body').css('background-repeat', repeat);
            //         } else {
            //             element.obj.css('background-repeat', repeat);
            //         }
            //     },
            //     setBackgroundPosition: function (position) {
            //         // if is wrapper
            //         if (element.isWrapper()) {
            //             element.obj.closest('body').css('background-position', position);
            //         } else {
            //             element.obj.css('background-position', position);
            //         }
            //     },
            //     setBackgroundSize: function (size) {
            //         // if is wrapper
            //         if (element.isWrapper()) {
            //             element.obj.closest('body').css('background-size', size);
            //         } else {
            //             element.obj.css('background-size', size);
            //         }
            //     },
            // })
        ];
    }
}

window.CellContainerElement = CellContainerElement;