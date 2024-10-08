document.addEventListener('DOMContentLoaded', function () {
    // delete image
    document.querySelectorAll('.delete-image').forEach(button => {
        button.addEventListener('click', function () {
            const imageContainer = this.closest('.image-container');
            const key = imageContainer.getAttribute('data-key');

            // hide images
            imageContainer.style.display = 'none';

            // to track deleted images, activate hidden field
            const input = imageContainer.querySelector('.remove-image-input');
            input.disabled = false; // disabledを解除
            console.log('Removed image ID: ' + key); // デバッグ用
        });
    });

    // replace images
    document.querySelectorAll('.clickable-image').forEach(img => {
        img.addEventListener('click', function () {
            const input = document.getElementById('image');
            input.click(); 
        });
    });

    // preview
    document.getElementById('image').addEventListener('change', function(event) {
        const files = event.target.files; // to select multiple images
        const previewContainer = document.getElementById('imagePreview');
        previewContainer.innerHTML = ''; // clear old images

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-thumbnail w-100'; // size preview images
                previewContainer.appendChild(img); // add
            };
            reader.readAsDataURL(file); // read URL as image data
        });
    });
});
