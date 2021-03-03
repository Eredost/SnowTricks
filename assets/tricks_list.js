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

                tricksList.displayTricks(res);
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

    displayTricks: function (tricks) {
        for (let trick of tricks) {
            let cloneElement = document.importNode(tricksList.template.content, true);

            let trickTitle = cloneElement.querySelector('.trick-card__name > a');
            trickTitle.textContent = trick.name;

            let linkElements = cloneElement.querySelectorAll('.trick__link');
            for (let link of linkElements) {
                link.href = tricksList.linkTarget.replace(/slug$/, trick.slug);
            }

            // Display featured image
            if (trick.trickImages[0]) {
                let imageElement = cloneElement.querySelector('.trick-card__image > img');
                imageElement.src = imageElement.src.replace(/\/figure-placeholder\.jpg$/, '/images/' + trick.trickImages[0].src);
            }

            // Handle trick-card administration features
            let cardActionsElement = cloneElement.querySelector('.trick-card__actions');
            if (cardActionsElement) {
                let editLinkElement = cardActionsElement.querySelector('.trick-card__edit');
                let deleteFormElement = cardActionsElement.querySelector('.trick-card__delete');

                editLinkElement.href = editLinkElement.href.replace(/\/slug\//, '/' + trick.slug + '/');
                deleteFormElement.action = deleteFormElement.action.replace(/\/slug\//, '/' + trick.slug + '/');
            }

            tricksList.wrapper.appendChild(cloneElement);
        }
    }
};

document.addEventListener('DOMContentLoaded', tricksList.init);
