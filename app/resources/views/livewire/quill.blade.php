<div wire:ignore>
    <!-- Quill stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Toolbar -->
    <div id="{{ $quillId }}-toolbar">
        <span class="ql-formats">
            <select class="ql-header">
                <option selected></option>
                <option value="1"></option>
                <option value="2"></option>
            </select>
            <select class="ql-font"></select>
        </span>
        <span class="ql-formats">
            <button class="ql-bold"></button>
            <button class="ql-italic"></button>
            <button class="ql-underline"></button>
            <button class="ql-strike"></button>
        </span>
        <span class="ql-formats">
            <select class="ql-color"></select>
            <select class="ql-background"></select>
        </span>
        <span class="ql-formats">
            <button class="ql-list" value="ordered"></button>
            <button class="ql-list" value="bullet"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-link"></button>
            <button class="ql-image"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-clean"></button>
        </span>
    </div>

    <!-- Editor -->
    <div id="{{ $quillId }}" style="height:200px;"></div>

    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const quill = new Quill('#{{ $quillId }}', {
            theme: 'snow',
            modules: {
                toolbar: {
                    container: '#{{ $quillId }}-toolbar',
                    handlers: {
                        image: function () {
                            const input = document.createElement('input');
                            input.setAttribute('type', 'file');
                            input.setAttribute('accept', 'image/*');
                            input.click();

                            input.onchange = () => {
                                const file = input.files[0];
                                if (file) {
                                    let formData = new FormData();
                                    formData.append('image', file);

                                    fetch("{{ route('quill.image.upload') }}", {
                                        method: "POST",
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                        },
                                        body: formData
                                    })
                                    .then(response => response.json())
                                    .then(result => {
                                        const range = quill.getSelection();
                                        quill.insertEmbed(range.index, 'image', result.url);
                                    })
                                    .catch(error => {
                                        console.error('Image upload failed', error);
                                    });
                                }
                            };
                        }
                    }
                }
            }
        });

        // load initial value
        @if (!empty($value))
            quill.root.innerHTML = @json($value);
        @endif

        // push updates to Livewire
        quill.on('text-change', function () {
            @this.set('value', quill.root.innerHTML);
        });
    });
</script>

</div>
