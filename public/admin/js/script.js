class Tabs {
    constructor(node) {
        this.node = node;

        $(this.node).find('.tab').on('click', (e)=>{
            e.preventDefault();
            this.tabClick(e)
        });

        return this;
    }
    node = '';
    dataProps = {

    }
    tabClick = (e)=>{
        var curTab = $(e.target).closest('.tab');

        $('.tab').removeClass('active');
        $('.tab-content').removeClass('active');

        curTab.addClass('active');
        $(`#${curTab.data('content')}`).addClass('active')
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

class PopupAcceptBloger extends Popup{
    constructor(node){
        super(node);

        $(this.node).find('.btn.send-data').on('click', this.sendData)
        $(this.node).find('.close-popup').on('click', this.closePopup)
        $(this.node).find('.form-stat__title').on('click', (e) => this.statCardClick(e))

        var changeTelegramEr = null, self = this;

        $(this.node).find('#telegram_subs').on('focusout', function(e){
            var cover = $(self.node).find('#telegram_cover').val(),
                subs = $(e.target).val();

            if(subs && cover){
                changeTelegramEr = setTimeout(() => {
                    var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                    val = (Math.round(val * 100) / 100).toFixed(2);

                    $(self.node).find('#telegram_er').val(val);
                }, 100);
            }
        })
        $(this.node).find('#telegram_cover').on('focusout', function(e){
            var subs = $(self.node).find('#telegram_subs').val(),
                cover = $(e.target).val();

            changeTelegramEr && clearTimeout(changeTelegramEr);

            if(subs && cover){
                changeTelegramEr = setTimeout(() => {
                    var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                    val =(Math.round(val * 100) / 100).toFixed(2);

                    $(self.node).find('#telegram_er').val(val);
                }, 100);
            }
        })

        var changeInstagramEr = null;

        $(this.node).find('#instagram_subs').on('focusout', function(e){
            var cover = $(self.node).find('#instagram_cover').val(),
                subs = $(e.target).val();

            if(subs && cover){
                changeInstagramEr = setTimeout(() => {
                    var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                    val = (Math.round(val * 100) / 100).toFixed(2);

                    $(self.node).find('#instagram_er').val(val);
                }, 100);
            }
        })
        $(this.node).find('#instagram_cover').on('focusout', function(e){
            var subs = $(self.node).find('#instagram_subs').val(),
                cover = $(e.target).val();

            changeInstagramEr && clearTimeout(changeInstagramEr);

            if(subs && cover){
                changeInstagramEr = setTimeout(() => {
                    var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                    val = (Math.round(val * 100) / 100).toFixed(2);

                    $(self.node).find('#instagram_er').val(val);
                }, 100);
            }
        })

        var changeVkEr = null;

        $(this.node).find('#vk_subs').on('focusout', function(e){
            var cover = $(self.node).find('#vk_cover').val(),
                subs = $(e.target).val();

            if(subs && cover){
                changeVkEr = setTimeout(() => {
                    var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                    val = (Math.round(val * 100) / 100).toFixed(2);

                    $(self.node).find('#vk_er').val(val);
                }, 100);
            }
        })
        $(this.node).find('#vk_cover').on('focusout', function(e){
            var subs = $(self.node).find('#vk_subs').val(),
                cover = $(e.target).val();

            changeVkEr && clearTimeout(changeVkEr);

            if(subs && cover){
                changeVkEr = setTimeout(() => {
                    var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                    val = (Math.round(val * 100) / 100).toFixed(2);

                    $(self.node).find('#vk_er').val(val);
                }, 100);
            }
        })

        var changeYoutubeEr = null;

        $(this.node).find('#youtube_subs').on('focusout', function(e){
            var cover = $(self.node).find('#youtube_cover').val(),
                subs = $(e.target).val();

            if(subs && cover){
                changeYoutubeEr = setTimeout(() => {
                    var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                    val = (Math.round(val * 100) / 100).toFixed(2);

                    $(self.node).find('#youtube_er').val(val);
                }, 100);
            }
        })
        $(this.node).find('#youtube_cover').on('focusout', function(e){
            var subs = $(self.node).find('#youtube_subs').val(),
                cover = $(e.target).val();

            changeYoutubeEr && clearTimeout(changeYoutubeEr);

            if(subs && cover){
                changeYoutubeEr = setTimeout(() => {
                    var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                    val =(Math.round(val * 100) / 100).toFixed(2);

                    $(self.node).find('#youtube_er').val(val);
                }, 100);
            }
        })
        var changeYoutubeAdditEr = null;

        $(this.node).find('#youtube_subs').on('focusout', function(e){
            var cover = $(self.node).find('#youtube_additional_cover').val(),
                subs = $(e.target).val();

            if(subs && cover){
                changeYoutubeAdditEr = setTimeout(() => {
                    var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                    val = (Math.round(val * 100) / 100).toFixed(2);

                    $(self.node).find('#youtube_additional_er').val(val);
                }, 100);
            }
        })
        $(this.node).find('#youtube_additional_cover').on('focusout', function(e){
            var subs = $(self.node).find('#youtube_subs').val(),
                cover = $(e.target).val();

            changeYoutubeAdditEr && clearTimeout(changeYoutubeAdditEr);

            if(subs && cover){
                changeYoutubeAdditEr = setTimeout(() => {
                    var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                    val =(Math.round(val * 100) / 100).toFixed(2);

                    $(self.node).find('#youtube_additional_er').val(val);
                }, 100);
            }
        })

        var changeVKAdditEr = null;

        $(this.node).find('#vk_subs').on('focusout', function(e){
            var cover = $(self.node).find('#vk_additional_cover').val(),
                subs = $(e.target).val();

            if(subs && cover){
                changeVKAdditEr = setTimeout(() => {
                    var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                    val = (Math.round(val * 100) / 100).toFixed(2);

                    $(self.node).find('#vk_additional_er').val(val);
                }, 100);
            }
        })
        $(this.node).find('#vk_additional_cover').on('focusout', function(e){
            var subs = $(self.node).find('#vk_subs').val(),
                cover = $(e.target).val();

            changeVKAdditEr && clearTimeout(changeVKAdditEr);

            if(subs && cover){
                changeVKAdditEr = setTimeout(() => {
                    var val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

                    val =(Math.round(val * 100) / 100).toFixed(2);

                    $(self.node).find('#vk_additional_er').val(val);
                }, 100);
            }
        })

        return this;
    }

    sendUri = '/apist/admin/bloggers/accept';
    getUri = '/apist/bloggers';

    blogger_id = '';

    statCardClick = (e) => {
        $(e.target).closest('.form-stat').toggleClass('active');
    }

    dataProps = {
        desc: {
            set: (val)=>{
                $(this.node).find('#desc').val(val);
            },
            get: ()=>{
                return $(this.node).find('#desc').val();
            }
        },
        gender_ratio: {
            set: (val)=>{
                $(this.node).find('#gender_ratio').val(val);
                $(this.node).find('#gender_ratio_f').val(100 - Number(val));
            },
            get: ()=>{
                return $(this.node).find('#gender_ratio').val();
            }
        },
        country: {
            set: (val)=>{
                $(this.node).find('#country').val(val);
            },
            get: ()=>{
                return $(this.node).find('#country').val();
            }
        },
        city: {
            set: (val)=>{
                $(this.node).find('#city').val(val);
            },
            get: ()=>{
                return $(this.node).find('#city').val();
            }
        },
        sex: {
            set: (val)=>{
                $(this.node).find('#sex').val(val);
            },
            get: ()=>{
                return $(this.node).find('#sex').val();
            }
        },
        is_achievement: {
            set: (val)=>{
                if(val == 1) $(this.node).find('#is_achievement').prop('checked', true)
            },
            get: ()=>{
                return $(this.node).find('#is_achievement').is(':checked');
            }
        },

        telegram_subs: {
            set: (val)=>{
                $(this.node).find('#telegram_subs').val(val)
            },
            get: ()=>{
                return $(this.node).find('#telegram_subs').val();
            }
        },
        telegram_cover: {
            set: (val)=>{
                $(this.node).find('#telegram_cover').val(val)
            },
            get: ()=>{
                return $(this.node).find('#telegram_cover').val();
            }
        },
        telegram_er: {
            set: (val)=>{
                $(this.node).find('#telegram_er').val(val)
            },
            get: ()=>{
                return $(this.node).find('#telegram_er').val();
            }
        },
        telegram_cpm: {
            set: (val)=>{
                $(this.node).find('#telegram_cpm').val(val)
            },
            get: ()=>{
                return $(this.node).find('#telegram_cpm').val();
            }
        },
        telegram_link: {
            set: (val)=>{
                $(this.node).find('#telegram_link').val(val)
            },
            get: ()=>{
                return $(this.node).find('#telegram_link').val();
            }
        },

        instagram_subs: {
            get: ()=>{
                return $(this.node).find('#instagram_subs').val();
            },
            set: (val)=>{
                $(this.node).find('#instagram_subs').val(val);
            },
        },
        instagram_cover: {
            get: ()=>{
                return $(this.node).find('#instagram_cover').val();
            },
            set: (val)=>{
                $(this.node).find('#instagram_cover').val(val);
            },
        },
        instagram_er: {
            get: ()=>{
                return $(this.node).find('#instagram_er').val();
            },
            set: (val)=>{
                $(this.node).find('#instagram_er').val(val);
            },
        },
        instagram_cpm: {
            get: ()=>{
                return $(this.node).find('#instagram_cpm').val();
            },
            set: (val)=>{
                $(this.node).find('#instagram_cpm').val(val);
            },
        },
        instagram_link: {
            get: ()=>{
                return $(this.node).find('#instagram_link').val();
            },
            set: (val)=>{
                $(this.node).find('#instagram_link').val(val);
            },
        },

        youtube_subs: {
            set: (val)=>{
                $(this.node).find('#youtube_subs').val(val)
            },
            get: ()=>{
                return $(this.node).find('#youtube_subs').val();
            }
        },
        youtube_cover: {
            set: (val)=>{
                $(this.node).find('#youtube_cover').val(val)
            },
            get: ()=>{
                return $(this.node).find('#youtube_cover').val();
            }
        },
        youtube_er: {
            set: (val)=>{
                $(this.node).find('#youtube_er').val(val)
            },
            get: ()=>{
                return $(this.node).find('#youtube_er').val();
            }
        },
        youtube_additional_cover: {
            set: (val)=>{
                $(this.node).find('#youtube_additional_cover').val(val)
            },
            get: ()=>{
                return $(this.node).find('#youtube_additional_cover').val();
            }
        },
        youtube_additional_er: {
            set: (val)=>{
                $(this.node).find('#youtube_additional_er').val(val)
            },
            get: ()=>{
                return $(this.node).find('#youtube_additional_er').val();
            }
        },
        youtube_cpm: {
            set: (val)=>{
                $(this.node).find('#youtube_cpm').val(val)
            },
            get: ()=>{
                return $(this.node).find('#youtube_cpm').val();
            }
        },
        youtube_link: {
            set: (val)=>{
                $(this.node).find('#youtube_link').val(val)
            },
            get: ()=>{
                return $(this.node).find('#youtube_link').val();
            }
        },

        vk_subs: {
            set: (val)=>{
                $(this.node).find('#vk_subs').val(val)
            },
            get: ()=>{
                return $(this.node).find('#vk_subs').val();
            }
        },
        vk_cover: {
            set: (val)=>{
                $(this.node).find('#vk_cover').val(val)
            },
            get: ()=>{
                return $(this.node).find('#vk_cover').val();
            }
        },
        vk_er: {
            set: (val)=>{
                $(this.node).find('#vk_er').val(val)
            },
            get: ()=>{
                return $(this.node).find('#vk_er').val();
            }
        },
        vk_additional_cover: {
            set: (val)=>{
                $(this.node).find('#vk_additional_cover').val(val)
            },
            get: ()=>{
                return $(this.node).find('#vk_additional_cover').val();
            }
        },
        vk_additional_er: {
            set: (val)=>{
                $(this.node).find('#vk_additional_er').val(val)
            },
            get: ()=>{
                return $(this.node).find('#vk_additional_er').val();
            }
        },
        vk_cpm: {
            set: (val)=>{
                $(this.node).find('#vk_cpm').val(val)
            },
            get: ()=>{
                return $(this.node).find('#vk_cpm').val();
            }
        },
        vk_link: {
            set: (val)=>{
                $(this.node).find('#vk_link').val(val)
            },
            get: ()=>{
                return $(this.node).find('#vk_link').val();
            }
        },
    }

    getData = () => {
        var self = this;

        $.get(`${self.getUri}/${self.blogger_id}`, {}, function(res){
            console.log(res);

            self.setPlatforms(res.platforms);
            self.setUsersData(res.blogger)
        })
    }

    setUsersData = (blogger)=>{
        this.dataProps.gender_ratio.set(blogger.gender_ratio || 50);
        this.dataProps.is_achievement.set(blogger.is_achievement);
        this.dataProps.desc.set(blogger.description || '');
        this.dataProps.sex.set(blogger.sex || '');
        this.dataProps.country.set(blogger.country_id || 0);
        this.dataProps.city.set(blogger.city || '');
    }

    setPlatforms = (platforms) => {
        var self = this;

        platforms.forEach(item=>{
            switch(item.name){
                case 'Telegram':
                    self.dataProps.telegram_subs.set(item.subscriber_quantity);
                    self.dataProps.telegram_link.set(item.link);
                    self.dataProps.telegram_cpm.set(item.cost_per_mille);
                    self.dataProps.telegram_er.set(item.engagement_rate);
                    self.dataProps.telegram_cover.set(item.coverage);
                break;
                case 'Instagram':
                    self.dataProps.instagram_subs.set(item.subscriber_quantity);
                    self.dataProps.instagram_link.set(item.link);
                    self.dataProps.instagram_cpm.set(item.cost_per_mille);
                    self.dataProps.instagram_er.set(item.engagement_rate);
                    self.dataProps.instagram_cover.set(item.coverage);
                break;
                case 'Youtube':
                    self.dataProps.youtube_subs.set(item.subscriber_quantity);
                    self.dataProps.youtube_link.set(item.link);
                    self.dataProps.youtube_cpm.set(item.cost_per_mille);
                    self.dataProps.youtube_er.set(item.engagement_rate);
                    self.dataProps.youtube_cover.set(item.coverage);
                    self.dataProps.youtube_additional_er.set(item.additional_engagement_rate);
                    self.dataProps.youtube_additional_cover.set(item.additional_coverage);
                break;
                case 'VK':
                    self.dataProps.vk_subs.set(item.subscriber_quantity);
                    self.dataProps.vk_link.set(item.link);
                    self.dataProps.vk_cpm.set(item.cost_per_mille);
                    self.dataProps.vk_er.set(item.engagement_rate);
                    self.dataProps.vk_cover.set(item.coverage);
                    self.dataProps.vk_additional_er.set(item.additional_engagement_rate);
                    self.dataProps.vk_additional_cover.set(item.additional_coverage);
                break
            }
        })
    }

    emptyForm = () => {
        this.blogger_id = null;
        this.dataProps.gender_ratio.set(50);
        this.dataProps.sex.set('');
        this.dataProps.is_achievement.set('');
        this.dataProps.country.set('');
        this.dataProps.city.set('');
        this.dataProps.desc.set();

        this.dataProps.telegram_subs.set('');
        this.dataProps.telegram_cover.set('');
        this.dataProps.telegram_er.set('');
        this.dataProps.telegram_cpm.set('');
        this.dataProps.telegram_link.set('');

        this.dataProps.instagram_subs.set('');
        this.dataProps.instagram_cover.set('');
        this.dataProps.instagram_er.set('');
        this.dataProps.instagram_cpm.set('');
        this.dataProps.instagram_link.set('');

        this.dataProps.youtube_subs.set('');
        this.dataProps.youtube_cover.set('');
        this.dataProps.youtube_er.set('');
        this.dataProps.youtube_additional_cover.set('');
        this.dataProps.youtube_additional_er.set('');
        this.dataProps.youtube_cpm.set('');
        this.dataProps.youtube_link.set('');

        this.dataProps.vk_subs.set('');
        this.dataProps.vk_cover.set('');
        this.dataProps.vk_er.set('');
        this.dataProps.vk_additional_cover.set('');
        this.dataProps.vk_additional_er.set('');
        this.dataProps.vk_cpm.set('');
        this.dataProps.vk_link.set('');
    }

    sendData = () => {
        var self = this;

        $.post(self.sendUri, {
            blogger_id: self.blogger_id,
            gender_ratio: self.dataProps.gender_ratio.get(),
            sex: self.dataProps.sex.get(),
            is_achievement: Number(self.dataProps.is_achievement.get()),
            country_id: self.dataProps.country.get(),
            city: self.dataProps.city.get(),
            desc: self.dataProps.desc.get(),

            telegram_subs: self.dataProps.telegram_subs.get(),
            telegram_cover: self.dataProps.telegram_cover.get(),
            telegram_er: self.dataProps.telegram_er.get(),
            telegram_cpm: self.dataProps.telegram_cpm.get(),
            telegram_link: self.dataProps.telegram_link.get(),

            instagram_subs: self.dataProps.instagram_subs.get(),
            instagram_cover: self.dataProps.instagram_cover.get(),
            instagram_er: self.dataProps.instagram_er.get(),
            instagram_cpm: self.dataProps.instagram_cpm.get(),
            instagram_link: self.dataProps.instagram_link.get(),

            youtube_subs: self.dataProps.youtube_subs.get(),
            youtube_cover: self.dataProps.youtube_cover.get(),
            youtube_er: self.dataProps.youtube_er.get(),
            youtube_additional_coverage: self.dataProps.youtube_additional_cover.get(),
            youtube_additional_engagement_rate: self.dataProps.youtube_additional_er.get(),
            youtube_cpm: self.dataProps.youtube_cpm.get(),
            youtube_link: self.dataProps.youtube_link.get(),

            vk_subs: self.dataProps.vk_subs.get(),
            vk_cover: self.dataProps.vk_cover.get(),
            vk_er: self.dataProps.vk_er.get(),
            vk_additional_coverage: self.dataProps.vk_additional_cover.get(),
            vk_additional_engagement_rate: self.dataProps.vk_additional_er.get(),
            vk_cpm: self.dataProps.vk_cpm.get(),
            vk_link: self.dataProps.vk_link.get(),
        }, function(res){
            notify('info', {title: 'Успешно!', message: ''});
            self.emptyForm();
            self.closePopup();
        })
    }

    closePopup = () => {
        $(this.node).removeClass('opened');
        this.emptyForm();
    }
}

class PopupAchivmentsManagement extends Popup{
    constructor(node){
        super(node);

        return this;
    }

    sendUri = '#';
    blogerId = '';
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
    blogerAchivments = {}
    getAchivments = ()=>{
        console.log(this.blogerId)
    }
    saveData = ()=>{

    }
}

class PopupConfirmDeletion extends Popup{
    constructor(node){
        super(node);

        this.node = node;

        $(this.node).find('.close-popup-btn').on('click', this.closePopup)
        $(this.node).find('.send-data').on('click', ()=>{
            var self = this;

            $.ajax({
                url: '/apist/users/' + self.id,
                type: 'DELETE',
                success: function(result) {
                    self.card.remove();
                    self.closePopup()
                }
            });
        })

        if(!this.instagramance) this.instagramance = this;

        return this.instagramance;
    }
    instagramance = null;

    node = '';
    id = '';
    card = '';
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
    $(document).on('click', '.card__delete', function(e){
        var btn = $(e.currentTarget);

        e.preventDefault();

        confirmationPopup = new PopupConfirmDeletion('#confirm-deletion');

        confirmationPopup.id = btn.data('id')
        confirmationPopup.card = btn.closest('.card')
        confirmationPopup.openPopup()
    })

    //popups
    var acceptBlogerForm;
    $(document).on('click', '.btn-accept', function(e){
        e.preventDefault();

        if(!acceptBlogerForm){
            acceptBlogerForm = new PopupAcceptBloger('#accept-form');
        }

        acceptBlogerForm.blogger_id = e.target.dataset.id
        acceptBlogerForm.getData()
        acceptBlogerForm.openPopup()
    })

    $(document).on('click', '.header__menu-btn', function(){
        $('.admin-view__container').toggleClass('active-menu')
    })

    var adminTabs = new Tabs('.admin-view');

    $(document).on('click', '.btn-achivments-form', function(e){
        var achivmentsForm = new PopupAchivmentsManagement('#achivments-form');
        achivmentsForm.blogerId = $(e.target).closest('.bloger-item').data('id');
        achivmentsForm.getAchivments();
        achivmentsForm.openPopup();
    })


    $(document).on('click', '.blogers-search-btn', function(){
        let search = $(document).find('#blogers-search').val();

        $.post('/apist/admin/bloggers', {
            name: search
        },
        function(res){
            $('#blogers-list').find('.list-blogers').remove();
            $('#blogers-list').find('.admin-blogers__body').append(res);
        })
    })

    $(document).on('click', '.sellers-search-btn', function(){
        let search = $(document).find('#sellers-search').val();

        $.post('/apist/admin/sellers', {
            name: search
        },
        function(res){
            $('#sellers-list').find('.list-blogers').remove();
            $('#sellers-list').find('.admin-blogers__body').append(res);
        })
    })

    $(document).on('click', '.moderation-search-btn', function(){
        let search = $(document).find('#moderation-search').val();

        $.post('/apist/admin/moderation', {
            name: search
        },
        function(res){
            $('#moderation').find('.list-blogers').remove();
            $('#moderation').find('.admin-blogers__body').append(res);
        })
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
