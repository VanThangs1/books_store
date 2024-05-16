
const setAuthActive = function (index) {
    const forms = $$('.auth-form .form form');
    const btns = $$('.auth-form .control p');

    if (forms[index]) {
        forms[index].classList.add('active-form');
    }

    if (btns[index]) {
        btns[index].classList.add('active');
    }
}

const deleteAuthActive = function () {
    const activeForm = $('.auth-form .form .active-form');
    const activeBtn = $('.auth-form .control .active');

    if (activeForm) {
        activeForm.classList.remove('active-form');
    }

    if (activeBtn) {
        activeBtn.classList.remove('active');
    }
}

$('.auth-form .control').addEventListener('click',(e) => {
    const btn_list = $$('.auth-form .control p');
    const index = Array.from(btn_list).indexOf(e.target);
    if(e.target !== $('.auth-form .control .active') && index !== -1) {
        deleteAuthActive();
        setAuthActive(index);
    }
    
})

function setFormActive() {
    var fragmentIdentifier = window.location.hash.substring(1);
    deleteAuthActive();
    if(fragmentIdentifier == 'register') {
        setAuthActive(1);
    }else if(fragmentIdentifier == 'forgot-password') {
        setAuthActive(2);
    }else {
        setAuthActive(0);
    }
}
setFormActive();
window.addEventListener('hashchange', function() {
    setFormActive();
});

function setFlagmentIndentifier(flagmentIndent) {
    window.location.hash = flagmentIndent;
}
