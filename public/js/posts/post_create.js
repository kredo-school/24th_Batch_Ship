document.addEventListener('DOMContentLoaded', function () {
    // keep all selected file on preview
    let allFiles = [];

    // image preview process
    document.getElementById('image').addEventListener('change', function(event) {
        const files = Array.from(event.target.files); // a new selected file
        const previewContainer = document.getElementById('imagePreview');
        const input = document.getElementById('image');
        
        // add a new selected image to allFiles[]
        allFiles = allFiles.concat(files);

        // clear old preview then show a new selected preview
        previewContainer.innerHTML = '';

        // use DataTransfer to update input file
        const dataTransfer = new DataTransfer();

        // preview all selected files and add to DataTransfer
        allFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.className = 'position-relative me-2 mb-2 w-25 image-container'; // class name
                imgContainer.setAttribute('data-key', index); // Set a unique key to track how many images have been added

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-100 img-thumbnail d-inline-block'; // set a style
                
                // create x mark (delete button)
                const deleteBtn = document.createElement('button');
                deleteBtn.type = 'button';
                deleteBtn.className = 'position-absolute bg-transparent border-0 bg-light fs-3 delete-image';
                deleteBtn.style.top = '-5%';
                deleteBtn.style.right = '-5%';
                deleteBtn.setAttribute('aria-label', 'Close');
                deleteBtn.innerHTML = '<i class="fa-solid fa-circle-xmark text-danger"></i>'; // delete button

                deleteBtn.addEventListener('click', function () {
                    imgContainer.remove(); // when click xmark button, it remove
                    allFiles = allFiles.filter((_, fileIndex) => fileIndex !== index); // remove from allFiles[]

                    // update DataTransfer after the images has deleted
                    const updatedDataTransfer = new DataTransfer();
                    allFiles.forEach(file => {
                        updatedDataTransfer.items.add(file);
                    });
                    input.files = updatedDataTransfer.files; // update input element
                });

                imgContainer.appendChild(img); // add img
                imgContainer.appendChild(deleteBtn); // add xmark(delete button)
                previewContainer.appendChild(imgContainer); // add to preview
            };
            reader.readAsDataURL(file); // read img file as URL
            dataTransfer.items.add(file); // add to DataTransfer
        });

        // update input files property to dataTransfer
        input.files = dataTransfer.files;
    });
});
