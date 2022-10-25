const rem = Number.parseInt(
    getComputedStyle(document.documentElement).fontSize.replace('px', '')
);
const navBarHeight = 4 * rem;
const delta = 0.5 * rem;

// setting the active link whenever the section it links to reaches the top
let prev = null;
const makeActive = sectionId => {
    if (prev) prev.classList.remove('active-navlink');
    const link = document.querySelector(`a[href="#${sectionId}"]`);
    link.classList.add('active-navlink');
    prev = link;
};

let lastScrollTop = 0;
let hasGoneUp = {};

window.addEventListener('scroll', e => {
    const currentScrollTop = document.documentElement.scrollTop;

    if (currentScrollTop === 0 && prev) prev.classList.remove('active-navlink');
    const scrollingDown = currentScrollTop > lastScrollTop;

    for (let section of document.getElementsByTagName('section')) {
        const y = section.getBoundingClientRect().y;
        const id = section.getAttribute('id');
        if (scrollingDown && y <= navBarHeight + delta && !hasGoneUp[id]) {
            hasGoneUp[id] = true;
            makeActive(id);
        } else if (
            !scrollingDown &&
            y >= navBarHeight - delta &&
            hasGoneUp[id]
        ) {
            hasGoneUp[id] = false;
            makeActive(id);
        }
    }

    lastScrollTop = currentScrollTop;
});

