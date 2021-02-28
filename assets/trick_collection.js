let trickCollection = {
    init: function () {
        let addButtonElements = document.getElementsByClassName('new_trick_media');
        for (let addButtonElement of addButtonElements) {
            addButtonElement.addEventListener('click', trickCollection.handleAddButtonClick);
        }
    },

    handleAddButtonClick: function (e) {
        let wrapperElement = e.currentTarget.previousElementSibling;
        let prototypeElement = wrapperElement.dataset.prototype;

        trickCollection.addFormToCollection(prototypeElement, wrapperElement)
    },

    addFormToCollection: function (prototype, wrapper) {
        let newForm = document.createElement('div');
        let count = wrapper.childElementCount;

        newForm.innerHTML = prototype;

        wrapper.appendChild(newForm);
    }
};

document.addEventListener('DOMContentLoaded', trickCollection.init);
