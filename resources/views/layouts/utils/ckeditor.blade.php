@push('head')
  <style>
    #container {
      width: 1000px;
      margin: 20px auto;
    }

    .ck-editor__editable[role="textbox"] {
      /* editing area */
      min-height: 200px;
    }

    .ck-content .image {
      /* block images */
      max-width: 80%;
      margin: 20px auto;
    }
  </style>
@endpush

@push('script')
  <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>

  <script>
    ClassicEditor
      .create(document.querySelector('#editor'), {
        ckfinder: {
          uploadUrl: `{{ route('ckeditor.image-upload', ['_token' => csrf_token()]) }}`
        }
      })
      .catch(error => {
        console.error(error);
      });
  </script>
@endpush
