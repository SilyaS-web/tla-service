class Quest {
    constructor(node) {
        this.node = node;
        this.stepsCount = $(node).find('.step').length;
        this.currentStep = 1;

        $(node).find('.btn.next').on('click', this.nextStep)
        $(node).find('.btn.back').on('click', this.stepBack)

        return this;
    }
    currentStep = 1;
    stepsCount = 1;
    node = '';
    nextStep = ()=>{
        if(this.currentStep + 1 <= this.stepsCount){
            this.currentStep += 1;

            $(this.node).find('.step').removeClass('current');
            $(this.node).find(`#step_${this.currentStep}`).addClass('current');
        }
    }
    stepBack = ()=>{
        if(this.currentStep - 1 > 0){
            this.currentStep -= 1;

            $(this.node).find('.step').removeClass('current');
            $(this.node).find(`#step_${this.currentStep}`).addClass('current');
        }
    }
}

$(window).on('load', function(){
    $(document).on('click', '.owl-dots', (e) => e.stopPropagation())


    $(document).on('click', '.profile .nav-menu__close', function(e){
        $(e.target).closest('.profile__navigation.nav-menu').toggleClass('active')
    })

    $(document).on('click', '.tarrif-header', function(e){
        $('.header__profile-item--js').not($(e.target).closest('.tarrif-header')).removeClass('active')
        $(e.target).closest('.tarrif-header').toggleClass('active')
    })
    $(document).on('click', '.header__profile-w', function(e){
        $('.header__profile-item--js').not($(e.target).closest('.header__profile-w')).removeClass('active')
        $(e.target).closest('.header__profile-w').toggleClass('active')
    })
    $(document).on('click', '.header__notif', function(e){
        if($(e.target).closest('.notif-header__hide').length == 0){
            $('.header__profile-item--js').not((e.target).closest('.header__notif')).removeClass('active')
            $(e.target).closest('.header__notif').toggleClass('active')
        }
    })

    $(document).on('click', '.profile-projects__item .btn-bloggers', function(e){
        $(e.target).closest('.profile-projects__item').toggleClass('active-bloggers');
        $(e.target).closest('.profile-projects__item').removeClass('active-statistics');
        $(e.target).closest('.profile-projects__item').removeClass('active-bloggers-in_work');
    })

    $(document).on('click', '.profile-projects__item .btn-statistics', function(e){
        $(e.target).closest('.profile-projects__item').toggleClass('active-statistics');
        $(e.target).closest('.profile-projects__item').removeClass('active-bloggers');
        $(e.target).closest('.profile-projects__item').removeClass('active-bloggers-in_work');
    })

    $(document).on('click', '.profile-projects__item .btn-bloggers-in_work', function(e){
        $(e.target).closest('.profile-projects__item').removeClass('active-statistics');
        $(e.target).closest('.profile-projects__item').removeClass('active-bloggers');
        $(e.target).closest('.profile-projects__item').toggleClass('active-bloggers-in_work');
    })

    $(document).on('click', '.profile-projects__item .profile-projects__blogers', function(e){
        e.stopPropagation()
    })

    // burger menu
    $(document).on('click', '.burger-menu__close', function(){
        $('.burger-menu').removeClass('opened');
    })
    $(document).on('click', '.burger', function(){
        $('.burger-menu').addClass('opened');
    })


    $(document).on('click', '.projects-list__filter-btn', function(){
        $(this).closest('.tab-content').find('.projects-list__filter').toggleClass('opened')
    })
    $(document).on('click', '.filter__hide', function(){
        $(this).closest('.filter').removeClass('opened');
    })


    $(document).find('.quest__step .input-checkbox-w.disabled').on('click', function(e){
        $(e.target).closest('.input-checkbox-w').find('input').prop('checked', false);
        notify('info',{title: 'Внимание', message: 'Данный формат рекламы находится в разработке'})
    })

    $(document).find('.nav__link.disabled').on('click', function(e){
        e.preventDefault()
        $(e.target).closest('.input-checkbox-w').find('input').prop('checked', false);
        notify('info',{title: 'Внимание', message: 'Данная страница находится в разработке'})
    })

})

function ibg(){
    let ibg = $('._ibg');

    $(ibg).each((i, item)=>{
        if(img = $(item).find('img')){
            $(item).css("background-image", 'url("' + img.attr('src') + '")');
        }
    })
}

window.addEventListener('load', ibg)

function notify(type, content){
    $('.notification').fadeIn()
    $('.notification').addClass(type)
    $('.notification .notification__title').text(content.title);
    $('.notification .notification__text').text(content.message);

    setTimeout(()=>{
        $('.notification').fadeOut()
        $('.notification').removeClass(type)
    }, 5000)
}

