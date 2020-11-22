
(function(){

    var scrollY = function () {
        var supportPageOffset = window.pageXOffset !== undefined;
        var isCSS1Compat = ((document.compatMode || "") === "CSS1Compat");
        return supportPageOffset ? window.pageYOffset : isCSS1Compat ? document.documentElement.scrollTop : document.body.scrollTop;
    }
    
    var menu = document.querySelector('.menu')
    var onScroll = function(){
        if(scrollY() > 0){
            menu.classList.add('fixed')
        } else {
            menu.classList.remove('fixed')
            menu.style.transition = '500ms'
        }
    }
    window.addEventListener('scroll', onScroll)

})()