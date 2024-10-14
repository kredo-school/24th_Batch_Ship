document.addEventListener('DOMContentLoaded', function() {
    // Event delegation for sort-date and sort-empathy buttons
    document.addEventListener('click', function(event) {
        if (event.target && event.target.id === 'sort-date') {
            console.log('sort-date button clicked');
            sortComments('date');
        }
        if (event.target && event.target.id === 'sort-empathy') {
            console.log('sort-empathy button clicked');
            sortComments('percentage');
        }
    });
    // Sorting function
    function sortComments(sortType) {
        const commentsContainer = document.getElementById('comments-container');
        const comments = Array.from(commentsContainer.querySelectorAll('.comment-item'));
        const validComments = comments.filter(comment => comment.dataset.percentage !== '' && comment.dataset.percentage !== null);
        validComments.sort((a, b) => {
            if (sortType === 'percentage') {
                return parseInt(b.dataset.percentage) - parseInt(a.dataset.percentage);
            } else if (sortType === 'date') {
                return new Date(b.dataset.date) - new Date(a.dataset.date);
            }
            return 0;
        });
        // Clear container and append sorted comments
        commentsContainer.innerHTML = '';
        validComments.forEach(comment => {
            commentsContainer.appendChild(comment.cloneNode(true));
        });
        // Remove trailing <hr> if exists
        if (commentsContainer.lastChild && commentsContainer.lastChild.tagName === 'HR') {
            commentsContainer.removeChild(commentsContainer.lastChild);
        }
        // Re-attach event listeners after sorting
        attachReplyButtons();
        attachShowRepliesButtons();
    }
    // Attach reply buttons event listeners
    function attachReplyButtons() {
        const replyButtons = document.querySelectorAll('.reply-button');
        replyButtons.forEach(button => {
            button.removeEventListener('click', toggleReplyForm);
            button.addEventListener('click', toggleReplyForm);
        });
    }
    // Toggle reply form display
    function toggleReplyForm() {
        const commentId = this.getAttribute('data-comment-id');
        const replyForm = document.getElementById(`reply-form-${commentId}`);
        replyForm.style.display = replyForm.style.display === 'none' || replyForm.style.display === '' ? 'block' : 'none';
    }
    // Attach show replies buttons event listeners
    function attachShowRepliesButtons() {
        const showReplyButtons = document.querySelectorAll('.show-replies-button');
        showReplyButtons.forEach(button => {
            button.removeEventListener('click', toggleReplies);
            button.addEventListener('click', toggleReplies);
        });
    }
    // Toggle replies visibility
    function toggleReplies() {
        const commentId = this.getAttribute('data-comment-id');
        const repliesContainer = document.getElementById(`replies-container-${commentId}`);
        if (repliesContainer.style.display === 'none' || repliesContainer.style.display === '') {
            repliesContainer.style.display = 'block';
            this.textContent = 'Hide Replies';
        } else {
            repliesContainer.style.display = 'none';
            this.textContent = `Show Replies (${repliesContainer.children.length})`;
        }
    }
    // Initial event attachment
    attachReplyButtons();
    attachShowRepliesButtons();
});
