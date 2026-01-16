@extends('Admin.layouts.master')
@section('content')
    @php
        $currentPage = 'faq';
    @endphp
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="row layout-top-spacing">
                <div class="top-tabel">
                    <div class="row">
                        <div class="col-md-4">
                            <h6 class="card-title">Manage Faq's</h6>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                    <div class="widget-content widget-content-area br-8 position-btn h-10">
                        <div class="view-details Article">
                            <form id="add_faq_form" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company-name" class="label">Question</label>
                                            <div id="faq-quill-add-question" class="editor-quill" style="height: 100px;">
                                            </div>
                                            <input type="hidden" id="add_faq_question" name="question">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="company-name" class="label">Answer</label>
                                            <div id="faq-quill-add-answer" class="editor-quill" style="height: 100px;">
                                            </div>
                                            <input type="hidden" id="add_faq_answer" name="answer">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button id="add_faq_btn" type="submit"
                                            class="download-btn-custom mt-3 custom-width-10">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
@section('section_script')
    <script>
        var questionQuill = new Quill('#faq-quill-add-question', {
            theme: 'snow'
        });

        var answerQuill = new Quill('#faq-quill-add-answer', {
            theme: 'snow'
        });


        $('#add_faq_btn').on("click", function(e) {
            $('#add_faq_form').validate({
                // ignore: [],
                // debug: false,
                rules: {
                    question: {
                        required: true
                    },
                    answer: {
                        required: true,
                        quillNotEmpty: true
                    },
                },
                messages: {
                    question: {
                        required: "Please Enter Question"
                    },
                    answer: {
                        required: "Please Enter Answer"
                    },

                },
                errorClass: 'error-message',
                submitHandler: function(form) {

                    var questionHtml = questionQuill.root.innerHTML.trim();
                    var answerHtml = answerQuill.root.innerHTML.trim();
                    
                    $('#add_faq_question').val(questionHtml);
                    $('#add_faq_answer').val(answerHtml);
                    base_url = url_path;
                    var formData = new FormData(form);
                    $('#add_faq_btn').text('Please wait...').attr('disabled', true);

                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                    });

                    $.ajax({
                        url: base_url + '/insert-faq',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 200) {
                                toastr.success('FAQ Added Successfully');
                                setTimeout(function() {
                                    window.location.href = base_url + "/faq";
                                }, 1000);
                            } else {
                                toastr.error("Something went wrong");
                            }
                            $('#add_faq_btn').attr('disabled', false).text('Submit');
                        },
                    });
                }
            });
        });
    </script>
@endsection
