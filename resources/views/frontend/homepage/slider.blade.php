


@isset($slider)
    <div id="jssor_1"
        style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:490px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->

        <div data-u="slides"
            style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:490px;overflow:hidden;">
            @foreach ($slider as $img_sli)
                <div data-p="735">
                    <img data-u="image" src="{{ $img_sli['image'] }}" />
                    @isset($img_sli['description'])
                        <svg viewbox="0 0 980 490" data-ts="preserve-3d" width="980" height="490" data-tchd="jssor_1_msk_1"
                            style="left:0px;top:0px;display:block;position:absolute;overflow:hidden;">
                            <g mask="url(#jssor_1_msk_1)">
                                <text data-to="614px 157px" stroke="#cca48f" stroke-width="1.6" text-anchor="middle" x="614"
                                    y="182" data-t="1"
                                    style="position:absolute;font-size:48px;overflow:visible;">{{ $img_sli['description'] }}
                                </text>
                            </g>
                        </svg>
                    @endisset
                    @isset($img_sli['link'])
                        <svg viewbox="0 0 980 490" data-ts="preserve-3d" width="980" height="490" data-tchd="jssor_1_msk_1"
                            style="left:0px;top:0px;display:block;position:absolute;overflow:hidden;">
                            <g mask="url(#jssor_1_msk_1)">

                                <text data-to="614px 157px" stroke="#cca48f" stroke-width="1.6" text-anchor="middle" x="614"
                                    y="182" data-t="1" style="position:absolute;font-size:48px;overflow:visible;">

                                </text>

                            </g>
                        </svg>
                    @endisset

                                      <svg viewbox="0 0 590 280" data-ts="preserve-3d" width="590" height="280" data-tchd="jssor_1_msk_8"
                        style="left:90px;top:17px;display:block;position:absolute;overflow:visible;">
                        <g mask="url(#jssor_1_msk_8)">

                            @isset($img_sli['link'])
                                <svg viewbox="0 0 472 100" x="70" y="13" width="472" height="100"
                                    style="position:absolute;font-size:40px;overflow:visible;">
                                    <g data-to="306px 63px" fill="#ffffff" data-t="24" style="opacity:0;letter-spacing:2em;">
                                        <path id="jssor_1_pt_5" fill="none" d="M12,87L462,27"></path>
                                        <a href="{{ $img_sli['link'] }}">
                                            <text text-anchor="middle" x="236" >
                                                <textPath href="#jssor_1_pt_5">{{ $img_sli['link_label'] }}
                                                </textPath>
                                            </text></a>

                                    </g>
                                </svg>

                            @endisset
                            @isset($img_sli['description'])
                            <svg viewbox="0 0 472 100" x="90" y="127" width="472" height="100"
                            style="position:absolute;font-size:36px;overflow:visible;">
                            <g data-to="326px 177px" fill="#ffffff" data-t="25"
                                style="opacity:0;letter-spacing:2em;">
                                <path id="jssor_1_pt_6" fill="none" d="M12,87L462,27"></path>
                                <text text-anchor="middle" x="236">
                                    <textPath href="#jssor_1_pt_6">{{ $img_sli['description'] }}
                                    </textPath>
                                </text>
                            </g>
                        </svg>
                           
                        @endisset
                    
                           
                        </g>

                </div>
            @endforeach
        </div>
        <a data-scale="0" href="https://www.jssor.com" style="display:none;position:absolute;">animation</a>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb071" style="position:absolute;bottom:20px;right:20px;" data-autocenter="1"
            data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:24px;height:24px;font-size:12px;line-height:24px;">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:-1;">
                    <circle class="b" cx="8000" cy="8000" r="6666.7"></circle>
                </svg>
                <div data-u="numbertemplate" class="n"></div>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2"
            data-scale="0.75" data-scale-left="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2"
            data-scale="0.75" data-scale-right="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
            </svg>
        </div>
    </div>

@endisset
