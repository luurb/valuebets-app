let filtersIcon = document.querySelector('.nav-box__filters-icon');
let filters = document.querySelector('.filters');
let infoBtn = document.querySelector('.main-table__nav-info .fa-circle-info');
let leftNav = document.querySelector('.main-table__nav-left');

//Show or hide filters bar 
filtersIcon.addEventListener('click', () => {
    if (filtersIcon.classList.contains('show-filters')) {
        filtersIcon.classList.remove('show-filters');
        filtersIcon.classList.add('hide-filters');
        filters.classList.remove('right-0')
    } else {
        filtersIcon.classList.remove('hide-filters');
        filtersIcon.classList.add('show-filters');
        filters.classList.add('right-0')
    }
});