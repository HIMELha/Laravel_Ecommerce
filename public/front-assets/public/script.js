

const mdNav = document.querySelector('.mdNav');
mdNavBtn = document.querySelector('#mdNavBtn');
btnClose = document.querySelector('#btnClose');
smNav = document.querySelector('#smNav');
smNavBtn = document.querySelector('#smNavBtn');
catNav = document.querySelector('#catNav');
catNavbtn = document.querySelector('#catbtn');
catclose = document.querySelector('#catclose');
accBtn = document.querySelector('#accBtn');
accNav = document.querySelector('#account');
Profilebtn = document.querySelector('#Profilebtn');
Profilenav = document.querySelector('#Profilenav');


// show and hide mdnav
mdNavBtn.addEventListener('click', () => {
    if (mdNav.classList.contains('close')) {
        mdNav.classList.remove('close');
    } else {
        mdNav.classList.add('open');
    }
});

btnClose.addEventListener('click', () => {
    mdNav.classList.add('close');
});

// show and hide smnav
smNavBtn.addEventListener('click', () => {
    if (smNav.classList.contains('hidden')) {
        smNav.classList.remove('hidden');
        smNav.classList.add('block');
    } else {
        smNav.classList.remove('block');
        smNav.classList.add('hidden');
    }
});


// show hide catnav
catNavbtn.addEventListener('click', () => {
    if (catNav.classList.contains('hidden')) {
        catNav.classList.remove('hidden');
        catNav.classList.add('block');
        catNav.classList.add('absolute');
    } else {
        catNav.classList.add('hidden');
        catNav.classList.remove('block');
    }
});


catclose.addEventListener('click', () => {
    catNav.classList.remove('Block');
    catNav.classList.add('hidden');
});

// show hide acccount
accBtn.addEventListener('click', () => {
    accNav.classList.toggle('hidden');
});


// multiple pages
function showPage(pageId) {
    const pages = document.querySelectorAll('.page');
    pages.forEach(page => {
        if (page.id === pageId) {
            page.style.display = 'block';
        } else {
            page.style.display = 'none';
        }
    });
}


