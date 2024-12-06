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
        document.querySelector('.nav-links').classList.toggle('active');
        if (document.querySelector('.meerOverMij').classList.contains('active')) {
            document.querySelector('.meerOverMij').classList.remove('active');
        }
    });

    window.addEventListener('scroll', function() {
        const hamburger = document.querySelector('#hamburger');
        const navLinks = document.querySelector('.nav-links');
        const meerOverMij = document.querySelector('.meerOverMij');

        if (hamburger.classList.contains('active')) {
            hamburger.classList.remove('active');
            navLinks.classList.remove('active');
        }

        if (meerOverMij.classList.contains('active')) {
            meerOverMij.classList.remove('active');
        }
    });

    // document.querySelector('.kruis').addEventListener('click', function() {
    //     document.querySelector('.meerOverMij').classList.remove('active');
    // });
    //
    // document.querySelector('.meerOverMijButton').addEventListener('click', function() {
    //     document.querySelector('.meerOverMij').classList.add('active');
    // });

    window.changeSkill = function(index, skillsId, ballId) {
        const balls = document.querySelectorAll(`#${ballId} .ball`);
        balls.forEach(ball => ball.classList.remove('active'));
        balls[index].classList.add('active');

        const skills = document.querySelectorAll(`#${skillsId} .skill`);
        const activeSkill = document.querySelector(`#${skillsId} .skill.active`);

        if (activeSkill) {
            activeSkill.classList.remove('active');
            activeSkill.classList.add('animation-out');

            activeSkill.addEventListener('animationend', function onFadeOut() {
                activeSkill.classList.remove('animation-out');
                skills[index].classList.add('active', 'animation-in');
                skills[index].addEventListener('animationend', function onFadeIn() {
                    skills[index].classList.remove('animation-in');
                    skills[index].removeEventListener('animationend', onFadeIn);
                });
                activeSkill.removeEventListener('animationend', onFadeOut);
            });
        } else {
            skills[index].classList.add('active', 'animation-in');
            skills[index].addEventListener('animationend', function onFadeIn() {
                skills[index].classList.remove('animation-in');
                skills[index].removeEventListener('animationend', onFadeIn);
            });
        }
    };

    window.changeProjecten = function(index, projectsIdOne, projectsIdTwo, blobId) {
        const blobs = document.querySelectorAll(`#${blobId} .blob`);
        if (index < 0 || index >= blobs.length) {
            console.error('Invalid index:', index);
            return;
        }

        const projectsOne = document.querySelectorAll(`#${projectsIdOne} .project`);
        if (projectsOne[index]) {
            projectsOne.forEach(project => project.classList.remove('active'));
            projectsOne[index].classList.add('active');
        }

        const projectsTwo = document.querySelectorAll(`#${projectsIdTwo} .project`);
        if (projectsTwo[index]) {
            projectsTwo.forEach(project => project.classList.remove('active'));
            projectsTwo[index].classList.add('active');
        }

        const light = document.querySelector(`#${blobId} .blob-light`);
        const targetBlob = blobs[index];
        light.classList.remove('grow');
        light.style.left = `${targetBlob.offsetLeft + targetBlob.offsetWidth / 2}px`;
        light.classList.add('visible');

        light.addEventListener('transitionend', function onTransitionEnd() {
            light.classList.add('grow');
            light.removeEventListener('transitionend', onTransitionEnd);
        });
    };

    // Set initial position of the light element
    const initialBlob = document.querySelector(`#blobs .blob`);
    if (initialBlob) {
        const light = document.querySelector(`#blobs .blob-light`);
        light.classList.add('grow');
        light.style.left = `${initialBlob.offsetLeft + initialBlob.offsetWidth / 2}px`;
        light.classList.add('visible');
    }


});
