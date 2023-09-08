@extends('websitepagebuilder::layouts.master')




<?php
// Helper function to constitute a valid path
function join_paths()
{
    $paths = [];
    foreach (func_get_args() as $arg) {
        if ($arg !== '') {
            $paths[] = $arg;
        }
    }

    return preg_replace('#/+#', '/', implode('/', $paths));
}

if ($url_template != null) {
    $templateUrl = URL::asset($url_template);
} else {
    $templateUrl = URL::asset('Modules/WebsitePageBuilder/assets/templates/default/6037a0a8583a7');
}
// dd( $templateUrl);
$theme =URL::asset('Modules/WebsitePageBuilder/assets/templates/default/6037a0a8583a7/theme.js');

// Detect the absolute URL to BuilderJS' dist/ folder
$baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$baseUrl = parse_url($baseUrl, PHP_URL_PATH); // Get something like "/builderjs/hello.php/"
$baseUrl = trim($baseUrl, '/'); // Get something like "builderjs/hello.php" (without slashes)
$baseUrl = preg_replace('/[^\/]+$/', '', $baseUrl); // Remove the script name (*.php) from the path to get something like "builderjs/"

$distUrl = join_paths('/Modules/WebsitePageBuilder/assets/dist/'); // Constitute the final path to the dist/ folder, which is something like "/builderjs/dist/"
// and this path shall be passed as the value of "root" parameter in BuliderJS construction function
?>
@section('head')
    <?php
if (file_exists($theme)) {
?>
    <script src="<?php echo "xmlsx".$theme; ?>"></script>
    <?php
}

?>

    <script>
        var editor;
        var params = new URLSearchParams(window.location.search);


        var tags = [{
                type: 'label',
                tag: '{CONTACT_FIRST_NAME}'
            },
            {
                type: 'label',
                tag: '{CONTACT_LAST_NAME}'
            },
            {
                type: 'label',
                tag: '{CONTACT_FULL_NAME}'
            },
            {
                type: 'label',
                tag: '{CONTACT_EMAIL}'
            },
            {
                type: 'label',
                tag: '{CONTACT_PHONE}'
            },
            {
                type: 'label',
                tag: '{CONTACT_ADDRESS}'
            },
            {
                type: 'label',
                tag: '{ORDER_ID}'
            },
            {
                type: 'label',
                tag: '{ORDER_DUE}'
            },
            {
                type: 'label',
                tag: '{ORDER_TAX}'
            },
            {
                type: 'label',
                tag: '{PRODUCT_NAME}'
            },
            {
                type: 'label',
                tag: '{PRODUCT_PRICE}'
            },
            {
                type: 'label',
                tag: '{PRODUCT_QTY}'
            },
            {
                type: 'label',
                tag: '{PRODUCT_SKU}'
            },
            {
                type: 'label',
                tag: '{AGENT_NAME}'
            },
            {
                type: 'label',
                tag: '{AGENT_SIGNATURE}'
            },
            {
                type: 'label',
                tag: '{AGENT_MOBILE_PHONE}'
            },
            {
                type: 'label',
                tag: '{AGENT_ADDRESS}'
            },
            {
                type: 'label',
                tag: '{AGENT_WEBSITE}'
            },
            {
                type: 'label',
                tag: '{AGENT_DISCLAIMER}'
            },
            {
                type: 'label',
                tag: '{CURRENT_DATE}'
            },
            {
                type: 'label',
                tag: '{CURRENT_MONTH}'
            },
            {
                type: 'label',
                tag: '{CURRENT_YEAR}'
            },
            {
                type: 'button',
                tag: '{PERFORM_CHECKOUT}',
                'text': 'Checkout'
            },
            {
                type: 'button',
                tag: '{PERFORM_OPTIN}',
                'text': 'Subscribe'
            }
        ];

        $(document).ready(function() {
            var strict = true;

            if (params.get('type') == 'custom') {
                strict = false;
            }

            editor = new Editor({
                strict: strict, // default == true
                showInlineToolbar: true, // default == true
                root: '<?php echo $distUrl; ?>',
                url: '<?php echo $templateUrl; ?>',
                urlBack: window.location.origin,
                uploadAssetUrl: '{{ route('pages.design.upload.image') }}',
                uploadAssetMethod: 'POST',
                uploadTemplateUrl: '{{ URL::asset('Modules/WebsitePageBuilder/Traits/upload.php') }}',
                uploadTemplateCallback: function(response) {
                    window.location = response.url;
                },

                saveUrl: '{{ route('pages.design.update', $data['row']['id']) }}',
                saveMethod: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    type: '<?php echo 'default'; ?>',
                    slug: '{{ $data['row']['slug'] }}',
                    url_storage: '{{ $data['row']['url_storage'] }}',
                    template_id: '{{ $data['row']['id'] }}'
                },
                //  templates: templates,
                //  tags: tags,
                changeTemplateCallback: function(url) {
                    window.location = url;
                },

                /*
                    Disable features: 
                    change_template|export|save_close|footer_exit|help
                */
                // disableFeatures: [ 'change_template', 'export', 'save_close', 'footer_exit', 'help' ], 

                // disableWidgets: [ 'HeaderBlockWidget' ], // disable widgets
                //  export: {
                //      url: 'export.php'
                //  },
                backgrounds: [
                    //   ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images1.jpg') }}'
                    ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images1.jpg') }}',
                    ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images2.jpg') }}',
                    ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images3.jpg') }}',
                    ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images4.png') }}',
                    ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images5.jpg') }}',
                    ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images6.jpg') }}',
                    ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images9.jpg') }}',
                    ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images11.jpg') }}',
                    ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images12.jpg') }}',
                    ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images13.jpg') }}',
                    ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images14.jpg') }}',
                    ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images15.jpg') }}',
                    ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images16.jpg') }}',
                    ' {{ URL::asset('Modules/WebsitePageBuilder/assets/image/backgrounds/images17.png') }}'
                ],
                loaded: function() {
                    var thisEditor = this;

                    if (typeof(WidgetManager) !== 'undefined') {
                        var widgets = WidgetManager.init();

                        widgets.forEach(function(widget) {
                            thisEditor.addContentWidget(widget, 0, 'Template Content');
                        });
                    }
                }
            });

            editor.init();
        });
    </script>

    <style>
        .lds-dual-ring {
            display: inline-block;
            width: 80px;
            height: 80px;
        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 30px;
            height: 30px;
            margin: 4px;
            border-radius: 80%;
            border: 2px solid #aaa;
            border-color: #007bff transparent #007bff transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection

@section('content')
@endsection



@section('script')
    <script>
        switch (window.location.protocol) {
            case 'http:':
            case 'https:':
                //remote file over http or https
                break;
            case 'file:':
                alert('Please put the builderjs/ folder into your document root and open it through a web URL');
                window.location.href = "./index.php";
                break;
            default:
                //some other protocol
        }
    </script>
@endsection
