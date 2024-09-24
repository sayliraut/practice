
$(document).ready(function() {

 FilePond.registerPlugin(FilePondPluginImagePreview);

const thumbnailImageInput = document.querySelector('input[name="filepond"]');
const thumbnailImagePond = FilePond.create(thumbnailImageInput, {
storeAsFile: true,
allowImagePreview: true,
allowRemove: true,

});
});