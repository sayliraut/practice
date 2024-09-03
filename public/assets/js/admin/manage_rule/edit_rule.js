// $(document).ready(function() {
//     var quillTitle = new Quill('#rules-quill-edit-title', {
//         theme: 'snow'
//     });

//     // var quillMessage = new Quill('#rules-quill-edit-message', {
//     //     theme: 'snow'
//     // });

//     var storedTitle = document.getElementById('stored-title-message').value;
//     quillTitle.clipboard.dangerouslyPasteHTML(storedTitle);

//     // var storedMessage = document.getElementById('stored-message-message').value;
//     // quillMessage.clipboard.dangerouslyPasteHTML(storedMessage);

//     $('#update_rules').on("click", function(e) {
//         e.preventDefault();

//         $('#rules_form').validate({
//             ignore: [],
//             debug: false,
//             rules: {
//                 article_des_title: {
//                     required: true,
//                     minlength: 10,
//                 },
//                 article_des_message: {
//                     required: true,
//                     minlength: 10,
//                 }
//             },
//             messages: {
//                 article_des_title: {
//                     required: "Please Enter Rules Title",
//                     minlength: "Please Enter Rules Title"
//                 },
//                 article_des_message: {
//                     required: "Please Enter Rules Message",
//                     minlength: "Please Enter Rules Message"
//                 }
//             },
//             errorClass: 'error-message',
//             submitHandler: function(form) {
//                 var article_des_title = quillTitle.root.innerHTML;
//                 var article_des_message = quillMessage.root.innerHTML;

//                 if (article_des_title.trim() === '<p><br></p>' || article_des_message.trim() === '<p><br></p>') {
//                     toastr.error("Please Enter Rules");
//                     return false;
//                 }

//                 let base_url = url_path;
//                 var rule_id = document.querySelector('input[name="rule_id"]').value;

//                 var formData = new FormData(form);
//                 formData.append('article_des_title', article_des_title);
//                 formData.append('article_des_message', article_des_message);

//                 $.ajaxSetup({
//                     headers: {
//                         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//                     },
//                 });

//                 $.ajax({
//                     url: base_url + '/update_rules',
//                     type: 'POST',
//                     data: formData,
//                     processData: false,
//                     contentType: false,
//                     success: function(response) {
//                         if (response.status == 200) {
//                             toastr.success('Rules Data Updated Successfully');
//                             setTimeout(function() {
//                                 window.location.href = base_url + "/manage_rules";
//                             }, 1000);
//                         } else {
//                             toastr.error("Something went wrong");
//                         }
//                     },
//                     error: function(xhr, textStatus, errorThrown) {
//                         console.error(xhr.responseText);
//                         toastr.error("An error occurred while updating the rules");
//                     }
//                 });
//             }
//         });

//         $('#rules_form').submit();
//     });
// });
