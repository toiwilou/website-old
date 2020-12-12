
var skillsHide = document.querySelector('.skills-hide');
var openSkills = document.querySelector('.open-skills');
var closeSkills = document.querySelector('.close-skills');

openSkills.addEventListener('click', function(){
    skillsHide.classList.add('skills-visible');
    openSkills.style.display = 'none';
});

closeSkills.addEventListener('click', function(){
    skillsHide.classList.remove('skills-visible')
    openSkills.style.display = 'block';
});