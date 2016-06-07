var XPhotoClass = function (methods) {
    var klass = function () {
        this.initialize.apply(this, arguments);
    };

    for (var property in methods) {
        klass.prototype[property] = methods[property];
    }

    if (!klass.prototype.initialize) klass.prototype.initialize = function () {
    };

    return klass;
};
var XPhoto = XPhotoClass({
    options: {
        autostart: false,
        videoID: null,
        canvasID: null,
        inputID: null,
        upload: true,
        capture: true,
        photoWidth: 300,
        photoHeight: 350,
        photoUrl: null,
        withModal: false,
    },
    videoContainerElement: null,
    videoElement: null,
    canvasElement: null,
    canvasObj: null,
    videoObj: null,
    dataURL: null,
    imageURL: null,
    initialize: function (options, callback) {
        this.options = this.mergeObjects(this.options, options);
        //console.log(this.options);
        this.raiseEvents();
        if (this.options.autostart === true) this.startCapture();

        if (callback) {
            this.complete = callback;
        }
    },
    raiseEvents: function () {
        var obj = this;
        this.videoContainerElement = $('.xphoto-video-container');
        $('.xphoto-video-container').addClass("img-responsive");
        this.videoElement = $('#' + this.options.videoID);
        this.canvasElement = $('#' + this.options.canvasID);
        $('#' + this.options.canvasID).addClass('img-responsive')
        this.canvasElement.hide();
        this.createButtons();
        if (this.options.capture === true) {
            if (this.options.withModal === true) {
                $(".xphoto-buttons .xphoto-button-camera").on('click', function () {
                    obj.buildModal();
                });
            } else {
                $(".xphoto-buttons .xphoto-button-camera").on('click', function () {
                    $(this).hide();
                    if (obj.options.upload)$(".xphoto-buttons .xphoto-button-upload").hide();
                    $(".xphoto-buttons .xphoto-button-snap").show();
                    obj.startCapture();
                });
                $(".xphoto-buttons .xphoto-button-snap").on('click', function () {
                    $(this).hide();
                    $(".xphoto-buttons .xphoto-button-camera").show();
                    if (obj.options.upload)$(".xphoto-buttons .xphoto-button-upload").show();
                    obj.snapPhoto();
                });
            }
        }
        if (this.options.upload === true) {
            $("#xphoto-input-file").on('change', function (event) {
                obj.handleImage(event);
            });
            $(".xphoto-buttons .xphoto-button-upload").on('click', function () {
                $("#xphoto-input-file").click();
            });
        }
    },
    createButtons: function () {
        var buttons = '';
        if (this.options.capture === true) {
            buttons += '<button type="button" class="btn btn-success xphoto-button-camera"><i class="fa fa-camera"></i> Fotografia</button>'
                + '<button type="button" class="btn btn-primary xphoto-button-snap" style="display:none;"><i class="fa fa-circle"></i></button>';
        }
        if (this.options.upload === true) {
            buttons += '<button type="button" class="btn btn-default xphoto-button-upload"><i class="fa fa-upload"></i> Subir Archivo</button>';
        }
        $('.xphoto-buttons').html(buttons);
    },
    mergeObjects: function (objOne, objTwo) {
        if (objOne instanceof Array) {
            return objOne.concat(objTwo);
        }
        var merge = {};
        var property;
        for (property in objOne) {
            merge[property] = objOne[property];
        }
        for (property in objTwo) {
            merge[property] = objTwo[property];
        }
        return merge;
    },
    startCapture: function () {
        if (!this.options.capture) return false;

        this.canvasElement.hide();
        this.videoContainerElement.show();
        var obj = this;
        videoObj = {'video': true};
        if (navigator.getUserMedia) { // Standard
            navigator.getUserMedia(videoObj, function (stream) {
                video = obj.getVideo();
                video.src = stream;
                video.play();
            }, this.error);
        } else if (navigator.webkitGetUserMedia) { // WebKit-prefixed
            navigator.webkitGetUserMedia(videoObj, function (stream) {
                video = obj.getVideo();
                video.src = window.webkitURL.createObjectURL(stream);
                video.play();
            }, this.error);
        }
        else if (navigator.mozGetUserMedia) { // Firefox-prefixed
            navigator.mozGetUserMedia(videoObj, function (stream) {
                video = obj.getVideo();
                video.src = window.URL.createObjectURL(stream);
                video.play();
            }, this.error);
        }
    },
    snapPhoto: function () {
        video = this.getVideo();
        video.pause();
        context = this.getCanvasContext();
        context.clearRect(0, 0, canvas.width, canvas.height);
        /**
         * Draw Image
         * Clip the image and position the clipped part on the canvas:
         * JavaScript syntax:    context.drawImage(img,sx,sy,swidth,sheight,x,y,width,height);
         * source: http://www.w3schools.com/tags/canvas_drawimage.asp
         */
        var clipsize = this.getClipSizes();
        context.drawImage(video, clipsize.sx, clipsize.sy, clipsize.swidth, clipsize.sheight, clipsize.x, clipsize.y, clipsize.width, clipsize.height);

        var dataURL = canvas.toDataURL();
        this.dataURL = dataURL;

        //All action marked as complete and apply complete callback
        this.complete();

        //hide video capture
        this.videoContainerElement.hide();
        //show canvas rendered
        this.canvasElement.show();
    },

    handleImage: function (e) {
        var obj = this;
        var reader = new FileReader();
        reader.onload = function (event) {
            var img = new Image();
            img.onload = function () {
                canvas = obj.getCanvas();
                ctx = obj.getCanvasContext();

                var hRatio = canvas.width / img.width;
                var vRatio = canvas.height / img.height;
                var ratio = Math.min(hRatio, vRatio);
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, img.width * ratio, img.height * ratio);

                var dataURL = canvas.toDataURL();
                obj.dataURL = dataURL;

                //All action marked as complete and apply complete callback
                obj.complete();
            }
            img.src = event.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);

        //hide video capture
        obj.videoContainerElement.hide();
        //show canvas rendered
        obj.canvasElement.show();
    },
    complete: function () {
        //alert(this.dataURL);
        var obj = this;
        //alert('#'+obj.options.inputID);
        $('#' + obj.options.inputID).val(obj.dataURL);
    },
    getClipSizes: function () {
        var clip_sx = this.options.photoWidth / 2;
        var clip_sy = clip_sx / 2;
        var clip_swidth = this.options.photoWidth;
        var clip_sheight = this.options.photoHeight;
        var clip_x = 0;
        var clip_y = 0;

        var clip = {
            sx: clip_sx,
            sy: clip_sy,
            swidth: clip_swidth,
            sheight: clip_sheight,
            x: clip_x,
            y: clip_y,
            width: clip_swidth,
            height: clip_sheight
        };
        return clip;
    },
    buildModal: function () {
        var obj = this;
        var modal = '<div id="xphoto-modal" class="modal fade">'
            + '<div class="modal-dialog">'
            + '<div class="modal-content">'
            + '<div class="modal-header">'
            + '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'
            + '<h4 class="modal-title">Fotografia</h4>'
            + '</div>'
            + '<div class="modal-body">'
            + '<div class="xphoto-video-container">'
            + '<video id="xphoto-modal-video"></video>'
            + '</div>'
            + '<div class="xphoto-modal-buttons">'
            + '<button type="button" class="xphoto-modal-button-snap btn btn-primary btn-lg"><i class="fa fa-circle"></i></button>'
            + '</div>'
            + '</div>'
            + '</div>'
            + '</div>'
            + '</div>';
        $('#xphoto-modal-container').html(modal);
        $('#xphoto-modal').modal('show');
        obj.startCapture();
        $(".xphoto-modal-buttons .xphoto-modal-button-snap").on('click', function () {
            obj.snapPhoto();
            $('#xphoto-modal').modal('hide');
        });
    },
    getCanvas: function () {
        return document.getElementById(this.options.canvasID);
    },
    getCanvasContext: function () {
        canvas = this.getCanvas();
        return canvas.getContext('2d');
    },
    getVideo: function () {
        if (this.options.withModal === true) return document.getElementById('xphoto-modal-video');
        return document.getElementById(this.options.videoID);
    },
    error: function (error) {
        if (error === 'NO_DEVICES_FOUND') {
            error = 'Tidak bisa menemukan perangkat kamera, pastikan kamera terhubung ke komputer';
        }
        var errormessage = 'XPhoto capture error: ' + error;
        alert(errormessage);
        console.error(errormessage);
    }
});