var homePath = $('#homePath').val();
var idGallery = $('#galleryId').val();


var app = new Vue({
    el: '#app',
    data: {
        formats: ['image/png', 'image/jpeg', 'image/jpg'],
        uploading: false,
        files: [],
        photos: [],
    },

    created: function() {

        axios.get('getPhotos')

        .then(function(response) {

            for (let pho of response.data) {
                pho.name = pho.name.split(' ').join('%20');
                app.photos.push(pho);

            }

            app.setBackground();

        }).catch(function(error) {

            console.log(error);

        });

    },

    methods: {
        getFile: function() {

            var input = document.getElementById('files');
            var momentFiles = input.files;

            for (let i = 0; i < momentFiles.length; i++) {

                if (this.validateImageFile(momentFiles[i].type)) continue;

                this.getElementsFromFile(momentFiles[i], i);

            }

            input.value = null;

        },

        validateImageFile: function(type) {
            let validation = true;

            for (let i of this.formats) {
                if (i == type) {
                    validation = false;
                    break;
                }
            }
            return validation;
        },

        getElementsFromFile: function(file) {

            let jso = {
                formData: file,
                bits: null,
                status: 0,
                id: 0,
            };


            let reader = new FileReader();
            reader.onload = function(e) {
                jso.bits = e.target.result;
                app.pushFile(jso);
            };

            reader.readAsDataURL(file);


        },

        pushFile: function(x) {

            this.files.push(x);
            this.chekId();
            // setTimeout(this.setImagesPreview(), 50);
            this.nextFileToSend();
        },

        seeFiles: function() {
            console.log(this.files);
        },

        chekId: function() {

            for (let i = 0; i < this.files.length; i++) {
                this.files[i].id = 'imagePreview' + i;
            }

        },

        nextFileToSend: function() {
            for (let i = 0; i < this.files.length; i++) {

                if (this.files[i].status == 0) {
                    this.sendFile(i);
                    break;
                }

            }
        },



        sendFile: function(i) {

            if (this.uploading == true) return;

            this.uploading = true;

            this.files[i].status = 1;
            var formD = new FormData();
            formD.append('image', this.files[i].formData);


            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                progress: function(progressEvent) {
                    var percent = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    app.progress(percent);
                }
            }

            axios.post('upload', formD, config)

            .then(function(response) {

                app.uploading = false;
                app.successUpload(response, i);

            }).catch(function(error) {

                app.uploading = false;
                app.errorHandler(error, i);

            });
        },

        progress: function(e) {
            let element = document.getElementById('percent');
            element.style.width = e + "%";
        },

        successUpload: function(response, i) {

            response = response.data;

            app.files.splice(i, 1);
            response.name = response.name.split(' ').join('%20');
            app.photos.unshift(response);

            app.setBackground();
            setTimeout(app.nextFileToSend(), 200);
        },

        errorHandler: function(response, i) {

            if (this.files[i] == undefined) return;
            if (response.status == 403) {
                this.files[i].status = -2;
            } else {
                this.files[i].status = -1;
            }

            console.log(response);
            setTimeout(this.nextFileToSend(), 500);

        },

        retryFiled: function() {

            for (let i = 0; i < this.files.length; i++) {
                if (this.files[i].status == -1) {
                    this.files[i].status = 0;
                }
            }

            this.nextFileToSend();
        },

        setBackground: function() {

            setTimeout(() => {

                for (let pho of this.photos) {

                    var doc = document.getElementById('pho-' + pho.id);
                    doc.style.backgroundImage = 'url(' + homePath + '/images/noticias/' + idGallery + '/' + pho.name + ')';

                    var width = doc.offsetWidth;
                    doc.parentElement.style.height = width + 'px';

                }

            }, 50);


        },

        deletePhoto: function(photo) {

            axios.post('deletePhoto', photo)

            .then(function(response) {

                for (var i = 0; i < app.photos.length; i++) {

                    if (app.photos[i].id == photo.id) {

                        app.photos.splice(i, 1);
                        break;

                    }

                }


            }).catch(function(error) {

                console.log(error);

            });

        }

    }

});