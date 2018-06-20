 var homePath = $('#homePath').val();
 var idGallery = $('#galleryId').val();


 var app = new Vue({
     el: '#app',
     data: {

         photos: [],
     },

     created: function() {

         axios.get(idGallery + '/getPhotos')

         .then(function(response) {

             for (let pho of response.data) {
                 pho.name = pho.name.split(' ').join('%20');
                 pho.path = homePath + '/images/noticias/' + idGallery + '/' + pho.name;
                 app.photos.push(pho);

             }

             app.setBackground();

         }).catch(function(error) {

             console.log(error);

         });

     },

     methods: {


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



     }

 });