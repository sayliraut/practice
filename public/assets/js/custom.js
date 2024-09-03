document.querySelector('table').onclick = ({
    target
  }) => {
    if (!target.classList.contains('more')) return
    document.querySelectorAll('.dropout.active').forEach(
      (d) => d !== target.parentElement && d.classList.remove('active')
    )
    target.parentElement.classList.toggle('active')
  }
// tags-js

// The DOM element you wish to replace with Tagify
var input = document.querySelector('input[name=basic]');

// initialize Tagify on the above input node reference
new Tagify(input)

// tags-js

// cka-editor
CKEDITOR.replace('editor', {
  skin: 'moono',
  enterMode: CKEDITOR.ENTER_BR,
  shiftEnterMode:CKEDITOR.ENTER_P,
  toolbar: [{
    name: 'basicstyles',
    items: ['Bold', 'Italic', 'Underline', 'Strike']
},
{
    name: 'paragraph',
    items: ['NumberedList', 'BulletedList', '-', 'Blockquote']
},
{
    name: 'styles',
    items: ['Format']
},
{
    name: 'links',
    items: ['Link', 'Unlink']
},
{
    name: 'tools',
    items: ['Maximize']
}
]
});

// cka-editor

