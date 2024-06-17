//----To next dev guy-----
//If you watching this it means I've save myself and leave
//All I wanna say is Sorry :3

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
        },
        feedback_q: {
            set: ()=>{

            },
            get: ()=>{
                return $(this.node).find('#feedback-quantity').find('input:checked').attr('id');
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
        themes: {
            set: (value)=>{
                $(this.node).find('.form-formats').find('.form-format__check').prop('checked', false);
            },
            get: ()=>{
                var themes = $(this.node).find('.form-formats').find('.form-format__check:checked'),
                    values = [];

                themes.each((i, v) => { values.push($(v).val()) })

                return values;
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
                if(!value || value == '') $(this.node).find('#filter__item--sex').find('input').prop('checked', false);

                $(this.node).find('#filter__item--sex').find(`#${value}`).prop('checked', true);
            },
            get: ()=>{
                var male = $(this.node).find('#filter__item--sex').find('input#male:checked').prop('id') || false,
                    female = $(this.node).find('#filter__item--sex').find('input#female:checked').prop('id') || false;

                var arr = [];

                if(male)
                    arr.push(male);
                if(female)
                    arr.push(female);

                return arr.join(',');
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
            city: this.dataProps.city.get(),
            country: this.dataProps.country.get(),
            sex: this.dataProps.sex.get(),
            themes: this.dataProps.themes.get(),
        }

        $.post(self.sendUri, questData, function(res){
            $(document).find('.blogers-list__list.list-blogers').remove();
            $(document).find('.profile-blogers__body').append(res);
        })
    }
}

class ProjectsFilter {
    constructor(node, type = false) {
        this.node = node;

        $(this.node).find('.btn-filter-send').on('click', this.sendData);
        $(this.node).find('.filter__reset').on('click', this.resetFilters);

        if(type)
            this.type = type;

        return this;
    }
    node = '';
    sendUri = '/apist/projects';
    type = null;

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
            category: this.dataProps.category.get(),
            type: this.type,
        }

        $.post(self.sendUri, questData, function(res){
            $(self.node).closest('.profile-projects').find('.profile-projects__items').remove();
            $(self.node).closest('.profile-projects').find('.profile-projects__body').append(res);
        })
    }
}

class BloggerAllProjectsFilter {
    constructor(node) {
        this.node = node;

        $(this.node).find('.btn-filter-send').on('click', this.sendData);
        $(this.node).find('.filter__reset').on('click', this.resetFilters);

        $(this.node).find('#filter-category').on('input', (e) => {
            var search = $(e.target).val();

            this.searchTimeout = setTimeout(()=>{
                this.getCategories(search)
            }, 300)
        });

        $(this.node).find('#filter-category').on('focus', (e)=>{
            $(this.node).on('click', (e) => {
                if($(e.target).closest('.filter-tooltip__row').length > 0){
                    var el = $(e.target).closest('.filter-tooltip__row'),
                        text = el.text(),
                        id = el.data('id');

                    $(this.node).find('#filter-category').val(text.trim());
                    this.dataProps.category.set(id)

                    clearTimeout(this.searchTimeout);
                    this.searchTimeout = false;

                    $(this.node).find('.filter-tooltip').hide();
                }
                else if(!$(e.target).closest('.filter-category').length > 0){
                    clearTimeout(this.searchTimeout);
                    this.searchTimeout = false;
                    $(this.node).find('.filter-tooltip').hide();
                }
            })
        })

        return this;
    }
    node = '';
    sendUri = '/apist/blogger/projects';
    getCategoryUri = 'apist/projects/categories';

    searchTimeout = false;

    searchCategoryItemTemplate = `<div class="filter-tooltip__row" data-id="%%ID%%">
                                    %%NAME%%
                                </div>`

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
        },
        category: {
            set: (value)=>{
                $(this.node).find('#filter-category-id').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-category-id').val();
            }
        }
    }

    getCategories = (search) => {
        var self = this;

        $.get(self.getCategoryUri, {
            category: search
        }, function(res){
            self.insertCategorySearchResults(res.categories);
        })
    }

    insertCategorySearchResults = (categories) => {
        if(categories.length > 0){
            var wrap = $(this.node).find('.filter-tooltip'),
                categoryItemsWrap = wrap.find('.filter-tooltip__items');

            categoryItemsWrap.empty();

            for(var k in categories){
                var template = this.searchCategoryItemTemplate;

                template = template.replaceAll('%%ID%%', categories[k].id);
                template = template.replaceAll('%%NAME%%', categories[k].theme);

                categoryItemsWrap.append(template);
            }

            wrap.show();
        }
        else{
            $(this.node).find('.filter-tooltip').hide();
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
            category: this.dataProps.category.get(),
        }

        $.post(self.sendUri, questData, function(res){
            $(self.node).closest('.profile-projects').find('.list-projects__items').empty();
            $(self.node).closest('.profile-projects').find('.list-projects__items').append(res);
        })
    }
}

class BloggerProjectsFilter {
    constructor(node) {
        this.node = node;

        $(this.node).find('.btn-filter-send').on('click', this.sendData);
        $(this.node).find('.filter__reset').on('click', this.resetFilters);
        $(this.node).find('#filter-category').on('input', (e) => {
            var search = $(e.target).val();

            this.searchTimeout = setTimeout(()=>{
                this.getCategories(search)
            }, 300)
        });

        $(this.node).find('#filter-category').on('focus', (e)=>{
            $(this.node).on('click', (e) => {
                if($(e.target).closest('.filter-tooltip__row').length > 0){
                    var el = $(e.target).closest('.filter-tooltip__row'),
                        text = el.text(),
                        id = el.data('id');

                    $(this.node).find('#filter-category').val(text.trim());
                    this.dataProps.category.set(id)

                    clearTimeout(this.searchTimeout);
                    this.searchTimeout = false;
                    $(this.node).find('.filter-tooltip').hide();
                }
                else if(!$(e.target).closest('.filter-category').length > 0){
                    clearTimeout(this.searchTimeout);
                    this.searchTimeout = false;
                    $(this.node).find('.filter-tooltip').hide();
                }
            })
        })

        return this;
    }
    node = '';
    sendUri = '/apist/blogger/projects';
    getCategoryUri = 'apist/projects/categories';

    searchTimeout = false;

    searchCategoryItemTemplate = `<div class="filter-tooltip__row" data-id="%%ID%%">
                                    %%NAME%%
                                </div>`

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
        category: {
            set: (value)=>{
                $(this.node).find('#filter-category-id').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-category-id').val();
            }
        }
    }

    getCategories = (search) => {
        var self = this;

        $.get(self.getCategoryUri, {
            category: search
        }, function(res){
            self.insertCategorySearchResults(res.categories);
        })
    }

    insertCategorySearchResults = (categories) => {
        if(categories.length > 0){
            var wrap = $(this.node).find('.filter-tooltip'),
                categoryItemsWrap = wrap.find('.filter-tooltip__items');

            categoryItemsWrap.empty();

            for(var k in categories){
                var template = this.searchCategoryItemTemplate;

                template = template.replaceAll('%%ID%%', categories[k].id);
                template = template.replaceAll('%%NAME%%', categories[k].theme);

                categoryItemsWrap.append(template);
            }

            wrap.show();
        }
        else{
            $(this.node).find('.filter-tooltip').hide();
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
            category: this.dataProps.category.get(),
            type: 'works',
        }

        $.post(self.sendUri, questData, function(res){
            $(self.node).closest('.profile-projects').find('.list-projects__items').empty();
            $(self.node).closest('.profile-projects').find('.list-projects__items').append(res);
        })
    }
}

class BloggerProjectsOffersFilter {
    constructor(node) {
        this.node = node;

        $(this.node).find('.btn-filter-send').on('click', this.sendData);
        $(this.node).find('.filter__reset').on('click', this.resetFilters);

        $(this.node).find('#filter-category').on('input', (e) => {
            var search = $(e.target).val();

            this.searchTimeout = setTimeout(()=>{
                this.getCategories(search)
            }, 300)
        });

        $(this.node).find('#filter-category').on('focus', (e)=>{
            $(this.node).on('click', (e) => {
                if($(e.target).closest('.filter-tooltip__row').length > 0){
                    var el = $(e.target).closest('.filter-tooltip__row'),
                        text = el.text(),
                        id = el.data('id');

                    $(this.node).find('#filter-category').val(text.trim());
                    this.dataProps.category.set(id)

                    clearTimeout(this.searchTimeout);
                    this.searchTimeout = false;
                    $(this.node).find('.filter-tooltip').hide();
                }
                else if(!$(e.target).closest('.filter-category').length > 0){
                    clearTimeout(this.searchTimeout);
                    this.searchTimeout = false;
                    $(this.node).find('.filter-tooltip').hide();
                }
            })
        })

        return this;
    }
    node = '';
    sendUri = '/apist/blogger/projects';

    getCategoryUri = 'apist/projects/categories';

    searchTimeout = false;

    searchCategoryItemTemplate = `<div class="filter-tooltip__row" data-id="%%ID%%">
                                    %%NAME%%
                                </div>`

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
        category: {
            set: (value)=>{
                $(this.node).find('#filter-category-id').val(value);
            },
            get: ()=>{
                return $(this.node).find('#filter-category-id').val();
            }
        }
    }

    resetFilters = () => {
        for(var key in this.dataProps){
            this.dataProps[key].set('');
        }
    }

    getCategories = (search) => {
        var self = this;

        $.get(self.getCategoryUri, {
            category: search
        }, function(res){
            self.insertCategorySearchResults(res.categories);
        })
    }

    insertCategorySearchResults = (categories) => {
        if(categories.length > 0){
            var wrap = $(this.node).find('.filter-tooltip'),
                categoryItemsWrap = wrap.find('.filter-tooltip__items');

            categoryItemsWrap.empty();

            for(var k in categories){
                var template = this.searchCategoryItemTemplate;

                template = template.replaceAll('%%ID%%', categories[k].id);
                template = template.replaceAll('%%NAME%%', categories[k].theme);

                categoryItemsWrap.append(template);
            }

            wrap.show();
        }
        else{
            $(this.node).find('.filter-tooltip').hide();
        }
    }

    sendData = ()=>{
        var self = this;

        var questData = {
            project_type: this.dataProps.format.get(),
            project_name: this.dataProps.projectName.get(), type: 'applications',
            category: this.dataProps.category.get(),
        }

        $.post(self.sendUri, questData, function(res){
            $(self.node).closest('.profile-projects').find('.list-projects__items').empty();
            $(self.node).closest('.profile-projects').find('.list-projects__items').append(res);
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
                $(self.node).find('.btn-action').data('id', res['data-id']);

                if(res['btn-class'] == 'accept-btn'){
                    $(self.node).find('.btn-action').prop('href', `/apist/works/${self.currentChatId}/accept`);
                }
                else{
                    $(self.node).find('.btn-action').prop('href', `#`);
                }

                $(self.node).find(`.item-chat[data-id="${self.currentChatId}"]`).addClass('current')
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
        delete this;
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

class PopupBloggerSendStatistics extends Popup{
    constructor(node){
        super(node);

        this.node = node;

        $(this.node).find('.send-data').on('click', this.sendData)

        return this;
    }

    node = '';
    sendUri = "";
    workId = false;

    dataProps = {
        subs: {
            set: (val) => {
                if(!val) $(this.node).find('#subs').val('');
            },
            get: () =>{
                return $(this.node).find('#subs').val();
            }
        },
        views: {
            set: (val) => {
                if(!val) $(this.node).find('#views').val('');
            },
            get: () =>{
                return $(this.node).find('#views').val();
            }
        },
        reposts: {
            set: (val) => {
                if(!val) $(this.node).find('#reposts').val('');
            },
            get: () =>{
                return $(this.node).find('#reposts').val();
            }
        },
        likes: {
            set: (val) => {
                if(!val) $(this.node).find('#likes').val('');
            },
            get: () =>{
                return $(this.node).find('#likes').val();
            }
        },
        stats: {
            set: (val) => {
                if(!val) $(this.node).find('#statistics-file').val( '');
            },
            get: () =>{
                return $(this.node).find('#statistics-file').prop('files');
            }
        }
    }

    sendData = () => {
        var self = this,
            data = new FormData();

        for(let k in this.dataProps){
            if(k != 'stats')
                data.append(k, this.dataProps[k].get())
        }

        var images = this.dataProps.stats.get()

        for (let i = 0; i < images.length; i++) {
            data.append('images[]', images[i]);
        }

        $.ajax({
            url: `/apist/works/${self.workId}/stats`,
            data: data,
            method: 'POST',
            type: 'POST',
            processData: false,
            contentType: false,
            success: (res)=>{
                self.closePopup();
                notify('info', {title: 'Успешно!', message: 'Статистика успешно отправлена'});
                for(let k in self.dataProps){
                    self.dataProps[k].set(false);
                }
                self.desctructor()
            }
        })
    }

    desctructor = ()=> {
        delete this;
    }
}

class PopupBloggerSendOffer extends Popup{
    constructor(node){
        super(node);

        this.node = node;

        $(this.node).find('.send-data').on('click', this.sendData)

        return this;
    }

    node = '';
    sendUri = "/apist/works";
    projectWorkId = false;

    dataProps = {
        message: {
            set: (val) => {console.log(val);},
            get: () =>{
                return $(this.node).find('#message').val();
            }
        },
    }

    sendData = () => {
        var self = this,
            data = new FormData();

        for(let k in this.dataProps){
            data.append(k, this.dataProps[k].get())
        }

        data.append('project_work_id', self.projectWorkId)

        $.ajax({
            url: `${self.sendUri}`,
            data: data,
            method: 'POST',
            processData: false,
            contentType: false,
            success: (res)=>{
                self.closePopup();
                notify('info', {title: 'Успешно!', message: 'Отклик успешно отправлен'});

                $(document).find(`.btn-blogger-send-offer[data-project-work="${self.projectWorkId}"]`).text('Начать работу')
                $(document).find(`.btn-blogger-send-offer[data-project-work="${self.projectWorkId}"]`).removeClass('btn-blogger-send-offer')
            }
        })
    }
}

class PopupSellerChooseProjectsFormat extends Popup{
    constructor(node){
        super(node);

        this.node = node;

        $(this.node).find('.btn-confirm').on('click', this.confirm);
        $(this.node).on('click', '.input-checkbox-w', function(e){
            var wrap = $(e.target).closest('.input-checkbox-w'),
                cRadio = wrap.find('input[type="radio"]'),
                allRadio = $(e.target).closest('.popup__form').find(`.popup__formats .input-checkbox-w[data-id!="${cRadio.closest('.input-checkbox-w').data('id')}"] input[type="radio"]`);

            allRadio.prop('checked', false);
        })


        return this;
    }

    node = '';
    projectNode = null;

    formatTemplate = `<div class="input-checkbox-w" data-id="%%ID%%">
        <input id="format_%%COUNTER%%" name="format_%%COUNTER%%" type="radio" class="checkbox">
        <label for="format_%%COUNTER%%">%%NAME%%</label>
    </div>`;

    addFormats = (list) => {
        $(this.node).find('.popup__formats').empty();

        list.each((i, v)=>{
            var name = $(v).find('span').text(),
                counter = i,
                id = $(v).data('id');

            var template = this.formatTemplate;

            template = template.replaceAll('%%ID%%', id);
            template = template.replaceAll('%%NAME%%', name);
            template = template.replaceAll('%%COUNTER%%', counter);

            $(this.node).find('.popup__formats').append(template);
        })
    }

    confirm = () => {
        var currentFormat = $(this.node).find('.popup__formats .input-checkbox-w input:checked');

        if(currentFormat.length == 0){
            notify('info', {title: 'Внимание!', message: 'Необходимо выбрать проект'});
            return
        }

        $('.current-project').show();
        $(document).find('#profile-blogers-list .projects-list__header .projects-list__choose-btn').hide();

        $('.current-project').find('.projects-list__choose-btn').show();
        $('#profile-projects-choose').removeClass('active');
        $('#profile-blogers-list').addClass('active');

        var articul = $(this.projectNode).find('.btn-choose-project').data('articul'),
            name = $(this.projectNode).find('.project-item__subtitle').text(),
            imgUrl = $(this.projectNode).find('.project-item__img').css('backgroundImage');

        $('.current-project').find('.current-project__main .current-project__title .articul span').text(articul)
        $('.current-project').find('.current-project__main .current-project__title .name b').text(name)
        $('.current-project').find('.current-project__img').css('backgroundImage', imgUrl)
        $('.current-project').find('.current-project__format .articul').text(currentFormat.closest('.input-checkbox-w').find('label').text())
        $('.current-project').data('id', currentFormat.closest('.input-checkbox-w').data('id'))

        this.closePopup();
        delete this;
    }
}

class PopupBlogerProjectMoreInfo extends Popup{
    constructor(node){
        super(node);

        this.node = node;



        return this;
    }

    node = '';
    getProjectInfoUri = 'apist/projects/%%PROJECT_ID%%/wb-info'
    projectId = false

    formatTemplate = `<div class="characteristics__row">
                        <div class="characteristics__row-left">
                            <div class="characteristics__title">
                                %%TITLE%%
                            </div>
                            <hr>
                        </div>
                        <div class="characteristics__row-right">
                            <div class="characteristics__desc">
                                %%DESC%%
                            </div>
                        </div>
                    </div>`;

    getProjectInfo = () => {
        var self = this;
        this.getProjectInfoUri = this.getProjectInfoUri.replaceAll('%%PROJECT_ID%%', this.projectId);

        $.ajax({
            url: `${self.getProjectInfoUri}`,
            data: {},
            method: 'GET',
            processData: false,
            contentType: false,
            success: (res)=>{
                console.log(res);
            }
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
    $(document).on('click', '.btn-blogger-send-offer', function(e){
        var btn = $(e.target).closest('.btn-blogger-send-offer');

        var popup = new PopupBloggerSendOffer('#blogger-send-offer');

        popup.openPopup();
        popup.projectWorkId = btn.data('project-work');
    })

    $(document).on('click', '#blogger .project-item', function(e){
        if($(e.target).closest('.project-item__btns').length == 0){
            var popup = new PopupBlogerProjectMoreInfo('#project-item-info');
            popup.projectId = $(e.target).closest('.project-item').data('id');
            popup.getProjectInfo()
            popup.openPopup();
        }
    })

    $(document).find('.form-stat__title').on('click', function(e){
        $(e.target).closest('.form-stat').toggleClass('active');
    })

    $(document).on('click', '.projects-list__choose-btn', function(e){
        console.log(e.target);
        e.preventDefault();

        $('#profile-projects-choose').addClass('active');
        $('#profile-blogers-list').removeClass('active');

        $(document).on('click', '.btn-choose-project', function(e){
            var choosePopup = new PopupSellerChooseProjectsFormat('#choose-projects-adv-format');
            choosePopup.openPopup();

            var formats = $(e.target).closest('.project-item').find('.project-item__format-tags .card__tags-item');
            choosePopup.addFormats(formats);

            choosePopup.projectNode = $(e.target).closest('.project-item')
        })
    })

    $(document).on('click', '.item-chat__project-link--seller', function(e){
        var pId = $(e.target).closest('.item-chat__project-link--seller').data('project-id');

        $(document).find('.projects-list-link').click();

        $(`.profile-projects__item[data-id="${pId}"]`).addClass('hovered')

        $([document.documentElement, document.body]).animate({
            scrollTop: $(`.profile-projects__item[data-id="${pId}"]`).offset().top
            });

        setTimeout(()=>{
            $(`.profile-projects__item[data-id="${pId}"]`).removeClass('hovered')
        }, 3000)
    })

    $(document).on('click', '.item-chat__project-link--blogger', function(e){
        var pId = $(e.target).closest('.item-chat__project-link--blogger').data('project-id');

        $(document).find('.projects-work-link').click();

        $(`.project-item[data-id="${pId}"]`).addClass('hovered')

        $([document.documentElement, document.body]).animate({
            scrollTop: $(`.project-item[data-id="${pId}"]`).offset().top
            });

        setTimeout(()=>{
            $(`.project-item[data-id="${pId}"]`).removeClass('hovered')
        }, 3000)
    })

    $(document).on('click', '#send-stats-blogger-btn', function(e){
        var btn = $(e.target).closest('#send-stats-blogger-btn');
        var form = new PopupBloggerSendStatistics('#send-statistics-blogger');

        form.workId = $(btn).data('id');
        form.openPopup()
    })
    $(document).on('click', '.notif-header__goto', function(e){
        e.preventDefault();

        $(document).find('.chat-link').click();
        $(document).find(`.item-chat[data-id="${$(e.target).closest('.notif-header__goto').data('work-id')}"]`).click();
        $(document).find(`.item-chat[data-id="${$(e.target).closest('.notif-header__goto').data('work-id')}"]`).addClass('current');
    })

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

    $('.profile-projects__item').find('.projects-blogers--leads').owlCarousel({
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
    $('.profile-projects__item').find('.projects-blogers--in_work').owlCarousel({
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
    $('.list-projects__item').find('.project-item__carousel--carousel').owlCarousel({
        margin: 5,
        nav: false,
        dots: true,
        responsive: {
            0:{
                items: 1
            },
            1180: {
                items:1
            }
        }
    });
    $('.popup-project__carousel').owlCarousel({
        margin: 5,
        nav: false,
        dots: true,
        responsive: {
            0:{
                items: 1
            },
            1180: {
                items:1
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
    var projectsFilters = new ProjectsFilter('.profile#seller #profile-projects .projects-list__filter', 'projects-page');
    var projectsFiltersChoose = new ProjectsFilter('.profile#seller #profile-projects-choose .projects-list__filter', 'select-project-page');
    var blogersProjectsFilters = new BloggerProjectsFilter('.profile#blogger #my-projects .projects-list__filter');
    var blogersAllProjectsFilters = new BloggerAllProjectsFilter('.profile#blogger #profile-projects .projects-list__filter');
    var bloggerProjectsOffersFilter = new BloggerProjectsOffersFilter('.profile#blogger #avail-projects .projects-list__filter');

    $('.projects-list__filter-btn').on('click', function(){
        $('.projects-list__filter').addClass('opened');

        $(document).off('click', '.projects-list__filter-btn').on('click', document, function(e){
            console.log($(e.target).closest('.projects-list__filter'));
            if(!$(e.target).closest('.projects-list__filter').length > 0 && !$(e.target).hasClass('projects-list__filter-btn')){
                $('.projects-list__filter').removeClass('opened');
                $(document).off('click', document)
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
