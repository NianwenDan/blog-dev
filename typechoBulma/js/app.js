// Enable Highlight.js
hljs.configure({languages:[]});
hljs.highlightAll();

document.addEventListener('DOMContentLoaded', () => {

    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
  
    // Add a click event on each of them
    $navbarBurgers.forEach( el => {
      el.addEventListener('click', () => {
  
        // Get the target from the "data-target" attribute
        const target = el.dataset.target;
        const $target = document.getElementById(target);
  
        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');
  
      });
    });
  
});

// Jump to a new tab if not my domain
document.querySelectorAll('a').forEach(function(link) {
    const currentDomain = window.location.hostname;
    const href = link.getAttribute('href');

    // Check if href is not empty and starts with http or https
    if (href && (href.startsWith('http://') || href.startsWith('https://'))) {
        const linkDomain = (new URL(href)).hostname;

        // Check if the link's domain is different from the current domain
        if (linkDomain !== currentDomain && !linkDomain.endsWith(`.${currentDomain}`)) {
            link.setAttribute('target', '_blank');
        }
    }
});


// Handle Render Pagenation
document.addEventListener('DOMContentLoaded', () => {
    // Select the existing pagination element
    const pagination = document.querySelector('.pagination');

    // Check if the pagination element exists
    if (!pagination) {
        return; // Exit if pagination element is not found
    }

    // Select all list items within the .page-navigator before clearing
    const pageItems = pagination.querySelectorAll('.page-navigator li');

    // Clear the existing pagination content
    pagination.innerHTML = '';

    // Create a new pagination list
    const paginationList = document.createElement('ul');
    paginationList.classList.add('pagination-list');

    // Iterate through the items and add them to the new structure
    pageItems.forEach((item) => {
        if (item.classList.contains('prev') || item.classList.contains('next')) {
            // Skip previous and next items
            return;
        }
        // Handle ellipsis
        if (item.querySelector('span')) {
            const ellipsis = document.createElement('span');
            ellipsis.classList.add('pagination-ellipsis');
            ellipsis.innerHTML = '&hellip;';
            paginationList.appendChild(ellipsis);
            return;
        }

        const listItem = document.createElement('li');
        const anchor = document.createElement('a');

        if (item.classList.contains('current')) {
            anchor.classList.add('pagination-link', 'is-current');
            anchor.setAttribute('aria-current', 'page');
            anchor.setAttribute('aria-label', `Page ${item.textContent.trim()}`);
        } else {
            anchor.classList.add('pagination-link');
            anchor.setAttribute('aria-label', `Goto page ${item.textContent.trim()}`);
        }

        anchor.href = item.querySelector('a') ? item.querySelector('a').href : '#';
        anchor.textContent = item.textContent.trim();

        listItem.appendChild(anchor);
        paginationList.appendChild(listItem);
    });

    // Append the pagination list to the pagination element
    pagination.appendChild(paginationList);
});

// Disable Search Button When No Words
document.addEventListener('DOMContentLoaded', function() {
    const inputField = document.querySelector('#s');
    const searchButton = document.querySelector('#search button');

    // Initially disable the button
    searchButton.disabled = true;

    // Add event listener to the input field
    inputField.addEventListener('input', function() {
        // Check if the input field has any value
        if (inputField.value.trim() !== "") {
            searchButton.disabled = false;
        } else {
            searchButton.disabled = true;
        }
    });
});