class Quest {
    constructor(node) {
        this.node = node;
        this.stepsCount = $(node).find('.quest__step').length;
        this.currentStep = 1;

        $(node).find('.btn.next').on('click', this.nextStep)
        $(node).find('.quest__step-arrow.next').on('click', this.nextStep)
        $(node).find('.btn.back').on('click', this.stepBack)
        $(node).find('.btn.send').on('click', this.sendData)
        $(node).find('.quest__step-arrow.send').on('click', this.sendData)
        $(node).find('.input-file input').on('change', function(){
            $(this).closest('.input-file').find('span').text('Изображение успешно загружено')
        })

        return this;
    }
    currentStep = 1;
    stepsCount = 1;
    node = '';
    saveUri = '#';
    emptyErrorsKeys = {
        projectName: 'Название проекта',
        productName: 'Название товара',
        productLink: 'Ссылка',
        productImg: 'Изображение товара',
        productPrice: 'Цена',
        format: 'Формат рекламы'
    }
    dataProps = {
        projectName: {
            set: (value)=>{
                $(this.node).find('#project-name').val(value);
            },
            get: ()=>{
                return $(this.node).find('#project-name').val(); 
            }
        },
        productName: {
            set: (value)=>{
                $(this.node).find('#product-name').val(value);
            },
            get: ()=>{
                return $(this.node).find('#product-name').val(); 
            }
        },
        productLink: {
            set: (value)=>{
                $(this.node).find('#project-link').val(value);
            },
            get: ()=>{
                return $(this.node).find('#project-link').val(); 
            }
        },
        productImg: {
            get: ()=>{
                return $(this.node).find('#product-img').prop('files');
            }
        },
        productPrice: {
            set: (value)=>{
                return $(this.node).find('#project-price').val(value);
            },
            get: ()=>{
                return $(this.node).find('#project-price').val();
            }
        },
        format: {
            set: (type, value)=>{
                $(this.node).find(`#${type}`).val(value);
            },
            get: ()=>{
                return $(this.node).find('.marketing-format').find('input:checked').attr('id'); 
            }
        }
    }
    nextStep = ()=>{
        if(this.currentStep + 1 <= this.stepsCount){
            this.currentStep += 1;
        
            $(this.node).find('.quest__step').removeClass('current'); 
            $(this.node).find(`#quest_${this.currentStep}`).addClass('current');
        }
    }
    stepBack = ()=>{
        if(this.currentStep - 1 > 0){
            this.currentStep -= 1;
    
            $(this.node).find('.quest__step').removeClass('current'); 
            $(this.node).find(`#quest_${this.currentStep}`).addClass('current');
        }
    }
    sendData = ()=>{
        var questData = {}, isAnyFieldEmpty = false;

        for(let key in this.dataProps){
            let value = this.dataProps[key].get();
            console.log(value);
            if(value == '' || value == null || value == undefined){
                isAnyFieldEmpty = true;
                notify('error', {'title': 'Ошибка.', 'message': `Поле "${this.emptyErrorsKeys[key]}" должно быть заполнено`})
                break;
            }

            questData[key] = value;
        }

        if(!isAnyFieldEmpty){
            var data = new FormData();
            
            for(var key in questData){
                data.append(key, questData[key]);
            }
    
            console.log(data, questData);
    
            notify('success', {'title': 'Успешно!', 'message': 'Проект успешно сохранен, можете посмортеть список проектов во вкладке "Мои проекты"'})
        }
    }
}

class BlogersFilter {
    constructor(node) {
        this.node = node;

        $(this.node).find('#subs-range').on('change', this.listenToSubsRange);
        $(this.node).find('.btn-filter-send').on('click', this.sendData);
        $(this.node).find('.filter__reset').on('click', this.resetFilters);

        return this;
    }
    node = '';
    saveUri = '#';
    dataProps = {
        blogerName: {
            set: (value)=>{
                $(this.node).find('#filter-name').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-name').val(); 
            }
        },
        category: {
            set: (value)=>{
                $(this.node).find('#filter-cat').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-cat').val(); 
            }
        },
        platform: {
            set: (value)=>{
                $(this.node).find('#filter-name').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-name').val(); 
            }
        },
        sex: {
            set: (value)=>{
                $(this.node).find('#filter__item--sex').find(`#${value}`).prop('checked', true);
            },
            get: ()=>{
                return $(this.node).find('#filter__item--sex').find('input:checked').prop('id')
            }
        },
        subscribers: {
            set: (value)=>{
                console.log(value);
            },
            get: ()=>{
                return {
                    'min': $(this.node).find('#subs-min').val(),
                    'max': $(this.node).find('#subs-max').val(),
                }
            }
        },
        country: {
            set: (value)=>{
                $(this.node).find('#filter-country').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-country').val(); 
            }
        }
    }
    resetFilters = () => {
        for(var key in this.dataProps){
            this.dataProps[key].set('');
        }
    }
    listenToSubsRange = ()=>{
        var value = $(this.node).find('#subs-range').val();

        $(this.node).find('#subs-max').val(value)
    }
    sendData = ()=>{
        var questData = {
            
        }
        
        var data = new FormData();
        
        for(var key in questData){
            data.append(key, questData[key]);
        }

        console.log(data, questData);
    }
}

class ProjectsFilter {
    constructor(node) {
        this.node = node;

        $(this.node).find('.btn-filter-send').on('click', this.sendData);
        $(this.node).find('.filter__reset').on('click', this.resetFilters);

        return this;
    }
    node = '';
    saveUri = '#';
    dataProps = {
        projectName: {
            set: (value)=>{
                $(this.node).find('#filter-name').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-name').val(); 
            }
        },
        format: {
            set: (value)=>{
                $(this.node).find('#filter-cat').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-cat').val(); 
            }
        },
        status: {
            set: (value)=>{
                $(this.node).find('#filter-name').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-name').val(); 
            }
        },
        country: {
            set: (value)=>{
                $(this.node).find('#filter-country').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-country').val(); 
            }
        }
    }
    resetFilters = () => {
        for(var key in this.dataProps){
            this.dataProps[key].set('');
        }
    }
    sendData = ()=>{
        var questData = {
            
        }
        
        var data = new FormData();
        
        for(var key in questData){
            data.append(key, questData[key]);
        }

        console.log(data, questData);

        // notify('success', {'title': 'Успешно!', 'message': 'Проект успешно сохранен, можете посмортеть список проектов во вкладке "Мои проекты"'})
    }
}

class Tabs {
    constructor(node) {
        this.node = node;
        
        $(this.node).find('.tab').on('click', this.tabClick);

        return this;
    }
    node = '';
    dataProps = {
        
    }
    tabClick = (e)=>{
        var curTab = $(e.target);

        $('.tab').removeClass('active');
        $('.tab-content').removeClass('active');

        curTab.addClass('active');
        $(`#${curTab.data('content')}`).addClass('active')
    }
}

class ProfileInfoForm {
    constructor(node) {
        this.node = node;

        $(this.node).find('#profile-img').on('change', this.profileImgUploadedListener);
        // this.getUserData();
        
        return this;
    }
    node = '';
    saveUri = '#';
    getUri = '#';
    imgPath = '#';
    dataProps = {
        img: {
            set: (value)=>{
                $(this.node).find('.tab-content__profile-img').attr('src', value);
            },
            get: ()=>{
                return $(this.node).find('.tab-content__profile-img').attr('src'); 
            }
        },
        name: {
            set: (value) => {
                $(this.node).find('#name').val(value);
            },
            get: ()=>{
                return $(this.node).find('#name').val(); 

            }
        },
        email: {
            set: (value) => {
                $(this.node).find('#email').val(value);
            },
            get: ()=>{
                return $(this.node).find('#email').val(); 

            }
        },
        phone: {
            set: (value) => {
                $(this.node).find('#phone').val(value);
            },
            get: ()=>{
                return $(this.node).find('#phone').val(); 

            }
        },
        nick: {
            set: (value) => {
                $(this.node).find('#nick').val(value);
            },
            get: ()=>{
                return $(this.node).find('#nick').val(); 

            }
        },
        whois: {
            set: (value) => {
                $(this.node).find('.whois#' + value).prop('checked', true);
            },
            get: ()=>{
                return $(this.node).find('.whois:checked').val(); 

            }
        },
        type: {
            set: (value) => {
                $(this.node).find('#type').val(value);
            },
            get: ()=>{
                return $(this.node).find('#type').val(); 

            }
        },
        inn: {
            set: (value) => {
                $(this.node).find('#inn').val(value);
            },
            get: ()=>{
                return $(this.node).find('#inn').val(); 

            }
        },
    }
    saveUserData = ()=>{
        var questData = {
            
        }
        
        var data = new FormData();
        
        for(var key in questData){
            data.append(key, questData[key]);
        }

        console.log(data, questData);

        // notify('success', {'title': 'Успешно!', 'message': 'Проект успешно сохранен, можете посмортеть список проектов во вкладке "Мои проекты"'})
    }

    getUserData = ()=>{
        $.ajax({
            url: this.getUri,
        })
        .done(function( data ) {
            console.log(data);
        });
    }

    profileImgUploadedListener = () => {
        $(this.node).find('.tab-content__profile-img-upload').text('Изображение успешно загружено');
    } 
}

class Chat {
    constructor(node) {
        this.node = node;

        $(this.node).find('#profile-img').on('change', this.profileImgUploadedListener);
        // this.getUserData();
        
        return this;
    }
    node = '';
    sendMsgUri = '#';
    getMsgUri = '#';
    
    chooseChat = ()=>{
        
    }
}

class Popup{
    constructor(node) {
        this.node = node;

        $(this.node).find('.close-popup').on('click', this.closePopup)
        
        return this;
    }
    
    node = '';
    
    openPopup = () => {
        $(this.node).addClass('opened');
    }
    
    closePopup = () => {
        $(this.node).removeClass('opened');
    }
}

class PopupCallUs extends Popup{
    constructor(node){
        super(node);
        
        $(this.node).find('.btn.send-data').on('click', this.sendData)

        return this;
    }

    sendUri = '#';
    dataProps = {
        name: {
            set: (value)=>{
                console.log(value)
            },
            get: ()=>{
                return $(this.node).find('#name').val();
            }
        },
        phone: {
            set: (value)=>{
                console.log(value)
            },
            get: ()=>{
                return $(this.node).find('#phone').val();
            }
        }
    }
    sendData = () => {//не знаю куда если честно это отправлять, мб потом в админку, но пока что так понимаю на почту, естественно через бэк
    
        var data = new FormData();
        
        for(var key in this.dataProps){
            data.append(key, questData[key].get());
        }

        console.log(data, questData);
    }
}

class PopupAddBlogerToProject extends Popup{//когда нибудь тут будет пагинация
    constructor(node){
        super(node);
        
        $(this.node).find('.btn.btn-add').on('click', (e)=>{
            this.projectId = $(e.target).closest('popup-projects__item').data('id');

            this.addToProject()
        })

        $(this.node).find('.popup__search .btn-search').on('click', this.searchProjects)

        return this;
    }

    searchUri = '#';

    sendUri = '#';
    blogerId = '#';
    projectId = '#';

    dataProps = {
        searchField: {
            get: ()=>{
                return $(this.node).find('.popup__search .input').val();
            }
        }
    }

    addToProject = () => {
        console.log(this.blogerId,this.projectId );
        $.ajax({
            url: this.sendUri,
            body: {
                'bloger-id': this.blogerId,
                'project-id': this.projectId,
            },
            success: ()=>{
                this.closePopup();
            }
        })
    }
    searchProjects = () => {
        $.ajax({
            url: this.searchUri,
            body: {
                'name': this.dataProps.searchField.get(),
            },
            success: (data)=>{
                console.log(data);
            }
        })
    }
}


function notify(type, content){
    $('.notification').show()
    $('.notification').addClass(type)
    $('.notification .notification__title').text(content.title);
    $('.notification .notification__text').text(content.message);
    
    setTimeout(()=>{
        $('.notification').hide()
        $('.notification').removeClass(type)
        $('.notification .notification__text').text('');
    }, 5000)
}

$(window).on('load', function(){
    var quest = new Quest('.create-project__quest');

    // burger menu
    $('.burger-menu__close').on('click', function(){
        $('.burger-menu').removeClass('opened');
    })
    $('.burger').on('click', function(){
        $('.burger-menu').addClass('opened');
    })


    //blogers filters
    var blogerFilters = new BlogersFilter('.blogers-list__filter');
    
    $('.blogers-list__filter-btn').on('click', function(){
        $('.blogers-list__filter').addClass('opened');

        $(document).off('click').on('click', function(e){
            if(!$(e.target).hasClass('blogers-list__filter') && !$(e.target).hasClass('blogers-list__filter-btn')){
                $('.blogers-list__filter').removeClass('opened');
            }
        })
    })

    //projects filters
    var projectsFilters = new ProjectsFilter('.projects-list__filter');
    
    $('.projects-list__filter-btn').on('click', function(){
        $('.projects-list__filter').addClass('opened');

        $(document).off('click').on('click', function(e){
            if(!$(e.target).hasClass('projects-list__filter') && !$(e.target).hasClass('projects-list__filter-btn')){
                $('.projects-list__filter').removeClass('opened');
            }
        })
    })


    //profile
    var profileTabs = new Tabs('.profile-tabs') 
    var profileForm = new ProfileInfoForm('#info') 

    //popups
    $(document).on('click', '#contact-us', function(){
        let form = new PopupCallUs('#contact-form');
        form.openPopup()
    })
    $(document).on('click', '.btn-add-to-project', function(e){//здесь вообще так должно работать, что если мы не со страницы создания проекта пришли, то попапа нет, тк у нас есть айдишник проекта
        var pId = $(e.target).closest('.card').find('btn-add-to-project').data('project-id'); 
        var bId = $(e.target).closest('.card').data('id'); 
        
        if(pId && pId != ''){
            $.ajax({
                url: '#',
                body: {
                    'bloger-id': bId,
                    'project-id': pId,
                }
            })

            return
        }

        let form = new PopupAddBlogerToProject('#add-to-project');
        console.log(bId);
        form.blogerId = bId;

        form.openPopup();
    })

    $(document).find('.quest__step .input-checkbox-w.disabled').on('click', function(e){
        $(e.target).closest('.input-checkbox-w').find('input').prop('checked', false);
        notify('info',{title: 'Внимание', message: 'Данный формат рекламы находится в разработке'})
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