let tricksList = {
    init: function () {
        tricksList.wrapper = document.getElementById('js-tricks-wrapper');
        tricksList.template = document.getElementById('js-trick-card');
        tricksList.loaderElement = document.getElementById('js-loading');

        tricksList.page = 1;
        tricksList.limit = 15;
        tricksList.count = 0;

        // Handle click on Load-more button
        tricksList.loadMoreButton = document.getElementById('js-load-more');
        tricksList.loadMoreButton.addEventListener('click', tricksList.handleLoadMoreClick);
        tricksList.linkTarget = tricksList.loadMoreButton.dataset.targetLink;

        let event = document.createEvent('HTMLEvents');
        event.initEvent('click', false, true);
        tricksList.loadMoreButton.dispatchEvent(event);
    },

    handleLoadMoreClick: function (e) {
        tricksList.toggleLoader();
        let tricksTotal = e.currentTarget.dataset.tricksCount;
        let isAuthenticated = e.currentTarget.dataset.isAuthenticated;

        fetch(e.currentTarget.dataset.tricksPath + '?page=' + tricksList.page + '&limit=' + tricksList.limit)
            .then(function (res) {
                return res.json();
            })
            .then(function (res) {
                tricksList.page++;
                tricksList.count += res.length;

                if (tricksList.count == tricksTotal) {
                    tricksList.loadMoreButton.remove();
                }
                if (tricksList.count > 15) {
                    document.getElementById('js-tricks-arrow').classList.remove('hide');
                }

                tricksList.displayTricks(res, isAuthenticated);
            })
            .catch(function (res) {
                console.error(res);
            })
            .finally(function () {
                tricksList.toggleLoader();
            })
    },

    toggleLoader: function () {
        tricksList.loaderElement.classList.toggle('hide');
        tricksList.loadMoreButton.classList.toggle('hide');
    },

    displayTricks: function (tricks, isAuthenticated) {
        for (let trick of tricks) {
            let cloneElement = document.importNode(tricksList.template.content, true);

            let trickTitle = cloneElement.querySelector('.trick-card__name > a');
            trickTitle.textContent = trick.name;

            let linkElements = cloneElement.querySelectorAll('.trick__link');
            for (let link of linkElements) {
                link.href = tricksList.linkTarget.replace(/0$/, trick.id);
            }

            if (isAuthenticated === 'false') {
                cloneElement.querySelector('.trick-card__actions').remove();
            }

            tricksList.wrapper.appendChild(cloneElement);
        }
    }
};

document.addEventListener('DOMContentLoaded', tricksList.init);
