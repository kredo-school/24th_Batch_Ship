document.addEventListener('DOMContentLoaded', function () {
    // to keep all selected files
    let allFiles = [];

    // initialize xmark(delete button)
    document.querySelectorAll('.delete-image').forEach(button => {
        button.addEventListener('click', function () {
            const imageContainer = this.closest('.image-container');
            const key = imageContainer.getAttribute('data-key');

            // hide image
            imageContainer.style.display = 'none';

            // to track deleted image, make hidden filed active
            // hidden filed for sending a command to delete the image
            const input = document.getElementById('image');
            const removedImages = document.getElementById('removedImages');
            removedImages.value = removedImages.value + ',' + key.toString();
            allFiles = allFiles.filter((_, index) => index !== parseInt(key)); // remove from allFiles
            console.log(allFiles)
            input.files = createFileList(allFiles); // update input element
            console.log('Removed image ID: ' + key); // for debug
        });
    });

    // to preview selected image
    document.getElementById('image').addEventListener('change', function(event) {
        const files = Array.from(event.target.files); // a new selected file
        const previewContainer = document.getElementById('imagePreview');
        
        // add to allFiles
        allFiles = allFiles.concat(files);

        // clear preview 
        previewContainer.innerHTML = '';

        // create preview for each images
        allFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.className = 'position-relative me-2 mb-2 w-25 image-container'; // class name
                imgContainer.setAttribute('data-key', index); // unique key to count

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-100 img-thumbnail d-inline-block'; // set a style

                // create xmark(delete button)
                const deleteBtn = document.createElement('button');
                deleteBtn.type = 'button';
                deleteBtn.className = 'position-absolute bg-transparent border-0 bg-light fs-3 delete-image';
                deleteBtn.style.top = '-5%';
                deleteBtn.style.right = '-5%';
                deleteBtn.setAttribute('aria-label', 'Close');
                deleteBtn.innerHTML = '<i class="fa-solid fa-circle-xmark text-danger"></i>'; // delete button

                deleteBtn.addEventListener('click', function () {
                    imgContainer.remove(); // click to delete
                    allFiles = allFiles.filter((_, fileIndex) => fileIndex !== index); // remove from allFiles
                    console.log(allFiles)

                    // update input element
                    const updatedFileList = createFileList(allFiles);
                    document.getElementById('image').files = updatedFileList; 
                });

                imgContainer.appendChild(img); // add image
                imgContainer.appendChild(deleteBtn); // add xmark button
                previewContainer.appendChild(imgContainer); // add to preview
            };
            reader.readAsDataURL(file); // read img file as URL
        });
    });

    // event to select a new image
    document.querySelectorAll('.clickable-image').forEach(img => {
        img.addEventListener('click', function () {
            const input = document.getElementById('image');
            input.click(); 
        });
    });

    // Helper function to create a file list
    function createFileList(files) {
        const dataTransfer = new DataTransfer();
        files.forEach(file => dataTransfer.items.add(file)); // fixed part
        return dataTransfer.files; // back to detaTransfer file
    }
});
