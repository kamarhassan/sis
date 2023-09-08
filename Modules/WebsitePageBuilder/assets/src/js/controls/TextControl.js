class TextControl extends Control {
    renderHtml() {
        var thisControl = this;
        var text = this.value;
        var html = $('#TextControl').html();
        html = html.replace("[ID]", this.id);
        html = html.replace("[ID]", this.id);
        html = html.replace("[TEXT]", text);

        return html;
    }

    afterRender() {
        var thisControl = this;

        var height = 180;
        if (this.value.length > 100) {
            height = 220;
        }
        if (this.value.length > 400) {
            height = 300;
        }

        var tinyconfig = {
            selector: '.text-editor-' + this.id,
            valid_elements: '*[*]',
            valid_children: '+h1[div],+h2[div],+h3[div],+h4[div],+h5[div],+h6[div],+a[div],*[*]',
            branding: false,
            menubar: false,
            skin: "oxide",
            height: height,
            elementpath: false,
            force_br_newlines : false,
            relative_urls: false,
            convert_urls: false,
            remove_script_host : false,
            force_p_newlines : false,
            forced_root_block : '',
            inline_boundaries: false,
            allow_html_in_named_anchor: true,
            plugins: 'link lists autolink',
            //toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignfull | numlist bullist outdent indent',
            toolbar: 'undo redo bold italic underline strikethrough alignleft aligncenter alignright alignjustify outdent indent  numlist bullist checklist fontselect fontsizeselect forecolor backcolor casechange permanentpen formatpainter removeformat pagebreak charmap emoticons fullscreen  preview save print insertfile image media pageembed template link anchor codesample a11ycheck ltr rtl showcomments addcomment customTag custom1 custom2',
            setup: function (editor) {
            
                /* Menu button that has a simple "insert date" menu item, and a submenu containing other formats. */
                /* Clicking the first menu item or one of the submenu items inserts the date in the selected format. */
                editor.ui.registry.addMenuButton('customTag', {
                  text: getI18n('editor.insert_tag'),
                  fetch: function (callback) {
                    var items = [];

                    currentEditor.tags.forEach(function(tag) {
                        if ( tag.type == 'label') {
                            items.push({
                                type: 'menuitem',
                                text: tag.tag.replace("{", "").replace("}", ""),
                                onAction: function (_) {
                                    if (tag.text) {
                                        editor.insertContent(tag.text);
                                    } else {
                                        editor.insertContent(tag.tag);
                                    }                                            
                                }
                            });
                        }
                    });
                    
                    callback(items);
                  }
                });

                editor.on("change keyup", function(e){
                    editor.save(); // updates this instance's textarea
                    $(editor.getElement()).trigger('change'); // for garlic to detect change
                    thisControl.callback(editor.getContent());
                    currentEditor.selected.select();
                });

                // set editor inline change
                currentEditor.inlineEditCallback = function(data) {
                    editor.setContent(data);
                };

                // custom inline setup
                if (currentEditor.customTinymceSetup != null) {
                    currentEditor.customTinymceSetup(editor);
                }
            },
            formats: {
                alignleft: {selector: 'span,em,i,b,strong', inline: 'span', block: 'span', styles: {display: 'block', 'text-align':'left'}},
                aligncenter: {selector: 'span,em,i,b,strong', inline: 'span', block: 'span', styles: {display: 'block', 'text-align':'center'}},
                alignright: {selector: 'span,em,i,b,strong', inline: 'span', block: 'span', styles: {display: 'block', 'text-align':'right'}},
                alignfull: {selector: 'span,em,i,b,strong', inline: 'span', block: 'span', styles: {display: 'block', 'text-align':'full'}},
                alignjustify: {selector: 'span,em,i,b,strong', inline: 'span', block: 'span', styles: {display: 'block', 'text-align':'justify'}}
            }
        };
        tinymce.init(tinyconfig);
    }
}

window.TextControl = TextControl;