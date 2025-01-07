// window.scrollTo(0, 0);
//
// const loadingScreen = document.getElementById('loading-screen');
//
// function showLoadingScreen() {
//     document.body.classList.add('no-scroll');
// }
//
// function hideLoadingScreen() {
//     loadingScreen.classList.add('fade-out');
//     loadingScreen.addEventListener('animationend', function() {
//         loadingScreen.style.display = 'none';
//         loadingScreen.classList.remove('fade-out');
//         document.body.classList.remove('no-scroll');
//     }, { once: true });
// }
//
// async function fetchData() {
//     showLoadingScreen();
//     try {
//         // Simulate data fetching
//         await new Promise(resolve => setTimeout(resolve, 2000));
//         // Fetch your data here
//     } catch (error) {
//         console.error('Error fetching data:', error);
//     } finally {
//         hideLoadingScreen();
//     }
// }


// fetchData().then(r => console.log('Data fetched'));




document.addEventListener('DOMContentLoaded', () => {
    const toggleClass = (selector, className) => document.querySelector(selector).classList.toggle(className);
    const removeClass = (selector, className) => document.querySelector(selector)?.classList.remove(className);

    document.querySelector('#hamburger').addEventListener('click', () => {
        toggleClass('#hamburger', 'active');
        toggleClass('.navigation', 'active');
        removeClass('#about_me_popup', 'active');
    });

    window.addEventListener('scroll', () => {
        removeClass('#hamburger', 'active');
        removeClass('.navigation', 'active');
        removeClass('.popup.active', 'active');
    });

    document.querySelectorAll('.kruis').forEach(function(kruis) {
        kruis.addEventListener('click', function() {
            const popup = this.closest('.popup.active');
            if (popup) {
                popup.classList.remove('active');
            }
        });
    });

    document.querySelector('.meerOverMijButton').addEventListener('click', () => {
        document.querySelector('#about_me_popup').classList.add('active');
    });

    window.changeSkill = (index, skillsId, ballId) => {
        document.querySelectorAll(`#${ballId} .ball`).forEach(ball => ball.classList.remove('active'));
        document.querySelectorAll(`#${skillsId} .skill`).forEach((skill, i) => {
            skill.classList.toggle('active', i === index);
        });
    };

    window.activateProjectPopup = projectId => {
        const projectPopup = document.querySelector(`#${projectId}`);
        if (projectPopup) {
            projectPopup.querySelector('.kruis').classList.add('active');
            projectPopup.classList.add('active');
        }
    };

    const initialBlob = document.querySelector(`#blobs .blob`);
    if (initialBlob) {
        const light = document.querySelector(`#blobs .blob-light`);
        light.classList.add('grow', 'visible');
        light.style.left = `${initialBlob.offsetLeft + initialBlob.offsetWidth / 2}px`;
    }
});
