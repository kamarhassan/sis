class CellOptionControl extends Control {
    renderHtml() {
        var thisControl = this;
        var html = `
            <div id="CellOptionControl">
                <div class="control-[ID]">
                    <div class="widget-row px-3 py-2">                        
                        <div class="layout-group layout-group-2">
                            <h4>{language.cell.layout}</h4>
                            <div class="d-flex cell-layouts">
                                <div class="mr-2 cell-layout p-2 border rounded" data-value="3-7">
                                    <svg style="width:50px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 78 53"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect x="1" y="1" width="27" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/><rect x="32" y="1" width="45" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/></g></g></svg>
                                    <div style="font-weight:600;text-align:center">3-7</div>
                                </div>
                                <div class="mr-2 cell-layout p-2 border rounded" data-value="5-5">
                                    <svg style="width:50px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 78 53"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect x="1" y="1" width="36" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/><rect x="41" y="1" width="36" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/></g></g></svg>
                                    <div style="font-weight:600;text-align:center">5-5</div>
                                </div>
                                <div class="mr-2 cell-layout p-2 border rounded" data-value="7-3">
                                    <svg style="width:50px;transform:scaleX(-1)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 78 53"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect x="1" y="1" width="27" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/><rect x="32" y="1" width="45" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/></g></g></svg>
                                    <div style="font-weight:600;text-align:center">7-3</div>
                                </div>
                            </div>
                        </div>
                        <div class="layout-group layout-group-3">
                            <h4>{language.cell.layout}</h4>
                            <div class="d-flex cell-layouts">
                                <div class="mr-2 cell-layout p-2 border rounded" data-value="4-4-4">
                                    <svg style="width:50px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.8 53"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect x="1" y="1" width="21.8" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/><rect x="28.2" y="1" width="21.8" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/><rect x="55.8" y="1" width="21" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/></g></g></svg>
                                    <div style="font-weight:600;text-align:center">4-4-4</div>
                                </div>
                                <div class="mr-2 cell-layout p-2 border rounded" data-value="3-6-3">
                                    <svg style="width:50px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.8 53.5"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect x="1" y="1" width="16.8" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/><rect x="60" y="1" width="16.8" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/><rect x="21.8" y="1.5" width="34" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/></g></g></svg>
                                    <div style="font-weight:600;text-align:center">3-6-3</div>
                                </div>
                                <div class="mr-2 cell-layout p-2 border rounded" data-value="3-3-6">
                                    <svg style="width:50px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.8 53"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect x="1" y="1" width="16.8" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/><rect x="22" y="1" width="16.8" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/><rect x="42.8" y="1" width="34" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/></g></g></svg>
                                    <div style="font-weight:600;text-align:center">3-3-6</div>
                                </div>
                                <div class="mr-2 cell-layout p-2 border rounded" data-value="6-3-3">
                                    <svg style="width:50px;transform:scaleX(-1)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.8 53"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><rect x="1" y="1" width="16.8" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/><rect x="22" y="1" width="16.8" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/><rect x="42.8" y="1" width="34" height="51" rx="4.3" style="fill:#e2e1e2;stroke:#b7b7b8;stroke-miterlimit:10;stroke-width:2px"/></g></g></svg>
                                    <div style="font-weight:600;text-align:center">6-3-3</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        thisControl.selector = function() {
            return $(".control-" + thisControl.id);
        };

        html = html.replace("[ID]", thisControl.id);

        var div = $('<DIV>').html(html);
        
        return div.html();
    }

    setLayout(layout) {
        var _this = this;

        _this.selector().find('.cell-layout').removeClass('current');
        _this.selector().find('.cell-layout[data-value="'+layout+'"]').addClass('current');

        _this.callback.setLayout(layout);
    }

    afterRender() {
        var _this = this;

        _this.selector().find('.cell-layout[data-value="'+_this.value.layout+'"]').addClass('current');

        //
        _this.selector().find('.cell-layout').on('click', function() {
            var layout = $(this).attr('data-value');

            _this.setLayout(layout);
        });

        // count
        _this.selector().find('.layout-group').hide();
        _this.selector().find('.layout-group-'+_this.value.count).show();
    }
}

window.CellOptionControl = CellOptionControl;