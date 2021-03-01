let trickCollection = {
    init: function () {
        // Handle add new media buttons
        let addButtonElements = document.getElementsByClassName('new_trick_media');
        for (let addButtonElement of addButtonElements) {
            addButtonElement.addEventListener('click', trickCollection.handleAddButtonClick);
        }

        // Handle close buttons
        let closeButtonElements = document.getElementsByClassName('js-delete-media');
        for (let closeButtonElement of closeButtonElements) {
            closeButtonElement.addEventListener('click', trickCollection.handleCloseButtonClick);
        }
    },

    handleAddButtonClick: function (e) {
        let wrapperElement = e.currentTarget.previousElementSibling;
        let prototypeElement = wrapperElement.dataset.prototype;

        trickCollection.addFormToCollection(prototypeElement, wrapperElement)
    },

    addFormToCollection: function (prototype, wrapper) {
        let newForm = wrapper.querySelector('.js-media-template').cloneNode(true);
        newForm.classList.remove('hide');
        newForm.querySelector('.js-delete-media').addEventListener('click', trickCollection.handleCloseButtonClick);
        let count = wrapper.childElementCount - 1;

        prototype = prototype.replace(/__name__/g, count);

        let prototypeWrapper = document.createElement('div');
        prototypeWrapper.innerHTML = prototype;
        newForm.prepend(prototypeWrapper.firstChild);

        wrapper.appendChild(newForm);
    },

    handleCloseButtonClick: function (e) {
        e.preventDefault();

        let parentElement = e.currentTarget.parentNode;
        parentElement.remove();
    }
};

document.addEventListener('DOMContentLoaded', trickCollection.init);
