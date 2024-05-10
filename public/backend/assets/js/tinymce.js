$(function() {
    'use strict';

    //Tinymce editor
    if ($("#description").length) {
        tinymce.init({
            selector: '#description',
            image_class_list: [
                { title: 'img-fluid', value: 'img-responsive' },
            ],
            height: 400,
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
            },
            theme: 'silver',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen table media',
            ],
            menubar2: 'table insert',
            toolbar: 'charactercount media',
            toolbar1: 'insertfile undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help | table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
            toolbar3: '',
            media_live_embeds: true,
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '/admin/upload',
            file_picker_types: 'image | media',
            file_picker_callback: function(cb, value, meta) {


                if (meta.filetype == 'media') {
                    console.log('inside media');
                    let input = document.createElement('input'); //Create a hidden input
                    input.setAttribute('type', 'file');
                    let that = this;
                    input.onchange = function() {
                        let file = this.files[0]; //Select the first file

                        var formData = new FormData()
                        formData.append('file', file);


                        $.ajax({
                            type: 'POST',
                            url: '/admin/uploadvideo',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                cb(data.location, { source2: 'alt.ogg', poster: 'image.jpg' });
                            }
                        });
                    }
                    input.click();
                }



                // if (meta.filetype == 'media') {

                //     console.log(value);

                //     var formData = { file: value }
                //     $.ajax({
                //         type: 'POST',
                //         url: '/admin/uploadvideo',
                //         data: formData,
                //         success: function(data) {
                //             cb(data.location, { source2: 'alt.ogg', poster: 'image.jpg' });
                //         }
                //     });

                // }

                if (meta.filetype == 'image') {

                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/* video/*');
                    input.onchange = function() {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = function() {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), { title: file.name });
                        };
                    };
                    input.click();
                }

            },
            templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                },
                {
                    title: 'Test template 2',
                    content: 'Test 2'
                }
            ],
            content_css: []
        });
    }


    //Tinymce editor
    if ($("#short_description").length) {
        tinymce.init({
            selector: '#short_description',
            image_class_list: [
                { title: 'img-fluid', value: 'img-responsive' },
            ],
            height: 400,
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
            },
            theme: 'silver',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen charactercount',
            ],
            elementpath: false,
            toolbar1: 'insertfile undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
            image_advtab: true,
            templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                },
                {
                    title: 'Test template 2',
                    content: 'Test 2'
                }
            ],
            content_css: [],
            setup: function(ed) {
                var maxlength = 150; // Limit characters
                var count = 0;
                ed.on("keyup", function(e) {
                    count++;
                    if (count > maxlength) {
                        alert("You have reached the character limit");
                        e.stopPropagation();
                        return false;
                    }
                });
            },
        });
    }


    //Tinymce editor
    if ($("#blogdescription").length) {
        tinymce.init({
            selector: '#blogdescription',
            image_class_list: [
                { title: 'img-fluid', value: 'img-responsive' },
            ],
            height: 400,
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
            },
            theme: 'silver',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
            ],
            toolbar: 'charactercount',
            toolbar1: 'insertfile undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '/admin/upload',
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function() {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                };
                input.click();
            },
            templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                },
                {
                    title: 'Test template 2',
                    content: 'Test 2'
                }
            ],
            content_css: []
        });
    }





});

tinymce.PluginManager.add('charactercount', function(editor) {
    var _self = this;

    function update() {
        editor.theme.panel.find('#charactercount').text(['Characters: {0}', _self.getCount()]);
    }

    editor.on('init', function() {
        var statusbar = editor.theme.panel && editor.theme.panel.find('#statusbar')[0];

        if (statusbar) {
            window.setTimeout(function() {
                statusbar.insert({
                    type: 'label',
                    name: 'charactercount',
                    text: ['Characters: {0}', _self.getCount()],
                    classes: 'charactercount',
                    disabled: editor.settings.readonly
                }, 0);

                editor.on('setcontent beforeaddundo keyup', update);
            }, 0);
        }
    });

    _self.getCount = function() {
        var tx = editor.getContent({ format: 'raw' });
        var decoded = decodeHtml(tx);
        var decodedStripped = decoded.replace(/(<([^>]+)>)/ig, '');
        var tc = decodedStripped.length;
        return tc;
    };

    function decodeHtml(html) {
        var txt = document.createElement('textarea');
        txt.innerHTML = html;
        return txt.value;
    }
});