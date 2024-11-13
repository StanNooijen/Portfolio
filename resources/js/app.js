import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.getElementById('hamburger').addEventListener('click', function() {
    this.classList.toggle('active');
    document.querySelector('.nav-links').classList.toggle('active');
});


window.addEventListener('scroll', function() {
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.querySelector('.nav-links');

    if (hamburger.classList.contains('active')) {
        hamburger.classList.remove('active');
        navLinks.classList.remove('active');
    }
});

document.querySelector('.kruis').addEventListener('click', function() {
    document.querySelector('.meerOverMij').classList.remove('active');
});

document.getElementById('meerOverMijButton').addEventListener('click', function() {
    document.querySelector('.meerOverMij').classList.add('active');
});

window.changeSkill = function(index, skillsId, ballId) {
    // Remove active class from all balls
    const balls = document.querySelectorAll(`#${ballId} .ball`);
    balls.forEach(ball => ball.classList.remove('active'));

    // Add active class to the clicked ball
    balls[index].classList.add('active');

    // Remove active class from all skills
    const skills = document.querySelectorAll(`#${skillsId} .skill`);
    skills.forEach(skill => skill.classList.remove('active'));

    // Add active class to the corresponding skill
    skills[index].classList.add('active');
};
