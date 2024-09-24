// datatable-dropdown
$(document).on("click", ".checkbox-dropdown", function() {
  $(this).toggleClass("is-active");
});

$(document).on("click", ".checkbox-dropdown ul", function(e) {
  e.stopPropagation();
});
// datatable-dropdown
// The DOM element you wish to replace with Tagify
var input = document.querySelector('input[name=basic]');

// initialize Tagify on the above input node reference
new Tagify(input)

// tags-js

// cka-editor
CKEDITOR.replace('editor', {
  skin: 'moono',
  enterMode: CKEDITOR.ENTER_BR,
  shiftEnterMode: CKEDITOR.ENTER_P,
  toolbar: [{ name: 'basicstyles', groups: ['basicstyles'], items: ['Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor'] },
  { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
  { name: 'scripts', items: ['Subscript', 'Superscript'] },
  { name: 'justify', groups: ['blocks', 'align'], items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
  { name: 'paragraph', groups: ['list', 'indent'], items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
  { name: 'links', items: ['Link', 'Unlink'] },
  { name: 'insert', items: ['Image'] },
  { name: 'spell', items: ['jQuerySpellChecker'] },
  { name: 'table', items: ['Table'] }
  ],
});

// cka-editor


