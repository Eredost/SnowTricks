let commentsList = {
    init: function () {
        commentsList.wrapper = document.getElementById('js-comments-wrapper');
        commentsList.template = document.getElementById('js-comment-template');
        commentsList.loaderElement = document.getElementById('js-loading');

        commentsList.page = 1;
        commentsList.limit = 5;
        commentsList.count = 0;

        // Handle click on Load-more button
        commentsList.loadMoreButton = document.getElementById('js-load-more');
        commentsList.loadMoreButton.addEventListener('click', commentsList.handleLoadMoreClick);

        let event = document.createEvent('HTMLEvents');
        event.initEvent('click', false, true);
        commentsList.loadMoreButton.dispatchEvent(event);
    },

    handleLoadMoreClick: function (e) {
        commentsList.toggleLoader();
        let commentsTotal = e.currentTarget.dataset.commentsCount;

        fetch(e.currentTarget.dataset.commentsPath + '?page=' + commentsList.page + '&limit=' + commentsList.limit)
            .then(function (res) {
                return res.json();
            })
            .then(function (res) {
                commentsList.page++;
                commentsList.count += res.length;

                if (commentsList.count == commentsTotal) {
                    commentsList.loadMoreButton.remove();
                }

                commentsList.displayComments(res);
            })
            .catch(function (res) {
                console.error(res);
            })
            .finally(function () {
                commentsList.toggleLoader();
            })
    },

    toggleLoader: function () {
        commentsList.loaderElement.classList.toggle('hide');
        commentsList.loadMoreButton.classList.toggle('hide');
    },

    displayComments: function (comments) {
        for (let comment of comments) {
            let cloneElement = document.importNode(commentsList.template.content, true);

            cloneElement.querySelector('.comment__author-name').textContent = comment.user.username;
            cloneElement.querySelector('.comment__content').textContent = comment.content;

            commentsList.wrapper.appendChild(cloneElement);
        }
    }
};

document.addEventListener('DOMContentLoaded', commentsList.init);
