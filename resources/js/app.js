document.addEventListener('DOMContentLoaded', function() {
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

    document.querySelector('#hamburger').addEventListener('click', function() {
        this.classList.toggle('active');
        document.querySelector('.navigation').classList.toggle('active');
        if (document.querySelector('#about_me_popup').classList.contains('active')) {
            document.querySelector('#about_me_popup').classList.remove('active');
        }
    });

    window.addEventListener('scroll', function() {
        const hamburger = document.querySelector('#hamburger');
        const navigation = document.querySelector('.navigation');
        const about_me = document.querySelector('#about_me_popup');

        if (hamburger.classList.contains('active')) {
            hamburger.classList.remove('active');
            navigation.classList.remove('active');
        }

        if (about_me.classList.contains('active')) {
            about_me.classList.remove('active');
        }
    });

    document.querySelector('.kruis').addEventListener('click', function() {
        document.querySelector('#about_me_popup').classList.remove('active');
    });

    document.querySelector('.meerOverMijButton').addEventListener('click', function() {
        document.querySelector('#about_me_popup').classList.add('active');
    });

    window.changeSkill = function(index, skillsId, ballId) {
        const balls = document.querySelectorAll(`#${ballId} .ball`);
        balls.forEach(ball => ball.classList.remove('active'));
        balls[index].classList.add('active');

        const skills = document.querySelectorAll(`#${skillsId} .skill`);
        const activeSkill = document.querySelector(`#${skillsId} .skill.active`);

        if (activeSkill) {
            activeSkill.classList.remove('active');
            skills[index].classList.add('active');
        } else {
            skills[index].classList.add('active');
        }
    };

    window.activateProjectPopup = function(projectId) {
        const projectPopup = document.querySelector(`#${projectId}`);
        projectPopup.classList.add('active');
    }

    // Set initial position of the light element
    const initialBlob = document.querySelector(`#blobs .blob`);
    if (initialBlob) {
        const light = document.querySelector(`#blobs .blob-light`);
        light.classList.add('grow');
        light.style.left = `${initialBlob.offsetLeft + initialBlob.offsetWidth / 2}px`;
        light.classList.add('visible');
    }

});
