<div>
    <div class="body d-flex py-3">
        <div class="container-xxl">

            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">وبلاگ ( {{$title}} )</h3>
                        <a href="{{route('admin.blogs')}}" wire:navigate
                           class="btn btn-primary py-2 px-5 text-uppercase btn-set-task w-sm-100">
                            ذخیره
                        </a>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row g-3 mb-3">
                <div class="col-lg-4">
                    <div class="sticky-lg-top">
                        <div class="card mb-3">
                            <div
                                class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">وضعیت قابلیت مشاهده</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" wire:click="updateTexts" value="1"
                                           wire:model="status" id="asd1" type="radio" name="couponsstatus"
                                           @if($status==1) checked @endif >
                                    <label class="form-check-label" for="asd1">
                                        منتشر شده
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" wire:click="updateTexts" value="0"
                                           wire:model="status" id="asd11" type="radio" name="couponsstatus"
                                           @if($status==0) checked @endif>
                                    <label class="form-check-label" for="asd11">
                                        مخفی
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div
                                class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">اطلاعات اولیه</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12">
                                        <label class="form-label">عنوان</label>
                                        <input type="text" class="form-control" wire:model="title"
                                               wire:keyup="updateTexts">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">slug</label>
                                        <input type="text" class="form-control" wire:model="slug"
                                               wire:keyup="updateTexts">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">انتخاب دسته بندی</label>
                                        <select class="form-select" wire:model="category_id" wire:change="updateTexts">
                                            <option value="">بدون دسته بندی</option>
                                            @foreach($categories as $i)
                                                <option value="{{$i->id}}">{{$i->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card" wire:ignore>
                            <div class="card-header py-3 bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">تصویر شاخص</h6>
                                <small>با رویداد و فایل پیش فرض سعی کنید تصویر را حذف کنید</small>
                            </div>
                            <div class="card-body">
                                <input type="file" wire:model="image" wire:ignore.self id="dropify-event"
                                       data-default-file="{{asset('storage/blogs/blog-'.$blog->id.'/'.$blog->img)}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">اطلاعات ثانویه</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12" wire:ignore>
                                    {{--                                    <div id="toolbar-container" wire:ignore></div>--}}
                                    <textarea id="editor">
                                        {!! $text !!}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">اطلاعات سئو</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-6">
                                    <label class="form-label">meta title</label>
                                    <input type="text" class="form-control" wire:model="meta_title"
                                           wire:keyup="updateTexts">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">meta keywords</label>
                                    <input type="text" class="form-control" wire:model="meta_keywords"
                                           wire:keyup="updateTexts">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">meta description</label>
                                    <textarea rows="5" class="form-control" wire:model="meta_description"
                                              wire:keyup="updateTexts"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Row end  -->

        </div>
    </div>
    @push('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/super-build/ckeditor.js"></script>
        <script>
            $(document).ready(function () {

                // This sample still does not showcase all CKEditor 5 features (!)
                // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
                CKEDITOR.ClassicEditor
                    .create(document.getElementById('editor'), {
                        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format

                        ckfinder: {
                            uploadUrl: "{{route('uploadImage',$blog->id).'?_token='.csrf_token()}}",
                        },
                        toolbar: {
                            items: [
                                'exportPDF', 'exportWord', '|',
                                'findAndReplace--', 'selectAll--', '|',
                                'heading', '|',
                                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript--', 'superscript--', 'removeFormat', '|',
                                'bulletedList', 'numberedList', 'todoList', '|',
                                'outdent', 'indent', '|',
                                'undo', 'redo',
                                '-',
                                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                                'alignment', '|',
                                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                                'specialCharacters--', 'horizontalLine--', 'pageBreak--', '|',
                                'textPartLanguage--', '|',
                                'sourceEditing'
                            ],
                            shouldNotGroupWhenFull: true
                        },
                        // Changing the language of the interface requires loading the language file using the <script> tag.
                        // language: 'es',
                        list: {
                            properties: {
                                styles: true,
                                startIndex: true,
                                reversed: true
                            }
                        },
                        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                        heading: {
                            options: [
                                {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                                {model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                                {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'},
                                {model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3'},
                                {model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4'},
                                {model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5'},
                                {model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6'}
                            ]
                        },
                        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                        placeholder: 'Welcome to CKEditor 5!',
                        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                        fontFamily: {
                            options: [
                                'default',
                                'Arial, Helvetica, sans-serif',
                                'Courier New, Courier, monospace',
                                'Georgia, serif',
                                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                                'Tahoma, Geneva, sans-serif',
                                'Times New Roman, Times, serif',
                                'Trebuchet MS, Helvetica, sans-serif',
                                'Verdana, Geneva, sans-serif'
                            ],
                            supportAllValues: true
                        },
                        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                        fontSize: {
                            options: [10, 12, 14, 'default', 18, 20, 22],
                            supportAllValues: true
                        },
                        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                        htmlSupport: {
                            allow: [
                                {
                                    name: /.*/,
                                    attributes: true,
                                    classes: true,
                                    styles: true
                                }
                            ]
                        },
                        // Be careful with enabling previews
                        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                        htmlEmbed: {
                            showPreviews: true
                        },
                        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                        link: {
                            decorators: {
                                addTargetToExternalLinks: true,
                                defaultProtocol: 'https://',
                                toggleDownloadable: {
                                    mode: 'manual',
                                    label: 'Downloadable',
                                    attributes: {
                                        download: 'file'
                                    }
                                }
                            }
                        },
                        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                        mention: {
                            feeds: [
                                {
                                    marker: '@',
                                    feed: [
                                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                        '@sugar', '@sweet', '@topping', '@wafer'
                                    ],
                                    minimumCharacters: 1
                                }
                            ]
                        },
                        // The "super-build" contains more premium features that require additional configuration, disable them below.
                        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                        removePlugins: [
                            // These two are commercial, but you can try them out without registering to a trial.
                            // 'ExportPdf',
                            // 'ExportWord',
                            'CKBox',
                            'CKFinder',
                            'EasyImage',
                            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                            // Storing images as Base64 is usually a very bad idea.
                            // Replace it on production website with other solutions:
                            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                            // 'Base64UploadAdapter',
                            'RealTimeCollaborativeComments',
                            'RealTimeCollaborativeTrackChanges',
                            'RealTimeCollaborativeRevisionHistory',
                            'PresenceList',
                            'Comments',
                            'TrackChanges',
                            'TrackChangesData',
                            'RevisionHistory',
                            'Pagination',
                            'WProofreader',
                            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                            // from a local file system (file://) - load this site via HTTP server if you enable MathType
                            'MathType'
                        ]
                    })
                    .then(editor => {
                        $(document).keyup(function () {
                            // setInterval(function (){
                            @this.
                            set('text', editor.getData());
                            @this.
                            updateTexts();
                            // },5000)
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });
        </script>
        <script>
            $(function () {
                $('.dropify').dropify();

                var drEvent = $('#dropify-event').dropify();
                drEvent.on('dropify.beforeClear', function (event, element) {
                    return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
                });

                drEvent.on('dropify.afterClear', function (event, element) {
                    @this.
                    imgRemove()
                    alert('File deleted');
                });
            });
        </script>
    @endpush
</div>
