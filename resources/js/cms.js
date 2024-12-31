const coll = document.getElementsByClassName("collapsible");

for (let i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        const content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.display = "flex";
            // Temporarily set display to get the correct scrollHeight
            content.style.maxHeight = "none";
            const scrollHeight = content.scrollHeight + "px";
            content.style.maxHeight = "0";
            // Force reflow
            content.offsetHeight;
            content.style.maxHeight = scrollHeight;
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    const horizontalScrollElements = document.getElementsByClassName("horizontal-scroll");

    for (let i = 0; i < horizontalScrollElements.length; i++) {
        horizontalScrollElements[i].addEventListener("wheel", function(event) {
            if (event.deltaY !== 0) {
                event.preventDefault();
                horizontalScrollElements[i].scrollLeft += event.deltaY;
            }
        });
    }
    const verticalScrollElements = document.getElementsByClassName("vertical-scroll");
    for (let i = 0; i < verticalScrollElements.length; i++) {
        verticalScrollElements[i].addEventListener("wheel", function(event) {
            if (event.deltaY !== 0) {
                event.preventDefault();
                verticalScrollElements[i].scrollTop += event.deltaY;
            }
        });
    }

    const addButton = document.querySelector('.AddButton');
    const languageDropdown = document.getElementById('languageDropdown');
    const buttonsContainer = document.getElementById('languages');
    const Input = document.getElementById('thingsInput');

    addButton.addEventListener('click', function (event) {
        event.preventDefault();
        addButton.style.display = 'none';
        languageDropdown.style.display = 'block';
    });

// Event delegation for dynamically added language divs
    buttonsContainer.addEventListener('click', function (event) {
        const inputName = Input.closest('.flex-row').querySelector('input[type="hidden"]').name;
        const clickedDiv = event.target.closest('.button');
        if (clickedDiv) {
            const language = clickedDiv.textContent.trim(); // Get the text content of the clicked div
            console.log('Clicked div text:', language);
            if (language) {
                buttonsContainer.removeChild(clickedDiv);
                removeDetailsValue(language, inputName);
                console.log('Language removed:', language);
            } else {
                console.error('Language attribute is missing!');
            }
        }
    });



    if (languageDropdown) {
        languageDropdown.addEventListener('change', function () {
            const selectedLanguage = languageDropdown.value;
            const inputName = languageDropdown.closest('.flex-row').querySelector('input[type="hidden"]').name;
            if (selectedLanguage && !isLanguageAdded(selectedLanguage, inputName)) {
                const newDiv = document.createElement('div');
                newDiv.className = 'button gap-1 align-items-center';
                newDiv.dataset.language = selectedLanguage; // Properly set the data-language attribute
                newDiv.innerHTML = `${selectedLanguage} <i class="fa-solid fa-xmark"></i>`;
                buttonsContainer.appendChild(newDiv);
                addButton.style.display = 'block';
                languageDropdown.style.display = 'none';
                updateDetailsValue(selectedLanguage, inputName);
                console.log('New language added:', selectedLanguage);
            }
        });
    }

    if (Input) {
        Input.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                const selectedLanguage = Input.value.trim();
                const inputName = Input.closest('.flex-row').querySelector('input[type="hidden"]').name;
                if (selectedLanguage && !isLanguageAdded(selectedLanguage, inputName)) {
                    const newDiv = document.createElement('div');
                    newDiv.className = 'button gap-1 align-items-center';
                    newDiv.dataset.language = selectedLanguage;
                    newDiv.innerHTML = `${selectedLanguage} <i class="fa-solid fa-xmark"></i>`;
                    buttonsContainer.appendChild(newDiv);
                    updateDetailsValue(selectedLanguage, inputName);
                }
                Input.value = '';
            }
        });
    }




    function updateDetailsValue(language, inputName) {
        const hiddenInput = document.querySelector(`input[name="${inputName}"]`);
        hiddenInput.value += `,${language}`;
        checkHiddenInputValue(inputName);
    }

    function removeDetailsValue(language, inputName) {
        console.log('removeDetailsValue:', inputName);
        const hiddenInput = document.querySelector(`input[name="${inputName}"]`);
        const languages = hiddenInput.value.split(',');
        const index = languages.indexOf(language);
        if (index !== -1) {
            languages.splice(index, 1);
        }
        hiddenInput.value = languages.join(',');
        checkHiddenInputValue(inputName);
    }

    function isLanguageAdded(language, inputName) {
        const hiddenInput = document.querySelector(`input[name="${inputName}"]`);
        const languages = hiddenInput.value.split(',');
        return languages.includes(language);
    }

    function checkHiddenInputValue(inputName) {
        const hiddenInput = document.querySelector(`input[name="${inputName}"]`);
        console.log(`Hidden input value for ${inputName}:`, hiddenInput.value);
    }

});

$(document).ready(function() {
    $('#summernote').summernote({
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New','Poppins sans-serif', 'Times New Roman', 'Verdana'],
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
        ]
    });
});
