<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Game Rental</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
</head>
<body class="font-poppins min-h-screen bg-[#010409] text-[#E6EDF3] custom-scrollbar">
<x-messages/>
<x-error/>
<x-delete/>
<x-add/>
<x-update-message/>
<style>
    .table-fixed {
        width: 100%;
        border-collapse: collapse;
    }

    .sticky-header {
        position: -webkit-sticky; /* For Safari */
        position: sticky;
        top: 0; /* Adjust if you have other fixed elements above */
        background-color: #0D1117; /* Or whatever background color you need */
        z-index: 10; /* Ensure it is above other content */
    }

    .sticky-header th {
        padding-left: 1rem;
        padding-right: 1rem;
        font-size: 0.875rem;
        text-align: left;
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 90%;
        color: #8D96A0;
        text-align: center;
    }

    .empty-state svg {
        margin-bottom: 10px;
    }

    *:focus:not(input, textarea, select) {
        outline: none;
    }

    *:focus {
        outline: 1px solid rgba(31,111,235,0.5);
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #1E2228;
        border-radius: 10px;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #42464D;
        border-radius: 10px;
        border: 2px solid #1E2228;
    }
    
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: #55595F;
    }

    .custom-scrollbar::-webkit-scrollbar-corner {
        background: rgba(0,0,0,0);
    }

    input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0px 1000px #0D1117 inset;
    -webkit-text-fill-color: #E6EDF3;
    }
    
    .no-resize {
        resize: none;
    }

    .custom-max-w {
        min-width: calc(100% - 30px);
    }

    .custom-max-h {
        min-height: calc(100% - 30px);
    }

    .custom-full-h {
        height: calc(100% - 30px);
    }

    .truncate {
        max-width: 100%; /* Adjust as needed */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .truncate:hover {
        overflow: visible;
        white-space: normal;
    }

    .card {
        transition: all 0.3s ease-in-out;
        overflow: hidden;
    }

    .description {
        display: block;
        max-height: 5em;
        transition: max-height 0.3s ease-in-out;
        overflow: hidden;
    }

    .card:hover .description {
        max-height: 20em;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(48%) sepia(0%) saturate(0%) hue-rotate(180deg) brightness(91%) contrast(91%);
    cursor: pointer;
    }

    .custom-radio {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: #0D1117;
        border: 1px solid #30363D;
        border-radius: 50%;
        width: 16px;
        height: 16px;
        display: inline-block;
        position: relative;
    }
    .custom-radio:checked {
        background-color: #0D1117;
        border-color: #1F6FEB;
    }
    .custom-radio:checked::before {
        content: '';
        display: block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #1F6FEB;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .custom-checkbox {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: #0D1117;
        border: 1px solid #30363D;
        border-radius: 3px;
        width: 16px;
        height: 16px;
        display: inline-block;
        position: relative;
        flex-shrink: 0;
    }

    .custom-checkbox:checked {
        background-color: #1F6FEB;
        border-color: #1F6FEB;
    }

    .custom-checkbox:checked::after {
        content: '';
        display: block;
        width: 5px;
        height: 10px;
        border: solid #E6EDF3;
        border-width: 0 2px 2px 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(45deg);
    }

    .disabled-checkbox {
        color: #666e79;
    }

    .disabled-input {
        color: #666e79;
    }

    .nav-pop-up-custom-max-h {
        max-height: calc(100vh - 64px);
        overflow-y: auto;
    }

    #item_category option:disabled {
        color: #8D96A0; /* Color for placeholder option */
    }

    /* For Add and Modify Caregory */

    #item_category {
        color: #E6EDF3; /* Default text color for selected option */
        background-color: #0D1117; /* Background color to match the select element */
        border: 1px solid #30363D; /* Border color */
    }
    #item_category option {
        color: #E6EDF3; /* Text color for the options */
        background-color: #0D1117; /* Background color for options */
    }
    #item_category option[value=""] {
        color: #8D96A0; /* Placeholder color */
    }

    /* Custom grid width */
    .custom-grid-width {
        width: calc(33.333333% - 14px);
    }
</style>

<script>

document.addEventListener('DOMContentLoaded', function() {
    new Sortable(document.querySelector('.sortable'), {
        animation: 150,
        ghostClass: 'sortable-ghost',
        handle: '.sortable-item'
    });
});

function checker() {
    const result = confirm ('Are you sure?');
    if(result == false){
        event.preventDefault();
    }
}

// For History Pop Up Date
document.addEventListener('DOMContentLoaded', (event) => {
    const optionAll = document.getElementById('option-1');
    const optionSelected = document.getElementById('option-2');
    const dateInputs = document.querySelectorAll('.date-input');

    function updateDateInputs() {
        if (optionAll.checked) {
            dateInputs.forEach((input) => {
                input.classList.add('disabled-input');
                input.disabled = true;
            });
        } else {
            dateInputs.forEach((input) => {
                input.classList.remove('disabled-input');
                input.disabled = false;
            });
        }
    }

    optionAll.addEventListener('change', updateDateInputs);
    optionSelected.addEventListener('change', updateDateInputs);

    updateDateInputs();
});

document.addEventListener('DOMContentLoaded', function() {
    new Sortable(document.querySelector('.sortable'), {
        animation: 150,
        ghostClass: 'sortable-ghost',
        handle: '.sortable-item'
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const selectAllCheckbox = document.getElementById('select-all-checkbox');
    const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
    const totalCategories = categoryCheckboxes.length;

    // Function to handle the select all checkbox state change
    const updateCategoryCheckboxes = (isChecked) => {
        categoryCheckboxes.forEach((checkbox) => {
            checkbox.checked = isChecked;
        });
    };

    // Set the default state of select all checkbox and category checkboxes
    selectAllCheckbox.checked = true;
    updateCategoryCheckboxes(true);

    // Function to handle the select all checkbox state change
    selectAllCheckbox.addEventListener('change', () => {
        if (selectAllCheckbox.checked) {
            // Check all category checkboxes when select all is checked
            updateCategoryCheckboxes(true);
        } else {
            // Uncheck all category checkboxes when select all is unchecked
            updateCategoryCheckboxes(false);
        }
    });

    // Function to handle individual category checkbox state change
    categoryCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', () => {
            // Count the number of checked checkboxes
            const checkedCount = document.querySelectorAll('.category-checkbox:checked').length;

            // If all category checkboxes are checked
            if (checkedCount === totalCategories) {
                selectAllCheckbox.checked = true;
            } else {
                // Uncheck the select all checkbox if not all category checkboxes are checked
                selectAllCheckbox.checked = false;
            }
        });
    });
});


// For Add and Modify Category

document.addEventListener('DOMContentLoaded', () => {
    const addSection = document.getElementById('add-section');
    const modifySection = document.getElementById('modify-section');
    const renameSection = document.getElementById('rename-section');
    const addButtons = document.getElementById('add-buttons');
    const modifyButtons = document.getElementById('modify-buttons');
    const radioButtons = document.querySelectorAll('input[name="option"]');
    const select = document.getElementById('item_category');

    // Function to toggle sections based on selected option
    const toggleSections = () => {
        const selectedOption = document.querySelector('input[name="option"]:checked');
        if (selectedOption) {
            if (selectedOption.id === 'option-1') {
                addSection.classList.remove('hidden');
                modifySection.classList.add('hidden');
                renameSection.classList.add('hidden');
                addButtons.classList.remove('hidden');
                modifyButtons.classList.add('hidden');
            } else if (selectedOption.id === 'option-2') {
                addSection.classList.add('hidden');
                modifySection.classList.remove('hidden');
                addButtons.classList.add('hidden');
                modifyButtons.classList.remove('hidden');
                toggleRenameSection(); // Update the visibility of the rename section
            }
        }
    };

    // Function to toggle rename section based on the selected category
    const toggleRenameSection = () => {
        if (select.value === "") {
            renameSection.classList.add('hidden'); // Hide rename section if no category is selected
        } else {
            renameSection.classList.remove('hidden'); // Show rename section if a category is selected
        }
    };

    // Initial setup: Check localStorage for the selected radio button and apply it
    const savedOption = localStorage.getItem('selectedOption');
    if (savedOption) {
        const savedButton = document.getElementById(savedOption);
        if (savedButton) {
            savedButton.checked = true;
        }
    }
    toggleSections(); // Toggle sections based on the initial or saved option

    // Event listener for radio button changes
    radioButtons.forEach(button => {
        button.addEventListener('change', (event) => {
            const selectedOptionId = event.target.id;
            localStorage.setItem('selectedOption', selectedOptionId); // Save selected option
            toggleSections();
        });
    });

    // Event listener for category select changes
    select.addEventListener('change', toggleRenameSection);
});


// Padding for scrolabble category
document.addEventListener("DOMContentLoaded", function() {
    var container = document.getElementById('categoryContainer');
    if (container.scrollHeight > container.clientHeight) {
        container.classList.add('pr-2');
    }
});

// Borrow Add Date Selector
document.addEventListener('DOMContentLoaded', (event) => {
    const optionOutbound = document.getElementById('option-outbound');
    const optionBorrow = document.getElementById('option-borrow');
    const dateInputs = document.querySelectorAll('.date-input');

    // Set the borrow option as the default checked radio button
    optionBorrow.checked = true;

    function updateDateInputs() {
        if (optionOutbound.checked) {
            dateInputs.forEach((input) => {
                input.classList.add('disabled-input');
                input.disabled = true;
            });
        } else {
            dateInputs.forEach((input) => {
                input.classList.remove('disabled-input');
                input.disabled = false;
            });
        }
    }

    optionBorrow.addEventListener('change', updateDateInputs);
    optionOutbound.addEventListener('change', updateDateInputs);

    updateDateInputs();
});

</script>