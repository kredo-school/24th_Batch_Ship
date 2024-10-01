document.addEventListener('DOMContentLoaded', function () {
    // 画像プレビューの処理
    document.getElementById('image').addEventListener('change', function(event) {
        const files = event.target.files; // 複数のファイルを取得
        const previewContainer = document.getElementById('imagePreview');
        previewContainer.innerHTML = ''; // 以前のプレビューをクリア

        Array.from(files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.className = 'position-relative me-2 mb-2 w-25 image-container'; // 指定されたクラス
                imgContainer.setAttribute('data-key', index); // 一意のキーを設定

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-100 img-thumbnail d-inline-block'; // スタイルを追加
                
                // バツ印を作成
                const deleteBtn = document.createElement('button');
                deleteBtn.type = 'button';
                deleteBtn.className = 'position-absolute bg-transparent border-0 bg-light fs-3 delete-image';
                deleteBtn.style.top = '-5%';
                deleteBtn.style.right = '-5%';
                deleteBtn.setAttribute('aria-label', 'Close');
                deleteBtn.innerHTML = '<i class="fa-solid fa-circle-xmark text-danger"></i>'; // バツ印のアイコン

                deleteBtn.addEventListener('click', function () {
                    imgContainer.remove(); // 画像を削除
                    const input = document.getElementById('image');
                    const dataTransfer = new DataTransfer(); // 新しいDataTransferを作成
                    Array.from(input.files).forEach((file, fileIndex) => {
                        if (fileIndex !== index) {
                            dataTransfer.items.add(file); // 削除しないファイルを追加
                        }
                    });
                    input.files = dataTransfer.files; // inputのファイルを更新
                });

                imgContainer.appendChild(img); // 画像をコンテナに追加
                imgContainer.appendChild(deleteBtn); // バツ印をコンテナに追加
                previewContainer.appendChild(imgContainer); // プレビューに追加
            };
            reader.readAsDataURL(file); // ファイルをData URLとして読み込む
        });
    });
});
