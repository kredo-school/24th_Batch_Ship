function checkCommentLength(textarea) {
  const commentLength = textarea.value.length; // コメントの長さを取得
  const postId = textarea.id; // textareaのID（post ID）を取得
  const reactionButton = document.getElementById(`reaction-button-${postId}`); // 対応するボタンを取得

  // コメントが50文字以上の場合、ボタンを表示
  if (commentLength >= 50) {
      reactionButton.style.display = 'block';
  } else {
      reactionButton.style.display = 'none'; // 50文字未満の場合、ボタンを隠す
  }
}

// DOMが完全に読み込まれた後に全てのtextareaにイベントリスナーを追加
document.addEventListener('DOMContentLoaded', function() {
  const textareas = document.querySelectorAll('.comment-post');
  textareas.forEach(textarea => {
      textarea.addEventListener('input', function() {
          checkCommentLength(textarea); // 入力時に長さをチェック
      });
      checkCommentLength(textarea); // 初期状態をチェック
  });
});
