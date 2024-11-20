document.addEventListener('DOMContentLoaded', function() {
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

    document.querySelector('.kruis').addEventListener('click', function() {
        document.querySelector('.meerOverMij').classList.remove('active');
    });

    document.querySelector('.meerOverMijButton').addEventListener('click', function() {
        document.querySelector('.meerOverMij').classList.add('active');
    });

    window.changeSkill = function(index, skillsId, ballId) {
        const balls = document.querySelectorAll(`#${ballId} .ball`);
        balls.forEach(ball => ball.classList.remove('active'));
        balls[index].classList.add('active');

        const skills = document.querySelectorAll(`#${skillsId} .skill`);
        skills.forEach(skill => skill.classList.remove('active'));
        skills[index].classList.add('active');
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
