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

class CreateProject extends Quest {
    constructor(node) {
        super(node);

        $(node).find('.quest__step-arrow.send').on('click', this.sendData)
        $(node).find('.input-file input').on('change', function(){
            $(this).closest('.input-file').find('span').text('Изображение успешно загружено')
        })

        $(node).find('.upload-files').find('.upload-files__plus').on('click', this.plusFile)

        return this;
    }
    saveUri = '#';
    emptyErrorsKeys = {
        projectName: 'Название проекта',
        productName: 'Название товара',
        productLink: 'Ссылка',
        productImg: 'Изображение товара',
        productPrice: 'Цена',
        format: 'Формат рекламы'
    }
    newFileTemplate = `<div class="upload-files__item">
                            <div class="upload-files__path">

                            </div>
                            <div class="upload-files__delete">

                            </div>
                            <input type="file" hidden name = "images[]">
                            <input type="text" data-id="" hidden>
                        </div>`
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

    plusFile = ()=>{
        var plusBtn = $(this.node).find('.upload-files').find('.upload-files__plus');

        $(this.newFileTemplate).insertBefore(plusBtn);

        var newFile = plusBtn.prev();
        var self = this;

        newFile.find('input[type="file"]').on('change', function(){
            var newFileName = $(this).prop('files')[0].name;

            newFile.find('.upload-files__path').text(newFileName)
            newFile.addClass('uploaded');

            newFile.find('.upload-files__delete').on('click', (e) => self.deleteFile(e));
        })

        newFile.find('input[type="file"]').click();
    }

    deleteFile = (e) => {
        $(e.target).closest('.upload-files__item').remove();
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
    sendUri = '/apist/bloggers';
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
                $(this.node).find('#filter-platform').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-platform').val();
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
        },
        city: {
            set: (value)=>{
                $(this.node).find('#filter-city').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-city').val();
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
        var self = this;

        var questData = {
            name: this.dataProps.blogerName.get(),
            platform: this.dataProps.platform.get().toLowerCase(),
            subscriber_quantity_min: this.dataProps.subscribers.get()['min'],
            subscriber_quantity_max: this.dataProps.subscribers.get()['max'],
            city: this.dataProps.city.get()
        }
        console.log(questData);
        $.post(self.sendUri, questData, function(res){
            $(document).find('.blogers-list__list.list-blogers').remove();
            $(document).find('.profile-blogers__body').append(res);
        })
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
    sendUri = '/apist/projects';
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
                $(this.node).find('#filter-format').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-format').val();
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
        var self = this;

        var questData = {
            project_type: this.dataProps.format.get(),
            project_name: this.dataProps.projectName.get(),
        }

        $.post(self.sendUri, questData, function(res){
            $(document).find('.profile-projects__items').remove();
            $(document).find('.profile-projects__body').append(res);
        })
    }
}

class BloggerAllProjectsFilter {
    constructor(node) {
        this.node = node;

        $(this.node).find('.btn-filter-send').on('click', this.sendData);
        $(this.node).find('.filter__reset').on('click', this.resetFilters);

        return this;
    }
    node = '';
    sendUri = '/apist/projects';
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
                $(this.node).find('#filter-format').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-format').val();
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
        var self = this;

        var questData = {
            project_type: this.dataProps.format.get(),
            project_name: this.dataProps.projectName.get(),
        }

        $.post(self.sendUri, questData, function(res){
            $(document).find('.list-projects__items').empty();
            $(document).find('.list-projects__items').append(res);
        })
    }
}

class BloggerProjectsFilter {
    constructor(node) {
        this.node = node;

        $(this.node).find('.btn-filter-send').on('click', this.sendData);
        $(this.node).find('.filter__reset').on('click', this.resetFilters);

        return this;
    }
    node = '';
    sendUri = '/apist/blogger/projects';
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
                $(this.node).find('#filter-format').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-format').val();
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
        var self = this;

        var questData = {
            project_type: this.dataProps.format.get(),
            project_name: this.dataProps.projectName.get(),
        }

        $.post(self.sendUri, questData, function(res){
            $(document).find('.list-projects__items').empty();
            $(document).find('.list-projects__items').append(res);
        })
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

        this.getMsgCountInterval = setInterval(this.getNewMessagesCount, 5000);

        $(this.node).on('click', '.chat__btns .btn-send-msg', (e) => { this.sendMessage(e) });
        $(this.node).on('click', '#accept-btn', (e) => {
            e.preventDefault()
            $.ajax({
                url: $(e.target).prop('href'),
                data: {},
                method: 'POST',
                processData: false,
                contentType: false,
                success: (res)=>{
                    $(e.target).prop('id', 'confirm-completion-btn')
                    $(e.target).text('Подтвердить выполнение')
                }
            })
        });
        $(this.node).on('click', '.item-chat', (e) => { this.chooseChat(e) });
        $(this.node).on('change', '#chat-upload', (e) => { this.uploadFile(e) });
        $(this.node).on('click', '.chat__back', (e) => {
            $('.chat__left').show();
            $('.chat__right').hide();
            this.currentChatId = false;
        });

        var mediaQuery = window.matchMedia('(max-width: 700px)')

        if (mediaQuery.matches) {
            $(this.node).on('click', '.item-chat', ()=>{
                $('.chat__left').hide()
                $('.chat__right').show()
            });
        }
        else{
            $(window).on('resize', function(){
                var mediaQuery = window.matchMedia('(max-width: 700px)')

                if (mediaQuery.matches) {
                    $(this.node).on('click', '.item-chat', ()=>{
                        $('.chat__left').hide()
                        $('.chat__right').show()
                    });
                }
            })
        }


        return this;
    }

    node = '';

    sendMsgUri = '/apist/messages/create';
    getMsgUri = '/apist/messages';
    getMsgCountUri = '/apist/notifications?type=message';

    getMsgCountInterval = null;
    getMsgInterval = null;

    currentChatId = false;

    chooseChat = (e)=>{
        if(!e){
            this.getNewMessages()
            return;
        }

        var chat = $(e.target).closest('.item-chat');

        this.getNewMessages(chat.data('id'));
        this.currentChatId = chat.data('id');

        $(document).find('.item-chat.current').removeClass('current');
        chat.addClass('current');

        this.getMsgInterval = setInterval(this.getNewMessages, 5000);
    }

    getNewMessagesCount = ()=>{
        $.get(this.getMsgCountUri, {}, function(res){
            if(Number(JSON.parse(res.count)) > 0){
                $('.nav-menu__link.chat-link .notifs-chat').show()
                $('.nav-menu__link.chat-link').find('.notifs-chat').text(res.count)
            }
            else{
                $('.nav-menu__link.chat-link .notifs-chat').hide()
            }
        })
    }

    uploadFile = () => {
        $(this.node).find('.textarea-upload__text').text('Файл прикреплен');
    }

    getNewMessages = (id = false) => {
        var self = this,
            data = {};

        if(!id) id = self.currentChatId;

        if(id) data = { work_id: id }

        $.post(self.getMsgUri, data, function(res){
            if(!id){
                $(document).find('.chat__chat-items').remove();
                $(document).find('#chat .chat__left').append(res.view);

                $(self.node).find('.chat__overflow').show()
            }
            else{
                $(self.node).find('.messages-chat').empty()
                $(self.node).find('.messages-chat').append(res.view)
                $(self.node).find('.chat__overflow').hide()

                $(self.node).find('.btn-action').text(res['btn-text']);
                $(self.node).find('.btn-action').prop('id', res['btn-class']);

                if(res['btn-class'] == 'accept-btn'){
                    $(self.node).find('.btn-action').prop('href', `/apist/works/${self.currentChatId}/accept`);
                }
                else{
                    $(self.node).find('.btn-action').prop('href', `#`);
                }
            }


            if(!this.newMessagesInterval){
                this.newMessagesInterval = setInterval(this.getNewMessages, 5000);
            }
        })
    }

    sendMessage = () => {
        var msg = $(document).find('.messages-create__textarea').val();
        var self = this;
        var file = $(this.node).find('.textarea-upload #chat-upload').prop('files');

        var formData = new FormData();

        formData.append('message', msg)
        formData.append('img', file[0])
        formData.append('work_id', self.currentChatId)

        $.ajax({
            url: self.sendMsgUri,
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res)=>{
                $(self.node).find('.item-chat.current').click();

                $(self.node).find('.messages-create__textarea').val('')
                $(self.node).find('.textarea-upload__text').text('Прикрепите файл');
                $(self.node).find('.textarea-upload #chat-upload').val('');
            }
        })
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

    sendUri = '/apist/feedback';
    dataProps = {
        name: {
            set: (value)=>{
                $(this.node).find('#name').val(value)
            },
            get: ()=>{
                return $(this.node).find('#name').val();
            }
        },
        phone: {
            set: (value)=>{
                $(this.node).find('#phone').val(value)
            },
            get: ()=>{
                return $(this.node).find('#phone').val();
            }
        }
    }
    sendData = () => {
        var self = this;

        $.post(self.sendUri, {
            message: self.dataProps.name.get(),
            mark: self.dataProps.phone.get(),
        }, function(res){
            notify('info', {title: 'Успешно!', message: 'Данные успешно отправлены'});
            self.closePopup();

            for(let key in self.dataProps){
                self.dataProps[key].set('')
            }
        })
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

class PopupConfirmCompletion extends Popup{
    constructor(node){
        super(node);

        this.node = node;

        $(this.node).find('.mark-items__star').on('click', (e) => this.setMark(e));
        $(this.node).find('.btn.send-data').on('click', this.sendData);

        return this;
    }

    node = '';
    sendUri = "/apist/projects/confirm";
    mark = 0;

    setMark = (e) => {
        var cStar = $(e.target).closest('.mark-items__star'),
            allStars = $(this.node).find('.mark-items__star');

        allStars.removeClass('active');
        allStars.each((i, star) => {
            if(allStars.index(star) <= allStars.index(cStar)){
                $(star).addClass('active');
            }
        })

        this.mark = allStars.index(cStar);
    }

    sendData = () => {
        var self = this;

        $.post(self.sendUri, {
            message: $(self.node).find('#comment').val(),
            mark: self.mark,
            work_id: $(document).find('.item-chat.current').data('id')
        }, function(res){
            notify('info', {title: 'Успешно!', message: 'Вы успешно подтвердили выполнение проекта'});
            self.closePopup();
        })
    }
}

class PopupConfirmCompletionBlogger extends Popup{
    constructor(node){
        super(node);

        this.node = node;

        $(this.node).find('.mark-items__star').on('click', (e) => this.setMark(e));
        $(this.node).find('.btn.send-data').on('click', this.sendData);
        $(this.node).find('.input-file.input-file--stat input[type="file"]').on('change', this.uploadFile)

        return this;
    }

    node = '';
    sendUri = "/apist/projects/confirm";
    workId = false;

    uploadFile  = () => {
        $(this.node).find('.input-file.input-file--stat label').text('Файл прикреплен')
    }

    sendData = () => {
        var self = this;

        if(self.workId){
            var data = new FormData;

            data.append('img', $(self.node).find('#statistics-file')[0].files[0]);
            data.append('work_id', self.workId);
            data.append('message',$(self.node).find('#comment').val());

            $.ajax({
                type: "POST",
                url: self.sendUri,
                data: data,
                cache : false,
                processData: false,
            }).done(res=>{
                notify('info', {title: 'Успешно!', message: 'Вы успешно подтвердили выполнение проекта'});
                self.closePopup();
            })
        }

    }
}

class PopupChangePassword extends Popup{
    constructor(node){
        super(node);

        this.node = node;

        $(this.node).find('.send-data').on('click', this.sendData)

        return this;
    }

    node = '';
    sendUri = "/apist/password/reset";

    dataProps = {
        phone: {
            set: (val) => {console.log(val);},
            get: () =>{
                return $(this.node).find('#phone').val();
            }
        }
    }

    sendData = () => {
        var self = this;
        $.post(self.sendUri, {
            phone: self.dataProps.phone.get(),
        }, function(res){
            notify('info', {title: 'Сообщение отправлено!', message: 'Вам отправлен новый пароль, перейдите в телеграм, чтобы получить его'})
        })
    }
}

class DashboardTabs extends Tabs{
    constructor(node){
        super(node);

        this.node = node;
        $(this.node).find('.dashboard__tab').on('click', this.tabClick);

        return this;
    }
    node = '';
    dataProps = {

    }
    tabClick = (e)=>{
        var curTab = $(e.target);
        if(curTab.hasClass('disabled')){
            notify('info',{title: 'Внимание', message: 'Данный раздел находится в разработке'})

            return;
        }
        $(this.node).find('.dashboard__tab').removeClass('active');
        $(this.node).find('.dashboard__content').removeClass('active');

        curTab.closest('.dashboard__tab').addClass('active');
        $(`#${curTab.data('content')}`).addClass('active')
    }
}


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

$(window).on('load', function(){
    var quant = $(document).find('.quantity-w');

    quant.on('click', function(e){
        var prevVal = Number($(this).find('.quantity-input .input').val()),
            maxVal = Number($(this).data('max'));

        if($(e.target).closest('.quantity-minus').length > 0){
            if(prevVal > 0){
                $(this).find('.quantity-input .input').val(prevVal - 1)
            }
        }
        if($(e.target).closest('.quantity-plus').length > 0){
            if(prevVal < maxVal){
                $(this).find('.quantity-input .input').val(prevVal + 1)
            }
        }
    })

    $(document).on('click', '.profile .nav-menu__close', function(e){
        $(e.target).closest('.profile__navigation.nav-menu').toggleClass('active')
    })

    var dbTabs = new DashboardTabs('.dashboard');

    var chat = new Chat('.profile-chat__body');
    $(document).find('.nav-menu__link.chat-link').on('click', () => chat.getNewMessages(false))

    $(document).on('click', '.tarrif-header', function(e){
        $('.header__profile-item--js').not($(e.target).closest('.tarrif-header')).removeClass('active')
        $(e.target).closest('.tarrif-header').toggleClass('active')
    })
    $(document).on('click', '.header__profile-w', function(e){
        $('.header__profile-item--js').not($(e.target).closest('.header__profile-w')).removeClass('active')
        $(e.target).closest('.header__profile-w').toggleClass('active')
    })
    $(document).on('click', '.header__notif', function(e){
        $('.header__profile-item--js').not((e.target).closest('.header__notif')).removeClass('active')
        $(e.target).closest('.header__notif').toggleClass('active')
    })


    $(document).on('click', '.chat-img-popup', function(e){
        var src = $(e.target).prop('src');

        var popup = new Popup($(e.target).data('popup'));
        $(popup.node).find('.chat-img').prop('src', src);
        popup.openPopup();

    })

    $(document).on('click', '.profile-projects__item .btn-bloggers', function(e){
        $(e.target).closest('.profile-projects__item').toggleClass('active-bloggers');
        $(e.target).closest('.profile-projects__item').removeClass('active-statistics');
    })

    $(document).on('click', '.profile-projects__item .btn-statistics', function(e){
        $(e.target).closest('.profile-projects__item').toggleClass('active-statistics');
        $(e.target).closest('.profile-projects__item').removeClass('active-bloggers');
    })

    $('.profile-projects__item').find('.owl-carousel').owlCarousel({
        margin: 5,
        nav: true,
        responsive: {
            0:{
                items: 1
            },
            1180: {
                items:2
            }
        }
    });

    $(document).on('click', '.profile-projects__item .profile-projects__blogers', function(e){
        e.stopPropagation()
    })

    var quest = new CreateProject('.create-project__quest');

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
    var projectsFilters = new ProjectsFilter('.profile#seller .projects-list__filter');
    var blogersProjectsFilters = new BloggerProjectsFilter('.profile#blogger #my-projects .projects-list__filter');
    var blogersAllProjectsFilters = new BloggerAllProjectsFilter('.profile#blogger #profile-projects .projects-list__filter');

    $('.projects-list__filter-btn').on('click', function(){
        console.log(123);
        $('.projects-list__filter').addClass('opened');

        $(document).off('click').on('click', function(e){
            if(!$(e.target).hasClass('projects-list__filter') && !$(e.target).hasClass('projects-list__filter-btn')){
                $('.projects-list__filter').removeClass('opened');
            }
        })
    })


    //profile
    var profileTabs = new Tabs('.profile__body')
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

    $(document).on('click', '#change-password-btn', function(){
        let popup = new PopupChangePassword('#change-password');
        popup.openPopup();
    })


    $(document).on('click', '#confirm-completion-btn', function(e){
        e.preventDefault();

        let popup = new PopupConfirmCompletion('#confirm-completion');
        popup.openPopup();
    })

    $(document).on('click', '#confirm-completion-blogger-btn', function(e){
        e.preventDefault();

        let popup = new PopupConfirmCompletionBlogger('#confirm-completion-blogger');
        popup.workId = $(e.target).data('work-id');
        popup.openPopup();
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

setInterval(() => {
    $.ajax({
        url: '/apist/notifications',
    })
    .done(function( data ) {
        document.querySelector('#header-notif-container').innerHTML = data.view;
        document.querySelector('#header-notif-count').innerHTML = data.count;
        if (data.count == 0) {
            document.querySelector('#header-notif-count').style.display = 'none';
        } else {
            document.querySelector('#header-notif-count').style.display = 'block';
        }
    });
}, 5000)

selectTab = (tabName)=>{
    $('.tab').removeClass('active');
    $('.tab-content').removeClass('active');
    curTab = $(`[data-content=${tabName}]`);
    curTab.addClass('active');
    $(`#${tabName}`).addClass('active')
}
