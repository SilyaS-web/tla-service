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
        $(this.node).find('.form-stat__title').on('click', (e) => this.statCardClick(e))

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

        tg_subs: {
            set: (val)=>{
                $(this.node).find('#tg_subs').val(val)
            },
            get: ()=>{
                return $(this.node).find('#tg_subs').val();
            }
        },
        tg_cover: {
            set: (val)=>{
                $(this.node).find('#tg_cover').val(val)
            },
            get: ()=>{
                return $(this.node).find('#tg_cover').val();
            }
        },
        tg_er: {
            set: (val)=>{
                $(this.node).find('#tg_er').val(val)
            },
            get: ()=>{
                return $(this.node).find('#tg_er').val();
            }
        },
        tg_cpm: {
            set: (val)=>{
                $(this.node).find('#tg_cpm').val(val)
            },
            get: ()=>{
                return $(this.node).find('#tg_cpm').val();
            }
        },
        tg_link: {
            set: (val)=>{
                $(this.node).find('#tg_link').val(val)
            },
            get: ()=>{
                return $(this.node).find('#tg_link').val();
            }
        },

        inst_subs: {
            get: ()=>{
                return $(this.node).find('#inst_subs').val();
            },
            set: (val)=>{
                $(this.node).find('#inst_subs').val(val);
            },
        },
        inst_cover: {
            get: ()=>{
                return $(this.node).find('#inst_cover').val();
            },
            set: (val)=>{
                $(this.node).find('#inst_cover').val(val);
            },
        },
        inst_er: {
            get: ()=>{
                return $(this.node).find('#inst_er').val();
            },
            set: (val)=>{
                $(this.node).find('#inst_er').val(val);
            },
        },
        inst_cpm: {
            get: ()=>{
                return $(this.node).find('#inst_cpm').val();
            },
            set: (val)=>{
                $(this.node).find('#inst_cpm').val(val);
            },
        },
        inst_link: {
            get: ()=>{
                return $(this.node).find('#inst_link').val();
            },
            set: (val)=>{
                $(this.node).find('#inst_link').val(val);
            },
        },

        yt_subs: {
            set: (val)=>{
                $(this.node).find('#yt_subs').val(val)
            },
            get: ()=>{
                return $(this.node).find('#yt_subs').val();
            }
        },
        yt_cover: {
            set: (val)=>{
                $(this.node).find('#yt_cover').val(val)
            },
            get: ()=>{
                return $(this.node).find('#yt_cover').val();
            }
        },
        yt_er: {
            set: (val)=>{
                $(this.node).find('#yt_er').val(val)
            },
            get: ()=>{
                return $(this.node).find('#yt_er').val();
            }
        },
        yt_cpm: {
            set: (val)=>{
                $(this.node).find('#yt_cpm').val(val)
            },
            get: ()=>{
                return $(this.node).find('#yt_cpm').val();
            }
        },
        yt_link: {
            set: (val)=>{
                $(this.node).find('#yt_link').val(val)
            },
            get: ()=>{
                return $(this.node).find('#yt_link').val();
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
        this.dataProps.gender_ratio.set(blogger.gender_ratio || 0);
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
                    self.dataProps.tg_subs.set(item.subscriber_quantity);
                    self.dataProps.tg_link.set(item.link);
                    self.dataProps.tg_cpm.set(item.cost_per_mille);
                    self.dataProps.tg_er.set(item.engagement_rate);
                    self.dataProps.tg_cover.set(item.coverage);
                break;
                case 'Instagram':
                    self.dataProps.inst_subs.set(item.subscriber_quantity);
                    self.dataProps.inst_link.set(item.link);
                    self.dataProps.inst_cpm.set(item.cost_per_mille);
                    self.dataProps.inst_er.set(item.engagement_rate);
                    self.dataProps.inst_cover.set(item.coverage);
                break;
                case 'Youtube':
                    self.dataProps.yt_subs.set(item.subscriber_quantity);
                    self.dataProps.yt_link.set(item.link);
                    self.dataProps.yt_cpm.set(item.cost_per_mille);
                    self.dataProps.yt_er.set(item.engagement_rate);
                    self.dataProps.yt_cover.set(item.coverage);
                break;
                case 'VK':
                    self.dataProps.vk_subs.set(item.subscriber_quantity);
                    self.dataProps.vk_link.set(item.link);
                    self.dataProps.vk_cpm.set(item.cost_per_mille);
                    self.dataProps.vk_er.set(item.engagement_rate);
                    self.dataProps.vk_cover.set(item.coverage);
                break
            }
        })
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

            tg_subs: self.dataProps.tg_subs.get(),
            tg_cover: self.dataProps.tg_cover.get(),
            tg_er: self.dataProps.tg_er.get(),
            tg_cpm: self.dataProps.tg_cpm.get(),
            tg_link: self.dataProps.tg_link.get(),

            inst_subs: self.dataProps.inst_subs.get(),
            inst_cover: self.dataProps.inst_cover.get(),
            inst_er: self.dataProps.inst_er.get(),
            inst_cpm: self.dataProps.inst_cpm.get(),
            inst_link: self.dataProps.inst_link.get(),

            yt_subs: self.dataProps.yt_subs.get(),
            yt_cover: self.dataProps.yt_cover.get(),
            yt_er: self.dataProps.yt_er.get(),
            yt_cpm: self.dataProps.yt_cpm.get(),
            yt_link: self.dataProps.yt_link.get(),

            vk_subs: self.dataProps.vk_subs.get(),
            vk_cover: self.dataProps.vk_cover.get(),
            vk_er: self.dataProps.vk_er.get(),
            vk_cpm: self.dataProps.vk_cpm.get(),
            vk_link: self.dataProps.vk_link.get(),
        }, function(res){
            notify('info', {title: 'Успешно!', message: ''});
            self.closePopup();
        })
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
